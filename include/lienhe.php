<?php
   if(isset($_POST['cauhoi_lienhe'])){
   	 $id_cauhoi = $_POST['cauhoi_lienhe'];
   	 $name = $_POST['name_lienhe'];
   	 $email = $_POST['email_lienhe'];
   	 $message = $_POST['message_lienhe'];

   	 $sql_lienhe = mysqli_query($con,"INSERT INTO tbl_lienhe(name,email,message) VALUES ('$name','$email','$message')");
   }
?>
<div class="contact py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>L</span>iên
				<span>H</span>ệ
			</h3>
			<!-- //tittle heading -->
			<div class="row contact-grids agile-1 mb-5">
				<div class="col-sm-4 contact-grid agileinfo-6 mt-sm-0 mt-2">
					<div class="contact-grid1 text-center">
						<div class="con-ic">
							<i class="fas fa-map-marker-alt rounded-circle"></i>
						</div>
						<h4 class="font-weight-bold mt-sm-4 mt-3 mb-3">Địa Chỉ </h4>
						<p>Hòa Thuận Tây, Thanh Khê, Đà Nẵng 
							<label>Việt Nam</label>
						</p>
					</div>
				</div>
				<div class="col-sm-4 contact-grid agileinfo-6 my-sm-0 my-4">
					<div class="contact-grid1 text-center">
						<div class="con-ic">
							<i class="fas fa-phone rounded-circle"></i>
						</div>
						<h4 class="font-weight-bold mt-sm-4 mt-3 mb-3">Số Điện Thoại</h4>
						<p>0795.517.772
							<label>0396.123.452</label>
						</p>
					</div>
				</div>
				<div class="col-sm-4 contact-grid agileinfo-6">
					<div class="contact-grid1 text-center">
						<div class="con-ic">
							<i class="fas fa-envelope-open rounded-circle"></i>
						</div>
						<h4 class="font-weight-bold mt-sm-4 mt-3 mb-3">Email</h4>
						<p>
							<a href="mailto:info@example.com">doanhhuy388015@gamil.com</a>
							<label>
								<a href="mailto:info@example.com">doanhhuy1.dtu@edu.com</a>
							</label>
						</p>
					</div>
				</div>
			</div>
			<!-- form -->
			<h3 style="text-align:center;">Đóng Góp Ý Kiến Hoặc Câu Hỏi Khác </h3><br>
			<form action="" method="post">
				<div class="contact-grids1 w3agile-6">
					<div class="row">
						<div class="col-md-6 col-sm-6 contact-form1 form-group">
							<label class="col-form-label">Họ Tên </label>
							<input type="text" class="form-control" name="name_lienhe" placeholder="" required="">
						</div>
						<div class="col-md-6 col-sm-6 contact-form1 form-group">
							<label class="col-form-label">E-mail</label>
							<input type="email" class="form-control" name="email_lienhe" placeholder="" required="">
						</div>
					</div>
					<div class="contact-me animated wow slideInUp form-group">
						<label class="col-form-label">Ý Kiến Đóng Góp Hoặc Câu Hỏi Cho Chúng Tôi</label>
						<textarea name="message_lienhe" class="form-control" placeholder="" required=""> </textarea>
					</div>
					<div class="contact-form">
						<input type="submit" name="cauhoi_lienhe" value="Gửi">
					</div>
				</div>
			</form>
			<!-- //form -->
		</div>
	</div>
	<!-- //contact -->

	<!-- map -->
	<div class="map mt-sm-0 mt-4">
		<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d805196.5077734194!2d144.49270863101745!3d-37.97015423820711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad646b5d2ba4df7%3A0x4045675218ccd90!2sMelbourne+VIC%2C+Australia!5e0!3m2!1sen!2sin!4v1474020956974"
		    allowfullscreen></iframe> -->
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.315608178257!2d108.20855347490367!3d16.049103984627504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219b8df444ef7%3A0x99622098c0b9af19!2zNjkgRHV5IFTDom4sIEjDsmEgVGh14bqtbiBOYW0sIEjhuqNpIENow6J1LCDEkMOgIE7hurVuZyA1NTAwMDAsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1726371006488!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
	<!-- //map -->
</div>