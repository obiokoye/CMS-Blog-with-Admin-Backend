<?php require "includes/header.php";?>
<?php require "config/config.php";?>


<?php
if(isset($_POST['search'])){
    if($_POST['search']== ''){
        echo "<script>alert('Enter seacrh keyword first');</script>";

    }else{
        $search = $_POST['search'];

        $data = $conn->query("SELECT * FROM posts WHERE title LIKE '%$search%' AND status = 1");

        $data->execute();

        $rows = $data->fetchAll(PDO::FETCH_OBJ);

        if($data->rowCount() == 0){
            echo "<div class ='alert alert-danger bg-danger text-white text-center'>No searches for this post for now</div>";

        }
    
}

}else{
    header('location: index.php');
}

?>

<div class="col-md-10 col-lg-8 col-xl-7">

<?php if(Count($rows) > 0) : ?>
    <div>Number of posts: (<?php echo Count($rows); ?>)</div>
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
        <?php else: ?>
        <div class ='alert alert-danger bg-danger text-white text-center'>No searches for this post for now</div>";
        <?php endif; ?>
        
    </div>
</div>








<?php require "includes/footer.php"; ?>