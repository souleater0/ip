<?php
require '../../vendor/autoload.php'; // Load PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Check if the required POST data is available
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['groupedData'])) {
    $groupedData = json_decode($_POST['groupedData'], true);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $row = 1;
    $grandTotalAmount = 0; // Variable to hold the grand total amount
    $grandTotalQty = 0;    // Variable to hold the grand total qty
    $grandTotalPercentage = 0; // Variable to hold the grand total % of Sales
    $grandTotalAvgPrice = 0;   // Variable to hold the grand total Avg Price

    foreach ($groupedData as $categoryName => $products) {
        // Add category name as a header and make it bold
        $sheet->setCellValue("A$row", $categoryName);
        $sheet->getStyle("A$row")->getFont()->setBold(true); // Bold category name
        $row++;

        // Add table headers with borders
        $sheet->setCellValue("A$row", "Product SKU")
              ->setCellValue("B$row", "Product Name")
              ->setCellValue("C$row", "Qty")
              ->setCellValue("D$row", "Amount")
              ->setCellValue("E$row", "% of Sales")
              ->setCellValue("F$row", "Avg Price");

        // Apply border to the header row
        $sheet->getStyle("A$row:F$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row++;

        $categoryTotalAmount = 0;    // Variable to hold the category total amount
        $categoryTotalQty = 0;       // Variable to hold the category total qty
        $categoryTotalPercentage = 0; // Variable to hold the category total % of Sales
        $categoryTotalAvgPrice = 0;   // Variable to hold the category total Avg Price

        // Add product data
        foreach ($products as $product) {
            $sheet->setCellValue("A$row", $product['ProductSKU'])
                  ->setCellValue("B$row", $product['ProductName'])
                  ->setCellValue("C$row", $product['Qty'])
                  ->setCellValue("D$row", $product['Amount'])
                  ->setCellValue("E$row", $product['PercentageOfSales'])
                  ->setCellValue("F$row", $product['AvgPrice']);

            // Apply borders to each product row
            $sheet->getStyle("A$row:F$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $row++;

            // Add the values to the category totals
            $categoryTotalQty += $product['Qty'];
            $categoryTotalAmount += $product['Amount'];
            $categoryTotalPercentage += $product['PercentageOfSales'];
            $categoryTotalAvgPrice += $product['AvgPrice'];
        }

        // Add subtotals for each column
        $sheet->setCellValue("A$row", "Subtotal")
              ->setCellValue("C$row", $categoryTotalQty)
              ->setCellValue("D$row", $categoryTotalAmount)
              ->setCellValue("E$row", $categoryTotalPercentage)
              ->setCellValue("F$row", $categoryTotalAvgPrice);
        $sheet->getStyle("A$row:F$row")->getFont()->setBold(true); // Bold subtotal row
        $sheet->getStyle("A$row:F$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row++;

        // Add the category totals to the grand total
        $grandTotalQty += $categoryTotalQty;
        $grandTotalAmount += $categoryTotalAmount;
        $grandTotalPercentage += $categoryTotalPercentage;
        $grandTotalAvgPrice += $categoryTotalAvgPrice;

        $row++; // Add space after each category
    }

    // Add the grand total
    $sheet->setCellValue("A$row", "Grand Total")
          ->setCellValue("C$row", $grandTotalQty)
          ->setCellValue("D$row", $grandTotalAmount)
          ->setCellValue("E$row", $grandTotalPercentage)
          ->setCellValue("F$row", $grandTotalAvgPrice);
    $sheet->getStyle("A$row:F$row")->getFont()->setBold(true); // Bold grand total row
    $sheet->getStyle("A$row:F$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    // Set headers for download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Sales_Report.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
