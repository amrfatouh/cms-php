<?php include('./includes/db.php'); ?>
<?php include('./admin/includes/functions.php'); ?>
<?php include('./includes/head.php'); ?>
<?php include('./includes/navigation.php'); ?>

<?php
if (isset($_GET['cat_id'])) {
  $cat_id = $_GET['cat_id'];
}
?>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <h1 class="page-header">
        Page Heading
        <small>Secondary Text</small>
      </h1>

      <!-- showing search results if search term is submitted -->
      <?php
      if (isset($_POST['search_term'])) {
        $search_term = $_POST['search_term'];
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search_term%' AND post_category_id = $cat_id AND post_status = 'published'";
        $searchQuery = mysqli_query($connection, $query);
        if (mysqli_num_rows($searchQuery) > 0) {
          while ($row = mysqli_fetch_assoc($searchQuery)) {
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
      ?>
            <h2>
              <a href="#"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
              by <a href="index.php"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src=<?php echo './images/' . $post_image ?> alt="<?php echo $post_title ?>">
            <hr>
            <p><?php echo $post_content ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
          <?php
          }
        } else {
          echo '<h1>No Results</h1>';
        }
      } else {

        $query = "SELECT * FROM posts WHERE post_category_id = $cat_id  AND post_status = 'published'";
        $selectPostsQuery = mysqli_query($connection, $query);
        checkQuery($selectPostsQuery);
        if (mysqli_num_rows($selectPostsQuery) === 0) {
          echo "<h2>No Results</h2>";
        }
        while ($row = mysqli_fetch_assoc($selectPostsQuery)) {
          $post_id = $row['post_id'];
          $post_title = $row['post_title'];
          $post_author = $row['post_author'];
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          $post_content = $row['post_content'];
          ?>
          <h2>
            <a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
          </h2>
          <p class="lead">
            by <a href="index.php"><?php echo $post_author ?></a>
          </p>
          <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
          <hr>
          <img class="img-responsive" src=<?php echo './images/' . $post_image ?> alt="<?php echo $post_title ?>">
          <hr>
          <p><?php echo strlen($post_content) > 100 ? substr($post_content, 0, 100) . '...' : $post_content ?></p>
          <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

      <?php
        }
      }
      ?>



      <hr>
    </div>

    <?php include('./includes/sidebar.php'); ?>

  </div>
  <!-- /.row -->

  <hr>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>