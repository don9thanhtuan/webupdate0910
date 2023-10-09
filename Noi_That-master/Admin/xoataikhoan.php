<?php
// Import kết nối CSDL
require_once 'ketnoi.php';

// Kiểm tra xem có tham số id được gửi từ URL không
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Lấy giá trị tham số id
    $id = $_GET['id'];

    // Thực hiện truy vấn SQL để xóa tài khoản với id tương ứng
    $sql = "DELETE FROM user WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Nếu xóa thành công, chuyển hướng trở lại trang quản lý tài khoản
        header("Location: quan_ly_tai_khoan.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "Tham số id không hợp lệ.";
}

// Đóng kết nối CSDL
mysqli_close($conn);
?>
