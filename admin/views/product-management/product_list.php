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
        <div class="container-fluid">
          <div class="w-100">
            <span>aw</span>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4 text-capitalize">list of products</h5>
              <div class="card">
                <div class="card-body">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Column 1</th>
                            <th>Column 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Row 1 Data 1</td>
                            <td>Row 1 Data 1</td>
                        </tr>
                        <tr>
                            <td>Row 2 Data 2</td>
                            <td>Row 2 Data 2</td>
                        </tr>
                        <tr>
                            <td>Row 3 Data 3</td>
                            <td>Row 3 Data 3</td>
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
    $('#myTable').DataTable({
      responsive: true
    });
} );
</script>
<?php
// echo "<tr><td><img src='data:image/png;base64," . base64_encode(generateBarcode("joeMAMA")) . "' width='180'></td></tr>";
?>

