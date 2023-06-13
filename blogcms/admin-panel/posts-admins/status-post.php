<?php require "../../config/config.php"; ?> 


<?php 

//this will stop anyone from going into the index page without been logged in
if(!isset($_SESSION['adminname'])){
  header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");
}

if(isset($_GET['id']) AND isset($_GET['status_id'])) {
  $id = $_GET['id'];
  $status_id = $_GET['status_id'];


  if($status_id == 0) {
        
      $update = $conn->prepare("UPDATE posts SET status = 1 WHERE id = '$id'");

      $update->execute();

      header('location: http://localhost/blogcms/admin-panel/posts-admins/show-posts.php');
    
    }else{
        $update = $conn->prepare("UPDATE posts SET status = 0 WHERE id = '$id'");

        $update->execute();
      
      header('location: http://localhost/blogcms/admin-panel/posts-admins/show-posts.php');


    }
}else{
    header('location: http://localhost/blogcms/404.php');
}


?>