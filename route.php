<?php
$route = $_GET['route'] ?? 'home';
switch ($route){
    case "product-management":
        require 'admin/views/product-management/product_list.php';
        break;
    case "category-management":
        require 'admin/views/category-management/category.php';
        break;
    case "brand-management":
        require 'admin/views/brand-management/brand.php';
        break;
    case "unit-management":
        require 'admin/views/unit-management/unit.php';
        break;
    case "tax-management":
        require 'admin/views/tax-management/tax.php';
        break;
    default:
        // require 'home.php';
}
?>