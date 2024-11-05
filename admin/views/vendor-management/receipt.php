<?php 
$productlists = getProductList($pdo);
$supplierlists = getSupplierList($pdo);
$customerlists = getCustomerList($pdo);
$selectProduct = '';
foreach ($productlists as $productlist) {
  $selectProduct .= '<option value="' . htmlspecialchars($productlist['product_name']) . '" data-sku="' . htmlspecialchars($productlist['product_sku']) . '" data-rate-purchase="' . htmlspecialchars($productlist['product_pp']) . '" data-rate-sell="' . htmlspecialchars($productlist['product_sp']) . '">'.htmlspecialchars($productlist['product_name']) . '</option>';
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
<div class="modal fade" id="transactionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="transactionModalLabel">
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
                <select class="selectpicker form-control" id="bill_supplier" name="bill_supplier" data-live-search="true" required>
                  <?php foreach ($supplierlists as $suplierlist):?>
                    <option value="<?php echo $suplierlist['id'];?>"><?php echo $suplierlist['vendor_name'];?></option>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="row py-3">
                <div class="col-2">
                  <div>
                    <label for="exampleFormControlTextarea1" class="form-label">Mailing Address</label>
                    <textarea class="form-control" id="bill_address" name="bill_address" rows="3"></textarea>
                  </div>
                </div>
                <div class="col-2">
                  <div>
                  <label for="bill_start_date" class="form-label">Bill Date</label>
                  <input id="bill_start_date" name="bill_start_date" class="form-control" type="date" required/>
                  </div>
                </div>
                <div class="col-2">
                  <div>
                  <label for="bill_end_date" class="form-label">Due Date</label>
                  <input id="bill_end_date" name="bill_end_date" class="form-control" type="date" required/>
                  </div>
                </div>
                <div class="col-2">
                  <div>
                    <label for="billNo" class="form-label">Bill No.</label>
                    <input type="text" class="form-control" id="billNo" required>
                  </div>
                </div>
              </div>
            </div>
            </form>
            <form id="expenseForm" class="dynamic-form" style="display:none;">
              <div class="row mb-3">
                <div class="col-2">
                  <label for="supplier" class="form-label">Payee</label >
                  <select class="selectpicker form-control" id="expense_supplier" name="expense_supplier" data-live-search="true">
                    <?php foreach ($supplierlists as $suplierlist):?>
                      <option value="<?php echo $suplierlist['id'];?>"><?php echo $suplierlist['vendor_name'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-2">
                    <div>
                    <label for="expense_date" class="form-label">Payment Date</label>
                    <input id="expense_date" name="expense_date" class="form-control" type="date" />
                    </div>
                </div>
                <div class="col-2">
                  <label for="expense_payment" class="form-label">Payment Method</label >
                  <select class="selectpicker form-control" id="expense_payment" name="expense_payment" data-live-search="true">
                    <option value="CASH">CASH</option>
                    <option value="GCASH">GCASH</option>
                    <option value="CREDIT CARD">CREDIT CARD</option>
                  </select>
                </div>
                <div class="col-2">
                  <div>
                    <label for="expense_ref_no" class="form-label">Ref No.</label>
                    <input type="text" class="form-control" id="expense_ref_no" name="expense_ref_no">
                  </div>
                </div>
              </div>
            </form>
            <form id="invoiceForm" class="dynamic-form" style="display:none;">
              <div class="row">
                <div class="col-6">
                  <div class="row mb-3">
                  <div class="col-3">
                      <label for="invoice_customer" class="form-label">Customer</label >
                      <select class="select-customer selectpicker form-control" id="invoice_customer" name="invoice_customer" data-live-search="true" required>
                        <?php foreach ($customerlists as $customerlist):?>
                          <option value="<?php echo $customerlist['id'];?>" data-customer-email="<?php echo $customerlist['customer_email'];?>"><?php echo $customerlist['customer_name'];?></option>
                        <?php endforeach;?>
                      </select>
                  </div>
                  <div class="col-3">
                      <label for="invoice_customer_email" class="form-label">Customer Email</label>
                      <input type="text" class="form-control" id="invoice_customer_email" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-3">
                    <label for="invoice_bill_address" class="form-label">Billing Address</label>
                    <textarea class="form-control" id="invoice_bill_address" name="invoice_bill_address" rows="3"></textarea>
                  </div>
                  <div class="col-3">
                    <label for="invoice_date" class="form-label">Invoice Date</label>
                    <input id="invoice_date" name="invoice_date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>"/>
                  </div>
                  <div class="col-3">
                    <label for="invoice_duedate" class="form-label">Due Date</label>
                    <input id="invoice_duedate" name="invoice_duedate" class="form-control" type="date" value="<?php echo date('Y-m-d', strtotime('+1 days')); ?>"/>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-3">
                    <label for="invoice_ship_address" class="form-label">Shipping to</label>
                    <textarea class="form-control" id="invoice_ship_address" name="invoice_ship_address" rows="3"></textarea>
                  </div>
                  <div class="col-3">
                      <label for="invoice_via" class="form-label">Ship Via</label>
                      <input type="text" class="form-control" id="invoice_via" required>
                  </div>
                  <div class="col-3">
                    <label for="expense_date" class="form-label">Shipping Date</label>
                    <input id="expense_date" name="expense_date" class="form-control" type="date" />
                  </div>
                  <div class="col-3">
                      <label for="invoice_customer_email" class="form-label">Tracking No.</label>
                      <input type="text" class="form-control" id="invoice_customer_email" required>
                  </div>
                </div>
                </div>
                <div class="col-6">
                  <div class="row mt-3 mr-3">
                    <div class="col-12">
                      <h6 class="text-end">BALANCE DUE</h6>
                    </div>
                    <div class="col-12">
                      <h1 class="text-end fw-bolder">₱0.00</h1>
                    </div>
                    <div class="col-12">
                      <div class="float-end">
                        <button type="button" class="btn btn-md btn-secondary rounded">Make Payment</button>
                      </div>
                    </div>
                    <div class="col-12 mt-5">
                      <div class="col-3 float-end">
                        <label for="invoice_no" class="form-label">Invoice No.</label>
                        <input type="text" class="form-control" id="invoice_no" required readonly>
                      </div>
                    </div>
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
            <table id="editableTable" class="table table-hover table-bordered w-100">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>SKU</th>
                  <th>Barcode</th>
                  <th>Expiry Date</th>
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
                <td colspan="9" class="text-dark text-end fw-bolder">Sub Total:</td>
                <td id="lblSubAmount" class="text-dark fw-bold" data-sub-total="0.00">0.00</td>
              </tr>
              <tr>
                <td colspan="9" class="text-dark text-end fw-bolder">Tax:</td>
                <td id="lblTaxAmount" class="text-dark fw-bold" data-total-tax="0.00">0.00</td>
              </tr>
              <tr>
                <td colspan="9" class="text-dark text-end fw-bolder">Total:</td>
                <td id="lblAmount" class="text-dark fw-bold" data-grand-total="0.00">0.00</td>
              </tr>
              <input type="hidden" id="totalSubAmount" value="0">
              <input type="hidden" id="totalTaxAmount" value="0">
              <input type="hidden" id="totalAmount" value="0">

            </tfoot>
            </table>
            <!-- Buttons to add and clear rows -->
            <button id="addRow" type="button" class="btn btn-success btn-sm">Add Row</button>
            <button id="clearRows" type="button" class="btn btn-danger btn-sm">Clear All</button>

            <div class="row">
              <form id="attachForm">
              <div class="col-2">
                <div>
                  <label for="attach_Remarks" class="form-label">Remarks</label>
                  <textarea class="form-control" id="attach_Remarks" rows="3"></textarea>
                </div>
              </div>
              <div class="col-3">
                <label for="attach_File" class="form-label">Attachment</label>
                <input class="form-control" type="file" id="attach_File">
              </div>
              </form>
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


$('[data-form]').on('click', function() {
  var formType = $(this).data('form');

  // Reset form inputs
  $('#billForm')[0].reset();
  $('#expenseForm')[0].reset();
  clearRows();
  if (formType === 'bill') {
    $('#expenseForm').hide();
    $('#invoiceForm').hide();
    $('#billForm').show();
    $('#transactionModalLabel').text('Bill');  // Set modal title for Bill
  } else if (formType === 'expense') {
    $('#billForm').hide();
    $('#invoiceForm').hide();
    $('#expenseForm').show();
    $('#transactionModalLabel').text('Expense');  // Set modal title for Expense
  } else if (formType === 'invoice') {
    $('#billForm').hide();
    $('#expenseForm').hide();
    $('#invoiceForm').show();
    $('#transactionModalLabel').text('Invoice');  // Set modal title for Expense
  }
  
  
});
  // $('.dropdown-item').on('click', function() {
  //   var formType = $(this).data('form');
  //   $('.dynamic-form').hide();
  //   $('#' + formType + 'Form').show();
  //   var newTitle = $(this).text();
  //   $('#transactionModalLabel').text(newTitle);
  // });
  
  var table = $('#editableTable').DataTable({
    columns: [
      { title: "Product Name", data: "product_name", className: "text-dark" },
      { title: "SKU", data: "sku"},
      { title: "Barcode", data: "barcode", className: "text-dark" },
      { title: "Expiry Date", data: "expiry", className: "text-dark" },
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
    autoWidth: true
  });
  var taxOption = $('#taxOption');
    var taxColumnIndex = 7; // Adjust this if the tax column index changes

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
        table.rows().every(function() {
          var rowData = this.data();
          rowData.tax = null;
          this.data(rowData).draw(false); // Redraw row with tax set to null
        });
      }
    }


    // Call the function on page load to apply the initial state
    toggleTaxColumn();

    // Handle the change event of the dropdown
    taxOption.change(function() {
        toggleTaxColumn(); // Reuse the same logic on change
        updateTotalAmount();
    });
  var currentlyEditingRow = null;
  function enterEditMode(row) {
    if (currentlyEditingRow) {
      // Attempt to save changes for the currently editing row
      if (!saveChanges(currentlyEditingRow)) {
        return;  // Exit if save was not successful
      }
    }

    currentlyEditingRow = row; // Set currently editing row
    var rowData = table.row(row).data();
    var lastRow = $('#editableTable tbody tr').last();

    // If this is the last row, add a new row after editing starts
    if (row.is(lastRow)) {
      addNewRow();
    }

  // Check if the tax column is visible
  var isTaxVisible = table.column(7).visible();
  var fields = [
    '<select class="selected-product selectpicker form-control col-auto" data-live-search="true"><?php echo $selectProduct; ?></select>',
    '<input type="text" class="form-control sku col-auto" value="' + rowData.sku + '" readonly>',
    '<input type="text" class="form-control barcode col-auto" value="' + rowData.barcode + '">',
    '<input type="date" class="form-control expiry col-auto" value="' + rowData.expiry + '">',
    '<input type="number" class="form-control qty col-auto" min="1" value="' + rowData.qty + '">',
    '<input type="number" class="form-control rate col-auto" min="1" value="' + rowData.rate + '">',
    '<input type="number" class="form-control amount col-auto" min="1" value="' + rowData.amount + '">'
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
      expiry: '',
      qty: '',
      rate: '',
      amount: '',
      tax: '',
      customer: ''
    }).draw(false);
    updateTotalAmount();
  }

  function saveChanges(row) {
    // Check if all input fields are empty
    var allEmpty = true;

    row.find('input, select').each(function() {
        var value = $(this).selectpicker ? $(this).selectpicker('val') : $(this).val().trim();
        if (value) {
            allEmpty = false; // Found a non-empty field
        }
    });

    if (allEmpty) {
        // Clear all fields
        row.find('input, select').val('').trigger('change'); // Clear input fields and trigger change for selectpicker
        row.find('.edit-row').text('Edit'); // Reset edit button text
        currentlyEditingRow = null; // Reset currently editing row
        return true; // Indicate success
    }

    var isValid = true;
    var errorMessages = []; // Use a Set to collect unique error messages

    function validateField(selector, fieldName, type) {
        var field = row.find(selector);
        var value = field.selectpicker ? field.selectpicker('val') : field.val().trim();

        switch (type) {
            case 'required':
                if (!value || value.length === 0) {
                    isValid = false;
                    errorMessages.push(fieldName + ' is required.'); // Add to Set
                    field.addClass('is-invalid');
                }
                break;
            case 'number':
                var value = field.val().trim();
                const floatValue = parseFloat(value.replace(/,/g, ''));
                if (isNaN(floatValue) || floatValue < 0) {
                    isValid = false;
                    errorMessages.push(fieldName + ' must be a positive number.'); // Add to Set
                    field.addClass('is-invalid');
                }
                break;
            case 'positiveNumber':
                var positiveValue = parseFloat(value.replace(/,/g, '')); // Use parseFloat for decimal support
                if (isNaN(positiveValue) || positiveValue < 0) { // Must be greater than or equal to 0
                    isValid = false;
                    errorMessages.push(fieldName + ' must be 0 or greater.'); // Updated message
                    field.addClass('is-invalid');
                }
                break;
        }
    }

    // Validate each field
    validateField('.selected-product', 'Product', 'required');
    validateField('.qty', 'Quantity', 'number');
    validateField('.rate', 'Rate', 'number');
    validateField('.amount', 'Amount', 'number');

    if (table.column(7).visible()) {
        validateField('.tax', 'Tax', 'positiveNumber');
    }

    // Check if all validations passed
    if (!isValid) {
        toastr.error(errorMessages[0]);
        return false; // Stop the save process
    }

    // Prepare updated data if validation is successful
    var updatedData = {
        product_name: row.find('.selected-product').selectpicker('val'),
        sku: row.find('.sku').val(),
        barcode: row.find('.barcode').val(),
        expiry: row.find('.expiry').val(),
        qty: parseInt(row.find('.qty').val(), 10) || 0,
        rate: parseFloat(row.find('.rate').val()) || 0,
        amount: parseFloat(row.find('.amount').val()) || 0,
        tax: table.column(7).visible() ? row.find('.tax').selectpicker('val') : null,
        customer: row.find('.selected-customer').selectpicker('val')
    };

    // Update the table with the new data
    table.row(row).data(updatedData).draw(false);
    updateTotalAmount();
    row.find('.edit-row').text('Edit');
    currentlyEditingRow = null; // Reset currently editing row

    // Remove all 'is-invalid' classes after successful save
    row.find('.is-invalid').removeClass('is-invalid');

    return true; // Indicate success
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
      expiry: '',
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
    clearRows();
  });

  $(document).on('changed.bs.select', '.selected-product', function (e, clickedIndex, isSelected, previousValue) {
    var selectedOption = $(this).find('option:selected');
    var sku = selectedOption.data('sku');  // Get the SKU from the selected option

    // Determine the active form type
    var formType = $('#billForm:visible').length ? 'bill' : $('#expenseForm:visible').length ? 'expense' : 'invoice';

    console.log('Form Type:', formType);
    // Choose the appropriate rate based on form type
    var rate;
    if (formType === 'bill' || formType === 'expense') {
        rate = selectedOption.data('rate-purchase');  // For bill and expense, use purchase price
    } else if (formType === 'invoice') {
        rate = selectedOption.data('rate-sell');  // For invoice, use selling price
    }

    console.log(rate);
    var row = $(this).closest('tr');  // Get the closest row of the table

    // Populate the SKU and Rate fields in the current row
    row.find('.sku').val(sku);
    row.find('.rate').val(rate);
    row.find('.qty').val(1);
    row.find('.amount').val((1 * rate).toFixed(2));
    updateTotalAmount();
  });




  // $(document).on('changed.bs.select', '.selected-product', function (e, clickedIndex, isSelected, previousValue) {
  //   var selectedOption = $(this).find('option:selected');
  //   var sku = selectedOption.data('sku');  // Get the SKU from the selected option
  //   var rate = selectedOption.data('rate');  // Get the Rate from the selected option

  //   var row = $(this).closest('tr');  // Get the closest row of the table

  //   // Populate the SKU and Rate fields in the current row
  //   row.find('.sku').val(sku);
  //   row.find('.rate').val(rate);
  //   row.find('.qty').val(1);
  //   row.find('.amount').val((1 * rate).toFixed(2));
  //   updateTotalAmount();
  // });
  $(document).on('changed.bs.select', '.select-customer', function (e, clickedIndex, isSelected, previousValue) {
    var selectedOption = $(this).find('option:selected');
    var customer_email = selectedOption.data('customer-email');

    $('#invoice_customer_email').val(customer_email);
  });
