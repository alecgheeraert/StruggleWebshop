<?php 
require ( '../config.php' );

$total = 0;
$cat;
$img;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struggle Clothing</title>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
	<link href="<?php echo SITE_URL ?>/Cart/cartStyle.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL ?>/Style/navbarStyle.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL ?>/Style/footerStyle.css" rel="stylesheet" />

<!-- Fonts --><link href="https://fonts.googleapis.com/css?family=Roboto+Mono:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
<!-- Icons --><script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script> 

</head>
<body>

<?php require(SITE_DIR.'/Include/navbar.php'); ?>

<div class="grid-container">

    <?php if( empty($_SESSION['CART'])) { ?>
    <div class="grid-item-ecart">
        <h3>Cart is empty.</h3><br>
        <a class="" href="<?php echo SITE_URL ?>/index.php">-> Home <-</a>
    </div>
    <?php die(); } ?>

    <div class="grid-item-head"><h4>Cart</h4></div>

    <div class="grid-item-loop">
    <?php foreach ( $_SESSION['CART'] as $product ) { ?>
        <?php $cat = $product['CAT']; ?>
        <?php $img = $product['IMAGE']; ?>
        
        <div class="spec-grid-container">
            <div class="image">
                <a class="a" href="<?php echo SITE_URL ?>/specific.php?cat_id=<?php echo $product['CAT_ID'] ?>&prod_id=<?php echo $product['ID'];  ?>">
                    <img src="<?php echo SITE_URL ?>/Images/<?php echo $product['CAT'] ?>/<?php echo $product['IMAGE'] ?>">
                </a>
            </div>
            <div class="name"><?php echo $product['NAME'];  ?></div>
            <div class="size">Size: <?php echo $product['SIZE']  ?></div>
            <div class="amount">Amount: <?php echo $product['AMOUNT'];?></div>
            <div class="color">Color: <?php echo $product['COLOR']; ?></div>


            <div class="add">
                <a role="button" href="<?php echo SITE_URL ?>/Cart/add.php?id=<?php echo $product['ID'] ?>&size=<?php echo $product['SIZE'] ?>">+</a>
            </div>
            <div class="remove">
                <a role="button" href="<?php echo SITE_URL ?>/Cart/remove.php?id=<?php echo $product['ID'] ?>&size=<?php echo $product['SIZE'] ?>">-</a> 
            </div>
            <div class="empty">
                <a class="emptybtn" role="button" href="<?php echo SITE_URL ?>/Cart/empty.php?id=<?php echo $product['ID'] ?>&size=<?php echo $product['SIZE'] ?>">Remove product</a>
            </div>

            <div class="total">Price: € <?php echo sprintf("%.2f", $product['PRICE'] * $product['AMOUNT']); ?></div>
            <?php $total += $product['PRICE'] * $product['AMOUNT']; ?>

        </div>
    <?php } ?>
    </div>

    <div class="grid-item-tcart">Total: <?php echo sprintf("%.2f", $total); ?></div>

    <div class="grid-item-order">
        <a class="" href="<?php echo SITE_URL ?>/Cart/order.php">Order</a>
    </div>

</div>
</body>
</html>