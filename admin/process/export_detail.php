<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Load TCPDF and PhpSpreadsheet

// Read the JSON input from the request body
$inputData = json_decode(file_get_contents('php://input'), true);

// Check if the input data is valid
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    exit;
}

// Retrieve POST data from the JSON payload
$format = $inputData['format'] ?? null;
$sku = $inputData['sku'] ?? null;
$transactionType = $inputData['transactionType'] ?? null;
$dateFilter = $inputData['dateFilter'] ?? null;
$startDate = $inputData['startDate'] ?? null;
$endDate = $inputData['endDate'] ?? null;
$transactions = $inputData['transactions'] ?? null;

if (!$format || !$sku || !$transactionType || !$transactions) {
    echo json_encode(['success' => false, 'message' => 'Missing required data']);
    exit;
}

// Ensure data is received properly and is not empty
if ($format === 'pdf') {
    // Initialize TCPDF for PDF generation
    $pdf = new TCPDF('P', 'mm', 'LEGAL');
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Detailed Report - SKU: ' . htmlspecialchars($sku, ENT_QUOTES, 'UTF-8'));
    $pdf->AddPage();

    // Header
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Detailed Report - SKU: ' . htmlspecialchars($sku, ENT_QUOTES, 'UTF-8'), 0, 1, 'C');

    // Set filter information
    $pdf->SetFont('helvetica', '', 10);
    $dateRange = (!empty($startDate) && !empty($endDate)) ? date('F d, Y', strtotime($startDate)) . ' - ' . date('F d, Y', strtotime($endDate)) : 'All Dates';
    $pdf->Cell(0, 5, 'Transaction Type: ' . ucfirst(htmlspecialchars($transactionType, ENT_QUOTES, 'UTF-8')), 0, 1, 'C');
    $pdf->Cell(0, 5, 'Date Range: ' . $dateRange, 0, 1, 'C');

    // Set column headers
    $columnHeaders = ['Transaction Type', 'Date', 'Transaction No', 'Product Name', 'Quantity', 'Unit Price', 'Total Amount'];
    $columnWidths = [30, 30, 30, 40, 30, 30, 30];

    $pdf->Ln(5); // Line break
    $pdf->SetFont('helvetica', 'B', 12);
    foreach ($columnHeaders as $index => $header) {
        $pdf->Cell($columnWidths[$index], 10, $header, 1, 0, 'C');
    }
    $pdf->Ln();

    // Add transactions
    $pdf->SetFont('helvetica', '', 10);
    foreach ($transactions as $transaction) {
        $pdf->Cell($columnWidths[0], 10, ucfirst(htmlspecialchars($transaction['transaction_type'], ENT_QUOTES, 'UTF-8')), 1);
        $pdf->Cell($columnWidths[1], 10, date('Y-m-d', strtotime($transaction['created_at'])), 1);
        $pdf->Cell($columnWidths[2], 10, htmlspecialchars($transaction['transaction_no'], ENT_QUOTES, 'UTF-8'), 1);
        $pdf->Cell($columnWidths[3], 10, htmlspecialchars($transaction['product_name'], ENT_QUOTES, 'UTF-8'), 1);
        $pdf->Cell($columnWidths[4], 10, htmlspecialchars($transaction['item_qty'], ENT_QUOTES, 'UTF-8'), 1);
        $pdf->Cell($columnWidths[5], 10, number_format($transaction['item_rate'], 2), 1);
        $pdf->Cell($columnWidths[6], 10, number_format($transaction['item_amount'], 2), 1);
        $pdf->Ln();
    }

    // Output the PDF to a string (base64 encoded)
    $pdfOutput = $pdf->Output('S'); // Use 'S' to return the PDF as a string

    // Send the response with the PDF data
    echo json_encode(['success' => true, 'pdfUrl' => 'data:application/pdf;base64,' . base64_encode($pdfOutput)]);
    exit;
}

 elseif ($format === 'excel') {
    // Initialize PhpSpreadsheet for Excel export
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $sheet->setCellValue('A1', 'Transaction Type');
    $sheet->setCellValue('B1', 'Date');
    $sheet->setCellValue('C1', 'Transaction No');
    $sheet->setCellValue('D1', 'Product Name');
    $sheet->setCellValue('E1', 'Quantity');
    $sheet->setCellValue('F1', 'Unit Price');
    $sheet->setCellValue('G1', 'Total Amount');

    // Add transactions data to the sheet
    $row = 2; // Start from row 2 (row 1 is the header)
    foreach ($transactions as $transaction) {
        $sheet->setCellValue('A' . $row, ucfirst(htmlspecialchars($transaction['transaction_type'], ENT_QUOTES, 'UTF-8')));
        $sheet->setCellValue('B' . $row, date('Y-m-d', strtotime($transaction['created_at'])));
        $sheet->setCellValue('C' . $row, htmlspecialchars($transaction['transaction_no'], ENT_QUOTES, 'UTF-8'));
        $sheet->setCellValue('D' . $row, htmlspecialchars($transaction['product_name'], ENT_QUOTES, 'UTF-8'));
        $sheet->setCellValue('E' . $row, htmlspecialchars($transaction['item_qty'], ENT_QUOTES, 'UTF-8'));
        $sheet->setCellValue('F' . $row, number_format($transaction['item_rate'], 2));
        $sheet->setCellValue('G' . $row, number_format($transaction['item_amount'], 2));
        $row++;
    }

    // Create Excel file in memory
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $excelData = $writer->save('php://output'); // Output to browser

    // Return the Excel file data as a blob for download
    echo json_encode(['success' => true, 'excelData' => $excelData, 'excelFilename' => 'Detailed_Report_' . $sku . '_' . date('Ymd') . '.xlsx']);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid format']);
    exit;
}
?>
