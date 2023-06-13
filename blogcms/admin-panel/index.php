<?php require "layouts/header.php"; ?> 
<?php require "../config/config.php"; ?> 


<?php 
//this will stop anyone from going into the index page without been logged in
if(!isset($_SESSION['adminname'])){
  header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");
}
//this will count the total number of admins
$select = $conn->query("SELECT COUNT(*) AS admins_numbers FROM admins");
$select->execute();
$admins = $select->fetch(PDO::FETCH_OBJ);

//this will count the total number of categories
$select_cats = $conn->query("SELECT COUNT(*) AS category_numbers FROM categories");
$select_cats->execute();
$categories = $select_cats->fetch(PDO::FETCH_OBJ);


//this will count the total number of posts
$select_posts = $conn->query("SELECT COUNT(*) AS post_numbers FROM posts");
$select_posts->execute();
$posts = $select_posts->fetch(PDO::FETCH_OBJ);






?>

            
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Posts</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">Number of posts: <?php echo $posts->post_numbers; ?></>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories: <?php echo $categories->category_numbers; ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">Number of admins: <?php echo $admins->admins_numbers; ?></p>
              
            </div>
          </div>
        </div>
      </div>
     
<?php require "../admin-panel/layouts/footer.php"; ?> 
