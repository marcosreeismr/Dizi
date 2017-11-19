<?php
error_reporting (1);
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=425px, user-scalable=no">

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  <title>Dízi</title>
</head>
<body style="margin-left:20px;width:300px;zoom:125%;">
  <form action="register.php" method="POST" role="form" style="width:300px;">
    <h3>Dízi</h3>
    <h4>Registrar uma nova conta</h4>
<?php
if($_POST['btn']=="submit-register-form"){
  if($_POST['username']!="" && $_POST['password']!="" && $_POST['confirm-password']!=""){
    if($_POST['password']==$_POST['confirm-password']){
      include 'connect.php';
      $username = strtolower($_POST['username']);
      $query = mysqli_query($conn , "SELECT username FROM users WHERE username=$username");
      mysqli_close($conn);
      if(!(mysqli_num_rows($query)>=1)){
          $password = md5($_POST['password']);
          include 'connect.php';
          mysqli_query($conn, "INSERT INTO users(username, password)
                       VALUES ('$username', '$password')
                      ");
          mysqli_close($conn);
          echo "<div class='alert alert-success'>Your account has been created!</div>";
          echo "<a href='.' style='width:300px;' class='btn btn-info'>Go Home</a>";
          echo "</form>";
          echo "<br>";
          echo "<div class='jumbotron' style='padding:3px;'>
                  <div class='container'>
                    <h5>Por <a href='#>Marcos Reis</a></h5>
                    <h5>Open Source - Fork it on <i class='fa fa-github'></i> <a href='https://github.com/marcosreeismr'>GitHub</a></h5>
                  </div>
                </div>";
          echo "</body>";
          echo "</html>";
          exit;

      }
      else{
        $error_msg="Username already exists please try again";
      }
    }
    else{
      $error_msg="Passwords did not match";
    }
  }
  else{
      $error_msg="All fields must be filled out";
  }
}
?>
    <div class="input-group" style="margin-bottom:10px;">
      <span class="input-group-addon">@</span>
      <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $_POST['username']; ?>">
    </div>
    <input type="password" style="margin-bottom:10px;" class="form-control" placeholder="Password" name="password">
    <input type="password" style="margin-bottom:10px;" class="form-control" placeholder="Confirm Password" name="confirm-password">
    <?php
    if($error_msg){
        echo "<div class='alert alert-danger'>".$error_msg."</div>";
    }
    ?>
    <button type="submit" style="width:300px; margin-bottom:5px;" class="btn btn-success" name="btn" value="submit-register-form">Registrar</button>
    <a href="." style="width:300px;" class="btn btn-info">Início</a>
  </form>
  <br>
   <div class="jumbotron" style="padding:3px;">
    <div class="container">
      <h5>Por<a href="#"> Marcos Reis</a></h5>
      <h5>Open Source - Fork it on <i class="fa fa-github"></i> <a href="https://github.com/marcosreeismr">GitHub</a></h5>
    </div>
  </div>
</body>
</html>
