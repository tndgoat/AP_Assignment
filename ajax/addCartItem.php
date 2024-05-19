<?php
session_start();
ob_start();
$rootPath = '/AP_Assignment';
require_once '../database/db_connection.php';
if (isset($_POST['productId'])) {
    settype($_POST['productId'], 'int');
    $id = $_POST['productId'];
    if ($id == 0)
        header('location: ../404.php');

    if (isset($_SESSION['cart'][$id])) {
        // nếu xe đã có trong giỏ thì tăng số lượng xe
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        // nếu xe chưa có trong giỏ thì set số lượng là 1
        $id = mysqli_real_escape_string($conn, $id);
        $sql = "SELECT name, images, price, price_sale FROM product WHERE product_id='$id'";
        $product = $conn->query($sql);
        if ($product->num_rows > 0) {
            $row = $product->fetch_array();
            $price = $row['price_sale'] != 0 ? $row['price_sale'] : $row['price'];
            $_SESSION['cart'][$id] = array(
                "id" => $id,
                "quantity" => 1,
                "price" => $price,
                "name" => $row['name'],
                "img" => $row['images']
            );
            $conn->close();
        }
    }
    echo json_encode(array(
        'status' => 'success',
    ));
} else {
    header('location: ../404.php');
}
