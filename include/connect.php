<?php

// connect to DB
$conn = mysqli_connect('localhost', 'saja', 'test123', 'hospital-system');

//check connection
if(!$conn){
    echo 'connection error: '. mysqli_connect_error();
}
?>