<?php require "../layouts/header.php"; ?> 
<?php require "../../config/config.php"; ?> 


<?php 

//this will restrict users from accessing the login page when they are already logged in..it will redirect them back to index page
if(isset($_SESSION['adminname'])){
  header("location: http://localhost/blogcms/admin-panel/index.php");
}
//check for the submit action
if(isset($_POST['submit'])){
    if($_POST['email']== '' OR $_POST['password']== ''){
      echo "<div class='alert alert-danger bg-warning text-center text-white role='alert'>
      Input data into the fields below!
  </div>";
    }else{
        //take the data from the input
        $email = $_POST['email'];
        $password = $_POST['password'];

        //write our query
        $login = $conn->query("SELECT * FROM admins WHERE email = '$email'");

        //fetch execute and then fetch
        $login->execute();

        $row = $login->FETCH(PDO::FETCH_ASSOC);

        //do our rowCount
        if($login->rowCount()> 0){

            // password verify function
            if(password_verify($password, $row['mypassword'])){

                             // echo "logged in";

                //session: they are used to carry informations across different pages at the backend application..things like a username, password, id etc
                $_SESSION['adminname'] = $row['adminname'];
                //this wil detect the user ID per post they make
                $_SESSION['admin_id'] = $row['id'];


                   //redirect the user to the home page
                header('location: http://localhost/blogcms/admin-panel/index.php');
            }
        }else{
          echo "<div class='alert alert-danger bg-warning text-center text-white role='alert'>
              The email or password you entered is wrong!
          </div>";
        }
    
    }
}

?>

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" class="p-auto" action="login-admins.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                 
                </form>

            </div>
       </div>
     </div>
    </div>
   
    <?php require "../layouts/footer.php"; ?> 
