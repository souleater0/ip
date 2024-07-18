<?php
    require_once '../../config.php';

    // Check if a table type is provided in the request
    if (isset($_GET['table_type'])) {
        $tableType = $_GET['table_type'];

        // Define SQL query based on the table type
        switch ($tableType) {
            case 'product':
                $sql = 'SELECT
                a.product_id,
                a.product_name,
                a.product_description,
                c.brand_id,
                c.brand_name,
                CASE
                    WHEN b2.category_name IS NULL then b.category_id
                    ELSE b2.category_id
                END AS category_id,
                CASE
                    WHEN b2.category_name IS NULL then b.category_name
                    ELSE CONCAT(b2.category_name," / ", b.category_name)
                END AS category,
                a.product_sku,
                a.product_pp,
                a.product_sp,
                CASE
                        WHEN COALESCE(SUM(g.item_qty), 0) >= a.product_min THEN 1
                        WHEN COALESCE(SUM(g.item_qty), 0) < a.product_min AND COALESCE(SUM(g.item_qty), 0) !=0  THEN 2
                        ELSE 3
                END AS status_id,
                a.product_min,
                a.product_max,
                a.tax_id,
                a.expiry_notice,
                a.unit_id,
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
                GROUP BY a.product_sku';
                break;
            case 'category':
                $sql = 'SELECT c.category_id, c.category_name AS category_name, c.category_prefix, c.parent_category_id, p.category_name AS parent_category_name
                        FROM category c
                        LEFT JOIN category p ON c.parent_category_id = p.category_id
                        ORDER BY c.category_id';
                break;
            case 'brand':
                $sql = 'SELECT * FROM brand
                        ORDER BY brand_name ASC';
                break;
            case 'unit':
                $sql = 'SELECT * FROM unit
                        ORDER BY unit_type ASC';
                break;
            case 'tax':
                $sql = 'SELECT * FROM tax
                        ORDER BY tax_percentage ASC';
                break;
            case 'costing':
                $sql = 'SELECT
                a.product_id,
                a.product_name,
                a.product_description,
                c.brand_id,
                c.brand_name,
                CASE
                    WHEN b2.category_name IS NULL then b.category_id
                    ELSE b2.category_id
                END AS category_id,
                CASE
                    WHEN b2.category_name IS NULL then b.category_name
                    ELSE CONCAT(b2.category_name," / ", b.category_name)
                END AS category,
                a.product_sku,
                a.product_pp,
                CAST(ROUND(a.product_sp * (1 + f.tax_percentage / 100), 2) AS DECIMAL(10, 2)) as product_sp,
                CASE
                        WHEN COALESCE(SUM(g.item_qty), 0) >= a.product_min THEN 1
                        WHEN COALESCE(SUM(g.item_qty), 0) < a.product_min AND COALESCE(SUM(g.item_qty), 0) !=0  THEN 2
                        ELSE 3
                END AS status_id,
                a.product_min,
                a.product_max,
                a.tax_id,
                f.tax_name,
                a.unit_id,
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
                GROUP BY a.product_sku';
                break;
            case 'users':
                $sql = 'SELECT
                a.id,
                a.display_name,
                a.username,
                a.role_id,
                b.role_name,
                a.isEnabled,
                CASE 
                    WHEN a.isEnabled = 1 THEN "Enabled"
                    ELSE "Disabled"
                END as status
                FROM users a
                INNER JOIN roles b ON b.id = a.role_id
                ORDER BY display_name ASC';
                break;
                case 'roles':
                    $sql = 'SELECT * FROM roles
                    ORDER BY role_name ASC';
                    break;
            case 'pending-stockin':
                $sql = 'SELECT
                a.id,
                a.series_number,
                DATE_FORMAT(a.date, "%M %d, %Y %h:%i %p") as date,
                a.isAdded
                FROM stockin_history a';
                break;
            case 'item-details':
                if (isset($_GET['series_number'])) {
                    $seriesNumber = $_GET['series_number'];
                    $sql = 'SELECT
                                b.product_name,
                                a.item_qty AS quantity,
                                a.item_barcode,
                                a.item_expiry
                            FROM pending_item a
                            INNER JOIN product b ON b.product_sku = a.product_sku
                            WHERE a.series_number = :series_number';
                    
                    // Prepare and execute the statement
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['series_number' => $seriesNumber]);
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode(['data' => $data]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Series number not specified']);
                    exit;
                }
                break;
            case 'item-details-stockout':
                if (isset($_GET['series_number'])) {
                    $seriesNumber = $_GET['series_number'];
                    $sql = 'SELECT
                                b.product_name,
                                a.item_qty AS quantity,
                                a.item_barcode,
                                a.item_expiry
                            FROM pending_stock_out a
                            INNER JOIN product b ON b.product_sku = a.product_sku
                            WHERE a.series_number = :series_number';
                    
                    // Prepare and execute the statement
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['series_number' => $seriesNumber]);
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode(['data' => $data]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Series number not specified']);
                    exit;
                }
                break;
            case 'pending-stockout':
                $sql = 'SELECT
                a.id,
                a.series_number,
                DATE_FORMAT(a.date, "%M %d, %Y %h:%i %p") as date,
                a.isAdded
                FROM stockout_history a';
                break;
            case 'item-details':
                if (isset($_GET['series_number'])) {
                    $seriesNumber = $_GET['series_number'];
                    $sql = 'SELECT
                                b.product_name,
                                a.item_qty AS quantity,
                                a.item_barcode,
                                a.item_expiry
                            FROM pending_item a
                            INNER JOIN product b ON b.product_sku = a.product_sku
                            WHERE a.series_number = :series_number';
                    
                    // Prepare and execute the statement
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['series_number' => $seriesNumber]);
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode(['data' => $data]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Series number not specified']);
                    exit;
                }
                break;
            case 'expiring_soon':
                $sql = 'SELECT
                    p.product_id,
                    i.item_id,
                    i.item_sku,
                    i.item_barcode,
                    i.item_qty,
                    i.item_expiry,
                    p.product_name,
                    p.expiry_notice,
                    DATEDIFF(i.item_expiry, NOW()) + 1 AS days_to_expiry
                FROM 
                    item i
                JOIN 
                    product p ON i.product_sku = p.product_sku
                WHERE 
                    DATEDIFF(i.item_expiry, NOW()) + 1 <= p.expiry_notice
                    AND i.item_expiry IS NOT NULL
                ORDER BY 
                    i.item_expiry ASC';
                break;
            default:
            case 'waste':
                $sql ='SELECT * FROM waste
                ORDER BY created_at ASC';
                break;
            // If an invalid or unsupported table type is provided, return an error
            echo json_encode(['error' => 'Unsupported table type']);
            exit;
        }
    // Execute the query
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['data' => $data]);
    }else{
        echo json_encode(['error' => 'Table type not specified']);
    }
?>
