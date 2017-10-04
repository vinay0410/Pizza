<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">

	<title>Pizza Villa</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
    <meta name="author" content="templatemo">


	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- css -->
	<link href="css/style.css" type="text/css" rel="stylesheet" media="all">

	<!-- bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- font-awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- custom -->
	<link rel="stylesheet" href="css/templatemo-style.css">
	<!-- google font -->
	<link href='//fonts.googleapis.com/css?family=Signika:400,300,600,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Chewy' rel='stylesheet' type='text/css'>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

<style>
.front img{
height:150px;
}
.gallery-des{
color:white;
}
.back{
background-color:orange;
}
.front{
background-color:white;
}
</style>

</head>
<body id="home" data-spy="scroll" data-target=".navbar-collapse">

	<?php
		session_start();

		if(isset($_SESSION["pop_profile"])) {
			$pop_profile = $_SESSION["pop_profile"];
			unset($_SESSION["pop_profile"]);
		}

		if(isset($_SESSION["pleaselogin"])) {
			echo "<script type='text/javascript'>alert('Please Login, To be able to change passowrd')</script>";
			unset($_SESSION["pleaselogin"]);
		}


		if (isset($_SESSION["reg-success"])) {
			echo "<script type='text/javascript'>alert('Registration Successfull, Login to continue')</script>";

			unset($_SESSION["reg-success"]);
		}

		if (isset($_POST["logout"])) {
			unset($_SESSION["logged"]);
		}

		if (isset($_SESSION["signup-error"])) {
			$signup_error = $_SESSION["signup-error"];
			unset($_SESSION["signup-error"]);

		}

		if (isset($_POST["username"])) {

	  #echo phpinfo();
		$username = $_POST["username"];
		$pass = $_POST["pass"];
		$error = False;
		$error_msg;
		try {

		 $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
		 $db = $m->Pizza;
		 $collection = $db->users;

		} catch(Exception $e) {
			#die("Caught Exception failed to Connect".$e->getMessage()."\n");

			$show_login = True;
			$error_msg = "Couldn't Connect to Database";
			$error = True;
		}
		if (!$error) {
			$result = $collection->findOne(array('username' => $username));
			#var_dump($result);
			if (!empty($result)) {
				if ($result["password"] == $pass) {
					echo "<script type='text/javascript'>alert('Logged in Successfully');</script>";
					$_SESSION["logged"] = $result;
					if ($username == "admin") {
						header("Location: ./admin.php");
					}
				} else {
					$show_login = True;
					$error = True;
					$error_msg = "Passwords don't match";
				}

			} else {
				$show_login = True;
				$error_msg = "Username not Registered, Register First!\n";
				$error = True;
			}

		}

		}

		?>


	<!-- start navigation -->
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
				</button>
				<a href="#home" class="navbar-brand smoothScroll"><strong>PIZZA Villa</strong></a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#home" class="smoothScroll">HOME</a></li>
					<li><a href="#about" class="smoothScroll">ABOUT</a></li>
					<li><a href="#menu" class="smoothScroll">MENU</a></li>
					<li><a href="#gallery" class="smoothScroll">GALLERY</a></li>
					<li><a href="#contact" class="smoothScroll">CONTACT</a></li>
					<?php if(!isset($_SESSION["logged"])) { ?>
					<li><a><button class="btn btn-warning pb-modalreglog-submit" data-toggle="modal" data-target="#myModal">Login</button><button class="btn btn-warning pb-modalreglog-submit" data-toggle="modal" data-target="#myModal2">Register</button></a></li>
				<?php } else { ?>
          <li><a><button class="btn btn-warning pb-modalreglog-submit" data-toggle="modal" data-target="#userModal"><?php echo 'Hi '.$_SESSION["logged"]["username"]; ?></button></a></li>
				<?php } ?>
			</div>
		</div>
	</div>
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
					<p>Pizza responsive web template is provided by <a rel="nofollow" href="http://www.templatemo.com" target="_parent">templatemo</a> website. Feel free to download, adapt, and use this template for your websites. Credit goes to <a rel="nofollow" href="http://pixabay.com" target="_parent">Pixabay</a> for images used in this template.</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat.</p>
					<p>Proin enim sem, ultricies sit amet convallis nec, sodales quis augue. Duis consequat felis ac justo luctus, a cursus tellus pharetra. In ullamcorper gravida enim id pulvinar.</p>

					<button class="btn btn-warning pb-modalreglog-submit" data-toggle="modal" data-target="#myModal">Login</button>
          <button class="btn btn-warning pb-modalreglog-submit" data-toggle="modal" data-target="#myModal2">Register</button>
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

				<div class="col-md-12">
					<h2 class="text-center text-uppercase">Menu</h2>
					<hr>
				</div>
				<div class="header">
						<div class="cart cart box_1">
							<form action="#" method="post" class="last">
								<input type="hidden" name="cmd" value="_cart" />
								<input type="hidden" name="display" value="1" />
								<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
							</form>
						</div>

				</div><!-- header ends (for cart) -->

				<!-- -->
				<div class="products-row" >
					<div class="col-md-4 col-sm-4 product-grids">
						<div class="flip-container">
							<div class="flipper agile-products">
								<div class="front">
									<img src="menu/1.jpg" class="img-responsive" alt="img">
									<!--<div class="agile-product-text">
										<h5>Voluptate</h5>
									</div> -->

									<div class="gallery-des">
									<h3>Voluptate</h3>
									</div>


								</div>
								<div class="back">
									<h4>Voluptate </h4>
									<p>Cheese, tomato, mushrooms, onions.</p>
									<h6>50<sup>$</sup></h6>
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="w3ls_item" value="Voluptate">
										<input type="hidden" name="amount" value="50">
										<button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
										<span class="w3-agile-line"> </span>
										<a href="#" data-toggle="modal" data-target="#myModal1">Explore</a>
									</form>
								</div><!-- front-->
							</div><!--flipper agileproducts -->
						</div> <!--flip container-->
					</div>
					<div class="col-md-4 col-sm-4 product-grids">
						<div class="flip-container">
							<div class="flipper agile-products">
								<div class="front">
								<img src="menu/2.jpeg" class="img-responsive" alt="img">
									<!--<div class="agile-product-text">
										<h5>Voluptate</h5>

									</div> -->

									<div class="gallery-des">
									<h3>Arcu pede</h3>
									</div>

								</div>
								<div class="back">
									<h4>Arcu pede</h4>
									<p>Tuna, Sweetcorn, Cheese</p>
									<h6>50<sup>$</sup></h6>
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="w3ls_item" value="Arcu pede">
										<input type="hidden" name="amount" value="50">
										<button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
										<span class="w3-agile-line"> </span>
										<a href="#" data-toggle="modal" data-target="#myModal1">Explore</a>
									</form>
								</div><!-- front-->
							</div><!--flipper agileproducts -->
						</div> <!--flip container-->
					</div>
					<div class="col-md-4 col-sm-4 product-grids">
						<div class="flip-container">
							<div class="flipper agile-products">
								<div class="front">
									<img src="menu/3.jpg" class="img-responsive" alt="img">

									<div class="gallery-des">
									<h3>Quam semper </h3>
									</div>

								</div>
								<div class="back" >
									<h4>Quam semper  </h4>
									<p>Cheese, tomato, mushrooms, onions.</p>
									<h6>25<sup>$</sup></h6>
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="w3ls_item" value="Quam semper">
										<input type="hidden" name="amount" value="25">
										<button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
										<span class="w3-agile-line"> </span>
										<a href="#" data-toggle="modal" data-target="#myModal1">Explore</a>
									</form>
								</div><!-- back-->
							</div><!--flipper agileproducts -->
						</div> <!--flip container-->
					</div>

					<br/><br/><br/><br/><div></div>
				</div> <!-- product rows -->

				<div class="products-row" >
					<div class="col-md-4 col-sm-4 product-grids">
						<div class="flip-container">
							<div class="flipper agile-products">
								<div class="front">
									<img src="menu/4.jpg" class="img-responsive" alt="img">
									<!--<div class="agile-product-text">
										<h5>Voluptate</h5>

									</div> -->

									<div class="gallery-des">
									<h3>Donec sodales</h3>
									</div>

								</div>
								<div class="back">
									<h4>Donec sodales</h4>
									<p>Double Cheese, onions.</p>
									<h6>70<sup>$</sup></h6>
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="w3ls_item" value="Donec sodales">
										<input type="hidden" name="amount" value="70">
										<button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
										<span class="w3-agile-line"> </span>
										<a href="#" data-toggle="modal" data-target="#myModal1">Explore</a>
									</form>
								</div><!-- front-->
							</div><!--flipper agileproducts -->
						</div> <!--flip container-->
					</div>
					<div class="col-md-4 col-sm-4 product-grids">
						<div class="flip-container">
							<div class="flipper agile-products">
								<div class="front">
									<img src="menu/5.jpg" class="img-responsive" alt="img">
									<!--<div class="agile-product-text">
										<h5>Voluptate</h5>
									</div> -->

									<div class="gallery-des">
									<h3>Nam eget</h3>
									</div>

								</div>
								<div class="back">
									<h4>Nam eget </h4>
									<p>Chicken, mozzarella cheese, onions.</p>
									<h6>50<sup>$</sup></h6>
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="w3ls_item" value="Nam eget">
										<input type="hidden" name="amount" value="50">
										<button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
										<span class="w3-agile-line"> </span>
										<a href="#" data-toggle="modal" data-target="#myModal1">Explore</a>
									</form>
								</div><!-- front-->
							</div><!--flipper agileproducts -->
						</div> <!--flip container-->
					</div>
					<div class="col-md-4 col-sm-4 product-grids">
						<div class="flip-container">
							<div class="flipper agile-products">
								<div class="front">
									<img src="menu/6.jpeg" class="img-responsive" alt="img">

									<div class="gallery-des">
									<h3>Metus varius</h3>
									</div>

								</div>
								<div class="back">
									<h4>Metus varius</h4>
									<p>Chicken, mozzarella cheese, onions.</p>
									<h6>50<sup>$</sup></h6>
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart">
										<input type="hidden" name="add" value="1">
										<input type="hidden" name="w3ls_item" value="Metus varius">
										<input type="hidden" name="amount" value="50">
										<button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
										<span class="w3-agile-line"> </span>
										<a href="#" data-toggle="modal" data-target="#myModal1">Explore</a>
									</form>
								</div><!-- back-->
							</div><!--flipper agileproducts -->
						</div> <!--flip container-->
					</div>


				</div> <!-- product rows -->
				<!-- -- >


