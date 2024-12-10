
<?php
  include('../db/connect.php');
  session_start();
?>
<?php
  if(!isset($_SESSION['dangnhap'])){
     header('Location:index.php');
  }
  if(isset($_GET['login'])){
    $dangxuat = $_GET['login'];
  }else{
    $dangxuat = '';
  }
  if($dangxuat == 'dangxuat'){
    session_destroy();
    //unset($_SESSION['login']);
    header('Location: index.php');
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
                <li class="nav-item ">
                    <a class="nav-link" href="xulykhachhang.php">Khách Hàng</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="xulykhachhang.php">Ý Kiến & Câu Hỏi</a>
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
            <h4>Danh Sách Câu Hỏi-Ý Kiến</h4>
           <?php
            $sql_danhsach_cauhoi = mysqli_query($con, "SELECT * FROM tbl_lienhe ORDER BY lienhe_id");
            ?>
            <table class="table table-bordered">
                <tr>
                    <td>Thứ Tự</td>
                    <td>Tên Khách Hàng</td>
                    <td>Email</td>
                    <td>Tin Nhắn</td>
                    <td>Quản Lý</td>
                </tr>
                <?php
                $i = 0;
                while ($row_cauhoi = mysqli_fetch_array($sql_danhsach_cauhoi)) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_cauhoi['name'] ?></td>
                    <td><?php echo $row_cauhoi['email'] ?></td>
                    <td><?php echo $row_cauhoi['message'] ?></td>
                    <td><a href="https://mail.google.com/mail/u/0/#inbox?compose=new">Trả Lời</a></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>      
    </div>
</body>
</html>
