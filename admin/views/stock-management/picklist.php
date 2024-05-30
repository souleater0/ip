<?php
$products = getProduct($pdo);
?>

<div class="body-wrapper-inner">
  <div class="container-fluid">
  <div id="productCards">
      <div class="card shadow-sm product-card">
        <div class="card-header bg-transparent border-bottom">
          <div class="row">
            <div class="col">
              <h5 class="mt-1 mb-0">Product</h5>
            </div>
            <div class="col align-content-end ">
            <button class="btn btn-danger btn-sm remove-product-btn float-end "><i class="fa-solid fa-trash"></i> Delete Product</button>
            </div>
          </div>
        </div>
        <div class="card-body">
        <div class="row gy-3">
          <div class="col-lg-4">
            <label for="product_select" class="form-label">Select Product</label>
            <select class="selectpicker form-control" data-live-search="true">
              <option value="" selected disabled>None</option>
              <?php foreach ($products as $product):?>
                <option value="<?php echo $product['product_sku'];?>" data-tokens="<?php echo $product['product_name'];?>"><?php echo $product['product_name'];?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-lg-4">
              <label for="product_name" class="form-label">SKU</label>
              <input type="text" class="form-control bg-secondary-subtle" name="product_name[]" placeholder="" readonly>
          </div>
          <div class="col-lg-4">
          <label for="qty" class="form-label">Quantity</label>
            <div class="input-group">
                <input type="number" class="form-control" name="qty[]" autocomplete="false">
                <span class="input-group-text" id="basic-addon2">Qty</span>
            </div>
          </div>
        </div>      
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <button class="btn btn-primary" id="addStockBTN"><i class="fa-solid fa-plus"></i>New Product</button>
      <button class="btn btn-primary" id="saveDataBtn"><i class="fa-solid fa-plus"></i>Proceed</button>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {        
        $('.selectpicker').selectpicker();
        
        $(document).on('input', 'input[type="number"]', function() {
          // Get the entered value
          var value = $(this).val();

          // Remove any non-numeric characters
          value = value.replace(/[^0-9]/g, '');

          // Convert the value to an integer
          var intValue = parseInt(value);

          // Check if the value is less than 1 or not a number
          if (isNaN(intValue) || intValue < 1) {
              // If less than 1 or not a number, set the value to 1
              $(this).val('1');
          } else {
              // Update the input field with the sanitized value
              $(this).val(intValue);
          }
        });
        $(document).on('change', '.selectpicker', function () {  
          var product_sku = $(this).val();
          $(this).closest('.row').find('input[name="product_name[]"]').val(product_sku);
        });
        $(document).on('click', '.remove-product-btn', function() {
          var productCard = $(this).closest('.product-card');
          if($('.product-card').length > 1) {
              productCard.remove();
          } else {
              toastr.error("Can't remove last form!");
          }
        });
        $('#addStockBTN').click(function() {
    var productCard = '<div class="card shadow-sm product-card">' +
                      '<div class="card-header bg-transparent border-bottom">' +
                          '<div class="row">' +
                              '<div class="col">' +
                                  '<h5 class="mt-1 mb-0">Product</h5>' +
                              '</div>' +
                              '<div class="col align-content-end ">' +
                                  '<button class="btn btn-danger btn-sm remove-product-btn float-end "><i class="fa-solid fa-trash"></i> Delete Product</button>' +
                              '</div>' +
                          '</div>' +
                      '</div>' +
                      '<div class="card-body">' +
                          '<div class="row gy-3">' +
                              '<div class="col-lg-4">' +
                                  '<label for="product_select" class="form-label">Select Product</label>' +
                                  '<select class="selectpicker form-control" data-live-search="true">' +
                                      '<option value="" selected disabled>None</option>' +
                                      '<?php foreach ($products as $product):?>' +
                                          '<option value="<?php echo $product['product_sku'];?>" data-tokens="<?php echo $product['product_name'];?>"><?php echo $product['product_name'];?></option>' +
                                      '<?php endforeach;?>' +
                                  '</select>' +
                              '</div>' +
                              '<div class="col-lg-4">' +
                                  '<label for="product_name" class="form-label">SKU</label>' +
                                  '<input type="text" class="form-control bg-secondary-subtle" name="product_name[]" placeholder="" readonly>' +
                              '</div>' +
                              '<div class="col-lg-4">' +
                                  '<label for="qty" class="form-label">Quantity</label>' +
                                  '<div class="input-group">' +
                                      '<input type="number" class="form-control" name="qty[]" autocomplete="false">' +
                                      '<span class="input-group-text" id="basic-addon2">Qty</span>' +
                                  '</div>' +
                              '</div>' +
                          '</div>' +
                      '</div>' +
                  '</div>';
        $('#productCards').append(productCard);
        $('.selectpicker').selectpicker('refresh');
        });

        $('#saveDataBtn').click(function() {
        // Collect data from appended product cards
          var productsData = [];
          $('.product-card').each(function() {
              var productData = {};
              productData.product_name = $(this).find("option:selected").text();
              productData.product_sku = $(this).find('select').val();
              productData.product_qty = $(this).find('input[name="qty[]').val();
              productsData.push(productData);
          });
          console.log(productsData);
        });
    });
</script>