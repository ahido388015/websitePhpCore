<?php 
 include('../db/connect.php');
?>
<?php
  session_start();
  if(isset($_POST['themdanhmuc'])){
    $tendanhmuc  = $_POST['danhmuc'];
    $sql_insert = mysqli_query($con,"INSERT INTO tbl_danhmuctin(tendanhmuc) values ('$tendanhmuc')");
  }elseif(isset($_POST['capnhatdanhmuc'])){
    $id_post = $_POST['id_danhmuc'];
    $tendanhmuc  = $_POST['danhmuc'];
    $sql_update  = mysqli_query($con,"UPDATE tbl_danhmuctin SET tendanhmuc='$tendanhmuc'WHERE danhmuctin_id='$id_post'"); 
    header('Location:xulydanhmucbaiviet.php');
  }
  if(isset($_GET['xoa'])){
    $id = $_GET['xoa'];
    $sql_xoa = mysqli_query($con,"DELETE FROM tbl_danhmuctin WHERE danhmuctin_id='$id'");
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
    <title>Admin Danh Mục Bài Viết </title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  </head>
  <body>
    <p>Xin Chào: <?php echo $_SESSION['dangnhap'] ?></p>
    <button> <a href="?login=dangxuat"> Đăng Xuất </a> </button>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="xulydonhang.php">Đơn Hàng <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="xulydanhmuc.php">Danh Mục </a>
              </li>
              <li class="nav-item active">
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
          if(isset($_GET['quanly'])=='capnhat'){
            $id_capnhat = $_GET['id'];
            $sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_danhmuctin WHERE danhmuctin_id='$id_capnhat'");
            $row_capnhat = mysqli_fetch_array($sql_capnhat);
        ?>
         <div class="col-md-4">
           <h4>Cập Nhật Danh Mục</h4>
           <label>Tên Danh Mục</label>
           <form action="" method="POST">
             <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['tendanhmuc']?>"><br>
             <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['danhmuctin_id']?>">
             <input type="submit" class="btn btn-default" name="capnhatdanhmuc" value="Cập Nhật Danh Mục">
          </form>
         </div>
         <?php 
         }else{
          ?>
           <div class="col-md-4">
             <h4>Thêm Danh Mục</h4>
             <label>Tên Danh Mục</label>
             <form action="" method="POST">
               <input type="text" class="form-control" name="danhmuc" placeholder="Nhập tên danh mục mới"><br>
               <input type="submit" class="btn btn-default" name="themdanhmuc" value="Thêm Danh Mục">
             </form>
           </div>
         <?php 
          }
        ?>
      
       <div class="col-md-8">
         <h4>Liệt Kê Danh Mục</h4>
         <?php
          $sql_select = mysqli_query($con,"SELECT * FROM tbl_danhmuctin ORDER BY danhmuctin_id DESC");
         ?>
            <table class="table table-bordered ">
              <tr>
                <td>Thứ Tự </td>
                <td>Tên Danh Mục </td>
                <td>Quản Lý</td>
              </tr>
              <?php
               $i = 0;
               while($row_category = mysqli_fetch_array($sql_select)){
                 $i++;
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row_category['tendanhmuc'] ?> </td>
                <td> <a href="?xoa=<?php echo $row_category['danhmuctin_id']?>">Xóa </a> || <a href="?quanly=capnhat&id=<?php echo $row_category['danhmuctin_id']?>">Cập Nhật </a> </td>
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