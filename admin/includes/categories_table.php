<div class="col-xs-6">
  <table class="table table-bordered">
    <tr>
      <th>Id</th>
      <th>Category</th>
    </tr>
    <?php
    $query = 'SELECT * FROM categories';
    $categoriesQuery = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($categoriesQuery)) {
      $cat_id = $row['cat_id'];
      $cat_title = $row['cat_title'];
    ?>
      <tr>
        <td><?php echo $cat_id ?></td>
        <td><?php echo $cat_title ?></td>
        <td><a href="categories.php?delete=<?php echo $cat_id ?>">Delete</a></td>
        <td><a href="categories.php?edit=<?php echo $cat_id ?>&cat_title=<?php echo $cat_title ?>">Edit</a></td>
      </tr>
    <?php
    }
    ?>
  </table>
</div>