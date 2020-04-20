<?php 

ob_start();
session_start();
require_once 'functions.php';
require_once 'config.php';
define ("title", "Login");
define ("page_name", "Login");

$msg=null;
if( isset($_POST['signin']) )
{
	
	$username=$_POST['login_email'];
	$pwd=md5($_POST['login_password']);
	
	if($data=$conn->query("SELECT * FROM admin WHERE username='$username' && password='$pwd' ")){
		$result=$data->fetch_assoc();
		if($result==null){
			$msg = "Username or Password are incorrect.";
		}else{
			$_SESSION['login_user']=$result;
			
			header("location:index.php");
		}
        if($result){
            if(!empty($_POST['remember'])){
                setcookie('login_email',$username,time()+ (1 * 60 * 60));
                setcookie('login_password',$pwd,time()+ (1 * 60 * 60));
                $_SESSION['login_user']=$result;
            }else{
                if(isset($_COOKIE['login_email'])){
                    setcookie('login_email','');
                }
                 if(isset($_COOKIE['login_password'])){
                    setcookie('login_password','');
                }
                }
                header('location:index.php');
                }
            else{
                $msg = "Username or Password are incorrect.";
                }       

	}
	
}


?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo title; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link rel="stylesheet" href="dist/css/custom.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	
	  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo web; ?>"><b><?php echo website; ?></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Login to your Admin Panel</p>
<?php echo "<p style='color:red;'>$msg</p>";  ?>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="email" name="login_email" class="form-control" placeholder="Email">
                    <div class="input-group-append input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="login_password" class="form-control" placeholder="Password">
                    <div class="input-group-append input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" name="signin" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="forgot-password.php">I forgot my password</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->


	<?php js();?>
	
</body>
</html>