<div class="container pagination-btn" style="min-height: 300px;">
	<div class="row">
		<div class="col-lg-12 text-center border rounded bg-light my-5">
			<form action="" method="post" class="text-center searchCatForm">
				<div class="form-outline mb-4 w-50 m-auto">
					<h2 class="text-black">User List</h2>
					<input type="text" name="User Id" placeholder="Enter user id"value="" id="category_name" class="form-control search_user_input"  required>
				</div>
				<input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory" onclick="searchUser(event)">
			</form>
			<select name="order" id="" class="orderBy form-select" aria-label="Default select example" onChange="orderBy(event, this)">
				<option value="old" id="old" name="selectOder">Old First</option>
				<option value="new" id="new" name="selectOder">New First</option>
				<option value="deleted" id="new" name="selectOder">deleted</option>
			</select>
		</div>
		<div class="col-lg-9 container-fluid m-0" style="width:100%; overflow:scroll">
			<table class="table">
				<thead>
					<tr class="text-center">
						<th scope="col">Serial No.</th>
						<th scope="col">User Id</th>
						<th scope="col">User Name</th>
						<th scope="col">First Name</th>
						<th scope="col">Last Name</th>
						<th scope="col">Email</th>
						<th scope="col">Orders Placed</th>
						<th scope="col">Joined At</th>
						<!-- <th scope="col">Total Orders</th> -->
						<th scope="col">Gender</th>
						<th scope="col">Deleted</th>
						<th scope="col">Remove</th>
						<th scope="col">Re-Open</th>
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