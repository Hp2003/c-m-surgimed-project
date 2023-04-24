<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Report Page</title>
    <link rel="shortcut icon" type="image/png" href="../../favicon-16x16.png" sizes="16x16">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<div class="container pagination-btn" style="min-height: 300px;">
		<div class="row">
			<div class="col-lg-12 text-center border rounded bg-light my-5">
				<form action="" method="post" class="text-center graphForm">
					<div class="form-outline mb-4 w-50 m-auto">
						<label class="form-label">Select year</label>
						<select class="form-select main-year" name="main-Year"aria-label="Default select example" onchange="changeMonth(event,this)">
							<!-- <option value="" selected>Default</option> -->
						</select>
					</div>
					<!-- <input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory"> -->
					<div class="form-outline mb-4 w-50 m-auto">
						<label class="form-label">Select Month</label>
						<select class="form-select main-month month" name="main-Month" aria-label="Default select example">
							<option value="" selected>Default</option>
						</select>
					</div>
					<div class="form-outline mb-4 w-50 m-auto">
						<label class="form-label">Status</label>
						<select class="form-select main-status" name="main-Status" aria-label="Default select example">
							<!-- <option value="" >Default</option> -->
							<option value="Placed" selected>Placed</option>
							<option value="Cancelled">Cancelled</option>
						</select>
					</div>
					<div class="form-outline mb-4 w-50 m-auto">
						<label class="form-label">Type</label>
						<select class="form-select type" name="main-type" aria-label="Default select example">
							<!-- <option value="" >Default</option> -->
							<option value="Revenue" selected>Revenue</option>
							<option value="Sales">Sales</option>
						</select>
					</div>
					<div class="form-outline mb-4 w-50 m-auto">
						<label class="form-label">Main Category</label>
						<select class="form-select main-main_category" name="main-main_category" onchange="getSubCategory(event, this)" aria-label="Default select example">
							<option value="" selected>Default</option>
						</select>
					</div>
					<div class="form-outline mb-4 w-50 m-auto">
						<label class="form-label">Sub Category</label>
						<select class="form-select main-sub_category" name="main-sub_category" aria-label="Default select example">
							<option value="" selected>Default</option>
						</select>
					</div>
					<div class="form-outline mb-4 w-50 m-auto">
						<label class="form-label">Product Id</label>
						<input type="text" name="main-product_id" value="" id="main-Product" class="form-control inputProductId main-pro_id" required>
					</div>
					<div class="form-outline mb-4 w-50 m-auto">
						<label class="form-label">User Id ( *optional)</label>
						<input type="text" name="main-user_id" value="" id="category_name" class="form-control inputUserId main-user_id" required>
					</div>
					<div class="form-outline mb-4 w-50 m-auto">
						<input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate" onchange="showCompareForm(event,this)">
						<label class="form-check-label" for="flexCheckIndeterminate">
							Compare
						</label>
					</div>

					<!-- <input type="submit" name="edit_category" value="normalGraph" onclick = "genrateGraph(event,this)" class="btn btn-info px-3 mb-3 genGraph"> -->
					<button type="button" value='normalGraph' class="btn btn-info genGraph" onclick="genGraph(event,this)">Generate</button>
					<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- -->
					<div class="container compareContainer">
						<h2>Compare With</h2>
						<div class="form-outline mb-4 w-50 m-auto">
							<label class="form-label">Select year</label>
							<select class="form-select sub-year" name="sub-year" onchange="changeSubMonth(event, this)" aria-label="Default select example">
								<!-- <option value="" selected>Default</option> -->
							</select>
						</div>
						<!-- <input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory"> -->
						<div class="form-outline mb-4 w-50 m-auto">
							<label class="form-label">Select Month</label>
							<select class="form-select sub_category month sub-month" name="sub-month" aria-label="Default select example">
								<option value="" selected>Default</option>
							</select>
						</div>
						<div class="form-outline mb-4 w-50 m-auto">
							<label class="form-label">Status</label>
							<select class="form-select sub_category" name="sub-status" aria-label="Default select example">
								<!-- <option value="" >Default</option> -->
								<option value="Placed" selected>Placed</option>
								<option value="Cancelled">Cancelled</option>
							</select>
						</div>
						<div class="form-outline mb-4 w-50 m-auto">
							<label class="form-label">Main Category</label>
							<select class="form-select sub-main_category" name="sub-main_category" onchange="getSubCategory(event, this, 'sub-sub_category')" aria-label="Default select example">
								<option value="" selected>Default</option>
							</select>
						</div>
						<div class="form-outline mb-4 w-50 m-auto">
							<label class="form-label">Sub Category</label>
							<select class="form-select sub-sub_category" name="sub-sub_category" aria-label="Default select example">
								<option value="" selected>Default</option>
							</select>
						</div>
						<div class="form-outline mb-4 w-50 m-auto">
							<label class="form-label">Product Id</label>
							<input type="text" name="sub-product_id" value="" id="" class="form-control search_user_inpunt sub-pro_id" required>
						</div>
						<div class="form-outline mb-4 w-50 m-auto">
							<label class="form-label">User Id ( *optional)</label>
							<input type="text" name="sub-user_id" value="" id="category_name" class="form-control search_user_input sub-user_id" required>
						</div>
						<button type="button" value='compareGraph' class="btn btn-info genGraph" onclick="genGraph(event,this)">Compare</button>


					</div>

				</form>
			</div>
			<div class="container-fluid" style="height:40em; width:100%;">
				<canvas id="chart"></canvas>
			</div>

			<!-- Axios -->
			<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
			<!-- Chart.js -->
			<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

			<script src="../../src/js/Alert.js"></script>
			<script src="../../src/js/report_generator/graph_gen.js"></script>
			<script src="../../src/js/report_generator/graph_request.js"></script>
			<script src="../../src/js/report_generator/graph_gen_main.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>