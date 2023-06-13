<?php require "../includes/header.php";?>
<?php require "../config/config.php";?>


<?php 
//this will automatically move a logged in user to the home page
if(isset($_SESSION['username'])){
  header("location: http://localhost/blogcms/index.php");
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
        $login = $conn->query("SELECT * FROM users WHERE email = '$email'");

        //fetch execute and then fetch
        $login->execute();

        $row = $login->FETCH(PDO::FETCH_ASSOC);

        //do our rowCount
        if($login->rowCount()> 0){

            // password verify function
            if(password_verify($password, $row['mypassword'])){

                             // echo "logged in";

                //session: they are used to carry informations across different pages at the backend application..things like a username, password, id etc
                $_SESSION['username'] = $row['username'];
                //this wil detect the user ID per post they make
                $_SESSION['user_id'] = $row['id'];


                   //redirect the user to the home page
                header('location: http://localhost/blogcms/index.php');
            }
        }else{
          echo "<div class='alert alert-danger bg-warning text-center text-white role='alert'>
              The email or password you entered is wrong!
          </div>";
        }
    
    }
}


?>

<form method="POST" action="login.php">
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

  <!-- Register buttons -->
  <div class="text-center">
    <p>a new member? Create an acount<a href="register.php"> Register</a></p>
    

    
  </div>
</form>

           
       <?php require "../includes/footer.php" ?>