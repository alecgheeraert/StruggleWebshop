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

        $sql = "SELECT klant_id as CLIENT_ID, voornaam as FIRST_NAME, achternaam as LAST_NAME, adres as ADDRESS, stad as CITY, postcode as POSTAL_CODE, land as COUNTRY, email as EMAIL, admin as ADMIN, geverifieerd as VERIFIED
                FROM klant
                WHERE klant_id LIKE $id";
        $stmt = $pdo -> query( $sql );
        $clientsS = $stmt->fetchAll();   

    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Klanteninformatie</title>
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
        <h3>Alle klanteninformatie</h3>
        
    <table id="clientSpecificTabel">
        <thead>
            <tr>
                <th>Klant ID</th>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Adres</th>
                <th>Stad</th>
                <th>Postcode</th>
                <th>Land</th>
                <th>E-Mail</th>
                <th>Admin?</th>
                <th>Geverifieerd?</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>                                
            <?php foreach ($clientsS as $clientS) { ?>
                <tr>
                    <form action="../CRUD/update.php" method="POST">
                        <td><input type="hidden" name="CLIENT_ID" value="<?php echo $clientS->CLIENT_ID ?>"> <?php echo $clientS->CLIENT_ID ?> </td>
                        <td><input type="text" name="FIRST_NAME" value="<?php echo $clientS->FIRST_NAME ?>"></td>
                        <td><input type="text" name="LAST_NAME" value="<?php echo $clientS->LAST_NAME ?>"></td>
                        <td><input type="text" name="ADDRESS" value="<?php echo $clientS->ADDRESS ?>"></td>
                        <td><input type="text" name="CITY" value="<?php echo $clientS->CITY ?>"></td>
                        <td><input type="text" name="POSTAL_CODE" value="<?php echo $clientS->POSTAL_CODE ?>"></td>
                        <td><input type="text" name="COUNTRY" value="<?php echo $clientS->COUNTRY ?>"></td>
                        <td><input type="email" name="EMAIL" value="<?php echo $clientS->EMAIL ?>"></td>
                        <td><input type="text" name="ADMIN" value="<?php echo $clientS->ADMIN ?>"></td>
                        <td><input type="text" name="VERIFIED" value="<?php echo $clientS->VERIFIED ?>"></td>
                        <td><a href="<?php echo SITE_URL ?>/CRUD/delete.php?table=klant&id=<?php echo $clientS->CLIENT_ID ?>"><i class="fas fa-trash" style="color: #AD0D01;"></i></a></td>
                    </form>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script> 
    $(document).ready( function () {
        $('#clientSpecificTabel').DataTable();
    } );
</script>

</body>
</html>

<?php } ?>