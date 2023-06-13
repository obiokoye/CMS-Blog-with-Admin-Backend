<?php require "../includes/header.php";?>
<?php require "../config/config.php";?>



<?php 

if(isset($_GET['prof_id'])){
  $id = $_GET['prof_id'];


  $select = $conn->query("SELECT * FROM users WHERE id = '$id'");
  $select->execute();
  $rows = $select->fetch(PDO::FETCH_OBJ);

  //this code will restrict user from accessing other pages by editing the link on search bar of the browser
  if($_SESSION['user_id'] !== $rows->id){
    header('location: http://localhost/blogcms/index.php');


  }


  if(isset($_POST['submit'])){
    if($_POST['email']== '' OR $_POST['username']== ''){
      echo 'one input or more are empty';
  }else{

    // unlink("../images/" .$rows->img. "");

      $email = $_POST['email'];
      $username = $_POST['username'];
     

    //   $dir = '../images/' . basename($img);



      $update = $conn->prepare("UPDATE users SET email = :email, username = :username WHERE id = '$id'");

      $update->execute([
          ':email' => $email,
          ':username' => $username

      ]);

     

      header('location: http://localhost/blogcms/users/profile.php?prof_id='.$_SESSION['user_id'].'');

  }
}
}else{
  header('location: http://localhost/blogcms/404.php');

}


?>


<form method="POST" action="profile.php?prof_id=<?php echo $id; ?>" enctype="multipart/form-data">
    <!-- Email input -->
    <div class="form-outline mb-4">
      <input type="email" name="email" value="<?php echo $rows->email;?>" id="form2Example1" class="form-control" placeholder="email" />
      
    </div>

    <div class="form-outline mb-4">
      <input type="text" name="username" value="<?php echo $rows->username;?>" id="form2Example1" class="form-control" placeholder="username" />
  </div>

  


    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>


</form>


           
  <?php require "../includes/footer.php" ?>