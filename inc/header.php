
<?php function head() { ?>
<?php 
ob_start();

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
 if($_SESSION['login_user']==""){
        header('location:login.php');
    }
    ?>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo title; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link rel="stylesheet" href="dist/css/custom.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
<?php } function header2(){ ?>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>


    </ul>

<ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">Profile</a>
          
        
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="change-password.php" class="dropdown-item">Change Password</a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item">Logout</a>
       </li>
 </ul>
    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

<?php } function sidebar(){ ?>


	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
		<a href="index.php" class="brand-link">
			<img src="dist/img/AdminLTELogo.png"
				alt="AdminLTE Logo"
				class="brand-image img-circle elevation-3"
				style="opacity: .8">
			<span class="brand-text font-weight-light">AdminLTE 3</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
				</div>
				<div class="info">
					<a href="#" class="d-block"><?php echo $_SESSION['login_user']['username']?></a>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
					with font-awesome or any other icon font library -->
					
					<!-- <li class="nav-item">
						<a href="index.php" class="nav-link">
							<i class="nav-icon fas fa-th"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="enquiry.php" class="nav-link">
							<i class="nav-icon fas fa-file"></i>
							<p>Enquiry</p>
						</a>
					</li> -->
					<li class="nav-item has-treeview">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-th"></i>
							<p>Courses<i class="right fas fa-angle-left"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="manage-course-type.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage Course Type</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="manage-course-duration.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage Course Duration</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="manage-course-stream.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage Course Stream</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="manage-course.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage Course</p>
								</a>
							</li>
						</ul>		
					</li>
					<li class="nav-item has-treeview">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-th"></i>
							<p>
								Blog
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="manage-blog-category.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage Blog Category</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="manage-blog.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage Blog</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="manage-blog-comment.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage Blog Comment</p>
								</a>
							</li>	
						</ul>
					</li>
					
					<li class="nav-item has-treeview">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-th"></i>
							<p>
								Pages
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="manage-pages.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage Pages</p>
								</a>
							</li>	
						</ul>
					</li>
					<li class="nav-item has-treeview">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-th"></i>
							<p>
								User
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="manage-user.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage User</p>
								</a>
							</li>	
						</ul>
					</li>
					<li class="nav-item has-treeview">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-th"></i>
							<p>
								Faq
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="manage-faq-category.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage Faq Category</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="manage-faq.php" class="nav-link">
									<i class="nav-icon fas fa-edit"></i>
									<p>Manage Faq</p>
								</a>
							</li>	
						</ul>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>

<?php } function breadcumb(){ ?>
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <div class="container-fluid">
			<div class="row mb-2">
			  <div class="col-sm-6">
				<h1><?php echo page_name; ?></h1>
			  </div>
			  <div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				  <li class="breadcrumb-item"><a href="#">Home</a></li>
				  <li class="breadcrumb-item active"><?php echo page_name; ?></li>
				</ol>
			  </div>
			</div>
		  </div><!-- /.container-fluid -->
		</section>
		
<?php } function mobile_menu(){ ?>

<?php } ?>