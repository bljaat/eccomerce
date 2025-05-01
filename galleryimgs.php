<div class="product__single__item_details">
    <ul class="nav nav-tabs img-thumb-wrapper" role="tablist">
        <li class="nav-item">
            <a class="nav-link img-thumb active" data-toggle="tab" href="#tabs-main_0" role="tab">
                <?php if ($product_result['product_type'] == 2) { ?>
                    <div class="product__thumb__pic set-bg" data-setbg="<?php echo UPLOAD_PATH . $product_result['product_logo']; ?>">
                    </div>
                <?php } ?>
                
            </a>
        </li>

        <?php
        $productid = isset($_GET['id']) ? $_GET['id'] : $_REQUEST['product_id'];
        $galleryimages = $conn->query("SELECT * FROM `gallery_images` WHERE `product_id`='" . $productid . "'");
        if ($galleryimages && $galleryimages->num_rows > 0) {
            while ($gallery = $galleryimages->fetch_assoc()) {
        ?>
                <li class="nav-item">
                    <a class="nav-link img-thumb" data-toggle="tab" href="#tabs-<?php echo $gallery['id']; ?>" role="tab">
                        <div class="product__thumb__pic set-bg" data-setbg="<?php echo UPLOAD_PATH . $gallery['images']; ?>">
                        </div>
                    </a>
                </li>
        <?php
            }
        }
        ?>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Main Product Image -->
        <div class="tab-pane active" id="tabs-main_0" role="tabpanel">
            <div class="product__details__pic__item">
                <a class="grouped_elements" href="<?php echo UPLOAD_PATH . $product_result['product_logo']; ?>">
                    <img onerror="" src="<?php echo UPLOAD_PATH . $product_result['product_logo']; ?>" alt="" />
                </a>
            </div>
        </div>

        <!-- Gallery Images Content -->
        <?php
        $galleryimages = $conn->query("SELECT * FROM `gallery_images` WHERE `product_id`='" . $productid . "'");
        if ($galleryimages && $galleryimages->num_rows > 0) {
            while ($gallery = $galleryimages->fetch_assoc()) {
        ?>
                <div class="tab-pane" id="tabs-<?php echo $gallery['id']; ?>" role="tabpanel">
                    <div class="product__details__pic__item">
                        <a class="grouped_elements" href="<?php echo UPLOAD_PATH . $gallery['images']; ?>">
                            <img onerror="" src="<?php echo UPLOAD_PATH . $gallery['images']; ?>" alt="" />
                        </a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<!-- JS to Set Backgrounds -->
<script>
    $(".set-bg").each(function () {
        var bg = $(this).data("setbg");
        $(this).css("background-image", "url(" + bg + ")");
    });
</script>
