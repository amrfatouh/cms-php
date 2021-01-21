<?php session_start() ?>
<?php ob_start(); ?>
<?php include('./includes/db.php'); ?>
<?php include('./admin/includes/functions.php'); ?>

<?php
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT * FROM users WHERE user_name = '$username'";
  $selectUserQuery = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($selectUserQuery);

  $user_name = $row['user_name'];
  $user_password = $row['user_password'];
  $user_firstname = $row['user_firstname'];
  $user_lastname = $row['user_lastname'];
  $user_email = $row['user_email'];
  $user_role = $row['user_role'];

  if ($password === $user_password) {
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_password'] = $user_password;
    $_SESSION['user_firstname'] = $user_firstname;
    $_SESSION['user_lastname'] = $user_lastname;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_role'] = $user_role;
    header('Location: admin/index.php');
  } else {
    header('Location: index.php');
  }
}
?>