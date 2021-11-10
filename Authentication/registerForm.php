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
	<div class="grid-item-disclamer">
		<p>
			Passwords must contain a Capital letter,
			lower case letter, number, special character and
			be at least 8 characters long.	
		</p>
	</div>

	<div class="grid-item">
		<form action="register.php" method="POST">
			<input type="text" 		name="FIRSTNAME" placeholder="First name" value=""/><br>
			<input type="text" 		name="LASTNAME"  placeholder="Last name" value=""/><br>
			<input type="email" 	name="EMAIL" 	 placeholder="Email" value=""/><br>
			<input type="password" 	name="PASSWORD"  placeholder="Password" value=""/><br>
			<input type="password" 	name="PASSWORDCONF" placeholder="Confirm Password" value=""/><br>
			<input type="text" 		name="ADRESS" 	 placeholder="Street + NR" value=""/><br>
			<input type="text" 		name="CITY" 	 placeholder="City" value=""/><br>
			<input type="text" 		name="CODE" 	 placeholder="Postal Code" value=""/><br>
			<input type="text" 		name="COUNTRY" 	 placeholder="Country" value=""/><br>
			<input type="submit" 	name="ACTION" 	 value="REGISTER"></input>
		</form>
	</div>

	<div class="grid-item-error">
		
		<?php 
		if ( empty( $_SESSION['ERROR_REG'])) { } 
		else {
			?><div class="title"> Errors: </div><?php
			foreach ( $_SESSION['ERROR_REG'] as $error_reg ) { 
			?>
				<div class="error_reg"> <?php echo $error_reg ?> </div>
			<?php
		} 	}
		?>
	</div>
</div>

<?php require(SITE_DIR.'/Include/footer.php'); ?>

</body>
</html>