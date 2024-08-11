<?php
session_start();
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

require_once('./pdf/tcpdf.php');

class PDF extends TCPDF
{
    private $isArabic = false; // Flag to determine if the content is in Arabic

    public function setIsArabic($isArabic)
    {
        $this->isArabic = $isArabic;
    }

    // Page header
    public function Header()
    {
        // Logo
        $this->Image('./photo/logo.jpg', 2, 5, 25);
        // Set font for title
        $this->SetFont('dejavuserif', 'B', 15);

        // $this->Cell(80);
        $this->Cell(-74, 60, 'Elmarwa Hotel', 0, 1, 'C');
        // Line break
        $this->Ln(20);
    }


    // Function to create table with labels and values side by side
    public function FancyTable($header, $data)
    {
        $this->SetY(40); // Adjust this value as needed
        if ($this->isArabic) {
            $this->setRTL(true);
        } else {
            $this->setRTL(false);
        }

        // Colors, line width and bold font for header
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');

        // Width of the columns
        $w = array(80, 45); // Widths of the columns: label and value

        // Color and font restoration for data
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data
        $fill = false;
        foreach ($data as $row) {
            for ($i = 0; $i < count($header); $i++) {
                // Print header (label)
                $this->SetX(1.5);
                $this->Cell($w[1], 9, $header[$i], 1, 0, ($this->isArabic ? 'R' : 'L'), 1);
                // Print corresponding value
                $this->Cell($w[0], 9, $row[$i], 1, 1, ($this->isArabic ? 'R' : 'L'), $fill);
            }
            $fill = !$fill;
        }

        // Move to a new line for signature and stamp area
        $this->Ln(5); // Add some space after the table
    }
}

// حدد اللغة هنا
$isArabic = false; // إذا كنت تريد استخدام اللغة العربية، اجعل هذا المتغير true، إذا أردت الإنجليزية اجعله false

// Column headings based on language
$header = $isArabic ? array('اسم العميل', 'تاريخ الوصول', 'تاريخ المغادرة', 'رقم الغرفة', 'نوع الغرفة', 'المدفوع') : 
                        array('Client Name', 'Check-in Date', 'Check-Out Date' , 'Number of Nights' , 'Room Number', 'Room Type', 'Paid');

$id = $_GET['id'];
$sql = mysqli_query($connect, "SELECT rooms.r_number as room_number, appointment.* from appointment join rooms on rooms.id=appointment.roomID where apid = $id ");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $data = array(array($row['client_name'], $row['check_in'], $row['check_out'], $row['nights'] , $row['room_number']  , $row['r_type'], $row['paid'] . '  EGP'));
}

$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(128, 148)); // A6 size (105 x 148 mm)
$pdf->setIsArabic($isArabic);
$pdf->SetFont('dejavusans', '', 12);
$pdf->AddPage();
$pdf->FancyTable($header, $data);
$pdf->Output('receipt.pdf', 'I');
