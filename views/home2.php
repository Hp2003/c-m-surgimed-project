<?php
	include './src/common_function.php';
	// if(!$_SESSION['loginId']){
	// 	header('location: http://localhost/project/Admin%20panel/login.php');
	// }
?>

<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $IsAdmin = false ;
    if(isset($_SESSION['IsAdmin'])){
        if($_SESSION['IsAdmin'] == true){
            $IsAdmin = $_SESSION['IsAdmin'];
        }
    }
    if($IsAdmin == true){
        require_once('admin_views/admin_dashboard.php');
    }
    // require_once('admin_views/admin_dashboard.php');
?>
<div class="search-bar">
	<div class="container">
		<script type="text/javascript">
			function showButtons(){
				var buttons=document.getElementById('buttons').style='display: inline-flex';
			}
		</script>
		<form action="search_product.php" method="post" class="searchbar">
			<input type="search" placeholder="Search Product" name="search_data" id="search">
			<button name="search_data_product" id="buttons"><i class="fa-solid fa-magnifying-glass"></i></button>
		</form>
	</div>
</div>	
<div class="product">	
	<div class="container">
		<div class="wrapper">
			<div class="row">
		<?php
			get_product();
		?>
			</div>
		</div>
	</div>	
</div>

