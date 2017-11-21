<?php include("header.php"); ?>


<?php

    if (isset($_POST["deleteOutlet"])) {
        $outlet_id = $_POST["deleteOutlet"];
        echo $outlet_id;
        try {
            $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
            $db = $m->pizza;
            $collection_outlet = $db->outlets;
            $collection_user = $db->users;
        } catch (Exception $e) {



            $error_del_msg = "Couldn't Connect to Database, Please try again";
        }

        if (empty($error_msg)) {
            $result_outlet = $collection_outlet->findOne(array('_id' => new MongoDB\BSON\ObjectID($outlet_id)));

            $result = $collection_outlet->deleteOne(array('_id' => new MongoDB\BSON\ObjectID($outlet_id)));
            $result = $collection_user->deleteOne(array('_id' => new MongoDB\BSON\ObjectID($result_outlet["supervisor_id"])));
            $success = "Outlet Deleted Successfully";
        }
    }


    if (isset($_POST["outlet"])) {
        $outlet = $_POST["outlet"];
        $outlet_addr = $_POST["outlet-addr"];
        $supervisor_fname = $_POST["sup-fname"];
        $supervisor_lname = $_POST["sup-lname"];
        $supervisor_email = $_POST["sup-email"];
        $supervisor_pass = $_POST["password"];
        $coord = [(float)$_POST['long'], (float)$_POST['lat']];
        $supervisor_phone = $_POST["sup-phone"];

        try {
            $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
            $db = $m->pizza;
            $collection = $db->outlets;
        } catch (Exception $e) {
            #die("Caught Exception failed to Connect".$e->getMessage()."\n");


            $error_msg = "Couldn't Connect to Database";
        }

        if (empty($error_msg)) {
            $result = $collection->findOne(array('outlet' => $outlet));
            #var_dump($result);

            if (empty($result)) {
              $collection = $db->users;
              $result_email = $collection->findOne(['email' => $supervisor_email]);

              if (empty($result_email)) {

                  $document = array(
              "fname" => $supervisor_fname,
              "lname" => $supervisor_lname,
              "email" => $supervisor_email,
              "address" => array(),
              "password" => $supervisor_pass,
              "phoneno" => $supervisor_phone,
              "role" => "supervisor"

           );

                  $supervisor_id = $collection->insertOne($document)->getInsertedId();
                  echo "Document Inserted Successfully";
                  var_dump($supervisor_id);


                  $document = array(
                                   "outlet" => $outlet,
                                   "outlet_addr" => $outlet_addr,
                                   "coord" => $coord,
                                   "supervisor_id" => new MongoDB\BSON\ObjectID($supervisor_id)
                                );

                  $collection = $db->outlets;
                  $outlet_id = $collection->insertOne($document)->getInsertedId();
                  $collection = $db->users;
                  $collection->updateOne(["_id" => new MongoDB\BSON\ObjectID($supervisor_id)], [ '$set' => ['ofOutlet' => new MongoDB\BSON\ObjectID($outlet_id)] ]);
                  $success = "Outlet added successfully!";

              }  else {
                  $error_msg = "Email Address Already Exists";

              }


            } else {
                $error_msg = "Outlet Already Exists";
            }
        }
    } elseif (isset($_POST["outlet-edit"])) {

        $id = $_POST["doc-id"];
        $outlet = $_POST["outlet-edit"];
        $outlet_addr = $_POST["outlet-addr"];
        $coord = [(float)$_POST['long'], (float)$_POST['lat']];

        $supervisor_fname = $_POST["sup-fname"];
        $supervisor_lname = $_POST["sup-lname"];
        $supervisor_email = $_POST["sup-email"];
        $supervisor_pass = $_POST["password"];
        $coord = [(float)$_POST['long'], (float)$_POST['lat']];
        $supervisor_phone = $_POST["sup-phone"];



        try {
            $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
            $db = $m->pizza;
            $collection = $db->outlets;
        } catch (Exception $e) {
            #die("Caught Exception failed to Connect".$e->getMessage()."\n");


            $error_edit_msg = "Couldn't Connect to Database";
        }

        if (empty($error_edit_msg)) {

            $result = $collection->findOne( ['_id' => new MongoDB\BSON\ObjectID($id)] );

            if (($result["outlet"] == $outlet) OR (!$collection->findOne(['outlet' => $outlet]))) {
              $collection_user = $db->users;
              $user = $collection_user->findOne( ['_id' => new MongoDB\BSON\ObjectID($result["supervisor_id"])] );

              if (($user["email"] == $supervisor_email) OR (!$collection_user->findOne(['email' => $supervisor_email]))) {

                  $document = array(
              "fname" => $supervisor_fname,
              "lname" => $supervisor_lname,
              "email" => $supervisor_email,
              "address" => array(),
              "password" => $supervisor_pass,
              "phoneno" => $supervisor_phone,
              "role" => "supervisor"

           );

                  $collection_user->updateOne(['_id' => new MongoDB\BSON\ObjectID($user["_id"])], ['$set' => $document]);
                  echo "Document Inserted Successfully";



                  $document = array(
                                   "outlet" => $outlet,
                                   "outlet_addr" => $outlet_addr,
                                   "coord" => $coord,
                                   "supervisor_id" => new MongoDB\BSON\ObjectID($user["_id"])
                                );


                  $collection->updateOne([ "_id" => new MongoDB\BSON\ObjectID($id) ], ['$set' => $document]);

                  $collection_user->updateOne(["_id" => new MongoDB\BSON\ObjectID($user["_id"])], [ '$set' => ['ofOutlet' => new MongoDB\BSON\ObjectID($id)] ]);
                  $success = "Outlet Updated successfully!";

              }  else {
                  $error_msg = "Email Address Already Exists";

              }


            } else {
                $error_edit_msg = "Outlet Name already Exists";
            }
        }
    }


    try {
        $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
        $db = $m->pizza;
        $collection = $db->outlets;

    } catch (Exception $e) {
        //die("Caught Exception failed to Connect".$e->getMessage()."\n");


        $error_outlet_msg = "Couldn't Load Outlets, Connection Failed!";
    }

    if (empty($error_outlet_msg)) {
        $outlet_cursor = $collection->aggregate([ ['$lookup' => ['from' => "users", "localField" => "supervisor_id", "foreignField" => "_id", "as" => "supervisor"]]]);
        $outlet_count = $collection->count();
    }


