<?php 
    $server = 'localhost';
    $user = 'manager';
    $userPass = 'manager';
    $dbName= 'staff_system';

    $conn = mysqli_connect($server,$user,$userPass,$dbName);

    if(!$conn) {
        die('db failed');
    }
?>