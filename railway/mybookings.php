<?php include 'db.php'; ?>

<h2 style="text-align:center;">My Bookings</h2>

<table border="1" style="margin:auto;">
<tr>
    <th>PNR</th>
    <th>Train ID</th>
    <th>Status</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM bookings");

while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['pnr']}</td>
        <td>{$row['train_id']}</td>
        <td>{$row['status']}</td>
    </tr>";
}
?>

</table>