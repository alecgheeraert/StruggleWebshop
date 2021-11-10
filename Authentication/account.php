<?php 
    require( '../config.php' );
    
    
        
        $email = $_SESSION['ACCOUNT'];
        
        $sql = "SELECT klant_id as CLIENT_ID, voornaam as FIRST_NAME, achternaam as LAST_NAME, adres as ADDRESS, stad as CITY, postcode as POSTAL_CODE, land as COUNTRY, email as EMAIL
                FROM klant
                WHERE email like ?";
        $stmt = $pdo -> prepare( $sql );
        $stmt ->execute([$email]);
        $clientsS = $stmt->fetchAll();   

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
        <h3>Account Info</h3>
        
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
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>                                
            <?php foreach ($clientsS as $clientS) { ?>
                <tr>
                <form action="update" method="POST">
                    <td><input type="hidden" name="" value="<?php echo $clientS->CLIENT_ID ?>"> <?php echo $clientS->CLIENT_ID ?> </td>
                    <td><input type="text" name="" value="<?php echo $clientS->FIRST_NAME ?>"></td>
                    <td><input type="text" name="" value="<?php echo $clientS->LAST_NAME ?>"></td>
                    <td><input type="text" name="" value="<?php echo $clientS->ADDRESS ?>"></td>
                    <td><input type="text" name="" value="<?php echo $clientS->CITY ?>"></td>
                    <td><input type="text" name="" value="<?php echo $clientS->POSTAL_CODE ?>"></td>
                    <td><input type="text" name="" value="<?php echo $clientS->COUNTRY ?>"></td>
                    <td><input type="email" name="" value="<?php echo $clientS->EMAIL ?>"></td>
                    <td><button type="submit" style="border:none; cursor:pointer; background:#0F0F0F"><i class="fas fa-wrench" style="color: #00AB46;"></i></button></td>
                    
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