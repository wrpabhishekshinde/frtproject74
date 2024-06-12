<?php
include('config.php'); // Assuming this file contains your database connection details

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];

    $res = mysqli_query($con, "SELECT * FROM expense WHERE added_by = $id");

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<p>item: " . $row['item'] . "</p>";
            echo "<p>details: " . $row['details'] . "</p>";
            echo "<p>price: Rs." . $row['price'] . "</p>";
            echo "<p>expense_date: " . $row['expense_date'] . "</p><hr/>";
        }
    } else {
        echo "<p>No expense details found for this user.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
