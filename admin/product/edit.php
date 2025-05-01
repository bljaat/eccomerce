<?php

require('../../config.php');
$id = $_GET['id'];

if (isset($_POST['update'])) {

    $filePath_select = $conn->query("SELECT `product_logo` FROM `product` WHERE id = '" . $id . "'");
    $product = $filePath_select->fetch_assoc();
    $filePath = $product['product_logo'];

    if (!empty($_FILES['image']['name'])) {
        $attachment = $_FILES['image'];
        $uplodfolder = '../uploads/categories/' . $attachment['name'];
        move_uploaded_file($attachment['tmp_name'], $uplodfolder);
        $filePath = 'categories/' . $attachment['name'];
    }

    $product_name  = $_POST['product_name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $subcategory_id = $_POST['subcategory_id'];
    $price = $_POST['price'];
    $brandid = $_POST['brands_id'];
    $attribute = $_POST['attribute'];
    $product_mrp = $_POST['product_mrp'];
    $update = "UPDATE `product` SET`product_name`='$product_name',`category_id` = '$category_id',`subcategory_id` = '$subcategory_id',`brands_id`='$brandid',`product_logo`='$filePath',`product_type` = '$attribute',`description`='$description',`product_mrp` = '$product_mrp' , `price` = '$price' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);


    if (!empty($_POST['prouct_values'])) {
        // dd($_POST['prouct_values']);

        foreach ($_POST['prouct_values'] as $product_value_id => $variation_data) {
            //  dd($_POST['prouct_values']);
            foreach ($variation_data['values'] as $key => $value_id) {
                $qty = $variation_data['qty'][$key];
                $mrp = $variation_data['mrp'][$key];
                $prices = $variation_data['prices'][$key];
                $vartID = $variation_data['vartID'][$key];

                $update_Product_values = "UPDATE `product_values` SET `values_id`='" . $value_id . "' WHERE id='" . $product_value_id . "'";

                $update_product_value = mysqli_query($conn, $update_Product_values);

                $updatevariation = "UPDATE `product_variations` SET `qty` = '$qty', `mrp` = '$mrp', `price` = '$prices' WHERE id = $vartID";
                // dd($updatevariation);
                $updateresult = mysqli_query($conn, $updatevariation);
                // dd($updateresult);



            }
        }
    }

    if (!empty($_FILES['gallery_image']['name'][0])) {
        $gallery_images = $_FILES['gallery_image'];
        $uploadDir = '../uploads/categories/';

        foreach ($gallery_images['name'] as $index => $image_name) {
            $tmp_name = $gallery_images['tmp_name'][$index];
            $error = $gallery_images['error'][$index];

            if ($error === 0) {
                $uniqueName = uniqid('img_', true) . '_' . basename($image_name);
                $uploadPath = $uploadDir . $uniqueName;

                if (move_uploaded_file($tmp_name, $uploadPath)) {
                    $galleryfilePath = 'categories/' . $uniqueName;

                    // Sirf naye images ko add karna
                    $insertQuery = "INSERT INTO `gallery_images` (`product_id`, `images`) VALUES ('$id', '$galleryfilePath')";
                    mysqli_query($conn, $insertQuery);
                } else {
                    echo "Failed to upload $image_name<br>";
                }
            } else {
                echo "Error in $image_name<br>";
            }
        }
    }
    if (!empty($_POST['new_product_values'])) {

        foreach ($_POST['new_product_values'] as $attribute_id => $attributeData) {
            // dd($attributeData);
            $product_attribute = "SELECT * FROM `product_attributes` WHERE `product_id` = '$id' AND `attribute_id` = '$attribute_id'";
            $product_attribute = mysqli_query($conn, $product_attribute);

            if ($product_attribute->num_rows > 0) {
                $last_id = $product_attribute->fetch_assoc()['id'];
            } else {

                $attrInsert = "INSERT INTO `product_attributes`(`product_id`, `attribute_id`) 
                           VALUES ('$id', '$attribute_id')";
                mysqli_query($conn, $attrInsert);
                $last_id = mysqli_insert_id($conn);
            }

            foreach ($attributeData['values'] as $key => $value_id) {

                $product_value = "SELECT * FROM `product_values` WHERE `product_id` = '$id' AND `attribute_id` = '$attribute_id' AND `values_id` = '$value_id'";
                $product_value = mysqli_query($conn, $product_value);

                if($product_value->num_rows > 0){
                    $lastvalues_id = $product_value->fetch_assoc()['id'];
                } else {
                    $valueInsert = "INSERT INTO `product_values`(`product_id`, `values_id`, `attribute_id`) 
                                VALUES ('$id', '$value_id', '$attribute_id')";
                    mysqli_query($conn, $valueInsert);
                    $lastvalues_id = mysqli_insert_id($conn);

                    $qty = $attributeData['qty'][$key] ?? 0;
                    $mrp = $attributeData['mrp'][$key] ?? 0;
                    $price = $attributeData['prices'][$key] ?? 0;

                    $attrInsert = "INSERT INTO `product_variations`(`product_id`, `product_attribute_id`, `product_value_id`, `qty`, `mrp`, `price`) 
                               VALUES ('$id', '$last_id', '$lastvalues_id', '$qty', '$mrp', '$price')";
                    $insert_product_variation = mysqli_query($conn, $attrInsert);
                }
            }
        }
    }
    if ($updateresult) {
        echo "<script>
                  alert('product Edit successfully');
                  window.location.href = 'index.php'; 
              </script>";
    }
}





$select = "SELECT * FROM `product` WHERE id = '" . $id . "'";
$data = mysqli_query($conn, $select);

$rowResult = mysqli_fetch_assoc($data);

$product_attribute = "SELECT attribute_id FROM product_attributes WHERE product_id = '" . $id . "'";
$attribute_data = mysqli_query($conn, $product_attribute);
$product_attributes = [];




$attributes = [];
$attributeQuery = $conn->query("SELECT * FROM aterbute WHERE status = 1");

if ($attributeQuery->num_rows > 0) {
    while ($attribute = $attributeQuery->fetch_assoc()) {
        $attributeId = $attribute['id'];
        $valuesQuery = $conn->query("SELECT * FROM `values` WHERE attribute_id = $attributeId");
        $values = [];

        if ($valuesQuery->num_rows > 0) {
            while ($value = $valuesQuery->fetch_assoc()) {
                $values[] = $value;
            }
        }

        $attribute['values'] = $values;
        $attributes[] = $attribute;
    }
}


while ($row = mysqli_fetch_assoc($attribute_data)) {
    $product_attributes[] = $row['attribute_id'];
}

$variations = "SELECT * FROM product_variations WHERE product_id = '" . $id . "'";
$varresult = mysqli_query($conn, $variations);

$varResult = mysqli_fetch_assoc($varresult);


$productvalue = "SELECT * FROM product_values WHERE product_id = '" . $id . "'";
$productvalue_data = mysqli_query($conn, $productvalue);

$product_values = [];

while ($row = mysqli_fetch_assoc($productvalue_data)) {
    $product_values[] = $row['values_id'];
}


include('../common/header.php');
include('../common/sidebar.php');

$category_query = "SELECT * FROM category";
$category_result = mysqli_query($conn, $category_query);

$subcategory_query = "SELECT * FROM subcategory";
$subcategory_result = mysqli_query($conn, $subcategory_query);

$brand_query = "SELECT * FROM brands";
$brand_result = mysqli_query($conn, $brand_query);

$values = $conn->query("SELECT `values`.id as value_id,`values`.`name`,aterbute.id as attribute_id ,aterbute.attribute_name   FROM `values` INNER JOIN aterbute ON `values`.attribute_id = aterbute.id");
$variation_query = "SELECT 
        product_variations.*,
        aterbute.id AS attribute_id, 
        aterbute.attribute_name, 
        `values`.id AS value_id, 
        `values`.`name` AS value_name
    FROM product_variations 
    LEFT JOIN product_attributes ON product_attributes.id = product_variations.product_attribute_id 
    LEFT JOIN product_values ON product_values.id = product_variations.product_value_id 
    LEFT JOIN aterbute ON aterbute.id = product_attributes.attribute_id 
    LEFT JOIN `values` ON `values`.id = product_values.values_id
    WHERE product_variations.product_id = '" . $id . "'";
$product_variations = $conn->query($variation_query);

if ($product_variations) {
    $variations = [];
    $attribute_ids = [];
    while ($row = mysqli_fetch_assoc($product_variations)) {
        $variations[$row['attribute_name']][] = $row;
        $attribute_ids[$row['attribute_name']] = $row['attribute_id'];
    }
}

$galleryimages = $conn->query("SELECT * FROM `gallery_images` WHERE product_id = '" . $id . "'");

if (isset($_POST['delete_image'])) {
    $image_id = $_POST['image_id'];
    $delete = "DELETE FROM `gallery_images` WHERE id = '$image_id'";
    $result = mysqli_query($conn, $delete);

    if ($result) {

        unlink(UPLOAD_PATH . $galleryimg['images']);
        echo "<script>
                  alert('Image deleted successfully');
                  window.location.href = 'edit.php?id=$id'; 
              </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .select {
            width: 100% !important;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .add-more {
            border: solid 1px #ccc;
            border-radius: 5px;
            width: 12% !important;
            margin: 10px;
        }
    </style>
</head>


<form method="post" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group">
            <label for="fullname">product name</label>
            <input type="text" name="product_name" value="<?php echo $rowResult['product_name'] ?>" class="form-control">
            <label for="fullname">image</label>
            <input type="file" name="image" class="form-control" value="<?php echo $rowResult['product_logo'] ?>"><br>

            <label for="">Gallery_image</label>
            <input type="file" name="gallery_image[]" class="form-control" value="<?php echo $galleryresult['images'] ?>" id="gallery_image" multiple><br><br>

            <div class="gallery-images">
                <?php

                if ($galleryimages && $galleryimages->num_rows > 0) {
                    while ($galleryimg = $galleryimages->fetch_assoc()) {
                ?>
                        <div style="display: inline-block; text-align: center; margin: 5px;">
                            <img src="<?php echo UPLOAD_PATH . $galleryimg['images']; ?>" alt="" style="width: 100px; height: 100px;">
                            <br>
                            <form method="post" action="">
                                <input type="hidden" name="image_id" value="<?php echo $galleryimg['id']; ?>">
                                <button type="submit" name="delete_image">Delete</button>
                            </form>
                        </div>
                <?php
                    }
                }
                ?>

                <br>
                <label for="fullname">Select Category</label><br><br>
                <select class="form-control" id="category" name="category_id">
                    <option class="input" value="">Select Category</option>
                    <?php while ($cate = mysqli_fetch_assoc($category_result)) { ?>
                        <option value="<?php echo $cate['id'] ?>"
                            <?php echo ($cate['id'] == $rowResult['category_id']) ? "selected" : ""; ?>>
                            <?php echo $cate['category_name']; ?>
                        </option>
                    <?php } ?>
                </select><br>

                <label for="">Select Subcategory</label>
                <select class="form-control" id="subcategory" name="subcategory_id">
                    <option class="input" value="">Select Subcategory</option>
                    <?php while ($subcate = mysqli_fetch_assoc($subcategory_result)) { ?>
                        <option value="<?php echo $subcate['id'] ?>"
                            <?php echo ($subcate['id'] == $rowResult['subcategory_id']) ? "selected" : ""; ?>>
                            <?php echo $subcate['subcategory_name']; ?>
                        </option>
                    <?php } ?>
                </select><br>
                <label for="">Select brand</label>
                <select class="form-control" name="brands_id">
                    <option class="input" value="">select brand</option>
                    <?php while ($subcate = mysqli_fetch_assoc($brand_result)) { ?>
                        <option value="<?php echo $subcate['id'] ?>"
                            <?php echo ($subcate['id'] == $rowResult['brands_id']) ? "selected" : ""; ?>>
                            <?php echo $subcate['brand_name']; ?>
                        </option>
                    <?php } ?>
                </select><br>

                <label for="fullname">description</label>
                <input type="textarea" name="description" value="<?php echo $rowResult['description'] ?>" class="form-control">
                <label for="MRP">MRP</label>
                <input type="text" name="product_mrp" value="<?php echo $rowResult['product_mrp'] ?>" class="form-control">
                <label for="price">price</label>
                <input type="text" name="price" value="<?php echo $rowResult['price'] ?>" class="form-control">


                <label for="Product">Product type</label><br>
                <select name="attribute" class="form-control" id="attribute">
                    <option value="">select Attribute</option>
                    <option value="1" <?= $rowResult['product_type'] == 1 ? 'selected' : '' ?>>Simple</option>
                    <option value="2" <?= $rowResult['product_type'] == 2 ? 'selected' : '' ?>>Configurable</option>
                </select><br>

                <div id="configurable-fields" class="attribute-row">
                    <div class="Atribute" style="display: flex;">
                        <?php
                        if ($attributes) {
                            foreach ($attributes as $attribute) {
                        ?>
                                <div class="Atribute-main" style="display: flex; margin: 5px;">
                                    <input type="checkbox" name="attributes[<?php echo $attribute['attribute_name'] ?>]" class="attribute-checkbox"
                                        value="<?php echo $attribute['id']; ?>"
                                        attribute='<?php echo json_encode($attribute, JSON_HEX_APOS | JSON_HEX_QUOT); ?>' <?php echo in_array($attribute['id'], $product_attributes) ? 'checked' : '' ?>>
                                    <?php echo $attribute['attribute_name']; ?>

                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>


                    <div id="configurable-fields" class="attribute-row">
                        <div class="Atribute">


                            <?php
                            if ($variations) {
                                foreach ($variations as $attributeName => $values) {
                            ?>
                                    <div style="text-align:center; border: 1px solid #ccc; margin: 10px 0; padding: 10px; flex-direction: column; display:flex; justify-content:space-between;"
                                        class="Atribute-main attribute-group"
                                        data-attribute="<?php echo $attribute_ids[$attributeName]; ?>"
                                        style="display: <?php echo isset($variations[$attributeName]) ? 'flex' : 'none'; ?>;">


                                        <label><strong><?php echo $attributeName; ?></strong></label>
                                        <div style="text-align: end;">
                                            <button class="add-more" data-attribute="${attrbuteId}">Add more</button>
                                        </div>

                                        <?php foreach ($values as $row) { ?>
                                            <div style="display: flex; gap: 10px;">
                                                <input type="hidden" name="prouct_values[<?php echo $row['product_value_id'] ?>][vartID][]" value="<?php echo $row['id']; ?>">
                                                <select name="prouct_values[<?php echo $row['product_value_id'] ?>][values][]" class="form-control">
                                                    <option value="">Select Value</option>
                                                    <?php
                                                    $attr_id = $row['attribute_id'];
                                                    $saved_value_id = $row['value_id'];
                                                    $query_values = "SELECT * FROM `values` WHERE attribute_id = '$attr_id'";
                                                    $result_values = mysqli_query($conn, $query_values);

                                                    while ($option = mysqli_fetch_assoc($result_values)) {
                                                        $selected = ($option['id'] == $saved_value_id) ? "selected" : "";

                                                        echo "<option value='{$option['id']}' $selected>{$option['name']}</option>";
                                                    }
                                                    ?>
                                                </select>

                                                <input type="text" name="prouct_values[<?php echo $row['product_value_id'] ?>][qty][]" value="<?php echo isset($row['qty']) ? $row['qty'] : ''; ?>" class="form-control" placeholder="Qty">
                                                <input type="text" name="prouct_values[<?php echo $row['product_value_id'] ?>][mrp][]   " value="<?php echo isset($row['mrp']) ? $row['mrp'] : ''; ?>" class="form-control" placeholder="MRP">
                                                <input type="text" name="prouct_values[<?php echo $row['product_value_id'] ?>][prices][]" value="<?php echo isset($row['price']) ? $row['price'] : ''; ?>" class="form-control" placeholder="Price">

                                            </div>
                                        <?php } ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <script>
                        $(document).on("click", ".add-more", function(event) {
                            event.preventDefault();
                            var attributeGroup = $(this).closest(".attribute-group");
                            var attrbuteId = attributeGroup.data("attribute");

                            var uniqueId = new Date().getTime();
                            var optionsHtml = attributeGroup.find("select").first().html();

                            attributeGroup.append(`
                                <div class="attribute-row" id="field-${uniqueId}" style="display: flex; gap: 10px; margin-top: 10px;">
                                    <select class="form-control" name="new_product_values[${attrbuteId}][values][]">
                                        ${optionsHtml}
                                    </select>
                                    <input type="text" class="form-control" name="new_product_values[${attrbuteId}][qty][]" placeholder="Qty">
                                    <input type="text" class="form-control" name="new_product_values[${attrbuteId}][mrp][]   " placeholder="MRP">
                                    <input type="text" class="form-control" name="new_product_values[${attrbuteId}][prices][]" placeholder="Price">
                                    <button type="button" class="remove-field btn btn-danger" data-field="field-${uniqueId}">Remove</button>
                                </div>
                            `);
                        });

                        $(document).on("click", ".remove-field", function() {
                            var fieldId = $(this).data("field");
                            $("#" + fieldId).remove();
                        });
                    </script>


                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let selectElement = document.getElementById("attributeSelect");
                            let attributeGroups = document.querySelectorAll(".attribute-group");


                            attributeGroups.forEach(function(group) {
                                if (group.style.display === "flex") {
                                    selectElement.value = group.getAttribute("data-attribute");
                                }
                            });

                            selectElement.addEventListener("change", function() {
                                let selectedValue = this.value;

                                attributeGroups.forEach(function(group) {
                                    if (group.getAttribute("data-attribute") === selectedValue) {
                                        group.style.display = "";
                                    } else {
                                        group.style.display = "none";
                                    }
                                });
                            });
                        });
                    </script>



                </div>


                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>

</form>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        let selectElement = document.getElementById("attribute");

        let defaultValue = "configurable";
        let options = selectElement.options;

        for (let i = 0; i < options.length; i++) {
            if (options[i].value === defaultValue) {
                options[i].selected = true;
                break;
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        $("#attribute").change(function() {
            var selectedValue = $(this).val();
            if (selectedValue == "2") {
                $("#configurable-fields").show();
            } else {
                $("#configurable-fields").hide();
            }
        });
    });
</script>
<?php include('../common/footer.php'); ?>