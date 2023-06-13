<?php require "../../config/config.php";?> 


<?php 
//this will get the delete id per user 
if(isset($_GET['del_id'])){
    $id = $_GET['del_id'];

   
    $delete = $conn->prepare("DELETE FROM admins WHERE id = :id");
    $delete->execute([
        ':id' => $id
    ]);

    header('location: http://localhost/blogcms/admin-panel/admins/admins.php');
}else{
    header("location: http://localhost/blogcms/404.php");
}


?>