<?php require "../../config/config.php"; ?> 


<?php 

//this will stop anyone from going into the index page without been logged in
if(!isset($_SESSION['adminname'])){
  header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");
}

if(isset($_GET['comments_id']) AND isset($_GET['status_comments'])) {
  $id = $_GET['comments_id'];
  $status_id = $_GET['status_comments'];


  if($status_id == 0) {
        
      $update = $conn->prepare("UPDATE comments SET status_comments = 1 WHERE id = '$id'");

      $update->execute();

      header('location: http://localhost/blogcms/admin-panel/comments-admins/show-comments.php');
    
    }else{
        $update = $conn->prepare("UPDATE comments SET status_comments = 0 WHERE id = '$id'");

        $update->execute();
      
      header('location: http://localhost/blogcms/admin-panel/comments-admins/show-comments.php');


    }
}else{
    header('location: http://localhost/blogcms/404.php');
}


?>