<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center border rounded bg-light my-5">
			<form action="" method="post" class="text-center searchCatForm">
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Category Title</label>
					<input type="text" name="category_name" value="" id="category_name" class="form-control search_cat_input" required>
				</div>
				<input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory">
			</form>
		</div>
		<div class="col-lg-9 container-fluid m-0" style="width:100%">
			<table class="table">
				<thead>
					<tr class="text-center">
						<th scope="col">Serial No.</th>
						<th scope="col">Id</th>
						<th scope="col">Product Name</th>
						<th scope="col">Product Price</th>
						<th scope="col">Quantity</th>
						<th scope="col">Delete</th>
						<th scope="col">Save</th>
					</tr>
				</thead>
				<tbody class="text-center tableBody">
					<!-- <tr>
						<td>1</td>
						<td>1</td>
						<td>1<input type='hidden' class='iprice' value='1'></td>
						<td>
							<form action='manage_cart.php' method='post'>
								<input type='number' class='text-center iqty' name='mod_qty' onchange='' min='1'
									max='20' value=''>
						</td>
						<input type='hidden' name='Item_Name' value=''>
						</form>
						<td class='itotal'></td>
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