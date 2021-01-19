<div class="row">
  <div class="col-xs-12">
    <table class="table table-bordered table-hover">
      <tr>
        <th>Id</th>
        <th>Category</th>
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
        <th>Image</th>
        <th>Content</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Status</th>
      </tr>
      <?php
      $query = 'SELECT * FROM posts';
      $selectPostsQuery = mysqli_query($connection, $query);
      checkQuery($selectPostsQuery);
      while ($row = mysqli_fetch_assoc($selectPostsQuery)) {
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comments_count = $row['post_comments_count'];
        $post_status = $row['post_status'];

        $categoryQuery = "SELECT * FROM categories WHERE cat_id = $post_category_id";
        $selectCategoryQuery = mysqli_query($connection, $categoryQuery);
        checkQuery($selectCategoryQuery);
        $row = mysqli_fetch_assoc($selectCategoryQuery);
        $cat_title = $row['cat_title'];
      ?>
        <tr>
          <td><?php echo $post_id ?></td>
          <td><?php echo $cat_title ?></td>
          <td><?php echo $post_title ?></td>
          <td><?php echo $post_author ?></td>
          <td><?php echo $post_date ?></td>
          <td><img width="100" src="../images/<?php echo $post_image ?>" alt="<?php echo $post_image ?>"></td>
          <td><?php echo (strlen($post_content) > 50) ? substr($post_content, 0, 50) . '...' : $post_content ?></td>
          <td><?php echo $post_tags ?></td>
          <td><?php echo $post_comments_count ?></td>
          <td><?php echo $post_status ?></td>
          <td><a href="posts.php?delete=<?php echo $post_id ?>">Delete</a></td>
          <td><a href="posts.php?source=edit_post&edit=<?php echo $post_id ?>">Edit</a></td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
</div>