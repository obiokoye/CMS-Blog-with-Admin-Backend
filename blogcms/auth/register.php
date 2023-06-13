<!-- this will include the header into the project -->
<?php require "../includes/header.php" ?>    

<!-- this will connect the config file where the database is stored -->
<?php require "../config/config.php" ?>

<?php 
//this will automatically move a logged in user to the home page
if(isset($_SESSION['username'])){
  header("location: http://localhost/blogcms/index.php");
}

if(isset($_POST['submit'])){
  
  if($_POST['email']== '' OR $_POST['username'] == '' OR $_POST['password']== ''){
            echo "<div class='alert alert-danger bg-warning text-center text-white role='alert'>
             Input data into the fields below!
            </div>";
  }else {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash( $_POST['password'], PASSWORD_DEFAULT);


    $insert = $conn->prepare("INSERT INTO users (email, username,mypassword) VALUES(:email, :username, :mypassword)");
    
    $insert->execute([
      ':email'=> $email,
      ':username' => $username,
      ':mypassword' => $password    
    
    ]);

    // this will automatically redirect the newly registered user to login page
    header("location: login.php");
  
  
  }
}



?>


            <form method="POST" action="register.php">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" />
               
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                
              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>Aleardy a member? <a href="login.php">Login</a></p>
                

               
              </div>
            </form>


           
  <?php require "../includes/footer.php" ?>     