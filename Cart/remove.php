<?php 
require( '../config.php' );

if( isset($_GET['id'], $_GET['size'])) {
    $winkelkar = $_SESSION['CART'];
        
    foreach($winkelkar as $i => $artikel) {
        if( $artikel['ID'] == $_GET['id'] && $artikel['SIZE'] == $_GET['size']) {
            $winkelkar[$i]['AMOUNT']--;
                
            if( $winkelkar[$i]['AMOUNT'] == 0 ) {
                unset($winkelkar[$i]);
            }
            break;
        }
    }
    $_SESSION['CART'] = $winkelkar;
}

header( 'location:'.SITE_URL.'/Cart/cart.php' );