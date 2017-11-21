<?php include("header.php"); ?>

<div class="container pb-modalreglog-container">
<?php echo "Hi! Supervisor";

try {
    $m = new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
    $db = $m->pizza;
    $collection = $db->users;

} catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
    //die("Caught Exception failed to Connect".$e->getMessage()."\n");
    $error_staff_msg = "Couldn't Load Outlets, Connection Failed!";

} catch (Exception $e) {
    $error_staff_msg = $e->getMessage();

}



if (empty($error_staff_msg)) {
    $chef_cursor = $collection->find([ "role" => "chef" , "ofOutlet" => new MongoDB\BSON\ObjectID($_SESSION["logged"]["ofOutlet"]) ])->toArray();
    $delivery_cursor = $collection->find([ "role" => "delivery" , "ofOutlet" => new MongoDB\BSON\ObjectID($_SESSION["logged"]["ofOutlet"]) ])->toArray();
}



?>

<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet">
<style>
.modal-title {
  font-size: 2em;
}

</style>
<div class="panel panel-default">
      <div class="panel-heading"><h3>Orders</h3>
    </div>
    <div class="panel-body">
    </div>
  </div>


<div class="panel panel-default">
      <div class="panel-heading"><h3>Chefs
				<button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#addStaff" data-title="chef" name="add_modal"><span class="glyphicon glyphicon-plus"></span>Add</button>
			</h3>
    </div>
    <div class="panel-body">
      <div class="list-group" id="chef">
          <?php

          if (count($chef_cursor) == 0) {
            ?>
            <p class="empty_msg">Your Outlet has no Chef's yet!</p>

          <?php
          } else {
          foreach (array_reverse($chef_cursor) as $document) {

             ?>
             <a class="list-group-item">
            <h4 class="list-group-item-heading accordion-toggle"><?php echo $document["fname"] . " " . $document["lname"]; ?>

              <button type="button" class="btn btn-danger btn-space pull-right" id="<?php echo $document["_id"]; ?>" onclick="delete_staff(this);" data-role="<?php echo $document['role']; ?>"><span class="glyphicon glyphicon-remove"></span></button>
              <button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" data-toggle="modal" data-target="#editStaff" data-title="chef" data-staff='<?php echo json_encode($document); ?>' onclick="putContents(this);" ><span class="glyphicon glyphicon-pencil"></span></button>
            </h4>
            <p class="list-group-item-text"><?php echo $document['email']; ?></p>
            <p class="list-group-item-text"><?php echo $document['phoneno']; ?></p>
          </a>
          <?php
            }
          } ?>
      </div>
    </div>


</div>

<div class="panel panel-default">
      <div class="panel-heading"><h3>Delivery Staff
				<button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#addStaff" data-title="delivery" name="add_modal" ><span class="glyphicon glyphicon-plus"></span>Add</button>
			</h3>
    </div>
    <div class="panel-body">
      <div class="list-group" id="delivery">
          <?php

          if (count($delivery_cursor) == 0) {
            ?>
            <p class="empty_msg">Your Outlet has no Delivery Staff yet!</p>

          <?php
          } else {
          foreach (array_reverse($delivery_cursor) as $document) {

             ?>
             <a class="list-group-item">
            <h4 class="list-group-item-heading accordion-toggle"><?php echo $document["fname"] . " " . $document["lname"]; ?>

              <button type="button" class="btn btn-danger btn-space pull-right" id="<?php echo $document["_id"]; ?>" onclick="delete_staff(this);" data-role="<?php echo $document['role']; ?>"><span class="glyphicon glyphicon-remove"></span></button>
              <button type="button" name="edit_modal" class="btn btn-default btn-space pull-right" data-toggle="modal" data-target="#editStaff" data-staff='<?php echo json_encode($document); ?>' data-title="delivery" onclick="putContents(this);" ><span class="glyphicon glyphicon-pencil"></span></button>
            </h4>
            <p class="list-group-item-text"><?php echo $document['email']; ?></p>
            <p class="list-group-item-text"><?php echo $document['phoneno']; ?></p>
          </a>
          <?php
            }
          } ?>
      </div>

    </div>


</div>



</div>




<div id="addStaff" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_heading">Add</h4>

      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" id="addStaffForm">
          <input type="hidden" id="dummy" name="staff_id">
          <div class="row">
				  <div class="form-group col-xs-6">
				    <label class="control-label col-sm-5" for="staff-fname">First Name: </label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="staff-fname" name="staff-fname" placeholder="First name">
				    </div>
          </div>
            <div class="form-group col-xs-6">
  				    <label class="control-label col-sm-5" for="staff-lname">Last Name: </label>
  				    <div class="col-sm-7">
  				      <input type="text" class="form-control" id="staff-lname" name="staff-lname" placeholder="Last name">
  				    </div>
				  </div>
        </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="staff-email">Email: </label>
				    <div class="col-sm-5">
				      <input type="email" class="form-control" id="staff-email" name="staff-email" placeholder="Supervisor's email">
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
				    <label class="control-label col-sm-2" for="staff-phone">Contact No.: </label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="staff-phone" name="staff-phone" placeholder="Phone No" maxlength = "10" pattern = "[0-9]{10}">
				    </div>
				  </div>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-warning" id="modal_submit">Add</button>
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


