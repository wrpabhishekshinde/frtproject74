<?php
$con = mysqli_init();
mysqli_ssl_set($con,NULL,NULL, "certificate.pem", NULL, NULL);
mysqli_real_connect($conn, "frtdbserver74.mysql.database.azure.com", "gsshinde", "Pass@123", "fin_demo", 3306, MYSQLI_CLIENT_SSL);
if(!$con)
{
    echo"connected successfully";
}
else{
    echo"not connected";
}
?>