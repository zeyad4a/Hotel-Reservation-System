<?php
session_start();
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
require('./pdf/fpdf.php');



class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('./photo/logo.png', 0, 5, 25);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(-74, 40, 'Elmarwa Hotel', 0, 1, 'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 5);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Function to create table with labels and values side by side
    function FancyTable($header, $data)
    {
        // Set position Y (move table down)
        $this->SetY(40); // Adjust this value as needed

        // Colors, line width and bold font for header
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        // Width of the columns
        $w = array(42, 60); // Widths of the columns: label and value

        // Color and font restoration for data
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data
        $fill = false;
        foreach ($data as $row) {
            for ($i = 0; $i < count($header); $i++) {
                // Print header (label)
                $this->SetX(1.5); // Ensure each label starts from the left edge
                $this->Cell($w[0], 9, $header[$i], 1, 0, 'L', true);
                // Print corresponding value
                $this->Cell($w[1], 9, $row[$i], 1, 9, 'L', $fill);
            }
            $this->Ln();
            $fill = !$fill;
        }

        // Move to a new line for signature and stamp area
        $this->Ln(5); // Add some space after the table

        // Add signature and stamp areas
        $this->SetX(10);
        $this->Cell(60, 0, 'Signature:', 0, 0, 'L');
        $this->Cell(50, 0, 'Stamp:', 0, 1, 'L');

    }
}

// Column headings
$header = array('Client Name', 'Check_in Date', 'Check-Out Date' , 'Room Number', 'Room Type', 'Payed');


$id = $_GET['id'];
// $uid = $_GET['uid']; 
$sql = mysqli_query($connect, "SELECT rooms.r_number as room_number, appointment.* from appointment join rooms on rooms.id=appointment.roomID where apid = $id ");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $data = array(
        array($row['client_name'], $row['check_in'], $row['check_out'], $row['room_number'], $row['r_type'], $row['paid'] . '  EGP'),
        // Add more rows as needed
    );
}

$pdf = new PDF('P', 'mm', array(105, 148)); // A6 size (105 x 148 mm)
$pdf->SetFont('Arial', '', 14);
$pdf->AddPage();
$pdf->FancyTable($header, $data);
$pdf->Output();


