<?php 
	require_once 'functions.php';
	require_once 'config.php';
	define ("title", "Add User");
	define ("page_name", "Add User");
	$msg=null;
?>
<?php
if(isset($_POST['submit']))	{
		$name = $_POST['name'];
		//$url_key = $_POST['url_key'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$password = md5($_POST['password']);
		$otp = '-';
		$code = '-';
		$profile = $_POST['profile'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$status = $_POST['status'];
		$date_created = date_create("Y-m-d H:i:s");

		$main_img = $_FILES['main_img']['name']; 
   if(empty($_FILES['main_img']['tmp_name'])) {
      $final_main_image = "";
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
		$sql=$conn->prepare("INSERT INTO users SET name=?, email=?, mobile=?, password=?, otp=?, code=?, profile=?, photo=?, address=?, city=?, state=?, status=?, date_created=?, date_modified=?");
  
    $sql->bind_param("sssssssssssiss", $name, $email, $mobile, $password, $otp, $code, $profile, $final_main_image, $address, $city, $state, $status, $date_created, $date_created);
    $sql->execute();
    if($conn->affected_rows==1){

    	$last_insert_id = mysqli_insert_id($conn);

		// url-key-----------------------------
		if(empty($_POST['url_key'])){
			$url_key = str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower(trim($name))));
			echo $url_key = $url_key.$last_insert_id; 
		}
		else{
			$url_key = str_replace("---","-",preg_replace("/[^-a-zA-Z0-9s]/", "-", strtolower(trim($_POST['url_key']))));
		}
		// End Url Key-------------------------

		$sql=$conn->prepare("UPDATE users SET url_key=? WHERE id='".$last_insert_id."'");
  
    $sql->bind_param("s", $url_key);
    $sql->execute();
    	$msg="<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Record Added Successfully.</div>";
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
															<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="email">Email</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="mobile">Mobile</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" value="">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="password">Password</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="password" name="password" placeholder="Enter password" value="">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="profile">Profile</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="profile" name="profile" placeholder="Enter Profile" value="">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="password">Photo</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="file" name="main_img">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="address">Address</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="address" name="address" placeholder="Address" value="">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="country">Country</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															 <select name="country" id="country-list" class="form-control" required>
															<?php
												                $countries = $conn->query("SELECT * FROM countries");
																while($country = $countries->fetch_array()) {	?>
																	<option dataCountry="<?php echo $country["id"]; ?>" value="<?php echo $country["name"]; ?>"><?php echo $country["name"]; ?></option>
												                <?php } ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="state">State</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															 <select name="state" id="state-list" class="form-control" required>
															<?php
												                $states = $conn->query("SELECT * FROM states WHERE country_id='101'");
																while($state = $states->fetch_array()) {	?>
																	<option dataState="<?php echo $state["id"]; ?>" value="<?php echo $state["name"]; ?>"><?php echo $state["name"]; ?></option>
												                <?php } ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-3">
														<div class="form-group">
															<label for="city">City</label>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<select name="city" id="city-list" class="form-control">
															    <option>Select City</option>
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
															<input type="text" name="url_key" class="form-control" value="">
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

	  	$("#country-list").change(function() {
			var dataCountry = $('option:selected', this).attr('dataCountry');

			$.ajax({
				type: "POST",
				url: "ajax/get-state.php",
				data:'country_id='+dataCountry,
				beforeSend: function() {
					$("#country-list").addClass("loader");
				},
				success: function(data){
					$("#state-list").html(data);
					$("#state-list").removeClass("loader");
				}
			});

		});

      $("#state-list").change(function() {
		var dataState = $('option:selected', this).attr('dataState');

		$.ajax({
			type: "POST",
			url: "ajax/get-city.php",
			data:'state_id='+dataState,
			beforeSend: function() {
				$("#state-list").addClass("loader");
			},
			success: function(data){
				$("#city-list").html(data);
				$("#city-list").removeClass("loader");
			}
		});

	});
</script>
</body>
</html>