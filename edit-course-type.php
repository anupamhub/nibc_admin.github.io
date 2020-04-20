<?php 
	require_once 'functions.php';
	require_once 'config.php';
	define ("title", "Edit Course Type");
	define ("page_name", "Edit Course Type");
	$msg=null;
?>
<?php
$id = $_GET['cid'];
$course_duration = $conn->query("SELECT * FROM course_type WHERE id='".$_GET['cid']."'");
$row = $course_duration->fetch_assoc();
if(isset($_POST['submit']))	{
		$name = $_POST['name'];
		// url-key-----------------------------
		if(empty($_POST['url_key'])){
			$url_key = str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower(trim($name))));
		}
		else{
			$url_key = str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower(trim($_POST['url_key']))));
		}
		// End Url Key-------------------------
		$status = $_POST['status'];
		$date_created = date('Y-m-d H:i:s');

		$sql=$conn->prepare("UPDATE course_type SET name=?, url_key=?, status=?, date_modified=? WHERE id='".$_GET['cid']."'");
  
    $sql->bind_param("ssis", $name, $url_key, $status, $date_created);
    $sql->execute();
    if($conn->affected_rows==1){
    	$msg="<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Record Added Successfully.</div>";
    	echo "<script> setTimeout(function () { window.location.href = 'edit-course-type.php?cid=$id'; }, 1000); </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>

	<?php head();?>


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
									<?php echo $msg; ?>
									<div class="card card-primary">
										<div class="card-header">
											<h3 class="card-title"><?php echo title;?></h3>
										</div>
										<!-- /.card-header -->
										<!-- form start -->
										
										
										<form role="form" method="post" enctype="multipart/form-data">
											<div class="card-body">

												
													<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="name">Name</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?= $row['name'];?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="url_key">Url Key</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" name="url_key" class="form-control" value="<?= $row['url_key'];?>">
														</div>
													</div>
												</div>
												
												
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label>Status</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<div class="form-check">
																<input name="status" class="form-check-input" type="radio" value="1" id="active" <?php if($row['status']=='1'){echo "checked";} ?>>
																<label class="form-check-label" for="active">Active</label>
															</div>
															<div class="form-check">
																<input name="status" class="form-check-input" type="radio" value="0" id="inactive" <?php if($row['status']=='0'){echo "checked";}?>>
																<label class="form-check-label" for="inactive">Inactive </label>
															</div>
														</div>
													</div>
												</div>
											</div>
												<div class="card-footer">
													<div class="col-3 form-group">
														<button type="submit" class="btn btn-block btn-secondary" name="submit">Submit</button>
													</div>
												</div>
											<!-- /.card-body -->
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
	
		<script src="plugins/summernote/summernote-bs4.min.js"></script>
	<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
</body>
</html>