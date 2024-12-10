<?php
  if(isset($_GET['id_tin'])){
    $id_danhmuc = $_GET['id_tin'];
  }else{
    $id_danhmuc = '';
  }
?>
<!-- page -->
<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="index.php">Trang Chủ</a>
                    <i>|</i>
                </li>
                <?php
                  if (!empty($id_danhmuc)) {
                      $sql_tendanhmuc = mysqli_query($con,"SELECT * FROM tbl_danhmuctin WHERE danhmuctin_id='$id_danhmuc'");
                      if ($sql_tendanhmuc && mysqli_num_rows($sql_tendanhmuc) > 0) {
                          $row_ten = mysqli_fetch_array($sql_tendanhmuc);
                          echo '<li>' . htmlspecialchars($row_ten['tendanhmuc']) . '</li>';
                      } else {
                          echo '<li>Danh mục không tồn tại</li>';
                      }
                  } else {
                      echo '<li>Danh mục không được chọn</li>';
                  }
                ?>
            </ul>
        </div>
    </div>
</div>
<!-- //page -->

<!-- about -->
<div class="welcome py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <span>D</span>anh
            <span>M</span>ục
            <span>T</span>in
        </h3>
        <!-- //tittle heading -->
        <?php
         $sql_baiviet = mysqli_query($con,"SELECT * FROM tbl_danhmuctin,tbl_baiviet WHERE tbl_danhmuctin.danhmuctin_id=tbl_baiviet.danhmuctin_id AND tbl_danhmuctin.danhmuctin_id='$id_danhmuc'");
         while($row_baiviet = mysqli_fetch_array($sql_baiviet)){
        ?>
        <div class="row">    
            <div class="col-lg-4 welcome-right-top mt-lg-0 mt-sm-5 mt-4">
                <img src="images/<?php echo $row_baiviet['baiviet_image'] ?>" class="img-fluid" alt=" ">
            </div>
            <div class="col-lg-8 welcome-left">
               <h5> <a href="index.php?quanly=chitiettin&id_tin=<?php echo $row_baiviet['baiviet_id'] ?>"> <?php echo $row_baiviet['tenbaiviet'] ?></a></h5>
               <h4 class="my-sm-3 my-2"><?php echo $row_baiviet['tomtat'] ?></h4>
            </div>
        </div>
        <?php
          }
        ?>
    </div>
</div>
<!-- //about -->
