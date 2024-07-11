<?php
// Define PDF_CREATOR constant
define('PDF_CREATOR', 'Your Company Name');

// Ensure the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize user data
    $userName = isset($_POST['user_name']) ? htmlspecialchars(trim($_POST['user_name'])) : '';
    $userEmail = isset($_POST['user_email']) ? htmlspecialchars(trim($_POST['user_email'])) : '';
    $marketShares = isset($_POST['market_shares']) ? json_decode($_POST['market_shares'], true) : [];

    // Validate data (optional: add more specific validation as needed)
    if (empty($userName) || empty($userEmail) || empty($marketShares)) {
        http_response_code(400);
        exit('Invalid or missing data');
    }

    // Include necessary libraries for PDF generation (fpdf)
    require_once('fpdf186/fpdf.php');

    // Create new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set document information
    $pdf->SetTitle('HHI Report');
    $pdf->SetAuthor('Your Name');
    $pdf->SetCreator(PDF_CREATOR);

    // Set font
    $pdf->SetFont('Arial', 'B', 16);

    // Add content
    $pdf->Cell(0, 10, 'HHI Report', 0, 1, 'C'); // Title

    // User information
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'User Name: ' . $userName, 0, 1);
    $pdf->Cell(0, 10, 'User Email: ' . $userEmail, 0, 1);

    // Market shares
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Market Shares:', 0, 1);

    foreach ($marketShares as $key => $data) {
        $companyName = isset($data['company_name']) ? $data['company_name'] : '';
        $marketShare = isset($data['market_share']) ? $data['market_share'] . '%' : '';

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Company Name: ' . $companyName . ', Market Share: ' . $marketShare, 0, 1);
    }

    // Output PDF to browser for download
    ob_end_clean(); // Clean output buffer before generating PDF
    $pdf->Output('hhi_report.pdf', 'D');
    exit;
} else {
    // Handle invalid requests
    http_response_code(400);
    exit('Invalid request');
}
?>
