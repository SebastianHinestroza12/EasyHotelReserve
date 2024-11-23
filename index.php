<?php include 'includes/header.php'; ?>
<div class="container">
  <h2 class="text-center my-4">Welcome to Our Hotel</h2>
  <div class="row">
    <div class="col-md-6">
      <h3>About Our Hotel</h3>
      <p>Experience the luxury and comfort at our hotel. We offer top-notch amenities and services to ensure your stay is unforgettable.</p>
      <p>Located in the heart of the city, our hotel provides easy access to major attractions, shopping, and dining experiences.</p>
    </div>
    <div class="col-md-6">
      <img src="img/hotel.jpg" class="img-fluid rounded" alt="Hotel Image">
    </div>
  </div>
  <div class="row my-4">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <img src="img/room.jpg" class="card-img-top" alt="Room Image">
        <div class="card-body">
          <h5 class="card-title">Luxurious Rooms</h5>
          <p class="card-text">Enjoy the comfort and elegance of our well-appointed rooms.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm">
        <img src="img/dining.jpg" class="card-img-top" alt="Dining Image">
        <div class="card-body">
          <h5 class="card-title">Fine Dining</h5>
          <p class="card-text">Savor exquisite culinary delights at our on-site restaurants.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm">
        <img src="img/spa.jpg" class="card-img-top" alt="Spa Image">
        <div class="card-body">
          <h5 class="card-title">Relaxing Spa</h5>
          <p class="card-text">Unwind and rejuvenate at our luxurious spa facilities.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center my-4">
    <?php if (isset($_SESSION['username'])): ?>
      <a href="register_service.php" class="btn btn-primary btn-lg">Register a Service</a>
    <?php else: ?>
      <a href="login.php" class="btn btn-primary btn-lg">Book Your Stay Now</a>
    <?php endif; ?>
  </div>
</div>
<?php include 'includes/footer.php'; ?>