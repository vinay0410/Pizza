<html>
<head>
	
 <meta charset="utf-8" />
    
   <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script>

function checkEmail() {

    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
    alert('Please provide a valid email address');
    email.focus;
    return false;
 }
}
</script>
<style>


.error {color: #FF0000;}
.form
{
 margin-top: 100px;
}
.fp{
color: orange;
}

</style>
</head>
<body>

		
<div class="container pb-modalreglog-container">
    	<div class="row">
    		    <div class="col-xs-12 col-md-4 col-md-offset-4">	
			<div class="form" >
			<legend class="fp">Forgot Password</legend>
			<fieldset>
			<form method="post" action="index.php">

					<div class="form-group">
                                   		 <label for="email">Email address</label>
                                    		<div class="input-group pb-modalreglog-input-group">   
                                        		<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                        		<input type="email" class="form-control" name="email" placeholder="Email">
							
                                 		</div>

                                	</div>

			
			<input type="submit" class="btn btn-warning" name="submit" value="Submit" onclick='Javascript:checkEmail();'/>
			</form></fieldset>
			</div>



</div></div></div>		


</body>
</html>
