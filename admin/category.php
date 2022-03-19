<?php include('inc/header.php')?>
<?php include('inc/topbar.php')?>
<?php include('inc/menu.php')?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Manage Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard v1</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Body content start -->
   <section class="content">
      <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="row">

            <!-- Add New Category -->
            <div class="col-md-6 col-12">

               <div class="card card-primary card-outline">
                  <div class="card-header">
                     <h3 class="">Add New Category</h3>
                  </div>
                  <div class="card-body">
                     <!-- Add Category Form -->
                     <form action="" method="post">
                        <div class="form-group">
                           <label>Category Name</label>
                           <input type="text" class="form-control" name="cat_name" required>
                        </div>

                        <div class="form-group">
                           <label>Category Description</label>
                           <textarea name="cat_desc" class="form-control" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                           <label>Category Status</label>
                           <select name="cat_status" class="form-control" required>
                              <option value="1">Active</option>
                              <option value="0">In-Active</option>
                           </select>
                        </div>

                        <div class="form-group">
                           <input type="submit" class="btn btn-primary" name="add_category" value="Add Category">
                        </div>
                     </form>
                  </div>
               </div><!-- /.card -->

               <!-- Update category -->
               <?php 
               if(isset($_GET['edit'])){
                     $the_cat_id = $_GET['edit'];

                     $sql = "SELECT * FROM category WHERE cat_id ='$the_cat_id'";
                     $cat_info = mysqli_query($db, $sql);

                     while($row = mysqli_fetch_assoc($cat_info)){
                        $cat_id     =  $row['cat_id'];
                        $cat_name   =  $row['cat_name'];
                        $cat_desc   =  $row['cat_desc'];
                        $cat_status =  $row['cat_status'];
                        ?>
               <div class="card card-primary card-outline">
                  <div class="card-header">
                     <h3 class="">Update Category Information</h3>
                  </div>
                  <div class="card-body">
                     <!-- Add Category Form -->
                     <form action="" method="post">
                        <div class="form-group">
                           <label>Category Name</label>
                           <input type="text" class="form-control" name="cat_name" required
                              value="<?php echo $cat_name;?>">
                        </div>

                        <div class="form-group">
                           <label>Category Description</label>
                           <textarea name="cat_desc" class="form-control" rows="10"><?php echo $cat_desc;?></textarea>
                        </div>

                        <div class="form-group">
                           <label>Category Status</label>
                           <select name="cat_status" class="form-control" required>
                              <option value="1" <?php if ($cat_status == 1) {echo 'selected';} ?>>Active</option>
                              <option value="0" <?php if ($cat_status == 0) {echo 'selected';} ?>>In-Active</option>
                           </select>
                        </div>

                        <div class="form-group">
                           <input type="submit" class="btn btn-primary" name="save_changes" value="Save Changes" />
                        </div>
                     </form>
                  </div>
               </div><!-- /.card -->
               <?php   }
               // Update category info
                        if (isset($_POST['save_changes'])){
                           $cat_name      =  $_POST['cat_name'];
                           $cat_desc      =  $_POST['cat_desc'];
                           $cat_status    =  $_POST['cat_status'];
         
                           $sql = "UPDATE category SET cat_name='$cat_name',cat_desc='$cat_desc',cat_status= '$cat_status' WHERE cat_id = '$the_cat_id' ";
                           $update_cat = mysqli_query($db, $sql);
         
                           if($update_cat){
                              header("Location: category.php");
                           }else{
                              die("Mysqli Error" . mysqli_error($db));
                           }
                        }
                    }
               ?>
            </div><!-- /.col-6 -->
            <?php 
               //Add category
               if(isset($_POST['add_category'])){
                  $cat_name      =  $_POST['cat_name'];
                  $cat_desc      =  $_POST['cat_desc'];
                  $cat_status    =  $_POST['cat_status'];

                  $sql = "INSERT INTO category (cat_name,cat_desc,cat_status) VALUES('$cat_name','$cat_desc','$cat_status')";
                  $add_category = mysqli_query($db, $sql);

                  if($add_category){
                     header("Location: category.php");
                  }else{
                     die("Mysqli Error" . mysqli_error($db));
                  }
               }
            ?>

            <!-- Manage Category -->
            <div class="col-md-6 col-12">
               <div class="card card-primary card-outline">
                  <div class="card-header">
                     <h3 class="">Manage All Category</h3>
                  </div>
                  <div class="card-body">

                     <?php
                              $sql = "SELECT * FROM category";
                              $all_cat = mysqli_query($db,$sql);
                              $total_cat = mysqli_num_rows($all_cat);
                              $i = 0;

                              if($total_cat==0) {
                                 echo "No category found";
                              }else{?>

                     <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                           <tr>
                              <th scope="col">#Sl.</th>
                              <th scope="col">Category Name</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
                           </tr>
                        </thead>
                        <tbody>

                           <?php
                                 while($row = mysqli_fetch_assoc($all_cat)){
                                       $cat_id     =  $row['cat_id'];
                                       $cat_name   =  $row['cat_name'];
                                       $cat_desc   =  $row['cat_desc'];
                                       $cat_status =  $row['cat_status'];
                                       $i++;
                                       ?>
                           <tr>
                              <th scope="row"><?php echo $i;?></th>
                              <td><?php echo $cat_name;?></td>
                              <td>
                                 <?php 
                                    if($cat_status == 1){ ?>
                                 <span class="badge badge-success"> Active</span>
                                 <?php   }
                                    else{ ?>
                                 <span class="badge badge-danger"> In-Active</span>
                                 <?php   }
                                 
                                 ?>
                              </td>

                              <td>
                                 <div class="action-bar">
                                    <div class="btn-group btn-group-sm">
                                       <a href="category.php?edit=<?php echo $cat_id;?>" type="button"
                                          class="btn btn-primary">Edit</a>
                                       <a type="button" class="btn btn-danger">Delete</i></a>
                                       </ul>
                                    </div>
                              </td>
                           </tr>
                           <?php         
                              }

                           ?>

                        </tbody>
                     </table>
                     <?php         
                              }

                           ?>
                  </div>
               </div><!-- /.card -->
            </div><!-- /.col-6 -->

         </div><!-- /.row -->
      </div>
   </section>
   <!-- Body content end -->
</div>

<?php include('inc/footer.php');?>