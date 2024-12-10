<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>S</span>ản
				<span>P</span>hẩm
				<span>M</span>ới</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<?php 
						  $sql_cate_home = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY category_id ASC ");
						  while($row_cate_home = mysqli_fetch_array($sql_cate_home)){
                               $id_category = $row_cate_home['category_id'];
						?>
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic">
								<?php echo $row_cate_home['category_name']?>
							</h3>
							<div class="row">
								<?php
								 $sql_product = mysqli_query($con,"SELECT * FROM tbl_sampham ORDER BY sanpham_id ASC");
								 while($row_sanpham  = mysqli_fetch_array($sql_product)){
								 	if($row_sanpham['category_id']==$id_category){
								?>
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="images/<?php echo $row_sanpham['sanpham_image'] ?>" alt="">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id']?>" class="link-product-add-cart">Xem Chi Tiêt</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id']?>"><?php echo $row_sanpham['sanpham_name'] ?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price"><?php echo number_format($row_sanpham['sanpham_giakhuyenmai']).'vnd' ?></span>
												<br>
												<del><?php echo number_format($row_sanpham['sanpham_gia']).'vnd' ?></del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
												<form action="?quanly=giohang" method="post">
								                  <fieldset>
									                 <input type="hidden" name="sanpham_id" value="<?php echo $row_sanpham['sanpham_id'] ?>" />
									                 <input type="hidden" name="tensanpham" value="<?php echo $row_sanpham['sanpham_name'] ?>" />
									                 <input type="hidden" name="giasanpham" value="<?php echo $row_sanpham['sanpham_giakhuyenmai'] ?>" />
									                 <input type="hidden" name="hinhanh" value="<?php echo $row_sanpham['sanpham_image'] ?>" />
									                 <input type="hidden" name="soluong" value="1" />
									                 <input type="submit" name="themgiohang" value="Thêm vào giỏ hàng " class="button" />
								                  </fieldset>
							                    </form>
											</div>
										</div>
									</div>
								</div>
								<?php
								  }
                                }
								?>
							</div>
						</div>
						<!-- //first section -->
						<?php
					     }
						 ?>
						<!-- second section -->
						
						<!-- //second section -->
						<!-- third section -->
						<div class="product-sec1 product-sec2 px-sm-5 px-3">
							<div class="row">
								<h3 class="col-md-4 effect-bg">Tưng Bừng Mùa Hè </h3>
								<p class="w3l-nut-middle">Khuyến Mãi 30%</p>
								<div class="col-md-8 bg-right-nut">
									<img src="images/image1.png" alt="">
								</div>
							</div>
						</div>
						<!-- //third section -->
						<!-- fourth section -->
						
						<!-- //fourth section -->
					</div>
				</div>
				<!-- //product left -->

				<!-- product right -->
				<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						<div class="search-hotel border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Tìm Kiếm </h3>
							<form action="#" method="post">
								<input type="search" placeholder="Nhập tên sản phẩm " name="search" required="">
								<input type="submit" value=" ">
							</form>
						</div>
						<!-- price -->
						<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Mức Giá </h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="#">Dưới 1 triệu </a>
									</li>
								</ul>
							</div>
						</div>
						<!-- //price -->
						<!-- discounts -->
						<!-- //discounts -->
						<!-- reviews -->
						<div class="customer-rev border-bottom left-side py-2">
							<h3 class="agileits-sear-head mb-3"> Đánh Giá Khách Hàng </h3>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>5.0</span>
									</a>
								</li>
							</ul>
						</div>
						<!-- //reviews -->
						<!-- electronics -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Danh Mục Sản Phẩm </h3>
							<ul>
								 <?php
	                                 $sql_category_sidebar = mysqli_query($con,'SELECT * FROM tbl_category ORDER BY category_id DESC');
	                                 while($row_category_sidebar = mysqli_fetch_array($sql_category_sidebar)){
	                             ?>
								<li>
									
									<span class="span"><a href="danhmuc.php?quanly=danhmu&id=<?php echo $row_category_sidebar['category_id'] ?>" ><?php echo $row_category_sidebar['category_name'] ?></a></span>
								</li>
								<?php
							     }
							    ?>
							</ul>
						</div>
						<!-- //electronics -->
						<!-- delivery -->
						<!-- //delivery -->
						<!-- arrivals -->
						<!-- //arrivals -->
						<!-- best seller -->
						<div class="f-grid py-2">
							<h3 class="agileits-sear-head mb-3">Sản Phẩm Bán Chạy </h3>
							<div class="box-scroll">
								<div class="scroll">
									<?php
								      $sql_product_sidebar  = mysqli_query($con,"SELECT * FROM tbl_sampham WHERE sanpham_hot='0' ORDER BY sanpham_id  ASC");
								       while($row_sanpham_sidebar  = mysqli_fetch_array($sql_product_sidebar)){
								 	?>
									<div class="row">
										<div class="col-lg-3 col-sm-2 col-3 left-mar">
											<img style="width: 10px; height: auto;" src="<?php echo $row_sanpham_sidebar['sanpham_image'] ?>" alt="" class="img-fluid">
										</div>
										<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
											<a href=""><?php echo $row_sanpham_sidebar['sanpham_name'] ?></a>
											<a href="" class="price-mar mt-2"><?php echo number_format($row_sanpham_sidebar['sanpham_giakhuyenmai']).' vnd'?> </a>
										</div>
									</div>
									<?php
								     }
								    ?>
								</div>
							</div>
						</div>
						<!-- //best seller -->
					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
	</div>
	<!-- //top products -->