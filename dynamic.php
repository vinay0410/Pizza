<?php include("header.php"); ?>
<script>
$(document).ready(function(){
    $("input").on('keyup change', function(){
        txt = $("input").val();
        search_by = $("input:radio:checked").val();
        $("#accordion").load("data.php", {suggest: txt, search_by});
    });
});
</script>
</head>
<body>

<div class="container pb-modalreglog-container">


  <div class="panel panel-default">
    <div class="panel-heading"><h3>Outlets</h3></div>
    <input type="text">
    <input type="radio" name="search" value="username" checked>Username<br>
    <input type="radio" name="search" value="email">Email<br>
    <input type="radio" name="search" value="address">Address

      <div class="panel-body" id="accordion">


      </div>

    </div>
  </div>


</body>
</html>
