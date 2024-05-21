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
            default:
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
