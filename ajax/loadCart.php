<?php
session_start();
ob_start();
$rootPath = '/AP_Assignment';
require_once '../database/db_connection.php';

$cart = '';
$headerCart = '';

if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
    $cart .= '<div class="container-fluid mt-5 mb-5">
                <div class="row">
                    <div class="col-xl-9 col-md-8 col-sm-12">
                        <table class="table">
                            <thead>
                                <tr class="table-primary">
                                    <th scope="col">Xe</th>
                                    <th scope="col">Trọng tải</th>
                                    <th scope="col">Kích thước</th>
                                    <th scope="col">Loại nhiên liệu</th>
                                </tr>
                            </thead>
                            <tbody>';
    foreach ($_SESSION['cart'] as $key => $value) {
    $cart .= '<tr>
                <td scope="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-3 d-none d-xl-block d-xxl-none">
                                <img src="' . $rootPath . '/public/img/products/' . $value['img'] . '" class="img-fluid rounded">
                            </div>
                            <div class="col-xl-9">
                                <div class="d-flex flex-column justify-content-center">
                                    <p>' . $value['name'] . '</p>
                                    <p>Mã xe: <strong>#' . $value['id'] . '</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td> &emsp; &emsp; &emsp;' . number_format($value['weight']) . ' <sup>đ</sup></td>
                <td class="align-middle">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-light disabled">' . $value['size'] . '</button>
                    </div>
                </td>
                <td class="text-danger">&emsp; &emsp; &emsp; <strong>' . number_format($value['weight'] * $value['size']) . ' <sup>đ</sup></strong></td>
                <td>
                    &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                    <button class="btn btn-danger" onclick="deleteCartItem(' . $value['id'] . ')"><i class="fa-solid fa-trash-can"></i></button>
                </td>
            </tr>';
    }
    $cart .=    '</tbody>
                        </table>
                        </div>
                        <div class="col-xl-3 col-md-4 col-sm-12">
                            <div class="container shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="row">
                                    <table class="table">
                                        <tr>
                                            <td>Tổng tiền</td>
                                            <td class="d-flex justify-content-end"><strong>' . number_format($totalBill) . ' <sup>đ</sup></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Giảm giá</td>
                                            <td class="d-flex justify-content-end"><strong>0 <sup>đ</sup></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Thành tiền</td>
                                            <td class="text-danger d-flex justify-content-end"><strong>' . number_format($totalBill) . ' <sup>đ</sup></strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="row">
                                    <a href="' . $rootPath . '/customer/check_out.php" class="btn btn-primary"><strong>Đặt hàng</strong></a>
                                    <a href="' . $rootPath . '/product.php" class="btn btn-outline-warning mt-2">Tiếp tục mua hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    $headerCart .= '<i class="fa-sharp fa-solid fa-calendar me-1"></i>' . sizeof($_SESSION['cart']);
} else {
    $cart .= '<div class="container pt-5 pb-5">
                <div class="row mb-2">
                    <div class="alert alert-warning">
                        <span class="h4"> <i class="fa-light fa-face-smile"></i> Hiện bạn chưa đăng ký lịch trình nào!</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-3 col-sm-6 mx-auto">
                        <a href="' . $rootPath . '/product.php" class="btn btn-primary">Đăng kí lịch trình</a>
                    </div>
                </div>
            </div>';
    $headerCart .= '<i class="fa-sharp fa-solid fa-calendar me-1"></i> 0';
}

$result = array(
    'cart' => $cart,
    'headerCart' => $headerCart
);

echo json_encode($result);
