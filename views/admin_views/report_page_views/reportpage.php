<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>
  <div class="container pagination-btn" style="min-height: 300px;">
	<div class="row">
		<div class="col-lg-12 text-center border rounded bg-light my-5">
			<form action="" method="post" class="text-center searchCatForm">
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Main Category Title</label>
					<input type="text" name="category_name" value="" id="category_name" class="form-control search_user_input"  required>
				</div>
				<!-- <input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory"> -->
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Sub Category Title</label>
					<input type="text" name="category_name" value="" id="category_name" class="form-control search_user_input"  required>
				</div>
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Poduct title</label>
					<input type="text" name="category_name" value="" id="category_name" class="form-control search_user_input"  required>
				</div>
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">User Name Or Id ( *optional)</label>
					<input type="text" name="category_name" value="" id="category_name" class="form-control search_user_input"  required>
				</div>
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Time period Start</label>
					<input type="date" name="category_name" id="category_name" class="form-control search_user_input" min="2022-03-31" max="2023-03-31" value="2022-03-31" required>
				</div>
				<!-- <input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory"> -->
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Time periond End</label>
					<input type="date" name="category_name" id="category_name" class="form-control search_user_input" min="2022-03-31" max="2023-03-31" value="2023-03-31" required>

				</div>
				<input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory">
			</form>
		</div>
		<select name="order" id="" class="orderBy" onChange="orderBy(event, this)">
			<option value="old" id="old" name="selectOder">lowest Quantity</option>
			<option value="new" id="new" name="selectOder">Heighest Quentity </option>
			<option value="deleted" id="new" name="selectOder"></option>
		</select>
		<select name="order" id="" class="orderBy mt-5" onChange="orderBy(event, this)">
			<option value="old" id="old" name="selectOder">Cancelled only </option>
			<option value="new" id="new" name="selectOder">Placed Only</option>
			<option value="deleted" id="new" name="selectOder"></option>
		</select>
		<div class="col-lg-9 container-fluid m-0" style="width:100%">
			<table class="table">
				<thead>
					<tr class="text-center">
						<th scope="col">Serial No.</th>
						<th scope="col">User Id</th>
						<th scope="col">Placed On</th>
						<th scope="col">Quantity</th>
						<th scope="col">Price</th>
						<th scope="col">Status</th>
						<th scope="col">Total price</th>
						<!-- <th scope="col">Total Orders</th> -->
						<th scope="col">Gender</th>
						<!-- <th scope="col">Deleted</th> -->
						<th scope="col">Remove</th>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>
