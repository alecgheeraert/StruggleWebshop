<?php 

require ('../config.php');

$vkey = $_GET['vkey'];

$sql = "
SELECT      klant_id as ID,
            email as EMAIL,
            vkey as VKEY, 
            geverifieerd as VERIFIED,
            tijd_registratie as TIME
FROM        klant
WHERE       vkey
LIKE        ?";
$stmt = $pdo -> prepare( $sql );
$stmt -> execute([$vkey]);
$klanten = $stmt->fetchAll();
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struggle Clothing</title>

	<link href="<?php echo SITE_URL ?>/Authentication/Style/authentication.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL ?>/Style/navbarStyle.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL ?>/Style/footerStyle.css" rel="stylesheet" />

    <!-- Google Fonts ------- ( To add the fonts used. ) -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<!-- Icons -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script> 
</head>
<body>
<div class="grid-container">
 
<?php foreach ( $klanten as $klant ) {
    if ( !$klant->VERIFIED ) { 
            $timeCreate = new DateTime($klant->TIME);
            $timeNow = new DateTime(date('Y-m-d H:i:s'));
            $timeDiff = $timeCreate->diff($timeNow);
            if ( $timeDiff->format('%d') < 2 ) { ?> 
                <div class="grid-item"> <?php   
                    $sql = 'UPDATE klant SET geverifieerd = :geverifieerd WHERE klant_id = :id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['geverifieerd' => 1, 'id' => $klant->ID]); ?> 
                    Verification has been succesfull.
                </div> <?php
            } else { 

                    $vkey = md5(time().$email); 
                    // Email verification
                    $to = $klant->EMAIL;
                    $subject = "Account verification";
                    $message = "<h3>Welcome to Struggle Clothing.</h3>
                                We are happy that you are joining our community.<br>
                                Please click the link below to finish creating your account.<br>
                                <a href='".SITE_URL."/Authentication/verify.php?vkey=$vkey'>Verify here.</a><br>
                                Kind regards &<br>
                                Our team thanks you.";
                    $headers = "From: Struggle Clothing <struggle@6tib.com>\r\n";
                    $headers .= "Reply-To: struggle@6tib.com\r\n";
                    $headers .= "Content-type: text/html\r\n";

                    $sql = 'UPDATE klant SET vkey = :vkey, tijd_registratie = current_timestamp  WHERE klant_id = :id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['vkey' => $vkey, 'id' => $klant->ID]);

                    $emailSucces = mail( $to, $subject, $message, $headers );
                    if ( !$emailSucces ) {
                        $_SESSION['ERROR'] = "EMAIL";
                        header( 'location:'.SITE_URL.'/Authentication/error.php' );
                    } ?>

                    <div class="grid-item"> 
                        The verification code has expired. <br>
                        We have send you a new email.
                    </div> 
            <?php }
    } else { ?>
        <div class="grid-item"> 
            This account has already been verified.
        </div> <?php
    } ?>
    <div class="grid-item-home">
        <a href="../index.php">Home</a>
    </div>
<?php } ?>
</div>
</body>
</html>