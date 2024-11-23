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

$booking_success = false;
$booking_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $document_number = $_POST['document_number'];
  $document_type = $_POST['document_type'];
  $full_name = $_POST['full_name'];
  $phone_number = $_POST['phone_number'];
  $email = $_POST['email'];
  $service_id = $_POST['service_id'];
  $user_id = isset($_SESSION['username']) ? $_SESSION['username'] : null;

  $sql = "INSERT INTO bookings (document_number, document_type, full_name, phone_number, email, service_id, user_id)
            VALUES ('$document_number', '$document_type', '$full_name', '$phone_number', '$email', '$service_id', (SELECT id FROM auth_users WHERE username = '$user_id'))";

  if ($conn->query($sql) === true) {
    $booking_success = true;
  } else {
    $booking_error = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
<div class="container my-5">
  <h2 class="text-center mb-4">Register a Service</h2>
  <?php if ($booking_success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Booking registered successfully!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php elseif ($booking_error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?php echo $booking_error; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>
  <form action="register_service.php" method="POST" class="needs-validation" novalidate>
    <div class="form-group">
      <label for="document_number">Document Number:</label>
      <input type="text" class="form-control" id="document_number" name="document_number" required autocomplete="off">
      <div class="invalid-feedback">
        Please enter your document number.
      </div>
    </div>
    <div class="form-group">
      <label for="document_type">Document Type:</label>
      <input type="text" class="form-control" id="document_type" name="document_type" required autocomplete="off">
      <div class="invalid-feedback">
        Please enter your document type.
      </div>
    </div>
    <div class="form-group">
      <label for="full_name">Full Name:</label>
      <input type="text" class="form-control" id="full_name" name="full_name" required autocomplete="off">
      <div class="invalid-feedback">
        Please enter your full name.
      </div>
    </div>
    <div class="form-group">
      <label for="phone_number">Phone Number:</label>
      <input type="text" class="form-control" id="phone_number" name="phone_number" required autocomplete="off">
      <div class="invalid-feedback">
        Please enter your phone number.
      </div>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
      <div class="invalid-feedback">
        Please enter a valid email address.
      </div>
    </div>
    <div class="form-group">
      <label for="service_id">Service:</label>
      <select class="form-control" id="service_id" name="service_id" required>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'hotel_db');
        $result = $conn->query("SELECT id, service_name FROM services");
        while ($row = $result->fetch_assoc()) {
          echo '<option value="' . $row['id'] . '">' . $row['service_name'] . '</option>';
        }
        $conn->close();
        ?>
      </select>
      <div class="invalid-feedback">
        Please select a service.
      </div>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Register</button>
    </div>
  </form>
</div>
<?php include 'includes/footer.php'; ?>