<!DOCTYPE html>
<html>
<head>
	<title>David's Cyber Team</title>
</head>
  <body>
  <?php
    session_start();
    // $db = mysqli_connect("localhost","root","","loginform") or die(mysqli_error());
    // if (isset($_POST['email']) && isset($_POST['ID']) && isset($_POST['password'])){
    // var_dump(isset($_POST['signin']));die;
    $id=$_SESSION['username'];
    $email=$_SESSION['email'];
    ?>
    <form method="get" action="home.php">
      <fieldset>
          <legend><h2>Welcome</h2></legend>
          <?php echo "Hallo $id & $email Anda telah berhasil login. Herzlich Wilkommen!! :):)";?>
      </fieldset>
    </form>
    <?php
  ?>

</body>
</html>
