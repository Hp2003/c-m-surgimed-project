<?php
require_once('home_page_data.php');
require_once('connection.php');
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
	//get products
	function get_product(){
		if(!isset($_POST['category'])){
			if(!isset($_POST['brand'])){
				$con=mysqli_connect('localhost','root','panchal4555','C_M_surgimed');
				$sql="SELECT * FROM product ORDER BY rand() LIMIT 12";
				$res=mysqli_query($con,$sql);

				$img = array();

				$count = 0;
				while($row=mysqli_fetch_assoc($res)){
					// getting images form folder
					$imagesReal = 
					$status=$row['ProductStatus'];
					if($status == 'Available'){
						array_push($img, $row['ProductImg']);
						$imagesReal = get_product_images($img);
					}


					$p_id=$row['ProductId'];
					$p_name=$row['ProductTitle'];
					$p_desc=$row['ProductDesc'];
					// $p_image=$row['ProductImg'];
					$p_price=$row['ProductPrice'];
					$c_id=$row['CateGoryId'];
					// $images = get_product_images($p_image);
					// $b_id=$row['brand_id'];
					if($status == 'Available'){
						echo "
						<div class='col-md-4 mb-2 cards' style='height:431px;'>
							<form action='manage_cart.php' method='post' class='cartForm'>
								<div class='card'>
									<img src='../{$row['ProductImg']}/$imagesReal[0]' class='card-img-top banner-img' style='height : 220px;'>
									<div class='card-body'>
										<p class='card-title text-white' style='font-size:1em'>$p_name</p>
										<p class='card-text'>Rs $p_price</p>
										";
										// if(isset($_SESSION['IsAdmin'])){
											if (!empty($_SESSION['IsAdmin'])){
												echo "<a href='details.php?product_id=]'><input type='submit' name='detail' value='Delete' class='button outline deleteProBtn'></a>
													  <input type='submit' name='' value='Edit' class='button fill editProduct'>";
											}
										 else{
											echo "<a onclick='get_details(event, this, $count)'><input type='submit' name='detail' value='Detail' class='button outline'></a>
												  <input type='button' name='addtocart' value='Buy Now' class='button fill addToCart' onClick='addToCart(event, this, $count )'>";}
											$count += 1;
										echo "
										
										<input type='hidden' name='Item_Name' value='$p_name'>
										<input type='hidden' name='Item_Price' value='$p_price'>
										<input type='hidden' name='item_Id' value='$p_id' class='Item_id'>
									</div>
								</div>
							</form>
						</div>	
					";
					}
					
					array_pop($img);
				}
			}
		}		
	}	
	//All Products are get
	function get_all_products(){
		if(!isset($_POST['category'])){
			if(!isset($_POST['brand'])){
				$con=mysqli_connect('localhost','root','','c.m.surgimed');
				$sql="SELECT * FROM products ORDER BY rand()";
				$res=mysqli_query($con,$sql);
				while($row=mysqli_fetch_assoc($res)){
					$p_id=$row['product_id'];
					$p_name=$row['product_name'];
					$p_desc=$row['product_description'];
					$p_image=$row['product_image1'];
					$p_price=$row['product_price'];
					$c_id=$row['category_id'];
					$b_id=$row['brand_id'];
					// $b_id=$row['Status'];
					echo "
						<div class='col-md-4 mb-2'>
							<div class='card'>
								<img src='../Admin panel/product_images/$p_image' class='card-img-top' id='banner-img'>
								<div class='card-body'>
									<h5 class='card-title'>$p_name</h5>
									<p class='card-text'>$p_desc</p>
									<input type='submit' name='detail' value='Detail' class='button outline'>
									<input type='submit' name='addtocart' value='Buy Now' class='button fill'>
								</div>
							</div>
						</div>
					";
				}
			}
		}
	}
function search_product(){

		$con= connect_to_db();
		$search_data_value=$_POST['search_data'];

		if((preg_match('/^#!:\d+$/', $search_data_value))){
		if(isset($_SESSION['IsAdmin'])){
			if($_SESSION['IsAdmin'] == true){
				if( preg_match('/^#!:\d+$/', $search_data_value)){
					$sql = $con->prepare("SELECT * FROM product WHERE ProductId =  ? LIMIT 1");
	
					$id = str_replace( '#!:', '',$search_data_value );
					$sql->bind_param('s', $id);
	
					$sql->execute();
					$result = $sql->get_result();
					$con->close();
					$sql->close();
					$data = mysqli_fetch_assoc($result);
	
					return $data;
				}
			}
		}
	}
			$input = '%'.$search_data_value.'%';
			$offset = $_POST['offset_search'];
			// $search_query="SELECT * FROM product WHERE ProductKeywords LIKE '%$search_data_value% ' LIMIT 12";
			$search_query= $con->prepare("SELECT * FROM product WHERE ProductKeywords  LIKE ?  AND ProductStatus = 'Available' LIMIT 16 OFFSET  ? ;");
			
			$search_query->bind_param('ss',$input , $offset);
			
			$search_query->execute();
			$res = $search_query->get_result();
			
			// $res=mysqli_query($con,$search_query);
			$num_of_rows=mysqli_num_rows($res);
			$data = array();

			$con->close();
			$search_query->close();
		if($num_of_rows==0){
			return 0;
		}
		while($row = mysqli_fetch_assoc($res)){
			array_push($data, $row);
		}
		
		return $data;
		
		
	}	
	// 
	// function get_unique_categories(){
	// 	if(isset($_POST['category'])){
	// 		$c_id=$_POST['category']
	// 		$category_query="SELECT * FROM products WHERE category_id='$c_id";
	// 		$res=mysqli_query($con,$category_query);
	// 		$num_of_rows=mysqli_num_rows($res);
	// 		if($num_of_rows==0){
	// 			echo "<h2 class='text-center text-danger'>No stock for this Category</h2>";
	// 		}
	// 		while($row=mysqli_fetch_assoc($res)){
	// 			$p_id=$row['product_id'];
	// 			$p_name=$row['product_name'];
	// 			$p_desc=$row['product_description'];
	// 			$p_image=$row['product_image1'];
	// 			$p_price=$row['product_price'];
	// 			$c_id=$row['category_id'];
	// 			$b_id=$row['brand_id'];
	// 			echo "
	// 				<div class='col-md-4 mb-2'>
	// 					<div class='card'>
	// 						<img src='../Admin panel/product_images/$p_image' class='card-img-top' id='banner-img'>
	// 						<div class='card-body'>
	// 							<h5 class='card-title'>$p_name</h5>
	// 							<p class='card-text'>$p_desc</p>
	// 							<input type='submit' name='detail' value='Detail' class='button outline'>
	// 							<input type='submit' name='addtocart' value='Buy Now' class='button fill'>
	// 						</div>
	// 					</div>
	// 				</div>
	// 			";
	// 		}
	// 	}
	// }

	// // brands
	// function get_unique_brands(){
	// 	if(isset($_POST['brand'])){
	// 		$b_id=$_POST['brand']
	// 		$brand_query="SELECT * FROM products WHERE brand_id='$b_id";
	// 		$res=mysqli_query($con,$brand_query);
	// 		$num_of_rows=mysqli_num_rows($res);
	// 		if($num_of_rows==0){
	// 			echo "<h2 class='text-center text-danger'>This brand is not available for service</h2>";
	// 		}
	// 		while($row=mysqli_fetch_assoc($res)){
	// 			$p_id=$row['product_id'];
	// 			$p_name=$row['product_name'];
	// 			$p_desc=$row['product_description'];
	// 			$p_image=$row['product_image1'];
	// 			$p_price=$row['product_price'];
	// 			$c_id=$row['category_id'];
	// 			$b_id=$row['brand_id'];
	// 			echo "
	// 				<div class='col-md-4 mb-2'>
	// 					<div class='card'>
	// 						<img src='../Admin panel/product_images/$p_image' class='card-img-top' id='banner-img'>
	// 						<div class='card-body'>
	// 							<h5 class='card-title'>$p_name</h5>
	// 							<p class='card-text'>$p_desc</p>
	// 							<input type='submit' name='detail' value='Detail' class='button outline'>
	// 							<input type='submit' name='addtocart' value='Buy Now' class='button fill'>
	// 						</div>
	// 					</div>
	// 				</div>
	// 			";
	// 		}
	// 	}
	// }
	//Searching products function
	// function search_product(){
	// 	$con=mysqli_connect('localhost','root','','c.m.surgimed');
	// 	if(isset($_POST['search_data_product'])){
	// 		$search_data_value=$_POST['search_data'];
	// 		$search_query="SELECT * FROM products WHERE product_keywords LIKE '%$search_data_value%' LIMIT 10";
	// 		$res=mysqli_query($con,$search_query);
	//  		$num_of_rows=mysqli_num_rows($res);
	// 		if($num_of_rows==0){
	//  			echo "<h2 class='text-center text-danger'>This brand is not available for service</h2>";
	//  		}
	// 		while($row=mysqli_fetch_assoc($res)){
	// 			$p_id=$row['product_id'];
	// 			$p_name=$row['product_name'];
	// 			$p_desc=$row['product_description'];
	// 			$p_image=$row['product_image1'];
	// 			$p_price=$row['product_price'];
	// 			$c_id=$row['category_id'];
	// 			$b_id=$row['brand_id'];
	// 			echo "
	// 				<form action='manage_cart.php' method='post'>
	// 					<div class='col-md-4 mb-2'>
	// 						<div class='card'>
	// 							<img src='../Admin panel/product_images/$p_image' class='card-img-top' id='banner-img'>
	// 							<div class='card-body'>
	// 								<h5 class='card-title'>$p_name</h5>
	// 								<p class='card-text'>$p_desc</p>
	// 								<input type='submit' name='detail' value='Detail' class='button outline'>
	// 								<input type='submit' name='addtocart' value='Buy Now' class='button fill'>
	// 								<input type='hidden' name='Item_Name' value='$p_name'>
	// 								<input type='hidden' name='Item_Price' value='$p_price'>
	// 							</div>
	// 						</div>
	// 					</div>
	// 				</form>	
	// 			";
	// 		}
	// 	}	
	// }
	//Details of products
	function details_of_product(){
		if(isset($_POST['id'])){
			if(!isset($_POST['category'])){
				if(!isset($_POST['brand'])){
					$product_id=$_POST['product_id'];
					$con=mysqli_connect('localhost','root','','c.m.surgimed');
					$sql="SELECT * FROM products WHERE product_id='$product_id'";
					$res=mysqli_query($con,$sql);
					while($row=mysqli_fetch_assoc($res)){
						$p_id=$row['product_id'];
						$p_name=$row['product_name'];
						$p_desc=$row['product_description'];
						$p_image1=$row['product_image1'];
						$p_image2=$row['product_image2'];
						$p_image3=$row['product_image3'];
						$p_price=$row['product_price'];
						$c_id=$row['category_id'];
						$b_id=$row['brand_id'];
						echo "
							<div class='col-md-12 mb-2'>
								<div class='card'>
									<img src='../Admin panel/product_images/$p_image1' class='card-img-top' id='banner-img'>
									<div class='card-body'>
										<h5 class='card-title'></h5>
										<p class='card-text'>$p_desc</p>
										<input type='submit' name='detail' value='Buy Now' class='button outline'>
										<input type='submit' name='addtocart' value='Add to Cart' class='button fill'>
									</div>
								</div>
							</div>
						";
						
					}
				}
			}	
		}
	}
?>