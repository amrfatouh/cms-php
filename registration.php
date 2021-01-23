<?php ob_start() ?>
<?php include "includes/db.php"; ?>
<?php include './admin/includes/functions.php'; ?>
<?php include "includes/head.php"; ?>
<?php include "includes/navigation.php"; ?>

<?php
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);
  $email = mysqli_real_escape_string($connection, $email);

  $salt = '$2y$10$0123456789012345678901';
  $password = crypt($password, $salt);

  $query = "INSERT INTO users (user_name, user_password, user_email, user_role) ";
  $query .= "VALUES ('$username', '$password', '$email', 'subscriber')";
  $insertUserQuery = mysqli_query($connection, $query);
  checkQuery($insertUserQuery);
  header('Location: index.php');
}
?>

<!-- Page Content -->
<div class="container">

  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <h1>Register</h1>
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
              <div class="form-group">
                <label for="username" class="sr-only">username</label>
                <input required type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
              </div>
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input required type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
              </div>
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input required type="password" name="password" id="key" class="form-control" placeholder="Password">
              </div>

              <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>



  <?php include "includes/footer.php"; ?>
  </body>

  </html>