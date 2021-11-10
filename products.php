<?php 
require ( 'config.php' );


$sql = "
SELECT      product.product_id as PROD_ID,
            product.categorie_id as PROD_CAT,
            product.productnaam as PROD_NAME,
            product.prijs as PROD_PRICE,
            product.kleur as PROD_COLOR,
            product.foto as PROD_IMAGE,
            product.fotoAchter as PROD_IMAGEBACK,
            product.voorraad as PROD_SUPPLY
FROM        product";
$stmt = $pdo -> query( $sql );
$producten = $stmt->fetchAll();

$sql = "
SELECT      categorie.categorie_id as CAT_ID,
            categorie.type as CAT_TYPE
FROM        categorie";
$stmt = $pdo -> query( $sql );
$categorieen = $stmt->fetchAll();
?>


<html>
<head>
	<meta charset="utf-8" />
    <title>Struggle Clothing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>

    <link href="<?php echo SITE_URL ?>/Style/productStyle.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL ?>/Style/navbarStyle.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL ?>/Style/footerStyle.css" rel="stylesheet" />

    <!-- Google Fonts ------- ( To add the fonts used. ) -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<!-- Icons -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script> 
	
	<!-- Hover img change -->
	<style>
    .a {
        display: inline-block;
        position: relative;
    }
    .a .img-back {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
    }
    .a:hover .img-back {
        display: inline;
    }
    </style>
</head>
<body>

    <?php require(SITE_DIR.'/Include/navbar.php'); ?>
    
    <div class="smooth-scroll-wrapper">

    <div class="grid-container">
        <div class="grid-item-prod">
            <?php
                foreach ( $categorieen as $categorie ) {
            ?>
            <div class="grid-container-cat"><?php echo $categorie->CAT_TYPE ?></div>     
            <div class="grid-container-loop">
                <?php foreach ( $producten as $product ) { ?>
                    <?php if ( $product->PROD_CAT == $categorie->CAT_ID ) { ?>
                        <div class="spec-grid-container">
                            <p class="price">EUR <?php echo  $product->PROD_PRICE ?></p>
                            <a class="a" href="specific.php?cat_id=<?php echo $categorie->CAT_ID ?>&prod_id=<?php echo $product->PROD_ID; ?>">
                                <img id="image" src="<?php echo SITE_URL ?>/Images/<?php echo $categorie->CAT_TYPE ?>/<?php echo  $product->PROD_IMAGE ?>" >
                                    <img class="img-back" id="image" src="<?php echo SITE_URL ?>/Images/<?php echo $categorie->CAT_TYPE ?>/<?php echo  $product->PROD_IMAGEBACK ?>" >
                            </a>
                            <p class="name"><?php echo  $product->PROD_NAME ?></p>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php require(SITE_DIR.'/Include/footer.php'); ?>
    
    </div>
    


</body>
</html>