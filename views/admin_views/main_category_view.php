<!-- <div class="container categoryTableMain">
<h3 class="text-center text-success mt-5">all Categories</h3>
	<table class="table table-bordered mt-5 table-main">
		<thead class="bg-info">
			<tr class="text-center">
				<td>Serial No</td>
				<td>Category Title</td>
				<td>Edit</td>
				<td>Delete</td>
			</tr>
		</thead>
		<tbody class="bg-secondary text-light table-body">


		</tbody>
	</table>


</nav>
</div> -->
  <button type="button" class="btn btn-primary" onclick = "refreshChart()"style="position: sticky; top: 3em; right: 12px; z-index:12;">
  <i class="fa fa-home" aria-hidden="true"></i>
 Main Chart
  </button>

<div class="container pagination-btn" style="min-height: 300px; ">
	<div class="row">
		<div class="col-lg-12 text-center border rounded bg-light my-5 " >
			<form action="" method="post" class="text-center searchCatForm">
				<div class="form-outline mb-4 w-50 m-auto">
					<label class="form-label">Category Title</label>
					<input type="text" name="category_name" value="" id="category_name" class="form-control serach_main_cat" required>
				</div>
				<input type="submit" name="edit_category" value="Search" class="btn btn-info px-3 mb-3 searchCategory" onclick="searchCategory(event)">
			</form>
			<input type="submit" name="edit_category" value="MainCategory" onclick = 'submitNewCategory(event, this)' class="btn btn-info px-3 mb-3 add_category " style="position:unset">
		</div>
		<!-- <select name="order" id="" class="orderBy" onChange="orderBy(event, this)">
			<option value="old" id="old" name="selectOder">Old First</option>
			<option value="new" id="new" name="selectOder">New First</option>
			<option value="deleted" id="new" name="selectOder">deleted</option>
		</select> -->
		<div class="col-lg-9 container-fluid m-0" style="width:100%;overflow:scroll">
			<table class="table">
				<thead>
					<tr class="text-center headings">
						<th scope="col">Serial No.</th>
						<th scope="col">Category Id</th>
						<th scope="col">Category name</th>
						<th scope="col">Created On</th>
						<th scope="col">Updated On</th>
						<th scope="col " class ="subCatCount" >Subcategory Count </th>
						<!-- <th scope="col">Open Subcategory</th> -->
						<th scope="col">Edit Category</th>
						<!-- <th scope="col"></th> -->
						<th scope="col">Remove</th>
						<th scope="col">Open Again</th> 
						<!-- <th scope="col">Deleted</th> -->
						<!-- <th scope="col"></th> -->
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