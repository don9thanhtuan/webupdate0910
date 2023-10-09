<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý hãng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="./bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="./FrontEnd/style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png" />
</head>

<body>
    <?php
    include './sidebar_quantri.php';
    
    ?>
    <div class="content">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <div class="container-fluid bg-secondary">
                    <div class="hstack gap-2 ">
                        <div class="p-2">
                            <h5>Quản lý hãng<h5>
                        </div>
                        <div class="p-2 ms-auto">
                            <form action="themhang.php" method="POST">
                                <!-- Nội dung của biểu mẫu -->
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </form>
                        </div>
                        <div class="p-2"><a href="xoahang.php" class="btn btn-danger">Xóa</a></div>
                    </div>
                </div>
                <div class="accordion-body">


                    <form class="form-inline" action="quan_ly_hang.php" method="GET">
                        <input class="" placeholder="Tên hãng" style="height: 35px;" name="search" type="text" />
                        <button class="btn bg-warning" type="submit" style="margin-top: -6px;">Tìm kiếm</button>
                    </form>


                    <br>
                    <?php

// Import kết nối CSDL
require_once 'ketnoi.php';

// Xử lý tìm kiếm
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Truy vấn dữ liệu từ bảng hang_san_xuat
$query = "SELECT * FROM hang_san_xuat";
// Thêm điều kiện tìm kiếm nếu có tên hãng được nhập
if (!empty($search)) {
    $query .= " WHERE ten_hang LIKE '%$search%'";
}
$result = mysqli_query($conn, $query);

// Kiểm tra xem có dữ liệu trả về hay không
if (mysqli_num_rows($result) > 0) {
    echo '<table class="table table-bordered table-hover vertical-center">';
    echo '<thead>';
    echo '<tr>';
    echo '<th id="manufacturer-grid_cnumber">&nbsp;</th>';
    echo '<th class="checkbox-column" id="manufacturer-grid_c0"><input type="checkbox" value="1" name="manufacturer-grid_c0_all" id="manufacturer-grid_c0_all" /></th>';
    echo '<th id="manufacturer-grid_cavatar">&nbsp;</th>';
    echo '<th id="manufacturer-grid_c1">Tên hãng</th>';
    echo '<th id="manufacturer-grid_c1">Số điện thoại</th>';
    echo '<th id="manufacturer-grid_c1">Địa chỉ</th>';

    //echo '<th id="manufacturer-grid_corder" style="text-align:center;">Thứ tự</th>';
    echo '<th></th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td width="30px">' . $row['id'] . '</td>';
        echo '<td width="30px"><input value="' . $row['id'] . '" id="manufacturer-grid_c0_0" type="checkbox" name="manufacturer-grid_c0[]" /></td>';
        echo '<td width="60px;"><img src="' . $row['anh_dai_dien'] . '" alt="Ảnh đại diện" width="60px"></td>';

        echo '<td>' . $row['ten_hang'] . '</td>';
        echo '<td>' . $row['so_dien_thoai'] . '</td>';
        echo '<td>' . $row['dia_chi'] . '</td>';
        //echo '<td width="80px" style="text-align:center;">' . $row['thu_tu'] . '</td>';
        echo '<td style="width: 100px;" align="center"><a class="fa-solid fa-pen-to-square" href="suahang.php?id=' . $row['id'] . '"></a>&emsp;<a class="fa-solid fa-trash" href="xoahang.php?id=' . $row['id'] . '"></a></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Không có dữ liệu.';
}

// Đóng kết nối CSDL
mysqli_close($conn);

?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>