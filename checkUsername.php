<?php
include "assets/conn.php";
$username = $_POST['name'];
if (isset($username)) {
    $query = "SELECT * FROM `users` WHERE name = '$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_num_rows($result);
    if ($row == 0) {
        echo json_encode([
            'status' => true,
            'msg' => "You Entered Unique Name!!",
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'msg' => "Already Exists. Enter Unique Name!",
        ]);
    }
} else {
    json_encode([
        'status' => false,
        'msg' => "Enter Some Value",
    ]);
}
