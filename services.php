<?php include 'includes/header.php'; ?>

<div class="container my-5">
  <h2 class="text-center mb-4">Our Services</h2>
  <div class="row">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hotel_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Obtener servicios
    $sql = "SELECT service_name, description FROM services";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card h-100 service-card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row["service_name"] . '</h5>';
        echo '<p class="card-text">' . $row["description"] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<div class="col-12"><p class="text-center">No services available.</p></div>';
    }
    $conn->close();
    ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>