<?php require "../layouts/header.php"; ?> 
<?php require "../../config/config.php"; ?> 


<?php 

//this will stop anyone from going into the index page without been logged in
if(!isset($_SESSION['adminname'])){
  header("location: http://localhost/blogcms/admin-panel/admins/login-admins.php");
}

$comments = $conn->query("SELECT posts.id AS id, posts.title AS title, comments.id AS comments_id,
 comments.id_post_comment AS id_post_comment, comments.user_name_comment AS user_name_comment, comments.comment AS comment, comments.status_comments AS status_comments FROM comments 
JOIN posts ON posts.id = comments.id_post_comment");
$comments->execute();
//This will fetch all the posts 
$rows = $comments->fetchAll(PDO::FETCH_OBJ);





?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Comments</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Title</th>
                    <th scope="col">Comment</th>
                    <th scope="col">User</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($rows as $row):?>
                  <tr>
                    <th scope="row"><?php echo $row->comments_id;?></th>
                    <td><?php echo $row->title; ?></td>
                    <td><?php echo $row->comment;?></td>
                    <td><?php echo $row->user_name_comment; ?></td>
                    <?php if($row->status_comments == 0): ?>
                      <td><a href="http://localhost/blogcms/admin-panel/comments-admins/status-comments.php?comments_id=<?php echo $row->comments_id; ?>&status_comments=<?php echo $row->status_comments;?>" class="btn btn-danger text-center ">Deactivated</a></td>

                      <?php else: ?>
                        <td><a href="http://localhost/blogcms/admin-panel/comments-admins/status-comments.php?comments_id=<?php echo $row->comments_id; ?>&status_comments=<?php echo $row->status_comments;?>" class="btn btn-success text-center ">Activated</a></td>
                        <?php endif;?>

                     <td><a href="http://localhost/blogcms/admin-panel/comments-admins/delete-comments.php?comments_id=<?php echo $row->comments_id;?>" class="btn btn-danger text-center ">delete</a></td>
                  </tr>
                 <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



  </div>
  <?php require "../layouts/footer.php"; ?> 
