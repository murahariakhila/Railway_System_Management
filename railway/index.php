<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Railway System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HEADER -->
<div class="header">
    <h2>Railway Reservation Management System</h2>
    <div class="nav">
        <a href="index.php">Home</a>
        <a href="admin.php">Admin Panel</a>
    </div>
</div>

<!-- HERO -->
<div class="hero">
    <h1>Book Your Train Tickets Online</h1>
</div>

<!-- SEARCH -->
<div class="search-box">
    <form method="post">
    <input type="text" name="source" placeholder="From">
    <input type="text" name="destination" placeholder="To">

    <button class="btn" name="search">Search Trains</button>
    <a href="index.php" class="btn" style="background: gray;">Show All</a>
</form>
</div>

<!-- AVAILABLE TRAINS -->
<h2 style="text-align:center;">Available Trains</h2>

<table>
<tr>
    <th>Train Name</th>
    <th>Departure</th>
    <th>Arrival</th>
    <th>Seats</th>
    <th>Action</th>
</tr>

<?php
if (isset($_POST['source']) && isset($_POST['destination'])) {
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $sql = "SELECT * FROM trains WHERE source='$source' AND destination='$destination'";
} else {
    $sql = "SELECT * FROM trains";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['source']}</td>
            <td>{$row['destination']}</td>
            <td>{$row['seats']}</td>
            <td><a class='book-btn' href='book.php?id={$row['id']}'>Book Now</a></td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No trains found</td></tr>";
}
?>

</table>

<!-- MY BOOKINGS -->
<h2 style="text-align:center;">My Bookings</h2>

<div style="width:80%; margin:auto;">

<?php
$sql = "SELECT trains.id, trains.name, trains.source, trains.destination, 
        COUNT(bookings.id) AS total_seats
        FROM bookings
        JOIN trains ON bookings.train_id = trains.id
        GROUP BY bookings.train_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='booking-card'>
        <p><b>Train:</b> {$row['name']}</p>
        <p><b>From:</b> {$row['source']}</p>
        <p><b>To:</b> {$row['destination']}</p>
        <p><b>Seats Booked:</b> {$row['total_seats']}</p>
        
        <a href='cancel.php?train_id={$row['id']}' 
           style='color:white;background:red;padding:5px 10px;text-decoration:none;border-radius:5px;'>
           Cancel 1 Seat
        </a>
      </div>";
    }
} else {
    echo "<p style='text-align:center;'>No bookings yet</p>";
}
?>

</div>

<!-- FOOTER -->
<div class="footer">
    © 2026 Railway Reservation System
</div>

</body>
</html>