<?php
session_start();
ob_start();
$rootPath = '/AP_Assignment/admin';
if (!isset($_SESSION["email_ad"])) {
    header('location: ../login.php');
}
require_once '../../database/db_connection.php';

if (isset($_GET['id'])) {
    settype($_GET['id'], 'int');
    $orderId = mysqli_real_escape_string($conn,$_GET['id']);
    if ($orderId == 0) header('location: ../../404.php');
} else {
    $conn->close();
    header('location: ../../404.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lịch trình</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/home.css"> -->
</head>
<body>
<?php
    require '../includes/header.php';
    require '../includes/navbar.php';
?>
    <div class="container mt-5 mb-5 shadow-sm p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="h3 text-primary text-center">thông tin chi tiết  <a href="./index.php" class="btn btn-secondary">Back</a></div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-12">
                <?php
                    $sqlOrder = "SELECT *
                    FROM `ltncdb`.`order`, user 
                    WHERE order.user_id = user.user_id
                    AND order_id = '$orderId'";
                    $ketQua = $conn->query($sqlOrder);
                    $ketQua = $ketQua->fetch_array();
                ?>  
                <div class="text-secondary h5">lịch trình #<?=$ketQua['order_id']?></div>
                <div>Tên tài xế: <?=$ketQua['name']?></div>
                <div>Nơi nhận: <?=$ketQua['receive_place']?></div>
                <div>Số điện thoại tài xế: <?=$ketQua['phone']?></div>
                <div>Địa chỉ email: <?=$ketQua['email']?></div>
                <div>Thời gian gửi yêu cầu: <?=$ketQua['updated_at']?></div>
                <div>Thời hạn sử dụng xe: <?= $ketQua['using_duration'] ?> ngày</div>
                <div>Mục đích sử dụng: <?= $ketQua['purpose'] ?> </div>
                <div>Trạng thái phê duyệt: 
                <span class="
                    <?php 
                        if ($ketQua['status'] == 'Đang chờ xét duyệt')
                            echo 'text-danger';
                        else 
                            echo 'text-success' 
                    ?>
                ">
                    <?=$ketQua['status']?>
                </span>     
                </div>
                <div>Trạng thái yêu cầu: 
                <span class="
                    <?php
                                    if ($ketQua['expired_status'] == 0)
                                        echo 'text-danger';
                                    else
                                        echo 'text-success'
                                            ?>
                                    ">
                        <?php  if($ketQua['expired_status'] == 0){
                        echo "Đã hết hạn";
                        }
                            else {
                        echo "Còn hiệu lực";        
                            } ?>
                    </span>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12">
                <?php
                    $sqlDetail = "SELECT *
                    FROM order_item, product 
                    WHERE order_id = '$orderId' 
                    AND order_item.product_id = product.product_id";
                    $detail = $conn->query($sqlDetail);
                    $cardetail = $detail->fetch_array();
                ?>

                <div>Tên xe: <?= $cardetail['name'] ?></div>
                <div>Loại xe: <?php if ($cardetail['category_id'] == 1) {
                    echo "Xe khách";
                } elseif ($cardetail['category_id'] == 2) {
                    echo "Xe tải";
                } else
                    echo "Container";?></div>
                <div>Loại nhiên liệu: <?= $cardetail['fuel_type'] ?></div>
                <div>Trạng thái: <?php if ($cardetail['status'] == 0) {
                    echo "Đang bảo dưỡng";
                } elseif ($cardetail['status'] == 1) {
                    echo "Đang hoạt động";
                } 
                else {
                    echo "Ngưng hoạt động";
                } ?></div>
            </div>
        </div>
    </div>
<?php
  require '../includes/footer.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>