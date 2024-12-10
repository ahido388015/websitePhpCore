<?php
  if(isset($_GET['huydon'])&&isset($_GET['magiaodich'])){
  	$huydon = $_GET['huydon'];
  	$magiaodich = $_GET['magiaodich'];
  }else{
  	$huydon = '';
  	$magiaodich = '';
  }
  $sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$magiaodich'");
  $sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");
?>
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Xem Đơn Hàng
			</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
							<div class="row">
								<?php
								  if(isset($_SESSION['dangnhap_home']))
								    echo 'Đơn Hàng: ' .$_SESSION['dangnhap_home']; 
								?>
								<br>
								<div class="col-md-12">
						         <?php
						         if(isset($_GET['khachhang'])){
						          $id_khachhang=$_GET['khachhang'];
						         }else $id_khachhang='';
						          $sql_select = mysqli_query($con,"SELECT * FROM tbl_giaodich WHERE tbl_giaodich.khachhang_id='$id_khachhang' GROUP BY  tbl_giaodich.magiaodich");
						         ?>
						            <table class="table table-bordered ">
						              <tr>
						                <td>Thứ Tự </td>
						                <td>Mã Giao Dịch </td>						               
						                <td>Ngày Đặt</td>						               
						                <td>Tình Trạng</td>
						                <td>Quản Lý </td>
						                <td>Yêu Cầu Hủy</td>
						              </tr>
						              <?php
						               $i = 0;
						               while($row_donhang = mysqli_fetch_array($sql_select)){
						                 $i++;
						              ?>
						              <tr>
						                <td><?php echo $i ?></td>						               
						                <td><?php echo $row_donhang['magiaodich'] ?></td>						     
						                <td><?php echo $row_donhang['ngaythang'] ?> </td>
                                        <td><?php
                                           if($row_donhang['tinhtrangdon']==0){
                                              echo 'Đã Đặt Hàng';
                                           }else{
                                           	  echo 'Đang giao hàng';
                                           }
                                        ?></td>
                                        <td><a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>">Xem Giao Dịch</a></td>

                                        <td>
                                        	<?php
                                        	  if($row_donhang['huydon']==0){
                                        	?>
                                        	<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>&huydon=1">Yêu Cầu Hủy</a>
                                        	<?php
                                        	 }elseif($row_donhang['huydon']==1){
                                        	?>
                                        	  <p>Đang Chờ Hủy...</p>
                                        	<?php
                                        	 }else{
                                        	 	echo 'Đã Hủy';
                                        	 }
                                        	?>                                   
                                        </td>
						              </tr>
						              <?php
						               }
						              ?>
						            </table>
						       </div>
							</div>
							<div class="col-md-12">
						            <h5>Chi Tiết Đơn Hàng</h5>
						            <?php
						            if (isset($_GET['magiaodich'])) {
						                $magiaodich = $_GET['magiaodich'];
						            } else {
						                $magiaodich = '';
						            }
						            $sql_select = mysqli_query($con, "SELECT * FROM tbl_sampham, tbl_khachhang, tbl_giaodich WHERE tbl_giaodich.sanpham_id=tbl_sampham.sanpham_id AND tbl_giaodich.khachhang_id=tbl_khachhang.khachhang_id AND tbl_giaodich.magiaodich='$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC");
						            ?>
						            <table class="table table-bordered">
						                <tr>
						                    <td>Thứ Tự</td>						     
						                    <td>Mã Giao Dịch</td>
						                    <td>Tên Sản Phẩm</td>
						                    <td>Số Lượng</td>
						                    <td>Ngày Đặt</td>
						                    
						                </tr>
						                <?php
						                $i = 0;
						                while ($row_donhang = mysqli_fetch_array($sql_select)) {
						                    $i++;
						                ?>
						                <tr>
						                    <td><?php echo $i ?></td>						 
						                    <td><?php echo $row_donhang['magiaodich'] ?></td>
						                    <td><?php echo $row_donhang['sanpham_name'] ?></td>
						                    <td><?php echo $row_donhang['soluong'] ?></td>
						                    <td><?php echo $row_donhang['ngaythang'] ?></td>
						                    
						                </tr>
						                <?php
						                }
						                ?>
						            </table>
						        </div>
						    </div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>