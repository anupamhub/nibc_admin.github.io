<?php 
	require_once 'functions.php';
	require_once 'config.php';
	define ("title", "Manage Pages");
	define ("page_name", "Pages");
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
						<a href="add-pages.php"><button type="button" class="btn btn-sm btn-secondary mbr-5 pull-right">Add Pages</button></a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
					  <table id="example1" class="table table-bordered table-hover">
						<thead>
						<tr>
						  <th>SI</th>
						  <th width="15%">Title</th>
						  <th width="42%">Description</th>
						  
						  
						  <th width="5%">Status</th>
						  <th width="8%">Date Created</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$ctr=0;
						$pages=$conn->query("SELECT * FROM pages");
						while($pag=$pages->fetch_array()){
							$ctr++;
							?>
						<tr>
						  <td><?php echo $ctr;?></td>
						  <td><?= $pag['title']?></td>
						  <td><?= $pag['description']?></td>
						  
						  
						  <td><?php if($pag['status']==1) {echo "Active";} else { echo "Deactive";} ?></td>
						  <td><?php 
						  		$date=date_create($pag['date_created']);
						  		echo date_format($date,"d/m/Y"); ?></td>
						  <td>
						  	<a href="edit-pages.php?p_id=<?php echo $pag['id'];?>" class="btn btn-sm btn-primary mbr-5">
								<i class="fa fa-edit"></i>Edit
							</a>
							

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
	<script type="text/javascript">
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
</body>
</html>