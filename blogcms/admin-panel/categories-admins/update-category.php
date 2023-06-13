<?php require "../layouts/header.php"; ?> 
<?php require "../../config/config.php"; ?> 


<?php 



if(isset($_GET['upcat_id'])){
  $id = $_GET['upcat_id'];

  //this will stop anyone from going into the index page without been logged in
if(!isset($_SESSION['adminname'])){
  header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");
} 


  $select_cat = $conn->query("SELECT * FROM categories WHERE id = '$id'");
  $select_cat->execute();
  $rows = $select_cat->fetch(PDO::FETCH_OBJ);




  if(isset($_POST['submit'])){
    if($_POST['name']== ''){
      echo "<div class='alert alert-danger bg-warning text-center text-white role='alert'>
      Input data into the fields below!
  </div>";
  }else{

    // unlink("../images/" .$rows->img. "");

      $name = $_POST['name'];
     
      $update = $conn->prepare("UPDATE categories SET name = :name WHERE id = '$id'");

      $update->execute([
          ':name' => $name
      
      ]);
      header('location: http://localhost/blogcms/admin-panel/categories-admins/show-categories.php');
    }
  }
  }




?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="" enctype="multipart/form-data"> 
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" value="<?php echo $rows->name;?>" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  <?php require "../layouts/footer.php"; ?> 
