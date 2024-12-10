<?php 
 include('../db/connect.php');
?> 
<?php
  session_start();
?> 
<?php
  if(isset($_POST['capnhatdonhang'])){
    $xuly = $_POST['xuly'];
    $mahang = $_POST['mahang_xuly'];
    $sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE mahang='$mahang'");
    $sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET tinhtrangdon='$xuly' WHERE magiaodich='$mahang'");
  } 
?>
<?php
  if(isset($_GET['xoadonhang'])){
    $mahang = $_GET['xoadonhang'];
    $sql_delete = mysqli_query($con,"DELETE FROM tbl_donhang WHERE mahang='$mahang'");
    header("Location:xulydonhang.php");
  }
  if(isset($_GET['xacnhanhuy'])&&isset($_GET['mahang'])){
    $huydon = $_GET['xacnhanhuy'];
    $magiaodich = $_GET['mahang'];
  }else{
    $huydon = '';
    $magiaodich = '';
  }
  $sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$magiaodich'");
  $sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");
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
    <title>Admin Đơn Hàng </title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  </head>
  <body>
    <p>Xin Chào: <?php echo $_SESSION['dangnhap'] ?></p>
    <button> <a href="?login=dangxuat"> Đăng Xuất </a> </button>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
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
              <li class="nav-item">
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
          if(isset($_GET['quanly'])=='xemdonhang'){
            $mahang = $_GET['mahang'];
            $sql_chitiet = mysqli_query($con,"SELECT * FROM tbl_donhang,tbl_sampham WHERE tbl_donhang.sanpham_id=tbl_sampham.sanpham_id AND tbl_donhang.mahang='$mahang'");
         ?>
         <div class="col-md-7">
           <p>Xem Chi Tiêt Đơn Hàng </p>
           <form action="" method="POST">
            <table class="table table-bordered ">
              <tr>
                <td>Thứ Tự </td>
                <td>Mã Hàng </td>
                <td>Tên Sản Phẩm </td>
                <td> Số Lượng </td>
                <td> Giá </td>
                <td> Tổng Tiền </td>
                <td>Ngày Đặt</td>
                
              </tr>
              <?php
               $i = 0;
               while($row_donhang = mysqli_fetch_array($sql_chitiet)){
                 $i++;
              ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row_donhang['mahang'] ?></td>
                <td><?php echo $row_donhang['sanpham_name']; ?></td>
                <td><?php echo $row_donhang['soluong'] ?></td>
                 <td><?php echo number_format($row_donhang['sanpham_giakhuyenmai']).'vnd' ?></td>
                <td><?php echo number_format($row_donhang['soluong']*$row_donhang['sanpham_giakhuyenmai']).'vnd' ?></td>
                <td><?php echo $row_donhang['ngaythang'] ?> </td>
                <input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang'] ?>">
               
              </tr>
              <?php
               }
              ?>
            </table>

            <select class="form-control" name="xuly">
              <option value="1">Đã Xử Lý </option>
              <option value="0">Chưa Xử Lý </option>
            </select>
            <br>
            <input type="submit" name="capnhatdonhang" class="btn btn-success" value="Cập Nhật Đơn Hàng">
          </form>
         </div>

         <?php 
         }else{
          ?> 
           <div class="col-md-7">
             <p>Đơn Hàng </p>
           </div>
         <?php 
          }
        ?>
      
       <div class="col-md-5">
         <h4>Liệt Kê Đơn Hàng</h4>
         <?php
          $sql_select = mysqli_query($con,"SELECT * FROM tbl_sampham,tbl_khachhang,tbl_donhang WHERE tbl_donhang.sanpham_id=tbl_sampham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id GROUP BY mahang ORDER BY tbl_donhang.ngaythang DESC");
         ?>
            <table class="table table-bordered ">
              <tr>
                <td>Thứ Tự </td>
                <td>Mã Hàng </td>
                <td>Tình Trạng </td>
                <td>Tên Khách Hàng</td>
                <td>Ngày Đặt</td>
                <td>Ghi Chú</td>
                <td>Hủy Đơn</td>
                <td>Quản Lý</td>
              </tr>
              <?php
               $i = 0;
               while($row_donhang = mysqli_fetch_array($sql_select)){
                 $i++;
              ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row_donhang['mahang'] ?></td>
                <td><?php
                    if($row_donhang['tinhtrang']==0){
                      echo 'Chưa Xử Lý';
                    }else{
                      echo 'Đã Xử Lý';
                    }
                   ?>
                </td>
                <td><?php echo $row_donhang['name']; ?></td>
                <td><?php echo $row_donhang['ngaythang'] ?> </td>
                 <td><?php echo $row_donhang['note'] ?> </td>
                 <td><?php if($row_donhang['huydon']==0){ 
                      echo ' ';
                    }elseif($row_donhang['huydon']==1){
                      echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='.$row_donhang['mahang'].'&xacnhanhuy=2">Xác nhận hủy</a>';
                    }else{
                      echo 'Đã Hủy';
                    }
                 ?></td>
                <td> <a href="?xoadonhang=<?php echo $row_donhang['mahang']?>">Xóa</a>|<a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang']?>">Xem</a> </td>
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