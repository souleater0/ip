<?php 
$productlists = getProductList($pdo);
$selectProduct = '';
foreach ($productlists as $productlist) {
  $selectProduct .= '<option value="' . htmlspecialchars($productlist['product_name']) . '">' . htmlspecialchars($productlist['product_name']) . '</option>';
}
?>
<div class="body-wrapper-inner">
  <div class="container-fluid mw-100">
    <div class="row py-3">
      <div class="col">
        <h3>Transaction</h3>
      </div>
      <div class="col">
        <div class="dropdown float-end">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            New Transaction
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#transactionModal" data-form="bill">Bill</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#transactionModal" data-form="expense">Expense</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#transactionModal" data-form="invoice">Invoice</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Manage Transaction</h5>
          </div>
        </div>
      </div>
      <div class="card-body">

      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="transactionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bolder" id="transactionModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <!-- Placeholder for dynamic form -->
        <div id="dynamicFormContent">
          <!-- Bill form -->
          <form id="billForm" class="dynamic-form" style="display:none;">
            <div class="row">
              <div class="col-2">
                <label for="supplier" class="form-label">Supplier</label >
                <select class="selectpicker form-control" id="supplier" name="supplier" data-live-search="true">
                  <option value="1">Supplier A</option>
                  <option value="2">Supplier B</option>
                </select>
              </div>
              <div class="row py-3">
                <div class="col-2">
                  <div>
                    <label for="exampleFormControlTextarea1" class="form-label">Mailing Address</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
                </div>
                <div class="col-2">
                  <div>
                  <label for="startDate" class="form-label">Bill Date</label>
                  <input id="startDate" class="form-control" type="date" />
                  </div>
                </div>
                <div class="col-2">
                  <div>
                  <label for="startDate" class="form-label">Due Date</label>
                  <input id="startDate" class="form-control" type="date" />
                  </div>
                </div>
                <div class="col-2">
                  <div>
                    <label for="exampleFormControlInput1" class="form-label">Bill No.</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1">
                  </div>
                </div>
              </div>
            </div>
            </form>
            <form id="expenseForm" class="dynamic-form" style="display:none;">
              <div class="row mb-3">
                <div class="col-2">
                  <label for="supplier" class="form-label">Payee</label >
                  <select class="selectpicker form-control" name="supplier" data-live-search="true">
                    <option value="1">Supplier A</option>
                    <option value="2">Supplier B</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-2">
                    <div>
                    <label for="payment_Date" class="form-label">Bill Date</label>
                    <input id="payment_Date" class="form-control" type="date" />
                    </div>
                </div>
                <div class="col-2">
                  <label for="paymentMethod" class="form-label">Payee</label >
                  <select class="selectpicker form-control" name="paymentMethod" data-live-search="true">
                    <option value="1">CASH</option>
                    <option value="2">GCASH</option>
                    <option value="3">CREDIT CARD</option>
                  </select>
                </div>
                <div class="col-2">
                  <div>
                    <label for="refNo" class="form-label">Ref No.</label>
                    <input type="text" class="form-control" id="refNo">
                  </div>
                </div>
              </div>
            </form>
            <!-- Table for items -->
            <table id="editableTable" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>SKU</th>
                  <th>Barcode</th>
                  <th>Qty</th>
                  <th>Rate</th>
                  <th>Amount</th>
                  <th>Customer</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody></tbody>
              <tfoot>
              <tr>
                <td colspan="7" class="text-dark text-end fw-bolder">Total:</td>
                <td id="totalAmount" class="text-dark fw-bold">0.00</td>
              </tr>
            </tfoot>
            </table>
            <!-- Buttons to add and clear rows -->
            <button id="addRow" type="button" class="btn btn-success btn-sm">Add Row</button>
            <button id="clearRows" type="button" class="btn btn-danger btn-sm">Clear All</button>

            <div class="row">
              <div class="col-2">
                <div>
                  <label for="exampleFormControlTextarea1" class="form-label">Remarks</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
              </div>
              <div class="col-3">
                <label for="formFile" class="form-label">Attachment</label>
                <input class="form-control" type="file" id="formFile">
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitForm">Save & Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('.dropdown-item').on('click', function() {
    var formType = $(this).data('form');
    $('.dynamic-form').hide();
    $('#' + formType + 'Form').show();
    var newTitle = $(this).text();
    $('#transactionModalLabel').text(newTitle);
  });

  $('.selected-product').change(function () {  
    
  });

  var table = $('#editableTable').DataTable({
    columns: [
      { title: "Product Name", data: "product_name", className: "text-dark" },
      { title: "SKU", data: "sku" },
      { title: "Barcode", data: "barcode" },
      { title: "Qty", data: "qty", className: "text-dark" },
      { title: "Rate", data: "rate", className: "text-dark"},
      { title: "Amount", data: "amount", className: "text-dark" },
      { title: "Customer", data: "customer" },
      {
        title: "Actions", 
        data: null,
        defaultContent: `
          <button type="button" class="btn btn-primary btn-sm edit-row">Edit</button>
          <button type="button" class="btn btn-danger btn-sm delete-row">Delete</button>`
      }
    ],
    paging: false,
    ordering: false,
    searching: false,
    autoWidth: false
  });

  var currentlyEditingRow = null;

  // Function to enter edit mode
  function enterEditMode(row) {
    if (currentlyEditingRow) {
      saveChanges(currentlyEditingRow);  // Save previous row before editing a new one
    }
    
    currentlyEditingRow = row;  // Set currently editing row
    var rowData = table.row(row).data();
    row.find('td').each(function(index) {
      if (index === 0) {
        $(this).html('<select class="selected-product selectpicker form-control" data-live-search="true">' +
                   '<?php echo $selectProduct; ?>' +
                   '</select>');
      // Set the value after the selectpicker is added to the DOM
      var selectProduct = $(this).find('.selected-product');
      selectProduct.val(rowData.product_name);
      selectProduct.selectpicker('refresh');  // Refresh selectpicker to apply changes
      } else if (index === 1) {
        $(this).html('<input type="text" class="form-control sku" value="' + rowData.sku + '">');
      } else if (index === 2) {
        $(this).html('<input type="text" class="form-control barcode" value="' + rowData.barcode + '">');
      } else if (index === 3) {
        $(this).html('<input type="number" class="form-control qty" value="' + rowData.qty + '">');
      } else if (index === 4) {
        $(this).html('<input type="number" class="form-control rate" value="' + rowData.rate + '">');
      } else if (index === 5) {
        $(this).html('<input type="number" class="form-control amount" value="' + rowData.amount + '">');
      } else if (index === 6) {
        $(this).html('<select class="selected-customer selectpicker form-control" data-live-search="true">' +
                   '<option value="">None</option>' +
                   '<option value="Customer A">Customer A</option>' +
                   '<option value="Customer B">Customer B</option>' +
                   '</select>');
      // Set the value after the selectpicker is added to the DOM
      var selectCustomer = $(this).find('.selected-customer');
      selectCustomer.val(rowData.customer);
      selectCustomer.selectpicker('refresh');  // Refresh selectpicker to apply changes
      }
    });
    row.find('.edit-row').text('Save');
  }

  // Function to save changes
  function saveChanges(row) {
    var updatedData = {
      product_name: row.find('.selected-product').selectpicker('val'),
      sku: row.find('.sku').val(),
      barcode: row.find('.barcode').val(),
      qty: row.find('.qty').val(),
      rate: row.find('.rate').val(),
      amount: row.find('.amount').val(),
      customer: row.find('.selected-customer').selectpicker('val')
    };
    console.log('Selected Data:', updatedData.product_name);  // For debugging
    table.row(row).data(updatedData).draw(false);
    updateTotalAmount();
    row.find('.edit-row').text('Edit');
    currentlyEditingRow = null;  // Reset currently editing row
  }

  // Handle double-click on a row to trigger edit mode
  $('#editableTable tbody').on('dblclick', 'tr', function() {
    var row = $(this);
    if (row.find('.edit-row').text() === 'Edit') {
      enterEditMode(row);
    }
  });

  // Handle Enter key press to trigger save
  $('#editableTable tbody').on('keydown', 'input, select', function(event) {
    if (event.key === "Enter") {
      var row = $(this).closest('tr');
      saveChanges(row);
    }
  });

  // Handle Edit button click
  $('#editableTable tbody').on('click', '.edit-row', function() {
    var row = $(this).closest('tr');
    if ($(this).text() === 'Edit') {
      enterEditMode(row);
    } else {
      saveChanges(row);
    }
  });

  // Handle clicking outside row to exit edit mode
  $(document).on('click', function(e) {
    if (currentlyEditingRow && !$(e.target).closest('tr').is(currentlyEditingRow)) {
      saveChanges(currentlyEditingRow);
    }
  });

  // Other existing functionality...
  
  // Add Row button
  $('#addRow').on('click', function() {
    table.row.add({
      product_name: '',
      sku: '',
      barcode: '',
      qty: '',
      rate: '',
      amount: '',
      customer: ''
    }).draw(false);
    updateTotalAmount();
  });

  // Clear Rows button
  $('#clearRows').on('click', function() {
    table.clear().draw(false); // Clear all rows
    addEmptyRows(2); // Add 2 default empty rows
    updateTotalAmount();
  });

  // Handle calculations for Qty, Rate, and Amount
  $('#editableTable').on('input', '.qty, .rate', function() {
    var row = $(this).closest('tr');
    var qty = parseFloat(row.find('.qty').val()) || 0;
    var rate = parseFloat(row.find('.rate').val()) || 0;
    row.find('.amount').val((qty * rate).toFixed(2));
    updateTotalAmount();
  });

  $('#editableTable').on('input', '.amount', function() {
    var row = $(this).closest('tr');
    var qty = parseFloat(row.find('.qty').val()) || 0;
    var amount = parseFloat($(this).val()) || 0;
    if (qty > 0) {
      row.find('.rate').val((amount / qty).toFixed(2));
    }
    updateTotalAmount();
  });

  // Handle Delete button
  $('#editableTable tbody').on('click', '.delete-row', function() {
    var row = table.row($(this).closest('tr'));
    if (table.rows().count() > 2) {
      row.remove().draw(false);
    } else {
      row.data({
        product_name: '',
        sku: '',
        barcode: '',
        qty: '',
        rate: '',
        amount: '',
        customer: ''
      }).draw(false);
    }
    updateTotalAmount();
  });

  // Form submission
  $('#submitForm').on('click', function() {
    var formData = table.rows().data().toArray();
    console.log(formData);
  });

  // Calculate total amount
  function updateTotalAmount() {
    var total = 0;
    table.rows().every(function() {
      var data = this.data();
      total += parseFloat(data.amount) || 0;
    });
    $('#totalAmount').text(total.toFixed(2));
  }

  // Initialize table with 2 empty rows
  function addEmptyRows(numRows) {
    for (var i = 0; i < numRows; i++) {
      table.row.add({
        product_name: '',
        sku: '',
        barcode: '',
        qty: '',
        rate: '',
        amount: '',
        customer: ''
      }).draw(false);
    }
    updateTotalAmount();
  }

  // Initialize with 2 empty rows
  addEmptyRows(2);
});

</script>