<div id="editStaff" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_heading">Edit</h4>

      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" id="editStaffForm">
          <input type="hidden" id="dummy" name="staff_id">
          <div class="row">
				  <div class="form-group col-xs-6">
				    <label class="control-label col-sm-5" for="edit-staff-fname">First Name: </label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="edit-staff-fname" name="edit-staff-fname" placeholder="First name">
				    </div>
          </div>
            <div class="form-group col-xs-6">
  				    <label class="control-label col-sm-5" for="edit-staff-lname">Last Name: </label>
  				    <div class="col-sm-7">
  				      <input type="text" class="form-control" id="edit-staff-lname" name="edit-staff-lname" placeholder="Last name">
  				    </div>
				  </div>
        </div>
				  <div class="form-group">
				    <label class="control-label col-sm-2" for="edit-staff-email">Email: </label>
				    <div class="col-sm-5">
				      <input type="email" class="form-control" id="edit-staff-email" name="edit-staff-email" placeholder="Email ID">
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
				    <label class="control-label col-sm-2" for="edit-staff-phone">Contact No.: </label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" id="edit-staff-phone" name="edit-staff-phone" placeholder="phone" maxlength = "10" pattern = "[0-9]{10}">
				    </div>
				  </div>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-warning" id="modal_submit">Update</button>
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

<script src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>

var edit_staff_div;

function putContents(param) {

  var staff_data = JSON.parse($(param).attr('data-staff'));
  console.log(staff_data);
  $("#editStaff #dummy").val(staff_data["_id"]["$oid"]);
  $("#editStaff input[name=edit-staff-fname]").val(staff_data["fname"]);
  $("#editStaff input[name=edit-staff-lname]").val(staff_data["lname"]);
  $("#editStaff input[name=edit-staff-email]").val(staff_data["email"]);
  $("#editStaff input[name=edit-staff-phone]").val(staff_data["phoneno"]);

  edit_staff_div = $(param).parent().parent();
}





function delete_staff(el) {


    var staff_id = el.id;
    var role = $(el).attr("data-role");
    var div = $(el).parent().parent();
    var copy_div = div.clone();

    var progress_bar = $("<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'></div></div>");

      $.ajax({
        url: "delete_staff.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: {staff_id :staff_id, role: role},
        beforeSend: function() {
          $(div).html(progress_bar);
        },
        success: function(data) {
          try {
          var value = JSON.parse(data);
          $(copy_div).prepend("<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + value.msg + "</div>");

          $(div).html(copy_div.children());
        } catch (e) {

          $(div).html(data).fadeIn("slow");

          setTimeout(function(){
            $(div).slideUp("slow");
            setTimeout(function() {
              $(div).remove();

              if ($("#" + role).find(".list-group-item").length == 0) {

                $("#" + role).prepend("<p class='empty_msg'>Oops! No one present!</p>").slideDown('slow');
              }

            }, 1000);
          }, 4000);


         }
        }
    });
  }



  var role;
    $('#addStaff, #editStaff').on('show.bs.modal', function (event) {
        var button  = $(event.relatedTarget);
        var modal = $(this);
        var title = button.data('title');
        console.log(title);
        var txt = modal.find('.modal-title').html().split(" ");
        console.log(txt);

        if (title == "chef") {
          role = "chef";
          modal.find('.modal-title').html(txt[0] + " Chef");
        } else {
          role = "delivery";
          modal.find('.modal-title').html(txt[0] + " Delivery Staff");
        }
    });



  $(document).ready(function() {
    $("#editStaffForm").on("submit", function(e) {
      e.preventDefault();

      var dummy = edit_staff_div;
      var copy_dummy = dummy.clone();
      console.log(dummy);
      var formData = new FormData(this);
      formData.append("role", role);
      console.log(formData);
      $("#editStaff").modal('toggle');
      //e.stopPropagation();
      var progress_bar = $("<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'></div></div>");
      $.ajax({
        url: "edit_staff.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,
        beforeSend : function()    {
           $(dummy).html(progress_bar);

        },
        success: function(data) {
          try {
          var value = JSON.parse(data);
          $(copy_dummy).prepend("<div class='alert alert-danger alert-dismissable fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + value.msg + "</div>");

          $(dummy).html(copy_dummy.children());
          //$(new_div).remove();
        } catch (e) {
          $("#editStaffForm")[0].reset();
          console.log(data);

          $(dummy).html(data).fadeIn("slow");

          }

        }
    });

  });
  });




$(document).ready(function() {
  $("#addStaffForm").on("submit", function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("role", role);
    console.log(formData);
    $("#addStaff").modal('toggle');
    //e.stopPropagation();
    var new_div = $("<a class='list-group-item new'><div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'></div></div></a>");
    $.ajax({
      url: "add_staff.php", // Url to which the request is send
      type: "POST",             // Type of request to be send, called as method
      data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
      contentType: false,       // The content type used when sending data to the server.
      cache: false,             // To unable request pages to be cached
      processData:false,
      beforeSend : function()    {


         $("#" + role).find(".empty_msg").remove();
          $("#" + role).prepend(new_div);


      },
      success: function(data) {
        try {
        var value = JSON.parse(data);
        $(new_div).html("<div class='alert alert-danger fade in'>" + value.msg + "</div>");
        setTimeout(function(){
          $(new_div).slideUp("slow");

        }, 4000);
        //$(new_div).remove();
      } catch (e) {
        $("#addStaffForm")[0].reset();
        console.log(data);

        $(new_div).html(data).fadeIn("slow");
        $(new_div).removeClass("new");
        }

      }
  });

 });
});

</script>

<?php include("modals.php"); ?>
<?php include("footer.php"); ?>
