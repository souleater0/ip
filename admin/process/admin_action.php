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
        }
        else if(empty($_POST['exp_notice'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter expiry notice!'
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
        }
        else if(empty($_POST['exp_notice'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter expiry notice!'
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

    if (!empty($_POST['action']) && $_POST['action'] == 'stockInItems') {
        if (!isset($_POST['data']) || empty($_POST['data'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter valid data!'
            );
        } else {
            $data = json_decode($_POST['data'], true);
    
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                $response = array(
                    'success' => false,
                    'message' => 'Invalid JSON data!'
                );
            } else {
                // Call stockIN function with decoded data
                $response = stockIN($pdo, $data); // Use the response directly from stockIN function
            }
        }
    
        // Send response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
    if (!empty($_POST['action']) && $_POST['action'] == 'sendpickList') {
        if (!isset($_POST['data']) || empty($_POST['data'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter valid data!'
            );
        } else {
            $data = json_decode($_POST['data'], true);
    
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                $response = array(
                    'success' => false,
                    'message' => 'Invalid JSON data!'
                );
            } else {
                // Store the data in the session
                $_SESSION['picklist'] = $data;
                $response = array(
                    'success' => true,
                    'message' => 'Proceeding Stockout.'
                );
            }
        }
    
        // Send response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    if (isset($_POST['action']) && $_POST['action'] === 'stockOutItems') {
        if (!isset($_POST['data']) || empty($_POST['data'])) {
            $response = [
                'success' => false,
                'message' => 'Please enter valid data!'
            ];
        } else {
            $data = $_POST['data'];

            if (empty($data) || json_last_error() !== JSON_ERROR_NONE) {
                $response = [
                    'success' => false,
                    'message' => 'Invalid JSON data!'
                ];
            } else {
                // Call stockOut function with decoded data
                $response = stockOut($pdo, $data);
            }
        }

        // Send response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // if(!empty($_POST['action']) && $_POST['action'] == 'stockInItems') {
    //     if (!isset($_POST['data']) || empty($_POST['data'])) { // Check if data is not set or empty
    //         $response = array(
    //             'success' => false,
    //             'message' => 'Please enter valid data!'
    //         );
    //     } else {
    //         $data = json_decode($_POST['data'], true); // Decode JSON data
    
    //         // Check if decoding was successful
    //         if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    //             $response = array(
    //                 'success' => false,
    //                 'message' => 'Invalid JSON data!'
    //             );
    //         } else {
    //             // Call stockIN function with decoded data
    //             if (stockIN($pdo, $data)) {
    //                 $response = array(
    //                     'success' => true,
    //                     'message' => 'Stock has been recorded.'
    //                 );
    //             } else {
    //                 $response = array(
    //                     'success' => false,
    //                     'message' => 'Failed to add stocks.'
    //                 );
    //             }
    //         }
    //     }
    
    //     // Send response
    //     header('Content-Type: application/json');
    //     echo json_encode($response);
    //     exit();
    // }
    if(!empty($_POST['action']) && $_POST['action'] == 'updateCost') {
        if(empty($_POST['selling_price'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a Selling Price!'
            );
        }else{
            if(updateCost($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'Selling Price has been updated.'
                );
            }else{
                $response = array(
                    'success' => true,
                    'message' => 'Failed to update Selling Price!'
                );
            }
        }
        // Send response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'addUser') {
        if(empty($_POST['user_display'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a display name!'
            );
        }
        else if(empty($_POST['username'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a display name!'
            );
        }
        else{
            if(addUser($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'User has been created.'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Failed to create new user!'
                );
            }
        }
        // Send response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if (!empty($_POST['action']) && $_POST['action'] == 'updateUser') {
        if (empty($_POST['user_display'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter a display name!'
            );
        } else if (empty($_POST['username'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter a username!'
            );
        } else {
            $result = updateUser($pdo);
            if ($result['success']) {
                $response = array(
                    'success' => true,
                    'message' => $result['message']
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => $result['message']
                );
            }
        }
        // Send response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
    if(!empty($_POST['action']) && $_POST['action'] == 'updateUserPassword') {
        if(empty($_POST['password'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a password!'
            );
        }else if (empty($_POST['c_password'])){
            $response = array(
                'success' => false,
                'message' => 'Please enter a confirm password!'
            );
        }else{
            if(updateUserPassword($pdo)){
                $response = array(
                    'success' => true,
                    'message' => 'User password has been updated.'
                );
            }else{
                $response = array(
                    'success' => false,
                    'message' => 'Failed to update password!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if (!empty($_POST['action']) && $_POST['action'] == 'addtoInventory') {
        if (empty($_POST['series_number'])) {
            $response = array(
                'success' => false,
                'message' => 'Could not retrieve Series Number!'
            );
        } else {
            $series_number = $_POST['series_number'];
            $result = addtoInventory($pdo, $series_number);
    
            if ($result === true) {
                $response = array(
                    'success' => true,
                    'message' => $series_number . ' has been successfully added.'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => isset($result['message']) ? $result['message'] : 'Failed to add to inventory!'
                );
            }
        }
    
        // Send response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
    // if(!empty($_POST['action']) && $_POST['action'] == 'addtoInventory') {
    //     if(empty($_POST['series_number'])){
    //         $response = array(
    //             'success' => false,
    //             'message' => 'Could not retrieve Series Number!'
    //         );
    //     }else{
    //         $series_number = $_POST['series_number'];
    //         if(addtoInventory($pdo, $series_number)){
    //             $response = array(
    //                 'success' => true,
    //                 'message' => $series_number.' has been successfully added.'
    //             );
    //         }else{
    //             $response = array(
    //                 'success' => false,
    //                 'message' => 'Failed to add to inventory!'
    //             );
    //         }
    //     }
    //     // Send response
    //     header('Content-Type: application/json');
    //     echo json_encode($response);
    //     exit();
    // }
?>