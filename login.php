<?php
include 'includes/header.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM auth_users WHERE username='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['username'] = $username;
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    Welcome back, $username!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
      header('Refresh: 2; URL=index.php');
    } else {
      $login_error = "Invalid password.";
    }
  } else {
    $login_error = "No user found with that username.";
  }

  $conn->close();
}
?>
<div class="container my-5">
  <h2 class="text-center mb-4">Login</h2>
  <?php if ($login_error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo $login_error; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>
  <form action="login.php" method="POST" class="needs-validation" novalidate>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
      <div class="invalid-feedback">
        Please enter your username.
      </div>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
      <div class="invalid-feedback">
        Please enter your password.
      </div>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Login</button>
    </div>
    <div class="text-center mt-3">
      <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
  </form>
</div>
<?php include 'includes/footer.php'; ?>