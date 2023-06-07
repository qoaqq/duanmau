<?php
    require_once "./my_db.php";

    $sql = "SELECT * FROM loai";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_prd = $_POST['id_prd'];
        $name_prd = $_POST['name_prd'];
        $price = $_POST['price'];
        $sale = $_POST['sale'];
        $date = $_POST['date'];
        $views = $_POST['views'];
        $id_cate = $_POST['id_cate'];
        $images = $_POST['img'];

        // Assuming you have an array called $data

        

        $file = $_FILES['img'];

        if (empty($_POST['name_prd'])) {
            $error['name_prd'] = "Please fill the name of product";
        }

        if (empty($_POST['price'])) {
            $error['price'] = "Please fill the price";
        }

        if (empty($_POST['sale'])) {
            $error['sale'] = "Please fill the sale";
        }

        if (empty($_POST['date'])) {
            $error['date'] = "Please fill the date";
        }

        if (empty($_POST['views'])) {
            $error['views'] = "Please fill the views";
        }

        if ($file['size'] > 0) {
            $img = ['jpg', 'jpeg', 'png', 'gif'];
            $images = $file['name'];
            $file_name = $file['name'];
            $file_ext = pathinfo($file_name,  PATHINFO_EXTENSION);
            if (!in_array($file_ext, $img)) {
                $error['img'] = "File của bạn không phải là ảnh";
            }
        }
        
        if (!isset($error)) {
            $sql = "UPDATE `hang_hoa` 
                    SET `ten_hh`='$name_prd',
                        `don_gia`=$price,
                        `giam_gia`=$sale,
                        `hinh`='$images',
                        `ngay_nhap`='$date',
                        `ma_loai`=$id_cate,
                        `so_luot_xem`=$views WHERE `ma_hh`=$id_prd";

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            move_uploaded_file($file['tmp_name'], './img/'. $file_name);
            
            header("location: dashboard.php");

            exit;
        }
    }
    
    $id_prd = $_GET['ma_hh'];
    $sql = "SELECT * FROM `hang_hoa` WHERE `ma_hh` = $id_prd";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/style.css" />

    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data" class="container" >
        <h1>Edit Customer</h1>
        <div class="mb-3">
            <input type="hidden" class="form-control" name="id_prd" value="<?= $products['ma_hh'] ?? '' ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Name Product</label>
            <input type="text" class="form-control" name="name_prd" value="<?= $products['ten_hh'] ?? '' ?>" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['name_prd'] ?? '' ?></p>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Price</label>
            <input type="number" class="form-control" name="price" value="<?= $products['don_gia'] ?? '' ?>" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['price'] ?? '' ?></p>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Sale</label>
            <input type="number" class="form-control" name="sale" value="<?= $products['giam_gia'] ?? '' ?>" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['sale'] ?? '' ?></p>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">IMG</label>
            <img src="./img/<?= $products['hinh'] ?>"  width="100" alt="">
            <input type="hidden" name="img" value="<?= $products['hinh'] ?>" >
            <input type="file" class="form-control" name="img" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['img'] ?? '' ?></p>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Date Add</label>
            <input type="date" class="form-control" name="date" value="<?= $products['ngay_nhap'] ?? '' ?>" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['date'] ?? '' ?></p>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">ID Categories</label>
            <select name="id_cate" id="">
                <?php foreach($categories as $id) : ?>
                    <option value="<?= $id['ma_loai'] ?>" <?= ($id['ma_loai'] == $products['ma_loai']) ? 'selected' : '' ?>>
                        <?= $id['ten_loai'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Views</label>
            <input type="number" class="form-control" name="views" value="<?= $products['so_luot_xem'] ?? '' ?>" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['views'] ?? '' ?></p>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<!-- Footer -->
    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="js/script.js"></script>

    <script src="./js/bootstrap.bundle.js"></script>
</body>
</html>