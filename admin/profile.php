<?php
ob_start();
include('../includes/db.php');
include('./includes/functions.php');
include('./includes/admin_header.php');
include('./includes/navigation.php');
?>

<?php
$isEdit = true;
$user_name = $_SESSION['user_name'];
$query = "SELECT * FROM users WHERE user_name = '$user_name'";
$selectUserQuery = mysqli_query($connection, $query);
checkQuery($selectUserQuery);
$row = mysqli_fetch_assoc($selectUserQuery);
$user_id = $row['user_id'];
$user_name = $row['user_name'];
$user_firstname = $row['user_firstname'];
$user_lastname = $row['user_lastname'];
$user_email = $row['user_email'];
$user_image = $row['user_image'];
$user_role = $row['user_role'];
?>

<div id="wrapper">
  <div id="page-wrapper">

    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Profile</h1>
        </div>
      </div>
      <!-- this form is copied from add_user.php page -->
      <form action="users.php" method='post'>
        <div class="form-group">
          <label for="user_name">Username</label>
          <input value="<?php echo $isEdit ? $user_name : "" ?>" class="form-control" type="text" name="user_name" id="user_name">
        </div>
        <div class="form-group">
          <label for="user_password">Password</label>
          <input required class="form-control" type="password" name="user_password" id="user_password">
        </div>
        <div class="form-group">
          <label for="user_firstname">First Name</label>
          <input value="<?php echo $isEdit ? $user_firstname : "" ?>" type='text' name="user_firstname" id="user_firstname" class="form-control">
        </div>
        <div class="form-group">
          <label for="user_lastname">Last Name</label>
          <input value="<?php echo $isEdit ? $user_lastname : "" ?>" class="form-control" type="text" name="user_lastname" id="user_lastname">
        </div>
        <div class="form-group">
          <label for="user_email">E-mail</label>
          <input value="<?php echo $isEdit ? $user_email : "" ?>" class="form-control" type="email" name="user_email" id="user_email">
        </div>
        <div class="form-group">
          <label for="user_role">Role</label>
          <select name="user_role" id="user_role">
            <option <?php if ($isEdit) echo $user_role === 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
            <option <?php if ($isEdit) echo $user_role === 'subscriber' ? 'selected' : '' ?> value="subscriber">Subscriber</option>
          </select>
        </div>
        <?php echo $isEdit ? "<input type='hidden' name='user_id' value='$user_id'>" : "" ?>
        <input type="submit" value="<?php echo $isEdit ? 'Edit Profile' : 'Add User' ?>" class="btn btn-primary" name="<?php echo $isEdit ? "edit_user" : "add_user" ?>">
      </form>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<?php include('./includes/footer.php'); ?>