
<div class="container  main-add-pro main-form" style="height:100vh">
		<h1 class="text-center pt-4 pb-1">Add product</h1>
		<form action="" method="post" id="addProductForm" style="background: #ffffff42;padding: 2em;border-radius: 14px; bbackdrop-filter: blur(13px);" class="mt-5 popupForm">
			<div class="form-outline w-75 mt-3 m-auto mb-4" >
				<label class="form-label">Product Title</label>
				<input type="text" name="product_title" value="" class="form-control" id="product_title" required>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Description</label>
				<!-- <input type="text"  required> -->
				<textarea name="product_desc" value="" class="form-control desc" id="product_desc"cols="30" rows="10"></textarea>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Description</label>
				<!-- <input type="text"  required> -->
				<textarea name="product_desc" value="" class="form-control desc" id="product_desc"cols="30" rows="10"></textarea>
			</div>
			<!-- <div class="form-outline  w-75  m-auto mb-4">
				<label class="form-label">Product Keywords</label>
				
				<textarea name="product_keywords" value="" class="form-control" id="product_keywords"cols="30" rows="10"></textarea>
			</div> -->
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Categories</label>
				<select name="select_category" class="form-select dropDown" >
					<option value="" disabled selected>Select Category</option>
	
				</select>
			</div>
			<div class=" w-75 pt-3 m-auto mb-4">
				<label class="form-label">Add Category</label>
				<input type="checkbox" name="toggle" value="" class="check toggle" id=""  >
			</div>
			<div class="form-outline w-75 pt-3 m-auto mb-4">
				<input type="text" name="new_category" value="" class="form-control new_cat" id=""  disabled required>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Image</label>
				<input type="file" name="product_image[]" value="" class="form-control productImg" multiple="multiple" required>
			</div>
			<div class="main-prev d-flex align-items-center justify-content-center flex-column pt-3 m-auto" >
				<input type="text" value = "" name="" id="" class="form-outline  w-75 pt-3 m-auto mb-4 text-white img-name" style="display:none" disabled>
				<input type="text" value = "" name="" id="" class="form-outline  w-75 pt-3 m-auto mb-4 text-white img-name" style="display:none" disabled>
				<input type="text" value = "" name="" id="" class="form-outline  w-75 pt-3 m-auto mb-4 text-white img-name" style="display:none" disabled>
				<input type="text" value = "" name="" id="" class="form-outline  w-75 pt-3 m-auto mb-4 text-white img-name" style="display:none" disabled>
				<input type="text" value = "" name="" id="" class="form-outline  w-75 pt-3 m-auto mb-4 text-white img-name" style="display:none" disabled>
			<!-- Add your input text elements here -->
			</div>

			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Product Price</label>
				<input type="text" name="product_price" value="" class="form-control price" id="" required>
			</div>
			<div class="form-outline  w-75 pt-3 m-auto mb-4">
				<label class="form-label">Quantity</label>
				<input type="text" name="qoh" value="0" class="form-control qoh" id="" required>
			</div>

			<div class="container d-flex w-75 pt-3 justify-content-around">
				<div class="    pt-3">
					<input type="submit" name="add_product" value="Add Product" class="btn btn-info px-3 mb-3 add_product">
				</div>
				<div class="    pt-3">
					<input type="submit" name="" value="Close" class="btn btn-info px-3 mb-3 closeAddProduct">
				</div>
			</div>

		</form>
	</div>
