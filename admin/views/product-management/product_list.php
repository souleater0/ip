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
<div class="body-wrapper-inner">
        <div class="container-fluid" style="max-width: 100% !important;">
              <div class="card shadow-sm">
                <div class="card-header bg-transparent border-bottom">
                  <div class="row">
                    <div class="col">
                    <h5 class="mt-1 mb-0">Manage Product</h5>
                    </div>
                  <div class="col">
                  <a class="btn btn-primary btn-sm float-end"><i class="fa-solid fa-plus"></i>Add Product</a>
                  </div>
                  
                  </div>

                </div>
                <div class="card-body">
                <table id="myTable" class="table table-hover table-cs-color">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Product Barcode</th>
                            <th class="text-center">Stocks</th>
                            <th class="text-center">Purchase Price</th>
                            <th class="text-center">Selling Price</th>
                            <th class="text-center">Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>Dutch Mill</td>
                            <td>Dutch Mill Co., Ltd</td>
                            <td>Yoghurt Drink</td>
                            <td><span class="badge text-white" style="background-color: #FF8A08;">Low Stock</span></td>
                            <td><span>P0000001</span></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm">5</span></td>
                            <td class="text-center">21</td>
                            <td class="text-center">25</td>
                            <td>pcs</td>
                            <td><a class="btn btn-info btn-sm" href="index.php?route=view-product"><i class="fa-solid fa-eye"></i></a>&nbsp;<a class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>&nbsp;<a class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Cheeze Whiz</td>
                            <td>Kraft Foods</td>
                            <td>Spread</td>
                            <td><span class="badge text-white" style="background-color: #FFAF61;">In Stock</span></td>
                            <td><span>P0000002</span></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm">15</span></td>
                            <td class="text-center">21</td>
                            <td class="text-center">25</td>
                            <td>pcs</td>
                            <td><a class="btn btn-info btn-sm" href="index.php?route=view-product"><i class="fa-solid fa-eye"></i></a>&nbsp;<a class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>&nbsp;<a class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Milo</td>
                            <td>Nestle</td>
                            <td>Chocolate Malt</td>
                            <td><span class="badge text-white" style="background-color: #FF0808;">Out of Stock</span></td>
                            <td><span>P0000003</span></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm">0</span></td>
                            <td class="text-center">21</td>
                            <td class="text-center">25</td>
                            <td>pcs</td>
                            <td><a class="btn btn-info btn-sm" href="index.php?route=view-product"><i class="fa-solid fa-eye"></i></a>&nbsp;<a class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>&nbsp;<a class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Bear Brand</td>
                            <td>Nestle</td>
                            <td>Powdered Milk</td>
                            <td><span class="badge text-white" style="background-color: #FFAF61;">In Stock</span></td>
                            <td><span>P0000004</span></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm">10</span></td>
                            <td class="text-center">21</td>
                            <td class="text-center">25</td>
                            <td>pcs</td>
                            <td><a class="btn btn-info btn-sm" href="index.php?route=view-product"><i class="fa-solid fa-eye"></i></a>&nbsp;<a class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>&nbsp;<a class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a></td>
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
    scrollY: 300,
    select: {
        style: 'multi',
        selector: 'td:first-child'
    },
    responsive: true,
    autoWidth: false
  });
  });
</script>

