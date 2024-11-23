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

// Consultar las reservas
$sql = "SELECT bookings.*, services.service_name FROM bookings INNER JOIN services ON bookings.service_id = services.id";
$result = $conn->query($sql);
?>

<div class="container my-5">
  <h2 class="text-center mb-4">Bookings</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Document Number</th>
        <th>Document Type</th>
        <th>Full Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Service</th>
        <th>Booking Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row['document_number'] . '</td>';
          echo '<td>' . $row['document_type'] . '</td>';
          echo '<td>' . $row['full_name'] . '</td>';
          echo '<td>' . $row['phone_number'] . '</td>';
          echo '<td>' . $row['email'] . '</td>';
          echo '<td>' . $row['service_name'] . '</td>';
          echo '<td>' . $row['created_at'] . '</td>';
          echo '</tr>';
        }
      } else {
        echo '<tr><td colspan="7" class="text-center">No bookings found.</td></tr>';
      }
      $conn->close();
      ?>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>