$outlet_array = array();

?>





<div class="container pb-modalreglog-container">



<div class="panel panel-default">
      <div class="panel-heading"><h3>Outlets
				<button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#outletModal" name="add_modal"><span class="glyphicon glyphicon-plus"></span>Add Outlet</button>
			</h3>
			<?php if (isset($error_del_msg)) {
    ?>
			<div id="error" class="alert alert-danger" role="alert"><?php echo $error_del_msg; ?></div>
		<?php
} ?>
		<?php if (isset($error_outlet_msg)) {
        ?>
		<div id="error" class="alert alert-danger" role="alert"><?php echo $error_outlet_msg; ?></div>
	<?php
    } ?>
			<?php if (isset($success)) {
        ?>
			<div id="error" class="alert alert-success" role="alert"><?php echo $success; ?></div>
		<?php
    } ?>

			</div>
      <div class="panel-body" id="accordion">

				<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" type="hidden" id="deleteOutlet">
					<input type="hidden" name="deleteOutlet">
				</form>

				<div class="panel list-group">

					<?php
                    if (isset($outlet_count) or isset($outlet_cursor)) {
                        if ($outlet_count == 0 && empty($error_outlet_msg)) {
                            echo '<p>Oh, Your chain has no Outlets yet!</p>';
                        } else {
                            $index = 0;
                            foreach ($outlet_cursor as $document) {
                                //var_dump($document["supervisor"][0]);
                                array_push($outlet_array, $document); ?>

						<a class="list-group-item" data-toggle="collapse" data-target="<?php echo "#".$document['_id']; ?>" data-parent="#accordion">
			    		<h4 class="list-group-item-heading accordion-toggle"><?php echo $document['outlet']?>
								<button type="button" class="btn btn-danger btn-space pull-right" id="<?php echo $index; ?>" onclick="deleteOutlet(this);"><span class="glyphicon glyphicon-remove"></span> </button>
								<button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" data-toggle="modal" data-target="#outletEditModal" onclick="putContents(this); " id="<?php echo $index; ?>" ><span class="glyphicon glyphicon-pencil"></span> </button>
							</h4>
			    		<p class="list-group-item-text"><?php echo $document['outlet_addr']?></p>
		  			</a>
						<div id="<?php echo $document['_id']; ?>" class="sublinks collapse">
					   <a class="list-group-item"><?php echo "Supervisor's Name: " . $document["supervisor"][0]["fname"] . " " . $document["supervisor"][0]["lname"] ?></a>
					   <a class="list-group-item"><?php echo "Supervisor's EmailID: ".$document["supervisor"][0]["email"] ?></a>
						 <a class="list-group-item"><?php echo "Supervisor's PhoneNo: ".$document["supervisor"][0]["phoneno"] ?></a>
					  </div>

					<?php
                    $index++;
                            }
                        }
                    }?>



				</div>
			</div>

