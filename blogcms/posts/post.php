<?php require "../includes/navbar.php";?>
<?php require "../config/config.php";?>



<?php
//this code will automatically direct an admin to admin login page when they are not logged in
// if(!isset($_SESSION['adminname'])){
//     header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");
//   }

//this code will not allow a user to view posts if they doont register or login
//   if(!isset($_SESSION['username'])){
//     header("location: http://localhost/blogcms/auth/login.php");
//   }
if(isset($_GET['post_id'])){
    $id = $_GET['post_id'];

    $select = $conn->query("SELECT * FROM posts WHERE id = '$id'");
    $select->execute();

    $post = $select->fetch(PDO::FETCH_OBJ);
}else{
    header('location: http://localhost/blogcms/404.php');
}


if(isset($_POST['submit']) AND isset($_GET['post_id'])){
    //we need the id of the post and the username for the person who posted


    if($_POST['comment'] == ''){
        echo "<script>alert('write a cooment');</script>";

    }else{
        $id = $_GET['post_id'];
        $user_name = $_SESSION['username'];
        $comment = $_POST['comment'];
    
        $insert = $conn->prepare("INSERT INTO comments (id_post_comment, user_name_comment, comment) VALUES (:id_post_comment, :user_name_comment, :comment)");
    
        $insert->execute([
            ':id_post_comment' => $id,
            ':user_name_comment' => $user_name,
            ':comment' => $comment
    
        ]);
        //this is a message displayed after a comment is made on a post
        echo "<script>alert('comment added, waiting for admins approval');</script>";

        // header("location: http://localhost/blogcms/posts/post.php?post_id=".$id."");
    }
   

}

//selecting comments..This code is displaying all comments sent to the database with a status of 1, if its not 1 it wont show
$comments = $conn->query("SELECT posts.id AS id, comments.id_post_comment AS id_post_comment, comments.user_name_comment
    AS user_name_comment, comments.comment AS comment, comments.created_at AS created_at,comments.status_comments
     AS status_comments FROM posts JOIN comments ON posts.id = comments.id_post_comment WHERE posts.id = '$id' AND comments.status_comments = 1");

$comments->execute();

//this is used to fetch all comments from the database 
$allcomments =$comments->fetchAll(PDO::FETCH_OBJ);
?>





<header class="masthead" style="background-image: url('../images/<?php echo $post->img;?>')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?php echo $post->title; ?></h1>
                            <span class="subheading"><?php echo $post->subtitle;?></span>
                            <span class="meta">
                            Posted by
                            <a href="#!"><?php echo $post->user_name; ?></a>
                            <?php echo date('M ', strtotime($post->created_at)) . ','. date('d ', strtotime($post->created_at)).','. date('Y ', strtotime($post->created_at));?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p><?php echo $post->body;?></p>
                        <!-- <p>
                            Placeholder text by
                            <a href="http://spaceipsum.com/">Space Ipsum</a>
                            &middot; Images by
                            <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>
                        </p> -->
                            <!-- this code will detect a specific user and if its not his post he wont be able to delete the post unless it was created by him -->
                        <?php if(isset($_SESSION['user_id']) AND $_SESSION['user_id'] == $post->user_id) : ?>
                        <a href="http://localhost/blogcms/posts/delete.php?del_id=<?php echo $post->id; ?>" class="btn btn-danger text-center float-end">Delete</a>

                        <a href="update.php?update_id=<?php echo $post->id;?>" class="btn btn-warning text-center">Edit</a>
                        
                        <?php endif;?>  
                    </div>
                </div>
            </div>
        </article>


        <section>
          <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
              <div class="col-md-12 col-lg-10 col-xl-8">
                <!-- this will display error message when there is no comment written and the user submits an empty comment -->
                <!-- <?php if(isset($_POST['submit']) AND $_POST['comment'] == ''): ?>
                    <div class='bg-danger alert alert-danger text-white'>write a comment</div>
                    <?php endif; ?> -->
                <h3 class="mb-5">Comments</h3>
                <!-- this code below will display a message if there are no comments on a particular article -->
                <?php if(count($allcomments) > 0) : ?>
                    <!--the display of no comments ends here-->
                <?php foreach($allcomments as $comments): ?>
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-start align-items-center">
                    
                        <div>
                            <h6 class="fw-bold text-primary"><?php echo $comments->user_name_comment; ?>
                            <h8 class="p-3 text-black">(<?php echo date('M ', strtotime($comments->created_at)) . ','. date('d ', strtotime($comments->created_at)).','. date('Y ', strtotime($comments->created_at));?>)</h8></h6>
                        </div>
                        </div>

                        <p class="mt-3 mb-4 pb-2">
                        <?php echo $comments->comment; ?>
                        </p>
                   

                        <hr class="my-4" />
                 
                  </div>
                  <?php endforeach; ?>
                  <?php else : ?>
                    <!--this is the messaged displayed if no comments was made-->
                    <div class="text-center">No comments for this post, be the first t comment</div>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['username'])) : ?>

                  <form method="POST" action="post.php?post_id=<?php echo $id; ?>">

                        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">

                            <div class="d-flex flex-start w-100">
                            
                                <div class="form-outline w-100">
                                    <textarea class="form-control" id="" placeholder="write message" rows="4"
                                     name="comment"></textarea>
                                
                                </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm mb-3">Post comment</button>
                            </div>
                        </div>
                    </form>
                    <?php else : ?>
                        <div class='bg-danger alert alert-danger text-white'>Login </div>Login or register to make a comment
                    <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
        </section>



        <?php require "../includes/footer.php" ?>
