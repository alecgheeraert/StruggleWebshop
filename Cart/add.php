<?php 
require( '../config.php' );

$j = 0;

if( isset( $_GET['id'], $_GET['amount'], $_GET['price'], $_GET['name'], $_GET['size'], $_GET['color'], $_GET['image'], $_GET['cat'], $_GET['cat_id'])) {
    if ( empty( $_SESSION['CART'])) { 
        $_SESSION['CART'][0]['ID'] = $_GET['id'];
        $_SESSION['CART'][0]['AMOUNT'] = $_GET['amount'];
        $_SESSION['CART'][0]['PRICE'] = $_GET['price'];
        $_SESSION['CART'][0]['NAME'] = $_GET['name'];
        $_SESSION['CART'][0]['SIZE'] = $_GET['size'];
        $_SESSION['CART'][0]['COLOR'] = $_GET['color'];
        $_SESSION['CART'][0]['IMAGE'] = $_GET['image'];
        $_SESSION['CART'][0]['CAT'] = $_GET['cat'];
        $_SESSION['CART'][0]['CAT_ID'] = $_GET['cat_id'];

    } else {
        $winkelkar = $_SESSION['CART'];
        foreach($winkelkar as $i => $artikel) {
            if( $artikel['ID'] == $_GET['id'] && $artikel['SIZE'] == $_GET['size'])  {
                $_SESSION['CART'][$i]['AMOUNT'] += $_GET['amount'];
                break;
            } else {
                $j++;
            }
        }
        if ( $j == count($winkelkar)) {
            $_SESSION['CART'][count($winkelkar) + 1]['ID'] = $_GET['id'];
            $_SESSION['CART'][count($winkelkar) + 1]['AMOUNT'] = $_GET['amount'];
            $_SESSION['CART'][count($winkelkar) + 1]['PRICE'] = $_GET['price'];
            $_SESSION['CART'][count($winkelkar) + 1]['NAME'] = $_GET['name'];
            $_SESSION['CART'][count($winkelkar) + 1]['SIZE'] = $_GET['size'];
            $_SESSION['CART'][count($winkelkar) + 1]['COLOR'] = $_GET['color'];
            $_SESSION['CART'][count($winkelkar) + 1]['IMAGE'] = $_GET['image'];
            $_SESSION['CART'][count($winkelkar) + 1]['CAT'] = $_GET['cat'];
            $_SESSION['CART'][count($winkelkar) + 1]['CAT_ID'] = $_GET['cat_id'];
        }
    }
    
    header( 'location:'.SITE_URL.'/Cart/cart.php' );
} else if ( isset( $_GET['id'], $_GET['size']) && !isset( $_GET['amount'])) {
    $winkelkar = $_SESSION['CART'];
    foreach($winkelkar as $i => $artikel) {
        if( $artikel['ID'] == $_GET['id'] && $artikel['SIZE'] == $_GET['size'] )  {
            $_SESSION['CART'][$i]['AMOUNT']++;
        } 
    }
    header( 'location:'.SITE_URL.'/Cart/cart.php' );
} else {
    $_SESSION['ERROR'] = "The adding of your product has failed.";
    header( 'location:'.SITE_URL.'/Authentication/error.php' );
}