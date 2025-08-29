<?php 
include 'db.php';

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: view_bookings.php"); // refresh page after delete
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bookings - Grand Paradise Hotel</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .delete-btn {
      background: #e74c3c;
      color: white;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      border-radius: 4px;
    }
    .delete-btn:hover {
      background: #c0392b;
    }
  </style>
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

<section class="list-section">
  <h2>Reservations</h2>
  <?php
  // Use $conn, not $con
  $res = $conn->query("SELECT id,name,email,phone,checkin,checkout,guests,created_at FROM reservations ORDER BY created_at DESC");

  if($res && $res->num_rows > 0){
      echo '<table class="bookings">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Check-in</th>
                  <th>Check-out</th>
                  <th>Guests</th>
                  <th>Booked At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>';
      while($row = $res->fetch_assoc()){
          echo '<tr>';
          echo '<td>'.htmlspecialchars($row['id']).'</td>';
          echo '<td>'.htmlspecialchars($row['name']).'</td>';
          echo '<td>'.htmlspecialchars($row['email']).' / '.htmlspecialchars($row['phone']).'</td>';
          echo '<td>'.htmlspecialchars($row['checkin']).'</td>';
          echo '<td>'.htmlspecialchars($row['checkout']).'</td>';
          echo '<td>'.htmlspecialchars($row['guests']).'</td>';
          echo '<td>'.htmlspecialchars($row['created_at']).'</td>';
          echo '<td>
                  <form method="post" onsubmit="return confirm(\'Are you sure you want to delete this booking?\');">
                    <input type="hidden" name="delete_id" value="'.htmlspecialchars($row['id']).'">
                    <button type="submit" class="delete-btn">Delete</button>
                  </form>
                </td>';
          echo '</tr>';
      }
      echo '</tbody></table>';
  } else {
      echo '<p class="muted">No bookings yet.</p>';
  }
  ?>
</section>

<footer class="footer">
  <p>© <?php echo date('Y'); ?> Grand Paradise Hotel</p>
</footer>
</body>
</html>
