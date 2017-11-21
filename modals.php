<?php if (!isset($_SESSION["logged"])) {
    ?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>

                                 <h4 class="modal-title" id="myModalLabel">Login form</h4>
                                 <?php if (isset($pop_login)) {
        ?>
                                 <div id="error" class="alert alert-<?php echo $pop_login["type"] ?>" role="alert"><?php echo $pop_login["msg"] ?></div>
                               <?php
    } ?>
                                 <?php if (isset($error) and $error) {
        ?>
                                 <div id="error" class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>
                               <?php
    } ?>
                            </div><!--ending modal header-->


          <div class="modal-body">
                                  <form method="post" action="." id="loginform">
                                      <div class="form-group">
                                          <label for="email">Email ID:</label>
                <div class="input-group pb-modalreglog-input-group">
                  <input id="email" class="form-control"  type="email" title="Please enter a valid Email ID" name="email" placeholder="Email ID" value="<?php if (isset($error) and $error) {
        echo $email;
    } ?>" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
                  </div>


              <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group pb-modalreglog-input-group">
                                                <input type="password" name="pass" class="form-control" id="pws" placeholder="Password">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                          </div>
                                      </div>


        <a  href="forget.php">Forgot Password? </a>
        </br></br>
        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Log in</button>
                          </div> <!-- ending modal-footer -->


                                  </form>`

                          </div><!-- modal-body-->



<!--login form ends-->
                    </div><!--modal-content-->


            </div><!-- modal-dialog -->
        </div>

        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Registration form</h4>
                          <?php if (isset($signup_error)) {
        ?>
                          <div id="error" class="alert alert-danger" role="alert"><?php echo $signup_error["error_msg"] ?></div>
                        <?php
    } ?>
                      </div><!--modal header-->
                      <div class="modal-body">

      <!--form for registration -->
                          <form class="pb-modalreglog-form-reg" method="post" action="process.php" onsubmit="return Validation();">
      <div class="form-group">
                                  <label for="fname">First Name:</label>
        <div class="input-group pb-modalreglog-input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
          <input id="fname" class="form-control"  type="text" name="fname" placeholder="First Name" value="<?php if (isset($signup_error)) {
        echo $signup_error['fname'];
    } ?>" required/>
                                      </div>
          </div>
          <div class="form-group">
                                      <label for="lname">Last Name:</label>
            <div class="input-group pb-modalreglog-input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              <input id="lname" class="form-control"  type="text" name="lname" placeholder="Last Name" value="<?php if (isset($signup_error)) {
            echo $signup_error['lname'];
        } ?>" required/>
                                          </div>
              </div>
                              <div class="form-group">
                                  <label for="email">Email address</label>
                                  <div class="input-group pb-modalreglog-input-group">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                      <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?php if (isset($signup_error)) {
        echo $signup_error['email'];
    } ?>" required>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="password">Password</label>
                                  <div class="input-group pb-modalreglog-input-group">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                      <input type="password" class="form-control" id="pass" placeholder="Password" name="password" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="confirmpassword">Confirm password</label>
                                  <div class="input-group pb-modalreglog-input-group">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                      <input type="password" class="form-control" id="confirmpass" placeholder="Confirm Password" required>
                                  </div>
                              </div>
      <div class="form-group">
        <label for = "phoneno">Contact Number</label><br />
        <div class="input-group pb-modalreglog-input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
           <input type = "text" class="form-control" name = "phoneno" id="phoneno" maxlength = "10" placeholder = "Enter a valid phone number" pattern = "[0-9]{10}" value="<?php if (isset($signup_error)) {
        echo $signup_error['phoneno'];
    } ?>">
              </div>
      </div>

                              <div class="form-group">
                                  <input type="checkbox" id="ch" name="chs" required>
                                  I agree with <a href="#" style="color:orange">terms and conditions.</a>
                              </div>
      <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-warning">Sign up</button>
                        </div>
                          </form>
      <!-- form registration ended-->
                      </div><!--modal-content -->

                  </div><!-- "modal-dialog -->
              </div><!-- modal fade -->
          </div>

        <?php
} else {
        ?>

          <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
              <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                      <h3><?php echo $_SESSION["logged"]["fname"]."'s account"; ?>
                        <button type="button" class="btn btn-default btn-sm pull-right" onclick="editme(); "><span class="glyphicon glyphicon-pencil"></span>Edit</button>
                      </h3>
                      <?php if (isset($pop_profile)) {
            ?>
                      <div id="error" class="alert alert-<?php echo $pop_profile['type']; ?>" role="alert"><?php echo $pop_profile["msg"]; ?></div>
                    <?php
        } ?>
                    </div>

                    <div class="modal-body">
                      <form action = "update.php" method="post" id="editform">
                        <input type="hidden" name="doc_id" value="<?php echo $_SESSION['logged']['_id']; ?>" readonly required>
                      <table class="table">
                        <tbody>
                          <tr>
                            <td>First Name: </td>
                            <td><input class="readonly" name="edit_fname" id="edit_fname" value="<?php echo $_SESSION["logged"]["fname"]; ?>" readonly required></td>

                          </tr>
                          <tr>
                            <td>Last Name: </td>
                            <td><input class="readonly" name="edit_lname" id="edit_lname" value="<?php echo $_SESSION["logged"]["lname"]; ?>" readonly required></td>

                          </tr>
                          <tr>
                            <td>Email ID: </td>
                            <td><input class="readonly" name="edit_email" id="edit_email" value="<?php echo $_SESSION["logged"]["email"]; ?>" readonly required></td>
                          </tr>

                          <tr>
                            <td>Phone No.:</td>
                            <td><input class="readonly" name="edit_phoneno" id="edit_phoneno" value="<?php echo $_SESSION["logged"]["phoneno"]; ?>" readonly required></td>
                          </tr>

                        </tbody>
                      </table>
                      <div class="modal-footer">
                          <button type="button" onclick="window.location.href='change_password.php'; " class="btn btn-warning hidden"><span class="glyphicon glyphicon-lock"></span>Change Password</button>
                          <button type="submit" class="btn btn-warning hidden"><span class="glyphicon glyphicon-edit"></span>Update Details</button>
                      </div>
                    </form>
                      <form method="post" action=".">
                      <input type="hidden" value="logout" name="logout">
                      <button type="submit" class="btn btn-warning">Log Out</button>
                      <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
                    </form>
                    </div>
              </div>
              </div>
            </div>

          <?php
    } ?>

<?php if (isset($show_login) and $show_login = true) {
        echo "<script type='text/javascript'>$('#myModal').modal('show');</script>";
    } ?>
<?php if (isset($signup_error)) {
        echo "<script type='text/javascript'>$('#myModal2').modal('show');</script>";
    } ?>
<?php if (isset($pop_profile)) {
        echo "<script type='text/javascript'>$('#userModal').modal('show');</script>";
    } ?>
<?php if (isset($pop_login)) {
        echo "<script type='text/javascript'>$('#myModal').modal('show');</script>";
    } ?>
