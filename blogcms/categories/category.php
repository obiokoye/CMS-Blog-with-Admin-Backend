<?php require "../includes/header.php";?>
<?php require "../config/config.php";?>


<?php


if(isset($_GET['cat_id'])){
    $id = $_GET['cat_id'];


    $posts = $conn->query("SELECT posts.id AS id, posts.title AS title, 
    posts.subtitle AS subtitle, posts.user_name AS user_name,
    posts.created_at AS created_at, posts.status AS status, posts.category_id AS category_id
    FROM categories JOIN posts ON categories.id = posts.category_id 
    WHERE posts.category_id= '$id' AND status = 1");
    $posts->execute();
    //This will fetch all the posts 
    $rows = $posts->fetchAll(PDO::FETCH_OBJ);

}else{
    header('location: http://localhost/blogcms/404.php');
    // echo "404";
    
}




?>

   <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">

                    <?php foreach($rows as $row) :?>
                    <div class="post-preview">
                        <a href="http://localhost/blogcms/posts/post.php?post_id=<?php echo $row->id; ?>">
                            <h2 class="post-title"><?php echo $row->title; ?></h2>
                            <h3 class="post-subtitle"><?php echo $row->subtitle; ?></h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!"><?php echo $row->user_name; ?></a>
                            <?php echo date('M ', strtotime($row->created_at)) . ','. date('d ', strtotime($row->created_at)).','. date('Y ', strtotime($row->created_at));?>
                        </p>
                    </div>
                    
                 <?php endforeach; ?>
                    
                </div>
            </div>






















































































<?php require "../includes/footer.php";?>
