<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hãng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="./bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="./FrontEnd/style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png" />
</head>

<body>
    <?php
    include './sidebar_quantri.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['tenhang']) && isset($_POST['sdt']) && isset($_POST['diachi']) && isset($_FILES['anhdaidien'])) {
            $tenhang = $_POST['tenhang'];
            $sdt = $_POST['sdt'];
            $diachi = $_POST['diachi'];
            
            // Xử lý tệp ảnh
            $targetDirectory = "uploads/"; // Thư mục lưu trữ ảnh
            $targetFile = $targetDirectory . basename($_FILES['anhdaidien']['name']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Kiểm tra nếu tệp đã tồn tại
            if (file_exists($targetFile)) {
                echo "Tệp đã tồn tại.";
                $uploadOk = 0;
            }

            // Kiểm tra kích thước tệp ảnh (để đảm bảo tệp không quá lớn)
            if ($_FILES['anhdaidien']['size'] > 500000) { // Giới hạn kích thước là 500KB
                echo "Tệp ảnh quá lớn.";
                $uploadOk = 0;
            }

            // Cho phép chỉ những định dạng ảnh cụ thể (ví dụ: jpg, jpeg, png, gif)
            if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
                echo "Chỉ chấp nhận các tệp ảnh JPG, JPEG, PNG và GIF.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Tải lên tệp ảnh không thành công.";
            } else {
                // Lưu tệp ảnh vào thư mục
                if (move_uploaded_file($_FILES['anhdaidien']['tmp_name'], $targetFile)) {
                    // Thực hiện kết nối đến cơ sở dữ liệu
                    $conn = mysqli_connect('localhost', 'root', '', 'noithat');

                    if (!$conn) {
                        die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
                    }

                    // Sử dụng truy vấn SQL để thêm dữ liệu
                    $sql = "INSERT INTO hang_san_xuat (ten_hang, so_dien_thoai, dia_chi, anh_dai_dien) VALUES ('$tenhang', '$sdt', '$diachi', '$targetFile')";

                    if (mysqli_query($conn, $sql)) {
                        echo "Thêm hãng thành công!";
                    } else {
                        echo "Lỗi: " . mysqli_error($conn);
                    }

                    // Đóng kết nối
                    mysqli_close($conn);
                } else {
                    echo "Tải lên tệp ảnh không thành công.";
                }
            }
        }
    }
    ?>

    <div class="content">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <div class="container-fluid bg-secondary">
                    <div class="hstack gap-2 ">
                        <div class="p-2">
                            <h5>Thêm hãng</h5>
                        </div>
                    </div>
                </div>
                <div class="accordion-body">
                    <form class="form-horizontal" id="category-form" action="#" method="POST" enctype="multipart/form-data">
                        <!-- Các trường nhập dữ liệu -->
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Tên hãng</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tenhang">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="sdt">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="diachi">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Ảnh đại diện</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="anhdaidien" accept="image/*">
                            </div>
                        </div>

                        <div class="control-group form-group buttons">
                            <button class="btn btn-primary" type="submit" id="btnAddCate">Thêm hãng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
