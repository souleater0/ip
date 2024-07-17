<?php
// Include the PHP barcode library
require 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

// $text = "";
// $generator = new BarcodeGeneratorPNG();
// $barcode_image = $generator->getBarcode($text, $generator::TYPE_CODE_128);

function generateBarcode($text){
    $generator = new BarcodeGeneratorPNG();
    $barcode_image = $generator->getBarcode($text, $generator::TYPE_CODE_128);
    return $barcode_image;
}
$product_id = $_GET['product'];
$product = getProductSummary($product_id, $pdo);
$items = getItembyID($product_id, $pdo);
?>
<div class="body-wrapper-inner open-sans-regular">
    <div class="container-fluid" style="max-width: 100% !important;">
        <div class="card shadow-sm">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="mt-1 mb-0">Summary</h5>
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-product-tab" data-bs-toggle="tab" data-bs-target="#nav-product" type="button" role="tab" aria-controls="nav-product" aria-selected="true">Product</button>
                            <button class="nav-link" id="nav-pricing-tab" data-bs-toggle="tab" data-bs-target="#nav-pricing" type="button" role="tab" aria-controls="nav-pricing" aria-selected="false">Pricing</button>
                            <button class="nav-link" id="nav-stock-tab" data-bs-toggle="tab" data-bs-target="#nav-stock" type="button" role="tab" aria-controls="nav-stock" aria-selected="false">Stock</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Description</button>
                            
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
                            <!-- FIRST -->
                            <div class="mt-3">
                                <div class="row align-items-stretch gy-5">
                                    <div class="col-lg-3 col-md-6">
                                        <span class="text-dark fw-semibold ">Product Name: </span><br><span class="text-dark"><?php echo !empty($product['product_name']) ? $product['product_name'] : 'none' ?></span>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <span class="text-dark fw-semibold ">Brand: </span><br><span class="text-dark"><?php echo !empty($product['brand_name']) ? $product['brand_name'] : 'none' ?></span>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <span class="text-dark fw-semibold ">Category / Subcategory: </span><br><span class="text-dark"><?php echo !empty($product['category']) ? $product['category'] : 'none' ?></span>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <span class="text-dark fw-semibold ">SKU: </span><br><?php echo "<img src='data:image/png;base64," . base64_encode(generateBarcode(!empty($product['product_sku']) ? $product['product_sku'] : 'none')) . "' width='180'>";?><br><span class="text-dark"><?php echo !empty($product['product_sku']) ? $product['product_sku'] : 'none' ?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- FIRST -->
                        </div>
                        <div class="tab-pane fade" id="nav-pricing" role="tabpanel" aria-labelledby="nav-pricing-tab">
                            <div class="mt-3">
                                <div class="row align-items-stretch gy-5">
                                    <div class="col-lg col-md-6">
                                        <span class="text-dark fw-semibold ">Purchasing Price: </span><br><span class="text-dark"><?php echo !empty($product['product_pp']) ? '₱'.$product['product_pp'] : 'none' ?></span>
                                    </div>
                                    <div class="col-lg col-md-6">
                                        <span class="text-dark fw-semibold ">Selling Price: </span><br><span class="text-dark"><?php echo !empty($product['product_sp']) ? '₱'.$product['product_sp'] : 'none' ?></span>
                                    </div>
                                    <div class="col-lg col-md-6 col-6">
                                        <span class="text-dark fw-semibold ">Tax: </span><br><span class="text-dark"><?php echo !empty($product['tax_name']) ? $product['tax_name'] : 'none' ?></span>
                                    </div>
                                    <div class="col-lg col-md-6 col-6">
                                        <span class="text-dark fw-semibold ">Total Purchase Price: </span><br><span class="text-dark"><?php echo !empty($product['product_pp']) ? '₱'.$product['product_pp']*$product['stocks'] : 'none' ?></span>
                                    </div>
                                    <div class="col-lg col-md-6 col-6">
                                        <span class="text-dark fw-semibold ">Total Selling Price: </span><br><span class="text-dark"><?php echo !empty($product['product_sp']) ? '₱'.$product['product_sp']*$product['stocks'] : 'none' ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="py-3">
                            <p class="text-dark text-break"><?php echo !empty($product['product_description']) ? $product['product_description'] : 'none' ?></p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-stock" role="tabpanel" aria-labelledby="nav-stock-tab">
                            <div class="mt-3">
                                    <div class="row align-items-stretch gy-5">
                                        <div class="col-lg col-md-6 col-6">
                                            <span class="text-dark fw-semibold ">Stock: </span><br><span class="text-dark"><?php echo !empty($product['stocks']) ? $product['stocks'] : 'none' ?></span>
                                        </div>   
                                        <div class="col-lg col-md-6 col-6">
                                            <span class="text-dark fw-semibold ">Unit: </span><br><span class="text-dark"><?php echo !empty($product['unit']) ? $product['unit'] : 'none' ?></span>
                                        </div>
                                        <div class="col-lg col-md-6 col-6">
                                        <span class="text-dark fw-semibold ">Status: </span><br><span class="text-dark">
                                            <?php
                                            if(!empty($product['status_id']) && $product['status_id'] == 1){
                                                echo '<span class="badge text-white" style="background-color: #58D68D;">In Stock</span>';
                                            }
                                            if(!empty($product['status_id']) && $product['status_id'] == 2){
                                                echo '<span class="badge text-white" style="background-color: #FFAF61;">Low Stock</span>';
                                            }
                                            if(!empty($product['status_id']) && $product['status_id'] == 3){
                                                echo '<span class="badge text-white" style="background-color: #EC7063;">Out of Stock</span>';
                                            }
                                            ?>
                                        </span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h5 class="mt-1 mb-0">Item List</h5>
            </div>
            <div class="card-body">
            <table id="viewProductTable" class="table table-hover table-cs-color">
                    <thead>
                        <tr>
                            
                            <th>SKU</th>
                            <th class="text-start">Product Barcode</th>
                            <th class="text-center">Qty</th>
                            <th>Expiry Date</th>
                            <th class="text-center">Remaining Days</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php foreach($items as $item):?>
                            <tr>
                            <td><span><?php echo "<img src='data:image/png;base64," . base64_encode(generateBarcode(!empty($item['item_sku']) ? $item['item_sku'] : 'none')) . "' width='180'>";?></span><br><span><?php echo !empty($item['item_sku']) ? $item['item_sku'] : 'none';?></span></td>
                            <td class="text-start"><span><?php echo "<img src='data:image/png;base64," . base64_encode(generateBarcode(!empty($item['item_barcode']) ? $item['item_barcode'] : 'none')) . "' width='180'>";?></span><br><span><?php echo !empty($item['item_barcode']) ? $item['item_barcode'] : 'none';?></span></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm"><?php echo $item['item_qty'];?></span></td>
                            <td><?php echo $item['item_expiry'];?></td>
                            <td class="text-center">
                                <?php 
                                    $days_to_expiry = (int)$item['days_to_expiry'];
                                    if ($days_to_expiry <= 0) {
                                        echo '<span class="badge bg-danger">Expired</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary">' . $days_to_expiry . '</span>';
                                    }
                                ?>
                            </td>
                            <td class="text-center"><button class="btn btn-danger btn-sm btn-waste" data-sku="<?php echo !empty($product['product_sku']) ? $product['product_sku'] : 'none' ?>" data-item-barcode="<?php echo !empty($item['item_barcode']) ? $item['item_barcode'] : 'none';?>" data-item-qty="<?php echo $item['item_qty']; ?>">Move to Waste</button></td>
                            </tr>
                            <?php endforeach;?>
                        
                    </tbody>
                </table>
            </div>
        </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="wasteModal" tabindex="-1" aria-labelledby="wasteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="wasteForm">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="wasteModalLabel">Waste Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body border">
        <div class="row gy-2">
          <div class="col-lg-12">
            <label for="product_desc" class="form-label">Reason</label>
            <input type="hidden" class="form-control" id="product_sku" name="product_sku">
            <input type="hidden" class="form-control" id="product_barcode" name="product_barcode">
            <textarea type="text" class="form-control" id="product_desc" name="product_desc" placeholder="Ex. Food"></textarea>
          </div>
          <div class="col-lg-6">
            <label for="min_qty" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="qty" name="qty" value="1" min="1" placeholder="Ex. 20" pattern="[0-9]*">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" id="moveWaste" update-id="">Move to Waste</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- END -->
