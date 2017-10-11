<?php include("header.php"); ?>
<script>
$(document).ready(function(){
    $(".panel").on('keyup change click', function(){
        txt = $("input").val();
        search_by = $("option:selected").val().toLowerCase();
        $("#accordion").load("data.php", {suggest: txt, search_by});
    });
});
</script>
</head>
<body>

<div class="container pb-modalreglog-container">


  <div class="panel panel-default">
    <div class="panel-heading"><h3>Users</h3></div>
    <div class="form-group">
    <br>
      <div class="input-group pb-modalreglog-input-group col-sm-5">
        <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
        <input type="text" name="search_text" class="form-control" placeholder="Search">

      </div>

    </div>

    <div class="form-group">
     <div class="input-group pb-modalreglog-input-group col-sm-5">
      <label for="sel1">Search By:</label>
        <select class="form-control" id="sel1">
          <option>Username</option>
          <option>Email</option>
          <option>Address</option>
        </select>
      </div>
    </div>


      <div class="panel-body" id="accordion">


      </div>

    </div>
  </div>


</body>
</html>
