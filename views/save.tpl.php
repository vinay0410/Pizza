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

    <form method="post" action="<?php echo $this->data['baseUri']; ?>/save">
      <input name="id" type="hidden" value="<?php echo $this->data['note']['_id']; ?>" />
      <div class="form-group">
        <label for="title">Title</label>
        <input type="title" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo htmlspecialchars($this->data['note']['title']); ?>">
      </div>
      <div class="form-group">
        <label for="color">Color</label>
        <input type="color" class="form-control" id="color" name="color" placeholder="Color" value="<?php echo$this->data['note']['color']; ?>">
      </div>
      <div class="form-group">
        <label for="body">Content</label>
        <textarea name="body" id="body" class="form-control" rows="3"><?php echo htmlspecialchars($this->data['note']['body']); ?></textarea>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-default">Save</button>
      </div>
    </form>    
    
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