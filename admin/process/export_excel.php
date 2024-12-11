<?php
require '../../vendor/autoload.php'; // Load PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['groupedData'], $_POST['filters'])) {
    $groupedData = json_decode($_POST['groupedData'], true);
    $filters = json_decode($_POST['filters'], true);
    $currentDate = date('F d, Y');

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $row = 1;

    // Set document title/header
    $sheet->mergeCells("A$row:F$row");
    $sheet->setCellValue("A$row", "Summary Report");
    $sheet->getStyle("A$row")->applyFromArray([
        'font' => ['bold' => true, 'size' => 16],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    ]);
    $row++;

    // Add filters as sub-header
    $sheet->mergeCells("A$row:F$row");
    $filterDetails = "Filters - Transaction Type: " . $filters['transactionType'] . 
        ", Date Range: " . ($filters['dateFilter'] === "custom" ? 
        $filters['startDate'] . " to " . $filters['endDate'] : $filters['dateFilter']);
    $sheet->setCellValue("A$row", $filterDetails);
    $sheet->getStyle("A$row")->applyFromArray([
        'font' => ['italic' => true, 'size' => 12],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    ]);
    $row += 2;

    $grandTotalAmount = 0;
    $grandTotalQty = 0;
    $grandTotalPercentage = 0;
    $grandTotalAvgPrice = 0;

    foreach ($groupedData as $categoryName => $products) {
        // Add category name as a header and make it bold
        $sheet->setCellValue("A$row", $categoryName);
        $sheet->getStyle("A$row")->getFont()->setBold(true);
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

        $categoryTotalAmount = 0;
        $categoryTotalQty = 0;
        $categoryTotalPercentage = 0;
        $categoryTotalAvgPrice = 0;

        // Add product data
        foreach ($products as $product) {
            $sheet->setCellValue("A$row", $product['ProductSKU'])
                  ->setCellValue("B$row", $product['ProductName'])
                  ->setCellValue("C$row", $product['Qty'])
                  ->setCellValue("D$row", number_format($product['Amount'], 2))  // This ensures .00 is added
                  ->setCellValue("E$row", number_format($product['PercentageOfSales'], 2) . '%')  // Add '%' symbol
                  ->setCellValue("F$row", number_format($product['AvgPrice'], 2));

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
              ->setCellValue("D$row", number_format($categoryTotalAmount, 2))
              ->setCellValue("E$row", number_format($categoryTotalPercentage, 2). '%')
              ->setCellValue("F$row", number_format($categoryTotalAvgPrice, 2));
        $sheet->getStyle("A$row:F$row")->getFont()->setBold(true);
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
          ->setCellValue("D$row", number_format($grandTotalAmount, 2))
          ->setCellValue("E$row", number_format($grandTotalPercentage, 2). '%')
          ->setCellValue("F$row", number_format($grandTotalAvgPrice, 2));
    $sheet->getStyle("A$row:F$row")->getFont()->setBold(true);
    $sheet->getStyle("A$row:F$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    $fileName = 'Summary_Report_' . date('Ymd');
    // Set headers for download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $fileName . '.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
