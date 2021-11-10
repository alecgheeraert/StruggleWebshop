<html>
<script>
    	function openSlideMenu() {
        	document.getElementById('slideMenu').style.width = '250px';
    	}
    	function closeSlideMenu() {
        	document.getElementById('slideMenu').style.width = '0';
    	}
    	
    	
</script>

<div id="contentNavigation">

    	<!-- ------- Start Navigation Bar ------- -->
    	<!-- Large Size Screens -->
    	<div id="standardNavigation">

        	<span id="brand">
            	<a href="<?php echo SITE_URL ?>/index.php">struggle clothing</a>
        	</span>

        	<div id="standardMenu">
            	<a href="<?php echo SITE_URL ?>/index.php">home</a>
            	<a href="<?php echo SITE_URL ?>/products.php">products</a>
            	<a href="<?php echo SITE_URL ?>/Cart/cart.php">cart</a>
				<?php if ( $_SESSION['LOGIN_OK'] ) { 
					if ( $_SESSION['ADMIN_OK'] ) { ?>
						<div class="adminDropdown">
							<div class="adminPages">
								<a href="<?php echo SITE_URL ?>/Admin/clientOverview.php">clients</a>
								<a href="<?php echo SITE_URL ?>/Admin/ordersOverview.php">orders</a>
								<a href="<?php echo SITE_URL ?>/Admin/productsOverview.php">products</a>
							</div>
						</div>
					<?php } ?>
					<a href="<?php echo SITE_URL ?>/Authentication/account.php">profile</a>
					<a href="<?php echo SITE_URL ?>/Authentication/logout.php">logout</a>
				<?php } else { ?>
            		<a href="<?php echo SITE_URL ?>/Authentication/loginForm.php">login</a>
				<?php } ?>
        	</div>
    	</div>

    	<!-- Small Size Screens -->
    	<div id="resizeNavigation">
        
        	<span class="openSlide">
            	<a href="#" onclick="openSlideMenu()">
                		<i class="fas fa-bars"></i>
            	</a>
        	</span>

        	<div id="slideMenu" class="slideNavigation">
            	<a href="#" class="closeSlide" onclick="closeSlideMenu()">
                		<i class="fas fa-times"></i>
            	</a>
            	<a href="<?php echo SITE_URL ?>/index.php">Home</a>
            	<a href="<?php echo SITE_URL ?>/products.php">Products</a>
            	<a href="<?php echo SITE_URL ?>/Cart/cart.php">Cart</a>
            	<?php if ( $_SESSION['LOGIN_OK'] ) { ?>
					<a href="<?php echo SITE_URL ?>/Authentication/account.php">profile</a>
					<a href="<?php echo SITE_URL ?>/Authentication/logout.php">logout</a>
				<?php } else { ?>
            		<a href="<?php echo SITE_URL ?>/Authentication/loginForm.php">login</a>
				<?php } ?>
        	</div>
    	</div>
    	<!-- ------- End Navigation Bar ------- -->
</div>

<script>

    $(document).ready(function() {
        $('#standardMenu p').click(function() {
            if ($pages.is(':hidden')) {
                var $lefty = $(this).next('.adminDropdown');
                $lefty.animate({ 
                    left: parseInt($lefty.css('left'),10) == 0 ? -$lefty.outerWidth() : 0 }); 
            } else {
                var $right = $(this).next('.adminPages');
                $right.animate({ 
                    right: parseInt($right.css('right'),10) == 0 ? -$right.outerWidth() : 0 }); 
            }
        }); 
        
    });

</script>

</html>