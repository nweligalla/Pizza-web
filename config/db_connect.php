<?php
//connecting to database
$conn = mysqli_connect("localhost", "nayana", "test1234", "webpizza");


//checking conncetion
if (!$conn) {
    echo "Connection error" . mysqli_connect_error();
}

?>