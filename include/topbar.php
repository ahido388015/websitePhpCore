<?php
 if(isset($_POST['dangnhap_home'])){
     $taikhoan = $_POST['email_login'];
     $matkhau = md5($_POST['password_login']);
        if($taikhoan =='' || $matkhau ==''){
           echo '<script>alert("Bạn nhập thiếu email hoặc mật khẩu")</script>';
        }else{
           $sql_select_admin = mysqli_query($con,"SELECT * FROM tbl_khachhang WHERE email='$taikhoan' AND password='$matkhau' LIMIT 1");
           $count = mysqli_num_rows($sql_select_admin);
           $row_dangnhap = mysqli_fetch_array($sql_select_admin);
           if($count>0){
                 $_SESSION['dangnhap_home'] = $row_dangnhap['name'];
                 $_SESSION['khachhang_id'] = $row_dangnhap['khachhang_id'];
                 $_SESSION['khachhang_name'] = $row_dangnhap['name'];
                 header('Location: index.php?quanly=giohang');
           }else{
               echo '<script>alert("Email hoặc mật khẩu bị sai. Vui lòng nhập lại")</script>'; 
           }
        }
    }elseif(isset($_POST['dangky'])){
       $name = $_POST['name'];
       $phone = $_POST['phone'];
       $address = $_POST['address'];
       $note = $_POST['note'];
       $email = $_POST['email'];
       $password = md5($_POST['password']);
       $giaohang = $_POST['giaohang'];

       $sql_khachhang = mysqli_query($con,"INSERT INTO tbl_khachhang(name,phone,address,note,email,giaohang,password) values('$name','$phone','$address','$note','$email','$giaohang','$password')");
       $sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
       $row_dangnhap_khachhang = mysqli_fetch_array($sql_select_khachhang);
       $_SESSION['dangnhap_home'] = $name;
       $_SESSION['khachhang_id'] = $row_dangnhap_khachhang['khachhang_id'];
       $_SESSION['khachhang_name'] = $row_dangnhap['name'];
       header("Location:index.php?quanly=giohang");
    } 
