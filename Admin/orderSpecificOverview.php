<?php 
    require( '../config.php' );
    
    if (!$_SESSION["ADMIN_OK"]) { 
        $url = SITE_DIR."/Error/adminDenied.php"; 
        header('Location: '.$url); 
        die(); 
    } else { 

    if (!empty($_GET))
    {

        $id = $_GET["id"];

        $sql = "SELECT bestelling_id as ORDER_ID, product_id as PRODUCT_ID, aantalProducten as AMOUNT_PRODUCT
                FROM productperbestelling
                WHERE bestelling_id LIKE $id";
        $stmt = $pdo -> query( $sql );
        $ordersS = $stmt->fetchAll();   

    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bestellingsinformatie</title>
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
    <h3>Alle bestellingsinformatie</h3>
    
        <table id="orderSpecificTabel">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Aantal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>                                
                <?php foreach ($ordersS as $orderS) { ?>
                    <tr>
                        <td><?php echo $orderS->PRODUCT_ID ?></td>
                        <td><?php echo $orderS->AMOUNT_PRODUCT ?></td>
                        <td><a href="<?php echo SITE_URL ?>/CRUD/delete.php?table=productperbestelling&id=<?php echo $orderS->ORDER_ID ?>&prod_id=<?php echo $orderS->PRODUCT_ID ?>"><i class="fas fa-trash" style="color: #AD0D01;"></i></a></td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</div>

<script> 
    $(document).ready( function () {
        $('#orderSpecificTabel').DataTable();
    } );
</script>

</body>
</html>

<?php } ?>