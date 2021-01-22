<?php
if (isset($_GET['edit'])) {
  $post_id = $_GET['edit'];
  $query = "SELECT * FROM posts WHERE post_id = $post_id";
  $selectPostQuery = mysqli_query($connection, $query);
  checkQuery($selectPostQuery);
  $row = mysqli_fetch_assoc($selectPostQuery);

  $post_category_id = $row['post_category_id'];
  $post_title = $row['post_title'];
  $post_author = $row['post_author'];
  $post_image = $row['post_image'];
  $post_content = $row['post_content'];
  $post_tags = $row['post_tags'];
  $post_status = $row['post_status'];
}
?>


<!-- in post requests of the form you can send parameters -->
<form action="posts.php" method='post' enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input value="<?php echo $post_title ?>" class="form-control" type="text" name="post_title" id="post_title">
  </div>
  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input value="<?php echo $post_author ?>" class="form-control" type="text" name="post_author" id="post_author">
  </div>
  <div class="form-group">
    <label for="post_category_id">Post Category</label>
    <select name="post_category_id" id="post_category_id">
      <?php
      $query = "SELECT * FROM categories";
      $selectCategoriesQuery = mysqli_query($connection, $query);
      checkQuery($selectCategoriesQuery);
      while ($row = mysqli_fetch_assoc($selectCategoriesQuery)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
      ?>
        <option <?php echo $post_category_id === $cat_id ? "selected" : null ?> value="<?php echo $cat_id ?>"><?php echo $cat_title ?></option>
      <?php
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label name="post_image" for="post_image">Choose Image</label>
    <input type="file" id="post_image" name='post_image'>
    <br>
    <img width="150" class="thumbnail" src="<?php echo '../images/' . $post_image ?>" alt="<?php echo $post_image ?>">
  </div>
  <div class="form-group">
    <label for="body">Post Content</label>
    <textarea name="post_content" id="body" class="form-control"><?php echo $post_content ?></textarea>
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags ?>" class="form-control" type="text" name="post_tags" id="post_tags">
  </div>
  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input value="<?php echo $post_status ?>" class="form-control" type="text" name="post_status" id="post_status">
  </div>
  <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
  <input type="submit" value="Publish Post" class="btn btn-primary" name="update_post">
</form>