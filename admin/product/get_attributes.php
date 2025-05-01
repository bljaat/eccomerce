<?php
require '../../config.php';

$query = "SELECT * FROM aterbute WHERE status = 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<label><input type="checkbox" class="attribute-checkbox" value="' . $row['attribute_name'] . '"> ' . $row['attribute_name'] . '</label>';
    }
}
?>
