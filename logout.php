<?php
require 'config.php';
if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
    unset($_SESSION['user']);
    header('Location: login.php');
}else{
    header('Location: login.php');
}
?>