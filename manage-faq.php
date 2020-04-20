<?php 
    require_once 'functions.php';
    require_once 'config.php';
    define ("title", "Manage Faq");
    define ("page_name", "Manage Faq");

    $msg=null;

    //========================================================================================================
    $l='';
  $limit=10;
  if (isset($_GET['page'])) { $page=$_GET['page'];}else{ $page=1; }
  $start_from = ($page-1) * $limit; 

  //===========================================================================================================
    if(isset($_GET['did'])){
              if ($stmt=$conn->prepare ("DELETE from faq WHERE id='".$_GET['did']."' ")){
                $stmt->execute();
                $msg = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Record Deleted Successfully.</div>";
              }
            }

          if(isset($_GET['aid'])){
            if($sql = $conn->prepare("UPDATE faq SET status='1' WHERE id ='".$_GET['aid']."' ")) {
              $sql->execute();
              $msg = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Status Active</div>";
            }
          }

          if(isset($_GET['inid'])){
             if($sql = $conn->prepare("UPDATE faq SET status='0' WHERE id ='".$_GET['inid']."' ")) {
                $sql->execute();
                $msg = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>×</button>Status Deactive</div>
                ";
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
                  <a href="add-faq.php">
                  <button type="button" class="btn bg-gradient-secondary pull-right">Add Faq</button></a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <?php echo $msg;?>
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Date</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Status </th>
                      <th width="236px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sl=$conn->query("SELECT * FROM faq ORDER BY id DESC LIMIT $start_from,$limit");
                    
                    while($row=$sl->fetch_array()){
                  

                    ?>
                    <tr>
                    <td><?php 
                  $date=date_create($row['date_created']);
                  echo date_format($date,"d/m/Y"); ?></td>
                    <td><?= $row['title'];?></td>
                    <?php $category = $conn->query("SELECT title FROM faq_category WHERE id='".$row['category_id']."'"); 
                   while($cat = $category->fetch_array()){
                      ?>
                      <td><?php echo $cat['title'];?></td>
                    <?php } ?>
                    
                    <td><?php if($row['status'] == '1'){echo "<span class='mb-xs mt-xs mr-xs btn btn-sm btn-success mbr-5'>Active</span>";}else{ echo "<span class='mb-xs mt-xs mr-xs btn btn-sm btn-warning mbr-5'>Inactive</span>"; } ?></td>
                    <td>
                        <a href="edit-faq.php?cid=<?php echo $row['id']?>" class="btn btn-sm btn-primary mbr-5">
                        <i class="fa fa-eye">&nbsp;</i>Edit
                        </a>
                        <a href="?did=<?php echo  $row['id']?>" class="btn btn-sm btn-danger mbr-5">
                        <i class="fa fa-eye">&nbsp;</i>Delete
                        </a>
                        <?php if($row['status']==0){ ?>
                        <a href="?aid=<?php echo $row['id']; ?>" class="mb-xs mt-xs mr-xs btn btn-sm btn-success mbr-5">Active</a>
                      <?php }else{ ?>
                        <a href="?inid=<?php echo $row['id']; ?>" class="mb-xs mt-xs mr-xs btn btn-sm btn-warning mbr-5">Inactive</a>
                      <?php } ?>
              
                  </td>
                    </tr>
                    <?php }
                    ?>
                    </tbody>
                    </table>

                    </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- /.Pagination -->

            <ul class="pagination">
          <?php  
        // echo $start_from;
          $sql1 = "SELECT COUNT(id) FROM faq";
          $rs_result = mysqli_query($conn,$sql1);  
          $rw = mysqli_fetch_row($rs_result);  
          $total_records = $rw[0];  
          $total_pages = ceil($total_records / $limit);
        
        ?>
         <li>
          <?php
            if($page == 1){
          ?>
          <li class="paginate_button previous disabled">
            <a href="#" >PREV</a>
          </li>
          <?php }else{ ?>
            <li class="paginate_button previous">
              <a href="manage-faq.php?page=<?= ($page-1);?>">PREV</a>
            </li>
            <li class=""><a href="manage-faq.php?page=1" >1</a></li>
            
            <li class="paginate_button"><a>...</a></li>
            <?php }?></li>
        <?php
          for ($i=$page; $i<=$page+5 && $i<=$total_pages-1; $i++) {
        ?>
          <li class="paginate_button <?php if($page == $i){echo 'active';}else{ echo ''; } ?>"><a href="manage-faq.php?page=<?= $i;?>" ><?= $i;?></a></li>
        <?php
          }
        ?>

        <li class="pg-text">
          <?php
            if($total_pages == $page){
          ?>
          
          <li class="paginate_button active"><a href="manage-faq.php?page=<?= $total_pages;?>" ><?= $total_pages;?></a></li>
          
          <li class="paginate_button previous disabled">
            <a href="#" >NEXT</a>
          </li>
        <?php }else{?>
        
          <li class="paginate_button"><a>...</a></li>
          <li class="paginate_button"><a href="manage-faq.php?page=<?= $total_pages;?>" ><?= $total_pages;?></a></li>
          <li class="paginate_button next">
            <a href="manage-faq.php?page=<?= ($page+1);?>">NEXT</a>
          </li>
        <?php }?>
        </li>
            </ul>

          <!-- /.End Pagination -->
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