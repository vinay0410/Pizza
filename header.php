<!DOCTYPE html>
<html lang="en">
<head>

<?php
session_start();

if(isset($_SESSION["pop_login"])) {
	$pop_login = $_SESSION["pop_login"];
	unset($_SESSION["pop_login"]);
}

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
	echo "<script type='text/javascript'>alert('LogOut Successful')</script>";
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


	<!-- start navigation -->
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
				</button>
				<a href="<?php if (basename($_SERVER['PHP_SELF']) == "index.php") { echo "#home"; } else {echo "."; } ?>" class="navbar-brand smoothScroll"><strong>PIZZA Villa</strong></a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php if (basename($_SERVER['PHP_SELF']) == 'index.php') { echo '#home'; } else {echo '.'; } ?>" class="smoothScroll">HOME</a></li>
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
