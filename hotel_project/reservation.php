<?php include 'db.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Make a Reservation - Grand Paradise Hotel</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
  <div class="logo">🏨 Grand Paradise Hotel</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="reservation.php">Reservations</a>
    <a href="view_bookings.php">View Bookings</a>
    <a href="contact.php">Contact</a>
  </nav>
</header>

<section class="form-section">
  <h2>Book Your Stay</h2>

  <?php
  if($_SERVER['REQUEST_METHOD'] === 'POST'){

      // Sanitize inputs
      $name = trim($_POST['name'] ?? '');
      $email = trim($_POST['email'] ?? '');
      $phone = trim($_POST['phone'] ?? '');
      $checkin = $_POST['checkin'] ?? '';
      $checkout = $_POST['checkout'] ?? '';
      $guests = (int)($_POST['guests'] ?? 1);

      // Required fields validation
      if($name === '' || $email === '' || $checkin === '' || $checkout === ''){
          echo '<p class="error">Please fill in all required fields.</p>';
      } else {

          // Prepare statement
          $stmt = $conn->prepare(
              "INSERT INTO reservations 
              (name, email, phone, checkin, checkout, guests, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, NOW())"
          );

          if(!$stmt){
              die("<p class='error'>SQL prepare failed: " . $conn->error . "</p>");
          }

          // Bind parameters
          $stmt->bind_param("sssssi", $name, $email, $phone, $checkin, $checkout, $guests);

          // Execute and check
          if($stmt->execute()){
              echo '<p class="success">Booking successful! Thank you, ' . htmlspecialchars($name) . '.</p>';
          } else {
              echo '<p class="error">Booking failed: ' . $stmt->error . '</p>';
          }

          $stmt->close();
      }
  }
  ?>

  <form method="post" class="reservation-form">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="tel" name="phone" placeholder="Phone">
    <input type="email" name="email" placeholder="Email" required">
    
    <div class="row">
      <input type="date" name="checkin" required>
      <input type="date" name="checkout" required>
    </div>

    <input type="number" name="guests" min="1" value="1" required>
    <button type="submit">Book Now</button>
  </form>
</section>

<footer class="footer">
  <p>© <?php echo date('Y'); ?> Grand Paradise Hotel</p>
</footer>
</body>
</html>
