<?php
// Retrieve and sanitize the filter parameters from the URL
$sku = isset($_GET['sku']) ? htmlspecialchars($_GET['sku']) : '';
$transactionType = isset($_GET['transactionType']) ? htmlspecialchars($_GET['transactionType']) : 'none';
$dateFilter = isset($_GET['dateFilter']) ? htmlspecialchars($_GET['dateFilter']) : '';
$startDate = isset($_GET['startDate']) ? htmlspecialchars($_GET['startDate']) : '';
$endDate = isset($_GET['endDate']) ? htmlspecialchars($_GET['endDate']) : '';

// Call the function to retrieve product and transactions
$data = getProductAndTransactions($pdo, $sku, $transactionType, $dateFilter, $startDate, $endDate);
$product = $data['product'];
$transactionResult = $data['transactions'];
?>

<div class="body-wrapper-inner">
  <div class="container-fluid mw-100">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Detailed Report</h5>
          </div>
          <div class="col text-end">
            <?php if ($product && $transactionResult): ?>
              <!-- Export Buttons -->
              <button id="exportPdf" class="btn btn-danger">Export to PDF</button>
              <button id="exportExcel" class="btn btn-success">Export to Excel</button>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php if ($product): ?>
          <h3>Product: <?php echo htmlspecialchars($product['product_name']); ?></h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Transaction Type</th>
                <th>Date of Transaction</th>
                <th>Transaction No</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($transactionResult): ?>
                <?php foreach ($transactionResult as $transaction): ?>
                  <tr>
                    <td class="text-dark"><?php echo ucfirst(htmlspecialchars($transaction['transaction_type'])); ?></td>
                    <td class="text-dark"><?php echo date('Y-m-d', strtotime($transaction['created_at'])); ?></td>
                    <td class="text-dark"><?php echo htmlspecialchars($transaction['transaction_no']); ?></td>
                    <td class="text-dark"><?php echo htmlspecialchars($transaction['product_name']); ?></td>
                    <td class="text-dark"><?php echo htmlspecialchars($transaction['item_qty']); ?></td>
                    <td class="text-dark"><?php echo number_format($transaction['item_rate'], 2); ?></td>
                    <td class="text-dark"><?php echo number_format($transaction['item_amount'], 2); ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7">No transactions found for the given criteria.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>No product found with the given SKU.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  // Trigger export to PDF
  $('#exportPdf').click(function() {
    exportData('pdf');
  });

  // Trigger export to Excel
  $('#exportExcel').click(function() {
    exportData('excel');
  });

  function exportData(format) {
    // Get data from PHP variables
    var sku = '<?php echo htmlspecialchars($sku, ENT_QUOTES, "UTF-8"); ?>';
    var transactionType = '<?php echo htmlspecialchars($transactionType, ENT_QUOTES, "UTF-8"); ?>';
    var dateFilter = '<?php echo htmlspecialchars($dateFilter, ENT_QUOTES, "UTF-8"); ?>';
    var startDate = '<?php echo htmlspecialchars($startDate, ENT_QUOTES, "UTF-8"); ?>';
    var endDate = '<?php echo htmlspecialchars($endDate, ENT_QUOTES, "UTF-8"); ?>';
    var transactions = <?php echo json_encode($transactionResult); ?>;

    // Prepare the request data
    var requestData = {
      format: format,
      sku: sku,
      transactionType: transactionType,
      dateFilter: dateFilter,
      startDate: startDate,
      endDate: endDate,
      transactions: transactions
    };

    // Make AJAX call to export data
    $.ajax({
      url: 'admin/process/export_detail.php', // Change the URL as necessary
      type: 'POST',
      data: JSON.stringify(requestData), // Send data as JSON
      contentType: 'application/json', // Set content type to JSON
      dataType: 'json', // Expect JSON response
      success: function(response) {
        if (response.success) {
          // If format is PDF, open in a new tab with base64-encoded PDF
          if (format === 'pdf') {
            var pdfUrl = response.pdfUrl;
            var win = window.open();
            win.document.write('<iframe src="' + pdfUrl + '" width="100%" height="100%"></iframe>');
          } else if (format === 'excel') {
            // Handle Excel file generation if needed
            window.location.href = response.excelUrl;
          }
        } else {
          alert('Export failed: ' + response.message || 'An error occurred.');
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX Error: ', status, error); // Log any AJAX errors
        alert('An error occurred while exporting the data.');
      }
    });
  }
});

</script>
