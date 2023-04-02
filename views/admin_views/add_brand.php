<div class="container pagination-btn" style="min-height: 300px;">
	<div class="row">
		<div class="col-lg-12 text-center border rounded bg-light my-5">
			<form action="" method="post" class="text-center searchCatForm">
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Category Title</label>
					<input type="text" name="category_name" value="" id="category_name" class="form-control search_user_input" onkeydown="searchUser(event,this,index)" required>
				</div>
				<input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory" onclick='addNewBrand(event, this)'>;
			</form>
		</div>
		<div class="col-lg-9 container-fluid m-0" style="width:100%">
			<table class="table">
				<thead>
					<tr class="text-center">
						<th scope="col">Serial No.</th>
						<th scope="col">Brand Id</th>
						<th scope="col">Brand Name</th>
						<th scope="col">Added On</th>
						<th scope="col">Updated On</th>
						<!-- <th scope="col"></th> -->
						<!-- <th scope="col">Orders Placed</th> -->
						<!-- <th scope="col">Total Orders</th> -->
						<!-- <th scope="col">Deleted</th> -->
						<th scope="col">Remove</th>
						<th scope="col">Re-Openr</th>
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