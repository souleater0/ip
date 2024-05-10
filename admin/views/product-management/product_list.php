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
                <table id="productTable" class="table table-hover table-cs-color">
                </table>
                </div>
        </div>
  </div>
</div>
<script>
  $(document).ready( function () {
  //   $('#myTable').DataTable( {
  //     columnDefs: [
  //       {
  //           orderable: false,
  //           render: DataTable.render.select(),
  //           targets: 0
  //       }
  //   ],
  //   order: [[1, 'asc']],
  //   paging: true,
  //   scrollCollapse: true,
  //   scrollX: true,
  //   scrollY: 300,
  //   select: {
  //       style: 'multi',
  //       selector: 'td:first-child'
  //   },
  //   responsive: true,
  //   autoWidth: false
  // });
  var table = $('#productTable').DataTable({
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
        autoWidth: false,
        ajax:{
          url: 'admin/process/table.php?table_type=product',
          dataSrc: 'data'
        },
        columns:[
          {data: null},
          {data: 'product_id', visible: false},
          {data: 'product_name', title: 'Product Name'},
          // {data: 'brand_name', title: 'Brand Name'},
          {data: 'category', title: 'Category'},
          {data: 'product_sku', title: 'SKU'},
          {data: 'product_pp', title: 'Purchase Price',className: 'text-center'},
          {data: 'product_sp', title: 'Selling Price',className: 'text-center'},
          { 
                "data": "status_id",
                "render": function(data, type, row, meta) {
                    var statusText;
                    var statusColor;
                    switch (data) {
                        case 1:
                            statusText = "In Stock";
                            statusColor = "#58D68D"; // Green
                            break;
                        case 2:
                            statusText = "Low Stock";
                            statusColor = "#FFAF61"; // Orange
                            break;
                        default:
                            statusText = "Out of Stock";
                            statusColor = "#EC7063"; // Red
                            break;
                    }
                    return '<span class="badge text-white" style="background-color: ' + statusColor + ';">' + statusText + '</span>';
                },
                "title": "Status",
            },
          {data: 'product_min', title: 'Min', className: 'text-center'},
          {data: 'product_max', title: 'Max', className: 'text-center'},
          { 
                "data": "stocks",
                "render": function(data, type, row, meta) {
                    return '<span class="badge bg-secondary">' + data + '</span>';
                },
                "title": "Stocks",
                "className": "text-center"
          },
          {data: 'unit', title: 'Unit'},
          {"data": null, title: 'Action', "defaultContent": "<a class='btn btn-info btn-sm' href='index.php?route=view-product'><i class='fa-solid fa-eye'></i></a>&nbsp;<button class='btn btn-primary btn-sm btn-edit'><i class='fa-regular fa-pen-to-square'></i></button>&nbsp;<button class='btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i></button>"}
        ]
    });
  });
</script>

