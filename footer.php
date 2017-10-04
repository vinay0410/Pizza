<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p>Copyright &copy; 2084 Company Name</p>
        <hr>
        <ul class="social-icon">
          <li><a href="#" class="fa fa-facebook"></a></li>
          <li><a href="#" class="fa fa-twitter"></a></li>
          <li><a href="#" class="fa fa-instagram"></a></li>
          <li><a href="#" class="fa fa-pinterest"></a></li>
          <li><a href="#" class="fa fa-google"></a></li>
          <li><a href="#" class="fa fa-github"></a></li>
          <li><a href="#" class="fa fa-apple"></a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<!-- end footer -->


<script src="js/plugins.js"></script>
<script src="js/smoothscroll.js"></script>

<script src="js/custom.js"></script>

<script>
function editme() {

  var input = $('#editform input');
  input.toggleClass('readonly');
  input.toggleClass('form-control');
  console.log(input.prop("readonly"));
  input.attr('readonly', input.prop('readonly') == false ? true : false);
  $('#editform button').toggleClass("hidden");


}
function Validation()
{
 var email = document.getElementById('inputEmail');
 var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  if (!filter.test(email.value)) {
    alert('Please provide a valid email address');
    email.focus;
  return false;
}
var pswd=document.getElementById('pass');
var cpswd=document.getElementById('confirmpass');

if(pswd.value!=cpswd.value){
  alert("password does not match"); cpswd.focus; return false;}

    var phone = document.getElementById('phoneno');
   var phoneNum = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if(phone.value.match(phoneNum)) {
            return true;
        }
        else {
            alert('Please provide a valid phone number');
      phone.focus;
    return false;
        }
}
</script>


<!-- cart-js -->
<script src="js/minicart.js"></script>
<script>
      w3ls.render();

      w3ls.cart.on('w3sb_checkout', function (evt) {
        var items, len, i;

        if (this.subtotal() > 0) {
          items = this.items();

          for (i = 0, len = items.length; i < len; i++) {
          }
        }
      });

  </script>
<!-- //cart-js -->




</body>
</html>



<!-- start footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p>Copyright &copy; 2084 Company Name</p>
        <hr>
        <ul class="social-icon">
          <li><a href="#" class="fa fa-facebook"></a></li>
          <li><a href="#" class="fa fa-twitter"></a></li>
          <li><a href="#" class="fa fa-instagram"></a></li>
          <li><a href="#" class="fa fa-pinterest"></a></li>
          <li><a href="#" class="fa fa-google"></a></li>
          <li><a href="#" class="fa fa-github"></a></li>
          <li><a href="#" class="fa fa-apple"></a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<!-- end footer -->
