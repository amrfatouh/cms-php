<?php
ob_start();
include('../includes/db.php');
include('./includes/functions.php');
include('./includes/admin_header.php');
include('./includes/navigation.php');
?>

<?php
if (isset($_GET['delete'])) {
  $comment_id = $_GET['delete'];
  $query = "DELETE FROM comments WHERE comment_id = $comment_id";
  $deleteCommentQuery = mysqli_query($connection, $query);
  checkQuery($deleteCommentQuery);
}
?>

<?php
if (isset($_GET['approve'])) {
  $comment_id = $_GET['approve'];
  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
  $updateCommentQuery = mysqli_query($connection, $query);
  checkQuery($updateCommentQuery);
}
?>

<?php
if (isset($_GET['disapprove'])) {
  $comment_id = $_GET['disapprove'];
  $query = "UPDATE comments SET comment_status = 'disapproved' WHERE comment_id = $comment_id";
  $updateCommentQuery = mysqli_query($connection, $query);
  checkQuery($updateCommentQuery);
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

    </div>

    <?php include("./includes/all_comments.php") ?>

  </div>
  <!-- /#page-wrapper -->

</div>
<?php include('./includes/footer.php'); ?>