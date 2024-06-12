
<?php
session_start();

// Replace {path to CA cert} with the actual path to the CA certificate file
$ca_cert_path = "/path/to/your/CA/certificate.pem";

// Initialize mysqli
$con = mysqli_init();

// Set SSL options
mysqli_ssl_set($con, NULL, NULL, $ca_cert_path, NULL, NULL);

// Connect to Azure MySQL Database
mysqli_real_connect($con, "frtdbserver74.mysql.database.azure.com", "gsshinde", "Pass@123", "fin_demo", 3306, MYSQLI_CLIENT_SSL);

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to get database connection
function getDbConnection() {
    // Replace {path to CA cert} with the actual path to the CA certificate file
    $ca_cert_path = "/path/to/your/CA/certificate.pem";
    
    // Initialize mysqli
    $con = mysqli_init();

    // Set SSL options
    mysqli_ssl_set($con, NULL, NULL, $ca_cert_path, NULL, NULL);

    // Connect to Azure MySQL Database
    mysqli_real_connect($con, "frtdbserver74.mysql.database.azure.com", "gsshinde", "Pass@123", "fin_demo", 3306, MYSQLI_CLIENT_SSL);

    // Check the connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $con;
}
?>
