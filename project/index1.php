<?php
	// include './Admin panel/connection.php';
	include "header.php";
	include 'common_function.php';
	// if(!$_SESSION['loginId']){
	// 	header('location: http://localhost/project/Admin%20panel/login.php');
	// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<!-- <link rel="stylesheet" type="text/css" href="../css/boostrape.min.css"> -->
</head>
<body>
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
<?php
	include 'footer.php';
?>
</body>
</html>