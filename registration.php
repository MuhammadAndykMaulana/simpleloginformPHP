<?php
  session_start();
  ini_set('session.cache_limiter','public');
  session_cache_limiter(false);
  $db = mysqli_connect("localhost","root","","loginform") or die(mysqli_error());
  $username = "";
  $email = "";
  // var_dump(isset ($_POST["register"]));die;
  if (isset ($_POST["register"])){
    // echo "Masuk didalam register";die;
    $username = $_POST['ID'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql_u = "SELECT * FROM userlogin WHERE id='$username'";
    $res_u = mysqli_query($db, $sql_u);
    $sql_e = "SELECT * FROM userlogin WHERE email='$email'";
    $res_e = mysqli_query($db, $sql_e);
    $sql="SELECT * FROM userlogin WHERE id='$username' and email='$email' and password='$password'";
    $res = mysqli_query($db, $sql);
    $_SESSION['status'] = "login";
  	if (mysqli_num_rows($res_u) > 0) {
        $name_error = "Username already taken";
        $_SESSION['username'] = $username;
  	}elseif(mysqli_num_rows($res_e) > 0){
        $email_error = "Email already taken";
        $_SESSION['email'] = $email;
  	}
    else{
      $query = "INSERT INTO userlogin (id, email, password)
          VALUES ('$username', '$email', '".md5($password)."')";
      $results = mysqli_query($db, $query);
      echo '<script language="javascript">';
      echo 'alert("Adding user succeeded! This page will be redirected to login page")';
      echo '</script>';
      // exit();
      header("Refresh:3; url=index.php");
  	}
  }
  function index(){
    location.href(index.php);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="bootstrap-4.1.3-dist\css\Bootstrap.css">
  <link rel="stylesheet" type="text/js" href="bootstrap-4.1.3-dist\css\Bootstrap.js">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>David's Cyber Team</title>
</head>
<body>
  <div class="container">
    <h1 align="center" style="color: blue"> David's Cyber Team<br><br></h1>
    <h4 class = "text-center" style="color:black"> Register here!</h4>
    <form action="registration.php" method="post" id="register_form">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4"style="background: #f7f7f7">
        <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
          <input type="text" class="form-control" name = "ID" placeholder="Enter your Username" required>
          <?php if (isset($name_error)): ?>
      	  	<span style="color: red"><?php echo $name_error; ?></span>
      	  <?php endif ?>
        </div>
        <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
          <input type="email" class="form-control" name = "email" placeholder="Enter your Email" required>
          <?php if (isset($email_error)): ?>
          	<span style="color: red"><?php echo $email_error; ?></span>
          <?php endif ?>
      	</div>
        <div>
          <input type="password"  class="form-control" placeholder="Type your password here" name="password" required >
          <input type="submit" class="btn btn-info" name="register" value="Sign Up" id="btnRegis" onclick="index();">
  	    </div>
      </div>
      <div class="col-md-4"></div>
    </form>
  </div>
  </form>
</body>
</html>
