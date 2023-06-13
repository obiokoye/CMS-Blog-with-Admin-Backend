<?php require "../layouts/header.php"; ?> 
<?php require "../../config/config.php"; ?> 



<?php 

if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
  
    //this will stop anyone from going into the index page without been logged in
  if(!isset($_SESSION['adminname'])){
    header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");
  } 
  
  
    $select_admin = $conn->query("SELECT * FROM admins WHERE id = '$id'");
    $select_admin->execute();
    $rows = $select_admin->fetch(PDO::FETCH_OBJ);
  
  
  
  
    if(isset($_POST['submit'])){
      if($_POST['email']== ''OR $_POST['adminname'] == ''){
        echo "<div class='alert alert-danger bg-warning text-center text-white role='alert'>
        Input data into the fields below!
    </div>";
    }else{
  
  
        $email = $_POST['email'];
        $adminname = $_POST['adminname'];

       
        $update = $conn->prepare("UPDATE admins SET email = :email, adminname = :adminname WHERE id = '$id'");
  
        $update->execute([
            ':email' => $email,
            ':adminname' => $adminname
        
        ]);
        header('location: http://localhost/blogcms/admin-panel/admins/admins.php');
      }
    }
    }
  




?>


       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Edit Admins</h5>
          <form method="POST" action="edit-admins.php?edit_id=<?php echo $id; ?>">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" value="<?php echo $rows->email;?>" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="adminname" value="<?php echo $rows->adminname;?>" id="form2Example1" class="form-control" placeholder="adminname" />
                </div>
                <!-- <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div> -->

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  <?php require "../layouts/footer.php"; ?> 
