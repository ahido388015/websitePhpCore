<?php 
 include('../db/connect.php');
?>
<?php
   session_start();
  if(isset($_POST['themsanpham'])){
    $tensanpham  = $_POST['tensanpham'];
    $hinhanh   = $_FILES['hinhanh']['name'];
    $giasanpham  = $_POST['giasanpham'];
    $giakhuyenmai  = $_POST['giakhuyenmai'];
    $soluong  = $_POST['soluong'];
    $mota  = $_POST['mota'];
    $danhmuc  = $_POST['danhmuc'];
    $chitiet  = $_POST['chitiet'];

    $path = '../uploads/';
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $sql_insert_product = mysqli_query($con,"INSERT INTO tbl_sampham(sanpham_name,sanpham_gia,sanpham_giakhuyenmai,sanpham_image,sanpham_soluong,sanpham_mota,sanpham_chitiet,category_id) values('$tensanpham','$giasanpham','$giakhuyenmai','$hinhanh','$soluong','$mota','$chitiet','$danhmuc')");
    move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
  }
  elseif(isset($_POST['capnhatsanpham'])){
      $id_update = $_POST['id_update'];
      $tensanpham = $_POST['tensanpham'];
      $hinhanh   = $_FILES['hinhanh']['name'];
      $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
      $soluong = $_POST['soluong'];
      $giasanpham = $_POST['giasanpham'];
      $giakhuyenmai = $_POST['giakhuyenmai'];
      $mota = $_POST['mota'];
      $chitiet = $_POST['chitiet'];
      $danhmuc = $_POST['danhmuc'];
      $path = '../uploads/';
      if($hinhanh!=''){
        $sql_update_image ="UPDATE tbl_sampham SET sanpham_name='$tensanpham',sanpham_gia='$giasanpham',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_image='$hinhanh',sanpham_soluong='$soluong',sanpham_mota='$mota',sanpham_chitiet='$chitiet',category_id='$danhmuc' WHERE sanpham_id='$id_update' ";
      }else{
        move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
        $sql_update_image ="UPDATE tbl_sampham SET sanpham_name='$tensanpham',sanpham_gia='$giasanpham',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_image='$hinhanh',sanpham_soluong='$soluong',sanpham_mota='$mota',sanpham_chitiet='$chitiet',category_id='$danhmuc' WHERE sanpham_id='$id_update' ";
      }
      mysqli_query($con,$sql_update_image);
  }
