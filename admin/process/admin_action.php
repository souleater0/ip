<?php
session_start();
require_once '../../config.php';
require_once 'function.php';

    if (!empty($_POST['action']) && $_POST['action'] == 'loginProcess') {
        $response = loginProcess($pdo);
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
    if (!empty($_POST['action']) && $_POST['action'] == 'moveWaste') {
        if (empty($_POST['void_card'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter a waste card!'
            );
        }
        else if (empty($_POST['product_desc'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter a reason!'
            );
        } else {
            $result = movetoWaste($pdo);
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

    if (!empty($_POST['action']) && $_POST['action'] == 'addRole') {
        if (empty($_POST['role_name'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter a Role Name!'
            );
        } else {
            $result = addRole($pdo);
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
    if (!empty($_POST['action']) && $_POST['action'] == 'updateRole') {
        if (empty($_POST['role_name'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter a Role Name!'
            );
        } else {
            $result = updateRole($pdo);
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
    if (!empty($_POST['action']) && $_POST['action'] == 'getUserPermissionbyID') {
        if (empty($_POST['role_id'])) {
            $response = array(
                'success' => false,
                'message' => 'Could not retrieve role id.'
            );
        } else {
            $result = getRolePermissions($pdo);
            if ($result['success']) {
                $response = array(
                    'success' => true,
                    'permissions' => $result['permissions']
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

    if (!empty($_POST['action']) && $_POST['action'] == 'addSupplier') {
        if (empty($_POST['company_name'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter Company Name!'
            );
        }
        else if (empty($_POST['supplier_name'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter Supplier Name!'
            );
        }
        else if (empty($_POST['supplier_address'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter the Supplier Address!'
            );
        }
        else {
            $result = addSupplier($pdo);
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
    if (!empty($_POST['action']) && $_POST['action'] == 'updateSupplier') {
        if (empty($_POST['company_name'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter Company Name!'
            );
        }
        else if (empty($_POST['supplier_name'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter Supplier Name!'
            );
        }
        else if (empty($_POST['supplier_address'])) {
            $response = array(
                'success' => false,
                'message' => 'Please enter the Supplier Address!'
            );
        }
        else {
            $result = updateSupplier($pdo);
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
    if (!empty($_POST['action']) && $_POST['action'] == 'getProductbyName') {
        // Call the function directly as the validation is handled inside the function
        $result = getProductDetailsbyName($pdo);
    
        if ($result['success']) {
            $response = array(
                'success' => true,
                'message' => $result['message'],
                'data'    => $result['data'] // Include product data if available
            );
        } else {
            $response = array(
                'success' => false,
                'message' => $result['message']
            );
        }
    
        // Send response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if (!empty($_POST['action']) && $_POST['action'] === 'addTransaction') {
        // Check which form is being submitted
        if (isset($_POST['formType'])) {
            $formType = $_POST['formType'];
            $response = array('success' => false, 'message' => '');
    
            // Common variables
            $items = isset($_POST['items']) ? json_decode($_POST['items'], true) : [];
    
            // Validate items
            $validItems = [];
            foreach ($items as $item) {
                if (!empty($item['product_name']) && !empty($item['sku']) &&
                    !empty($item['qty']) && !empty($item['rate']) &&
                    !empty($item['amount'])) {
                    $validItems[] = $item;
                }
            }
    
            // Check if there is at least one valid item
            if (count($validItems) === 0) {
                $response['message'] = 'Add at least one product!';
            } else {
                try {
                    // Prepare data based on form type
                    // $transactionData = [
                    //     'items' => $validItems
                    // ];
    
                    if ($formType === 'bill') {
                        // Validate bill form fields
                        if (empty($_POST['billSupplier'])) {
                            $response['message'] = 'Please enter Supplier Name!';
                        } elseif (empty($_POST['billDate'])) {
                            $response['message'] = 'Please enter Bill Date!';
                        } elseif (empty($_POST['billdueDate'])) {
                            $response['message'] = 'Please enter Due Date!';
                        } elseif (empty($_POST['billNo'])) {
                            $response['message'] = 'Please enter Bill No!';
                        } else {
                            // Call the addTransaction function
                            $transactionResult = addTransaction($pdo);
    
                            if ($transactionResult['success']) {
                                // Handle file upload for bill
                                if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
                                    handleFileUpload($_FILES['attachment']);
                                }
                                $response['success'] = true;
                                $response['message'] = 'Bill submitted successfully!';
                            } else {
                                $response['message'] = $transactionResult['message'];
                            }
                        }
                    } elseif ($formType === 'expense') {
                        // Validate expense form fields
                        if (empty($_POST['payee_id'])) {
                            $response['message'] = 'Please enter Payee!';
                        } elseif (empty($_POST['expenseDate'])) {
                            $response['message'] = 'Please enter Bill Date!';
                        } elseif (empty($_POST['expense_payment_method'])) {
                            $response['message'] = 'Please enter Payment Method!';
                        } elseif (empty($_POST['expenseNo'])) {
                            $response['message'] = 'Please enter Reference No!';
                        } else {
                            // Call the addTransaction function
                            $transactionResult = addTransaction($pdo);
    
                            if ($transactionResult['success']) {
                                // Handle file upload for expense
                                if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
                                    handleFileUpload($_FILES['attachment']);
                                }
                                $response['success'] = true;
                                $response['message'] = 'Expense submitted successfully!';
                            } else {
                                $response['message'] = $transactionResult['message'];
                            }
                        }
                    } elseif ($formType === 'invoice') {
                        // Validate invoice form fields
                        if (empty($_POST['customer_id'])) {
                            $response['message'] = 'Please enter Customer ID!';
                        } elseif (empty($_POST['invoice_date'])) {
                            $response['message'] = 'Please enter Invoice Date!';
                        } elseif (empty($_POST['invoice_duedate'])) {
                            $response['message'] = 'Please enter Due Date!';
                        } elseif (empty($_POST['invoice_bill_address'])) {
                            $response['message'] = 'Please enter Billing Address!';
                        } else {
                            // Call the addTransaction function
                            $transactionResult = addTransaction($pdo);
    
                            if ($transactionResult['success']) {
                                // Handle file upload for invoice
                                if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
                                    handleFileUpload($_FILES['attachment']);
                                }
                                $response['success'] = true;
                                $response['message'] = 'Invoice submitted successfully!';
                            } else {
                                $response['message'] = $transactionResult['message'];
                            }
                        }
                    }
                } catch (Exception $e) {
                    // Handle any exceptions
                    $response['message'] = 'Failed to submit transaction: ' . $e->getMessage();
                }
            }
    
            // Send response
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }
    if (!empty($_POST['action']) && $_POST['action'] === 'checkBarcodeItemDetails') {

        // Send response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if (!empty($_POST['action']) && $_POST['action'] === 'generatePaymentRefNo') {
        try {
            // Generate the payment reference number
            $paymentRefNo = generatePaymentRefNo($pdo);
    
            // Prepare success response
            $response = array(
                'success' => true,
                'payment_refno' => $paymentRefNo,
                'message' => 'Payment reference number generated successfully.'
            );
        } catch (Exception $e) {
            // Prepare error response
            $response = array(
                'success' => false,
                'message' => 'Error generating payment reference number: ' . $e->getMessage()
            );
        }
    
        // Send response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Check if the request is a POST and if the action is 'getTransactionDetails'
    if (!empty($_POST['action']) && $_POST['action'] == 'getTransactionDetails') {
        $transactionType = $_POST['transactionType'] ?? '';
        $transactionNo = $_POST['transactionNo'] ?? '';

        if (empty($transactionType) || empty($transactionNo)) {
            $response = array(
                'success' => false,
                'message' => 'Please provide both transaction type and transaction number.'
            );
        } else {
            // Call the getTransactionDetails function
            $response = getTransactionDetails($pdo);
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if (!empty($_POST['action']) && $_POST['action'] == 'generatePaymentReference') {
        try {
            $reference = generatePaymentReference($pdo);
            
            if (!empty($reference)) {
                $response = array(
                    'success' => true,
                    'reference' => $reference
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Failed to generate payment reference.'
                );
            }
        } catch (Exception $e) {
            $response = array(
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            );
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if (!empty($_POST['action']) && $_POST['action'] == 'createPaymentTransaction') {
        // Call the function to create the payment transaction
        $result = createPaymentTransaction($pdo);
    
        // Send response as JSON
        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }
?>