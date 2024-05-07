<?php
$route = $_GET['route'] ?? 'home';
switch ($route){
    case "dashboard":
        require 'admin/views/dashboard/dashboard.php';
        break;
    case "product-management":
        require 'admin/views/product-management/product_list.php';
        break;
    case "view-product":
        require 'admin/views/product-management/product_view.php';
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
    case "product-list":
        require 'admin/views/tax-management/product_list.php';
        break;
    case "stock-in":
        require 'admin/views/stock-management/stockin.php';
        break;
    default:
    require 'admin/views/dashboard/dashboard.php';
}
?>
