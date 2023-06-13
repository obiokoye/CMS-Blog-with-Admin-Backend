<?php require "includes/header.php";?>
<?php require "config/config.php";?>

<?php 
//this will connect to the database and fetch each post stored inside posts table
$posts = $conn->query("SELECT * FROM posts WHERE  status = 1 LIMIT 5");
$posts->execute();
//This will fetch all the posts 
$rows = $posts->fetchAll(PDO::FETCH_OBJ);


//BELOW IS THE CATEGORIES FUNCTIONS CODE
$categories = $conn->query("SELECT * FROM categories");
$categories->execute();
$category = $categories->fetchAll(PDO::FETCH_OBJ);




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


            <!-- the codes bellow will load the categories stored in the database -->
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <h3 class="mb-5">CATEGORIES</h3>
                       
                <?php foreach ($category as $cat) : ?>
                    <div class="col-md-6">
                    <a href="http://localhost/blogcms/categories/category.php?cat_id=<?php echo $cat->id; ?>">
                        <div class="alert alert-dark bg-dark text-center text-white" role="alert">
                        <?php echo $cat->name; ?>
                        </div>
                    </a>
                
                    </div>
                    <?php endforeach; ?>
            </div>


 