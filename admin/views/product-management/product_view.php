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
                                        <span class="text-dark fw-semibold ">Product Name: </span><br><span class="text-dark">Red Mongo 340g</span>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <span class="text-dark fw-semibold ">Brand: </span><br><span class="text-dark">YS Quality</span>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <span class="text-dark fw-semibold ">Category / Subcategory: </span><br><span class="text-dark">Fruit Preserves/Syrup</span>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <span class="text-dark fw-semibold ">SKU: </span><br><?php echo "<img src='data:image/png;base64," . base64_encode(generateBarcode("P0000004")) . "' width='180'>";?><br><span class="text-dark">P0000004</span>
                                    </div>
                                </div>
                            </div>
                            <!-- FIRST -->
                        </div>
                        <div class="tab-pane fade" id="nav-pricing" role="tabpanel" aria-labelledby="nav-pricing-tab">
                            <div class="mt-3">
                                <div class="row align-items-stretch gy-5">
                                    <div class="col-lg col-md-6">
                                        <span class="text-dark fw-semibold ">Purchasing Price: </span><br><span class="text-dark">₱ 102</span>
                                    </div>
                                    <div class="col-lg col-md-6">
                                        <span class="text-dark fw-semibold ">Selling Price: </span><br><span class="text-dark">₱ 110</span>
                                    </div>
                                    <div class="col-lg col-md-6 col-6">
                                        <span class="text-dark fw-semibold ">Tax: </span><br><span class="text-dark">No Tax</span>
                                    </div>
                                    <div class="col-lg col-md-6 col-6">
                                        <span class="text-dark fw-semibold ">Total Purchase Price: </span><br><span class="text-dark">₱ 1020</span>
                                    </div>
                                    <div class="col-lg col-md-6 col-6">
                                        <span class="text-dark fw-semibold ">Total Selling Price: </span><br><span class="text-dark">₱ 1100</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="py-3">
                            <p class="text-dark text-break">Red and mung beans are beneficial to your health. They are rich in nutrients like protein, fiber and antioxidants.</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-stock" role="tabpanel" aria-labelledby="nav-stock-tab">
                            <div class="mt-3">
                                    <div class="row align-items-stretch gy-5">
                                        <div class="col-lg col-md-6 col-6">
                                            <span class="text-dark fw-semibold ">Stock: </span><br><span class="text-dark">10</span>
                                        </div>   
                                        <div class="col-lg col-md-6 col-6">
                                            <span class="text-dark fw-semibold ">Unit: </span><br><span class="text-dark">pcs</span>
                                        </div>
                                        <div class="col-lg col-md-6 col-6">
                                        <span class="text-dark fw-semibold ">Status: </span><br><span class="text-dark"><span class="badge text-white" style="background-color: #FFAF61;">In Stock</span></span>
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
            <table id="myTable" class="table table-hover table-cs-color">
                    <thead>
                        <tr>
                            <th></th>
                            <th>SKU</th>
                            <th class="text-start">Product Barcode</th>
                            <th class="text-center">Qty</th>
                            <th>Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td><span>ITM001</span></td>
                            <td class="text-start"><span><?php echo "<img src='data:image/png;base64," . base64_encode(generateBarcode("ITM001")) . "' width='180'>";?></span></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm">5</span></td>
                            <td>2024-April-4</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><span>ITM002</span></td>
                            <td class="text-start"><span><?php echo "<img src='data:image/png;base64," . base64_encode(generateBarcode("ITM002")) . "' width='180'>";?></span></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm">5</span></td>
                            <td>2024-April-4</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
  </div>
</div>
<script>
  $(document).ready( function () {
    // let table = new DataTable('#myTable');
    $('#myTable').DataTable( {
      columnDefs: [
        {
            orderable: false,
            render: DataTable.render.select(),
            targets: 0
        }
    ],
    order: [[1, 'asc']],
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
  });
</script>

