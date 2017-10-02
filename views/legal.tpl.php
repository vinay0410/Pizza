<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cloud Notepad</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->    
  </head>
  <body>
  
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h4 class="pull-left">Legal Notice</h4>
      </div>
    </div>  

    <div class="container">
      <p>This application is intended for demonstration purposes only and is provided without any warranties or safeguards. Users are hereby warned that they should not store any sensitive or confidential information within it. The application author takes no responsibility or liability for any data loss arising from usage of this application.</p>
      <p>By using this application, you agree to defend, indemnify and hold harmless the application author, from and against all costs, charges and expenses (including attorneys' fees) arising from any third party claim, action, suit, or proceeding against any action by a third party against the application author.</p>
    </div>

    
    <div class="container">
      <p class="text-center">
        <a href="<?php echo $this->data['baseUri']; ?>/" role="button" class="btn btn-default btn-sm">Home</a>
      </p>
    </div> 
  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>