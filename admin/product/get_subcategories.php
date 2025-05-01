<?php
require('../../config.php');  

if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];

    $query = "SELECT * FROM subcategory WHERE category_id = '$category_id' AND status = 1";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['subcategory_name'] . '</option>';
    }
}
?>
