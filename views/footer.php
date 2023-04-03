
</div>
<div class="container pagination-main d-flex justify-content-center">

</div>
<button type="button" class="btn btn-primary rounded-circle back-to-top" style="display:none;"><i class="fa fa-arrow-up" aria-hidden="true" style="fontsize:2em;  " onclick="takeToTop()"></i>
</button>
	<footer class="footer d-flex " style="height:100%;">
		<div class="container" style="background-color: #24262b; ">
			<div class="row" >
				<!-- <div class="footer-col">
					<h4>Company</h4>
					<ul>
						<li><a href="#">about us</a></li>
						<li><a href="#">our services</a></li>
						<li><a href="#">privacy policy</a></li>
						<li><a href="#">contacts</a></li>
					</ul>
				</div> -->
				<div class="footer-col">
					<h4>Get Help</h4>
					<ul>
						<!-- <li><a href="#">FAQ</a></li> -->
						<li><a href="#">Payment</a></li>
						<li><a href="#">Returns</a></li>
						<!-- <li><a href="#"></a></li> -->
						<li><a href="#">payment option</a></li>
					</ul>
				</div>
				<div class="footer-col">
					<h4>Online Shop</h4>
					<ul>
						<li><a href="#">chair</a></li>
						<li><a href="#">stracher</a></li>
						<li><a href="#">stool</a></li>
						<li><a href="#">bad</a></li>
					</ul>
				</div>
				<div class="footer-col">
					<h4>Follow Us</h4>
					<div class="social-links">
						<a href="#"><i class="fab fa-facebook-f"></i></a>
						<a href="#"><i class="fab fa-twitter"></i></a>
						<a href="#"><i class="fab fa-instagram"></i></a>
						<!-- <a href="#"><i class="fab fa-linkedin-in"></i></a> -->
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5">
                <form id="contactUs_form">
                    <fieldset class="form-group">
                        <input type="email" class="form-control" id="ehc" name="Email" placeholder="Enter email">
                    </fieldset>
                    <fieldset class="form-group">
                        <textarea class="form-control" id="mhc" placeholder="Message" name="message"></textarea>
                    </fieldset>
                    <fieldset class="form-group text-xs-right">
                        <button type="button" class="btn btn-secondary-outline btn-lg" id="hcb">Send</button>
                    </fieldset>
                </form>
            </div>
	</footer>

	<!-- Axios -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- credits: https://www.codeply.com/p/EJd6H4Ejyi -->
<!-- <section class="dark"></section> -->

<!-- Custom js -->
<script src="../src/js/Alert.js"></script>
<script src="../src/js/confirmbox.js"></script>
<?php 
	if($IsAdmin == false){
		echo '<script src="../src/js/searchProduct.js"></script>';
	}
?>

<script src="../src/js/orderpage_ui.js"></script>
<script src="../src/js/order_view.js"></script>
<script src="../src/js/manageCart.js"></script>
<script src="../src/js/popup.js"></script>
<script src="../src/js/display_product_page.js"></script>
<!-- <script src="../src/js/cart.js"></script> -->
<!-- <script src="../src/js/homepage_contact.js"></script> -->
<script src="../src/js/homepage_ui.js"></script>
<?php 
	if(isset($IsAdmin) ){
		if($IsAdmin == true){
			echo '<script src="../src/js/include_admin_js_modules.js" defer></script>';
			echo '<script src="../src/js/deletePro.js"></script>';
			echo "<script src= '../src/js/adminToggleButton.js'></script>";
			echo "<script src='../src/js/list_all_user_ui.js'></script>";
			echo "<script src='../src/js/edit_category.js'></script>";
			echo "<script src='../src/js/edit_brands.js'></script>";
			echo "<script src='../src/js/admin_search_product.js'></script>";

		}
	}

?>

<script type="text/javascript">


		function showimg(path){
			document.querySelector('.biggerImg').src = path;
		}
		function takeToTop(){
			document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
		}
	</script>

<script type="text/javascript">

		$(document).ready(function(){
			$('.sub-btn').click(function(){
				$(this).next('.sub-menu').slideToggle();
				$(this).find('.dropdown').toggleClass('rotate');
			});
			$('.menu-btn').click(function(){
				$('.side-bar').addClass('active');
				$('.menu-btn').css("visibility","hidden");
			});
			$('.close-btn').click(function(){
				$('.side-bar').removeClass('active');
				$('.menu-btn').css("visibility","visible");
			});
		});
	</script>
	<script>
		window.addEventListener('scroll', function() {
			if (window.scrollY >= 300) {
				document.querySelector('.back-to-top').style.display = 'block';
			}else{
				document.querySelector('.back-to-top').style.display = 'none';
			}
		});
	</script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
