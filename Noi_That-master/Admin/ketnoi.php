<?php
$conn = mysqli_connect("localhost", "root", "", "noithat");

// Kiểm tra kết nối CSDL
if (!$conn) {
    die("Kết nối CSDL thất bại: " . mysqli_connect_error());
}
?>
