<?php
ob_start();
include('../includes/db.php');
include('./includes/functions.php');
include('./includes/admin_header.php');
include('./includes/navigation.php');
?>

<?php createCategory(); ?>

<?php deleteCategory(); ?>

<?php editCategory(); ?>

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
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-6">
          <form action="" method='post'>
            <div class="form-group">
              <label for="cat_title">Catergory Name</label>
              <input type="text" name="cat_title" id="cat_title" class="form-control">
            </div>
            <input type="submit" value="Add Category" name='submit' class='btn btn-primary'>
          </form>
          <br>

          <!-- edit form in case of clicking edit link -->
          <?php include('./includes/update_categories.php'); ?>
        </div>
        <?php include('./includes/categories_table.php'); ?>

      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<?php include('./includes/footer.php'); ?>