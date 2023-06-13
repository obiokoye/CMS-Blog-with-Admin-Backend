<?php require "../includes/header.php";?>
<?php require "../config/config.php";?>



<?php 

if(isset($_GET['update_id'])){
  $id = $_GET['update_id'];


  $select = $conn->query("SELECT * FROM posts WHERE id = '$id'");
  $select->execute();
  $rows = $select->fetch(PDO::FETCH_OBJ);

  // this code will restrict user from accessing other pages by editing the link on search bar of the browser
  // if($_SESSION['user_id'] !== $rows->user_id){
  //   header('location: http://localhost/blogcms/index.php');


  // }


  if(isset($_POST['submit'])){
    if($_POST['title']== '' OR $_POST['subtitle']== '' OR $_POST['body']== ''){
      echo "<div class='alert alert-danger bg-warning text-center text-white role='alert'>
      Input data into the fields below!
  </div>";
  }else{

    unlink("../images/" .$rows->img. "");

      $title = $_POST['title'];
      $subtitle = $_POST['subtitle'];
      $body = $_POST['body'];
      $img = $_FILES['img']['name'];

      $dir = '../images/' . basename($img);



      $update = $conn->prepare("UPDATE posts SET title = :title, subtitle = :subtitle, body = :body, img = :img WHERE id = '$id'");

      $update->execute([
          ':title' => $title,
          ':subtitle' => $subtitle,
          ':body' => $body,
          ':img' => $img


          

      ]);

      if(move_uploaded_file($_FILES['img']['tmp_name'], $dir)){

        header('location: http://localhost/blogcms/index.php');
    }

      // header('location: http://localhost/blogcms/index.php');

  }
}
}else{
  header('location: http://localhost/blogcms/404.php');

}


?>


<form method="POST" action="update.php?update_id=<?php echo $id; ?>" enctype="multipart/form-data">
    <!-- Email input -->
    <div class="form-outline mb-4">
      <input type="text" name="title" value="<?php echo $rows->title;?>" id="form2Example1" class="form-control" placeholder="title" />
      
    </div>

    <div class="form-outline mb-4">
      <input type="text" name="subtitle" value="<?php echo $rows->subtitle;?>" id="form2Example1" class="form-control" placeholder="subtitle" />
  </div>

  <div class="form-outline mb-4">
      <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"><?php echo $rows->body;?></textarea>
  </div>
    <!-- this code below will load the image file for a specific post on the edit page -->
    <?php echo "<img src='../images/".$rows->img."' width=300px height=300px>";?>
  <div class="form-outline mb-4">
      <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
  </div>


    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>


</form>


           
  <?php require "../includes/footer.php" ?>