<?php
ob_start();
include('../includes/db.php');
include('./includes/functions.php');
include('./includes/admin_header.php');
include('./includes/navigation.php');
?>

<?php
if (isset($_GET['delete'])) {
  $user_id = $_GET['delete'];
  $query = "DELETE FROM users WHERE user_id = '$user_id'";
  $deleteUserQuery = mysqli_query($connection, $query);
  checkQuery($deleteUserQuery);
  $deleteUserSuccess = true;
}
?>

<!-- creating a new row in users table in database -->
<?php
if (isset($_POST['add_user'])) {
  $user_name = $_POST['user_name'];
  $user_password = $_POST['user_password'];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_role = $_POST['user_role'];

  $query = "INSERT INTO users(user_name, user_password, user_firstname, user_lastname, user_email, user_role) ";
  $query .= "VALUES ('$user_name', '$user_password', '$user_firstname', '$user_lastname', '$user_email', '$user_role')";
  $insertUserQuery = mysqli_query($connection, $query);
  checkQuery($insertUserQuery);
  $createUserSuccess = true;
}
?>

<!-- updating a row in users table in database -->
<?php
if (isset($_POST['edit_user'])) {
  $user_id = $_POST['user_id'];
  $user_name = $_POST['user_name'];
  $user_password = $_POST['user_password'];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_role = $_POST['user_role'];

  $query = "UPDATE users SET ";
  $query .= "user_name = '$user_name', ";
  $query .= "user_password = '$user_password', ";
  $query .= "user_firstname = '$user_firstname', ";
  $query .= "user_lastname = '$user_lastname', ";
  $query .= "user_email = '$user_email', ";
  $query .= "user_role = '$user_role'";
  $query .= " WHERE user_id = $user_id";

  $updateUserQuery = mysqli_query($connection, $query);
  checkQuery($updateUserQuery);
  $updateUserSuccess = true;
}
?>

<div id="wrapper">
  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            All Users
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <?php
          if (isset($_POST['add_user']) && $createUserSuccess) echo "<div class='text-success'>User Created</div>";
          else if (isset($_POST['edit_user']) && $updateUserSuccess) echo "<div class='text-success'>User Updated</div>";
          else if (isset($_GET['delete']) && $deleteUserSuccess) echo "<div class='text-success'>User Deleted</div>";
          ?>
          <table class="table table-bordered table-hover">
            <tr>
              <th>Id</th>
              <th>Username</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>E-mail</th>
              <th>Image</th>
              <th>Role</th>
            </tr>
            <?php
            $query = 'SELECT * FROM users';
            $selectUsersQuery = mysqli_query($connection, $query);
            checkQuery($selectUsersQuery);
            while ($row = mysqli_fetch_assoc($selectUsersQuery)) {
              $user_id = $row['user_id'];
              $user_name = $row['user_name'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
              $user_email = $row['user_email'];
              $user_image = $row['user_image'];
              $user_role = $row['user_role'];
            ?>
              <tr>
                <td><?php echo $user_id ?></td>
                <td><?php echo $user_name ?></td>
                <td><?php echo $user_firstname ?></td>
                <td><?php echo $user_lastname ?></td>
                <td><?php echo $user_email ?></td>
                <td><?php echo $user_image ?></td>
                <td><?php echo $user_role ?></td>
                <td><a href="users.php?delete=<?php echo $user_id ?>">Delete</a></td>
                <td><a href="add_user.php?edit=<?php echo $user_id ?>">Edit</a></td>
              </tr>
            <?php
            }
            ?>
          </table>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<?php include('./includes/footer.php'); ?>