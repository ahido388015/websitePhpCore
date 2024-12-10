<?php
     if(isset($_POST['themgiohang'])){
  	$sanpham_id = $_POST['sanpham_id'];
  	$tensanpham = $_POST['tensanpham'];
  	$giasanpham = $_POST['giasanpham'];
  	$hinhanh = $_POST['hinhanh'];
  	$soluong = $_POST['soluong'];
  
  	 $sql_select_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
  	 $count = mysqli_num_rows($sql_select_giohang);
  	 if($count>0){
  	 	$row_sanpham = mysqli_fetch_array($sql_select_giohang);
  	 	$soluong = $row_sanpham['soluong'] +1;
  	 	$sql_giohang = "UPDATE tbl_giohang SET soluong = '$soluong'WHERE sanpham_id='$sanpham_id'";
  	 }else{
  	 	$soluong = $soluong;
  	 	$sql_giohang = "INSERT INTO tbl_giohang(sanpham_id,sanpham_name,sanpham_gia,sanpham_image,soluong) values('$sanpham_id','$tensanpham','$giasanpham','$hinhanh','$soluong')";
  	 }
  	 $insert_row = mysqli_query($con,$sql_giohang);
  	if($insert_row==0){
  		header('Location:index.php?quanly=chitietsp&id='.$sanpham_id);
  	}
    }elseif(isset($_POST['capnhatgiohang'])){
  	  for($i=0;$i<count($_POST['product_id']);$i++){
  		$sanpham_id = $_POST['product_id'][$i];
  		$soluong = $_POST['soluong'][$i];
  		if($soluong<=0){
  			$sql_delete = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
  		}else{
  		   $sql_update = mysqli_query($con,"UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'");	
  		}
  	  }
    }elseif(isset($_GET['xoa'])){
  	  $id = $_GET['xoa'];
  	  $sql_delete = mysqli_query($con,"DELETE FROM tbl_giohang WHERE giohang_id='$id'");
    }elseif(isset($_GET['dangxuat'])){
      $id = $_GET['dangxuat'];
      if($id==1){
      	unset($_SESSION['dangnhap_home']);
      }
    }elseif(isset($_POST['thanhtoan'])){
       $name = $_POST['name'];
       $phone = $_POST['phone'];
       $address = $_POST['address'];
       $note = $_POST['note'];
       $email = $_POST['email'];
       $password = md5($_POST['password']);
       $giaohang = $_POST['giaohang'];

       $sql_khachhang = mysqli_query($con,"INSERT INTO tbl_khachhang(name,phone,address,note,email,giaohang,password) values('$name','$phone','$address','$note','$email','$giaohang','$password')");
       if($sql_khachhang){
       	$sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
       	$mahang = rand(0,99999);
       	$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
        $khachhang_id = $row_khachhang['khachhang_id'];
        $_SESSION['dangnhap_home'] = $row_khachhang['name'];
        $_SESSION['khachhang_id'] = $khachhang_id;
        for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
  		    $sanpham_id = $_POST['thanhtoan_product_id'][$i];
  		    $soluong = $_POST['thanhtoan_soluong'][$i];
  		    $sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,soluong,mahang,khachhang_id) values('$sanpham_id','$soluong','$mahang','$khachhang_id')");
  		    $sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values('$sanpham_id','$soluong','$mahang','$khachhang_id')");
  		    $sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
  	    }
       }
    }
    elseif(isset($_POST['thanhtoandangnhap'])){
    	$khachhang_id = $_SESSION['khachhang_id'];
       	$mahang = rand(0,99999);
        for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
  		    $sanpham_id = $_POST['thanhtoan_product_id'][$i];
  		    $soluong = $_POST['thanhtoan_soluong'][$i];
  		    $sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,soluong,mahang,khachhang_id) values('$sanpham_id','$soluong','$mahang','$khachhang_id')");
  		    $sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values('$sanpham_id','$soluong','$mahang','$khachhang_id')");
  		    $sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
        }
    }
 ?>
	<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>G</span>iỏ
				<span>H</span>àng
			</h3>
			<?php
			  if(isset($_SESSION['dangnhap_home'])){
			  	echo '<p style="color:#000;"> Giỏ Hàng Của: '.$_SESSION['dangnhap_home'].' <a href="index.php?quanly=giohang&dangxuat=1">Đăng Xuất </a><br></p>';
			  }
			?>
			<!-- //tittle heading -->
			<div class="checkout-right">
				
				<?php
                 $sql_lay_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
				?>
				<div class="table-responsive">
					<form action="" method="POST">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th style="width:50px">Thứ Tự </th>
								<th style="width:280px">Sản Phẩm </th>
								<th style="width:100px">Số Lượng </th>
								<th style="width:200px">Tên Sản Phẩm </th>
								<th style="width:150px">Giá </th>
								<th>Tổng  </th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i = 0;
						$total =0;
                         while($row_fetch_giohang = mysqli_fetch_array($sql_lay_giohang)){
                         	$subtotal = $row_fetch_giohang['soluong'] * $row_fetch_giohang['sanpham_gia'];
                         	$total += $subtotal;
                         	$i++;
						?>
							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<td class="invert-image">
									<a href="single.html">
										<img src="images/<?php echo $row_fetch_giohang['sanpham_image']?>" alt=" " class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<input type="number" min="1" name="soluong[]" value="<?php echo $row_fetch_giohang['soluong']?>">
									<input type="hidden"  name="product_id[]" value="<?php echo $row_fetch_giohang['sanpham_id']?>">
								</td>
								<td class="invert"><?php echo $row_fetch_giohang['sanpham_name']?></td>
								<td class="invert"><?php echo number_format($row_fetch_giohang['sanpham_gia'])?></td>
								<td class="invert"><?php echo number_format($subtotal)?></td>
								<td class="invert">
									<a href="?quanly=giohang&xoa=<?php echo $row_fetch_giohang['giohang_id']?>">Xóa</a>
								</td>
							</tr>
							<?php
						    }
						    ?>
						    <tr>
						    	<td colspan="7 ">Tổng Tiền: <?php echo number_format($total)?></td>
						    </tr>	
						    <tr>
						    	<td colspan="7"><input type="submit" class="btn btn-success" value="Cập Nhật Giỏ Hàng" name="capnhatgiohang">
                                 <?php
                                  $sql_giohang_select = mysqli_query($con,"SELECT * FROM tbl_giohang");
                                  $count_giohang = mysqli_num_rows($sql_giohang_select);
                                  if(isset($_SESSION['dangnhap_home']) && $count_giohang>0){
                                  	while($row_1 = mysqli_fetch_array($sql_giohang_select)){
                                 ?>
	                                <input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong']?>">
									<input type="hidden"  name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id']?>">
								<?php
								  }
								?>
						    	<input type="submit" name="thanhtoandangnhap" class="btn btn-primary" value="Thanh Toán Giỏ Hàng">
						    	<?php
						    	  }
						    	?>
						        </td>
						    </tr>
						</tbody>
					</table>
				    </form>
				</div>
			</div>
			<?php
			  if(!isset($_SESSION['dangnhap_home'])){
			?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm Chi Tiết Giao Hàng </h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Nhập Tên " required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Số Điện Thoại " name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Địa Chỉ " name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Email" name="email" required="">
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Password" name="password" required="">
									</div>
									<div class="controls form-group">
										<textarea class="form-control" placeholder="Ghi Chú " name="note" required="" ></textarea>
									</div>
									<div class="controls form-group">
										<select class="option-w3ls" name="giaohang">
											<option>Phương Thức Thanh Toán </option>
											<option value="0">COD (thanh toán khi nhận hàng</option>
											<option value="1">ATM</option>
										</select>
									</div>
								</div>
								<?php
                                  $sql_lay_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
                                  while($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)){
								?>
								   <input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong']?>">
									<input type="hidden"  name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id']?>">
								<?php
							    }
							    ?>
								<input type="submit" name="thanhtoan" class="btn btn-success" value="Đặt Hàng" style="width:200px"> 
							</div>
						</div>
					</form>
					
				</div>
			</div>
			<?php
		     }
			?>
			<div class="checkout-right-basket">
				<a href="index.php">Quay Lại Trang Chủ 
					<span class="far fa-hand-point-right"></span>
				</a>
	       </div>
		</div>
	</div>
	<!-- //checkout page -->
	