</div>
</div> <!--row-->
</div> <!--container -->
</div><!--section-->



<!-- end menu -->

	<!-- start gallery -->
	<section id="gallery" class="templatemo-section templatemo-light-gray-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center text-uppercase">Gallery</h2>
					<hr>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="gallery-wrapper">
						<img src="images/gallery-img1.jpg" class="img-responsive gallery-img" alt="Pizza 1">
						<div class="gallery-des">
							<h3>Curabitur </h3>
							<h5>Cras in ante mattis, elementum nunc sed.</h5>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="gallery-wrapper">
						<img src="images/gallery-img2.jpg" class="img-responsive gallery-img" alt="Pizza 2">
						<div class="gallery-des">
							<h3>Lorem ipsum</h3>
							<h5>In ullamcorper gravida enim id pulvinar</h5>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="gallery-wrapper">
						<img src="images/gallery-img3.jpg" class="img-responsive gallery-img" alt="Pizza 3">
						<div class="gallery-des">
							<h3>Pellentesque</h3>
							<h5>Maecenas efficitur nisi id sapien</h5>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="gallery-wrapper">
						<img src="images/gallery-img4.jpg" class="img-responsive gallery-img" alt="Pizza 4">
						<div class="gallery-des">
							<h3>Suspendisse</h3>
							<h5>Mauris sit amet augue sit amet risus</h5>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="gallery-wrapper">
						<img src="images/gallery-img5.jpg" class="img-responsive gallery-img" alt="Pizza 5">
						<div class="gallery-des">
							<h3>Elementum</h3>
							<h5>Maecenas efficitur nisi id sapien</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end gallery -->


	<!-- start contact -->
	<section id="contact" class="templatemo-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-uppercase text-center">Contact Us</h2>
					<hr>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<form action="#" method="post" role="form">
						<div class="col-md-6 col-sm-6">
							<input name="name" type="text" class="form-control" id="name" maxlength="60" placeholder="Name">
					    	<input name="email" type="email" class="form-control" id="email" placeholder="Email">
							<input name="message" type="text" class="form-control" id="message" placeholder="Subject">
						</div>
						<div class="col-md-6 col-sm-6">
							<textarea class="form-control" rows="5" placeholder="Message"></textarea>
						</div>
						<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
							<input name="submit" type="submit" class="form-control" id="submit" value="Send">
						</div>
					</form>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-4 col-sm-4">
					<h3 class="padding-bottom-10 text-uppercase">Visit our shop</h3>
					<p><i class="fa fa-map-marker contact-fa"></i> 63 Another Walking Street, BKK 18080</p>
					<p>
						<i class="fa fa-phone contact-fa"></i>
						<a href="tel:010-020-0340" class="contact-link">010-020-0340</a>,
						<a href="tel:080-090-0660" class="contact-link">080-090-0660</a>
					</p>
					<p><i class="fa fa-envelope-o contact-fa"></i>
                    	<a href="mailto:hello@company.com" class="contact-link">hello@company.com</a></p>
				</div>
				<div class="col-md-4 col-sm-4">
					<h3 class="text-uppercase">Opening hours</h3>
					<p><i class="fa fa-clock-o contact-fa"></i> 7:00 AM - 11:00 PM</p>
					<p><i class="fa fa-bell-o contact-fa"></i> Monday to Friday and Sunday</p>
                    <p><i class="fa fa-download contact-fa"></i>
                    	<a class="contact-link" rel="nofollow"
                        	href="http://fontawesome.io/icons/" target="_blank">Change Icons</a></p>
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

	<?php if(!isset($_SESSION["logged"])) { ?>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																		</button>

																	 <h4 class="modal-title" id="myModalLabel">Login form</h4>
																	 <?php if(isset($error) AND $error) { ?>
																	 <div id="error" class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>
																 <?php } ?>
															</div><!--ending modal header-->


						<div class="modal-body">
																		<form method="post" action="." id="loginform">
																				<div class="form-group">
																						<label for="username">Username</label>
									<div class="input-group pb-modalreglog-input-group">
										<input id="username" class="form-control"  type="text" name="username" placeholder="Username" value="<?php if(isset($error) AND $error) {echo $username;} ?>" />
																									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									</div>
										</div>


								<div class="form-group">
																							<label for="password">Password</label>
																							<div class="input-group pb-modalreglog-input-group">
																									<input type="password" name="pass" class="form-control" id="pws" placeholder="Password">
																									<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
																						</div>
																				</div>


					<a  href="forget.php" target="_blank">Forgot Password? </a>
					</br></br>
					<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-warning">Log in</button>
														</div> <!-- ending modal-footer -->


																		</form>`

														</div><!-- modal-body-->



<!--login form ends-->
											</div><!--modal-content-->


							</div><!-- modal-dialog -->
					</div>

					<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Registration form</h4>
														<?php if(isset($signup_error)) { ?>
														<div id="error" class="alert alert-danger" role="alert"><?php echo $signup_error["error_msg"] ?></div>
													<?php } ?>
                        </div><!--modal header-->
                        <div class="modal-body">

				<!--form for registration -->
                            <form class="pb-modalreglog-form-reg" method="post" action="process.php" onsubmit="return Validation();">
				<div class="form-group">
                                   	<label for="username">Username</label>
 					<div class="input-group pb-modalreglog-input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input id="username" class="form-control"  type="text" name="username" placeholder="Username" value="<?php if(isset($signup_error)) { echo $signup_error['username']; } ?>" required/>
                                        </div>
    				</div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?php if(isset($signup_error)) { echo $signup_error['email']; } ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="password" class="form-control" id="pass" placeholder="Password" name="password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirmpassword">Confirm password</label>
                                    <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="password" class="form-control" id="confirmpass" placeholder="Confirm Password" required>
                                    </div>
                                </div>
				<div class="form-group">
					<label for = "phoneno">Contact Number</label><br />
 					<div class="input-group pb-modalreglog-input-group">
                                        	<span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
						 <input type = "text" class="form-control" name = "phoneno" id="phoneno" maxlength = "10" placeholder = "Enter a valid phone number" pattern = "[0-9]{10}" value="<?php if(isset($signup_error)) { echo $signup_error['phoneno']; } ?>">
       					</div>
				</div>

                                <div class="form-group">
                                    <input type="checkbox" id="ch" name="chs" required>
                                    I agree with <a href="#" style="color:orange">terms and conditions.</a>
                                </div>
				<div class="modal-footer">
                            		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            		<button type="submit" class="btn btn-warning">Sign up</button>
                        	</div>
                            </form>
				<!-- form registration ended-->
                        </div><!--modal-content -->

                    </div><!-- "modal-dialog -->
                </div><!-- modal fade -->
            </div>

					<?php } else { ?>

						<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
								<div class="modal-dialog" role="document">
								<div class="modal-content">
											<div class="modal-header">
												<h3><?php echo $_SESSION["logged"]["username"]."'s account"; ?>
													<button type="button" class="btn btn-default btn-sm pull-right" onclick="editme(); "><span class="glyphicon glyphicon-pencil"></span></button>
												</h3>
												<?php if(isset($pop_profile)) { ?>
												<div id="error" class="alert alert-success" role="alert"><?php echo $pop_profile ?></div>
											<?php } ?>
											</div>

											<div class="modal-body">
												<form action = "update.php" method="post" id="editform">

												<table class="table">
											    <tbody>
											      <tr>
											        <td>Username: </td>
											        <td><input class="readonly" name="edit_username" id="edit_username" value="<?php echo $_SESSION["logged"]["username"]; ?>" readonly></td>

											      </tr>
											      <tr>
											        <td>Email ID: </td>
											        <td><input class="readonly" name="edit_email" id="edit_email" value="<?php echo $_SESSION["logged"]["email"]; ?>" readonly></td>
											      </tr>
														<tr>
											        <td>Password: </td>
											        <td><input class="readonly" name="edit_password" id="edit_password" value="<?php echo $_SESSION["logged"]["password"]; ?>" readonly></td>

											      </tr>
											      <tr>
											        <td>Phone No.:</td>
											        <td><input class="readonly" name="edit_phoneno" id="edit_phoneno" value="<?php echo $_SESSION["logged"]["phoneno"]; ?>" readonly></td>
											      </tr>

											    </tbody>
											  </table>
												<div class="modal-footer">
														<a href="change_password.php" class="btn btn-warning "><span class="glyphicon glyphicon-edit"></span>Change Password</a>
								            <button type="submit" class="btn btn-warning hidden">Update Details</button>
								        </div>
											</form>
												<form method="post" action=".">
												<input type="hidden" value="logout" name="logout">
												<button type="submit" class="btn btn-warning">Log Out</button>
												<button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
											</form>
											</div>
								</div>
								</div>
							</div>

						<?php } ?>

<?php if (isset($show_login) AND $show_login = True) { echo "<script type='text/javascript'>$('#myModal').modal('show');</script>"; } ?>
<?php if (isset($signup_error)) {echo "<script type='text/javascript'>$('#myModal2').modal('show');</script>"; } ?>
<?php if (isset($pop_profile)) {echo "<script type='text/javascript'>$('#userModal').modal('show');</script>"; } ?>
	<!-- modals end -->
	<!-- start footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>Copyright &copy; 2084 Company Name</p>
					<hr>
					<ul class="social-icon">
						<li><a href="#" class="fa fa-facebook"></a></li>
						<li><a href="#" class="fa fa-twitter"></a></li>
						<li><a href="#" class="fa fa-instagram"></a></li>
						<li><a href="#" class="fa fa-pinterest"></a></li>
						<li><a href="#" class="fa fa-google"></a></li>
						<li><a href="#" class="fa fa-github"></a></li>
						<li><a href="#" class="fa fa-apple"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- end footer -->


	<script src="js/plugins.js"></script>
	
	<script src="js/custom.js"></script>

	<script>
	function editme() {

		var input = $('#editform input');
		input.toggleClass('readonly');
		input.toggleClass('form-control');
		console.log(input.prop("readonly"));
		input.attr('readonly', input.prop('readonly') == false ? true : false);
		$('#editform button').toggleClass("hidden");


	}
	function Validation()
	{
	 var email = document.getElementById('inputEmail');
	 var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		if (!filter.test(email.value)) {
			alert('Please provide a valid email address');
			email.focus;
		return false;
	}
	var pswd=document.getElementById('pass');
	var cpswd=document.getElementById('confirmpass');

	if(pswd.value!=cpswd.value){
		alert("password does not match"); cpswd.focus; return false;}

			var phone = document.getElementById('phoneno');
		 var phoneNum = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
					if(phone.value.match(phoneNum)) {
							return true;
					}
					else {
							alert('Please provide a valid phone number');
				phone.focus;
			return false;
					}
	}
	</script>


<!-- cart-js -->
	<script src="js/minicart.js"></script>
	<script>
        w3ls.render();

        w3ls.cart.on('w3sb_checkout', function (evt) {
        	var items, len, i;

        	if (this.subtotal() > 0) {
        		items = this.items();

        		for (i = 0, len = items.length; i < len; i++) {
        		}
        	}
        });

    </script>  
	<!-- //cart-js --> 
	

   

</body>
</html>
