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
        <h4 class="pull-left">Notes</h4>
        <div class="btn-group pull-right">
            <a role="button" class="btn btn-primary" href="<?php echo $this->data['baseUri']; ?>/index">List</a>
        </div>
      </div>
    </div>  

    <div class="panel panel-default">
      <div class="panel-heading">
        <strong><?php echo htmlspecialchars($this->data['note']['title']); ?></strong>
        <span class="label label-primary pull-right" style="background: <?php echo htmlspecialchars($this->data['note']['color']); ?>">&nbsp;</span>
      </div>
      <div class="panel-body">
        <?php echo nl2br($this->data['note']['body']); ?>
        <hr/>
        <a href="<?php echo $this->data['baseUri']; ?>/save/<?php echo htmlspecialchars($this->data['note']['_id']); ?>" role="button" class="btn btn-primary" style="background: <?php echo htmlspecialchars($this->data['note']['color']); ?>">Edit</a>
        <a href="<?php echo $this->data['baseUri']; ?>/delete/<?php echo htmlspecialchars($this->data['note']['_id']); ?>" role="button" class="btn btn-primary pull-right" style="background: <?php echo htmlspecialchars($this->data['note']['color']); ?>">Delete</a> 
        </div>
    </div>
    
    <div class="container">
      <p class="text-center">
        <a href="<?php echo $this->data['baseUri']; ?>/legal" role="button" class="btn btn-default btn-sm">Legal</a>
      </p>
    </div>
  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>