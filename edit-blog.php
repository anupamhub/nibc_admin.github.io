<?php 
	require_once 'functions.php';
	require_once 'config.php';
	define ("title", "Edit Blog");
	define ("page_name", "Edit Blog");
	$msg=null;
?>
<?php
$msg=null;
$id=$_GET['cid'];
$blogs = $conn->query("SELECT * FROM blog WHERE id='$id'");
$blog = $blogs->fetch_assoc();
if(isset($_POST['submit']))	{
		$category_id = $_POST['category_id'];
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
		$profile_img=$_FILES['artist_img']['name'];

    if(empty($_FILES['artist_img']['tmp_name'])) {
      $final_profile_image = $_POST['hidden_artist_img'];
    }
    else {
      if (($_FILES['artist_img']['type'] == "image/jpeg")
      || ($_FILES['artist_img']['type'] == "image/jpg")
      || ($_FILES['artist_img']['type'] == "image/gif")
      || ($_FILES['artist_img']['type'] == "image/png")) {
      
        $cat_image = preg_replace('/\s+/', '-', $profile_img);

        //If file exists change the name Start
        if(file_exists('../uploads/blog/'.$profile_img)){
          $actual_name = pathinfo($profile_img,PATHINFO_FILENAME);
          $original_name = $actual_name;
          $extension = pathinfo($profile_img, PATHINFO_EXTENSION);
          
          $i = 1;
          while(file_exists('../uploads/blog/'.$actual_name.".".$extension))
          {           
            $actual_name = (string)$original_name.$i;
            $img_name = $actual_name.".".$extension;
            $i++; 
          } 
          $final_profile_image=$img_name; 
        }
        else {
          $final_profile_image=$profile_img;
        }
        //If file exists change the name End
        
        move_uploaded_file($_FILES['artist_img']['tmp_name'],'../uploads/blog/'.$final_profile_image);
      }
      else
      {
        $msg = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button>Image must be in JPG, GIF or PNG Format.</div>";
      }
    }

		$sql=$conn->prepare("UPDATE blog SET blog_category_id=?, title=?, description=?, image=?, url_key=?, status=?,  date_modified=? WHERE id='$id'");
  
    $sql->bind_param("issssis", $category_id, $title, $description, $final_profile_image, $url_key, $status, $date_modified);
    $sql->execute();
    if($conn->affected_rows==1){
    	$msg="<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Record Updated Successfully.</div>";
    	echo "<script> setTimeout(function () { window.location.href = 'edit-blog.php?cid=$id'; }, 1000); </script>";
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
															<label for="project_name">Category</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<select class="form-control" name="category_id">
																<option value="0">Choose Category</option>

																<?php 
																$blog_category = $conn->query("SELECT * FROM blog_category");
																while($blog_data = $blog_category->fetch_assoc()){
																?>
																<option value="<?= $blog_data['id'];?>" <?php if($blog_data['id']==$blog['blog_category_id']) echo "selected";?>><?= $blog_data['title'];?></option>
															<?php } ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="project_name">Title</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="<?= $blog['title'];?>">
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
															<textarea class="textarea" name="description" id="description" placeholder="Place some text here"><?= $blog['description'];?></textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="image">Image</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="hidden" name="hidden_artist_img" value="<?= $blog['image'];?>">
															<img src="../uploads/blog/<?= $blog['image'];?>" width="100px" height="100px">
															<input type="file" name="artist_img">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="project_name">Url Key</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
														</div>
															<input type="text" class="form-control" id="url_key" name="url_key" placeholder="" value="<?= $blog['url_key'];?>">
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
																<input name="status" class="form-check-input" type="radio" value="1" id="active" <?php if($blog['status'] == 1) {echo "checked";}?>>
																<label class="form-check-label" for="active">Active</label>
															</div>
															<div class="form-check">
																<input name="status" class="form-check-input" type="radio" value="0" id="inactive" <?php if($blog['status'] == 0) {echo "checked";}?>>
																<label class="form-check-label" for="inactive">Inactive</label>
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