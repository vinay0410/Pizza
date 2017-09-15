<!DOCTYPE html>
<html>
<head><title>blah blah Pizza Chain</title></head>
<body>
<div class="login-signup">
  <form action="login.php" method="post">
    <input name="username" type="email" placeholder="Enter your Email ID" required>
    <input name="pass" type="password" placeholder="Enter your password" required>
    <input type="submit" value="Login">
  </form>
    <button onclick="togglesignup();">Sign Up</button>
</div>
<div class="signup-modal" id="signup" style="display: none">
  <form action="signup.php" method="post">
  <input name="name" type="text" placeholder="Enter your name" required>
  <input name="email" type="email" placeholder="Enter your Email ID" required>
  <input name="pass" type="password" placeholder="Enter your password" required>

  <input type="submit" value="Sign Up">
</form>
</div>
</body>

<script src="main.js"></script>
</html>
