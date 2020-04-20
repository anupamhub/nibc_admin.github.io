<?php 
    session_start();
    require_once 'functions.php';
    require_once 'config.php';
    define ("title", "Forgot Password");
    define ("page_name", "Forgot Password");
    /*if ($_SESSION['user_email']==null) {
            header("location:login.php");
    }*/
    
    /*

    $email = $_SESSION['user_email'];
    if( isset($_POST['submit']) ){
        if($change_pass=$conn->prepare("UPDATE users SET password='".md5($_POST['password'])."' where email='$email' ")){
            $change_pass->execute();
            if($change_pass->affected_rows==1){ ?>
                <script>
                    alert('Your password has been changed successfully.');
                    window.location.href = 'https://www.websapex.com/sample/hcssc-new/admin/login.php';
                </script>
                
                <?php
            }
        }
        else{
            echo "something went wrong";exit;
        }
        
    }*/
    $email = $_GET['email'];
    $code = $_GET['code'];
    if ($email==null) {
        header("location:login.php");
    }

    if( isset($_POST['submit']) ){
        if($change_pass=$conn->prepare("UPDATE users SET password='".md5($_POST['password'])."' WHERE email='$email' && code='$code'")){
            $change_pass->execute();
            if($change_pass->affected_rows==1){ ?>
                <script>
                    alert('Your password has been changed successfully.');
                    window.location.href = 'http://localhost/wholesale/login.php';
                </script>
                
                <?php
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
            <p class="login-box-msg">Enter New Password</p>

            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Change Password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="admin.php">Back to Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->


	<?php js();?>
	
</body>
</html>