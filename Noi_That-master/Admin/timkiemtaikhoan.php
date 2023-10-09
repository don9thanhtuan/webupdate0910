<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm tài khoản</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .pageTitle {
            font-size: 28px;
            color: #333; /* Màu cho tiêu đề */
            text-align: center; /* Căn giữa theo chiều ngang */
            padding: 20px 0; /* Khoảng cách trên và dưới tiêu đề */
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        p {
            font-size: 16px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #d9edf7;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- <h1>Kết quả tìm kiếm tài khoản</h1> -->
        <?php
        
        // Kết nối đến cơ sở dữ liệu
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "noithat";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }
        
        // Lấy thông tin tìm kiếm từ yêu cầu GET
        $searchId = $_GET["search_id"];
        $searchName = $_GET["search_name"];
        $searchEmail = $_GET["search_email"];
       // $searchSex = $_GET["search_sex"];
        
        
        // Xây dựng câu truy vấn SQL tùy theo điều kiện tìm kiếm
        $sql = "SELECT id, ho_ten, mat_khau, email, gioi_tinh, cap_bac FROM user WHERE 1=1";
        
        if (!empty($searchId)) {
            $sql .= " AND id = '$searchId'";
        }
        
        if (!empty($searchName)) {
            $sql .= " AND ho_ten LIKE '%$searchName%'";
        }
        if (!empty($searchEmail)) {
            $sql .= " AND email LIKE '%$searchEmail%'";
        }
        // if (!empty($searchName)) {
        //     $sql .= " AND gioi_tinh LIKE '%$searchSex%'";
        // }
        
        
        // Thực hiện truy vấn
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Hiển thị kết quả tìm kiếm ở đây
                // Ví dụ: echo ra HTML cho kết quả
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["ho_ten"] . "</td>";
                echo "<td>" . $row["mat_khau"] . "</td>"; // Thay thế mật khẩu nguyên văn bằng dấu sao hoặc dòng văn bản khác để che giấu nó
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["gioi_tinh"] . "</td>";
                echo "<td>" . $row["cap_bac"] . "</td>";
                //echo "<td>Cấp bậc</td>"; // Bạn cần thêm cột này nếu có thông tin về cấp bậc
                echo "<td style='width: 100px;' align='center'><a class='fa-solid fa-pen-to-square' href='suataikhoan.php?id=" . $row["id"] . "'></a>&emsp;<a class='fa-solid fa-trash' href='xoataikhoan.php?id=" . $row["id"] . "'></a></td>";
                echo "</tr>";
            
            }
        } else {
            echo "<tr>";
            echo "Không tìm thấy kết quả phù hợp.";
            echo "</tr>";
            
        }
        
        $conn->close();
        
        ?>
    </div>
</body>

</html>

