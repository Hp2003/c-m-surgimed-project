<div class="proContainer">

	<form action="manage_cart.php" method="post" class="detailsMainForm">

		<div class='product1' style="max-width: 900px">
			<div class="container flex-cons">

				<div class='pic'>
					<div class="big-img">
						<img src='../Admin panel/product_images/chair.jpeg' height="300" width="300"
							style="border-radius: 16px;" class="biggerImg">
					</div>
					<div class="small-pic ">
						<img src="../img/Product_images/641fa2199d502/img4.jpg" class="small-img"
							onclick="showimg(this.src);">
						<img src="../img/Product_images/641fa28484812/general-semi-fowler-bed-500x500-600x560w.jpg"
							class="small-img" onclick="showimg(this.src);">
						<img src="../img/Product_images/641fa294349e8/img5.jpg" class="small-img"
							onclick="showimg(this.src);">
						<img src="../img/Product_images/641fa22d5918b/img4.jpg" class="small-img"
							onclick="showimg(this.src);">
						<img src="../img/Product_images/641fa3b2e83c6/img5.jpg" class="small-img"
							onclick="showimg(this.src);">
					</div>
				</div>
			</div>
			<div class="container flex-cons">

				<div class='info'>
					<a href="index1.php" class="btn closeBtn" onclick="closeContainer(event)">close</a>
					<div class='name title'>Chair</div>
					<div class='grid'>
						<div class=' '>
							<label>Price of Product</label>
							Rs <h3 class="price">1500</h3>
						</div>
						<div class=''>
							<label style="margin:0;padding:0;">Availabel in Stock</label>
							<h4 class="stock">15</h4>
						</div>
					</div>
					
					<div class='colors'>
						<h4>desc :- </h4>
						<p class="desc"></p>
						
					</div>
					<div class='action'>
						<input type='submit' name='detail' value='check Review' class='button outline' onclick="showReview(event)" >
						<input type='submit' name='addtocart' value='Add to Cart' class='button fill'>
					</div>
				</div>
			</div>
	</form>

    </div>


</div>

