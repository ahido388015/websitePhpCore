<?php 
include('../db/connect.php');
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
if (!isset($_SESSION['dangnhap'])) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['login'])) {
    $dangxuat = $_GET['login'];
} else {
    $dangxuat = '';
}

if ($dangxuat == 'dangxuat') {
    session_destroy();
    header('Location: index.php');
    exit();
}

if (isset($_POST['capnhatdonhang'])) {
    $xuly = $_POST['xuly'];
    $mahang = $_POST['mahang_xuly'];
    $sql_update_donhang = mysqli_query($con, "UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE mahang='$mahang'");
}

if (isset($_GET['xoadonhang'])) {
    $mahang = $_GET['xoadonhang'];
    $sql_delete = mysqli_query($con, "DELETE FROM tbl_donhang WHERE mahang='$mahang'");
    header("Location:xulydonhang.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Khách Hàng</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
    <p>Xin Chào: <?php echo $_SESSION['dangnhap'] ?></p>
    <button><a href="?login=dangxuat">Đăng Xuất</a></button>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="xulydonhang.php">Đơn Hàng <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulydanhmuc.php">Danh Mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulydanhmucbaiviet.php">DM_Bài Viết</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulybaiviet.php">Bài Viết</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="xulysanpham.php">Sản Phẩm</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="xulykhachhang.php">Khách Hàng</a>
                </li>
                 <li class="nav-item">
                <a class="nav-link" href="xulycauhoi.php">Ý Kiến & Câu Hỏi</a>
              </li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="container">
        <div>
            <p>Xin Chào: <?php echo $_SESSION['dangnhap'] ?></p>
        </div>
        <div class="col-md-12">
            <h4>Danh Sách Khách Hàng</h4>
            <?php
            $sql_danhsach_khachhang = mysqli_query($con, "SELECT * FROM tbl_khachhang ORDER BY khachhang_id");
            ?>
            <table class="table table-bordered">
                <tr>
                    <td>Thứ Tự</td>
                    <td>Tên Khách Hàng</td>
                    <td>Số Điện Thoại</td>
                    <td>Email</td>
                    <td>Địa Chỉ</td>
                    <td>Quản Lý</td>
                </tr>
                <?php
                $i = 0;
                while ($row_khachhang = mysqli_fetch_array($sql_danhsach_khachhang)) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_khachhang['name'] ?></td>
                    <td><?php echo $row_khachhang['phone']; ?></td>
                    <td><?php echo $row_khachhang['email'] ?></td>
                    <td><?php echo $row_khachhang['address'] ?></td>
                    <td><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['khachhang_id'] ?>">Xem Giao Dịch</a></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <br>
        <div class="col-md-12">
            <h4>Liệt Kê Lịch Sử Đơn Hàng</h4>
            <?php
            if (isset($_GET['khachhang'])) {
                $khachhang_id = $_GET['khachhang'];
            } else {
                $khachhang_id = '';
            }
            $sql_select = mysqli_query($con, "SELECT * FROM tbl_sampham, tbl_khachhang, tbl_giaodich WHERE tbl_giaodich.sanpham_id=tbl_sampham.sanpham_id AND tbl_giaodich.khachhang_id=tbl_khachhang.khachhang_id AND tbl_giaodich.khachhang_id='$khachhang_id' ORDER BY tbl_giaodich.giaodich_id DESC");
            ?>
            <table class="table table-bordered">
                <tr>
                    <td>Thứ Tự</td>
                    <td>Khách Hàng</td>
                    <td>Mã Giao Dịch</td>
                    <td>Tên Sản Phẩm</td>
                    <td>Ngày Đặt</td>
                </tr>
                <?php
                $i = 0;
                while ($row_donhang = mysqli_fetch_array($sql_select)) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_donhang['name'] ?></td>
                    <td><?php echo $row_donhang['magiaodich'] ?></td>
                    <td><?php echo $row_donhang['sanpham_name'] ?></td>
                    <td><?php echo $row_donhang['ngaythang'] ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
