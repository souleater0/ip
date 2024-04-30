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
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4 text-capitalize">list of products</h5>
              <div class="card">
                <div class="card-body">
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
<?php
// echo "<tr><td><img src='data:image/png;base64," . base64_encode(generateBarcode("joeMAMA")) . "' width='180'></td></tr>";
?>

