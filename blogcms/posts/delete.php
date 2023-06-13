<?php require "../includes/navbar.php";?>

<?php require "../config/config.php";?> 


<?php 
//this will get the delete id per user 
if(isset($_GET['del_id'])){
    $id = $_GET['del_id'];

    //this will select the posts and the id and with te images
    $select = $conn->query("SELECT * FROM posts WHERE id ='$id'");
    $select->execute();
    $posts = $select->fetch(PDO::FETCH_OBJ);
    
    //this code will not allow other users to delete a post or image if they are not the ones that posted it
    if($_SESSION['user_id'] !== $posts->user_id){
        header('location: http://localhost/blogcms/index.php');

    }else{
        //this will delete the image attached to a specific post
    unlink("../images/" . $posts->img. "");

    //this will delete a specific post from the database
    $delete = $conn->prepare("DELETE FROM posts WHERE id = :id");
    $delete->execute([
        ':id' => $id
    ]);
    }

    
    header('location: http://localhost/blogcms/index.php');
}else{
    header('location: http://localhost/blogcms/404.php');

}


?>