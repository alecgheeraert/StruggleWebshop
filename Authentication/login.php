<?php

require ('../config.php');

$errorInput;
$email = $password = "";

if ( !empty($_POST)) { 
    if ( empty($_POST['EMAIL'])) { $errorInput[] = "Email is required."; }
    else { $email = checkInput( $_POST['EMAIL']); }

    if ( empty($_POST['PASSWORD'])) { $errorInput[] = "Password is required."; }
    else { $password = checkInput( $_POST['PASSWORD']); }
}

function checkInput( $dataInput ) {
    $dataInput = trim( $dataInput );              // Strip extra space, tab, newline
    $dataInput = stripslashes( $dataInput );      // Strip backslashes
    $dataInput = htmlspecialchars( $dataInput );  // Set $data to html chars
    return $dataInput;
}

$sql = '
SELECT  email as ACC_EMAIL, 
        wachtwoord as PASSWORD,
        geverifieerd as VERIFIED,
        admin as ADMIN
FROM    klant
WHERE   email
LIKE    ?';

$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$users = $stmt->fetchAll();

if ( empty( $errorInput) ) {
    if ( !empty( $users )) {
    foreach ( $users as $user ) {
        if ( password_verify( $email.$password, $user->PASSWORD ) ) {
                $_SESSION['LOGIN_OK'] = true;
                $_SESSION['ACCOUNT'] = $email;
                if ( $user->ADMIN ) {
                    $_SESSION['ADMIN_OK'] = true;
                }
                header('location:'.SITE_URL.'/index.php');
        } else {
            $errorInput[] = "Your email or password is incorrect.";
            foreach ( $errorInput as $error ) { error_log( $error ); }
            $_SESSION['ERROR_LOG'] = $errorInput;
            header('location:'.SITE_URL.'/Authentication/loginForm.php');
        }
    }
    } else {
        $errorInput[] = "Your email or password is incorrect.";
        foreach ( $errorInput as $error ) { error_log( $error ); }
        $_SESSION['ERROR_LOG'] = $errorInput;
        header('location:'.SITE_URL.'/Authentication/loginForm.php');
    }
    
} else {
    foreach ( $errorInput as $error ) { error_log( $error ); }
    $_SESSION['ERROR_LOG'] = $errorInput;
    header('location:'.SITE_URL.'/Authentication/loginForm.php');
}