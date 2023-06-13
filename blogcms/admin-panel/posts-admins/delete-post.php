<?php require "../../config/config.php";?> 


<?php 
//this will get the delete id per user 
if(isset($_GET['po_id'])){
    $id = $_GET['po_id'];

   
    $delete = $conn->prepare("DELETE FROM posts WHERE id = :id");
    $delete->execute([
        ':id' => $id
    ]);

    header('location: http://localhost/blogcms/admin-panel/posts-admins/show-posts.php');
}else{
    header("location: http://localhost/blogcms/404.php");
}


?>