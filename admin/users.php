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
               <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Manage All User</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <?php
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
      if($do == 'Manage'){?>
   <!-- Body content start -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card card-primary card-outline">
                  <div class="card-header">
                     <h3 class="">Manage All Users</h3>
                  </div>
                  <div class="card-body">
                     <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                           <tr>
                              <th scope="col">#Sl.</th>
                              <th scope="col">Image</th>
                              <th scope="col">Full Name</th>
                              <th scope="col">User Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Address</th>
                              <th scope="col">User Role</th>
                              <th scope="col">Status</th>
                              <th scope="col">Join Date</th>
                              <th scope="col">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $sql = "SELECT * FROM users";
                           $allUsers = mysqli_query($db, $sql);
                           $i = 0;
                           while($row = mysqli_fetch_assoc($allUsers)){
                              $id         = $row['id'];
                              $fullname   = $row['fullname'];
                              $email      = $row['email'];
                              $username   = $row['username'];
                              $password   = $row['password'];
                              $phone      = $row['phone'];
                              $address    = $row['address'];
                              $role       = $row['role'];
                              $status     = $row['status'];
                              $image      = $row['image'];
                              $join_date  = $row['join_date'];
                              $i++;
                           ?>
                           <tr>
                              <th scope="row"><?php echo $i;?></th>
                              <td>
                                 <?php 
                                 if( !empty($image) ){ 
                              ?>
                                 <img src="img/users/<?php echo $image;?>" width="35">

                                 <?php }
                              else{ 
                              ?>
                                 <img src="img/users/default.png" width="35">
                                 <?php }
                              ?>

                              </td>
                              <td><?php echo $fullname;?></td>
                              <td><?php echo $username;?></td>
                              <td><?php echo $email;?></td>
                              <td><?php echo $phone;?></td>
                              <td><?php echo $address;?></td>
                              <td>
                                 <?php 
                                 if ($role == 1){ ?>
                                 <span class="badge badge-success">Admin </span>
                                 <?php }
                                 else if ($role == 2){ ?>
                                 <span class="badge badge-primary">Editor </span>
                                 <?php } ?>
                              </td>
                              <td>
                                 <?php 
                                 if ($status == 0){ ?>
                                 <span class="badge badge-danger">In-Active </span>
                                 <?php }
                                 else if ($status == 1){ ?>
                                 <span class="badge badge-success">Active </span>
                                 <?php } ?>
                              </td>

                              <td><?php echo $join_date;?></td>

                              <td>
                                 <div class="action-bar">
                                    <div class="btn-group btn-group-sm">
                                       <a href="" type="button" class="btn btn-primary">Edit</a>
                                       <a type="button" class="btn btn-danger" data-toggle="modal"
                                          data-target="#delete">Delete</i></a>
                                    </div>
                              </td>
                           </tr>
                           <?php   
                        }
                        ?>
                        </tbody>
                     </table>

                  </div>
               </div>

            </div>
         </div>
      </div>
   </section>
   <!-- Body content end -->
   <?php  }
      else if($do == 'Add'){ ?>

   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card card-primary card-outline">
                  <div class="card-header">
                     <h3 class=""> Add New User</h3>
                  </div>
                  <div class="card-body">
                     <form action="users.php?do=Insert" method="post" enctype="multipart/form-data">
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Full Name</label>
                                 <input type="text" name="fullname" class="form-control" autocomplete="off" required>
                              </div>
                              <div class="form-group">
                                 <label>Username</label>
                                 <input type="text" name="username" class="form-control" autocomplete="off" required>
                              </div>
                              <div class="form-group">
                                 <label>Email Address</label>
                                 <input type="email" name="email" class="form-control" autocomplete="off" required>
                              </div>
                              <div class="form-group">
                                 <label>Password</label>
                                 <input type="password" name="password" class="form-control" autocomplete="off"
                                    required>
                              </div>
                              <div class="form-group">
                                 <label>Repeat Password</label>
                                 <input type="password" name="re-password" class="form-control" autocomplete="off"
                                    required>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Phone Number</label>
                                 <input type="text" name="phone" class="form-control" autocomplete="off">
                              </div>
                              <div class="form-group">
                                 <label>Address</label>
                                 <input type="text" name="address" class="form-control" autocomplete="off">
                              </div>
                              <div class="form-group">
                                 <label>User Role</label>
                                 <select class="form-control" name="role">
                                    <option value="1">Super Admin</option>
                                    <option value="2">Editor</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Status</label>
                                 <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Profile Picture</label>
                                 <input type="file" name="image" class="form-control-file">
                              </div>
                              <div class="form-group">
                                 <input type="submit" name="addUser" class="btn btn-primary" value="Register User">
                              </div>
                           </div>
                        </div>


                     </form>

                  </div>
               </div>

            </div>
         </div>
      </div>
   </section>
   <?php         }
            else if($do == 'Insert'){
              echo "This page is for Insert";
                  }
                  else  if($do == 'Edit'){
                    echo "This page is for Edit";
                        }  
                        else  if($do == 'Update'){
                          echo "This page is for Update";
                              }
                              else  if($do == 'Delete'){
                                echo "This page is for Delete";
                                    }
  
  ?>

</div>

<?php include('inc/footer.php');?>


<!-- Body content start -->
<!-- <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card card-primary card-outline">
                  <div class="card-header">
                     <h3 class="">Manage All Users</h3>
                  </div>
                  <div class="card-body">
                     

                  </div>
               </div>

            </div>
         </div>
      </div>
   </section> -->
<!-- Body content end -->