// Update the total amount after selecting a new tax value from the picker
$(document).on('changed.bs.select', '.tax', function (e, clickedIndex, isSelected, previousValue) {
    var row = $(this).closest('tr');  // Get the current row
    var qty = parseFloat(row.find('.qty').val()) || 0;  // Get quantity
    var rate = parseFloat(row.find('.rate').val()) || 0;  // Get base rate
    var taxRate = parseFloat($(this).selectpicker('val')) || 0;  // Get the selected tax rate

    var taxType = $('#taxOption').val();  // Fetch the selected tax type
    var amount = 0;

    // Calculate amount based on tax type
    if (taxType === "1") {  // Exclusive of Tax
        amount = qty * rate;  // Calculate amount without tax
        row.find('.amount').val(amount.toFixed(2));  // Update the amount in the row
    } else if (taxType === "2") {  // Inclusive of Tax
        // Amount includes tax, calculate rate
        amount = qty * rate / (1 + taxRate / 100);  // Adjust amount to exclude tax
        row.find('.amount').val(amount.toFixed(2));  // Update the amount in the row
    } else if (taxType === "3") {  // Out of Scope of Tax
        amount = qty * rate;  // No tax applied, just the base amount
        row.find('.amount').val(amount.toFixed(2));  // Update the amount in the row
    }

    // Update total amounts at the bottom
    updateTotalAmount();
});