</div>


<div class="panel panel-default" id="user_div">
  <div class="panel-heading"><h3>Users</h3></div>
  <div class="panel-body">
  <div class="form-group user-group">
  <br>
    <div class="input-group pb-modalreglog-input-group col-sm-5">
      <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
      <input type="text" name="search_text" id="user_search" class="form-control" placeholder="Search">

    </div>

  </div>

  <div class="form-group user-group">
   <div class="input-group pb-modalreglog-input-group col-sm-5">
    <label for="sel1">Search By:</label>
      <select class="form-control" id="sel1">
        <option>First Name</option>
        <option>Last Name</option>
        <option>Email</option>
        <option>Address</option>
      </select>
    </div>
  </div>


    <div id="accordion_users" style="display: none;">


    </div>
    <div class="user-loader loader col-xs-6 col-xs-offset-5" style="display: none;">
   </div>

  </div>

  </div>




  <div class="panel panel-default">
    <div class="panel-heading"><h3>Menu
      <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#itemModal" name="add_modal"><span class="glyphicon glyphicon-plus"></span>Add Item</button>
    </h3></div>
    <div class="panel-body">
      <ul class="nav nav-tabs menu-tabs">
        <li class="active"><a data-toggle="tab" href="#pizzas" div-toggle="pizzas" onclick="load_menu(this)">Pizzas</a></li>
        <li><a data-toggle="tab" href="#sides" div-toggle="sides" onclick="load_menu(this)">Sides</a></li>
        <li><a data-toggle="tab" href="#beverages" div-toggle="beverages" onclick="load_menu(this)">Beverages</a></li>
      </ul>

      <div class="tab-content">
        <div id="pizzas" class="tab-pane fade in active">

        </div>
        <div id="sides" class="tab-pane fade">

        </div>
        <div id="beverages" class="tab-pane fade">

        </div>
      </div>



      <div class="menu-loader loader col-xs-6 col-xs-offset-5" style="display: none;"></div>

    </div>


    </div>


</div>





<script src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>





<script type="text/javascript">


var currentRequest = null;
$(document).ready(function(){

    $(".user-group").on('keyup change blur', function(){
        txt = $("#user_search").val();
        search_by = $("option:selected").val().toLowerCase();
        if (txt) {
        console.log(txt);
        console.log(search_by);
        currentRequest = $.ajax({
    data: {suggest: txt, search_by: search_by},
    url: 'data.php',
    beforeSend : function()    {
        if(currentRequest != null) {
            currentRequest.abort();
        }
        $("#accordion_users").slideUp("slow");
        $(".user-loader").show();
    },
    success: function(result) {
        $("#accordion_users").html(result);
        $(".user-loader").hide();
        $("#accordion_users").slideDown("slow");
    },
    error:function(e){
      if (currentRequest == null) {
      $(".user-loader").hide();
      alert("Error Loading data");
    }
    }
    });
  } else {
    console.log("empty");
    currentRequest.abort();
    $("#accordion_users").slideUp("slow");
    $(".user-loader").hide();
  }
  });
});





var currentRequestMenu = null;

