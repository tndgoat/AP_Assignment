<?php
session_start();
ob_start();
$rootPath = '/AP_Assignment/admin/';
if (!isset($_SESSION["email_ad"])) {
    header('location: login.php');
    exit();
}

require_once '../../database/db_connection.php';

// lấy productId
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    if ($productId == 0) {
        header('location: ../../404.php');
        exit();
    }
} else {
    $conn->close();
    header('location: ../../404.php');
    exit();
}

$sqlFindProduct = "SELECT * FROM product WHERE product_id = '$productId'";
$product = $conn->query($sqlFindProduct);
if ($product->num_rows <= 0) {
    $conn->close();
    header('location: ../../404.php');
    exit();
}

// khi nút update được nhấn
if (isset($_POST['update'])) {
    if ($_FILES['images']['error'] > 0) {
        $tb = 'Vui lòng nhập ảnh hợp lệ';
    } else {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $weight = floatval(mysqli_real_escape_string($conn, $_POST['weight']));
        $size = floatval(mysqli_real_escape_string($conn, $_POST['size']));
        $fuel_type = mysqli_real_escape_string($conn, $_POST['fuel_type']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $categoryId = intval(mysqli_real_escape_string($conn, $_POST['categoryId']));
        $images = mysqli_real_escape_string($conn, $_FILES['images']['name']);
        $imagesOld = mysqli_real_escape_string($conn, $_POST['imagesOld']);

        if ($name == '' || $weight == '' || $size == '' || $fuel_type == '' || $description == '' || $categoryId == '' || $images == '') {
            $tb = 'Bạn chưa nhập đủ các trường' . '<br/>';
        } else {
            $sqlUpdate = "UPDATE product SET 
                name = '$name', 
                weight = $weight, 
                size = $size, 
                fuel_type = '$fuel_type', 
                description = '$description', 
                category_id = $categoryId, 
                images = '$images' 
                WHERE product_id = '$productId'";

            if ($conn->query($sqlUpdate) === TRUE) {
                if (!file_exists("../../public/img/products/" . $images)) {
                    move_uploaded_file($_FILES["images"]["tmp_name"], "../../public/img/products/" . $images);
                    unlink("../../public/img/products/" . $imagesOld);
                }
                $conn->close();
                setcookie('thongBao', 'Cập nhật thông tin xe thành công', time() + 5);
                header("location: index.php");
                exit();
            } else {
                $tb = "Error updating record: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./includes/css/base.css">
    <link rel="stylesheet" href="./includes/css/home.css">
</head>
<body>
<?php
    require '../includes/header.php';
    require '../includes/navbar.php';
?>
<div class="container-fluid mt-5 mb-3"></div>
<div class="container">
    <div class="row">
        <div class="col text-center h4 text-primary">
            Cập nhật thông tin xe
        </div>
    </div>
    <?php 
        if (isset($tb)) {
            echo '<div class="row"><div class="alert alert-danger">'.$tb.'</div></div>'; 
        }
    ?>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 shadow p-3 mb-5 bg-body rounded">
            <form action="<?=$_SERVER['PHP_SELF']?>?id=<?=$productId?>" method="post" enctype="multipart/form-data">
                <?php
                    $product = $product->fetch_array();
                ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Tên xe</label>
                    <input type="text" class="form-control" name="name" value="<?=$product['name']?>" id="name" placeholder="Nhập tên xe">
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">Trọng tải</label>
                    <input type="number" class="form-control" name="weight" value="<?=$product['weight']?>" id="weight" placeholder="Nhập trọng tải">
                </div>
                <div class="mb-3">
                    <label for="size" class="form-label">Kích thước</label>
                    <input type="number" class="form-control" name="size" value="<?=$product['size']?>" id="size" placeholder="Nhập kích thước">
                </div>
                <div class="mb-3">
                    <label for="fuel_type" class="form-label">Nhiên liệu</label>
                    <input type="text" class="form-control" name="fuel_type" value="<?=$product['fuel_type']?>" id="fuel_type" placeholder="Nhập loại nhiên liệu">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Mô tả</label>
                    <textarea id="desc" name="description" class="form-control mt-2" rows="6" placeholder="Nhập mô tả xe"><?=$product['description']?></textarea>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Thể loại</label>
                    <select name="categoryId" class="form-select">
                        <?php
                            $sqlCategory = "SELECT * FROM category";
                            $category = $conn->query($sqlCategory);
                            while($row = $category->fetch_assoc()){
                        ?>
                        <option value="<?=$row['category_id']?>" <?php if ($product['category_id']==$row['category_id']) echo 'selected'; ?> ><?=$row['category_name']?></option>
                        <?php 
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <img src="../../public/img/products/<?=$product['images']?>" width="200px" alt="">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Hình</label>
                        <input class="form-control" name="images" type="file" id="formFile">
                        <input class="form-control" name="imagesOld" value="<?=$product['images']?>" type="hidden">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary w-100 mt-2" value="Cập nhật" name="update">
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<?php
    require '../includes/footer.php';
?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
