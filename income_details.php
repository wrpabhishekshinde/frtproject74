<?php
include('config.php'); // Assuming this file contains your database connection details

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];

    $res = mysqli_query($con, "SELECT * FROM income WHERE added_by = $id");

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
           // echo "<p>item: " . $row['item'] . "</p>";
            echo "<p>details: " . $row['details'] . "</p>";
            echo "<p>amount: Rs." . $row['amount'] . "</p>";
            echo "<p>income_date: " . $row['income_date'] . "</p><hr/>";
        }
    } else {
        echo "<p>No income details found for this user.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
