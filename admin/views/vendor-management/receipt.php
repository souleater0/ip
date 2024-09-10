<style>
  .plain-text {
  border: none;
  background: transparent;
  padding: 0;
  font-size: inherit;
  line-height: inherit;
  box-shadow: none;
  cursor: default;
}

.plain-text:focus {
  outline: none;
}
</style>
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
              <div class="row">
                <div class="col-2">
                  <label for="supplier" class="form-label">Supplier</label>
                  <select class="selectpicker form-control show-tick" id="supplier" name="supplier" data-live-search="true">
                    <?php foreach ($suppliers as $supplier):?>
                      <option value="<?php echo $supplier['id'];?>"><?php echo $supplier['vendor_company'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <table id="example" class="table table-hover table-cs-color display">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>SKU</th>
                <th>Barcode</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Customer</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              <td class="editable" data-type="product-name">
  <input type="text" class="form-control plain-text" readonly />
  <div class="select-wrapper" style="display:none;">
    <select class="selectpicker form-control" data-live-search="true">
      <option value="" disabled selected>Select a product</option>
      <option value="1">Chocolate</option>
      <option value="2">Vanilla</option>
      <option value="3">Strawberry</option>
    </select>
  </div>
</td>
                <td class="editable">CHC0001</td>
                <td class="editable">ABC1234</td>
                <td class="editable">A 30g Choco</td>
                <td class="editable qty">15</td>
                <td class="editable rate"></td>
                <td class="editable amount">200</td>
                <td class="editable" data-type="customer">
                  <input type="text" class="form-control plain-text" readonly />
                  <div class="select-wrapper" style="display:none;">
                    <select class="selectpicker form-control" data-live-search="true">
                      <option value="" disabled selected>Select a customer</option>
                      <option value="1">Customer X</option>
                      <option value="2">Customer Y</option>
                      <option value="3">Customer Z</option>
                    </select>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
              <!-- Additional fields for bill form -->
            </form>
            <!-- Expense and Invoice forms here -->
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
  // Initialize Select Picker
  $('.selectpicker').selectpicker();

  // Show the appropriate form in the modal
  $('.dropdown-item').on('click', function() {
    var formType = $(this).data('form');
    $('.dynamic-form').hide();
    $('#' + formType + 'Form').show();
    var newTitle = $(this).text();
    $('#staticBackdropLabel').text(newTitle);
  });

  // Handle cell click for inline editing
  $('#example').on('click', 'tbody td.editable', function() {
    var $cell = $(this);
    if ($cell.hasClass('editing')) return;

    var $input = $cell.find('input');
    var $selectWrapper = $cell.find('.select-wrapper');
    var $select = $cell.find('select');
    var currentValue = $input.val();

    // Switch to editing mode
    $cell.addClass('editing');
    $input.hide();
    $selectWrapper.show();
    $select.selectpicker('refresh');

    // Set the selectpicker to the current value
    if ($select.length) {
      $select.val(function() {
        return $select.find('option').filter(function() {
          return $(this).text() === currentValue;
        }).val();
      }).selectpicker('refresh');
    }
    
    $select.focus();

    // Handle select change
    $select.on('change', function() {
      var selectedText = $(this).find('option:selected').text();
      $input.val(selectedText).show();
      $selectWrapper.hide();
      $cell.removeClass('editing');
    });

    // Handle click outside to save changes
    $(document).on('click', function(event) {
      if (!$cell.is(event.target) && !$cell.has(event.target).length) {
        $input.show();
        $selectWrapper.hide();
        $cell.removeClass('editing');
      }
    });
  });

  // Compute rate
  function computeRate() {
    $('#example tbody tr').each(function() {
      var qty = $(this).find('.qty').text();
      var amount = $(this).find('.amount').text();
      var rate = (qty && amount) ? (amount / qty).toFixed(2) : '';
      $(this).find('.rate').text(rate);
    });
  }

  $('#example').on('input', '.qty, .amount', function() {
    computeRate();
  });

  // Initialize DataTable
  $('#example').DataTable({
    autoWidth: false
  });
});
</script>