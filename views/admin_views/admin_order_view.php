<div class="container" style="min-height: 300px;">
	<div class="row">
		<div class="col-lg-12 text-center border rounded bg-light my-5">
			<form action="" method="post" class="text-center searchCatForm">
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Customer id</label>
					<input type="text" name="category_name" value="" id="CusId" class="form-control search_cat_input" required>
				</div>
				<input type="submit" name="search_order" value="Search" onClick = "serachOrder(event)"class="btn btn-info px-3 mb-3 searchCategory SubmitCusId">
			</form>
			<div class="container">
				<select name="orderStatus" class=" form-select orderStatus"id="" aria-label="Default select example" onchange="filterOrders(event,this)">
					<option value="Default" class="default-selection"selected="selected">Default</option>
					<option value="Cancelled">Cancelled</option>
					<option value="Pending">Pending</option>
					<option value="Placed">Placed</option>
				</select>
			</div>
		</div>

		<div class="col-lg-9 container-fluid m-0" style="width:100%">
			<table class="table">
				<thead>
					<tr class="text-center">
						<th scope="col">Serial No.</th>
						<th scope="col">Product Id</th>
						<th scope="col">Customer Id</th>
						<th scope="col">Order Id</th>
						<th scope="col">Quantity</th>
						<th scope="col">Total Price</th>
						<th scope="col">Placed On</th>
						<th scope="col">status</th>
						<th scope="col">Cancel</th>
						<th scope="col">Place</th>
					</tr>
				</thead>
				<tbody class="text-center tableBody">
					<!-- <tr>
						<td>1</td>
						<td>1</td>
						<td>1<input type='hidden' class='iprice' value='1'></td>
						<td>
						price
						<td >quantity</td>
						<td >placed</td>
						<td>
							<form action='manage_cart.php' method='post'>
								<button name='Remove_Item' class='btn btn-sm btn-outline-danger'><i
										class='fa-solid fa-trash'></i></button>
								<input type='hidden' name='Item_Name' value='$value[Item_Name]'>
							</form>

						</td>
					</tr> -->
				</tbody>
			</table>
		</div>

	</div>
</div>