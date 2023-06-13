<?php require "../layouts/header.php"; ?> 
<?php require "../../config/config.php";?> 


<?php 
//this will get the delete id per user 
if(isset($_GET['delcat_id'])){
    $id = $_GET['delcat_id'];

    //this will select the posts and the id and with te images
    $select_cat = $conn->query("SELECT * FROM categories WHERE id ='$id'");
    $select_cat->execute();
    $category = $select_cat->fetch(PDO::FETCH_OBJ);
    
   
    $delete = $conn->prepare("DELETE FROM categories WHERE id = :id");
    $delete->execute([
        ':id' => $id
    ]);

    header('location: http://localhost/blogcms/admin-panel/categories-admins/show-categories.php');
}


?>