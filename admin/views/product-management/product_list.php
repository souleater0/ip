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
<style>
  .table thead th{
    background: #f8f9fd;
    color: #060606;
  }
  .table-cs-color{
    --bs-table-color: #000;
    /* --bs-table-bg: #FFF; */
    --bs-table-border-color: #cac8e6;
    --bs-table-striped-bg: #d5d3f2;
    --bs-table-striped-color: #000;
    --bs-table-active-bg: #cac8e6;
    --bs-table-active-color: #000;
    --bs-table-hover-bg: #dee2e6;
    --bs-table-hover-color: #000;
  }
  .card .card-header:not(.border-0) h5:after{
    content: "";
    height: 30px;
    width: 3px;
    background: #26B1FF;
    position: absolute;
    left: 0px;
    top: 15px;
    border-radius: 0 3px 3px 0;
  }
  select.dt-input{
    margin-right: 10px;
  }
</style>
<div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="card shadow-sm">
                <div class="card-header bg-transparent border-bottom">
                  <div class="row">
                    <div class="col">
                    <h5 class="mt-1 mb-0">Manage Product</h5>
                    </div>
                  <div class="col">
                  <button class="btn btn-primary btn-sm float-end"><i class="fa-solid fa-plus"></i>Add Product</button>
                  </div>
                  
                  </div>

                </div>
                <div class="card-body">
                <table id="myTable" class="table table-hover table-cs-color">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Barcode</th>
                            <th class="text-center">Stocks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Dutch Mill</td>
                            <td><?php echo "<img src='data:image/png;base64," . base64_encode(generateBarcode("P0000001")) . "' width='180'>";?></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm">10</span></td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Cheeze Whiz</td>
                            <td><?php echo "<img src='data:image/png;base64," . base64_encode(generateBarcode("P0000001")) . "' width='180'>";?></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm">10</span></td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Milo</td>
                            <td><?php echo "<img src='data:image/png;base64," . base64_encode(generateBarcode("P0000001")) . "' width='180'>";?></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm">10</span></td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>Bear Brand</td>
                            <td><?php echo "<img src='data:image/png;base64," . base64_encode(generateBarcode("P0000001")) . "' width='180'>";?></td>
                            <td class="text-center"><span class="btn btn-secondary btn-sm">10</span></td>
                            <td><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                        </tr>
                    </tbody>
                </table>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
<script>
  $(document).ready( function () {
    // let table = new DataTable('#myTable');
    $('#myTable').DataTable( {
    responsive: true,
    select: true
  });
  });
</script>

