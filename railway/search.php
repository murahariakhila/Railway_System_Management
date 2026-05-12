<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trains</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    <h2>Available Trains</h2>
</div>

<table>
<tr>
    <th>Train Name</th>
    <th>Seats</th>
    <th>Action</th>
</tr>

<?php
$source = $_POST['source'];
$destination = $_POST['destination'];

$sql = "SELECT * FROM trains WHERE source='$source' AND destination='$destination'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['seats']}</td>
        <td><a class='book-btn' href='book.php?id={$row['id']}'>Book Now</a></td>
    </tr>";
}
?>

</table>

<!-- CARDS SECTION -->
<div class="container">

    <!-- My Bookings -->
    <div class="card">
        <h3>My Bookings</h3>
        <p>PNR: 123456</p>
        <p>Status: Confirmed</p>
        <button class="btn" style="background:red;">Cancel Ticket</button>
    </div>

    <!-- Admin -->
    <div class="card">
        <h3>Admin Dashboard</h3>
        <p>Total Bookings: 20</p>
        <p>Trains: 5</p>
        <button class="btn">Generate Report</button>
    </div>

</div>

<!-- FOOTER -->
<div class="footer">
    © 2024 Railway Reservation System
</div>

</body>
</html>