
	<div class="container  main-edit-pro main-form">
		<h1 class="text-center pt-4 pb-1">Edit Product</h1>
		<form action="" method="post" id="editProduct" class="mt-5 popupForm">
			<div class="form-outline w-75 mt-3 m-auto mb-4">
				<label class="form-label">Product Title</label>
				<input type="text" name="product_title" value="" class="form-control" id="product_title" required>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Description</label>
				<!-- <input type="text"  required> -->
				<textarea name="product_desc" value="" class="form-control" id="product_desc"cols="30" rows="10"></textarea>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Keywords</label>
				<!-- <input type="text"  required> -->
				<textarea name="product_keywords" value="" class="form-control" id=""cols="30" rows="10"></textarea>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label ">Main Category</label>
				<select name="main_category" class="form-select MainCategory">
				</select>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label ">Subcategory</label>
				<select name="product_category" class="form-select Subcategory">
					
				</select>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label ">Brand</label>
				<select name="brand" class="form-select Brand">
					
				</select>
			</div>
			<input type="hidden" name="img_dir" class="img_dir" value="">
			<!-- images -->
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
			<p class="img-text mx-2"></p>
					<label for="img1" class="btn btn-info ">Add image 1</label>
					<input type="file"  style="display:none;"id="img1" class="pro-img">
					<input type="checkbox" name="remove[]" class="remove" id="" value = 'remove1'> remove1
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
			<p class="img-text mx-2"></p>
					<label for="img2" class="btn btn-info ">Add image 2</label>
					<input type="file"  style="display:none;"id="img2" class="pro-img">
					<input type="checkbox" name="remove[]" class="remove" id="" value = 'remove2'> remove2

			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
			<p class="img-text mx-2"></p>
					<label for="img3" class="btn btn-info ">Add image 3</label>
					<input type="file"  style="display:none " id="img3"class="pro-img">
					<input type="checkbox" name="remove[]"  class="remove" id="" value = 'remove3'> remove3

			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
			<p class="img-text mx-2"></p>
					<label for="img4" class="btn btn-info ">Add image 4</label>
					<input type="file"  style="display:none " id="img4" class="pro-img">
					<input type="checkbox" name="remove[]" class="remove" id="" value = 'remove4'>remove4

			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
			<p class="img-text mx-2"></p>
					<label for="img5" class="btn btn-info ">Add image 5</label>
					<input type="file" class="pro-img"id="img5" style="display:none ">
					<input type="checkbox" name="remove[]" class="remove" id="" value = 'remove5'> remove5

			</div>

			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Price</label>
				<input type="text" name="product_price" value="" class="form-control" id="product_price" required>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">QOH</label>
				<input type="text" name="QOH" value="" class="form-control" id="QOH" required>
			</div>
			<div class="container d-flex w-75 pt-3 justify-content-around">
				<div class="    pt-3">
					<input type="submit" name="" value="Update Product" class="btn btn-info px-3 mb-3  " onClick="editProduct(event)">
				</div>
				<div class="    pt-3">
					<input type="submit" name="" value="Close" class="btn btn-info px-3 mb-3 closeEditForm">
				</div>
			</div>

		</form>
	</div>
