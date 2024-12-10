<?php 
include('../db/connect.php');
session_start();

if(isset($_POST['thembaiviet'])){
    $tenbaiviet  = $_POST['tenbaiviet'];
    $hinhanh   = $_FILES['hinhanh']['name'];
    $tomtat  = $_POST['tomtat'];
    $danhmuc = $_POST['danhmuc'];
    $noidung  = $_POST['noidung'];
    $path = '../uploads/';
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $sql_insert_product = mysqli_query($con,"INSERT INTO tbl_baiviet(tenbaiviet,tomtat,noidung,danhmuctin_id,baiviet_image) values('$tenbaiviet','$tomtat','$noidung','$danhmuc','$hinhanh')");
    move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
}

elseif(isset($_POST['capnhatbaiviet'])){
    $id_update = $_POST['id_update'];
    $tenbaiviet = $_POST['tenbaiviet'];
    $hinhanh   = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $tomtat= $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $danhmuc = $_POST['danhmuc'];
    $path = '../uploads/';

    if($hinhanh != ''){
        move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
        $sql_update_image ="UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet', tomtat='$tomtat', noidung='$noidung', danhmuctin_id='$danhmuc', baiviet_image='$hinhanh' WHERE baiviet_id='$id_update'";
    } else {
        $sql_update_image ="UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet', tomtat='$tomtat', noidung='$noidung', danhmuctin_id='$danhmuc' WHERE baiviet_id='$id_update'";
    }
    mysqli_query($con, $sql_update_image);
}

if(isset($_GET['xoa_sp'])){
    $id_xoa = $_GET['xoa_sp'];
    $sql_xoa_sp = mysqli_query($con,"DELETE FROM tbl_baiviet WHERE baiviet_id='$id_xoa'");
}

if(!isset($_SESSION['dangnhap'])){
    header('Location:index.php');
}

if(isset($_GET['login'])){
    $dangxuat = $_GET['login'];
} else {
    $dangxuat = '';
}

if($dangxuat == 'dangxuat'){
    session_destroy();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <title>Admin Bài Viết</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<p>Xin Chào: <?php echo $_SESSION['dangnhap'] ?></p>
<button> <a href="?login=dangxuat"> Đăng Xuất </a> </button>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="xulydonhang.php">Đơn Hàng <!-- <span class="sr-only">(current)</span> --></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulydanhmuc.php">Danh Mục</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulydanhmucbaiviet.php">DM_Bài Viết</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="xulybaiviet.php">Bài Viết</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulysanpham.php">Sản Phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulykhachhang.php">Khách Hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="xulycauhoi.php">Ý Kiến & Câu Hỏi</a>
            </li>
        </ul>
    </div>
</nav><br>
<div class="container">
   <!--  <div>
        <p>Xin Chào: <?php echo $_SESSION['dangnhap'] ?></p>
    </div> -->
    <div class="row">
        <?php
        if(isset($_GET['quanly']) && $_GET['quanly'] == 'capnhat'){
            $id_capnhat = $_GET['capnhat_id'];
            $sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_baiviet WHERE baiviet_id='$id_capnhat'");
            $row_capnhat = mysqli_fetch_array($sql_capnhat);
            $id_category_1 = $row_capnhat['danhmuctin_id']; //so sánh với danh mục của sản phẩm nếu bằng thì tự select vào form 
        ?>
        <div class="col-md-4">
            <h4>Cập Nhật Bài Viết</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <label>Tên Sản Phẩm</label>
                <input type="text" class="form-control" name="tenbaiviet" value="<?php echo $row_capnhat['tenbaiviet'] ?>"><br>
                <input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['baiviet_id'] ?>">
                <label>Hình Ảnh</label>
                <input type="file" class="form-control" name="hinhanh">
                <img src="../uploads/<?php echo $row_capnhat['baiviet_image']?>" height="80" width="80"><br>
                <label>Tóm Tắt</label>
                <textarea class="form-control" name="tomtat"><?php echo $row_capnhat['tomtat'] ?></textarea><br>
                <label>Nội Dung</label>
                <textarea class="form-control" name="noidung"><?php echo $row_capnhat['noidung'] ?></textarea><br>
                <label>Danh Mục</label>
                <?php
                $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_danhmuctin ORDER BY danhmuctin_id DESC");
                ?>
                <select class="form-control" name="danhmuc">
                    <option value="0">--------Chọn Danh Mục------------</option>
                    <?php
                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                        if($id_category_1 == $row_danhmuc['danhmuctin_id']){
                    ?>
                    <option selected value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                    <?php
                        } else {
                    ?>
                    <option value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select><br>
                <input type="submit" class="btn btn-default" name="capnhatbaiviet" value="Cập Nhật Bài Viết">
            </form>
        </div>
        <?php 
        } else {
        ?> 
        <div class="col-md-4">
            <h4>Thêm Bài Viết</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <label>Tên Bài Viết</label>
                <input type="text" class="form-control" name="tenbaiviet" placeholder="Tên Bài Viết"><br>
                <label>Hình Ảnh</label>
                <input type="file" class="form-control" name="hinhanh"><br>
                <label>Tóm Tắt</label>
                <textarea class="form-control" name="tomtat"></textarea><br>
                <label>Nội Dung</label>
                <textarea class="form-control" name="noidung"></textarea><br>
                <label>Danh Mục</label>
                <?php
                $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_danhmuctin ORDER BY danhmuctin_id DESC");
                ?>
                <select class="form-control" name="danhmuc">
                    <option value="0">--------Chọn Danh Mục------------</option>
                    <?php
                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                    ?>
                    <option value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                    <?php
                    }
                    ?>
                </select><br>
                <input type="submit" class="btn btn-default" name="thembaiviet" value="Thêm Bài Viết">
            </form>
        </div>
        <?php 
        }
        ?> 

        <div class="col-md-8">
            <h4>Liệt Kê Bài Viết</h4>
            <?php
            $sql_select_bv = mysqli_query($con,"SELECT * FROM tbl_baiviet, tbl_danhmuctin WHERE tbl_baiviet.danhmuctin_id=tbl_danhmuctin.danhmuctin_id ORDER BY tbl_baiviet.baiviet_id DESC");
            ?> 
            <table class="table table-bordered">
                <tr>
                    <td>Thứ Tự</td>
                    <td>Tên Bài Viết</td>
                    <td>Hình Ảnh</td>
                    <td>Danh Mục</td>
                    <td>Quản Lý</td>
                </tr>
                <?php
                $i = 0;
                while($row_bv = mysqli_fetch_array($sql_select_bv)){
                    $i++;
                ?> 
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_bv['tenbaiviet'] ?></td>
                    <td><img src="../uploads/<?php echo $row_bv['baiviet_image'] ?>" height="80" width="100"></td>
                    <td><?php echo $row_bv['tendanhmuc'] ?></td>
                    <td><a href="?xoa_sp=<?php echo $row_bv['baiviet_id'] ?>">Xóa</a><br><a href="xulybaiviet.php?quanly=capnhat&capnhat_id=<?php echo $row_bv['baiviet_id'] ?>">Cập Nhật</a></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
