<?php require '../../config.php';
if (isset($_POST['submit'])) {
    if (!empty($_POST['product_name'])) {
        $productname = $_POST['product_name'];
        $categoryid = $_POST['category_id'];
        $subcategoryid = $_POST['subcategory_id'];
        $brandid = $_POST['brand_id'];
        $price = $_POST['price'];
        $product_mrp = $_POST['product_mrp'];
        $Description = $_POST['description'];
        foreach ($_POST['attribute'] as $attrId => $values) {
            foreach ($values as $val) {
                $attribute = $val;
            }
        }

        $filePath = null;
        if (!empty($_FILES['attachment']['name'])) {
            $attachment = $_FILES['attachment'];
            $uploadFolder = '../uploads/categories/' . $attachment['name'];
            move_uploaded_file($attachment['tmp_name'], $uploadFolder);
            $filePath = 'categories/' . $attachment['name'];
        }

        $insert = "INSERT INTO `product`(`product_name`,`category_id`,`subcategory_id`,`brands_id`, `product_logo`, `product_type`,`description`,`product_mrp`, `price`) 
                   VALUES ('$productname', '$categoryid', '$subcategoryid', '$brandid', '$filePath','$attribute', '$Description','$product_mrp', '$price')";
        $upload = mysqli_query($conn, $insert);

        if ($upload) {
            $product_id = mysqli_insert_id($conn);
            $product_id = (int) $product_id;



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

                            $gallery = "INSERT INTO `gallery_images`(`product_id`, `images`) 
                                        VALUES ('$product_id', '$galleryfilePath')";
                            mysqli_query($conn, $gallery);
                        } else {
                            echo "Failed to upload $image_name<br>";
                        }
                    } else {
                        echo "Error in $image_name<br>";
                    }
                }
            }




            if (!empty($_POST['attribute_values'])) {
                foreach ($_POST['attribute_values'] as $id => $attributeData) {

                    $id = (int) $id;

                    $product_attribute = "SELECT * FROM `product_attributes` WHERE `product_id` = '$product_id' AND `attribute_id` = '$id'";
                    $product_attribute = mysqli_query($conn, $product_attribute);

                    if ($product_attribute->num_rows > 0) {
                        $last_id = $product_attribute->fetch_assoc()['id'];
                    } else {
                        $attrInsert = "INSERT INTO `product_attributes`(`product_id`, `attribute_id`) 
                        VALUES ('$product_id', '$id')";
                        mysqli_query($conn, $attrInsert);
                        $last_id = mysqli_insert_id($conn);
                    }


                    foreach ($attributeData['value'] as $key => $value_id) {

                        $product_values = "SELECT * FROM `product_values` WHERE `product_id` = '$product_id' AND `values_id` = '$value_id' AND `attribute_id` = '$id'";
                        $product_values = mysqli_query($conn, $product_values);

                        if ($product_value->num_rows > 0) {
                            $lastvalues_id = $product_value->fetch_assoc()['id'];
                        } else {

                            $valueInsert = "INSERT INTO `product_values`(`product_id`, `values_id`, `attribute_id`) 
                                        VALUES ('$product_id', '$value_id', '$id')";
                            mysqli_query($conn, $valueInsert);
                            $lastvalues_id = mysqli_insert_id($conn);
                        }

                        $qty = $attributeData['qty'][$key] ?? 0;
                        $mrp = $attributeData['mrp'][$key] ?? 0;
                        $price = $attributeData['price'][$key] ?? 0;

                        $attrInsert = "INSERT INTO `product_variations`(`product_id`, `product_attribute_id`, `product_value_id`, `qty`, `mrp`, `price`) 
                                       VALUES ('$product_id', '$last_id', '$lastvalues_id', '$qty', '$mrp', '$price')";
                        mysqli_query($conn, $attrInsert);
                    }
                }
            }

            header('Location: index.php');
        } else {
            echo "<script>alert('Please fill all the fields'); window.location.href = 'add.php';</script>";
        }
    }
}


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

?>


