<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    if ($name === '' || $email === '' || $message === '') {
        $feedback = '<p class="error">Please fill all fields.</p>';
    } else {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name,email,message,created_at) VALUES (?,?,?,NOW())");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $feedback = '<p class="success">Message sent successfully. Thank you!</p>';
        } else {
            $feedback = '<p class="error">Failed to send message: ' . htmlspecialchars($stmt->error) . '</p>';
        }
        $stmt->close();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact - Grand Paradise Hotel</title>
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
  <h2>Contact Us</h2>
  <?php if(!empty($feedback)) echo $feedback; ?>
  <form method="post" class="contact-form">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Your Message" required></textarea>
    <button type="submit">Send Message</button>
  </form>
</section>

<footer class="footer">
  <p>© <?php echo date('Y'); ?> Grand Paradise Hotel</p>
</footer>
</body>
</html>
