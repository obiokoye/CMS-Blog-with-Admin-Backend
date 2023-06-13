<?php require "../layouts/header.php"; ?> 
<?php require "../../config/config.php"; ?> 



<?php 
//this will automatically move a logged in user to the home page
// if(isset($_SESSION['username'])){
//   header("location: http://localhost/blogcms/index.php");
// }
//this will stop anyone from going into the index page without been logged in
if(!isset($_SESSION['adminname'])){
  header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");
}

if(isset($_POST['submit'])){
  
  if($_POST['email']== '' OR $_POST['adminname'] == '' OR $_POST['password']== ''){
            echo "<div class='alert alert-danger bg-warning text-center text-white role='alert'>
             Input data into the fields below!
            </div>";
  }else {
    $email = $_POST['email'];
    $adminname = $_POST['adminname'];
    $password = password_hash( $_POST['password'], PASSWORD_DEFAULT);


    $insert = $conn->prepare("INSERT INTO admins (email, adminname,mypassword) VALUES(:email, :adminname, :mypassword)");
    
    $insert->execute([
      ':email'=> $email,
      ':adminname' => $adminname,
      ':mypassword' => $password    
    
    ]);

    // this will automatically redirect the newly registered user to login page
    header("location: http://localhost/blogcms/admin-panel/index.php");
  
  
  }
}




?>


       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="adminname" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  <?php require "../layouts/footer.php"; ?> 
