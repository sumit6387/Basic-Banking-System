   <?php
include "assets/conn.php";
$username = $_POST['username'];
$email = $_POST['email'];
$amount = $_POST['amount'];
if ($username && $email && $amount) {
    $sql = "SELECT * FROM `users` WHERE name = '$username'";
    $result1 = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result1)) {
        echo json_encode([
            'status' => false,
            'msg' => "This Username Alredy Exists!!",
        ]);
    } else {
        $sql1 = "INSERT INTO `users`( `name`, `email`, `balance`) VALUES('$username','$email','$amount')";
        $result2 = mysqli_query($conn, $sql1);
        if ($result2) {
            echo json_encode([
                'status' => true,
                'msg' => "User Added Successfully!!",
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg' => "Something Went Wrong!!",
            ]);
        }
    }
} else {
    echo json_encode([
        'status' => false,
        'msg' => "Enter All Fields!!",
    ]);
}
