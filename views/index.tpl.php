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
          <a role="button" class="btn btn-primary" href="<?php echo $this->data['baseUri']; ?>/save">Add</a>
        </div>
      </div>
    </div>  

    <div class="panel panel-default">
      <form method="get" action="<?php echo $this->data['baseUri']; ?>/index">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default">Go!</button>
          </span>
        </div>  
      </form>
    </div>  
    
    <ul class="list-group">
      <?php foreach ($this->data['notes'] as $n): ?>
      <li class="list-group-item">
        <?php echo htmlspecialchars($n['title']); ?> 
        <span class="label label-primary pull-right" style="background: <?php echo $n['color']; ?>">&nbsp;</span><br/> 
        <small>Last edited: <?php echo htmlspecialchars(date('d M Y h:i', $n['updated'])); ?></small><br/>
        <a href="<?php echo $this->data['baseUri']; ?>/view/<?php echo htmlspecialchars($n['_id']); ?>" role="button" class="btn btn-primary" style="background: <?php echo $n['color']; ?>">View</a>
        <a href="<?php echo $this->data['baseUri']; ?>/delete/<?php echo htmlspecialchars($n['_id']); ?>" role="button" class="btn btn-primary pull-right" style="background: <?php echo $n['color']; ?>">Delete</a>      
      </li>
      <?php endforeach; ?>
    </ul>
    
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