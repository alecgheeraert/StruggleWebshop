<?php

require ('../config.php');
    
$errorInput;
$firstname = $lastname = $email = $adress = $city = $code = $country = $password = $passwordConf = "";

if ( !empty($_POST)) {
    if ( empty($_POST['FIRSTNAME']) ) { $errorInput[] = "Firstname is required."; }
    else { $firstname = checkInput(  $_POST['FIRSTNAME']); }

    if ( empty($_POST['LASTNAME']) ) { $errorInput[] = "Lastname is required."; }
    else { $lastname = checkInput( $_POST['LASTNAME']); }

    if ( empty($_POST['EMAIL'])) { $errorInput[] = "Email is required."; }
    else { $email = checkInput( $_POST['EMAIL']); }

    if ( empty($_POST['ADRESS'])) { $errorInput[] = "Adress is required."; }
    else { $adress = checkInput( $_POST['ADRESS']); }

    if ( empty($_POST['CITY'])) { $errorInput[] = "City is required."; }
    else { $city = checkInput( $_POST['CITY']); }
    
    if ( empty($_POST['CODE'])) { $errorInput[] = "Postalcode is required."; }
    else { $code = checkInput( $_POST['CODE']); }
    
    if ( empty($_POST['COUNTRY'])) { $errorInput[] = "Country is required."; }
    else { $country = checkInput( $_POST['COUNTRY']); }
    
    if ( empty($_POST['PASSWORD'])) { $errorInput[] = "Password is required."; }
    else { $password = $_POST['PASSWORD']; }

    if ( empty($_POST['PASSWORDCONF'])) { $errorInput[] = "Password confirmation is required."; }
    else { $passwordConf = $_POST['PASSWORDCONF']; }
}

function checkInput( $dataInput ) {
    $dataInput = trim( $dataInput );              // Strip extra space, tab, newline
    $dataInput = stripslashes( $dataInput );      // Strip backslashes
    $dataInput = htmlspecialchars( $dataInput );  // Set $data to html chars
    return $dataInput;
}


$sql = " SELECT * FROM klant WHERE klant.email LIKE ?";
$stmt = $pdo -> prepare( $sql );
$stmt -> execute([$email]);
$exists = $stmt -> fetchAll();
if ( count($exists) >= 1 ) { $errorInput[] = "This email already exists."; } else {

    $passUpperCase = preg_match('@[A-Z]@', $password);
    $passLowerCase = preg_match('@[a-z]@', $password);
    $passNumber = preg_match('@[0-9]@', $password);
    $passSpecialChars = preg_match('@[^\w]@', $password);

    if ( !$passUpperCase || !$passLowerCase || !$passNumber || !$passSpecialChars || strlen($password) < 8 ) {
        $errorInput[] = "Password does not pass all validation criteria.";
    } else {
        if ( $password != $passwordConf ) {
            $errorInput[] = "Passwords do not match.";     
        } 
    }

    // Vkey
    $vkey = md5(time().$email); 
}

if ( empty( $errorInput )) {

    $sql = 'INSERT INTO klant (voornaam, achternaam, adres, stad, postcode, land, email, wachtwoord, vkey) 
    VALUES(:voornaam, :achternaam, :adres, :stad, :postcode, :land, :email, :wachtwoord, :vkey)';
    $stmt = $pdo->prepare($sql);
    $stmt -> execute([
        'voornaam' => strtolower( $firstname ),
        'achternaam' => strtolower( $lastname ),
        'adres' => strtolower( $adress ),
        'stad' => strtolower( $city ),
        'postcode' => strtolower( $code ),
        'land' => strtolower( $country ),
        'email' => $email,
        'wachtwoord' => password_hash($email.$password, PASSWORD_DEFAULT),
        'vkey' => $vkey]);


    // Email verification
    $to = $email;
    $subject = "Account verification";
    $message = "<h3>Welcome to Struggle Clothing.</h3>
                We are happy that you are joining our community.<br>
                Please click the link below to finish creating your account.<br>
                <a href='".SITE_URL."/Authentication/verify.php?vkey=$vkey'>Verify here.</a><br>
                Kind regards &<br>
                Our team thanks you.";
    $headers = "From: Struggle Clothing <struggle@6tib.com>\r\n";
    $headers .= "Reply-To: struggle@6tib.com\r\n";
    $headers .= "Organization: Sender Organization\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

    $emailSucces = mail( $to, $subject, $message, $headers );
    if ( !$emailSucces ) {
        $_SESSION['ERROR'] = "There has been an error with sending a confirmation email.";
        header('location:'.SITE_URL.'/Authentication/error.php');

    } 

    $_SESSION['LOGIN_OK'] = true;
    $_SESSION['ACCOUNT'] = $email;
    header('location:'.SITE_URL.'/index.php');
    
} else {
    foreach ( $errorInput as $error ) { error_log( $error ); }
    $_SESSION['ERROR_REG'] = $errorInput;
    header('location:'.SITE_URL.'/Authentication/registerForm.php');
}