function load_menu(category) {
  var tab = $(category).attr("div-toggle");
  console.log(tab);

  if (!$("#" + tab).hasClass("loaded")) {
    var loader_clone = $(".menu-loader").clone().css("display", "block").removeClass("menu-loader");
  $.ajax({
  data: {admin: "True", category: tab},
  url: 'menu.php',
  beforeSend : function()    {

      $("#" + tab).html(loader_clone);

  },
  success: function(result) {
      $("#" + tab).slideUp("slow");
      $("#" + tab).html(result);

      $("#" + tab).slideDown("slow", function() {$(this).css('display', '');});
      $("#" + tab).addClass("loaded");
  },
  error:function(e){
    if (currentRequestMenu == null) {
    $(".menu-loader").hide();
    alert("Error Loading data");
  }
  }
  });
}
}

$(document).ready(function() {$(".menu-tabs .active a").click();});


function editable(el) {
  var parent = $(el).parent();
  var form = $(document).find("#back-edit-form");
  $(form).find("form input[name=item_id]").val($(parent).find("input[name=item_id]").val());
  $(form).find("form input[name=name]").val($(parent).find("h4").text());
  $(form).find("form input[name=ingredients]").val($(parent).find("p").text());
  $(form).find("form input[name=price]").val($(parent).find("h6").clone().children().remove().end().text());
  $(parent).after(form.clone().fadeIn());

}

