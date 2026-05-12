<?php
include 'db.php';

if (isset($_GET['id'])) {

    $train_id = $_GET['id'];

    // Check available seats
    $check = $conn->query("SELECT seats FROM trains WHERE id='$train_id'");
    $row = $check->fetch_assoc();

    if ($row['seats'] > 0) {

        // Generate random PNR
        $pnr = "PNR" . rand(1000, 9999);

        // Insert booking
        $sql = "INSERT INTO bookings (train_id, pnr, status) 
                VALUES ('$train_id', '$pnr', 'Booked')";

        if ($conn->query($sql) === TRUE) {

            // Reduce seat count
            $conn->query("UPDATE trains SET seats = seats - 1 WHERE id='$train_id'");

            // Redirect back to homepage
            header("Location: index.php");
            exit();

        } else {
            echo "Error: " . $conn->error;
        }

    } else {
        echo "<h2 style='text-align:center;color:red;'>No seats available!</h2>";
        echo "<p style='text-align:center;'><a href='index.php'>Go Back</a></p>";
    }

} else {
    echo "Invalid request";
}
?>