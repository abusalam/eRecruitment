<?php

include_once 'MyPDF.php';

$pdf = new PDF();
$Data = new DB();
$Query = "Select * from " . MySQL_Pre . "Admits";
//. " Where AppID='{$_SESSION['AppID']}'";
$Data->do_sel_query($Query);

$pdf->SetTitle("Attendance Sheet");
$pdf->AddPage();
/* $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(0, 4, "Attendance Sheet", 0, 1, "C");
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(0, 5, "Staff Recruitment Examination 2013", 0, 1, "C");
  $pdf->Cell(0, 4, "Paschim Medinipur Judgeship", 0, 1, "C");
  $pdf->Ln(4); */
$x = 0;
$y = 0;
$h = 22;
$w = 60;
$cpp = 3;
$rpp = 12;
$m = 15;
while ($Row = $Data->get_row()) {
//while ($y < 100) {
  $pdf->Rect($x + $m, $y + $m, $w, $h);
  $pdf->Ln(1);
  $pdf->SetXY($x + $m + 17, $y + $m + 1);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(42, 6, "Roll No. : " . $Row['RollNo'] . " - " . $Row['AppID'], 1, 1, "C");
  $pdf->SetX($x + $m + 18);
  $pdf->SetFont('Arial', '', 6);
  $pdf->Cell(40, 4, $Row['AppName'], 0, 1, "L");
  $pdf->SetX($x + $m + 18);
  $pdf->Cell(40, 4, "DOB: " . $Row['AppDOB'], 0, 1, "L");
  $pdf->SetX($x + $m + 18);
  $pdf->Cell(40, 4, "" . $Row['UploadedOn'], 0, 0, "L");
  $pdf->MemImage($Row['Photo'], $x + $m + 1, $y + $m + 1, 15);
  $x+=$w;

  if ($x == $w * $cpp)
    $y+=$h;
  $x%=$w * $cpp;

  if ($y == $h * $rpp)
    $pdf->AddPage();
  $y%=$h * $rpp;
}
$pdf->Output("AttendanceSheet.pdf", "D");
unset($pdf);
exit();
?>