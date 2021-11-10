<?php 
    require( '../config.php' );

    session_destroy();
    session_start();

    header('location:'.SITE_URL);
?>