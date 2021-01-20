<div class="row">
  <div class="col-xs-12">
    <table class="table table-bordered table-hover">
      <tr>
        <th>Id</th>
        <th>Post Id</th>
        <th>Author</th>
        <th>E-mail</th>
        <th>Comment</th>
        <th>Status</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Disapprove</th>
        <th>Delete</th>
      </tr>
      <?php
      $query = "SELECT * FROM comments";
      $selectCommentsQuery = mysqli_query($connection, $query);
      checkQuery($selectCommentsQuery);
      while ($row = mysqli_fetch_assoc($selectCommentsQuery)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        $postQuery = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $selectPostQuery = mysqli_query($connection, $postQuery);
        checkQuery($selectPostQuery);
        $row = mysqli_fetch_assoc($selectPostQuery);
        $comment_post_title = $row['post_title'];
      ?>
        <tr>
          <td><?php echo $comment_id ?></td>
          <td><a href="../post.php?post_id=<?php echo $comment_post_id ?>"><?php echo $comment_post_title ?></a></td>
          <td><?php echo $comment_author ?></td>
          <td><?php echo $comment_email ?></td>
          <td><?php echo strlen($comment_content) > 50 ? substr($comment_content, 0, 50) . '...' : $comment_content ?></td>
          <td><?php echo $comment_status ?></td>
          <td><?php echo $comment_date ?></td>
          <td><a href='comments.php?approve=<?php echo $comment_id ?>'>Approve</a></td>
          <td><a href='comments.php?disapprove=<?php echo $comment_id ?>'>Disapprove</a></td>
          <td><a href='comments.php?delete=<?php echo $comment_id ?>'>Delete</a></td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
</div>