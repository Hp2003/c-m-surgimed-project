<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	function add_product_to_cart(){
			if(isset($_SESSION['cart'])){
				$myitem=array_column($_SESSION['cart'],'Item_Name');
				if (in_array($_POST['Item_Name'],$myitem)){
					// echo "<script>
					// 	alert('Item Already Added...');
					// 	window.location.href='index1.php';
					// </script>";
					header('Content-Type: application/json');
					$res = array(
						'text' => 'alreadyAdded'
					);
					echo json_encode($res);
					return 0;
				}
				else{
					// print_r($_POST);
					$cnt=count($_SESSION['cart']);
					$_SESSION['cart'][$cnt]=array('Item_Name'=>$_POST['Item_Name'],'Item_Price'=>$_POST['Item_Price'],'Item_Image'=>$_POST['Item_Image'],'Item_Quantity'=>1 , 'ItemId' => $_POST['item_Id']);
					// echo "<script>
					// 	alert('Item Added...');
					// 	window.location.href='index1.php';
					// </script>";	
					header('Content-Type: application/json');
					$res = array(
						'text' => 'itemAdded'
					);
					echo json_encode($res);
					return 0;
				}
			}
			else{
				$_SESSION['cart'][0]=array('Item_Name'=>$_POST['Item_Name'],'Item_Price'=>$_POST['Item_Price'],'Item_Image'=>$_POST['Item_Image'],'Item_Quantity'=>1, $_POST['item_Id'],'Id'=>1);
					// echo "<script>
					// 	alert('Item Added...');
					// 	window.location.href='index1.php';
					// </script>";
					header('Content-Type: application/json');
					$res = array(
						'text' => 'itemAdded'
					);
					echo json_encode($res);
					return 0;
			}
	}
	function remove_pro_from_cart(){
		foreach($_SESSION['cart'] as $key => $value){
			if($value['Item_Name']==$_POST['Item_Name']){
				unset($_SESSION['cart'][$key]);
				$_SESSION['cart']=array_values($_SESSION['cart']);
				// echo "<script>
				// 	alert('Removed Item...');
				// 	window.location.href='cart.php';
				// </script>";		
				$res = array(
					'text' => 'removed'
				);
				header('Content-Type: application/json');
				echo json_encode($res);
				return;
			}
		}
	}
		

	function increase_qty(){
		foreach($_SESSION['cart'] as $key => $value){
			if($value['Item_Name']==$_POST['Item_Name']){
				$_SESSION['cart'][$key]['Item_Quantity']=$_POST['mod_qty'];
				//print_r($_SESSION['cart']);
				// echo "<script>
				// 	window.location.href='cart.php';
				// </script>";
				
			}
		}	
		header('Content-Type: application/json');
		$res = array(
			'text' => 'changed'
		);
		echo json_encode($res);
		return;
	}

	// if($_SERVER['REQUEST_METHOD']="POST"){
	// 	if(isset($_POST['detail'])){
	// 		header("location: details.php");
	// 	}
	// }
?>