?>
<div class="agile-main-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-2">
				<div class="col-lg-4 header-most-top">
					<p class="text-white text-lg-left text-center">Hot Sale mở bán ngày 20/9
						<i class="fas fa-shopping-cart ml-1"></i>
					</p>
				</div>
				<div class="col-lg-8 header-right mt-lg-0 mt-2">
					<!-- header lists -->
					<ul>
						<li class="text-center border-right text-white">
							<a class="play-icon popup-with-zoom-anim text-white" href="#small-dialog1">
								<i class="fas fa-map-marker mr-2"></i>Chọn vị trí của bạn</a>
						</li>
						<?php
						  if(isset($_SESSION['dangnhap_home'])){  // nếu tông tại session đn home thì mới hiển thị 
						?>
						<!-- <li class="text-center border-right text-white">
							<a href="index.php?quanly=xemdonhang" data-target="#exampleModal" class="text-white">
								<i class="fas fa-truck mr-2"></i><?php echo $_SESSION['dangnhap_home'] ?> </a>
						</li> -->
						<li class="text-center border-right text-white">
						    <a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>" data-target="#exampleModal" class="text-white">
						        <i class="fas fa-truck mr-2"></i>Đơn Hàng: 
						        <?php
						        $full_name = $_SESSION['dangnhap_home'];						       
						        $name_parts = explode(' ', $full_name); // Tách tên theo khoảng trắng						        
						        array_shift($name_parts);// Bỏ phần tử đầu tiên của mảng
						        $short_name = implode(' ', $name_parts);	 // Ghép lại các phần tử còn lại thành chuỗi			  
						        echo $short_name; // Echo tên rút gọn
						        ?>
						    </a>
						</li>

						<?php
						 }
						?>
						<li class="text-center border-right text-white">
							<i class="fas fa-phone mr-2"></i> 0795517772
						</li>
						<li class="text-center border-right text-white">
							<a href="#" data-toggle="modal" data-target="#dangnhap" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Đăng Nhập </a>
						</li>
						<li class="text-center text-white">
							<a href="#" data-toggle="modal" data-target="#dangky" class="text-white">
								<i class="fas fa-sign-out-alt mr-2"></i> Đăng ký  </a>
						</li>
					</ul>
					<!-- //header lists -->
				</div>
			</div>
		</div>
	</div>

	<!-- Button trigger modal(select-location) -->
	<div id="small-dialog1" class="mfp-hide">
		<div class="select-city">
			<h3>
				<i class="fas fa-map-marker"></i> Xin vui lòng chọn vị trí của bạn</h3>
			<select class="list_of_cities">
				<optgroup label="Popular Cities">
					<option selected style="display:none;color:#eee;">Chọn Tỉnh thành</option>
					<option>Hà Nội</option>
					<option>Hải Phòng </option>
					<option>Huế </option>
					<option>Đà Nẵng </option>
					<option>TP.HCM</option>
					<option>Cần Thơ</option>
				</optgroup>
				
				
			</select>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- //shop locator (popup) -->

	<!-- log in -->
	<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng Nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="text" class="form-control" placeholder=" " name="email_login" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật Khẩu </label>
							<input type="password" class="form-control" placeholder=" " name="password_login" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng nhập" name="dangnhap_home">
						</div>
						<div class="sub-w3l">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
								<label class="custom-control-label" for="customControlAutosizing">Ghi Đăng Nhập </label>
							</div>
						</div>
						<p class="text-center dont-do mt-3">Bạn Chưa Có Tài Khoản ?
							<a href="#" data-toggle="modal" data-target="#dangky">
								Đăng Kí Ngay </a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- register -->
	<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng Ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-form-label">Tên Khách Hàng </label>
							<input type="text" class="form-control" placeholder=" " name="name" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Số Điện Thoại </label>
							<input type="text" class="form-control" placeholder=" " name="phone" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Địa Chỉ  </label>
							<input type="text" class="form-control" placeholder=" " name="address" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật Khẩu </label>
							<input type="password" class="form-control" placeholder=" " name="password" id="password1" required="">
							<input type="hidden" class="form-control" value="0 " name="giaohang">
						</div>
						<div class="form-group">
							<label class="col-form-label">Ghi Chú </label>
							<textarea class="form-control" name="note"></textarea>
						</div>
						<!-- <div class="form-group">
							<label class="col-form-label">Confirm Password</label>
							<input type="password" class="form-control" placeholder=" " name="Confirm Password" id="password2" required="">
						</div> -->
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng Ký " name="dangky">
						</div>
						<!-- <div class="sub-w3l">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="customControlAutosizing2">
								<label class="custom-control-label" for="customControlAutosizing2">I Accept to the Terms & Conditions</label>
							</div>
						</div> -->
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->
	<!-- header-bottom-->
	<div class="header-bot">
		<div class="container">
			<div class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
					<h1 class="text-center">
						<a href="index.php" class="font-weight-bold font-italic">
							<!-- <img src="images/logo2.png" alt=" " class="img-fluid">AHI-STORE -->
							<img src="images/logo_ahi3.png" alt=" ">Ahi_do__
						</a>
					</h1>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row">
						<!-- search -->
						<div class="col-10 agileits_search">
							<form class="form-inline" action="index.php?quanly=timkiem" method="post">
								<input class="form-control mr-sm-2" type="search" name="search_product" placeholder="Nhập tên sản phẩm " aria-label="Search" required>
								<button class="btn btn-warning my-2 my-sm-0" name="search_button" type="submit">Tìm kiếm </button>
							</form>
						</div>
						<!-- //search -->
						<!-- cart details -->
						<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1">
								<form action="#" method="post" class="last">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="display" value="1">
									<button class="btn w3view-cart" type="submit" name="submit" value="">
										<i class="fas fa-cart-arrow-down"><a href="giohang.php"></a></i>
									</button>
								</form>
							</div>
						</div>
						<!-- //cart details -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- shop locator (popup) -->
	<!-- //header-bottom -->
	<!-- navigation -->