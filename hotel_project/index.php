<?php include 'db.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Grand Paradise Hotel</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
  <div class="logo">🏨 <span id="hotel-name">Grand Paradise Hotel</span></div>
  <nav>
    <a href="index.php">Home</a>
    <a href="reservation.php">Reservations</a>
    <a href="view_bookings.php">View Bookings</a>
    <a href="contact.php">Contact</a>
  </nav>
</header>

<section class="hero">
  <div class="hero-inner">
    <h1>Welcome to <span id="hero-hotel">Grand Paradise Hotel</span></h1>
    <p>Comfort • Cleanliness • Care — Book your stay with us.</p>
    <a class="btn" href="reservation.php">Book Now</a>
  </div>
</section>

<section class="info">
  <div class="info-card">
    <h3>Rooms & Rates</h3>
    <p>Deluxe - Rs. 6,500 / night<br/>Luxury - Rs. 9,500 / night<br/>Single - Rs. 3,500 / night</p>
  </div>
  <div class="info-card">
    <h3>Facilities</h3>
    <ul>
      <li>Free Wi‑Fi</li>
      <li>24/7 Reception</li>
      <li>Restaurant & Cafe</li>
    </ul>
  </div>
</section>

<footer class="footer">
  <p>© <?php echo date('Y'); ?> <span id="hotel-footer">Grand Paradise Hotel</span>. All rights reserved.</p>
</footer>
</body>
</html>
