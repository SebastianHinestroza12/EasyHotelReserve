<?php include 'includes/header.php'; ?>
<div class="container my-5">
  <h2 class="text-center mb-4">Contact Us</h2>
  <form action="#" method="POST" class="needs-validation" novalidate>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" required>
      <div class="invalid-feedback">
        Please enter your name.
      </div>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" required>
      <div class="invalid-feedback">
        Please enter a valid email address.
      </div>
    </div>
    <div class="form-group">
      <label for="message">Message:</label>
      <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
      <div class="invalid-feedback">
        Please enter your message.
      </div>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
<?php include 'includes/footer.php'; ?>