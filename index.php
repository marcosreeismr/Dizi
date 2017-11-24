<?php
error_reporting (1);
session_start();
$user_id = $_SESSION['user_id'];
?>
<?php
if($_POST['login-btn']=="login-submit"){
  if($_POST['username']!="" && $_POST['password']!=""){
    $username = strtolower($_POST['username']);
    include "connect.php";
    $query = mysqli_query($conn, "SELECT id, password
                          FROM users
                          WHERE username='$username'
                          ");
    mysqli_close($conn);
    if(mysqli_num_rows($query)>=1){
      $password = md5($_POST['password']);
      $row = mysqli_fetch_assoc($query);
      if($password==$row['password']){
        $_SESSION['user_id']=$row['id'];
        header('Location: .');
        exit;
      }
      else{
        $error_msg = "Incorrect username or password";
      }
    }
    else{
      $error_msg = "Incorrect username or password";
    }
  }
  else{
    $error_msg = "All fields must be filled out";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=425px, user-scalable=no">

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="main.css">


</head>
<body>

  <?php
  if($user_id){
    include "dashboard.php";
    exit;
  }
  ?>
  
  <br>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dízi</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="index.php" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <?php
                                  if($error_msg){
                                      echo "<div class='alert alert-danger'>".$error_msg."</div>";
                                  }
                                ?>
                                <div class="btn-group" id="loginButtons">
                                  <a href="register.php" class="btn btn-success">Registrar</a>
                                  <button type="submit" class="btn btn-info" name="login-btn" value="login-submit">Entrar</button>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                            </fieldset>
                        </form>
                    </div>
                    <div class="jumbotron" style="padding:3px;">
                      <div class="container">
                        <h5>Por<a href="#"> Marcos Reis</a></h5>
                        <h5>Open Source - Fork it on <i class="fa fa-github"></i> <a href="https://github.com/marcosreeismr">GitHub</a></h5>
                      </div>
                    </div>
            </div>
        </div>

    </div>
</body>
</html>
