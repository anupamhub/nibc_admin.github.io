<?php 
	require_once 'functions.php';
	require_once 'config.php';
	define ("title", "Edit Blog Comment");
	define ("page_name", "Edit Blog Comment");
?>
<?php
$msg=null;
$id=$_GET['cid'];
$blog_comment = $conn->query("SELECT * FROM blog_comment WHERE id='$id'");
$blog_data = $blog_comment->fetch_assoc();
$msg = null;
if(isset($_POST['submit'])){
    //$blog_id = $row['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $approval = $_POST['status'];
    $date_created = date('Y-m-d H:i:sa');
    $query = $conn->prepare("UPDATE blog_comment SET name=?, email=?, comment=?, approval_status=?, date_created=? WHERE id='".$id."'");
    $query->bind_param("sssis", $name, $email, $comment, $approval, $date_created);
    $query->execute();
    if($conn->affected_rows==1){
        $msg = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Record updated Successfully.</div>";
        echo "<script> setTimeout(function () { window.location.href = 'edit-blog-comment.php?cid=$id'; }, 1000); </script>";
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
															<label for="project_name">Name</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="title" name="name" placeholder="Enter Title" value="<?= $blog_data['name'];?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="description">Email</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="title" name="email" placeholder="Enter Email" value="<?= $blog_data['email'];?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="comment">Comment</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
														</div>
														<textarea class="form-control" name="comment"><?= $blog_data['comment'];?></textarea>
															
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label>Approval Status</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<div class="form-check">
																<input name="status" class="form-check-input" type="radio" value="1" id="active" <?php if($blog_data['approval_status'] == 1) {echo "checked";}?>>
																<label class="form-check-label" for="active">Active</label>
															</div>
															<div class="form-check">
																<input name="status" class="form-check-input" type="radio" value="0" id="inactive" <?php if($blog_data['approval_status'] == 0) {echo "checked";}?>>
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