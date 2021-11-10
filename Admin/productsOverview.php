<?php 
    require( '../config.php' );
    
    if (!$_SESSION["ADMIN_OK"]) { 
        $url = SITE_DIR."/Error/adminDenied.php"; 
        header('Location: '.$url); 
        die(); 
    } else { 

    $sql = "SELECT product_id as ID, productnaam as NAME, prijs as PRICE, kleur as COLOR FROM product";
    $stmt = $pdo -> query( $sql );
    $producten = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Producten</title>
        <meta name="viewport" >

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>       
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script> 

        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="<?php echo SITE_URL ?>/Style/adminStyle.css" rel="stylesheet" />
        <link href="<?php echo SITE_URL ?>/Style/tableStyle.css" rel="stylesheet" />
        <link href="<?php echo SITE_URL ?>/Style/tableStyle.scss" rel="stylesheet" />
        <link href="<?php echo SITE_URL ?>/Style/navbarStyle.css" rel="stylesheet" />
        
        <!-- Google Fonts ------- ( To add the fonts used. ) -->
	    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	    <!-- Icons -->
	    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script> 
  </head>
  <body>
      
    <?php require( SITE_DIR.'/Include/navbar.php' ); ?>

    <div class="container">
        <h3>Alle producten</h3>
        
        <table id="productTabel">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Naam</th>
                    <th>Prijs</th>
                    <th>Kleur</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>                                
                <?php foreach ($producten as $product) { ?>
                        <tr>
                            <form action=".../CRUD/update.php" method="POST">
                                <td><input type="text" name="PROD_ID" value="<?php echo $product->ID ?>"></td>
                                <td><input type="text" name="NAME" value="<?php echo $product->NAME ?>"></td>
                                <td><input type="text" name="PRICE" value="<?php echo $product->PRICE ?>"></td>
                                <td><input type="text" name="COLOR" value="<?php echo $product->COLOR ?>"></td>
                                <td><a href="<?php echo SITE_URL ?>/CRUD/delete.php?table=product&id=<?php echo $product->ID ?>"><i class="fas fa-trash" style="color: #AD0D01;"></i></a></td>
                            </form>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<script> 
    $(document).ready( function () {
        $('#productTabel').DataTable();
    } );
</script>
</html>

<?php } ?>