<?php 
	require_once 'functions.php';
	require_once 'config.php';
	define ("title", "Manage Course");
	define ("page_name", "Manage Course");
?>
<?php 
	$msg = null;

	if(isset($_GET['aid'])){
		if($sql = $conn->prepare("UPDATE course SET status='1' WHERE id='".$_GET['aid']."'")){
			$sql->execute();
			$msg = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Status Active</div>";
		}
	}
	if(isset($_GET['inid'])){
		if($sql = $conn->prepare("UPDATE course SET status='0' WHERE id='".$_GET['inid']."'")){
			$sql->execute();
			$msg = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Status Inactive</div>";
		}
	}
	if(isset($_GET['did'])){
		if($sql = $conn->prepare("DELETE FROM course WHERE id='".$_GET['did']."'")){
			$sql->execute();
			$msg = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Record Deleted Successfully.</div>";
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>

	<?php head();?>
	
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<?php header2();?>
		<?php sidebar();?>
		
		<div class="content-wrapper">
			<?php breadcumb();?>
		
		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">
			  <div class="card">
				<div class="card-header">
				  <h3 class="card-title"><?php echo page_name; ?></h3>
				  <a href="add-course.php">
						<button type="button" class="mb-xs mt-xs mr-xs btn btn-sm btn-secondary mbr-5 pull-right">Add New</button></a>
				</div>
				<!-- /.card-header -->
				<?php echo $msg; ?>
				<div class="card-body">
				  <table id="example1" class="table table-bordered table-hover">
					<thead>
					<tr>
					  <th>SI</th>
					  <th>Course Name</th>
					  <th>Course Type</th>
					  <th>Course Duration</th>
					  <th>Course Stream</th>
					  <th>Url Key</th>
					  <th>Status</th>
					  <th width="235px">Action</th>
					</tr>
					</thead>
					<tbody>
						<?php 
						$ctr =0;
						$course = $conn->query("SELECT * FROM course");
						while($row = $course->fetch_assoc()){
							$ctr++;
						?>
					<tr>
					  <td><?php echo $ctr; ?></td>

					  <td><?= $row['course_name']?></td>

					   <?php 
					  $course_type = $conn->query("SELECT * FROM course_type WHERE id='".$row['course_type']."'");
					  $ct = $course_type->fetch_assoc(); ?>
						<td><?php  echo  $ct['name'];?></td>	
					  
					  <?php $course_duration = $conn->query("SELECT * FROM course_duration WHERE id='".$row['course_duration']."'");
					  $cd = $course_duration->fetch_assoc(); ?>
					  	<td><?php echo $cd['name'];?></td>	
					 
					  <?php $course_stream = $conn->query("SELECT * FROM course_stream WHERE id='".$row['course_stream']."'");
					 	$cs = $course_stream->fetch_assoc(); 
					 	?>
					  	<td><?php echo $cs['name'];?></td>	
					  
					  <td><?= $row['url_key'];?></td>
					  <td><?php if($row['status']==1) {echo "<div class='mb-xs mt-xs mr-xs btn btn-sm btn-success mbr-5'>Active</div>";} else{ echo "<div class='mb-xs mt-xs mr-xs btn btn-sm btn-warning mbr-5'>InActive</div>";} ?></td>
						<td>
							<a href="edit-course.php?cid=<?php echo $row['id']?>" class="btn btn-sm btn-primary mbr-5">
							<i class="fa fa-eye">&nbsp;</i>Edit
							</a>
							<a href="?did=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger mbr-5">
							<i class="fa fa-trash">&nbsp;</i>Delete
							</a>
							<?php if($row['status']==0){ ?>
							<a href="?aid=<?php echo $row['id']; ?>" class="mb-xs mt-xs mr-xs btn btn-sm btn-success mbr-5">Active</a>
						<?php }else{ ?>
							<a href="?inid=<?php echo $row['id']; ?>" class="mb-xs mt-xs mr-xs btn btn-sm btn-warning mbr-5">Inactive</a>
						<?php } ?>
						</td>
					</tr>
			<?php } ?>
					</tbody>
				  </table>
				</div>
				<!-- /.card-body -->
			  </div>
			  <!-- /.card -->
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	
		</div>
		
		
		<?php footer2();?>
		
	</div>
	
	<?php js();?>

</body>
</html>