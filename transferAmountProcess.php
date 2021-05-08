<?php
include "assets/conn.php";
$from = $_POST['from_id'];
$to = $_POST['to_id'];
$amount = $_POST['amount'];
$sql = "SELECT * FROM `users` WHERE id = '$from'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$sql1 = $sql = "SELECT * FROM `users` WHERE id = '$to'";
$result1 = mysqli_query($conn, $sql1);
$data1 = mysqli_fetch_assoc($result1);
$sender_name = $data['name'];
$receiver_name = $data1['name'];
$date = date("Y-m-d H:i:s");
if (mysqli_num_rows($result) && mysqli_num_rows($result1)) {
    if ($data['balance'] > $amount) {
        $amount_to = $data1['balance'] + $amount;
        $amount_from = $data['balance'] - $amount;
        $sql2 = "UPDATE `users` SET `balance`= '$amount_to' WHERE `id` = $to";
        $result2 = mysqli_query($conn, $sql2);
        $sql4 = "UPDATE `users` SET `balance` = '$amount_from' WHERE id = '$from'";
        $result4 = mysqli_query($conn, $sql4);
        $sql3 = "INSERT INTO `transactions`(`sender`, `receiver`, `balance`, `created_at`) VALUES ('$sender_name','$receiver_name',$amount,'$date')";
        $result3 = mysqli_query($conn, $sql3);
        echo json_encode(['status' => true, 'msg' => 'Amount Tranfered To The User']);
    } else {
        echo json_encode(['status' => false, 'msg' => "Enter sufficient Amount!!"]);
    }
} else {
    echo json_encode(['status' => false, 'msg' => "oops! Something Went Wrong!!"]);
}
