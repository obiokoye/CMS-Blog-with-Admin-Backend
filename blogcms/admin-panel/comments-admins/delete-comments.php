<?php require "../../config/config.php";?> 


<?php 
//this will get the delete id per user 
if(isset($_GET['comments_id'])){
    $id = $_GET['comments_id'];

   
    $delete = $conn->prepare("DELETE FROM comments WHERE id = :id");
    $delete->execute([
        ':id' => $id
    ]);

    header('location: http://localhost/blogcms/admin-panel/comments-admins/show-comments.php');
}else{
    header("location: http://localhost/blogcms/404.php");
}


?>