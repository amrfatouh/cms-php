<?php
ob_start();
include('../includes/db.php');
include('./includes/functions.php');
include('./includes/admin_header.php');
include('./includes/navigation.php');
?>

<!-- creating a new row in posts table in database -->
<?php
if (isset($_POST['publish_post'])) {
  $post_category_id = $_POST['post_category_id'];
  $post_title = $_POST['post_title'];
  $post_author = $_POST['post_author'];
  $post_image = $_FILES['post_image']['name'];
  $post_image_temp_location = $_FILES['post_image']['tmp_name'];
  $post_content = $_POST['post_content'];
  $post_tags = $_POST['post_tags'];
  $post_status = $_POST['post_status'];

  move_uploaded_file($post_image_temp_location, '../images/' . $post_image);

  $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
  $query .= "VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";
  $insertPostQuery = mysqli_query($connection, $query);
  checkQuery($insertPostQuery);
}
?>

<!-- updating a row in posts table in database -->
<?php
if (isset($_POST['update_post'])) {
  $post_id = $_POST['post_id'];
  $post_category_id = $_POST['post_category_id'];
  $post_title = $_POST['post_title'];
  $post_author = $_POST['post_author'];
  $post_image = $_FILES['post_image']['name'];
  $post_image_temp_location = $_FILES['post_image']['tmp_name'];
  $post_content = $_POST['post_content'];
  $post_tags = $_POST['post_tags'];
  $post_status = $_POST['post_status'];

  $query = "UPDATE posts SET ";
  $query .= "post_category_id = $post_category_id, ";
  $query .= "post_title = '$post_title', ";
  $query .= "post_author = '$post_author', ";
  $query .= "post_content = '$post_content', ";
  $query .= "post_tags = '$post_tags', ";
  $query .= "post_date = now(), ";
  $query .= "post_status = '$post_status'";

  if (!empty($post_image)) {
    $query .= ", post_image = '$post_image'";
    move_uploaded_file($post_image_temp_location, '../images/' . $post_image);
  }

  $query .= " WHERE post_id = $post_id";
  $updatePostQuery = mysqli_query($connection, $query);
  checkQuery($updatePostQuery);
}
?>

<?php
if (isset($_GET['delete'])) {
  $post_id = $_GET['delete'];
  $query = "DELETE FROM posts WHERE post_id = $post_id";
  $deletePostQuery = mysqli_query($connection, $query);
  checkQuery($deletePostQuery);
}
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
      <?php
      if (isset($_GET['source'])) {
        $source = $_GET['source'];
        switch ($source) {
          case 'add_post':
            include('./includes/add_post.php');
            break;
          case 'edit_post':
            include('./includes/edit_post.php');
            break;
          default:
            include('./includes/all_posts.php');
        }
      } else {
        include('./includes/all_posts.php');
      }
      ?>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<?php include('./includes/footer.php'); ?>