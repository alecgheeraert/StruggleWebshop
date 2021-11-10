<?php
  require ('../config.php');

?>

<!DOCTYPE html>
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

<?php require(SITE_DIR.'/Include/navbar.php'); ?>

<div class="grid-container">
	<div class="grid-item">
		
		<?php 
		if ( empty( $_SESSION['ERROR'])) { } 
		else {
			?><div class="title"> Errors: </div><?php
			foreach ( $_SESSION['ERROR'] as $error ) { 
			?>
				<div class="error"> <?php echo $error ?> </div>
			<?php
		} 	}
		?>
        <div class="faq">
            If you would have any questions,<br>be sure to check our FAQ or <br>get in contact with us.
        </div>
	</div>
</div>

<?php require(SITE_DIR.'/Include/footer.php'); ?>

</body>
</html>