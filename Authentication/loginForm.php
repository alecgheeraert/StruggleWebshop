<?php require('../config.php'); ?>

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
        <form action="login.php" method="post">
            <input type="email" name="EMAIL" placeholder="Email"/><br>
            <input type="password" name="PASSWORD" placeholder="Password"/><br>
            <input type="submit" name="ACTION" value="LOGIN"></input><br>
            <p><a href="registerForm.php">Register here!</a></p>
        </form>
    </div>
    <div class="grid-item-error">
        <?php if ( !empty( $_SESSION['ERROR_LOG'])) { ?>
            <div class="title"> Errors: </div><?php
			foreach ( $_SESSION['ERROR_LOG'] as $error_log ) { ?>
				<div class="error_log"> <?php echo $error_log ?> </div>
		<?php } }?>
	</div>
</div>

<?php require(SITE_DIR.'/Include/footer.php'); ?>

</body>
</html>