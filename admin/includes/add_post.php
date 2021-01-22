<!-- in post requests of the form you can send parameters -->
<form action="posts.php" method='post' enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input class="form-control" type="text" name="post_title" id="post_title">
  </div>
  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input class="form-control" type="text" name="post_author" id="post_author">
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
        <option value="<?php echo $cat_id ?>"><?php echo $cat_title ?></option>
      <?php
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label name="post_image" for="post_image">Choose Image</label>
    <input type="file" id="post_image" name='post_image'>
  </div>
  <div class="form-group">
    <label for="body">Post Content</label>
    <textarea name="post_content" id="body" class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input class="form-control" type="text" name="post_tags" id="post_tags">
  </div>
  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input class="form-control" type="text" name="post_status" id="post_status">
  </div>
  <input type="submit" value="Publish Post" class="btn btn-primary" name="publish_post">
</form>