<script>
$(document).ready( function () {
    // let table = new DataTable('#viewProductTable');
    $('#viewProductTable').DataTable( {
    order: [[3, 'asc']],
    paging: true,
    scrollCollapse: true,
    scrollX: true,
    scrollY: 200,
    select: {
        style: 'multi',
        selector: 'td:first-child'
    },
    responsive: true,
    autoWidth: false,
    footer: false
    });
    $('#qty').on('input', function(){
        let value = $(this).val().replace(/\D/g, ''); // Remove non-digit characters
        let maxQty = $(this).attr('max'); // Get the max attribute value
        value = Math.max(1, Math.min(maxQty, value)); // Ensure the value is between 1 and maxQty
        $(this).val(value);
    });
    $('#moveWaste').click(function(){
        var formData = $('#wasteForm').serialize();
        console.log(formData);
    });
    
    $('#viewProductTable').on('click', 'button.btn-waste', function () {
        var itemQty = $(this).data('item-qty');
        var product_sku = $(this).data('sku');
        var product_barcode = $(this).data('item-barcode');
        $('#product_sku').val(product_sku);
        $('#product_barcode').val(product_barcode);
        console.log(itemQty);
        $('#qty').attr('max', itemQty);
        $('#wasteModal').modal('show');
    });
});
</script>

