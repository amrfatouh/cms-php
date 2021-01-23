<?php include('./includes/db.php'); ?>
<?php include('./admin/includes/functions.php'); ?>
<?php include('./includes/head.php'); ?>
<?php include('./includes/navigation.php'); ?>

<?php
if (isset($_GET['post_id'])) {
  $post_id = $_GET['post_id'];
}
?>

<?php
if (isset($_POST['publish_comment'])) {
  $comment_author = $_POST['comment_author'];
  $comment_email = $_POST['comment_email'];
  $comment_content = $_POST['comment_content'];

  //insert comment query
  $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
  $query .= "VALUES($post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
  $insertCommentQuery = mysqli_query($connection, $query);
  checkQuery($insertCommentQuery);

  //update post_comments_count query
  $query = "UPDATE posts SET post_comments_count = post_comments_count + 1 WHERE post_id = $post_id";
  $updatePostQuery = mysqli_query($connection, $query);
  checkQuery($updatePostQuery);
}
?>



<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <!-- posts -->
      <?php
      if (isset($_GET['post_id'])) {
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $selectPostQuery = mysqli_query($connection, $query);
        checkQuery($selectPostQuery);
        $row = mysqli_fetch_assoc($selectPostQuery);
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];

      ?>
        <h1><?php echo $post_title ?></h1>
        <p class="lead">by <a href="#"><?php echo $post_author ?></a></p>
        <p class="lead"><?php echo $post_date ?></p>
        <hr>
        <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="<?php echo $post_image ?>">
        <hr>
        <p><?php echo $post_content ?></p>
        <hr>
        <br>
        <!-- comments -->
        <?php
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ORDER BY comment_id DESC";
        $selectCommentsQuery = mysqli_query($connection, $query);
        checkQuery($selectCommentsQuery);
        while ($row = mysqli_fetch_assoc($selectCommentsQuery)) {
          $comment_author = $row['comment_author'];
          $comment_content = $row['comment_content'];
        ?>
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" src="http://placehold.it/70" alt="<?php echo $comment_author ?>">
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading"><?php echo $comment_author ?></h4>
              <?php echo $comment_content ?>
            </div>
          </div>
          <hr>
        <?php
        }
        ?>


        <br>
        <br>
        <!-- comment form -->
        <h4>Add Your Comment</h4>
        <hr>
        <form action="post.php?post_id=<?php echo $post_id ?>" method="post">
          <div class="form-group">
            <label for="comment_author">Your Name</label>
            <input class="form-control" type="text" name="comment_author" id="comment_author">
          </div>
          <div class="form-group">
            <label for="comment_email">Your E-mail</label>
            <input class="form-control" type="text" name="comment_email" id="comment_email">
          </div>
          <div class="form-group">
            <label for="comment_content">Your Comment</label>
            <textarea class="form-control" name="comment_content" id="comment_content" rows="4"></textarea>
          </div>
          <input type="submit" value="Comment" name='publish_comment' class='btn btn-primary'>
        </form>
      <?php
      }
      ?>
    </div>
    <?php include('./includes/sidebar.php'); ?>
  </div>

</div>

<?php include "includes/footer.php"; ?>
</body>

</html>