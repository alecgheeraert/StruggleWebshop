<?php

require('../config.php');

$errorInput;

if ( $_SESSION['LOGIN_OK'] ) {

    if ( !empty($_SESSION['CART']) ) {

            $email = $_SESSION['ACCOUNT'];

            $sql = "
                SELECT      klant_id as ID
                FROM        klant
                WHERE		email
                LIKE		?";
            $stmt = $pdo -> prepare( $sql );
            $stmt -> execute([ $email ]);
            $klant = $stmt->fetch();


            $sql = "
                INSERT INTO bestelling (klant_id) 
                VALUES(:klant_id)";
            $stmt = $pdo -> prepare( $sql );
            $stmt -> execute([ 'klant_id' => $klant->ID ]);
            $id = $pdo -> lastInsertId();

        foreach( $_SESSION['CART'] as $cart ) {

            $sql = "
                INSERT INTO productperbestelling (bestelling_id, product_id, aantalProducten) 
                VALUES(:bestelling_id, :product_id, :aantalProducten)";
            $stmt = $pdo->prepare($sql);
            $stmt -> execute([  'bestelling_id' => $id,
                                'product_id' => $cart['ID'],
                                'aantalProducten' => $cart['AMOUNT'] ]);

            
           
        } 
        
        $_SESSION['CART'] = array();
        
        header('location:'.SITE_URL.'/index.php');
    } else {
        header('location:'.SITE_URL.'/Cart/cart.php');
    }
} else {
    $errorInput[] = "You must be logged in to continue.";
    foreach ( $errorInput as $error ) { error_log( $error ); }
    $_SESSION['ERROR_LOG'] = $errorInput;
    header('location:../Authentication/loginForm.php');
}