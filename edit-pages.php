<?php 
	require_once 'functions.php';
	require_once 'config.php';
	define ("title", "Edit Page");
	define ("page_name", "Page");
	
?>
<?php
$msg=null;
$id=$_GET['p_id'];
if(isset($_POST['submit']))	{
		$title = $_POST['title'];
		// url-key-----------------------------
		if(empty($_POST['url_key'])){
			$url_key = str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower(trim($title))));
		}
		else{
			$url_key = str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower(trim($_POST['url_key']))));
		}
		// End Url Key-------------------------
		$description = ($_POST['description']);
		$status = $_POST['status'];
		$date_modified = date('Y-m-d H:i:s');

		$sql=$conn->prepare("UPDATE pages SET title=?, description=?, url_key=?, status=?, date_modified=? WHERE id='$id'");
  
    $sql->bind_param("sssss", $title, $description, $url_key, $status, $date_modified);
    $sql->execute();
    if($conn->affected_rows==1){
    	$msg="<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Record Updated Successfully.</div>";
    	echo "<script> setTimeout(function () { window.location.href = 'edit-pages.php?p_id=$id'; }, 1000); </script>";
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
									<div class="card card-primary">
										<div class="card-header">
											<h3 class="card-title"><?php echo title;?></h3>
										</div>
										<!-- /.card-header -->
										<!-- form start -->
										<?php echo $msg; 
										$pages=$conn->query("SELECT * FROM pages WHERE id='$id'");
										$pag=$pages->fetch_array()?>
										<form role="form" method="post" enctype="multipart/form-data">
											<div class="card-body">

												
													<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="project_name">Title</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="title" name="title" placeholder="Enter Page Name" value="<?= $pag['title']; ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="description">Description</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<textarea class="textarea" name="description" id="description" placeholder="Place some text here"><?= $pag['description']; ?></textarea>
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
															<input type="text" name="url_key" value="<?= $pag['url_key'];?>" class="form-control">
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
																<input name="status" class="form-check-input" type="radio" value="1" id="active" checked>
																<label class="form-check-label" for="active">Active</label>
															</div>
															<div class="form-check">
																<input name="status" class="form-check-input" type="radio" value="0" id="inactive">
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