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
      <div class="row">
        <!-- posts -->
        <?php
        if (isset($_GET['post_id'])) {
          $post_id = $_GET['post_id'];
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
          <div class="col-lg-9">
            <h1><?php echo $post_title ?></h1>
            <p class="lead">by <a href="#"><?php echo $post_author ?></a></p>
            <p class="lead"><?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="../images/<?php echo $post_image ?>" alt="<?php echo $post_image ?>">
            <hr>
            <p><?php echo $post_content ?></p>
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