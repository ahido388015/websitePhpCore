<?php 
if (isset($_POST['search_button'])) {
    $tukhoa = $_POST['search_product'];
    $sql_product1 = mysqli_query($con, "SELECT * FROM tbl_sampham WHERE sanpham_name LIKE '%$tukhoa%' ORDER BY sanpham_id DESC");

    // Kiểm tra nếu truy vấn SQL thành công
    if (!$sql_product1) {
        die("Lỗi truy vấn SQL: " . mysqli_error($con));
    }

    // Kiểm tra nếu có kết quả tìm kiếm
    if (mysqli_num_rows($sql_product1) == 0) {
        $title = "Không tìm thấy sản phẩm nào.";
    } else {
        $title = $tukhoa;
    }
} else {
    $title = "Không có từ khóa tìm kiếm.";
}
?>
<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            Từ Khóa Tìm Kiếm: <?php echo $title; ?>
        </h3>
        <!-- //tittle heading -->
        <div class="row">
            <!-- product left -->
            <div class="agileinfo-ads-display col-lg-9">
                <div class="wrapper">
                    <!-- first section -->
                    <div class="product-sec1 px-sm-4 px-3 py-sm-5 py-3 mb-4">
                        <div class="row">
                            <?php
                            // Kiểm tra nếu có kết quả tìm kiếm
                            if (isset($sql_product1) && mysqli_num_rows($sql_product1) > 0) {
                                while ($row_sanpham = mysqli_fetch_array($sql_product1)) {
                            ?>
                                    <div class="col-md-4 product-men mt-5">
                                        <div class="men-pro-item simpleCart_shelfItem">
                                            <div class="men-thumb-item text-center">
                                                <img src="images/<?php echo $row_sanpham['sanpham_image']; ?>" alt="">
                                                <div class="men-cart-pro">
                                                    <div class="inner-men-cart-pro">
                                                        <a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id']; ?>" class="link-product-add-cart">Xem Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info-product text-center border-top mt-4">
                                                <h4 class="pt-1">
                                                    <a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id']; ?>"><?php echo $row_sanpham['sanpham_name']; ?></a>
                                                </h4>
                                                <div class="info-product-price my-2">
                                                    <span class="item_price"><?php echo number_format($row_sanpham['sanpham_giakhuyenmai']) . 'vnd'; ?></span>
                                                    <br>
                                                    <del><?php echo number_format($row_sanpham['sanpham_gia']) . 'vnd'; ?></del>
                                                </div>
                                                <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                    <form action="?quanly=giohang" method="post">
                                                        <fieldset>
                                                            <input type="hidden" name="sanpham_id" value="<?php echo $row_sanpham['sanpham_id']; ?>" />
                                                            <input type="hidden" name="tensanpham" value="<?php echo $row_sanpham['sanpham_name']; ?>" />
                                                            <input type="hidden" name="giasanpham" value="<?php echo $row_sanpham['sanpham_giakhuyenmai']; ?>" />
                                                            <input type="hidden" name="hinhanh" value="<?php echo $row_sanpham['sanpham_image']; ?>" />
                                                            <input type="hidden" name="soluong" value="1" />
                                                            <input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "<p class='text-center'>Không có sản phẩm nào được tìm thấy.</p>";
                            }
                            ?>
                        </div>
                    </div>
                    <!-- //first section -->
                </div>
            </div>
        </div>
    </div>
</div>
