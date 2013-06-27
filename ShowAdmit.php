<?php

include_once 'MyPDF.php';
if (strlen(GetVal($_SESSION, 'AppID')) > 0) {
  $pdf = new PDF();
  $Data = new DB();
  $Query = "Select * from " . MySQL_Pre . "Admits "
          . " Where AppID='{$_SESSION['AppID']}'";
  $Data->do_sel_query($Query);
  $Row = $Data->get_row();

  $pdf->SetTitle("AdmitCard");
  $pdf->AddPage();
  $pdf->Rect(10, 10, 190, 80);
  $pdf->Image("Sign.jpeg", 98, 72, 15);
  $pdf->MemImage($Row['Photo'], 160, 30, 20);
  $pdf->Ln(1);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(0, 4, "Admit Card", 0, 1, "C");
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(0, 5, "Staff Recruitment Examination 2013", 0, 1, "C");
  $pdf->Cell(0, 4, "Paschim Medinipur Judgeship", 0, 1, "C");
  $pdf->Ln(4);
  $pdf->SetXY(85, 30);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(40, 6, "Roll No.  : " . $Row['RollNo'], 1, 1, "C");
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(0, 5, "Name of the Candidate : " . $Row['AppName'], 0, 1, "L");
  $pdf->Cell(0, 5, "Father's / Husband's Name : " . $Row['GuardianName'], 0, 1, "L");
  $pdf->Cell(0, 5, "Address : " . $Row['Address'], 0, 1, "L");
  $pdf->Cell(0, 5, "Pin Code : " . $Row['PinCode'], 0, 1, "L");
  $pdf->Ln(2);
  $pdf->SetFont('Courier', 'B', 8);
  $pdf->Cell(0, 5, "Date of Examination : 04/08/2013", 0, 1, "L");
  $pdf->Cell(0, 5, "Time of Examination: 11.00am - 12.00am (Reporting Time - 10.30am)", 0, 1, "L");
  $pdf->Cell(0, 5, "Venue: Midnapore College, P.O.- Midnapore, Dist.- Paschim Medinipur", 0, 1, "L");
  $pdf->SetXY(150, 60);
  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(26, 6, "Applicant ID", 1, 0, "L");
  $pdf->SetFont('Courier', 'B', 12);
  $pdf->Cell(20, 6, $_SESSION['AppID'], 1, 1, "C");
  $pdf->Ln(4);
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(0, 4, "__________________________________", 0, 1, "R");
  $pdf->Cell(0, 4, "Full Signature of Applicant             ", 0, 1, "R");
  $pdf->SetFont('Arial', 'B', 6);
  $pdf->Cell(0, 3, "Chairman", 0, 1, "C");
  $pdf->Cell(0, 3, "District Selection Committee", 0, 1, "C");
  $pdf->Cell(0, 3, "Staff Recruitment Examination 2012-13", 0, 1, "C");
  $pdf->Cell(0, 3, "Paschim Medinipur", 0, 1, "C");
  $pdf->Output("AdmitCard-[{$_SESSION['AppID']}].pdf", "D");
  unset($pdf);
  exit();
}
?>