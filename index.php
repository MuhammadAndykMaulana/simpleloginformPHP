<?php
  session_start();
  ini_set('session.cache_limiter','public');
  session_cache_limiter(false);
  $db = mysqli_connect("localhost","root","","loginform") or die(mysqli_error());
  $username = "";
  $email = "";
  // var_dump(isset($_POST["next"]));die;
  if (isset ($_POST["next"])){
    $username = $_POST['ID'];
  	$email = $_POST['email'];
    $sql="SELECT * FROM userlogin WHERE id='$username' and email='$email'";
    $res = mysqli_query($db, $sql);
    if (mysqli_num_rows($res) >0) {
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      $_SESSION['status'] = "login";
      header('Location: validation.php');
    }
    else{
      $invalid_emailid = "Email and Username Not Match";
      header("Refresh:3; url=index.php");
  	}
  }
  function validate(){
    location.href(validation.php);
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
     <form action="index.php" method="post" id="userForm">
     <div class="row">
       <div class="col-md-4"></div>
       <div class="col-md-4"style="background: #f7f7f7;">
        <img src="https://www.ekahiornish.com/wp-content/uploads/2018/07/default-avatar-profile-icon-vector-18942381.jpg" alt="" class="profile-image">
        <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
          <input type="text" class="form-control"name = "ID" placeholder="Enter your Username" value="<?php echo $username; ?>"required>
          <?php if (isset($name_error)): ?>
      	  	<span style="color: red"><?php echo $name_error; ?></span>
      	  <?php endif ?>
      	</div>
        <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
          <input type="email" class="form-control" name = "email" placeholder="Enter your Email" value="<?php echo $email; ?>" required>
          <?php if (isset($email_error)): ?>
          	<span style="color: red"><?php echo $email_error; ?></span>
          <?php endif ?>
      	</div>
        <div <?php if (isset($invalid_emailid)): ?> class="form_error" <?php endif ?> >
          <input class="btn btn-info" type="submit" name="next" id="btnID" value="Next" onclick="validate();">
          <!-- <button type="submit" name="next" id="next_btn">Next</button> -->
          <!-- <input class="btn btn-info" type="submit" name="next" id="btnID" value="Next" onclick="validate();">-->
          <?php if (isset($invalid_emailid)): ?>
          	<span style="color: red"><?php echo $invalid_emailid; ?></span>
          <?php endif ?>
          <a href="registration.php"><p class="text-center" id="txtRegis">Create an account</p></a>
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
