<?php
    session_start();
    ob_start();
    $rootPath = '/AP_Assignment/customer';
    require_once '../../database/db_connection.php'; 
    echo "bla";
    if (isset($_POST['review'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $userId = mysqli_real_escape_string($conn, $_POST['userId']);
        $productId = mysqli_real_escape_string($conn, $_POST['productId']);
        $sqlInsert = "INSERT INTO review (title, content, user_id, product_id) VALUES ('$title', '$content', '$userId', '$productId')";
        $conn->query($sqlInsert);
        $conn->close();
        header("location: /AP_Assignment/product.php");
    } else {
        $conn->close();
        header('location: /AP_Assignment/404.php');
    }
?>