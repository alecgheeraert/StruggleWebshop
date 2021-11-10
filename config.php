<?php

require('pillar.php');

// Location Files
define( 'SITE_DIR', str_replace( "\\", '/', pathinfo(__FILE__,PATHINFO_DIRNAME) ) );
define( 'SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/'.str_replace( $_SERVER['DOCUMENT_ROOT'], '', SITE_DIR ) );
define( 'ACTIVE_PAGE', pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_FILENAME) );

// Session
session_start();
if ( !isset( $_SESSION['LOGIN_OK'])) { $_SESSION['LOGIN_OK'] = false; }
if ( !isset( $_SESSION['ADMIN_OK'])) { $_SESSION['ADMIN_OK'] = false; }
if ( !isset( $_SESSION['CART'])) { $_SESSION['CART'] = array(); }
if ( !isset( $_SESSION['ERROR_REG'])) { $_SESSION['ERROR_REG'] = array(); }
if ( !isset( $_SESSION['ERROR_LOG'])) { $_SESSION['ERROR_LOG'] = false; }
if ( !isset( $_SESSION['ERROR'])) { $_SESSION['ERROR'] = array(); }
if ( !isset( $_SESSION['ACCOUNT'])) { $_SESSION['ACCOUNT'] = array(); }

try {
    $pdo = new PDO( DB_CONNECTION, DB_USERNAME, DB_PASSWORD );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo 'Error with connection to database.<br>'.$e->getMessage();
    die();
}

?>