<?php
 require( '../config.php' );

    if (!empty($_POST))
    {

        $id = $_POST["ID"];
        $prodName = $_POST["NAME"];
        $prodPrice = $_POST["PRICE"];
        $prodColor = $_POST["COLOR"];

        $sql = "UPDATE product SET productnaam = :productnaam, prijs = :prijs, kleur = :kleur WHERE product_id = :id";

        $stmt=$pdo->prepare($sql);
        $stmt->execute(['productnaam' => $prodName, 'prijs' => $prodPrice, 'kleur' => $prodColor, 'id' => $id]);

        header("refresh:1, Location: ".SITE_DIR."/productsOverview.php");

    }

?>