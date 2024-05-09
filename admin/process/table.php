<?php
    require_once '../../config.php';
    $stmt = $pdo -> query ('SELECT c.category_id,c.category_name AS category_name,c.parent_category_id, p.category_name AS parent_category_name
    FROM category c
    LEFT JOIN category p ON c.parent_category_id = p.category_id
    ORDER BY c.category_id');
    $data = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['data' => $data]);
?>
