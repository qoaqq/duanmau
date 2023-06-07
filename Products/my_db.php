<?php 
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'phoneSenerity';

    try {
        $conn = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "connect failed:<br \>" . $e->getMessage();
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

?>