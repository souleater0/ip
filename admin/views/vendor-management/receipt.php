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
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-form="bill">Bill</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-form="expense">Expense</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-form="invoice">Invoice</a></li>
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
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bolder" id="staticBackdropLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border">
          <!-- Placeholder for dynamic form -->
          <div id="dynamicFormContent">
            <!-- Bill form -->
            <form id="billForm" class="dynamic-form" style="display:none;">
              <div class="row mb-3">
                <div class="col-3">
                  <label for="supplier" class="form-label">Supplier</label >
                  <select class="selectpicker form-control" id="supplier" name="supplier" data-live-search="true">
                    <option value="1">Supplier A</option>
                    <option value="2">Supplier B</option>
                  </select>
                </div>
              </div>

              <!-- Table for items -->
              <table id="editableTable" class="table table-hover">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Customer</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>

              <!-- Buttons to add and clear rows -->
              <button id="addRow" type="button" class="btn btn-success">Add Row</button>
              <button id="clearRows" type="button" class="btn btn-danger">Clear All</button>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="submitForm">Save & Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      // Show the appropriate form in the modal
      $('.dropdown-item').on('click', function() {
        var formType = $(this).data('form');
        $('.dynamic-form').hide();
        $('#' + formType + 'Form').show();
        var newTitle = $(this).text();
        $('#staticBackdropLabel').text(newTitle);
      });

      var table = $('#editableTable').DataTable({
        columns: [
          { title: "Product Name", data: "product_name" },
          { title: "SKU", data: "sku" },
          { title: "Qty", data: "qty" },
          { title: "Rate", data: "rate" },
          { title: "Amount", data: "amount" },
          { title: "Customer", data: "customer" },
          {
            title: "Actions", 
            data: null,
            defaultContent: '<button type="button" class="btn btn-primary btn-sm edit-row">Edit</button>'
          }
        ],
        paging: false,
        ordering: false,
        searching: false,
        autoWidth: false
      });

      // Function to add empty rows
      function addEmptyRows(numRows) {
        for (var i = 0; i < numRows; i++) {
          table.row.add({
            product_name: '',
            sku: '',
            qty: '',
            rate: '',
            amount: '',
            customer: ''
          }).draw(false);
        }
      }

      // Initialize with 2 empty rows
      addEmptyRows(2);

      // Handle Add Row button
      $('#addRow').on('click', function() {
        table.row.add({
          product_name: '',
          sku: '',
          qty: '',
          rate: '',
          amount: '',
          customer: ''
        }).draw(false);
      });

      // Handle Clear Rows button, keeping 2 empty rows
      $('#clearRows').on('click', function() {
        table.clear().draw(false); // Clear all rows
        addEmptyRows(2); // Add 2 default empty rows
      });

      // Handle Edit button click
      $('#editableTable tbody').on('click', '.edit-row', function() {
        var row = $(this).closest('tr');
        var rowData = table.row(row).data();

        if ($(this).text() === 'Edit') {
          // Switch to Edit Mode
          row.find('td').each(function(index) {
            if (index === 0) {
              $(this).html('<input type="text" class="form-control product-name" value="' + rowData.product_name + '">');
            } else if (index === 1) {
              $(this).html('<input type="text" class="form-control sku" value="' + rowData.sku + '">');
            } else if (index === 2) {
              $(this).html('<input type="number" class="form-control qty" value="' + rowData.qty + '">');
            } else if (index === 3) {
              $(this).html('<input type="number" class="form-control rate" value="' + rowData.rate + '">');
            } else if (index === 4) {
              $(this).html('<input type="number" class="form-control amount" value="' + rowData.amount + '">');
            } else if (index === 5) {
              $(this).html('<select class="selectpicker form-control" data-live-search="true"><option value="Customer A">Customer A</option><option value="Customer B">Customer B</option></select>');
              $(this).find('select').val(rowData.customer);
              // Reinitialize the selectpicker
              $(this).find('select').selectpicker('refresh');
            }
          });
          $(this).text('Save');
        } else {
          // Switch to Display Mode and Save the changes
          var updatedData = {
            product_name: row.find('.product-name').val(),
            sku: row.find('.sku').val(),
            qty: row.find('.qty').val(),
            rate: row.find('.rate').val(),
            amount: row.find('.amount').val(),
            customer: row.find('.selectpicker').val()
          };

          table.row(row).data(updatedData).draw(false);
          $(this).text('Edit');
        }
      });

      // Handle calculations between Qty and Rate to update Amount
      $('#editableTable').on('input', '.qty, .rate', function() {
        var row = $(this).closest('tr');
        var qty = parseFloat(row.find('.qty').val()) || 0;
        var rate = parseFloat(row.find('.rate').val()) || 0;
        row.find('.amount').val((qty * rate).toFixed(2));
      });

      // Handle changes to Amount to update Rate
      $('#editableTable').on('input', '.amount', function() {
        var row = $(this).closest('tr');
        var qty = parseFloat(row.find('.qty').val()) || 0;
        var amount = parseFloat($(this).val()) || 0;
        if (qty > 0) {
          row.find('.rate').val((amount / qty).toFixed(2));
        }
      });
      // Handle Save & Close button click
      $('#submitForm').on('click', function() {
        var formData = [];
        table.rows().every(function() {
          var data = this.data();
          formData.push(data);
        });

        console.log('Form Data:', formData);
      });
    });
  </script>
