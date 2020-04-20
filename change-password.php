<?php 

	require_once("functions.php");
	require_once('config.php');
	define ("title", "Change Password");
 	define ("page_name","Change Password");

  
?>    
<!DOCTYPE html>
<html>
<head>

	<?php head();?>
	<?php 

	$msg=null;
	//echo $_SESSION['user_login']['email'];
	if( isset($_POST['submit']) ){
		
		if($change_pass=$conn->prepare("UPDATE admin SET password='".md5($_POST['password'])."'
			WHERE username='".$_SESSION['login_user']['username']."' ")){
			$change_pass->execute();
			if($change_pass->affected_rows==1){ ?>
				<script>
					alert('Your password has been changed successfully.');
					window.location.href = 'http://localhost/nibc_admin/logout.php';
				</script>
				
				<?php
			}
		}
		
	}



	 ?>
	
		<!-- summernote -->
		<link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
	
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<?php header2();?>
		<?php sidebar();?>
		
		<div class="content-wrapper">
			<?php breadcumb();?>
					
					<section class="content">
						<div class="container-fluid">
							<div class="row">
								<!-- left column -->
								<div class="col-md-12">
									<!-- general form elements -->
									<div class="card card-primary">
										<div class="card-header">
											<h3 class="card-title"><?php echo page_name; ?></h3>
										</div><br>
										<!-- /.card-header -->
										<!-- form start -->
													<?php echo $msg;?>
										<form role="form" method="post" enctype="multipart/form-data" >
											<div class="card-body">
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="password">New Password</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" required>

														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="submit" class="form-control btn btn-primary" id="submit" name="submit" value="Submit">
															
														</div>
													</div>
												</div>
											</div>
											
										</form>
									</div>
									<!-- /.card -->

								</div>
								<!--/.col (left) -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.container-fluid -->
					</section>
	
		</div>
		
		
		<?php footer2();?>
		
	</div>
	
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