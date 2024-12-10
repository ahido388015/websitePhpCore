<?php
session_start();
include('../db/connect.php');
?>
<?php
   // session_destroy();
   if(isset($_POST['dangnhap'])){
     $taikhoan = $_POST['taikhoan'];
     $matkhau = md5($_POST['matkhau']);
        if($taikhoan =='' || $matkhau ==''){
            echo '<p>Xin Nhập Đủ Tài Khoản và Mật Khẩu</p>';
        }else{
           $sql_select_admin = mysqli_query($con,"SELECT * FROM tbl_admin WHERE email='$taikhoan' AND password='$matkhau' LIMIT 1");
           $count = mysqli_num_rows($sql_select_admin);
           $row_dangnhap = mysqli_fetch_array($sql_select_admin);
           if($count>0){
                 $_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
                 $_SESSION['admin_id'] = $row_dangnhap['admin_id'];
                 header('Location: dashboard.php');
           }else{
                echo '<p>Email hoặc Mật Khẩu nhập sai, Vui lòng nhập lại</p>';
           }
        }
    }
?>
<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset=utf-8>
    <title>Đăng Nhập Admin</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  </head>
  <body>
    <h2 align="center">Đăng Nhập Admin</h2>
    <div class="col-md-6">
       <div class="form-group">
    	  <form action="" method="POST">
    	  	<label>Tài Khoản </label>
    	  	<input type="text" name="taikhoan" placeholder="Nhập email" class="form-control"><br>
    	  	<label>Mật Khẩu </label>
    	  	<input type="text" name="matkhau" placeholder="Nhập mật khẩu " class="form-control"><br>
    	  	<input type="submit" name="dangnhap" class="btn btn-primary" value="Đăng Nhập">
    	  </form>
       </div>
    </div>
  </body>
</html> -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset=utf-8>
    <title>Đăng Nhập Admin</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  </head>
  <body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="col-md-6 col-lg-4">
      <h2 class="text-center">Đăng Nhập Admin</h2>
      <div class="form-group">
        <form action="" method="POST">
          <label>Tài Khoản </label>
          <input type="text" name="taikhoan" placeholder="Nhập email" class="form-control"><br>
          <label>Mật Khẩu </label>
          <input type="password" name="matkhau" placeholder="Nhập mật khẩu " class="form-control"><br>
          <input type="submit" name="dangnhap" class="btn btn-primary btn-block" value="Đăng Nhập">
        </form>
      </div>
    </div>
  </body>
</html>
