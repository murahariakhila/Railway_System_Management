<?php
include 'db.php';

if (isset($_GET['train_id'])) {

    $train_id = $_GET['train_id'];

    // Delete ONE booking (only one seat)
    $conn->query("DELETE FROM bookings 
                  WHERE train_id = '$train_id' 
                  LIMIT 1");

    // Increase seat count
    $conn->query("UPDATE trains 
                  SET seats = seats + 1 
                  WHERE id = '$train_id'");

    // Redirect back
    header("Location: index.php");
    exit();
}
?>