<?php
session_start();

// Check if picklist data is stored in session
if (!isset($_SESSION['picklist']) || empty($_SESSION['picklist'])) {
    echo 'No picklist data found';
    exit;
}

// Get picklist data from session
$picklist = $_SESSION['picklist'];

// Example function to get suggested items based on the picklist
// function getSuggestedItems($picklist) {
//     // Replace with your actual logic to get suggested items
//     $suggestedItems = [
//         [
//             'product_name' => 'Red Mongo 340g',
//             'product_sku' => 'SRP00001',
//             'barcode' => 'ITM00001',
//             'expiry' => '2024-07-15',
//             'qty' => 3
//         ],
//         [
//             'product_name' => 'Red Mongo 340g',
//             'product_sku' => 'SRP00001',
//             'barcode' => 'ITM00002',
//             'expiry' => '2025-07-15',
//             'qty' => 2
//         ],
//         [
//             'product_name' => 'Green Kaong 340g',
//             'product_sku' => 'SRP00002',
//             'barcode' => 'ITM00001',
//             'expiry' => '2025-07-16',
//             'qty' => 2
//         ]
//     ];
//     return $suggestedItems;
// }

// Get suggested items
// $suggestedItems = getSuggestedItems($picklist);

$suggestedItems = getSuggestedbySystem($pdo, $picklist);
?>

<div class="body-wrapper-inner">
  <div class="container-fluid" style="max-width: 100% !important;">
    <div class="row">
    <div class="col-lg-6">
        <div class="card shadow-sm">
        <div class="card-header bg-transparent border-bottom">
            <div class="row">
            <div class="col">
                <h5 class="mt-1 mb-0">Pick List</h5>
            </div>
            </div>
        </div>
        <div class="card-body">
                <table id="picklistTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($picklist as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($item['product_sku']); ?></td>
                                <td><?php echo htmlspecialchars($item['product_qty']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm">
        <div class="card-header bg-transparent border-bottom">
            <div class="row">
            <div class="col">
                <h5 class="mt-1 mb-0">Suggested by System</h5>
            </div>
            </div>
        </div>
        <div class="card-body">
            <table id="suggestedItemsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Barcode</th>
                        <th>Expiry</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($suggestedItems as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($item['product_sku']); ?></td>
                            <td><?php echo htmlspecialchars($item['barcode']); ?></td>
                            <td><?php echo htmlspecialchars($item['expiry']); ?></td>
                            <td><?php echo htmlspecialchars($item['qty']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <div class="row">
                <div class="col">
                    <h5 class="mt-1 mb-0">Validate Items</h5>
                </div>
                </div>
            </div>
            <div class="card-body">
                <table id="validateItemTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Barcode</th>
                            <th>Expiry</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($suggestedItems as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($item['product_sku']); ?></td>
                                <td><?php echo htmlspecialchars($item['barcode']); ?></td>
                                <td><?php echo htmlspecialchars($item['expiry']); ?></td>
                                <td><?php echo htmlspecialchars($item['qty']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
  </div>
</div>

    <script>
        $(document).ready(function() {
            $('#picklistTable').DataTable({
                order: [[1, 'asc']],
                paging: true,
                scrollCollapse: true,
                scrollX: true,
                scrollY: 300,
                responsive: true,
                autoWidth: false,
                columnDefs: [
                    {
                        targets: 0, // First column
                        className: 'text-dark text-start' // Add your class name here
                    },
                    {
                        targets: 1, // Second column
                        className: 'text-dark text-start' // Add another class name if needed
                    },
                    {
                        targets: 2, // Second column
                        className: 'text-dark text-start' // Add another class name if needed
                    },
                ]
            });
            
            $('#suggestedItemsTable').DataTable({
                order: [[1, 'asc']],
                paging: true,
                scrollCollapse: true,
                scrollX: true,
                scrollY: 300,
                responsive: true,
                autoWidth: false,
                columnDefs: [
                    {
                        targets: 0, // First column
                        className: 'text-dark text-start' // Add your class name here
                    },
                    {
                        targets: 1, // Second column
                        className: 'text-dark text-start' // Add another class name if needed
                    },
                    {
                        targets: 2, // Second column
                        className: 'text-dark text-start' // Add another class name if needed
                    },
                    {
                        targets: 3, // Second column
                        className: 'text-dark text-start' // Add another class name if needed
                    },
                    {
                        targets: 4, // Second column
                        className: 'text-dark text-start' // Add another class name if needed
                    },
                ]
            });
            $('#validateItemTable').DataTable({
                order: [[1, 'asc']],
                paging: true,
                scrollCollapse: true,
                scrollX: true,
                scrollY: 300,
                responsive: true,
                autoWidth: false,
                columnDefs: [
                    {
                        targets: 0, // First column
                        className: 'text-dark text-start' // Add your class name here
                    },
                    {
                        targets: 1, // Second column
                        className: 'text-dark text-start' // Add another class name if needed
                    },
                    {
                        targets: 2, // Second column
                        className: 'text-dark text-start' // Add another class name if needed
                    },
                    {
                        targets: 3, // Second column
                        className: 'text-dark text-start' // Add another class name if needed
                    },
                    {
                        targets: 4, // Second column
                        className: 'text-dark text-start' // Add another class name if needed
                    },
                ]
            });
        });
    </script>

