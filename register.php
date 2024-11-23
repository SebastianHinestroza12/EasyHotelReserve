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

$registration_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $email = $_POST['email'];

  $sql = "INSERT INTO auth_users (username, password, email) VALUES ('$username', '$password', '$email')";

  if ($conn->query($sql) === true) {
    $registration_success = true;
    header('Refresh: 2; URL=login.php');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
<div class="container my-5">
  <h2 class="text-center mb-4">Register</h2>
  <?php if ($registration_success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Registration successful!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>
  <form action="register.php" method="POST" class="needs-validation" novalidate>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
      <div class="invalid-feedback">
        Please enter a username.
      </div>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
      <div class="invalid-feedback">
        Please enter a password.
      </div>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
      <div class="invalid-feedback">
        Please enter a valid email address.
      </div>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Register</button>
    </div>
  </form>
</div>
<?php include 'includes/footer.php'; ?>