<?php
include '../common/header.php';
include '../common/sidebar.php';
$data = $conn->query("SELECT * FROM category WHERE status = 1");
$result = $conn->query("SELECT * FROM subcategory WHERE status = 1");
$brand = $conn->query("SELECT * FROM brands WHERE status = 1");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .content {
            background: #fff;
        }

        .container-fluid {
            background-color: #fff !important;
        }

        .dark-mode .card {
            background-color: #fff !important;
            color: #000;
        }

        .dark-mode .content-wrapper {
            background: #fff;
        }

        .btn-block {
            width: 30%;
        }

        .btn-block+.btn-block {
            margin-top: .0rem;
        }

        .form-control {
            background: #fff !important;
            color: #000 !important;
        }

        .status {
            padding: 5px;
            border-radius: 2px;
            background: #fff !important;
            color: #000 !important;
            width: 100%;
        }

        .submit {
            border: none;
            padding: 5px;
            border-radius: 2px;
        }

        .submit a {
            text-decoration: none;
            color: #fff;
        }

        .form input {
            width: 100%;
        }

        .class {
            width: 22% !important;
            background: #fff !important;
            color: #000 !important;
            border: solid 1px #ccc;
            padding: 3px;

        }


        .Atribute {
            display: flex;
            justify-content: start;
        }

        .Atribute-main {
            padding: 10px;
        }

        .Atribute-main input {
            margin-right: 10px;
        }

        .attribute-row {
            border: solid 1px #ccc;
            padding: 10px;
        }

        .attribute-row h4 {
            text-align: center;
        }

        .add-more {
            border: solid 1px #ccc;
            border-radius: 5px;
        }

        .remove-field {
            border: solid 1px #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Add a product</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="" class="form" method="POST" enctype="multipart/form-data">
                <label for="product_name">product Name</label><br>
                <input type="text" name="product_name" placeholder="product Name"><br><br>
                <label for="image">Image</label><br>
                <input class="input" type="file" name="attachment"><br><br>
                <label for="">Gallery_image</label>
                <input type="file" name="gallery_image[]" id="gallery_image" multiple><br><br>
                <label for="select_category">select category</label>
                <select class="form-control" id="category" name="category_id">
                    <option class="input" value="">select category</option>

                    <?php
                    if ($data->num_rows > 0) {
                        while ($cate = $data->fetch_assoc()) { ?>
                            <option class="input" value="<?php echo $cate['id'] ?>"><?php echo $cate['category_name'] ?></option>
                    <?php }
                    }
                    ?>

                </select><br>
                <label for="select_category">select subcategory</label>
                <select class="form-control" id="subcategory" name="subcategory_id">
                    <option class="input" value="">select subcategory</option>

                    <?php
                    if ($result->num_rows > 0) {
                        while ($cate = $result->fetch_assoc()) { ?>
                            <option class="input" value="<?php echo $cate['id'] ?>"><?php echo $cate['subcategory_name'] ?></option>
                    <?php }
                    }
                    ?>

                </select><br>
                <label for="select_category">select brand</label>
                <select class="form-control" name="brand_id">
                    <option class="input" value="">select brand</option>

                    <?php
                    if ($brand->num_rows > 0) {
                        while ($cate = $brand->fetch_assoc()) { ?>
                            <option class="input" value="<?php echo $cate['id'] ?>"><?php echo $cate['brand_name'] ?></option>
                    <?php }
                    }
                    ?>
                </select><br>


                <label for="Description">Description</label><br>
                <input type="textarea" name="description" placeholder="Description"><br><br>
                <label for="product_mrp">product_mrp</label>
                <input type="text" name="product_mrp" placeholder="product_mrp"><br><br>
                <label for="price">Price</label><br>
                <input type="text" name="price" placeholder="Price"><br><br>

                <label for="Product">Product type</label><br>
                <select name="attribute[${attrbuteId}][]" class="form-control" id="attribute">
                    <option value="">select Attribute</option>
                    <option value="1">Simple</option>
                    <option value="2">Configable</option>
                </select><br>

                <div id="configurable-fields" style="display: none;">
                    <div class="Atribute">
                        <?php
                        if ($attributes) {
                            foreach ($attributes as $attribute) {
                        ?>
                                <div class="Atribute-main" style="display: flex;">

                                    <input type="checkbox" name="attributes[<?php echo $attribute['attribute_name'] ?>]" class="attribute-checkbox"
                                        value="<?php echo $attribute['id']; ?>"
                                        attribute='<?php echo json_encode($attribute, JSON_HEX_APOS | JSON_HEX_QUOT); ?>'>
                                    <?php echo $attribute['attribute_name']; ?>


                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="attribute-fields" id="attribute-fields"></div>


                </div>
                <button class="submit btn btn-block btn-primary btn-sm" name="submit" type="submit">Submit</button>
            </form>
        </div>
    </div>
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



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#attribute").change(function() {
                var selectedValue = $(this).val();
                if (selectedValue == "2") {
                    $.ajax({
                        url: 'get_attributes.php',
                        type: 'GET',
                        success: function(data) {
                            $("#attribute-container").html(data);
                        }
                    });
                } else {
                    $("#attribute-container").html("");
                    $("#attribute-fields").html("");
                }
            });

            $(document).on("change", ".attribute-checkbox", function() {
                var attrbuteId = $(this).val();
                let attibute = $(this).attr("attribute");
                let attributeObj = {};

                try {
                    attributeObj = JSON.parse(attibute);
                } catch (error) {
                    console.error("JSON Parsing Error:", error, "Raw Data:", attibute);
                }

                if ($(this).is(":checked")) {
                    let rowId = `row-${attrbuteId}`;
                    if ($("#" + rowId).length === 0) {
                        let options = `<option value="">Select Value</option>`;
                        attributeObj.values.forEach(value => {
                            options += `<option value="${value.id}">${value.name}</option>`;
                        });

                        $("#attribute-fields").append(`
             <div class="attribute-row" id="${rowId}">   
                    <input type="checkbox" class="" name="primary_attribute" placeholder="primary" style="width: 3% ;">
                    <h4>${attributeObj.attribute_name}</h4>
                    <select class="class" name="attribute_values[${attrbuteId}][value][]">
                        ${options}
                    </select>
                    <input type="text" class="class" name="attribute_values[${attrbuteId}][qty][]" placeholder="Qty">
                    <input type="text" class="class" name="attribute_values[${attrbuteId}][mrp][]" placeholder="MRP">
                    <input type="text" class="class" name="attribute_values[${attrbuteId}][price][]" placeholder="Price">
                    <button class="add-more" data-attribute="${attrbuteId}">Add more</button>
          </div>

                <br>
            `);
                    }
                } else {
                    $("#row-" + attrbuteId).remove();
                }

            });


        });
    </script>
    <script>
        $(document).on("click", ".add-more", function(event) {
            event.preventDefault();

            var attrbuteId = $(this).data("attribute");

            var attributeRow = $("#attribute-fields").find("#row-" + attrbuteId);

            if (!attributeRow.length) {
                console.error("Attribute row not found for ID: " + attrbuteId);
                return;
            }

            var uniqueId = new Date().getTime();

            var existingSelect = attributeRow.find("select").first();
            var optionsHtml = existingSelect.html();

            attributeRow.append(`
                    <div class="attribute-row" id="field-${uniqueId}" style="padding: 0px; border: none;">
                        <select class="class" name="attribute_values[${attrbuteId}][value][]">
                            ${optionsHtml}
                        </select>
                        <input type="text" class="class" name="attribute_values[${attrbuteId}][qty][]" placeholder="Qty">
                        <input type="text" class="class" name="attribute_values[${attrbuteId}][mrp][]" placeholder="MRP">
                        <input type="text" class="class" name="attribute_values[${attrbuteId}][price][]" placeholder="Price">
                        <button type="button" class="remove-field" data-field="field-${uniqueId}">Remove</button>
                    </div>
               `);
        });

        $(document).on("click", ".remove-field", function() {
            var fieldId = $(this).data("field");
            $("#" + fieldId).remove();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#category').change(function() {
                var category_id = $(this).val();

                if (category_id != "") {
                    $.ajax({
                        url: 'get_subcategories.php',
                        type: 'POST',
                        data: {

                            category_id: category_id
                        },
                        success: function(data) {
                            $('#subcategory').html(data);
                        }
                    });
                } else {
                    $('#subcategory').html('<option value="">Select Subcategory</option>');
                }
            });
        });
    </script>


    <?php include '../common/footer.php' ?>