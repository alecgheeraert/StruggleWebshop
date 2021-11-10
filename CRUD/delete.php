<?php 

    require("../config.php");

    if (!empty($_GET))
    {

        $tablename = $_GET["table"];
        $id = $_GET["id"];

        if ($tablename == "klant")
        {

            $sql = "DELETE FROM klant WHERE klant_id = $id";

            $pdo->exec($sql);

            header('location:'.SITE_URL.'/Admin/clientOverview.php');

        }
        else if ($tablename == "bestelling")
        {

            $sql = "DELETE FROM bestelling WHERE bestelling_id = $id";

            $pdo->exec($sql);

            header('location:'.SITE_URL.'/Admin/orderOverview.php');

        }
        else if ($tablename == "productperbestelling")
        {

            $prod_ID = $_GET["prod_id"];

            $sql = "DELETE FROM productperbestelling WHERE bestelling_id = $id AND product_id = $prod_ID";

            $pdo->exec($sql);

            header('location:'.SITE_URL.'/Admin/orderSpecificOverview.php?id='.$id);

        }
        else if ($tablename == "product")
        {

            $sql = "DELETE FROM product WHERE product_id = $id";

            $pdo->exec($sql);

            header('location:'.SITE_URL.'/Admin/productOverview.php');

        }
        else
        {
            echo "Tabel bestaat niet";
        }

    }

?>