function update(el) {

    console.log("hi");
    var formData = new FormData($(el).parent()[0]);
    console.log(formData);
    var div = $(el).parent().parent().parent().parent();
    var copy_div = div.clone();
    var loader = $(document).find(".menu-loader").clone();
    console.log(loader);
    $(div).html(loader.css("display", "block"));
      $.ajax({
        url: "edit_item.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data) {
          try {
          var value = JSON.parse(data);
          $(copy_div).prepend("<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + value.msg + "</div>");
          console.log(copy_div);
          $(div).html(copy_div.children());
        } catch (e) {
            $(div).html(data);
            console.log(e);
          }
        }
    });
  }


  function delete_item(el) {

      console.log("hi");

      var item_id = $(el).parent().find("#item_id").val();
      console.log(item_id);
      var div = $(el).parent().parent().parent().parent();
      var copy_div = div.clone();
      var loader = $(document).find(".menu-loader");
      console.log(loader);
      $(div).html(loader.clone().css("display", "block"));
        $.ajax({
          url: "item_delete.php", // Url to which the request is send
          type: "POST",             // Type of request to be send, called as method
          data: {id :item_id},
          success: function(data) {
            try {
            var value = JSON.parse(data);
            $(copy_div).prepend("<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + value.msg + "</div>");
            console.log(copy_div);
            $(div).html(copy_div.children());
          } catch (e) {

            $(div).html(data);
            setTimeout(function(){
              $(div).slideUp("slow");

             }, 3000);
           }
          }
      });
    }

$(document).ready(function() {
  $("#itemform").on("submit", function(e) {
    e.preventDefault();

    var category = $(this).find("input[name=type]:checked").val();
    var formData = new FormData(this);
    console.log(formData);
    $("#itemModal").modal('toggle');
    //e.stopPropagation();
    var new_div = $("<div class='col-md-4 col-sm-4 product-grids'><div class='menu-loader loader col-xs-6 col-xs-offset-5'></div></div>");
    $.ajax({
      url: "add_item.php", // Url to which the request is send
      type: "POST",             // Type of request to be send, called as method
      data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
      contentType: false,       // The content type used when sending data to the server.
      cache: false,             // To unable request pages to be cached
      processData:false,
      beforeSend : function()    {
        console.log($('.menu').children().eq(1));


          $(".menu-tabs li a[href='#" + category + "']").tab("show");
          $('#' + category).children().eq(1).prepend(new_div);


      },
      success: function(data) {
        try {
        var value = JSON.parse(data);
        $(new_div).html("<div class='alert alert-danger fade in'>" + value.msg + "</div>");
        setTimeout(function(){
          $(new_div).slideUp("slow");

        }, 4000);
      } catch (e) {
        $("#itemform")[0].reset();
        console.log(data);
        $(new_div).html(data).fadeIn("slow");
        }

      }
  });

});
});



<?php if (isset($open_edited)) { ?>

  $("#<?php echo $open_edited; ?>").prev().click();
<?php } else { ?>
  $("#accordion .list-group .list-group-item:first-child").click();

<?php } ?>
  var complex = <?php echo json_encode($outlet_array); ?>;




</script>



<!-- Edit Modal Start -->

<div id="outletEditModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_heading">Edit Outlet</h4>

				<?php if (isset($error_edit_msg)) {
                        ?>
				<div id="error" class="alert alert-danger" role="alert"><?php echo $error_edit_msg; ?></div>
			<?php
                    } ?>
      </div>
      <div class="modal-body">
				<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit="return verify_outlet(this);">
					<input type="hidden" id="doc-id" name="doc-id">
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="outlet">Unique Outlet Name: </label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" name="outlet-edit" id="outlet" placeholder="Unique NickName" value="<?php if (isset($error_edit_msg)) {
                        echo $outlet;
                    } ?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="outlet-addr">Outlet Address</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="outlet-edit-addr" name="outlet-addr" placeholder="Enter Outlet Address" value="<?php if (isset($error_edit_msg)) {
                        echo $outlet_addr;
                    } ?>">
                    <div>
                      <label for="lat" class="control-label col-sm-2"> Lat: </label>
                      <input name="lat" type="text" id="lat-edit" class="col-sm-4" readonly="readonly">
                      <label for="long" class="control-label col-sm-2"> Long: </label>
                      <input name="long" type="text" id="long-edit" class="col-sm-4" readonly="readonly">
                    </div>
				      <input id="map-submit-edit" type="button" class="btn btn-default" value="See on Map & Drag">
				      <div id="map-edit" style="width: 400px; height: 400px;"></div>
				    </div>
				  </div>
          <div class="row">
				  <div class="form-group col-xs-6">
				    <label class="control-label col-sm-5" for="supervisor-fname">Supervisor's First Name: </label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="supervisor-fname" name="sup-fname" placeholder="First name" value="<?php if (isset($error_msg)) {
                        echo $supervisor_fname;
                    } ?>">
				    </div>
          </div>
            <div class="form-group col-xs-6">
  				    <label class="control-label col-sm-5" for="supervisor-lname">Supervisor's Last Name: </label>
  				    <div class="col-sm-7">
  				      <input type="text" class="form-control" id="supervisor-lname" name="sup-lname" placeholder="Last name" value="<?php if (isset($error_msg)) {
                          echo $supervisor_lname;
                      } ?>">
  				    </div>
				  </div>
        </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-email">Supervisor Email: </label>
				    <div class="col-sm-5">
				      <input type="email" class="form-control" id="supervisor-email" name="sup-email" placeholder="Supervisor's email" value="<?php if (isset($error_edit_msg)) {
                        echo $supervisor_email;
                    } ?>">
				    </div>
				  </div>
          <div class="form-group">
				    <label class="control-label col-sm-2" for="password">Password: </label>
				    <div class="col-sm-5">
				      <input type="password" class="form-control" id="pass" placeholder="Password" name="password" required>
				    </div>
				  </div>
          <div class="form-group">
				    <label class="control-label col-sm-2" for="confirmpass">Confirm Password: </label>
				    <div class="col-sm-5">
				      <input type="password" class="form-control" id="confirmpass" placeholder="Confirm Password" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-phone">Supervisor Contact No.: </label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="supervisor-phone" name="sup-phone" placeholder="Supervisor's phone" maxlength = "10" pattern = "[0-9]{10}" value="<?php if (isset($error_edit_msg)) {
                        echo $supervisor_phone;
                    } ?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-warning" id="modal_submit">Update Outlet</button>
				    </div>
				  </div>

				</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Edit Modal End -->

<!-- Outlet Modal start -->

