<?php
include("header.php");



?>

	<!-- end navigation -->

	<!-- start flexslider -->
	<div class="flexslider">
		<ul class="slides">
			<li>
				<img src="images/slider-img1.jpg" alt="Pizza Image 1">
				<div class="flex-caption">
					<h2 class="slider-title">We make Pizza</h2>
					<h3 class="slider-subtitle">Fresh, clean, and delicious.</h3>
					<p class="slider-description">Praesent tincidunt neque semper elementum gravida. Donec id euismod magna. Ut erat ligula, malesuada eu quam a, fringilla auctor augue.</p>
				</div>
			</li>
			<li>
				<img src="images/slider-img2.jpg" alt="Pizza Image 2">
				<div class="flex-caption">
					<h2 class="slider-title">Freshly Baked Pizza</h2>
					<h3 class="slider-subtitle">Premium Quality, Finest Ingredients</h3>
					<p class="slider-description">Donec id euismod magna. Ut erat ligula, malesuada eu quam a, fringilla auctor augue. Praesent tincidunt neque semper elementum gravida.</p>
				</div>

			</li>
		</ul>
	</div>
	<!-- end flexslider -->


	<!-- start about -->
	<section id="about" class="templatemo-section templatemo-top-130">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1 class="text-uppercase">Your Pizza Shop</h1>
				</div>
				<div class="col-md-6 col-sm-6">
					<h3 class="text-uppercase padding-bottom-10">Another Baker</h3>
					<p>Pizza Villa is about much more than pizzas. From freshly sauteed pastas and delicious appetizers to mocktails, desserts, soups and salads, we have a wide range for you to feast on. All this, combined with the warm, inviting ambience and friendly service, will lead to endless conversations, laughter and memories that you'll cherish forever. So, let your hair down and feel at ease. Go ahead and enjoy the All New Pizza Villa experience!</p>

					</div>
				<div class="col-md-6 col-sm-6">
					<img src="images/about-img1.jpg" class="img-responsive img-bordered img-about" alt="about img">
				</div>
			</div>
		</div>
	</section>
	<!-- end about -->



<!-- start menu -->
<section id="menu" class="templatemo-section templatemo-light-gray-bg">
	<div class="product">

    <div class="container">
      <div class="row">
				<div class="col-md-12 menu">
					<h2 class="text-center text-uppercase">Menu</h2>
           <hr>
				</div>

				<div class="menu-loader loader col-xs-6 col-xs-offset-5"></div>

			</div>

		</div>
	</div>
</section>
<!-- end menu -->


	<!-- start contact -->
	<section id="feedback" class="templatemo-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-uppercase text-center">FeedBack</h2>
					<hr>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<?php if (isset($feedback_msg)) { ?>
					<div id="error" class="alert alert-success" role="alert"><?php echo $feedback_msg ?></div>
					<script>window.location.hash = "#feedback"; </script>
					<?php } ?>
					<form action="feedback.php" method="post" role="form">
						<div class="col-md-6 col-sm-6">
							<input name="name" type="text" class="form-control" id="name" maxlength="60" placeholder="Name">
					    	<input name="email" type="email" class="form-control" id="email" placeholder="Email">
							<input name="subject" type="text" class="form-control" id="subject" placeholder="Subject">
						</div>
						<div class="col-md-6 col-sm-6">
							<textarea class="form-control" rows="5" placeholder="Message" name="message"></textarea>
						</div>
						<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
							<input name="submit" type="submit" class="form-control" id="submit" value="Send">
						</div>
					</form>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-4 col-sm-4">
					<h3 class="padding-bottom-10 text-uppercase">Fet in Touch with us</h3>

					<p>
						<i class="fa fa-phone contact-fa"></i>
						<a href="tel:010-020-0340" class="contact-link">010-020-0340</a>,
						<a href="tel:080-090-0660" class="contact-link">080-090-0660</a>
					</p>
					<p><i class="fa fa-envelope-o contact-fa"></i>
                    	<a href="mailto:hello@pizzavilla.com" class="contact-link">hello@pizzavilla.com.com</a></p>
				</div>

				<div class="col-md-4 col-sm-4">
					<div class="google_map">
						<div id="map-canvas" class="map"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end contact -->
	<!-- modals start -->

	<script src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.mycart.js"></script>
	<script src="js/scroll.js"></script>
		<script>
			 $(function() {
				$('html').smoothScroll(500);
			 });
			</script>

			<script>

			$(document).ready(function() {
				console.log("here");
				$.ajax({
				url: 'menu.php',
				beforeSend : function()    {
						console.log("before");
						$(".menu-loader").show();
				},
				success: function(result) {
					$(".menu").slideUp("slow");
						$(".menu").html(result);
						$(".menu-loader").hide();
						$(".menu").slideDown("slow");
						console.log("success");
				},
				error:function(e){
					console.log("error");
					$(".menu-loader").hide();
					alert("Error Loading data");

				}
				});
			});
			</script>


<script type="text/javascript" src="js/menu.js"></script>




	<?php include("modals.php"); ?>
	<!-- start footer -->

	<?php include("footer.php"); ?>
