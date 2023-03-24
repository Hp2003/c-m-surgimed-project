<?php
	include('header.php');
?>
	<style type="text/css">
		body{
			/* margin-top: 50px; */
			background-color:white;
			color:black;
		}
	</style>
<!-- <body> -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center border rounded bg-light my-5">
				<h1>My Cart</h1>
			</div>
			<div class="col-lg-9">
				<table class="table">
					<thead>
						<tr class="text-center"> 
							<th scope="col">Serial No.</th>
							<th scope="col">Item Name</th>
							<th scope="col">Item Price</th>
							<th scope="col">Quantity</th>
							<th scope="col">Total</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody class="text-center">
						<?php
							if(isset($_SESSION['cart'])){
								foreach($_SESSION['cart'] as $key=>$value){
									$sr=$key+1;
									echo "
										<tr>
											<td>$sr</td>
											<td>$value[Item_Name]</td>
											<td>$value[Item_Price]<input type='hidden' class='iprice' value='$value[Item_Price]'></td>
											<td>
											<form action='manage_cart.php' method='post' class='increaseqty'>
												<input type='number'  class='text-center iqty' name='mod_qty'  min='1' max='20' value='$value[Item_Quantity]'></td>
												<input type='hidden' name='Item_Name' value='$value[Item_Name]'> 
											</form>
											<td class='itotal'></td>	
											<td>
												<form action='manage_cart.php' method='post' class='rmporduct' >
													<button name='Remove_Item' class='btn btn-sm btn-outline-danger rmbtn' ><i class='fa-solid fa-trash'></i></button>
													<input type='hidden' name='Item_Name' value='$value[Item_Name]'> 
												</form>
											</td>
										</tr>
									";
								}
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="col-lg-3">
				<div class="border bg-light rounded p-4">
					<h4>Grand Total:</h4>
					<h5 class="text-center" id="gtotal"></h5>
					<br>
					<?php
						if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
					?>
					<form action="purchase.php" method="post">
						<div class="form-group">
							<label>Full Name</label>
							<input type="text" name="fname" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone Number</label>
							<input type="number" name="pno" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text" name="add" class="form-control" required>
						</div>
					<div>
						<input type="radio" name="payment" value="cod" required>
						<label>Cash On Delivery</label><br>
						<input type="radio" name="payment" value="online" required>
						<label>Online Payment</label>
					</div>
					<input type="submit" class="btn btn-primary btn-block my-2" name="purchase" value="Make Purchase">
					</form>
					<?php } ?>
				</div>	
			</div>
		</div>
	</div>
<script type="text/javascript">
	var gt=0;
	var iprice=document.getElementsByClassName('iprice');
	var iqty=document.getElementsByClassName('iqty');
	var itotal=document.getElementsByClassName('itotal');
	var gtotal=document.getElementById('gtotal');

	function subTotal(){
		gt=0;
		for(i=0;i<iprice.length;i++){
			itotal[i].innerText=(iprice[i].value)*(iqty[i].value);
			gt=gt+(iprice[i].value)*(iqty[i].value);
		}
		gtotal.innerText=gt;
	}

	subTotal();
</script>	
<?php 
	include('footer.php');
?>
<!-- </body>
</html> -->