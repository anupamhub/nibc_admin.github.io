<?php 
	require_once 'functions.php';
	require_once 'config.php';
	define ("title", "Add FAQ");
	define ("page_name", "Add FAQ");
	$msg=null;
?>
<?php
$msg=null;
if(isset($_POST['submit']))	{
		$faq_category_id = $_POST['faq_category'];
		$title = ($_POST['title']);
		$status = 0;
		$date_created = date('Y-m-d H:i:s');
		$date_modified = date('Y-m-d H:i:s');

		$sql=$conn->prepare("INSERT INTO faq SET category_id=?, title=?, status=?, date_created=?, date_modified=?");
  
    $sql->bind_param("isiss", $faq_category_id, $title, $status, $date_created, $date_modified);
    $sql->execute();
    if($conn->affected_rows==1){

    	$faq_id = mysqli_insert_id($conn);

    	if(!empty($_POST['question'])) {
		$question = $_POST['question'];
   		$answer = $_POST['answer'];
   		$sorting = $_POST['sorting'];
		for($j=0; $j < count($_POST['question']); $j++){

			$sql=$conn->prepare("INSERT INTO faq_questions SET faq_id=?, question=?, answer=?, sorting=?");
			$sql->bind_param("issi",$faq_id, $question[$j], $answer[$j], $sorting[$j]);
			$sql->execute();

		}
	}

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
											<input type="button" class="btn btn-warning" name="add_btn" onclick="addFaq();" value="Add New Question" style="float: right;margin-top: -28px;">
										</div>
										<!-- /.card-header -->
										<!-- form start -->
										
										
										<form role="form" method="post" enctype="multipart/form-data">
											<div class="card-body">
												<div class="row">
													<div class="col-2">
														<div class="form-group">
															<label for="project_name">Category</label>
														</div>
													</div>

													<div class="col-6">
														<div class="form-group">
															<select name="faq_category" class="form-control">
																<option value="">Choose Category</option>
																<?php 
																$faq_category = $conn->query("SELECT * FROM faq_category");
																while ($faq_cat = $faq_category->fetch_assoc()) { ?>
																	<option value="<?= $faq_cat['id'];?>"><?= $faq_cat['title'];?></option>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-2">
														<div class="form-group">
															<label for="project_name">Title</label>
														</div>
													</div>

													<div class="col-6">
														<div class="form-group">
															<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="">
														</div>
													</div>
												</div>
												<div class="row" id="addFaq"></div>
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

   var count=1;
   var value_faq_row=101;
	function addFaq(){
		html = '<div id="addFaq'+ value_faq_row + '">';
		html += 	'<div class="row">';
		html += 		'<div class="col-4">';
		html += 			'Question -'+ count +').<hr>';
		html += 		'</div>';
		html += 		'<div class="col-8">';
		html += 			'<div class="form-group">';
		html += 				'<a id="" style="margin-top: -5px; float:right;" class="btn btn-xs btn-danger" onclick="$(\'#addFaq' + value_faq_row + '\').remove();"><i class="fa fa-times"></i> Delete</a>';
		html += 			'</div>';
		html += 		'</div>';
		html += 	'</div>';
		html += 	'<div class="row">';
		html += 		'<div class="col-2">';
		html += 			'<div class="form-group">';
		html += 			'<label for="question">Question</label>';
		html += 			'</div>';
		html += 		'</div>';
		html += 		'<div class="col-6">';
		html += 			'<div class="form-group">';
		html += 			'<input type="text" class="form-control" id="question" name="question[]" placeholder="Enter Question" value="">';
		html += 			'</div>';
		html += 		'</div>';
		html += 	'</div>';
		html += 	'<div class="row">';
		html += 		'<div class="col-2">';
		html += 			'<div class="form-group">';
		html += 			'<label for="answer">Description</label>';
		html += 			'</div>';
		html += 		'</div>';
		html += 		'<div class="col-6">';
		html += 			'<div class="form-group">';
		html += 			'<textarea class="textarea" name="answer[]" id="answer" placeholder="Please Type Your Answer"></textarea>';
		html += 			'</div>';
		html += 		'</div>';
		html += 	'</div>';
		html += 	'<div class="row">';
		html += 		'<div class="col-2">';
		html += 			'<div class="form-group">';
		html += 			'<label for="sorting">Sorting</label>';
		html += 			'</div>';
		html += 		'</div>';
		html += 		'<div class="col-6">';
		html += 			'<div class="form-group">';
		html += 			'<input class="form-control" type="text" name="sorting[]" id="sorting" placeholder="Sorting">';
		html += 			'</div>';
		html += 		'</div>';
		html += 	'</div>';
		
		
		$(function () {
    // Summernote
    $('.textarea').summernote()
  })

		$('#addFaq').before(html);
		count++;
		value_faq_row++;

	}
</script>
</body>
</html>