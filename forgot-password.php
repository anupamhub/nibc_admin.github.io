<?php 
    session_start();
	require_once 'functions.php';
    require_once 'config.php';
	define ("title", "Forgot Password");
	define ("page_name", "Forgot Password");

    $msg=null;

   /* if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $_SESSION['user_email'] = $email;
        header("location:forgot.php");

    }*/

    if( isset($_POST['submit']) ){
        $email = $_POST['email'];
        $otp = md5(substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 10)), 0, 10));

        if($dt=$conn->prepare("UPDATE users SET code='$otp' WHERE email='$email' ")){
            $dt->execute();
            
            if($dt->affected_rows==1){
                $to = $email;
                $subject = "Forgot Password: Request for Recover the Password";

                $message = "
                <html>
                    <head>
                        <title>Recover the Password</title>
                    </head>
                    <body>
                        <p>Go through this link for reset the password</p>
                        <a href='https://www.websapex.com/sample/hcssc-new/admin/forgot.php?email=$email&code=$otp'>
                            <input type='submit' />
                        </a>
                    </body>
                </html>
                ";

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: HCSSC <admin@hcssc.in>' . "\r\n";
                $headers .= 'BCc: websapex@gmail.com' . "\r\n";

                if(mail($to,$subject,$message,$headers)){
                    $msg = "<button class='btn btn-success'>Please check your e-mail to reset your password.</button>";
                }

            }
            else {
                $msg = "<h4 class='form-box-header'>You are not authorized Person</h4>";
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
            <p class="login-box-msg">Enter your Email ID to Reset Your Password</p>

            <form  method="post">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="login.php">Back to Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->


	<?php js();?>
	<script type="text/javascript">
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
</body>
</html>