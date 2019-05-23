<?php
  session_start();
  ini_set('session.cache_limiter','public');
  session_cache_limiter(false);
  $db = mysqli_connect("localhost","root","","loginform") or die(mysqli_error());
  $email=$_SESSION["email"];
  $username=$_SESSION['username'];
  if(isset($_POST['signin'])) {
    $password=$_POST['password'];
    $sql="SELECT * FROM userlogin WHERE id='$username' and email='$email' and password='$password'";
    $res = mysqli_query($db, $sql);
    // echo "$email, $username, $password";
    if (mysqli_num_rows($res) >0) {
      $_SESSION['id']=$username;
      $_SESSION['email']=$email;
      header('Location: home.php');
    }
    else{
      $invalid_emailidpass = "Email/Username and Password Not Match.";
      header("Refresh:3; url=validation.php");
    }
  }
  function home(){
    location.href(home.php);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="bootstrap-4.1.3-dist\css\Bootstrap.css">
  <link rel="stylesheet" type="text/js" href="bootstrap-4.1.3-dist\css\Bootstrap.js">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Simple Login Form</title>
</head>
<body>
  <div class="container">
    <h1 align="center" style="color: blue">Simple Login Form<br><br></h1>
    <h4 class = "text-center" style="color:black"> Sign in with your E-mail</h4>
    <form action="validatation.php" method="post" id="validate">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4"style="background: #f7f7f7;height: 21  5px;">
        <div>
          <input type="text" class="form-control" name="ID" value="<?php echo $username;?>" readonly>
          <input type="text" class="form-control" name="email" value="<?php echo $email;?>" readonly>
          <input type="password" class="form-control" name = "password" placeholder="Enter your Password" required>
          <div <?php if (isset($invalid_emailidpass)): ?> class="form_error" <?php endif ?>>
            <input class="btn btn-info" name="signin" value="Sign In" type="submit" id="btnLogin" onclick="home();">
            <?php if (isset($invalid_emailidpass)): ?>
              <span style="color: red"><?php echo $invalid_emailidpass; ?></span>
            <?php endif ?>
          </div>
        </div>
      <div class="col-md-4"></div>
    </form>
    <script
          type="text/javascript"
          src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous">
    </script>
  </div>
</body>
</html>
