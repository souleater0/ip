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
        <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
        <option data-tokens="mustard">Burger, Shake and a Smile</option>
        <option data-tokens="frosting">Sugar, Spice and all things nice</option>
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