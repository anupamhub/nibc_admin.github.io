<?php 
	require_once 'functions.php';
	require_once 'config.php';
	define ("title", "Edit Course");
	define ("page_name", "Edit Course");
	$msg=null;
?>
<?php
$id= $_GET['cid'];
$course= $conn->query("SELECT * FROM course WHERE id='".$_GET['cid']."'");
$row = $course->fetch_assoc(); 
if(isset($_POST['submit']))	{
		$course_type = $_POST['course_type'];
		$course_duration = $_POST['course_duration'];
		$course_stream = $_POST['course_stream']; 
		$course_name = $_POST['course_name'];
		// url-key-----------------------------
		if(empty($_POST['url_key'])){
			$url_key = str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower(trim($course_name))));
		}
		else{
			$url_key = str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower(trim($_POST['url_key']))));
		}
		// End Url Key-------------------------

		$eligibility = $_POST['eligibility'];
		$course_details = $_POST['course_details'];
		$added_by = $_POST['added_by'];
		$status = $_POST['status'];
		$date_created = date_create("Y-m-d H:i:s");


		
		$main_img = $_FILES['main_img']['name']; 
   if(empty($_FILES['main_img']['tmp_name'])) {
      $final_main_image = $_POST['hidden_main_img'];
    }
    else {
      if (($_FILES['main_img']['type'] == "image/jpeg")
      || ($_FILES['main_img']['type'] == "image/jpg")
      || ($_FILES['main_img']['type'] == "image/gif")
      || ($_FILES['main_img']['type'] == "image/png")) {
      
        $cat_image = preg_replace('/\s+/', '-', $main_img);

        //If file exists change the name Start
        if(file_exists('uploads/images/'.$main_img)){
          $actual_name = pathinfo($main_img,PATHINFO_FILENAME);
          $original_name = $actual_name;
          $extension = pathinfo($main_img, PATHINFO_EXTENSION);
          
          $i = 1;
          while(file_exists('uploads/images/'.$actual_name.".".$extension))
          {           
            $actual_name = (string)$original_name.$i;
            $img_name = $actual_name.".".$extension;
            $i++; 
          } 
          $final_main_image=$img_name; 
        }
        else {
          $final_main_image=$main_img;
        }
        //If file exists change the name End
        
        move_uploaded_file($_FILES['main_img']['tmp_name'],'uploads/images/'.$final_main_image);
      }
      else
      {
        $msg = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button>Image must be in JPG, GIF or PNG Format.</div>";
      }
    }	
		$sql=$conn->prepare("UPDATE course SET course_type=?, course_duration=?, course_stream=?, course_name=?, eligibility=?, course_details=?, course_photo=?, added_by=?, status=?, url_key=?, date_modified=? WHERE id='".$_GET['cid']."'");
  
    $sql->bind_param("ssssssssiss", $course_type, $course_duration, $course_stream, $course_name, $eligibility, $course_details, $final_main_image, $added_by, $status, $url_key, $date_created);
    $sql->execute();
    
    	if($conn->affected_rows==1){

    	$last_insert_id = $id;

		// url-key-----------------------------
		if(empty($_POST['url_key'])){
			$url_key = str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower(trim($course_name))));
			echo $url_key = $url_key.$last_insert_id; 
		}
		else{
			$url_key = str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower(trim($_POST['url_key']))));
		}
		// End Url Key-------------------------

		$sql=$conn->prepare("UPDATE course SET url_key=? WHERE id='".$last_insert_id."'");
  
    $sql->bind_param("s", $url_key);
    $sql->execute();
    	$msg="<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Record Updated Successfully.</div>";
    	echo "<script> setTimeout(function () { window.location.href = 'edit-course.php?cid=$id'; }, 1000); </script>";
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
															<label for="name">Course Type</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<select class="form-control" name="course_type" >
																<?php 
																$course_type = $conn->query("SELECT * FROM course_type WHERE status='1'");
																while ($ct = $course_type->fetch_assoc()) { ?>
																	<option value="<?= $ct['id'];?>" <?php if($ct['id']==$row['course_type']){echo "selected";}?>><?= $ct['name'];?></option>
																<?php } ?>
																	
															</select>
															
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="email">Course Duration</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<select class="form-control" name="course_duration" >
																<?php 
																$course_duration = $conn->query("SELECT * FROM course_duration WHERE status='1'");
																while ($cd = $course_duration->fetch_assoc()) { ?>
																<option value="<?= $cd['id'];?>" <?php if($cd['id']==$row['course_duration']){echo "selected";}?>><?= $cd['name'];?></option>	
															<?php } ?>
															</select>												
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="mobile">Course Stream</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<select class="form-control" name="course_stream" >
																<?php 
																$course_stream = $conn->query("SELECT * FROM course_stream WHERE status='1'");
																while ($cs = $course_stream->fetch_assoc()) { ?>
																<option value="<?= $cs['id'];?>" <?php if($cs['id']==$row['course_stream']){echo "selected";}?>><?= $cs['name'];?></option>	
															<?php } ?>
															</select>
															
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="password">Course Name</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="course_name" name="course_name" placeholder="Course Name" value="<?= $row['course_name']; ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="profile">Eligibility</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="eligibility" name="eligibility" placeholder="Eligibility" value="<?= $row['eligibility']; ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="password">Course Detials</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<textarea class="textarea" name="course_details"><?= $row['course_details']; ?></textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="address">Course Photo</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="file" id="main_img" name="main_img">
															<input type="hidden" name="hidden_main_img" value="<?= $row['course_photo']; ?>">
															<img src="uploads/images/<?= $row['course_photo']; ?>" width="100px" width="75px">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="city">Added By</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<select name="added_by" class="form-control">
																<?php 
																$user = $conn->query("SELECT * FROM users WHERE status='1'"); 
																while ($user_data = $user->fetch_assoc()) {
																?>
																<option value="<?= $user_data['id']; ?>" <?php if($user_data['id']==$row['added_by']){echo "selected";}?>><?= $user_data['name']; ?></option>
															<?php } ?>
															</select>
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
																<input name="status" class="form-check-input" type="radio" value="1" id="active" <?php if($row['status']=='1'){echo "checked";}?>>
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