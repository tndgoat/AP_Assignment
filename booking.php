<?php
session_start();
ob_start();
$rootPath = '/AP_Assignment/customer';
require_once './database/db_connection.php';
if (isset($_POST['register'])) {

    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $place = mysqli_real_escape_string($conn, $_POST['place']);
    $userId = mysqli_real_escape_string($conn, $_POST['userId']);
    $productId = mysqli_real_escape_string($conn, $_POST['productId']);

    
    $sqlInsert = "INSERT INTO `order` (user_id, purpose, using_duration, receive_place,status, expired_status) VALUES ('$userId','$purpose','$duration','$place','Đang chờ xét duyệt','0')";
    $conn->query($sqlInsert);
    $res = $conn->query("SELECT * FROM `order` WHERE user_id='$userId'");
    $item = $res->fetch_assoc();
    $order_id = $item['order_id'];
    $sqlInsert = "INSERT INTO `order_item` (order_id ,product_id) VALUES ('$order_id','$productId')";
    $conn->query($sqlInsert);
    $conn->close();
    header("location: /AP_Assignment/product.php");
} else {
    $conn->close();
    header('location: /AP_Assignment/404.php');
}
?>