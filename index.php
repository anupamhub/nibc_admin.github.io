<?php 

require_once 'functions.php';
require_once 'config.php';
    define ("title", "Wholesale");
    define ("page_name", "Enquiry");

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
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <?php //foreach ($conn->query("SELECT COUNT(*) FROM enquiry") as $row) {
                                ?>
                                <div class="inner">
                                    <h3><?php //echo $row['COUNT(*)']?>56</h3>
                                <?php //} ?>
                                    <p>Enquiry</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="enquiry.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                               <?php //foreach ($conn->query("SELECT COUNT(*) FROM enquiry") as $row) {
                                ?>
                                <div class="inner">
                                    <h3><?php //echo $row['COUNT(*)']?>34</h3>
                                <?php // } ?>
                                    <p>Wholesale Enquiry</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="wholesale-enquiry.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                 <?php //foreach ($conn->query("SELECT COUNT(*) FROM orders") as $row) {
                                ?>
                                <div class="inner">
                                    <h3><?php //echo $row['COUNT(*)']?>78</h3>
                                <?php //} ?>
                                    <p>Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="orders.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <?php //foreach ($conn->query("SELECT COUNT(*) FROM customers") as $row) {
                                ?>
                                <div class="inner">
                                    <h3><?php //echo $row['COUNT(*)']?>41</h3>
                                <?php //} ?>
                                    <p>Customers</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="all-customers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
		</div>
		
		
		<?php footer2();?>
		
	</div>
	
	<?php js();?>
	
</body>
</html>