// Handle calculations for Qty, Rate, and Amount based on tax selection
$('#editableTable').on('input', '.qty, .rate', function() {
    var row = $(this).closest('tr');  // Get the current row
    var qty = parseFloat(row.find('.qty').val()) || 0;  // Get quantity
    var rate = parseFloat(row.find('.rate').val()) || 0;  // Get base rate

    var taxRate = parseFloat(row.find('.tax').selectpicker('val')) || 0;  // Get the selected tax rate
    var taxType = $('#taxOption').val();  // Fetch the selected tax type
    
    var amount = 0;

    // Calculate amount based on tax type
    if (taxType === "1") {  // Exclusive of Tax
        // Amount is just qty * rate (no changes)
        amount = qty * rate;
        row.find('.amount').val(amount.toFixed(2));  // Update the amount in the row (without tax)
    } else if (taxType === "2") {  // Inclusive of Tax
        // For Inclusive of Tax, calculate amount based on qty and rate
        amount = qty * rate / (1 + taxRate / 100);  // Adjust amount to exclude tax
        row.find('.amount').val(amount.toFixed(2));  // Update the amount in the row
    } else if (taxType === "3") {  // Out of Scope of Tax
        amount = qty * rate;  // No tax applied, just the base amount
        row.find('.amount').val(amount.toFixed(2));  // Update the amount in the row (without tax)
    }

    // Update total amounts at the bottom
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
// Update the total amount and tax at the bottom
function updateTotalAmount() {
    var subtotal = 0;
    var totalTax = 0;
    var grandTotal = 0;
    var taxType = $('#taxOption').val();  // Fetch the selected tax type

    // Iterate over each row to calculate subtotal and tax
    table.rows().every(function() {
        var data = this.data();
        var rowAmount = parseFloat(data.amount) || 0;  // Subtotal for each row
        var taxRate = parseFloat(data.tax) || 0;  // Get the selected tax rate
        var rate = parseFloat(data.rate) || 0;  // Get the base rate

        // For Inclusive tax, the row amount already includes tax.
        if (taxType === "2") { // Inclusive of Tax
            // Extract the tax from the row amount for display
            var taxAmount = (rowAmount * taxRate / (100 + taxRate));
            totalTax += Math.floor(taxAmount * 100) / 100;  // Round down to two decimal places
            subtotal += rowAmount; // The subtotal is still the amount with tax.
        } else {
            subtotal += rowAmount;  // Sum the amounts for subtotal
            if (taxType === "1") {  // Exclusive of Tax
                totalTax += rowAmount * (taxRate / 100);  // Add tax for exclusive tax
            }
            // Out of Scope (taxType === "3") doesn't add any tax
        }
    });

    // For Inclusive Tax, grandTotal should be equal to subtotal
    if (taxType === "2") {
        grandTotal = subtotal;  // Total is just the subtotal itself
    } else {
        grandTotal = subtotal + totalTax;  // Grand total = subtotal + tax for exclusive tax
    }

    // Update the subtotal and grand total displays
    $('#lblSubAmount').text(subtotal.toFixed(2));  // Display subtotal
    $('#lblTaxAmount').text(totalTax.toFixed(2));  // Display total tax
    $('#lblAmount').text(grandTotal.toFixed(2));  // Display grand total

    //update val
    $('#totalSubAmount').val(subtotal.toFixed(2));
    $('#totalTaxAmount').val(totalTax.toFixed(2));
    $('#totalAmount').val(grandTotal.toFixed(2));
}

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
        expiry: '',
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
    // Determine which form is currently active (Bill or Expense)
    var activeForm;
    if ($('#billForm').is(':visible')) {
      activeForm = 'bill';
    } else if ($('#expenseForm').is(':visible')) {
      activeForm = 'expense';
    }

    var formData = new FormData();

    // Based on the active form, capture the corresponding fields
    if (activeForm === 'bill') {
      formData.append('action', 'addTransaction');
      formData.append('formType', 'bill');  // Pass form type to backend
      formData.append('billSupplier', $('#bill_supplier').val());
      formData.append('billAddress', $('#bill_address').val());
      formData.append('billDate', $('#bill_start_date').val());
      formData.append('billdueDate', $('#bill_end_date').val());
      formData.append('billNo', $('#billNo').val());
      //totals
      formData.append('sub_total', $('#totalSubAmount').val());
      formData.append('total_tax', $('#totalTaxAmount').val());
      formData.append('grand_total', $('#totalAmount').val());
      // Get itemList from table and append it to FormData
      var itemList = table.rows().data().toArray();
      formData.append('items', JSON.stringify(itemList));
    } else if (activeForm === 'expense') {
      formData.append('action', 'addTransaction');
      formData.append('formType', 'expense');  // Pass form type to backend
      formData.append('payee_id', $('#expense_supplier').val());
      formData.append('expenseDate', $('#expense_date').val());
      formData.append('expense_payment_method', $('#expense_payment').val());
      formData.append('expenseNo', $('#expense_ref_no').val());
      var itemList = table.rows().data().toArray();
      formData.append('items', JSON.stringify(itemList));
    }

    // Attach remarks and file from `attachForm`
    formData.append('remarks', $('#attach_Remarks').val());
    var attachmentFile = $('#attach_File')[0].files[0]; // Get the first file from attach_File input
    if (attachmentFile) {
      formData.append('attachment', attachmentFile);
    }

    // Debugging: Log form data before submitting
    // console.log('Submitting form:', activeForm, formData);
    // console.log('Submitting form:', activeForm);

    // for (var pair of formData.entries()) {
    //   console.log(pair[0] + ': ' + pair[1]);
    // }


    Swal.fire({
      title: "Do you want to save the changes?",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Save",
      denyButtonText: `Don't save`
    }).then((result) => {
      if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: 'admin/process/admin_action.php', // Update with your PHP script path
            type: 'POST',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            success: function (response) {
                // Handle success response
                $('#responseMessage').html(response.message);
                if (response.success) {
                    // Reset the active form
                    if (activeForm === 'bill') {
                        $('#billForm')[0].reset(); // Reset the bill form
                        Swal.fire("Saved!", response.message, "success");
                        // toastr.success(response.message);
                    } else if (activeForm === 'expense') {
                        $('#expenseForm')[0].reset(); // Reset the expense form
                        // toastr.success(response.message);
                        Swal.fire("Saved!", response.message, "success");
                    }
                    clearRows();
                } else {
                    console.log(response.message);
                    // toastr.error(response.message);
                    Swal.fire("Error!", response.message, "error");
                }
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.log('An error occurred:', error);
            }
        });
      } else if (result.isDenied) {
        Swal.fire("Changes are not saved", "", "error");
      }
    });


  });

  function clearRows(){
    currentlyEditingRow = null; // Reset the editing state

    table.clear().draw(false); // Clear all rows
    addEmptyRows(2); // Add 2 default empty rows
    updateTotalAmount();
  }
  // Initialize table with 2 empty rows
  function addEmptyRows(numRows) {
    for (var i = 0; i < numRows; i++) {
      table.row.add({
        product_name: '',
        sku: '',
        barcode: '',
        expiry: '',
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
