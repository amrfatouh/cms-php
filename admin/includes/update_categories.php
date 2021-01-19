<?php
if (isset($_GET['edit'])) {
  $cat_id = $_GET['edit'];
  $cat_title = $_GET['cat_title'];
?>
  <form action="categories.php" method='post'>
    <div class="form-group">
      <label for="updated_cat_title">Catergory New Name</label>
      <input autofocus type="text" value="<?php echo $cat_title ?>" name="updated_cat_title" id="updated_cat_title" class="form-control">
    </div>
    <input type="hidden" name="cat_id" value="<?php echo $cat_id ?>">
    <input type="submit" value="Edit Category" name='update_submit' class='btn btn-primary'>
  </form>
<?php
}

?>