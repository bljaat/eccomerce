<?php

define("SITE_URL",'http://localhost/ecommerce/');
define("UPLOAD_PATH","http://localhost/ecommerce/admin/uploads/");
define('ADMIN_ASSET',SITE_URL.'assets/admin/');
function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];

    $projectRoot = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];

    return $protocol . $host . '/' . $projectRoot . '/';
}
function dd($data)
{
    echo"<pre>";
    print_r($data);die;
}

?>

<?php
session_start();

$servernme = "localhost";
$host = "localhost";
$username = "root";

$password = "";
$dbname = "admin";


$conn = mysqli_connect($servernme, $username, $password, $dbname);

$conn2 = new mysqli($host, $username, $password, $dbname);
// $query = "SELECT * FROM `users`";
// $result = $conn2->query($query);
// $data = $result->fetch_all();
// echo "<pre>";
// print_r($data);die;

if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
?>