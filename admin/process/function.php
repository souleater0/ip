<?php
    function loginProcess($pdo){
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username= ?");
            $stmt ->execute([$username]);
            $user = $stmt ->fetch();
    
            if($user && password_verify($password, $user["password"])){
                //login success
                // session_start();
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                return true;
            }else{
                return false;
            }
    }
    function addUser($pdo){
        try {
            $user_display = $_POST['user_display'];
            $username = $_POST['username'];
            $password = password_hash('ecadmin', PASSWORD_BCRYPT);
            $user_role = $_POST['user_role'];
            $loginEnabled = !empty($_POST['loginEnabled']) ? '1' : '0';

            // Check if Users with the same name already exists
            $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR display_name = :display_name");
            $stmt_check->bindParam(':username', $username);
            $stmt_check->bindParam(':display_name', $user_display);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();

            if ($count > 0) {
                // Users already exists, return false
                return false;
            }

            $stmt = $pdo ->prepare("INSERT INTO users (username, password, display_name, role_id, isEnabled) VALUES (:username, :password, :display_name, :role_id , :isEnabled)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':display_name', $user_display);
            $stmt->bindParam(':role_id', $user_role, PDO::PARAM_INT);
            $stmt->bindParam(':isEnabled', $loginEnabled, PDO::PARAM_INT);
            if ($stmt->execute()){
                // Users added successfully
                return true;
            } else {
                // Error occurred
                return false;
            }
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function updateUserPassword($pdo){
        try {
            $update_ID = $_POST['update_id'];
            $password = password_hash($_POST['c_password'], PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
            //bind parameters
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $update_ID, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getCategory($pdo){
        // require_once 'config.php';
        try {
            $query = "SELECT * FROM category";
            $stmt = $pdo->prepare($query);
    
            $stmt ->execute();
            $category = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $category;
        }catch(PDOException $e){
                    // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getRole($pdo){
        try {
            $query = "SELECT * FROM roles";
            $stmt = $pdo->prepare($query);
    
            $stmt ->execute();
            $roles = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $roles;
        }catch(PDOException $e){
                    // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function AddCategory($pdo){
        // require_once 'config.php';
        try {
            $category_name = $_POST['category_name'];
            $category_prefix = $_POST['category_prefix'];
            // Check if category with the same name already exists
            $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM category WHERE category_name = :category_name OR category_prefix = :category_prefix");
            $stmt_check->bindParam(':category_name', $category_name);
            $stmt_check->bindParam(':category_prefix', $category_prefix);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();

            if ($count > 0) {
                // Category already exists, return false
                return false;
            }
            $parent_category_id = !empty($_POST['p_category_id']) ? $_POST['p_category_id'] : null;
            $stmt = $pdo ->prepare("INSERT INTO category (parent_category_id, category_name, category_prefix) VALUES (:parent_category_id, :category_name, :category_prefix)");
            //bind parameters
            $stmt->bindParam(':parent_category_id', $parent_category_id, PDO::PARAM_INT);
            $stmt->bindParam(':category_name', $category_name);
            $stmt->bindParam(':category_prefix', $category_prefix);
            if ($stmt->execute()) {
                // Category added successfully
                return true;
            } else {
                // Error occurred
                return false;
            }
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function updateCategory($pdo){
        try {
            $category_name = $_POST['category_name'];
            $parent_category_id = !empty($_POST['p_category_id']) ? $_POST['p_category_id'] : null;
            $category_prefix = $_POST['category_prefix'];
            $update_ID = $_POST['update_id'];

            $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM category WHERE (category_name = :category_name OR category_prefix = :category_prefix) AND category_id != :category_id");
            $stmt_check->bindParam(':category_name', $category_name);
            $stmt_check->bindParam(':category_id', $update_ID, PDO::PARAM_INT);
            $stmt_check->bindParam(':category_prefix', $category_prefix);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();

            if ($count > 0) {
                // Category already exists, return false
                return false;
            }

            $stmt = $pdo->prepare("UPDATE category SET parent_category_id = :parent_category_id, category_name = :category_name, category_prefix = :category_prefix WHERE category_id = :category_id");
            //bind parameters
            $stmt->bindParam(':parent_category_id', $parent_category_id, PDO::PARAM_INT);
            $stmt->bindParam(':category_name', $category_name);
            $stmt->bindParam(':category_prefix', $category_prefix);
            $stmt->bindParam(':category_id', $update_ID, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            }else{
                return false;
            }
        } catch(PDOException $e){  
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function AddBrand($pdo){
        // require_once 'config.php';
        try {
            $brand_name = $_POST['brand_name'];
            // Check if category with the same name already exists
            $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM brand WHERE brand_name = :brand_name");
            $stmt_check->bindParam(':brand_name', $brand_name);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();
            if ($count > 0) {
                // Brand already exists, return false
                return false;
            }
            $stmt = $pdo ->prepare("INSERT INTO brand (brand_name) VALUES (:brand_name)");
            //bind parameters
            $stmt->bindParam(':brand_name', $brand_name);
            if ($stmt->execute()) {
                // Brand added successfully
                return true;
            } else {
                // Error occurred
                return false;
            }
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function updateBrand($pdo){
        // require_once 'config.php';
        try {
            $brand_name = $_POST['brand_name'];
            $update_ID = $_POST['update_id'];
            // Check if category with the same name already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM brand WHERE brand_name = :brand_name AND brand_id != :brand_id");
            $stmt->bindParam(':brand_name', $brand_name);
            $stmt->bindParam(':brand_id', $update_ID, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            if ($count > 0) {
                // Brand already exists, return false
                return false;
            }
            $stmt = $pdo->prepare("UPDATE brand SET brand_name = :brand_name WHERE brand_id = :brand_id");
            //bind parameters
            $stmt->bindParam(':brand_name', $brand_name);
            $stmt->bindParam(':brand_id', $update_ID, PDO::PARAM_INT);
            if ($stmt->execute()) {
                // Brand Update successfully
                return true;
            } else {
                // Error occurred
                return false;
            }
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function addUnit($pdo){
        try {
            $unit_name = $_POST['unit_name'];
            $unit_prefix = $_POST['unit_prefix'];
            // Check if category with the same name already exists
            $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM unit WHERE unit_type = :unit_type OR short_name = :short_name");
            $stmt_check->bindParam(':unit_type', $unit_name);
            $stmt_check->bindParam(':short_name', $unit_prefix);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();
            if ($count > 0) {
                // Unit already exists, return false
                return false;
            }
            $stmt = $pdo ->prepare("INSERT INTO unit (unit_type, short_name) VALUES (:unit_type, :short_name)");
            //bind parameters
            $stmt->bindParam(':unit_type', $unit_name);
            $stmt->bindParam(':short_name', $unit_prefix);
            if ($stmt->execute()) {
                // Unit added successfully
                return true;
            } else {
                // Error occurred
                return false;
            }
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function updateUnit($pdo){
        try {
            $unit_name = $_POST['unit_name'];
            $unit_prefix = $_POST['unit_prefix'];
            $update_ID = $_POST['update_id'];
            // Check if category with the same name already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM unit WHERE (unit_type = :unit_type OR short_name = :short_name) AND unit_id != :unit_id");
            $stmt->bindParam(':unit_type', $unit_name);
            $stmt->bindParam(':short_name', $unit_prefix);
            $stmt->bindParam(':unit_id', $update_ID, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            if ($count > 0) {
                // Unit already exists, return false
                return false;
            }
            $stmt = $pdo->prepare("UPDATE unit SET unit_type = :unit_type, short_name = :short_name WHERE unit_id = :unit_id");
            //bind parameters
            $stmt->bindParam(':unit_type', $unit_name);
            $stmt->bindParam(':short_name', $unit_prefix);
            $stmt->bindParam(':unit_id', $update_ID, PDO::PARAM_INT);
            if ($stmt->execute()) {
                // Unit Update successfully
                return true;
            } else {
                // Error occurred
                return false;
            }
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function addTax($pdo){
        try {
            $tax_name = $_POST['tax_name'];
            $tax_percentage = $_POST['tax_percentage'];
            // Check if tax with the same name already exists
            $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM tax WHERE tax_name = :tax_name OR tax_percentage = :tax_percentage");
            $stmt_check->bindParam(':tax_name', $tax_name);
            $stmt_check->bindParam(':tax_percentage', $tax_percentage, PDO::PARAM_INT);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();
            if ($count > 0) {
                // Tax already exists, return false
                return false;
            }
            $stmt = $pdo ->prepare("INSERT INTO tax (tax_name, tax_percentage) VALUES (:tax_name, :tax_percentage)");
            //bind parameters
            $stmt->bindParam(':tax_name', $tax_name);
            $stmt->bindParam(':tax_percentage', $tax_percentage, PDO::PARAM_INT);
            if ($stmt->execute()) {
                // Tax added successfully
                return true;
            } else {
                // Error occurred
                return false;
            }
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function updateTax($pdo){
        try {
            $tax_name = $_POST['tax_name'];
            $tax_percentage = $_POST['tax_percentage'];
            $update_ID = $_POST['update_id'];
            // Check if tax with the same name already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM tax WHERE (tax_name = :tax_name OR tax_percentage = :tax_percentage) AND tax_id != :tax_id");
            $stmt->bindParam(':tax_name', $tax_name);
            $stmt->bindParam(':tax_percentage', $tax_percentage, PDO::PARAM_INT);
            $stmt->bindParam(':tax_id', $update_ID, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            if ($count > 0) {
                // Tax already exists, return false
                return false;
            }
            $stmt = $pdo->prepare("UPDATE tax SET tax_name = :tax_name, tax_percentage = :tax_percentage WHERE tax_id = :tax_id");
            //bind parameters
            $stmt->bindParam(':tax_name', $tax_name);
            $stmt->bindParam(':tax_percentage', $tax_percentage, PDO::PARAM_INT);
            $stmt->bindParam(':tax_id', $update_ID, PDO::PARAM_INT);
            if ($stmt->execute()) {
                // Tax Update successfully
                return true;
            } else {
                // Error occurred
                return false;
            }
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getSKUID($pdo, $category_id){
        try {
            // Get category_id from the AJAX request
            if (!empty($category_id)) {
                // Fetch the category prefix
                $stmt = $pdo->prepare("SELECT category_prefix FROM category WHERE category_id = ?");
                $stmt->execute([$category_id]);
                $category_prefix = $stmt->fetchColumn();
            } else {
                // Use default category prefix for products without a category
                $category_prefix = "UNC";
            }
    
            // // Fetch the latest SKU for the category
            $query = "SELECT product_sku FROM product WHERE category_id = ? ORDER BY product_sku DESC LIMIT 1";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$category_id]);
    
            // If a SKU exists for the category, increment the last SKU number
            if ($stmt->rowCount() > 0) {
                $last_sku = $stmt->fetchColumn();
                $last_number = intval(substr($last_sku, strlen($category_prefix)));
                $next_sku = $category_prefix . sprintf('%05d', ++$last_number);
            } else {
                // If no SKU exists for the category, start from 1
                $next_sku = $category_prefix . '00001';
            }
            return $next_sku;
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getUnits($pdo){
        try {
            $query = "SELECT * FROM unit";
            $stmt = $pdo->prepare($query);
    
            $stmt ->execute();
            $units = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $units;
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getTaxs($pdo){
        try {
            $query = "SELECT * FROM tax
                        ORDER BY 
                CAST(SUBSTRING_INDEX(tax_name, ' ', 1) AS UNSIGNED) ASC";
            $stmt = $pdo->prepare($query);
    
            $stmt ->execute();
            $taxs = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $taxs;
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getBrand($pdo){
        try {
            $query = "SELECT * FROM brand";
            $stmt = $pdo->prepare($query);
    
            $stmt ->execute();
            $brands = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $brands;
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getProduct($pdo){
        try {
            $query = "SELECT * FROM product";
            $stmt = $pdo->prepare($query);
    
            $stmt ->execute();
            $products = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $products;
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getProductSummary($product_id, $pdo){
        try {
            $query = "SELECT
            a.product_name,
            a.product_description,
            c.brand_name,
            CASE
                WHEN b2.category_name IS NULL then b.category_name
                ELSE CONCAT(b2.category_name,'/', b.category_name)
            END AS category,
            a.product_sku,
            a.product_pp,
            a.product_sp,
            CASE
                WHEN COALESCE(SUM(g.item_qty), 0) >= a.product_min THEN 1
                WHEN COALESCE(SUM(g.item_qty), 0) < a.product_min AND COALESCE(SUM(g.item_qty), 0) !=0  THEN 2
                ELSE 3
            END AS status_id,
            f.tax_name,
            a.product_min,
            a.product_max,
            COALESCE(SUM(g.item_qty), 0) AS stocks,
            e.short_name AS unit
            FROM product a
            INNER JOIN category b ON b.category_id = a.category_id
            LEFT JOIN category b2 ON b.parent_category_id = b2.category_id
            INNER JOIN brand c ON c.brand_id = a.brand_id
            -- INNER JOIN status d
            INNER JOIN unit e ON e.unit_id = a.unit_id
            INNER JOIN tax f ON f.tax_id = a.tax_id
            LEFT JOIN item g ON g.product_sku = a.product_sku
            WHERE a.product_id = :product_id
            GROUP BY a.product_sku
            ";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    
            $stmt ->execute();
            $product = $stmt -> fetch(PDO::FETCH_ASSOC);
            return $product;
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getItembyID($product_id,$pdo){
        try {
            $query = "SELECT 
            a.item_sku,
            a.item_barcode,
            a.item_qty,
            a.item_expiry
            FROM item a
            INNER JOIN product b ON b.product_sku = a.product_sku
            WHERE b.product_id = :product_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt ->execute();
            $brands = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $brands;
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function addProduct($pdo){
        try {
            $sku_id = $_POST['sku_id'];
            $product_name = $_POST['product_name'];
            $purchase_price = $_POST['purchase_price'];
            $min_qty = $_POST['min_qty'];
            $max_qty = $_POST['max_qty'];
            
            //check product if exist
            $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM product WHERE product_name = :product_name");
            $stmt_check->bindParam(':product_name', $product_name);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();

            if ($count > 0) {
                // Category already exists, return false
                return false;
            }

            //if not empty category and units
            $product_desc = !empty($_POST['product_desc']) ? $_POST['product_desc'] : null;
            $brand_id = !empty($_POST['brand_id']) ? $_POST['brand_id'] : null;
            $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : null;
            $unit_id = !empty($_POST['unit_id']) ? $_POST['unit_id'] : null;
            $tax_id = !empty($_POST['tax_id']) ? $_POST['tax_id'] : null;

            $stmt = $pdo ->prepare("INSERT INTO product (product_name,product_description,brand_id,category_id,product_sku,product_pp,product_min,product_max,unit_id,tax_id) VALUES (:product_name, :product_description, :brand_id, :category_id, :product_sku, :product_pp, :product_min, :product_max, :unit_id, :tax_id)");

            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':product_description', $product_desc);
            $stmt->bindParam(':brand_id', $brand_id, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_sku', $sku_id);
            $stmt->bindParam(':product_pp', $purchase_price, PDO::PARAM_INT);
            $stmt->bindParam(':product_min', $min_qty, PDO::PARAM_INT);
            $stmt->bindParam(':product_max', $max_qty, PDO::PARAM_INT);
            $stmt->bindParam(':unit_id', $unit_id, PDO::PARAM_INT);
            $stmt->bindParam(':tax_id', $tax_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                // Product added successfully
                return true;
            } else {
                // Error occurred
                return false;
            }

        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function updateProduct($pdo){
        try {
            $sku_id = $_POST['sku_id'];
            $product_name = $_POST['product_name'];
            $purchase_price = $_POST['purchase_price'];
            $min_qty = $_POST['min_qty'];
            $max_qty = $_POST['max_qty'];
            $update_ID = $_POST['update_id'];
            //check product if exist
            $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM product WHERE product_name = :product_name AND product_id != :product_id");
            $stmt_check->bindParam(':product_name', $product_name);
            $stmt_check->bindParam(':product_id', $update_ID, PDO::PARAM_INT);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();

            if ($count > 0) {
                // Category already exists, return false
                return false;
            }

            //if not empty category and units
            $product_desc = !empty($_POST['product_desc']) ? $_POST['product_desc'] : null;
            $brand_id = !empty($_POST['brand_id']) ? $_POST['brand_id'] : null;
            $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : null;
            $unit_id = !empty($_POST['unit_id']) ? $_POST['unit_id'] : null;
            $tax_id = !empty($_POST['tax_id']) ? $_POST['tax_id'] : null;

            $stmt = $pdo ->prepare("UPDATE product SET product_name = :product_name,product_description =:product_description ,brand_id =:brand_id ,category_id =:category_id ,product_sku =:product_sku ,product_pp =:product_pp ,product_min =:product_min ,product_max = :product_max ,unit_id = :unit_id ,tax_id = :tax_id WHERE product_id = :product_id");
            
            $stmt->bindParam(':product_id', $update_ID, PDO::PARAM_INT);
            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':product_description', $product_desc);
            $stmt->bindParam(':brand_id', $brand_id, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_sku', $sku_id);
            $stmt->bindParam(':product_pp', $purchase_price, PDO::PARAM_INT);
            $stmt->bindParam(':product_min', $min_qty, PDO::PARAM_INT);
            $stmt->bindParam(':product_max', $max_qty, PDO::PARAM_INT);
            $stmt->bindParam(':unit_id', $unit_id, PDO::PARAM_INT);
            $stmt->bindParam(':tax_id', $tax_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                // Product updated successfully
                return true;
            } else {
                // Error occurred
                return false;
            }

        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function stockIN($pdo, $postData) {
        try {
            // Decode JSON data from AJAX POST
            if (is_array($postData)) {
                // Convert array to JSON-encoded string
                $postData = json_encode($postData);
            }
    
            // Decode JSON data
            $data = json_decode($postData, true);
    
            // Check if decoding was successful
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                return false; // Return false if JSON data is invalid
            }
    
            // Function to generate the next SKU
            function getNextSku($pdo, $prefix) {
                // Fetch the latest SKU for the prefix
                $stmt = $pdo->prepare("SELECT item_sku FROM item WHERE item_sku LIKE ? ORDER BY item_sku DESC LIMIT 1");
                $stmt->execute([$prefix . '%']);
    
                // If a SKU exists for the prefix, increment the last SKU number
                if ($stmt->rowCount() > 0) {
                    $last_sku = $stmt->fetchColumn();
                    $last_number = intval(substr($last_sku, strlen($prefix)));
                    return $prefix . sprintf('%05d', ++$last_number);
                } else {
                    // If no SKU exists for the prefix, start from 1
                    return $prefix . '00001';
                }
            }
    
            // Prepare the insert statement
            $stmt = $pdo->prepare("INSERT INTO item (item_sku, item_barcode, item_qty, item_expiry, product_sku, created_at) VALUES (:item_sku, :item_barcode, :item_qty, :item_expiry, :product_sku, :created_at)");
    
            foreach ($data as $product) {
                $product_sku = $product['product_sku'];
                foreach ($product['items'] as $item) {
                    // Assuming a common prefix "ITM" for all items
                    $prefix = 'ITM';
    
                    // Get the next SKU
                    $item_sku = getNextSku($pdo, $prefix);
    
                    // Execute the insert statement
                    $stmt->execute([
                        ':item_sku' => $item_sku,
                        ':item_barcode' => $item['barcode'],
                        ':item_qty' => $item['qty'],
                        ':item_expiry' => $item['expiry'],
                        ':product_sku' => $product_sku,
                        ':created_at' => date('Y-m-d H:i:s') // Add current datetime
                    ]);
                }
            }
    
            // Return true if the operation was successful
            return true;
        } catch (PDOException $e) {
            // Log or handle the database connection error
            return false; // Return false in case of error
        }
    }
    function updateCost($pdo){
        try{
            $selling_price = $_POST['selling_price'];
            $tax_id = !empty($_POST['tax_id']) ? $_POST['tax_id'] : null;
            $update_ID = $_POST['update_id'];

            $stmt = $pdo ->prepare("UPDATE product SET product_sp =:product_sp, tax_id=:tax_id WHERE product_id = :product_id");
            $stmt->bindParam(':product_id', $update_ID, PDO::PARAM_INT);
            $stmt->bindParam(':product_sp', $selling_price, PDO::PARAM_INT);
            $stmt->bindParam(':tax_id', $tax_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                // Cost updated successfully
                return true;
            } else {
                // Error occurred
                return false;
            }
        } catch (PDOException $e) {
            // Log or handle the database connection error
            return false; // Return false in case of error
        }
    }
    
?>
