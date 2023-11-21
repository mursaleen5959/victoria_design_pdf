<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_POST['generatepdf']))
{
    header('location:index.php');
}

// Data here
$companyname = "Bumble Roofing 6800 \nOwensmouth Ave Suite 410 \nCanoga Park, CA 9130";

$name = $_POST['name'];
// $name = "Herbert Miesel";

$jobAddress = $_POST['jobAddress'];
// $jobAddress = '8108 Sunnybrae Arc';

$projectType = $_POST['projectType'];
// $projectType = 'Re-Roof Final';

// $completion = $_POST['completion'];
$completion = '';

$adder = $_POST['adder'];
// $adder = array('Fascia','Shiplap','Plywood');

$price = $_POST['price'];
// $price = array(500,400,100);

$amount = $_POST['amount'];
// $amount = array(3,4,8);

//

require_once('fpdf/fpdf.php');
require_once('fpdf/extension.php');
function insert_cell($pdf, $X = 0, $Y = 0, $CellWidth = 0, $CellHeight = 0, $text, $border = 0, $alignment = 'L',$fill=0)
{
    $pdf->SetY($Y);
    $pdf->SetX($X);
    $pdf->Cell($CellWidth, $CellHeight, $text, $border, 0, $alignment,$fill);
}
ob_start();
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetMargins(0, 0, 0);

$pdf->SetFont('times', 'B', 15);
$pdf->SetFillColor(255, 255, 255);
insert_cell($pdf, $X = 0, $Y = 10, $CellWidth = 0, $CellHeight = 7, $text = 'VICTORIA DESIGN SERVICES INC.', $border = 0, $alignment = 'C',$fill=1);

$pdf->Image('logo.jpeg',5,5,30);

$pdf->SetFont('times', 'B', 10);
$x = 145;
$y = 30;
$pdf->SetFillColor(77, 121, 255);
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 22, $CellHeight = 7, $text = 'DATE', $border = 1, $alignment = 'C',$fill=1);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 7, $text = 'INVOICE', $border = 1, $alignment = 'C',$fill=1);
$pdf->SetFillColor(255, 255, 255);
$x = 145;
$y += 7;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 22, $CellHeight = 7, $text = date('d/m/Y'), $border = 1, $alignment = 'C',$fill=1);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 7, $text = rand(), $border = 1, $alignment = 'C',$fill=1);
$x = $pdf->GetX();

$pdf->SetY(35);
$pdf->SetX(15);
$pdf->MultiCell(90,5,"5027 Webster St"."\n"."Oakland, CA 91303");

$x = 15;
$y = 50;
$pdf->SetFillColor(77, 121, 255);
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 90, $CellHeight = 7, $text = 'Company Name:', $border = 1, $alignment = 'L',$fill=1);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFont('times', '', 10);
$x = 15;
$y += 7;
//insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 60, $CellHeight = 7, $text = $name , $border = 1, $alignment = 'L',$fill=1);
$pdf->SetY($y);
$pdf->SetX($x);
$pdf->MultiCell(90,5,$companyname,1);

$x = 15;
$y = 80;
$pdf->SetFillColor(77, 121, 255);
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 90, $CellHeight = 7, $text = 'JOB ADDRESS:', $border = 1, $alignment = 'L',$fill=1);
$pdf->SetFillColor(255, 255, 255);
$x = 15;
$y = $pdf->GetY() + 7;
// insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 60, $CellHeight = 7, $text = $jobAddress, $border = 1, $alignment = 'L',$fill=1);
$pdf->SetY($y);
$pdf->SetX($x);
$pdf->MultiCell(90,5,$name."\n".$jobAddress,1);

$x = 15;
$y = $pdf->GetY() + 10;
$pdf->SetFillColor(77, 121, 255);
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 80, $CellHeight = 7, $text = 'DESCRIPTION:', $border = 1, $alignment = 'C',$fill=1);
$x = $pdf->GetX();
$before_x = $x;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 35, $CellHeight = 7, $text = 'AMOUNT', $border = 1, $alignment = 'C',$fill=1);
$pdf->SetFillColor(255, 255, 255);
$x = 15;
$y += 7;

// Rectangle position Start
$Rect_x_start = $x;
$Rect_y_start = $y;
///////

insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 80, $CellHeight = 7, $text = $projectType, $border = 0, $alignment = 'L');

$y += 3;
$total = 0;
for($i=0;$i<count($adder);$i++)
{
    $x = 15;
    $y += 4.5;
    $pdf->SetY($y);
    $pdf->SetX($x);
    $pdf->SetY($y);
    $pdf->SetX($x);
    $pdf->Write(5,$adder[$i]." @ ");
    $x = $pdf->GetX();
    $pdf->SetY($y);
    $pdf->SetX($x);
    $pdf->Write(5,"$".$price[$i]."");
    // $x = $pdf->GetX();
    $x = 110;
    $pdf->SetY($y);
    $pdf->SetX($x);
    $pdf->Write(5,"$".$amount[$i]."  ");



    // $pdf->SetY($y);
    // $pdf->SetX($x);
    // $pdf->Write(5,$amount[$i]."  ");
    // $x = $pdf->GetX();
    // $pdf->SetY($y);
    // $pdf->SetX($x);
    // $pdf->Write(5,$adder[$i]." x ");
    // $x = $pdf->GetX();
    // $pdf->SetY($y);
    // $pdf->SetX($x);
    // $pdf->Write(5,"$".$price[$i]." = ");
    // $x = $pdf->GetX();
    // $pdf->SetY($y);
    // $pdf->SetX($x);
    // $pdf->Write(5,"$".$price[$i]*$amount[$i]);
    $pdf->Ln(5);
    $total += $price[$i]*$amount[$i];
}
$y = $pdf->GetY()+2;
$x = 15;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 80, $CellHeight = 7, $text = "Total", $border = 1, $alignment = 'C');
$x = 95;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 35, $CellHeight = 7, $text = "$".$total, $border = 1, $alignment = 'C');

// Rectangle position End
$Rect_x_end = $x;
$Rect_y_end = $y+7;
///////
$Rect_height = $Rect_y_end - $Rect_y_start;
$pdf->Rect($Rect_x_start,$Rect_y_start,80,$Rect_height);
$pdf->Rect($Rect_x_start,$Rect_y_start,115,$Rect_height);


$pdf->SetFont('times', 'B', 15);
$pdf->SetY(250);
$pdf->SetX(15);
$pdf->MultiCell(90,6,"Thank you for choosing \n Victoria Design Services, INC",0,'L');







$filename = "file.pdf";
header('Content-type: application/pdf');
ob_clean();
$pdf->Output('I', $filename);