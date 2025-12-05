<?php
$db_host = "db";
$db_user = "annisa";
$db_pass = "12345";
$db_name = "attendance_system";

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch (PDOException $e) {
    die("Terjadi masalah: " . $e->getMessage());
}
?>

