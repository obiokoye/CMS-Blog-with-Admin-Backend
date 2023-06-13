<?php require "../layouts/header.php"; ?> 
<?php require "../../config/config.php";?> 



<?php

//this will stop anyone from going into the index page without been logged in
if(!isset($_SESSION['adminname'])){
  header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");
}

$admins = $conn->query("SELECT * FROM admins LIMIT 7");
$admins->execute();
//This will fetch all the posts 
$rows = $admins->fetchAll(PDO::FETCH_OBJ);




?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>

                  </tr>
                </thead>
                <tbody>
                  <?php foreach($rows as $row): ?>
                  <tr>
                    <th scope="row"><?php echo $row->id; ?></th>
                    <td><?php echo $row->adminname; ?></td>
                    <td><?php echo $row->email; ?></td>

                    <!-- <td><a  href="edit-admin.php" class="btn btn-success btn-sm text-white text-center ">Edit Admin</a></td>
                    <td><a href="delete-admin.php" class="btn btn-danger btn-sm text-center ">Delete Admin</a></td>
                   -->
                    <?php //if(isset($_SESSION['adminname']) AND $_SESSION['adminname'] == $row->adminname) : ?>
                      <td><a href="http://localhost/blogcms/admin-panel/admins/edit-admins.php?edit_id=<?php echo $row->id;?>" class="btn btn-success btn-sm text-white text-center ">Edit</a></td>
                    
                      <td><a href="http://localhost/blogcms/admin-panel/admins/delete-admins.php?del_id=<?php echo $row->id; ?>" class="btn btn-danger btn-sm text-center">Delete</a></td>
                      
                      <?php //endif;?>
                   
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



  </div>
  <?php require "../layouts/footer.php"; ?> 
