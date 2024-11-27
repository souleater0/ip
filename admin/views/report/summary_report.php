<div class="body-wrapper-inner">
  <div class="container-fluid mw-100">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row align-items-end">
        <div class="col">
          <label for="product_sku" class="form-label">Transaction Type</label>
            <select class="selectpicker form-control" id="product_sku" name="product_sku" data-live-search="true">
                <option value="none">All</option>
                <option value="bill">Bill</option>
                <option value="expense">Expense</option>
                <option value="invoice">Invoice</option>
            </select>
          </div>
          <div class="col">
            <label for="dateFilter" class="form-label">Filter Date</label>
            <select id="dateFilter" class="form-control">
                <option value="all">All Date</option>
                <option value="custom">Custom Range</option>
            </select>
          </div>
          <div id="dateRangeFields" class="col d-none">
              <div class="row">
                <div class="col">
                    <input type="date" id="start_date" class="form-control mb-1" value="<?php echo date('Y-m-d'); ?>" placeholder="Start Date" />
                </div>
                <div class="col">
                <input type="date" id="end_date" class="form-control" value="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" placeholder="End Date" />
              </div>
              </div>
          </div>
          <div class="col">
            <button class="btn btn-primary btn-sm text-uppercase mt-auto" id="generateReportBtn">
              <iconify-icon icon="line-md:search" width="15" height="15"></iconify-icon>&nbsp; Generate
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Summary Report</h5>
          </div>
          <div class="col">
          </div>
        </div>
      </div>
      <div class="card-body">
      <div id="printArea">
            <h1>Invoice</h1>
            <p>Invoice #12345</p>
            <p>Customer Name: John Doe</p>
            <p>Total Amount: $100.00</p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function () {
    // Toggle custom date fields based on filter selection
    $('#dateFilter').on('change', function () {
        const isCustom = $(this).val() === 'custom';
        $('#dateRangeFields').toggleClass('d-none', !isCustom);
    });

    $("#printButton").click(function () {
        var printContents = $("#printArea").html(); // Get content of the print area
        var printWindow = window.open("", "_blank"); // Open a new tab/window
        
        // Write the content into the new window
        printWindow.document.open();
        printWindow.document.write(`
            <html>
                <head>
                    <title>Print Preview</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 20px;
                        }
                    </style>
                </head>
                <body>
                    ${printContents}
                </body>
            </html>
        `);
        printWindow.document.close();

        // Trigger the print dialog
        printWindow.print();

        // Optional: Close the print window after printing
        printWindow.onafterprint = function () {
            printWindow.close();
        };
    });
});

</script>