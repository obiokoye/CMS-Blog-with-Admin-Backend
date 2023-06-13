<?php require "../layouts/header.php"; ?> 
<?php require "../../config/config.php"; ?> 


<?php

//this will stop anyone from going into the index page without been logged in
if(!isset($_SESSION['adminname'])){
  header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");
}

$category = $conn->query("SELECT * FROM categories LIMIT 7");
$category->execute();
//This will fetch all the posts 
$rows = $category->fetchAll(PDO::FETCH_OBJ);


?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
             <a  href="create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Name</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($rows as $row): ?>
                  <tr>
                    <th scope="row"><?php echo $row->id;?></th>
                    <td><?php echo $row->name; ?></td>
                    <td><a  href="update-category.php?upcat_id=<?php echo $row->id;?>" class="btn btn-warning text-white text-center ">Edit</a></td>
                    <td><a href="http://localhost/blogcms/admin-panel/categories-admins/delete-category.php?delcat_id=<?php echo $row->id;?>" class="btn btn-danger  text-center ">Delete</a></td>
                  
                  </tr>
               <?php endforeach;?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



  </div>
  <?php require "../layouts/footer.php"; ?> 
