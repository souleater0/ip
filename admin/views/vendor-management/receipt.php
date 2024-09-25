<?php 
$productlists = getProductList($pdo);
$selectProduct = '';
foreach ($productlists as $productlist) {
  $selectProduct .= '<option value="' . htmlspecialchars($productlist['product_name']) . '" data-sku="' . htmlspecialchars($productlist['product_sku']) . '" data-rate="' . htmlspecialchars($productlist['product_pp']) . '">'.htmlspecialchars($productlist['product_name']) . '</option>';
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
             <!-- Dropdown for Tax Options -->
          <select id="taxOption">
            <option value="1">Exclusive of Tax</option>
            <option value="2">Inclusive of Tax</option>
            <option value="3" selected>Out of Scope of Tax</option>
          </select>
            <table id="editableTable" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>SKU</th>
                  <th>Barcode</th>
                  <th>Qty</th>
                  <th>Rate</th>
                  <th>Amount</th>
                  <th>Tax</th>
                  <th>Customer</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody></tbody>
              <tfoot>
              <tr>
                <td colspan="8" class="text-dark text-end fw-bolder">Sub Total:</td>
                <td id="totalSubAmount" class="text-dark fw-bold">0.00</td>
              </tr>
              <tr>
                <td colspan="8" class="text-dark text-end fw-bolder">Total:</td>
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
  
  var table = $('#editableTable').DataTable({
    columns: [
      { title: "Product Name", data: "product_name", className: "text-dark" },
      { title: "SKU", data: "sku" },
      { title: "Barcode", data: "barcode" },
      { title: "Qty", data: "qty", className: "text-dark" },
      { title: "Rate", data: "rate", className: "text-dark"},
      { title: "Amount", data: "amount", className: "text-dark" },
      {
        title: "Tax", 
        data: "tax",
        className: "text-dark",
        render: function(data, type, row) {
        // Check if data is null, undefined, or an empty string
        if (data === null || data === undefined || data === '') {
          return null; // Display 0% if no data
        }
        return data + '%'; // Display as percentage if there is data
      }
      },
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
  var taxOption = $('#taxOption');
    var taxColumnIndex = 6; // Adjust this if the tax column index changes

    // Function to show/hide tax column based on the selected value
    function toggleTaxColumn() {
      var selectedValue = taxOption.val();

      if (selectedValue === "3") { // Out of Scope of Tax
        table.column(taxColumnIndex).visible(false); // Hide the tax column
        // Reset tax values for all rows
        table.rows().every(function() {
          var rowData = this.data();
          rowData.tax = null;
          this.data(rowData).draw(false); // Redraw row with tax set to null
        });
      } else {
        table.column(taxColumnIndex).visible(true); // Show the tax column
      }
    }


    // Call the function on page load to apply the initial state
    toggleTaxColumn();

    // Handle the change event of the dropdown
    taxOption.change(function() {
        toggleTaxColumn(); // Reuse the same logic on change
    });
  var currentlyEditingRow = null;

  function enterEditMode(row) {
  if (currentlyEditingRow) {
    saveChanges(currentlyEditingRow); // Save previous row before editing a new one
  }

  currentlyEditingRow = row; // Set currently editing row
  var rowData = table.row(row).data();
  var lastRow = $('#editableTable tbody tr').last();

  // If this is the last row, add a new row after editing starts
  if (row.is(lastRow)) {
    addNewRow();
  }

  // Check if the tax column is visible
  var isTaxVisible = table.column(6).visible();
  var fields = [
    '<select class="selected-product selectpicker form-control" data-live-search="true"><?php echo $selectProduct; ?></select>',
    '<input type="text" class="form-control sku" value="' + rowData.sku + '" readonly>',
    '<input type="text" class="form-control barcode" value="' + rowData.barcode + '">',
    '<input type="number" class="form-control qty" value="' + rowData.qty + '">',
    '<input type="number" class="form-control rate" value="' + rowData.rate + '">',
    '<input type="number" class="form-control amount" value="' + rowData.amount + '">'
  ];

  // Add the tax field only if visible
  if (isTaxVisible) {
    fields.push(
      '<select class="tax selectpicker form-control" data-live-search="true">' +
        '<option value="0">0%</option>' +
        '<option value="5">5%</option>' +
        '<option value="12">12%</option>' +
      '</select>'
    );
  }

  // Add the customer field (always visible)
  fields.push(
    '<select class="selected-customer selectpicker form-control" data-live-search="true">' +
      '<option value="">None</option>' +
      '<option value="Customer A">Customer A</option>' +
      '<option value="Customer B">Customer B</option>' +
    '</select>'
  );

  // Fill the row cells with the corresponding fields
  row.find('td').each(function(index) {
    $(this).html(fields[index]);
  });

  // Set values for the fields
  row.find('.selected-product').val(rowData.product_name).selectpicker('refresh');
  if (isTaxVisible) {
    row.find('.tax').val(rowData.tax || 0).selectpicker('refresh');
  }
  row.find('.selected-customer').val(rowData.customer).selectpicker('refresh');

  row.find('.edit-row').text('Save');

  // Reset tax value when "Out of Scope of Tax" is selected
  row.find('.tax').change(function() {
    if ($(this).val() === "3") { // Assuming "3" represents Out of Scope of Tax
      rowData.tax = null; // Set tax to null
      table.row(row).data(rowData); // Update the row data
      $(this).val(null); // Reset tax select
    }
  });
}



  // Function to add a new row to the table
  function addNewRow() {
    table.row.add({
      product_name: '',
      sku: '',
      barcode: '',
      qty: '',
      rate: '',
      amount: '',
      tax: '',
      customer: ''
    }).draw(false);
    updateTotalAmount();
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
      tax: table.column(6).visible() ? row.find('.tax').selectpicker('val') : null, // Get tax value only if column is visible
      customer: row.find('.selected-customer').selectpicker('val')
    };
    // console.log('Selected Data:', updatedData.product_name);  // For debugging
    table.row(row).data(updatedData).draw(false);
    updateTotalAmount();
    row.find('.edit-row').text('Edit');
    currentlyEditingRow = null;  // Reset currently editing row
  }

  $(document).on('changed.bs.select', '.selected-product', function (e, clickedIndex, isSelected, previousValue) {
    var selectedOption = $(this).find('option:selected');
    var sku = selectedOption.data('sku');  // Get the SKU from the selected option
    var rate = selectedOption.data('rate');  // Get the Rate from the selected option

    var row = $(this).closest('tr');  // Get the closest row of the table

    // Populate the SKU and Rate fields in the current row
    row.find('.sku').val(sku);
    row.find('.rate').val(rate);
    row.find('.qty').val(1);
    row.find('.amount').val((1 * rate).toFixed(2));
    updateTotalAmount();
  });

  $(document).on('changed.bs.select', '.tax', function (e, clickedIndex, isSelected, previousValue) {
    var row = $(this).closest('tr');  // Get the closest row of the table
    var tax = row.find('.tax').selectpicker('val');
    console.log(tax);
  });


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
      tax: '',
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

// Handle calculations for Qty, Rate, Amount based on tax selection
$('#editableTable').on('input', '.qty, .rate', function() {
    var row = $(this).closest('tr');
    var qty = parseFloat(row.find('.qty').val()) || 0;
    var rate = parseFloat(row.find('.rate').val()) || 0;

    var taxType = $('#taxOption').val();
    var amount = 0;

    // Calculate amount based on tax type
    if (taxType === "1") { // Exclusive of Tax
        amount = qty * rate;
    } else if (taxType === "2") { // Inclusive of Tax
        amount = qty * rate / (1 + (parseFloat(row.find('.tax').val()) || 0) / 100);
    } else if (taxType === "3") { // Out of Scope of Tax
        amount = qty * rate; // No tax applied
    }

    row.find('.amount').val(amount.toFixed(2));
    updateTotalAmount();
});

// Handle input for amount to update rate if needed
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
    
    if (currentlyEditingRow && currentlyEditingRow.is(row.node())) {
      // If the row being deleted is currently being edited, reset the editing state
      currentlyEditingRow = null;
    }

    // If there are more than 2 rows, remove the row
    if (table.rows().count() > 2) {
      row.remove().draw(false);
    } else {
      // If only 2 rows left, clear the row instead of removing it
      row.data({
        product_name: '',
        sku: '',
        barcode: '',
        qty: '',
        rate: '',
        amount: '',
        tax: '',
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
        tax: '',
        customer: ''
      }).draw(false);
    }
    updateTotalAmount();
  }

  // Initialize with 2 empty rows
  addEmptyRows(2);
});

</script>
