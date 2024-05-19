<?php
session_start();
ob_start();
$rootPath = '/AP_Assignment';
require_once './database/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/base.css">
</head>

<body>
    <?php
        require './includes/header.php';
        require './includes/navbar.php';
    ?>

    <div id="template-mo-zay-hero-carousel" class="carousel carousel-dark slide mb-5" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 d-flex align-items-center image-container">
                            <a href="#"><img class="img-fluid rounded" src="./public/img/carousels/carousel1.jpg" alt="caro.jpg" style="height: 300px;" /></a>
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center content-wrapper" style="height: 300px;">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1" style="color:#002A54"><strong>Dịch vụ xe khách</strong></h1>
                                <h3 class="h2" style="color:#ED171F">Vận chuyển hành khách</h3>
                                <p>Công ty XYZ hứa hẹn sẽ mang chất lượng vận chuyển tốt nhất cho khách hàng!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 d-flex align-items-center image-container">
                            <a href="#"><img class="img-fluid rounded" src="./public/img/carousels/carousel2.jpg" style="height: 300px;" /></a>
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center content-wrapper" style="height: 300px;">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1" style="color:#002A54"><strong>Dịch vụ xe tải</strong></h1>
                                <h3 class="h2" style="color:#ED171F">Vận chuyển hàng hóa trọng tải nhỏ</h3>
                                <p>Công ty XYZ hứa hẹn sẽ mang chất lượng vận chuyển tốt nhất cho khách hàng!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 d-flex align-items-center image-container">
                            <a href="#"><img class="img-fluid rounded" src="./public/img/carousels/carousel3.jpg" style="height: 300px;" /></a>
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center content-wrapper" style="height: 300px;">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1" style="color:#002A54"><strong>Dịch vụ xe container</strong></h1>
                                <h3 class="h2" style="color:#ED171F">Vận chuyển hàng hóa trọng tải lớn</h3>
                                <p>Công ty XYZ hứa hẹn sẽ mang chất lượng vận chuyển tốt nhất cho khách hàng!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $sqlShowProducts = "SELECT product_id, name, weight, size, fuel_type, images, status FROM product";
    $categoryId = '';
    if (isset($_POST['search_btn'])) {
        $categoryId = $_POST['categoryId'];
        $sqlShowProducts = "SELECT product_id, name, weight, size, fuel_type, images, status FROM product WHERE category_id = '$categoryId'";
    }
    $products = $conn->query($sqlShowProducts);
    $totalProducts = $products->num_rows;
    $currentPage = 1;
    if (isset($_GET['page'])) {
        settype($_GET['page'], 'int'); // tránh injection, trang tự về 0
        $currentPage = $_GET['page'];
    }
    $limit = 8;
    $totalPage = ceil($totalProducts / $limit);

    // giới hạn phân trang trong 1-totalPage
    if ($currentPage > $totalPage) {
        $currentPage = $totalPage;
    } elseif ($currentPage < 1) {
        $currentPage = 1;
    }

    $start = ($currentPage - 1) * $limit;
    $sqlShowProducts = $sqlShowProducts . " LIMIT $start, $limit";
    $products = $conn->query($sqlShowProducts);
    ?>

    <?php
        require './includes/footer.php';
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="./public/javascripts/loadCartHeader.js"></script>

    <script>
        $(document).ready(function() {
            loadCartAjax();

            $(window).scroll(function() {
                if ($(this).scrollTop() > 114) {
                    $("#navbar-top").addClass('fix-nav')
                } else {
                    $("#navbar-top").removeClass('fix-nav')
                }
            })
        });
    </script>
    <script src="./public/javascripts/liveSearch.js"></script>

</body>

</html>