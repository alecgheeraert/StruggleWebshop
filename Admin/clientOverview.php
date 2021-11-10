<?php 
    require( '../config.php' );

    if (!$_SESSION["ADMIN_OK"]) { 
        $url = SITE_DIR."/Error/adminDenied.php"; 
        header('Location: '.$url); 
        die(); 
    } else { 
    
    $sql = "SELECT klant_id as ID, voornaam as VOORNAAM, achternaam as ACHTERNAAM, email as EMAIL FROM klant";
    $stmt = $pdo -> query( $sql );
    $klanten = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Klanten</title>
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
        <h3>Alle klanten</h3>
        
            <table id="klantTabel">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>E-Mail</th>
                    </tr>
                </thead>
                <tbody>                                
                    <?php foreach ($klanten as $klant) { ?>
                            <tr>
                                <td><a href="clientSpecificOverview.php?id=<?php echo $klant->ID ?>"><?php echo $klant->ID ?></a></td>
                                <td><a href="clientSpecificOverview.php?id=<?php echo $klant->ID ?>"><?php echo $klant->VOORNAAM ?></a></td>
                                <td><a href="clientSpecificOverview.php?id=<?php echo $klant->ID ?>"><?php echo $klant->ACHTERNAAM ?></a></td>
                                <td><a href="clientSpecificOverview.php?id=<?php echo $klant->ID ?>"><?php echo $klant->EMAIL ?></a></td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
    </div>

    <script> 
    $(document).ready( function () {
        $('#klantTabel').DataTable();
    } );
</script>

</body>

</html>

<?php } ?>