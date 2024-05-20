<?php
session_start();
require_once '../../config.php';
require_once 'function.php';

    if(!empty($_POST['action']) && $_POST['action'] == 'loginProcess') {
        if(loginProcess($pdo)){
            $response = array(
                'success' => true,
                'message' => 'Login successful.',
                'redirectUrl' => '../index.php?route=dashboard'
            );
        }else{
            $response = array(
                'success' => false,
                'message' => 'Invalid Credentials!'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'addCategory') {

        if(empty($_POST['category_name'])){
            $response = array(
                'success' => false,
                'message' => 'Please Enter a Category Name!'
            );
        
        }else if(empty($_POST['category_prefix'])){
            $response = array(
                'success' => false,
                'message' => 'Please Enter a Category Prefix!'
            );
        }else{
            if(AddCategory($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Category has been added successfully'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Category already Exist!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'updateCategory') {
        if(empty($_POST['category_name'])){
            $response = array(
                'success' => false,
                'message' => 'Please Enter a Category Name!'
            );
        }else if(empty($_POST['category_prefix'])){
            $response = array(
                'success' => false,
                'message' => 'Please Enter a Category Prefix!'
            );
        }else{
            if(updateCategory($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Category has been updated successfully'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Category already Exist!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'addProduct') {
        if(empty($_POST['sku_id'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a SKU ID!'
            );
        }
        else if(empty($_POST['product_name'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a product name!'
            );
        }
        else if(empty($_POST['product_desc'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a product description!'
            );
        }
        else if(empty($_POST['purchase_price'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter purchase price!'
            );
        }
        else if(empty($_POST['min_qty'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter minimum quantity!'
            );
        }
        else if(empty($_POST['max_qty'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter max quantity!'
            );
        }
        else if(empty($_POST['unit_id'])){
            $response = array(
                'success' => false,
                'message' => 'Please select units!'
            );
        }else{
            if(addProduct($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Product has been added successfully'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Product already Exist!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'updateProduct') {
        if(empty($_POST['sku_id'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a SKU ID!'
            );
        }
        else if(empty($_POST['product_name'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a product name!'
            );
        }
        else if(empty($_POST['product_desc'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a product description!'
            );
        }
        else if(empty($_POST['purchase_price'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter purchase price!'
            );
        }
        else if(empty($_POST['min_qty'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter minimum quantity!'
            );
        }
        else if(empty($_POST['max_qty'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter max quantity!'
            );
        }
        else if(empty($_POST['unit_id'])){
            $response = array(
                'success' => false,
                'message' => 'Please select units!'
            );
        }else{
            if(updateProduct($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Product has been updated successfully'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Product already Exist!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'addBrand') {
        if(empty($_POST['brand_name'])){
            $response = array(
                'success' => false,
                'message' => 'Please Enter a Brand Name!'
            );
        }else{
            if(AddBrand($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Brand has been added successfully'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Brand already Exist!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'updateBrand') {
        if(empty($_POST['brand_name'])){
            $response = array(
                'success' => false,
                'message' => 'Please Enter a Brand Name!'
            );
        }else{
            if(updateBrand($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Brand has been updated successfully'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Brand already Exist!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'addUnit') {
        if(empty($_POST['unit_name'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a Unit Name!'
            );
        }else if(empty($_POST['unit_prefix'])){
                $response = array(
                    'success' => false,
                    'message' => 'Please enter a Prefix Name!'
                );
        }else{
            if(addUnit($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Unit has been added successfully'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Unit already Exist!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'updateUnit') {
        if(empty($_POST['unit_name'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a Unit Name!'
            );
        }else if(empty($_POST['unit_prefix'])){
                $response = array(
                    'success' => false,
                    'message' => 'Please enter a Prefix Name!'
                );
        }else{
            if(updateUnit($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Unit has been updated successfully'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Unit already Exist!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'addTax') {
        if(empty($_POST['tax_name'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a Tax Type!'
            );
        }else if(empty($_POST['tax_percentage'])){
                $response = array(
                    'success' => false,
                    'message' => 'Please enter a Percentage!'
                );
        }else{
            if(addTax($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Tax has been added successfully'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Tax already Exist!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'updateTax') {
        if(empty($_POST['tax_name'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a Tax Type!'
            );
        }else if(isset($_POST['tax_percentage']) && $_POST['tax_percentage'] !== '' && !is_numeric($_POST['tax_percentage'])){
                $response = array(
                    'success' => false,
                    'message' => 'Please enter a Percentage!'
                );
        }else{
            if(updateTax($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Tax has been updated successfully'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Tax already Exist!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'getSKUID') {
    // Get the category_id from the AJAX request
    $category_id = $_POST['category_id'];

    // Call the getSKUID function with the provided category_id
    $sku = getSKUID($pdo, $category_id);

    // Return the generated SKU
    echo $sku;
    exit;
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'stockInItems') {
        if (!isset($_POST['data']) || empty($_POST['data'])) { // Check if data is not set or empty
            $response = array(
                'success' => false,
                'message' => 'Please enter valid data!'
            );
        } else {
            $data = json_decode($_POST['data'], true); // Decode JSON data
    
            // Check if decoding was successful
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                $response = array(
                    'success' => false,
                    'message' => 'Invalid JSON data!'
                );
            } else {
                // Call stockIN function with decoded data
                if (stockIN($pdo, $data)) {
                    $response = array(
                        'success' => true,
                        'message' => 'Stock has been recorded.'
                    );
                } else {
                    $response = array(
                        'success' => false,
                        'message' => 'Failed to add stocks.'
                    );
                }
            }
        }
    
        // Send response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
?>