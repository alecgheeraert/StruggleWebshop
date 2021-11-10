<?php 
require ( 'config.php' );

$limit = 3;

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
ORDER BY    product.voorraad
LIMIT       ?";
//$stmt = $pdo -> query( $sql );
$stmt = $pdo -> prepare( $sql );
$stmt -> execute([$limit]);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struggle Clothing</title>

    <link href="<?php echo SITE_URL ?>/Style/indexStyle.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL ?>/Style/navbarStyle.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL ?>/Style/footerStyle.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Google Fonts ------- ( To add the fonts used. ) -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<!-- Icons -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script> 
	
	<!-- Hover img change -->
	<style>
    .image {
        display: inline-block;
        position: relative;
    }
    .image .img-back {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
    }
    .image:hover .img-back {
        display: inline;
    }
    </style>
</head>
<body>
    
    <div class="smooth-scroll-wrapper">
    
    <?php require(SITE_DIR.'/Include/navbar.php'); ?>

    <div class="grid-container">
        <div class="grid-item-type">
            <h1 class="typewriter">The STRUGGLE is real.</h1>
        </div>
        <div class="grid-item-most">
            <p class="most">These are our most sold products.</p>
        </div>
        <div class="grid-item-prod">
            <div class="grid-container-loop">
                <?php 
                foreach ( $categorieen as $categorie ) {
                foreach ( $producten as $product ) {   
                if ( $product->PROD_CAT == $categorie->CAT_ID ) { 
                ?>
                <div class="spec-grid-container">
                    <div class="price">EUR <?php echo  $product->PROD_PRICE ?></div>
                    <a class="image" href="specific.php?cat_id=<?php echo $categorie->CAT_ID ?>&prod_id=<?php echo $product->PROD_ID; ?>">
                        <img src="<?php echo SITE_URL ?>/Images/<?php echo $categorie->CAT_TYPE ?>/<?php echo  $product->PROD_IMAGE ?>" alt="">
                        <img class="img-back" src="<?php echo SITE_URL ?>/Images/<?php echo $categorie->CAT_TYPE ?>/<?php echo  $product->PROD_IMAGEBACK ?>" alt="">
                    </a>
                    <div class="name"><?php echo  $product->PROD_NAME ?></div>
                </div>
                <?php } } } ?>
            </div>
        </div>
        <div class="grid-item-learn">
            <div class="learn-grid-container">
                <div class="learn-item-p">
                    <p>This website is made by Lars Ostyn, Ares Popal and Alec Gheeraert from 6th grade informatics. All footage is owned by Milan Vermeersch.</p>
                </div>
            </div>
        </div>
    </div>
    
    <?php require(SITE_DIR.'/Include/footer.php'); ?>
    
    </div>
    


</body>
</html>