<?php
$route = $_GET['route'] ?? 'home';
switch ($route){
    case "product-list":
        require 'views/product-management/product_list.php';
        break;
    default:
        // require 'home.php';
}
?>