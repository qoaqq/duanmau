<?php
    require_once "./my_db.php";
    //Categories
    $sql = "SELECT * FROM loai";

    $stmt = $conn ->prepare($sql);

    $stmt->execute();

    $categories = $stmt->fetchAll((PDO::FETCH_ASSOC));

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name_prd = $_POST['name_prd'];
        $price = $_POST['price'];
        $sale = $_POST['sale'];
        $date = $_POST['date'];
        $views = $_POST['views'];
        $id_cate = $_POST['id_cate'];

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

        $file = $_FILES['img'];
        if ($file['size'] == 0) {
            $error['img'] = "Vui long tai anh len";
        } else{
            $img = ['jpg', 'jpeg', 'png', 'gif'];
            $file_name = $file['name'];
            $file_ext = pathinfo($file_name,  PATHINFO_EXTENSION);
            if (!in_array($file_ext, $img)) {
                $error['img'] = "File của bạn không phải là ảnh";
            }
        }
            
        if (!empty($_POST['name_prd']) && !empty($_POST['price']) && !empty($_POST['sale']) && !empty($_POST['date']) && !empty($_POST['views'])) {
            $sql = "INSERT INTO `hang_hoa`(`ten_hh`, `don_gia`, `giam_gia`, `hinh`, `ngay_nhap`, `ma_loai`, `so_luot_xem`) 
            VALUES ('$name_prd', $price, $sale, '$file_name', '$date', $id_cate, $views)";

            move_uploaded_file($file['tmp_name'], './img/'. $file_name);

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            header("location: dashboard.php");

            exit;
        }
    }

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
            <input type="hidden" class="form-control" name="id_prd" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Name Product</label>
            <input type="text" class="form-control" name="name_prd" value="<?= $name_prd ?? '' ?>" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['name_prd'] ?? '' ?></p>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Price</label>
            <input type="number" class="form-control" name="price" value="<?= $price ?? '' ?>" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['price'] ?? '' ?></p>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Sale</label>
            <input type="number" class="form-control" name="sale" value="<?= $sale ?? '' ?>" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['sale'] ?? '' ?></p>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Img</label>
            <input type="file" class="form-control" name="img" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['img'] ?? '' ?></p>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Date Add</label>
            <input type="date" class="form-control" name="date" value="<?= $date ?? '' ?>" id="exampleInputPassword1">
            <p class="fs-6" style="color: red;"><?= $error['date'] ?? '' ?></p>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">ID Categories</label>
            <select name="id_cate" id="">
                <?php foreach($categories as $id): ?>
                    <option value="<?= $id['ma_loai'] ?>"><?= $id['ten_loai'] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Views</label>
            <input type="number" class="form-control" name="views" value="<?= $views ?? '' ?>" id="exampleInputPassword1">
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