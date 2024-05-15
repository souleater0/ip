<?php
$products = getProduct($pdo);
?>

<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card shadow-sm">
      <div class="card-header bg-transparent border-bottom">
        <div class="row">
          <div class="col">
            <h5 class="mt-1 mb-0">Stock In</h5>
          </div>
        </div>

      </div>
      <div class="card-body">
      <select class="selectpicker" data-live-search="true">
      <?php foreach ($products as $product):?>
        <option value="<?php echo $product['product_id'];?>" data-tokens="<?php echo $product['product_name'];?>"><?php echo $product['product_name'];?></option>
      <?php endforeach;?>
      </select>

      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>