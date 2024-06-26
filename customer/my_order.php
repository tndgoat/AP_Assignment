<?php
    session_start();
    ob_start();
    $rootPath = '/AP_Assignment';
    if (!isset($_SESSION['email_user']) && empty($_SESSION['email_user']) ) header('location: login.php');
    require_once '../database/db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch trình</title>
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
    <link rel="stylesheet" href="./public/css/home.css">
</head>
<body>
<?php
    require '../includes/header.php';
    require '../includes/navbar.php';
?>

<?php
    if (isset($_GET["cancel"])) {
        $sqlDeleteOrder = "DELETE FROM `ltncdb`.`order` WHERE order.order_id = " . $_GET["cancel"];
        $conn->query($sqlDeleteOrder);
    }
?>

<?php
    $email = $_SESSION['email_user'];
    $sqlFindUser = "SELECT user_id FROM user WHERE email = '$email'";
    $ketQua = $conn->query($sqlFindUser);
    $user = $ketQua->fetch_array();
    $userId = $user['user_id'];
    $sqlFindOrder = "SELECT order_id, purpose, using_duration, receive_place, status, order.updated_at FROM `ltncdb`.`order`, user WHERE order.user_id = '$userId' AND order.user_id = user.user_id";
    $orders = $conn->query($sqlFindOrder);

    if ($orders->num_rows>0) {
?>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="h4 text-primary">Danh sách lịch trình</div>
        </div>
        <div class="row">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Xe</th>
                        <th scope="col">Thông tin tài xế</th>
                        <th scope="col">Nơi giao</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $i = 1;
                while($row = $orders->fetch_assoc()) {
            ?>
                    <tr>
                        <td scope="col"><?=$i?></td>
                        <td scope="col"><?=$row['order_id']?></td>
                        <td scope="col"><?=$email?></td>
                        <td scope="col"><?=$row['receive_place']?></td>
                        <td scope="col"><span class="text-danger"><?=$row['status']?></span></td>
                        <td scope="col"><?=$row['updated_at']?></td>
                        <td scope="col"><?php if ($row['status']=="Đang chờ xét duyệt") {echo "<form><button name='cancel' value='",$row['order_id'],"'>Hủy chuyến</button></form>";}?> </td>
                    </tr>
            <?php
                    $i++;
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    } else {
?>
<div class="container pt-5 pb-5">
    <div class="row mb-2">
        <div class="alert alert-warning">
            <span class="h4"> <i class="fa-light fa-face-smile"></i> Bạn chưa có lịch trình nào!!!</span>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6 col-sm-12">
            <a href="<?php echo $rootPath?>/product.php" class="btn btn-primary">Trở về trang xe</a>
        </div>
    </div>
</div>
<?php
    }
    require '../includes/footer.php';
?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>