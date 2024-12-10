<?php 
 include('../db/connect.php');
?>
<?php
  session_start();
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
<?php
  if(isset($_POST['dangky_admin'])){
     $email = $_POST['email'];
     $name = $_POST['name'];
     $password = md5($_POST['password']);
     $create = $_SESSION['dangnhap'];

     $sql_dangky_admin = mysqli_query($con,"INSERT INTO tbl_admin(email,password,admin_name,create_by) VALUES('$email','$password','$name','$create')");
  } 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset=utf-8>
    <title>Admin Dashboard </title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <style>
        .welcome-message {
            font-size: 1rem;
            font-weight: bold;
            color: #17a2b8;
            text-align: center;
            margin-top: 20px;
        }
        .logout-button {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .logout-button a {
            text-decoration: none;
        }
        .logout-button .btn {
            background-color: #343a40;
            border-color: #343a40;
        }
        .logout-button .btn .text-light {
            margin: 0;
            color: white;
        }
    </style>
  </head>
  <body>
    <!-- <h2 align="center">DASHBOARD ADMIN </h2>
    <p>Xin Chào: <?php echo $_SESSION['dangnhap'] ?></p>
    <button class="btn btn-dark"> <a href="?login=dangxuat"><p class="text-info">Đăng Xuất</p></a></button> -->
    <h2 align="center">DASHBOARD ADMIN</h2>
    <p class="welcome-message">Xin Chào: <?php echo $_SESSION['dangnhap'] ?></p>
    <div class="logout-button">
        <a href="?login=dangxuat">
            <button class="btn btn-dark">
                <p class="text-light">Đăng Xuất</p>
            </button>
        </a>
    </div>
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
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
              <li class="nav-item disabled">
                <a class="nav-link" href="#">Doanh Thu</a>
              </li>
            </ul>
          </div>
        </nav>

       <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Đăng Ký Admin</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="admin-name">Tên Admin:</label>
                                <input type="text" class="form-control" id="admin-name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" id="email" name="email" Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật Khẩu:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" name="dangky_admin" class="btn btn-primary btn-block">Đăng Ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
  </body>
</html>