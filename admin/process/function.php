<?php
    function getModules($pdo){
        try {
            $query = "SELECT * FROM modules";
            $stmt = $pdo->prepare($query);
    
            $stmt ->execute();
            $modules = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $modules;
        }catch(PDOException $e){
                    // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getModulePermissions($pdo , $moduleID){
        try {
            $query = "SELECT * FROM permissions WHERE module_id = :module_id";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['module_id' => $moduleID]);
            $permissions = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $permissions;
        }catch(PDOException $e){
                    // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function userHasPermission ($pdo, $userId, $permissionName){
        try {
        $sql = "SELECT
        a.permission_name
        FROM permissions a
        JOIN role_permissions b ON b.permission_id = a.id
        JOIN roles c ON c.id = b.role_id
        JOIN users d ON d.role_id = c.id
        WHERE d.id = :user_id AND a.permission_name = :permission_name";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id'=> $userId, 'permission_name'=>$permissionName]);
        return $stmt->fetch() !==false;
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
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
            $password = password_hash('ecsadmin', PASSWORD_BCRYPT);
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
    function updateUser($pdo) {
        try {
            $pdo->beginTransaction();
    
            $update_ID = $_POST['update_id'];
            $user_display = $_POST['user_display'];
            $username = $_POST['username'];
            $user_role = $_POST['user_role'];
            $loginEnabled = !empty($_POST['loginEnabled']) ? '1' : '0';
    
            // Check if users with the same username or display name already exist (excluding the current user)
            $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE (username = :username OR display_name = :display_name) AND id != :id");
            $stmt_check->bindParam(':username', $username);
            $stmt_check->bindParam(':display_name', $user_display);
            $stmt_check->bindParam(':id', $update_ID, PDO::PARAM_INT);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();
    
            if ($count > 0) {
                // User with the same username or display name already exists, return false
                $pdo->rollBack();
                return array('success' => false, 'message' => 'Username or display name already exists.');
            }
    
            // Update user details without password
            $stmt = $pdo->prepare("UPDATE users SET username = :username, display_name = :display_name, role_id = :role_id, isEnabled = :isEnabled WHERE id = :id");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':display_name', $user_display);
            $stmt->bindParam(':role_id', $user_role, PDO::PARAM_INT);
            $stmt->bindParam(':isEnabled', $loginEnabled, PDO::PARAM_INT);
            $stmt->bindParam(':id', $update_ID, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                // User updated successfully
                $pdo->commit();
                return array('success' => true, 'message' => 'User updated successfully.');
            } else {
                // Error occurred
                $pdo->rollBack();
                return array('success' => false, 'message' => 'Error updating user.');
            }
        } catch(PDOException $e) {
            // Handle database connection error
            $pdo->rollBack();
            return array('success' => false, 'message' => 'Database error: ' . $e->getMessage());
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
    function getPermissionList($pdo){

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
    function getStockInNumber($pdo) {
        try {
            $query = "SELECT series_number FROM stockin_history ORDER BY series_number DESC LIMIT 1";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            
            // Check if there are any rows
            if ($stmt->rowCount() > 0) {
                $last_series_number = $stmt->fetchColumn();
                
                // Extract numeric part from series number (assuming format is "STK_IN00001")
                $numeric_part = intval(substr($last_series_number, 7)) + 1;
                
                // Format new series number with leading zeros
                $new_series_number = 'STK_IN' . str_pad($numeric_part, 5, '0', STR_PAD_LEFT);
            } else {
                // If no rows, start with the first series number
                $new_series_number = 'STK_IN00001';
            }
    
            return $new_series_number;
    
        } catch(PDOException $e) {
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return null; // Return null if an error occurs
        }
    }
    function getStockOutNumber($pdo) {
        try {
            $query = "SELECT series_number FROM stockout_history ORDER BY series_number DESC LIMIT 1";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            
            // Check if there are any rows
            if ($stmt->rowCount() > 0) {
                $last_series_number = $stmt->fetchColumn();
                
                // Extract numeric part from series number (assuming format is "STK_IN00001")
                $numeric_part = intval(substr($last_series_number, 7)) + 1;
                
                // Format new series number with leading zeros
                $new_series_number = 'STK_OUT' . str_pad($numeric_part, 5, '0', STR_PAD_LEFT);
            } else {
                // If no rows, start with the first series number
                $new_series_number = 'STK_OUT00001';
            }
    
            return $new_series_number;
    
        } catch(PDOException $e) {
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return null; // Return null if an error occurs
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
    function getCount_TotalProduct($pdo) {
        try {
            $query = "SELECT COUNT(*) AS total_products FROM product";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_products'];
        } catch (PDOException $e) {
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return 0; // Return 0 if an error occurs
        }
    }
    
    function getCount_TotalItems($pdo) {
        try {
            $query = "SELECT SUM(item_qty) AS total_items FROM item";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_items'];
        } catch (PDOException $e) {
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return 0; // Return 0 if an error occurs
        }
    }
    function getCount_OutofStock($pdo){
        try {
            $query = "SELECT COUNT(*) AS count
            FROM 
                product p
            LEFT JOIN 
                item i ON p.product_sku = i.product_sku
            GROUP BY 
                p.product_id
            HAVING COALESCE(SUM(i.item_qty), 0) = 0";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getCount_LowofStock($pdo) {
        try {
            $query = "SELECT COUNT(*) AS count
                      FROM (
                          SELECT 
                              p.product_id
                          FROM 
                              product p
                          LEFT JOIN 
                              item i ON p.product_sku = i.product_sku
                          GROUP BY 
                              p.product_id, p.product_min
                          HAVING 
                              COALESCE(SUM(i.item_qty), 0) < p.product_min
                              AND COALESCE(SUM(i.item_qty), 0) > 0
                      ) AS subquery";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return 0; // Return 0 if an error occurs
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
    function getLowofStock($pdo){
        try {
            $query = "SELECT 
                p.product_id, 
                p.product_name, 
                p.product_description, 
                p.product_sku, 
                p.product_min, 
                c.category_name,
                pc.category_name AS parent_category_name,
                COALESCE(SUM(i.item_qty), 0) AS total_stock_qty
            FROM 
                product p
            LEFT JOIN 
                item i ON p.product_sku = i.product_sku
            LEFT JOIN
                category c ON p.category_id = c.category_id
            LEFT JOIN
                category pc ON c.parent_category_id = pc.category_id
            GROUP BY 
                p.product_id, 
                p.product_name, 
                p.product_description, 
                p.product_sku, 
                p.product_min, 
                c.category_name,
                pc.category_name
            HAVING 
                total_stock_qty < p.product_min AND total_stock_qty > 0";
            $stmt = $pdo->prepare($query);
            $stmt ->execute();
            $lowStock = $stmt ->fetchAll(PDO::FETCH_ASSOC);
            return $lowStock;
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getOutofStock($pdo){
        try {
            $query = "SELECT 
                p.product_id, 
                p.product_sku, 
                p.product_name, 
                p.product_description, 
                c.category_name,
                pc.category_name AS parent_category_name,
                COALESCE(SUM(i.item_qty), 0) AS qty
            FROM 
                product p
            LEFT JOIN 
                item i ON p.product_sku = i.product_sku
            LEFT JOIN
                category c ON p.category_id = c.category_id
            LEFT JOIN
                category pc ON c.parent_category_id = pc.category_id
            GROUP BY 
                p.product_id, 
                p.product_name, 
                p.product_description, 
                p.product_sku, 
                p.product_min, 
                c.category_name,
                pc.category_name
            HAVING qty = 0";
            $stmt = $pdo->prepare($query);
            $stmt ->execute();
            $outOfStock = $stmt ->fetchAll(PDO::FETCH_ASSOC);
            return $outOfStock;
        }catch(PDOException $e){
            // Handle database connection error
            echo "Error: " . $e->getMessage();
            return array(); // Return an empty array if an error occurs
        }
    }
    function getItembyID($product_id, $pdo){
        try {
            $query = "SELECT 
                a.item_sku,
                a.item_barcode,
                a.item_qty,
                a.item_expiry,
                b.product_id,
                b.product_name,
                b.expiry_notice,
                DATEDIFF(a.item_expiry, NOW()) + 1 AS days_to_expiry
            FROM 
                item a
            INNER JOIN 
                product b ON b.product_sku = a.product_sku
            WHERE 
                b.product_id = :product_id
                AND a.item_expiry IS NOT NULL
            ORDER BY 
                a.item_expiry ASC";
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
            $expiry_notice = !empty($_POST['exp_notice']) ? $_POST['exp_notice'] : 30;

            $stmt = $pdo ->prepare("INSERT INTO product (product_name,product_description,brand_id,category_id,product_sku,product_pp,product_min,product_max,unit_id,tax_id,expiry_notice) VALUES (:product_name, :product_description, :brand_id, :category_id, :product_sku, :product_pp, :product_min, :product_max, :unit_id, :tax_id,:expiry_notice)");

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
            $stmt->bindParam(':expiry_notice', $expiry_notice, PDO::PARAM_INT);
            
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
            $expiry_notice = !empty($_POST['exp_notice']) ? $_POST['exp_notice'] : 30;

            $stmt = $pdo ->prepare("UPDATE product SET product_name = :product_name,product_description =:product_description ,brand_id =:brand_id ,category_id =:category_id ,product_sku =:product_sku ,product_pp =:product_pp ,product_min =:product_min ,product_max = :product_max ,unit_id = :unit_id ,tax_id = :tax_id, expiry_notice = :expiry_notice WHERE product_id = :product_id");
            
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
            $stmt->bindParam(':expiry_notice', $expiry_notice, PDO::PARAM_INT);

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

    function getCurrentInventoryCount($pdo, $product_sku) {
        $stmt = $pdo->prepare("SELECT SUM(item_qty) as total_qty FROM item WHERE product_sku = :product_sku");
        $stmt->execute([':product_sku' => $product_sku]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['total_qty'] : 0;
    }
    
    function stockIN($pdo, $postData) {
        try {
            if (is_array($postData)) {
                $postData = json_encode($postData);
            }
    
            $data = json_decode($postData, true);
    
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                return [
                    'success' => false,
                    'message' => 'Invalid JSON data!'
                ];
            }
    
            // Begin the transaction
            $pdo->beginTransaction();
    
            $series_number = $data['stockin_number'];
            $stmt_stockin = $pdo->prepare("INSERT INTO stockin_history (series_number) VALUES (:series_number)");
            $insert_stockin_history = $stmt_stockin->execute([':series_number' => $series_number]);
    
            if (!$insert_stockin_history) {
                $pdo->rollBack();
                return [
                    'success' => false,
                    'message' => 'Failed to insert into stockin_history!'
                ];
            }
    
            $stmt = $pdo->prepare("INSERT INTO pending_item (series_number, item_barcode, item_qty, item_expiry, product_sku, created_at) VALUES (:series_number, :item_barcode, :item_qty, :item_expiry, :product_sku, :created_at)");
    
            foreach ($data['items'] as $product) {
                $product_sku = $product['product_sku'];
    
                // Fetch product limits
                $stmt_product = $pdo->prepare("SELECT product_min, product_max FROM product WHERE product_sku = :product_sku");
                $stmt_product->execute([':product_sku' => $product_sku]);
                $product_limits = $stmt_product->fetch(PDO::FETCH_ASSOC);
    
                if (!$product_limits) {
                    $pdo->rollBack();
                    return [
                        'success' => false,
                        'message' => "Product with SKU $product_sku not found."
                    ];
                }
    
                $product_max = (int)$product_limits['product_max'];
                $current_count = getCurrentInventoryCount($pdo, $product_sku);
    
                foreach ($product['items'] as $item) {
                    // Calculate the new total count if the item is added
                    $new_total_count = $current_count + $item['qty'];
    
                    // Validate the item's quantity against the max limit
                    if ($new_total_count > $product_max) {
                        $pdo->rollBack();
                        return [
                            'success' => false,
                            'message' => "Adding item with barcode {$item['barcode']} exceeds the allowed maximum of $product_max for product SKU $product_sku."
                        ];
                    }
    
                    // Update the current count for the next iteration
                    $current_count = $new_total_count;
    
                    // Insert the item into the pending_item table
                    $stmt->execute([
                        ':series_number' => $series_number,
                        ':item_barcode' => $item['barcode'],
                        ':item_qty' => $item['qty'],
                        ':item_expiry' => $item['expiry'],
                        ':product_sku' => $product_sku,
                        ':created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
    
            // Commit the transaction
            $pdo->commit();
    
            return ['success' => true, 'message' => 'Stock has been recorded.'];
        } catch (PDOException $e) {
            // Rollback the transaction in case of an error
            $pdo->rollBack();
            return ['success' => false, 'message' => 'Failed to add stocks.'];
        }
    }
    function stockOut($pdo, $postData) {
        try {
            // Step 1: Handle input
            if (is_array($postData)) {
                $postData = json_encode($postData);
            }
    
            // Step 2: Decode JSON
            $data = json_decode($postData, true);
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                return ['success' => false, 'message' => 'Invalid JSON data!'];
            }
    
            // Step 3: Begin transaction
            $pdo->beginTransaction();
    
            // Step 4: Insert into stockout_history
            $stockoutNumber = $data['stockout_number'];
            $stmt_stockout = $pdo->prepare("INSERT INTO stockout_history (series_number, date, isAdded) VALUES (:series_number, NOW(), 1)");
            if (!$stmt_stockout->execute([':series_number' => $stockoutNumber])) {
                $pdo->rollBack();
                return ['success' => false, 'message' => 'Failed to insert into stockout_history!'];
            }
    
            // Step 5: Prepare pending_stock_out insert
            $stmt_pending = $pdo->prepare("INSERT INTO pending_stock_out (series_number, item_barcode, item_qty, item_expiry, product_sku, created_at) VALUES (:series_number, :item_barcode, :item_qty, :item_expiry, :product_sku, NOW())");
    
            // Step 6: Loop through items
            foreach ($data['items'] as $item) {
                $productSku = $item['product_sku'];
                $itemBarcode = $item['barcode'];
                $itemQty = $item['qty'];
                $itemExpiry = $item['expiry'];
    
                // Insert the item into pending_stock_out table
                $stmt_pending->execute([
                    ':series_number' => $stockoutNumber,
                    ':item_barcode' => $itemBarcode,
                    ':item_qty' => $itemQty,
                    ':item_expiry' => $itemExpiry,
                    ':product_sku' => $productSku
                ]);
    
                // Decrement the item in the item table
                $stmt_decrement = $pdo->prepare("UPDATE item SET item_qty = item_qty - :item_qty WHERE item_barcode = :item_barcode");
                $stmt_decrement->execute([
                    ':item_qty' => $itemQty,
                    ':item_barcode' => $itemBarcode
                ]);
    
                // Check if the item quantity is now zero and delete it if so
                $stmt_check = $pdo->prepare("SELECT item_qty FROM item WHERE item_barcode = :item_barcode");
                $stmt_check->execute([':item_barcode' => $itemBarcode]);
                $currentQty = $stmt_check->fetchColumn();
    
                // If quantity is zero, delete the item
                if ($currentQty === '0' || $currentQty === 0) {
                    $stmt_delete = $pdo->prepare("DELETE FROM item WHERE item_barcode = :item_barcode");
                    $stmt_delete->execute([':item_barcode' => $itemBarcode]);
                }
            }
    
            // Step 7: Commit transaction
            $pdo->commit();
            unset($_SESSION['picklist']);
            return ['success' => true, 'message' => 'Stock-out recorded successfully.'];
        } catch (PDOException $e) {
            // Rollback in case of error
            $pdo->rollBack();
            return ['success' => false, 'message' => 'Failed to process stock-out: ' . $e->getMessage()];
        }
    }
    
    
    // function stockOut($pdo, $postData) {
    //     try {
    //         // Step 1: Handle input
    //         if (is_array($postData)) {
    //             $postData = json_encode($postData);
    //         }
    
    //         // Step 2: Decode JSON
    //         $data = json_decode($postData, true);
    //         if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    //             return ['success' => false, 'message' => 'Invalid JSON data!'];
    //         }
    
    //         // Step 3: Begin transaction
    //         $pdo->beginTransaction();
    
    //         // Step 4: Insert into stockout_history
    //         $stockoutNumber = $data['stockout_number'];
    //         $stmt_stockout = $pdo->prepare("INSERT INTO stockout_history (series_number, date, isAdded) VALUES (:series_number, NOW(), 1)");
    //         if (!$stmt_stockout->execute([':series_number' => $stockoutNumber])) {
    //             $pdo->rollBack();
    //             return ['success' => false, 'message' => 'Failed to insert into stockout_history!'];
    //         }
    
    //         // Step 5: Prepare pending_stock_out insert
    //         $stmt_pending = $pdo->prepare("INSERT INTO pending_stock_out (series_number, item_barcode, item_qty, item_expiry, product_sku, created_at) VALUES (:series_number, :item_barcode, :item_qty, :item_expiry, :product_sku, NOW())");
    
    //         // Step 6: Loop through items
    //         foreach ($data['items'] as $item) {
    //             $productSku = $item['product_sku'];
    //             $itemBarcode = $item['barcode'];
    //             $itemQty = $item['qty'];
    //             $itemExpiry = $item['expiry'];

    //             // Insert the item into pending_stock_out table
    //             $stmt_pending->execute([
    //                 ':series_number' => $stockoutNumber,
    //                 ':item_barcode' => $itemBarcode,
    //                 ':item_qty' => $itemQty,
    //                 ':item_expiry' => $itemExpiry,
    //                 ':product_sku' => $productSku
    //             ]);

    //             //Decrement the item in the item table
    //             $stmt_decrement = $pdo->prepare("UPDATE item SET item_qty = item_qty - :item_qty WHERE item_barcode = :item_barcode");
    //             $stmt_decrement->execute([
    //                 ':item_qty' => $itemQty,
    //                 ':item_barcode' => $itemBarcode
    //             ]);
    //         }
    
    //         // Step 7: Commit transaction
    //         $pdo->commit();
    //         unset($_SESSION['picklist']);
    //         return ['success' => true, 'message' => 'Stock-out recorded successfully.'];
    //     } catch (PDOException $e) {
    //         // Rollback in case of error
    //         $pdo->rollBack();
    //         return ['success' => false, 'message' => 'Failed to process stock-out: ' . $e->getMessage()];
    //     }
    // }

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
    function addtoInventory($pdo, $series_number){
        try {
            $query_pendingItem = "SELECT * FROM pending_item WHERE series_number = :series_number";
            $stmt_pendingItem = $pdo->prepare($query_pendingItem);
            $stmt_pendingItem->bindParam(':series_number', $series_number);
            $check_pendingItem = $stmt_pendingItem->execute();
    
            if (!$check_pendingItem) {
                return false;
            }
    
            function getNextSku($pdo, $prefix) {
                $stmt = $pdo->prepare("SELECT item_sku FROM item WHERE item_sku LIKE ? ORDER BY item_sku DESC LIMIT 1");
                $stmt->execute([$prefix . '%']);
        
                if ($stmt->rowCount() > 0) {
                    $last_sku = $stmt->fetchColumn();
                    $last_number = intval(substr($last_sku, strlen($prefix)));
                    return $prefix . sprintf('%05d', ++$last_number);
                } else {
                    return $prefix . '00001';
                }
            }
    
            $pendingItems = $stmt_pendingItem->fetchAll(PDO::FETCH_ASSOC);
    
            if ($pendingItems) {
                $insertQuery = "INSERT INTO item (item_sku, item_barcode, item_qty, item_expiry, product_sku, created_at) 
                                VALUES (:item_sku, :item_barcode, :item_qty, :item_expiry, :product_sku, :created_at)";
                $stmtInsert = $pdo->prepare($insertQuery);
    
                // Start the transaction
                $pdo->beginTransaction();
                $allSuccessful = true;
    
                foreach ($pendingItems as $pendingItem) {
                    $product_sku = $pendingItem['product_sku'];
                    
                    // Fetch product limits
                    $stmt_product = $pdo->prepare("SELECT product_min, product_max FROM product WHERE product_sku = :product_sku");
                    $stmt_product->execute([':product_sku' => $product_sku]);
                    $product_limits = $stmt_product->fetch(PDO::FETCH_ASSOC);
    
                    if (!$product_limits) {
                        $pdo->rollBack();
                        return [
                            'success' => false,
                            'message' => "Product with SKU $product_sku not found."
                        ];
                    }
    
                    $product_max = (int)$product_limits['product_max'];
                    $current_count = getCurrentInventoryCount($pdo, $product_sku);
    
                    $new_total_count = $current_count + $pendingItem['item_qty'];
    
                    if ($new_total_count > $product_max) {
                        $pdo->rollBack();
                        return [
                            'success' => false,
                            'message' => "Adding item with barcode {$pendingItem['item_barcode']} exceeds the allowed maximum of $product_max for product SKU $product_sku."
                        ];
                    }
    
                    $current_count = $new_total_count;
                    $prefix = 'ITM';
                    $item_sku = getNextSku($pdo, $prefix);
                    
                    // Convert the barcode to uppercase
                    $uppercaseBarcode = strtoupper($pendingItem['item_barcode']);
                    
                    $stmtInsert->bindParam(':item_sku', $item_sku);
                    $stmtInsert->bindParam(':item_barcode', $uppercaseBarcode);
                    $stmtInsert->bindParam(':item_qty', $pendingItem['item_qty']);
                    $stmtInsert->bindParam(':item_expiry', $pendingItem['item_expiry']);
                    $stmtInsert->bindParam(':product_sku', $pendingItem['product_sku']);
                    $stmtInsert->bindParam(':created_at', $pendingItem['created_at']);
    
                    if (!$stmtInsert->execute()) {
                        $allSuccessful = false;
                        break;
                    }
                }
    
                if ($allSuccessful) {
                    $pdo->commit();
                    $updateStockStatus = $pdo->prepare("UPDATE stockin_history SET isAdded = :isAdded WHERE series_number = :series_number");
                    $updateStockStatus->execute([':isAdded' => 1, ':series_number' => $series_number]);
                    return true;
                } else {
                    $pdo->rollBack();
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    function getSuggestedbySystem($pdo, $picklist){
        // Placeholder for suggested items
        $suggestedItems = [];
    
        // Prepare placeholders for picklist product SKUs and quantities
        $picklistProductSKUs = [];
        $picklistQuantities = [];
        foreach ($picklist as $item) {
            $picklistProductSKUs[] = $item['product_sku'];
            $picklistQuantities[$item['product_sku']] = $item['product_qty'];
        }
    
        // Construct SQL query to fetch suggested items
        $sql = "SELECT
                p.product_sku,
                i.item_sku,
                i.item_barcode,
                p.product_name,
                i.item_qty,
                i.item_expiry,
                DATEDIFF(i.item_expiry, NOW()) + 1 AS days_to_expiry
            FROM
                item i
            JOIN
                product p ON i.product_sku = p.product_sku
            WHERE
                p.product_sku IN ('" . implode("','", $picklistProductSKUs) . "') 
                AND i.item_expiry IS NOT NULL
            ORDER BY
                i.item_expiry ASC;
        ";
    
        // Prepare statement
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    
        // Fetch suggested items
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product_sku = $row['product_sku'];
    
            // Calculate suggested quantity based on picklist and available quantity
            if (isset($picklistQuantities[$product_sku]) && $picklistQuantities[$product_sku] > 0) {
                $picklist_qty = $picklistQuantities[$product_sku];
                $available_qty = $row['item_qty'];
    
                // Determine suggested quantity
                $suggested_qty = min($picklist_qty, $available_qty);
    
                // Prepare suggested item
                $suggestedItems[] = [
                    'product_name' => $row['product_name'],
                    'product_sku' => $row['product_sku'],
                    'barcode' => $row['item_barcode'],
                    'expiry' => $row['item_expiry'],
                    'qty' => $suggested_qty
                ];
    
                // Adjust picklist quantity based on what's suggested
                $picklistQuantities[$product_sku] -= $suggested_qty;
            }
        }
    
        // Return array of suggested items
        return $suggestedItems;
    }
    function movetoWaste($pdo) {
        try {
            $pdo->beginTransaction();
            
            $void_card_input = $_POST['void_card'];
            $product_sku = $_POST['product_sku'];
            $product_barcode = $_POST['product_barcode'];
            $product_desc = $_POST['product_desc'];
            $qty = intval($_POST['qty']);
            $created_at = date('Y-m-d H:i:s');
    
            // Check if the void_card matches the value in the system option table
            $sql_check_void_card = "SELECT option_value FROM system_option WHERE option_name = 'void_card'";
            $stmt_check_void_card = $pdo->prepare($sql_check_void_card);
            $stmt_check_void_card->execute();
            $system_option = $stmt_check_void_card->fetch(PDO::FETCH_ASSOC);
    
            if ($system_option && $system_option['option_value'] === $void_card_input) {
                // Retrieve necessary information
                $sql = "
                    SELECT
                        p.product_sku,
                        p.product_name,
                        p.product_pp,
                        c.category_name,
                        i.item_barcode,
                        i.item_qty,
                        i.item_expiry
                    FROM
                        item i
                    JOIN
                        product p ON i.product_sku = p.product_sku
                    JOIN
                        category c ON p.category_id = c.category_id
                    WHERE
                        i.item_barcode = :item_barcode AND p.product_sku = :product_sku;
                ";
        
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':item_barcode', $product_barcode);
                $stmt->bindParam(':product_sku', $product_sku);
                $stmt->execute();
                $item = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($item) {
                    // Decrement or remove items from the item table
                    $remaining_qty = $item['item_qty'] - $qty;
                    if ($remaining_qty <= 0) {
                        $stmt_delete = $pdo->prepare("DELETE FROM item WHERE item_barcode = :item_barcode");
                        $stmt_delete->bindParam(':item_barcode', $product_barcode);
                        $stmt_delete->execute();
                    } else {
                        $stmt_update = $pdo->prepare("UPDATE item SET item_qty = :item_qty WHERE item_barcode = :item_barcode");
                        $stmt_update->bindParam(':item_qty', $remaining_qty, PDO::PARAM_INT);
                        $stmt_update->bindParam(':item_barcode', $product_barcode);
                        $stmt_update->execute();
                    }
        
                    // Insert a new waste entry
                    $stmt_insert_waste = $pdo->prepare("
                        INSERT INTO waste (product_sku, product_name, product_pp, category_name, item_barcode, item_qty, item_expiry, waste_reason, created_at)
                        VALUES (:product_sku, :product_name, :product_pp, :category_name, :item_barcode, :item_qty, :item_expiry, :waste_reason, :created_at)
                    ");
                    $stmt_insert_waste->bindParam(':product_sku', $item['product_sku']);
                    $stmt_insert_waste->bindParam(':product_name', $item['product_name']);
                    $stmt_insert_waste->bindParam(':product_pp', $item['product_pp']);
                    $stmt_insert_waste->bindParam(':category_name', $item['category_name']);
                    $stmt_insert_waste->bindParam(':item_barcode', $item['item_barcode']);
                    $stmt_insert_waste->bindParam(':item_qty', $qty, PDO::PARAM_INT);
                    $stmt_insert_waste->bindParam(':item_expiry', $item['item_expiry']);
                    $stmt_insert_waste->bindParam(':waste_reason', $product_desc);
                    $stmt_insert_waste->bindParam(':created_at', $created_at);
                    $stmt_insert_waste->execute();
        
                    $pdo->commit();
                    return array('success' => true, 'message' => 'Item moved to waste successfully.');
                } else {
                    $pdo->rollBack();
                    return array('success' => false, 'message' => 'Item not found.');
                }
            } else {
                $pdo->rollBack();
                return array('success' => false, 'message' => 'Void card does not match.');
            }
        } catch (PDOException $e) {
            // Handle database connection error
            $pdo->rollBack();
            return array('success' => false, 'message' => 'Database error: ' . $e->getMessage());
        }
    }    
    function addRole($pdo){
        $roleName = $_POST['role_name'];
        $permissions = $_POST['selected_permission'];

        try {
            // Start a transaction
            $pdo->beginTransaction();
    
            // Insert the new role into the roles table (if you have one)
            $stmt = $pdo->prepare("INSERT INTO roles (role_name) VALUES (:role_name)");
            $stmt->execute(['role_name' => $roleName]);
    
            // Get the ID of the newly inserted role
            $roleId = $pdo->lastInsertId();
    
            // Insert the permissions into the role_permissions table
            $stmt = $pdo->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)");
    
            foreach ($permissions as $permissionId) {
                $stmt->execute(['role_id' => $roleId, 'permission_id' => $permissionId]);
            }
            // Commit the transaction
            $pdo->commit();
            return array('success' => true, 'message' => 'Role and permissions added successfully!');
        } catch (Exception $e) {
            // Roll back the transaction if something failed
            $pdo->rollBack();
            return array('success' => false, 'message' => 'Failed to add role and permissions' . $e->getMessage());
        }
    }
    function getRolePermissions($pdo) {
        $roleId = $_POST['role_id'];
        try {
            // Fetch the permissions associated with the role
            $stmt = $pdo->prepare("SELECT permission_id FROM role_permissions WHERE role_id = :role_id");
            $stmt->execute(['role_id' => $roleId]);
            $permissions = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
            // Fetch the role name (assuming you want to display it as well)
            $stmt = $pdo->prepare("SELECT role_name FROM roles WHERE id = :role_id");
            $stmt->execute(['role_id' => $roleId]);
            $roleName = $stmt->fetchColumn();
    
            return array('success' => true, 'role_name' => $roleName, 'permissions' => $permissions);
        } catch (Exception $e) {
            return array('success' => false, 'message' => 'Failed to fetch role permissions: ' . $e->getMessage());
        }
    }
    function updateRole($pdo) {
        $roleId = $_POST['role_id'];
        $roleName = $_POST['role_name'];
        $permissions = $_POST['selected_permission'];
    
        try {
            // Start a transaction
            $pdo->beginTransaction();
    
            // Update the role name in the roles table
            $stmt = $pdo->prepare("UPDATE roles SET role_name = :role_name WHERE id = :role_id");
            $stmt->execute(['role_name' => $roleName, 'role_id' => $roleId]);
    
            // Delete existing permissions for the role
            $stmt = $pdo->prepare("DELETE FROM role_permissions WHERE role_id = :role_id");
            $stmt->execute(['role_id' => $roleId]);
    
            // Insert the updated permissions into the role_permissions table
            $stmt = $pdo->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)");
    
            foreach ($permissions as $permissionId) {
                $stmt->execute(['role_id' => $roleId, 'permission_id' => $permissionId]);
            }
    
            // Commit the transaction
            $pdo->commit();
            return array('success' => true, 'message' => 'Role and permissions updated successfully!');
        } catch (Exception $e) {
            // Roll back the transaction if something failed
            $pdo->rollBack();
            return array('success' => false, 'message' => 'Failed to update role and permissions: ' . $e->getMessage());
        }
    }
    
?>
