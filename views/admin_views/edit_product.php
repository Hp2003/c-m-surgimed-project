
	<div class="container  main-edit-pro main-form">
		<h1 class="text-center pt-4 pb-1">Edit Product</h1>
		<form action="" method="post" id="editProductForm" class="mt-5">
			<div class="form-outline w-75 mt-3 m-auto mb-4">
				<label class="form-label">Product Title</label>
				<input type="text" name="product_title" value="" class="form-control" id="product_title" required>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Description</label>
				<!-- <input type="text"  required> -->
				<textarea name="product_desc" value="" class="form-control" id="product_desc"cols="30" rows="10"></textarea>
			</div>
			<!-- <div class="form-outline  w-75  m-auto mb-4">
				<label class="form-label">Product Keywords</label>
				
				<textarea name="product_keywords" value="" class="form-control" id="product_keywords"cols="30" rows="10"></textarea>
			</div> -->
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Categories</label>
				<select name="product_category" class="form-select">
					<option value="<?php $category_name ?>"></option>	
				</select>
			</div>
			<div class="form-outline w-75 pt-3 m-auto mb-4">
				<label class="form-label">Add Category</label>
				<input type="text" name="product_price" value="" class="form-control" id="product_price" required>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Image</label>
				<input type="file" name="product_image" value="" class="form-control" id="product_image" required>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Price</label>
				<input type="text" name="product_price" value="" class="form-control" id="product_price" required>
			</div>
			<div class="container d-flex w-75 pt-3 justify-content-around">
				<div class="    pt-3">
					<input type="submit" name="edit_product" value="Update Product" class="btn btn-info px-3 mb-3">
				</div>
				<div class="    pt-3">
					<input type="submit" name="" value="Close" class="btn btn-info px-3 mb-3 closeEditForm">
				</div>
			</div>

		</form>
	</div>
