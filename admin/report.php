<?php
session_start();
$rootPath = '/AP_Assignment/admin';
if (!isset($_SESSION["email_ad"])) {
    header('location: login.php');
    exit();
}

require_once '../database/db_connection.php';

// số lượng lịch trình
$sqlOrder = "SELECT count(*) as count FROM `ltncdb`.`order`";
$dataCountOrder = $conn->query($sqlOrder);
$dataCountOrder = $dataCountOrder->fetch_array();
$countOrder = $dataCountOrder['count'];

// số lượng tài xế
$sqlCustomer = "SELECT count(*) as count FROM user";
$dataCountCustomer = $conn->query($sqlCustomer);
$dataCountCustomer = $dataCountCustomer->fetch_array();
$countCustomer = $dataCountCustomer['count'];

// số lượng xe
$sqlProduct = "SELECT count(*) as count FROM product";
$dataCountProduct = $conn->query($sqlProduct);
$dataCountProduct = $dataCountProduct->fetch_array();
$countProduct = $dataCountProduct['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./includes/css/base.css">
    <link rel="stylesheet" href="./includes/css/home.css">
</head>
<body>
<?php
require './includes/header.php';
require './includes/navbar.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col text-center h2 text-primary mb-4">
            Thống kê tổng quan
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card bg-danger">
                <div class="card-body">
                    <h5 class="card-title text-light" style="font-size: 60px;"><b><?= $countCustomer ?></b></h5>
                    <p class="card-text text-light" style="font-size: 30px;">Số tài xế</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card bg-info">
                <div class="card-body">
                    <h5 class="card-title text-light" style="font-size: 60px;"><b><?= $countOrder ?></b></h5>
                    <p class="card-text text-light" style="font-size: 30px;">Số lịch trình</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card bg-success">
                <div class="card-body">
                    <h5 class="card-title text-light" style="font-size: 60px;"><b><?= $countProduct ?></b></h5>
                    <p class="card-text text-light" style="font-size: 30px;">Số lượng xe</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require './includes/footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