?>
<?php
  if(isset($_GET['xoa_sp'])){
    $id_xoa = $_GET['xoa_sp'];
    $sql_xoa_sp = mysqli_query($con,"DELETE FROM tbl_sampham WHERE sanpham_id='$id_xoa'");
  }
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
    <meta charset=utf-8>
    <title>Admin Sản Phẩm </title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  </head>
  <body>
    <p>Xin Chào: <?php echo $_SESSION['dangnhap'] ?></p>
    <button> <a href="?login=dangxuat"> Đăng Xuất </a> </button>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item ">
                <a class="nav-link" href="xulydonhang.php">Đơn Hàng <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="xulydanhmuc.php">Danh Mục </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="xulydanhmucbaiviet.php">DM_Bài Viết</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="xulybaiviet.php">Bài Viết</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="xulysanpham.php">Sản Phẩm </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="xulykhachhang.php">Khách Hàng </a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="xulycauhoi.php">Ý Kiến & Câu Hỏi</a>
              </li>
            </ul>
          </div>
        </nav><br>
    <div class="container">
      <div>
        <p> Xin Chào: <?php echo $_SESSION['dangnhap'] ?></p>
      </div>
      <div class="row">
         <?php
          if(isset($_GET['quanly'])=='capnhat'){
            $id_capnhat = $_GET['capnhat_id'];
            $sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_sampham WHERE sanpham_id='$id_capnhat'");
            $row_capnhat = mysqli_fetch_array($sql_capnhat);
            $id_category_1 = $row_capnhat['category_id']; //so sánh với danh mục của sản phẩm nếu bằng thì tự select vào form 
         ?>
         <div class="col-md-4">
             <h4>Cập Nhật Sản Phẩm </h4>
             <form action="" method="POST" enctype = "multipart/form-data">
               <label>Tên Sản Phẩm </label>
               <input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['sanpham_name'] ?>"><br>
               <input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['sanpham_id' ] ?>">
               <label>Hình Ảnh</label>
               <input type="file" class="form-control" name="hinhanh">
               <img src="../uploads/<?php echo $row_capnhat['sanpham_image']?>" heigth="80" width="80"><br>
               <labeL>Giá </labeL>
               <input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['sanpham_gia'] ?>"><br>
               <labeL>Giá Khuyến Mãi</labeL>
               <input type="text" class="form-control" name="giakhuyenmai" value="<?php echo $row_capnhat['sanpham_giakhuyenmai'] ?>"><br>
               <labeL>Số Lượng</labeL>
               <input type="text" class="form-control" name="soluong"  value="<?php echo $row_capnhat['sanpham_soluong'] ?>"><br>
               <labeL>Mô Tả </labeL>
               <textarea rols="10" class="form-control" name="mota" value="<?php echo $row_capnhat['sanpham_mota'] ?>"></textarea><br>
               <labeL>Chi Tiết </labeL>
               <textarea class="form-control" name="chitiet" value="<?php echo $row_capnhat['sanpham_mota']?>"></textarea><br>
               <labeL>Danh Mục </labeL>
               <?php
                 $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC");
               ?>
               <select class="form-control" name="danhmuc">
                    <option value="0">--------Chọn Danh Mục------------</option>
                    <?php
                      while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                       if($id_category_1==$row_danhmuc['category_id']){
                    ?>
                    <option selected value="<?php echo $row_danhmuc['category_id'] ?> "><?php echo $row_danhmuc['category_name'] ?> </option>
                    <?php
                     }else{
                    ?>
                    <option  value="<?php echo $row_danhmuc['category_id'] ?> "><?php echo $row_danhmuc['category_name'] ?> </option>
                    <?php
                     }
                     }
                    ?>
               </select><br>
               <input type="submit" class="btn btn-default" name="capnhatsanpham" value="Cập Nhật Sản Phẩm">
             </form>
           </div>
         
         <?php 
         }else{
          ?> 
           <div class="col-md-4">
             <h4>Thêm Sản Phẩm </h4>
             <form action="" method="POST" enctype = "multipart/form-data">
               <label>Tên Sản Phẩm </label>
               <input type="text" class="form-control" name="tensanpham" placeholder="Tên Sản Phẩm"><br>
               <label>Hình Ảnh</label>
               <input type="file" class="form-control" name="hinhanh"><br>
               <labeL>Giá </labeL>
               <input type="text" class="form-control" name="giasanpham" placeholder="Giá Sản Phẩm"><br>
               <labeL>Giá Khuyến Mãi</labeL>
               <input type="text" class="form-control" name="giakhuyenmai" placeholder="Giá Khuyến Mãi"><br>
               <labeL>Số Lượng</labeL>
               <input type="text" class="form-control" name="soluong" placeholder="Số Lượng"><br>
               <labeL>Mô Tả </labeL>
               <textarea class="form-control" name="mota"></textarea><br>
               <labeL>Chi Tiết </labeL>
               <textarea class="form-control" name="chitiet"></textarea><br>
               <labeL>Danh Mục </labeL>
               <?php
                 $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC");
               ?>
               <select class="form-control" name="danhmuc">
                    <option value="0">--------Chọn Danh Mục------------</option>
                    <?php
                      while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                    ?>
                    <option value="<?php echo $row_danhmuc['category_id'] ?> "><?php echo $row_danhmuc['category_name'] ?> </option>
                    <?php
                     }
                    ?>
               </select><br>
               <input type="submit" class="btn btn-default" name="themsanpham" value="Thêm Sản Phẩm">
             </form>
           </div>
          <?php 
          }
         ?> 
       
       <div class="col-md-8">
         <h4>Liệt Kê Sản Phẩm </h4>
        <?php
          $sql_select_sp = mysqli_query($con,"SELECT * FROM tbl_sampham, tbl_category WHERE tbl_sampham.category_id=tbl_category.category_id ORDER BY tbl_sampham.sanpham_id DESC");
         ?> 
            <table class="table table-bordered ">
              <tr>
                <td>Thứ Tự </td>
                <td>Tên Sản Phẩm</td>
                <td>Hình Ảnh</td>
                <td>Số Lượng</td>
                <td>Danh Mục</td>
                <td>Giá Sản Phẩm</td>
                <td>Giá Khuyến Mãi</td>
                <td>Quản Lý</td>
              </tr>
             <?php
               $i = 0;
               while($row_sp = mysqli_fetch_array($sql_select_sp)){
                 $i++;
              ?> 
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row_sp['sanpham_name'] ?></td>
                <td> <img src="../uploads/<?php echo $row_sp['sanpham_image'] ?>"height="80" width="100"></td>
                <td><?php echo $row_sp['sanpham_soluong'] ?></td>
                <td><?php echo $row_sp['category_name'] ?>  </td>
                <td><?php echo number_format($row_sp['sanpham_gia']).'vnd' ?></td>
                <td><?php echo number_format($row_sp['sanpham_giakhuyenmai']).'vnd' ?> </td>
                <td><a href="?xoa_sp=<?php echo $row_sp['sanpham_id'] ?>">Xóa</a><br><a href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sp['sanpham_id'] ?>">Cập Nhật </a></td>
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