<div id="outletModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_heading">Add Outlet</h4>
				<?php if (isset($error_msg)) {
                        ?>
				<div id="error" class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>
			<?php
                    } ?>
      </div>
      <div class="modal-body">
				<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit="return verify_outlet(this)">
					<input type="hidden" id="dummy">
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="outlet">Unique Outlet Name: </label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" name="outlet" id="outlet" placeholder="Unique NickName" value="<?php if (isset($error_msg)) {
                        echo $outlet;
                    } ?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="outlet-addr">Outlet Address</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="outlet-addr" name="outlet-addr" placeholder="Enter Outlet Address" value="<?php if (isset($error_msg)) {
                        echo $outlet_addr;
                    } ?>">
              <div>
                <label for="lat" class="control-label col-sm-2"> Lat: </label>
                <input name="lat" type="text" id="lat-add" class="col-sm-4" readonly="readonly">
                <label for="long" class="control-label col-sm-2"> Long: </label>
                <input name="long" type="text" id="long-add" class="col-sm-4" readonly="readonly">
              </div>
				      <input id="map-submit-add" type="button" class="btn btn-default" value="See on Map & Drag">
				      <div id="map-add" style="width: 400px; height: 400px;"></div>
				    </div>
				  </div>
          <div class="row">
				  <div class="form-group col-xs-6">
				    <label class="control-label col-sm-5" for="supervisor-fname">Supervisor's First Name: </label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="supervisor-fname" name="sup-fname" placeholder="First name" value="<?php if (isset($error_msg)) {
                        echo $supervisor_fname;
                    } ?>">
				    </div>
          </div>
            <div class="form-group col-xs-6">
  				    <label class="control-label col-sm-5" for="supervisor-lname">Supervisor's Last Name: </label>
  				    <div class="col-sm-7">
  				      <input type="text" class="form-control" id="supervisor-lname" name="sup-lname" placeholder="Last name" value="<?php if (isset($error_msg)) {
                          echo $supervisor_lname;
                      } ?>">
  				    </div>
				  </div>
        </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-email">Supervisor Email: </label>
				    <div class="col-sm-5">
				      <input type="email" class="form-control" id="supervisor-email" name="sup-email" placeholder="Supervisor's email" value="<?php if (isset($error_msg)) {
                        echo $supervisor_email;
                    } ?>" required>
				    </div>
				  </div>
          <div class="form-group">
				    <label class="control-label col-sm-2" for="password">Password: </label>
				    <div class="col-sm-5">
				      <input type="password" class="form-control" id="pass" placeholder="Password" name="password" required>
				    </div>
				  </div>
          <div class="form-group">
				    <label class="control-label col-sm-2" for="confirmpass">Confirm Password: </label>
				    <div class="col-sm-5">
				      <input type="password" class="form-control" id="confirmpass" placeholder="Confirm Password" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-phone">Supervisor Contact No.: </label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="supervisor-phone" name="sup-phone" placeholder="Supervisor's phone" maxlength = "10" pattern = "[0-9]{10}" value="<?php if (isset($error_msg)) {
                        echo $supervisor_phone;
                    } ?>">
				    </div>
				  </div>
          <input type="hidden" id="supervisor_object">

				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-warning" id="modal_submit">Add Outlet</button>
				    </div>
				  </div>

				</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="itemModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_heading">Add Item</h4>

      </div>
      <div class="modal-body">
				<form class="form-horizontal" method="post" id="itemform">
					<input type="hidden" id="dummy">
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="outlet">Item Name: </label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="outlet-addr">Toppings: </label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="toppings" name="toppings" placeholder="Toppings" required>

				    </div>
				  </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-name">Price: </label>
				    <div class="col-sm-5">
				      <input type="number" class="form-control" id="item_price" name="item_price" placeholder="Price" required>
				    </div>
				  </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="supervisor-name">Type: </label>
          <label class="radio-inline">
            <input type="radio" name="type" value="pizzas" checked="checked">Pizza
          </label>
          <label class="radio-inline">
            <input type="radio" name="type" value="sides">Side
          </label>
          <label class="radio-inline">
            <input type="radio" name="type" value="beverages">Beverage
          </label>
        </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="supervisor-phone">Image: </label>
				    <div class="col-sm-5">
				      <input type="file" name="image" id="imageToUpload">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-warning" id="modal_submit">Add Item</button>
              <input type="reset" class="btn btn-default" value="Reset">
				    </div>
				  </div>
				</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php if (isset($error_msg)) {
                        echo "<script type='text/javascript'>$('#outletModal').modal('show');</script>";
                    } ?>
<?php if (isset($error_edit_msg)) {
                        echo "<script type='text/javascript'>$('#outletEditModal').modal('show');</script>";
                    } ?>

