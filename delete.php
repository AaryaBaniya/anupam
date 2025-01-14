<?php
require_once 'connect.php';

if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
    //access granted
    $id = (int)$_GET['customer_id']; //data type casting

    if ($id <= 0) {
        //cross checking if invalid id passed from url query e.g. id=asdjdas
        header('location: admindash.php');
        exit;
    }

    //cross checking from if the error id value is passed from url query string e.g. id=13211513351
    $sql_1 = "SELECT * FROM bookings WHERE customer_id = " . $id;
    $query_1 = mysqli_query($conn, $sql_1);

    //validates if there is data in a table or not.
    if (mysqli_num_rows($query_1) <= 0) {
        header('location: admindash.php');
        exit;
    }

    $sql = "DELETE FROM bookings WHERE customer_id = " . $id;
    $query = mysqli_query($conn, $sql);

    if ($query) {
        //success
        header('location: admindash.php');
        exit;
    } else {
        header('location: admindash.php');
        exit;
    }
} else {
    header('location: admindash.php');
    exit;
}
