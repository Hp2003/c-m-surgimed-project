<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
  <div class="container pagination-btn" style="min-height: 300px;">
	<div class="row">
		<div class="col-lg-12 text-center border rounded bg-light my-5">
			<form action="" method="post" class="text-center reportForm" >
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Main Category</label>
					<select class="form-select main_category" name = "main_category" onchange="getSubCategory(event, this)" aria-label="Default select example" > 
						<!-- <option value="" selected>Default</option> -->
					</select>
				</div>
				<!-- <input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory"> -->
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Sub Category</label>
					<select class="form-select sub_category"  name = "sub_category" aria-label="Default select example">
						<option value="" selected>Default</option>
					</select>
				</div>
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Status</label>
					<select class="form-select sub_category"  name = "status" aria-label="Default select example">
						<option value="" >Default</option>
						<option value="Placed" selected>Placed</option>
						<option value="Cancelled" >Cancelled</option>
					</select>
				</div>
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Product Id</label>
					<input type="text" name="product_id" value="" id="category_name" class="form-control search_user_input"  required>
				</div>
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">User Id ( *optional)</label>
					<input type="text" name="user_id" value="" id="category_name" class="form-control search_user_input"  required>
				</div>
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Time period Start</label>
					<input type="datetime-local" name="start_time" id="category_name" class="form-control search_user_input" min="2022-03-01 02:26:20" max="2023-03-27 21:08:39" value="2022-03-01 02:26:20" required>
				</div>
				<!-- <input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory"> -->
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Time periond End</label>
					<input type="datetime-local" name="end_time" id="category_name" class="form-control search_user_input" min="2022-03-01 02:26:20" max="2023-03-27 21:08:39" value="2023-03-27 21:08:39" required>

				</div>
				<input type="submit" name="edit_category" value="Generate" onclick = "generateReport(event,this)" class="btn btn-info px-3 mb-3 searchCategory">
			</form>
		</div>
		<!-- <select name="order" id="" class="orderBy" onChange="orderBy(event, this)">
			<option value="old" id="old" name="selectOder">lowest Quantity</option>
			<option value="new" id="new" name="selectOder">Heighest Quentity </option>
			<option value="deleted" id="new" name="selectOder"></option>
		</select>
		<select name="order" id="" class="orderBy mt-5" onChange="orderBy(event, this)">
			<option value="old" id="old" name="selectOder">Cancelled only </option>
			<option value="new" id="new" name="selectOder">Placed Only</option>
			<option value="deleted" id="new" name="selectOder"></option>
		</select> -->
		<div class="container text-center mt-5"><h3>Summery</h3></div>
		<!-- Shows total -->
		<div class="col-lg-9 container-fluid m-0 report-btns" style="width:100%">
		<table class="table">
				<thead>
					<tr class="text-center " >
						<th scope="col">Combine Revenue </th>
						<th scope="col">Combine selling</th>
						<th scope="col">Combine Cancelled</th>
						<!-- <th scope="col">Quantity sold</th> -->
						<!-- <th scope="col">Revenue</th>
						<th scope="col">Cancelled Units</th>
						<th scope="col">Total</th> -->
					</tr>
				</thead>
				<tbody class="text-center ">
					<tr>
						<td><button type="button" class="btn btn-outline-warning combineRevBtn" onclick = "genrateCombineRevenue(event, this, true)"><i class="fa fa-pie-chart" aria-hidden="true"></i></button></td>
						<td><button type="button" class="btn btn-outline-success combineSellingBtn" onclick = "genrateCombineSelling(event, this, true)"><i class="fa fa-pie-chart" aria-hidden="true"></i></button></td>
						<td><button type="button" class="btn btn-outline-danger combineCancelledBtn" onclick = "genrateCombineCancelled(event, this, true)"><i class="fa fa-pie-chart" aria-hidden="true"></i></button></td>
						<!-- <td><button type="button" class="btn btn-outline-" onclick = "genrateCombineChart(event, this)"><i class="fa fa-pie-chart" aria-hidden="true"></i></button></td> -->
						
					</tr>
				</tbody>
			</table>
		</div>
		<hr style="border:3px dashed black" class="mt-3">

		<div class="col-lg-9 container-fluid m-0" style="width:100%">
		
			<table class="table">
				<thead>
					<tr class="text-center header-summary" >
						<th scope="col">Serial No.</th>
						<th scope="col">Id</th>
						<th scope="col">Name</th>
						<th scope="col">Quantity sold</th>
						<th scope="col">Revenue</th>
						<th scope="col">Cancelled Units</th>
						<th scope="col">Total</th>
					</tr>
				</thead>
				<tbody class="text-center summery-tableBody">
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
		<hr style="border:3px dashed black" class="mt-3">
		<!-- Shows detail view  -->
		<div class="container text-center mt-5"><h3>Detail view</h3></div>
		<div class="col-lg-9 container-fluid m-0" style="width:100%">
			<table class="table">
				<thead>
					<tr class="text-center body detail-header">
						<th scope="col">Serial No.</th>
						<th scope="col"> Id</th>
						<th scope="col"> Name</th>
						<th scope="col">Placed Orders</th>
						<th scope="col">Revenue</th>
						<!-- <th scope="col">Cancelled Orders</th> -->
						<!-- <th scope="col">Quantity sold</th> -->
						<th scope="col">Placed On</th>
						<th scope="col">Cancelled Units</th>
						<!-- <th scope="col">Status</th>
						<th scope="col">Total price</th> -->
						<!-- <th scope="col">Total Orders</th> -->
						<!-- <th scope="col">Gender</th> -->
						<!-- <th scope="col">Deleted</th> -->
					</tr>
				</thead>
				<tbody class="text-center detail-tableBody">
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
<div class="container button-container">
</div>
    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<!-- Chart.js -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script src="../../src/js/report_generator/table_generator.js"></script>
	<script src="../../src/js/report_generator/render_data.js"></script>
	<script src="../../src/js/report_generator/report_gen.js"></script>
	<script src="../../src/js/report_generator/generate_pi_chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>