<!-- Outlet Modal End -->





	<script>
      function verify_outlet(param) {
        console.log("here");
        var coord = $(param).find("input[name=lat]").val();
        console.log(coord);
        if (!coord) {
          alert("Please verify your location on Map first");
          return false;
        }
        return true;
      }

			function deleteOutlet(param) {

				var num = parseInt(param.id);
				var outlet_id = complex[num]["_id"]["$oid"];
        var outlet_name = complex[num]["outlet"];
        console.log(outlet_id);
				var person = prompt("Are you sure, you want to delete '" + outlet_name + "'!\nEnter yes to confirm");
				if (person.toLowerCase() == "yes") {
					$("#deleteOutlet input[name=deleteOutlet]").val(outlet_id);
					$("#deleteOutlet").submit();
				}
			}


			function putContents(param) {
				var num = parseInt(param.id);
				var out = complex[num];
        console.log(out);
				$("#outletEditModal input[name=doc-id]").val(out["_id"]['$oid']);
				console.log(out["_id"]['$oid']);
				$("#outletEditModal input[name=outlet-edit]").val(out["outlet"]);
				$("#outletEditModal input[name=outlet-addr]").val(out["outlet_addr"]);
        $("#outletEditModal input[name=lat]").val("");
        $("#outletEditModal input[name=long]").val("");
				$("#outletEditModal input[name=sup-fname]").val(out["supervisor"][0]["fname"]);
        $("#outletEditModal input[name=sup-lname]").val(out["supervisor"][0]["lname"]);
				$("#outletEditModal input[name=sup-email]").val(out["supervisor"][0]["email"]);
				$("#outletEditModal input[name=sup-phone]").val(out["supervisor"][0]["phoneno"]);

        //$("#supervisor_object").val();
			}

      function initMap() {
        var map1 = new google.maps.Map(document.getElementById('map-add'), {
          zoom: 3,
          center: {lat: 36.6139, lng: 60.2090}
        });
				var map2 = new google.maps.Map(document.getElementById('map-edit'), {
          zoom: 3,
          center: {lat: 36.6139, lng: 60.2090}
        });
        var geocoder = new google.maps.Geocoder();

       document.getElementById('map-submit-add').addEventListener('click', function() {
          geocodeAddress(geocoder, map1, "add");
        });

				document.getElementById('map-submit-edit').addEventListener('click', function() {
          geocodeAddress(geocoder, map2, "edit");
        });


      }

      var modal;
      function geocodeAddress(geocoder, resultsMap, modal_type) {
        var marker;
        var addr;
        var add_address = document.getElementById('outlet-addr').value;
				var edit_address = document.getElementById('outlet-edit-addr').value;
				if (modal_type == "add") {
					addr = add_address;
          modal = "add_modal";
				} else {
					addr = edit_address;
          modal = "edit_modal";
				}
        geocoder.geocode({'address': addr}, function(results, status) {
          console.log(results);
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
              marker = new google.maps.Marker({
              map: resultsMap,
              draggable: true,
              animation: google.maps.Animation.DROP,
              position: results[0].geometry.location,
              title: "Drag Me!"
            });

            marker.addListener('click', toggleBounce);
            google.maps.event.addListener(marker, 'dragend', fill_coord);
            var mouseEvent1 = {
              stop: null,
              latLng: results[0].geometry.location
            }
            google.maps.event.trigger(marker, 'dragend', mouseEvent1);
						if (results[0].geometry.viewport)
        				resultsMap.fitBounds(results[0].geometry.viewport);



          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }

        });
        function toggleBounce() {
          if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
          } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
          }
        }

      }

      function fill_coord(event) {
            console.log(event);

            if (modal == "add_modal") {
            document.getElementById("lat-add").value = event.latLng.lat();
           document.getElementById("long-add").value = event.latLng.lng();
         } else {
           console.log("here");
           document.getElementById("lat-edit").value = event.latLng.lat();
          document.getElementById("long-edit").value = event.latLng.lng();
         }

       }





			$('#outletModal').on('shown.bs.modal', function(){
    initMap();
    });
		$('#outletEditModal').on('shown.bs.modal', function(){
	initMap();
	});
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2nLH2Yr5OH-QJ8WxG5f-AZFmTLqtkC0I&callback=initMap">
    </script>




<?php include("modals.php"); ?>
<?php include("footer.php"); ?>
