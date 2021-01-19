<?php
ob_start();
include('../includes/db.php');
include('./includes/functions.php');
include('./includes/admin_header.php');
include('./includes/navigation.php');
?>
<div id="wrapper">
  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Blank Page
            <small>Subheading</small>
          </h1>
        </div>
      </div>


      <div class="row">
        <!-- posts -->
        <?php
        $query = 'SELECT * FROM posts';
        $selectPostsQuery = mysqli_query($connection, $query);
        checkQuery($selectPostsQuery);
        while ($row = mysqli_fetch_assoc($selectPostsQuery)) {
          $post_id = $row['post_id'];
          $post_title = $row['post_title'];
          $post_author = $row['post_author'];
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          $post_content = $row['post_content'];
        ?>
          <div class="col-lg-9">
            <a href="post.php?post_id=<?php echo $post_id ?>">
              <h2><?php echo $post_title ?></h2>
            </a>
            <p class="lead">by <a href="#"><?php echo $post_author ?></a></p>
            <p class="lead"><?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="../images/<?php echo $post_image ?>" alt="<?php echo $post_image ?>">
            <hr>
            <p><?php echo strlen($post_content) > 100 ? substr($post_content, 0, 100) . '...' : $post_content ?></p>
            <a href="post.php?post_id=<?php echo $post_id ?>"><button class="btn btn-primary">Read More</button></a>
            <hr>
          </div>
          <br>
        <?php
        }
        ?>
      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<?php include('./includes/footer.php'); ?>