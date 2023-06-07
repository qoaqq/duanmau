<?php
    require_once "./my_db.php";

    $ma_hh = $_GET['ma_hh'];
    // var_dump($ma_hh);
    // die;

    $sql = "DELETE FROM `hang_hoa` WHERE ma_hh = '$ma_hh'";
    // echo $sql; die;

    // echo $sql; die;

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $msg_del = "Delete success";
    header("location: dashboard.php");

?>