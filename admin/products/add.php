<?php
session_start();
ob_start();
$rootPath = '/AP_Assignment/admin/';
if (!isset($_SESSION["email_ad"])) {
    header('location: login.php');
}

require_once '../../database/db_connection.php';
if (isset($_POST['add'])) {
    if ($_FILES['images']['error']>0) {
        $tb = 'Vui lòng nhập ảnh hợp lệ!';
    } else {
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $weight = mysqli_real_escape_string($conn,$_POST['weight']);
        $size = mysqli_real_escape_string($conn,$_POST['size']);
        $fuel_type = mysqli_real_escape_string($conn,$_POST['fuel_type']);
        $description = mysqli_real_escape_string($conn,$_POST['description']);
        $categoryId = mysqli_real_escape_string($conn,$_POST['categoryId']);
        $images = mysqli_real_escape_string($conn,$_FILES['images']['name']);
        if ($name == '' || $weight == '' || $size == '' || $fuel_type == '' || $description == '' || $categoryId =='' || $images == '' ) {
            $tb .= 'Bạn chưa nhập đủ các trường'.'<br/>';
        } else {
        $sqlInsert = "INSERT INTO product (name, category_id, description, images, weight, size, fuel_type) 
                    VALUES ('$name', '$categoryId', '$description', '$images', '$weight', '$size', '$fuel_type')"; 
        $conn->query($sqlInsert);
        if (! file_exists("../../public/img/products/".$images))
            move_uploaded_file($_FILES["images"]["tmp_name"],"../../public/img/products/".$images);
        $conn->close();
        setcookie('thongBao', 'Bạn đã thêm xe mới thành công', time()+5);
        header("location: index.php");
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
    <link rel="stylesheet"  href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
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
<div class="container-fluid mt-5 mb-3">
</div>
<div class="container">
    <div class="row">
        <div class="col text-center h4 text-primary">
            Thêm xe mới
        </div>
    </div>
    <?php 
        if (isset($tb)) {
            echo '<div class="row"><div class="alert alert-danger">'.$tb.'</div></div>'; 
        }
    ?>
    <div class="row">
        <div class="col-xl-2"></div>
        <div class="col-xl-8 col-md-6 col-sm-12 shadow p-3 mb-5 bg-body rounded">
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên xe</label>
                    <input type="text" class="form-control" name="name" value="" id="name" placeholder="Nhập tên xe">
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">Trọng tải</label>
                    <input type="number" class="form-control" name="weight" value="" id="weight" placeholder="Nhập trọng tải">
                </div>
                <div class="mb-3">
                    <label for="size" class="form-label">Kích thước</label>
                    <input type="number" class="form-control" name="size" value="" id="size" placeholder="Nhập kích thước">
                </div>
                <div class="mb-3">
                    <label for="fuel_type" class="form-label">Loại nhiên liệu</label>
                    <input type="text" class="form-control" name="fuel_type" value="" id="fuel_type" placeholder="Nhập loại nhiên liệu">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Mô tả</label>
                    <textarea id="desc" name="description" class="form-control mt-2" id="" rows="6" placeholder="Nhập mô tả xe"></textarea>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Thể loại</label>
                    <select name="categoryId" class="form-select" id="">
                        <?php
                            $sqlCategory = "SELECT * FROM category";
                            $category = $conn->query($sqlCategory);
                            while($row = $category->fetch_assoc()){
                        ?>
                        <option value="<?=$row['category_id']?>"><?=$row['category_name']?></option>
                        <?php 
                            }
                        ?>
                    </select>
                </div>
                <div class="d-flex">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Hình</label>
                        <input class="form-control" name="images" type="file" id="formFile">
                    </div>
                </div>
                <input type="submit" class="btn btn-success w-100 mt-2" value="Cập nhật" name="add">
            </form>
        </div>
        <div class="col-xl-2"></div>
    </div>
</div>

<?php
    require '../includes/footer.php';
?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>