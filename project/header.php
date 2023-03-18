<?php
	    if(session_status() !== PHP_SESSION_ACTIVE){
			session_start();
		}
?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
		<div class="container-fluid">
			<a href="index1.php" class="navbar-brand">Logo</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item p-2"><a href="index1.php" class="nav-link">Home</a></li>
					<li class="nav-item p-2"><a href="display_all_product.php" class="nav-link">Product</a></li>
					<li class="nav-item p-2"><a href="#" class="nav-link">Service</a></li>
					<li class="nav-item p-2"><a href="#" class="nav-link">Contact</a></li>
					<li class="nav-item p-2"><a href="#" class="nav-link">Login</a></li>
				</ul> 
	<script type="text/javascript">
		function showButtons(){
			var buttons=document.getElementById('buttons').style='display: inline-flex';
		}
		// function hideButtons(){
		// 	var buttons=document.getElementById('buttons').style='display: none';	
		// }
	</script>
				<form class="d-flex p-2" action="search_product.php" method="post">
					<table>
					<tr>
						<td>
							<input type="search" placeholder="Search" name="search_data" id="search" class="form-control me-2">
						</td>
						<td>	
							<button class="btn btn-primary" name="search_data_product">Search</button>
						</td>
					</tr>
					<!-- <tr>	
						<td>
							<div id="buttons" style="margin-top: 10px; display: none;">
								<button class="button-value">All</button>
								<button class="button-value">Top</button>
								<button class="button-value">Stool</button>
								<button class="button-value">Chair</button>
							</div>
						</td>
					</tr> -->
					</table>
				</form>
			</div>
			<?php
				$cnt=0;
				if(isset($_SESSION['cart'])){
					$cnt=count($_SESSION['cart']);
				}
			?>
			<div class="d-flex">
				<a href="cart.php">
					<button class="btn btn-outline-success">Cart(<?php echo $cnt; ?>)</button>
				</a>
			</div>
		</div>
	</nav>
</body>
</html>
