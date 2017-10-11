<?php


  $q = $_POST["suggest"];
  $search_by = $_POST["search_by"];
  //;var_dump($_POST);

  $m = new MongoClient("mongodb://admin:EIIGMGVVORZLANRD@sl-eu-lon-2-portal.5.dblayer.com:20539,sl-eu-lon-2-portal.0.dblayer.com:20539/admin?ssl=true");
  $db = $m->Pizza;
  $collection = $db->users;

  $result = $collection->find(array($search_by => new MongoRegex("/$q/i")));
?>


<div class="panel list-group">

<?php
      if ($result->count() != 0 AND !empty($q)) {
      foreach ($result as $row) { ?>

    <a class="list-group-item" data-toggle="collapse" data-target="<?php echo "#".$row['_id']; ?>" data-parent="#accordion">
      <h4 class="list-group-item-heading accordion-toggle">
        <?php echo $row["username"]; ?>
        <button type="button" class="btn btn-danger btn-space pull-right" onclick="deleteOutlet(this);"><span class="glyphicon glyphicon-remove"></span> </button>

      </h4>
        <?php echo '<p>'.$row['email'].'</p>'; ?>
    </a>
    <div id="<?php echo $row['_id']; ?>" class="sublinks collapse">
      some data
    </div>

<?php
  }
} else {
  echo '<p>No Suggestions</p>';
}
 ?>
 </div>
