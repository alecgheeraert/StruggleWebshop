<?php 
require ( 'config.php' );

// htmlspecialchars();
if (isset( $_GET['prod_id'])&& isset ($_GET['cat_id']))  {
$prod_id = htmlspecialchars($_GET['prod_id']);
$cat_id = htmlspecialchars($_GET['cat_id']);


$sql = "
SELECT      product.product_id as PROD_ID,
            product.categorie_id as PROD_CAT,
            product.productnaam as PROD_NAME,
            product.prijs as PROD_PRICE,
            product.kleur as PROD_COLOR,
            product.foto as PROD_IMAGE,
            product.fotoAchter as PROD_IMAGEBACK,
            product.voorraad as PROD_SUPPLY
FROM        product
WHERE		product_id
LIKE		?";
$stmt = $pdo -> prepare( $sql );
$stmt -> execute([$prod_id]);
$producten = $stmt->fetchAll();

$sql = "
SELECT      categorie.categorie_id as CAT_ID,
            categorie.type as CAT_TYPE
FROM        categorie
WHERE		categorie_id
LIKE		?";
$stmt = $pdo -> prepare( $sql );
$stmt -> execute([$cat_id]);
$categorieen = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struggle Clothing</title>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<link href="<?php echo SITE_URL ?>/Style/navbarStyle.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL ?>/Style/footerStyle.css" rel="stylesheet" />
	<link href="<?php echo SITE_URL ?>/Style/specificStyle.css" rel="stylesheet" />
    <!-- Google Fonts ------- ( To add the fonts used. ) -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<!-- Icons -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script> 
	
	<!-- Hover img change -->
	<style>
    .grid-item-image {
        display: inline-block;
        position: relative;
    }
    .grid-item-image .img-back {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
    }
    .grid-item-image:hover .img-back {
        display: inline;
    }
    </style>
</head>
<body>
    
    <div class="smooth-scroll-wrapper">

	<?php require(SITE_DIR.'/Include/navbar.php'); ?>

    <div class="grid-container">
    <?php
    if(isset($_GET['prod_id']) && isset($_GET['cat_id'])){ 
		foreach ( $categorieen as $categorie ) {
		foreach ( $producten as $product ) { ?>
        <div class="grid-item-image">    
        	<img src='<?php echo SITE_URL ?>/Images/<?php echo $categorie->CAT_TYPE ?>/<?php echo $product->PROD_IMAGE ?>'>
        	<img class="img-back" src='<?php echo SITE_URL ?>/Images/<?php echo $categorie->CAT_TYPE ?>/<?php echo $product->PROD_IMAGEBACK ?>'>
    	</div>
    	<div class="grid-item-specs">
        	<h3 id="specific-name"><?php echo $product->PROD_NAME ?></h3>
        	<p id="price">EUR <?php echo $product->PROD_PRICE ?></p>

			<form method="GET" action="Cart/add.php">
				
				<input type="hidden" name="id" value="<?php echo $product->PROD_ID ?>">
				<input type="hidden" name="name" value="<?php echo $product->PROD_NAME ?>">
				<input type="hidden" name="price" value="<?php echo $product->PROD_PRICE ?>">
				<input type="hidden" name="color" value="<?php echo $product->PROD_COLOR ?>">
				<input type="hidden" name="image" value="<?php echo $product->PROD_IMAGE ?>">
				<input type="hidden" name="cat" value="<?php echo $categorie->CAT_TYPE ?>">
				<input type="hidden" name="cat_id" value="<?php echo $categorie->CAT_ID ?>">



				<input type="radio" name="size" id="input-radio-small" value="small" checked>
				<label for="input-radio-small" class="input-radio">Small</label>
				<br>

				<input type="radio" name="size" id="input-radio-medium" value="medium">
				<label for="input-radio-medium" class="input-radio">Medium</label>
				<br>

				<input type="radio" name="size" id="input-radio-large" value="large">
				<label for="input-radio-large" class="input-radio">Large</label>
				<br>
				
        		<input type="number" placeholder="1" min="1" step="1" value="1" class="input-amount" name="amount">
        		<div class="add-specific">
					<input type="submit" class="submit" value="Add to bag"></input>
       			</div>
			</form>
    	</div>
    <?php } } } ?>
	</div>

	<?php require(SITE_DIR.'/Include/footer.php'); ?>
    </div>
    


</body>
<?php } ?>
</html>