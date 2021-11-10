<?php 
    require( '../config.php' );
    
    if (!$_SESSION["ADMIN_OK"]) { 
        $url = SITE_DIR."/Error/adminDenied.php"; 
        header('Location: '.$url); 
        die(); 
    } else { 

    $sql = "SELECT bestelling_id as ORDER_ID, klant_id as CLIENT_ID, datumVanBestelling as DATE_ORDER FROM bestelling";
    $stmt = $pdo -> query( $sql );
    $orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bestellingen</title>
    <meta name="viewport" >

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>        

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
    <h3>Alle bestellingen</h3>
    
    <table id="orderTabel">
        <thead>
            <tr>
                <th>Bestellings ID</th>
                <th>Klant ID</th>
                <th>Bestellingsdatum</th>
                <th></th>
            </tr>
        </thead>
        <tbody>                                
            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><a href="orderSpecificOverview.php?id=<?php echo $order->ORDER_ID ?>"><?php echo $order->ORDER_ID ?></a></td>
                    <td><a href="clientSpecificOverview.php?id=<?php echo $order->CLIENT_ID ?>"><?php echo $order->CLIENT_ID ?></a></td>
                    <td><a href="orderSpecificOverview.php?id=<?php echo $order->ORDER_ID ?>"><?php echo $order->DATE_ORDER ?></a></td>
                    <td><a href="<?php echo SITE_URL ?>/CRUD/delete.php?table=bestelling&id=<?php echo $order->ORDER_ID ?>"><i class="fas fa-trash" style="color: #AD0D01;"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script> 
    $(document).ready( function () {
        $('#orderTabel').DataTable();
    } );
</script>

</body>
</html>

<?php } ?>