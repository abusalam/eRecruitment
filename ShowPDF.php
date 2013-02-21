<?php
include_once 'MyPDF.php';
if (strlen($_SESSION['AppID'])>0)
{
	$pdf=new PDF();
	ShowPDF(&$pdf,0);
	ShowPDF(&$pdf,1);
	ShowPDF(&$pdf,2);
}
function ShowPDF($pdf,$Pos=0)
{
	$Data=new DB();
	$Query="Select AppMobile,Fees from ".MySQL_Pre."Applications A,".MySQL_Pre."Reserved R,".MySQL_Pre."AppIDs P "
				."Where A.ResID=R.ResID AND P.AppSlNo=A.AppID AND P.AppID='{$_SESSION['AppID']}'";
	$Data->do_sel_query($Query);
	$Row=$Data->get_row();
	$FeesAmount=$Row['Fees'];
	$AppMobile=$Row['AppMobile'];
	$pdf->SetTitle("Pay-In-Slip");
	if($Pos==0)
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',8);
	$y=$pdf->GetY();
	$pdf->Cell(17,4,"Pay-In-Slip",1,0,"L");
	$pdf->SetX(172);
	if($Pos==0)
		$pdf->Cell(24,4,"Bank's Copy",1,1,"C");
	elseif ($Pos==1)
		$pdf->Cell(24,4,"Applicant's Copy",1,1,"C");
	else
		$pdf->Cell(24,4,"Original",1,1,"C");
	
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,5,"Staff Recruitment Examination 2013",0,1,"C");
	$pdf->Cell(0,4,"Paschim Medinipur Judgeship",0,1,"C");
	$pdf->SetY($pdf->GetY()-6);
	$pdf->Image("sbi_logo_main.gif",NULL,NULL,46);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(0,4,"................................................... Branch",0,0,"L");
	$pdf->Cell(0,4,"Date ............................ 20.........   ",0,1,"R");
	$pdf->Ln(2);
	$pdf->Cell(36,5,"Type of Account: SAVINGS",1,1,"L");
	$pdf->Ln(2);
	$pdf->Cell(24,5,"Account Number",1,0,"L");
	$pdf->SetFont('Courier','B',8);
	$pdf->Cell(22,5,"31278887992",1,0,"C");
	$pdf->SetX(162);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(14,5,"Amount",1,0,"L");
	$pdf->SetFont('Courier','B',8);
	$pdf->Cell(20,5,"Rs.**{$FeesAmount}/-",1,1,"R");
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(4,6,"For the credit of the Bank account of ............................................................  "
			."Rupees (in words) .................................",0,1,"L");
	$pdf->SetXY(70,$pdf->GetY()-6.5);
	$pdf->SetFont('Courier','B',8);
	$pdf->Cell(4,6,"District Judge, Paschim Medinipur                    ".RsInWords($FeesAmount),0,1,"L");
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(12,6,"Mobile",1,0,"L");
	$pdf->SetFont('Courier','B',8);
	$pdf->Cell(20,6,$AppMobile,1,1,"L");
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(12,6,"Branch",1,0,"L");
	$pdf->SetFont('Courier','B',8);
	$pdf->Cell(16,6,"MIDNAPUR",1,0,"L");
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(14,6,"Code No.",1,0,"L");
	$pdf->SetFont('Courier','B',8);
	$pdf->Cell(18,6,"SBIN00132",1,0,"L");
	$pdf->Ln(2);
	$pdf->SetXY(152,$pdf->GetY()-10);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(26,6,"Applicant ID",1,0,"L");
	$pdf->SetFont('Courier','B',12);
	$pdf->Cell(20,6,$_SESSION['AppID'],1,1,"C");
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(0,4,"__________________________________",0,1,"R");
	$pdf->Cell(0,6,"Full Signature of Applicant             ",0,1,"R");
	$pdf->Ln(5);
	if($Pos==2)
	{
		/*$pdf->SetXY(0,20);
		$pdf->SetFont('Courier','B',36);
		$pdf->Cell(0,6,"Sample Copy Not To Be Used",0,0,"C");
		$pdf->SetXY(0,100);
		$pdf->Cell(0,6,"Sample Copy Not To Be Used",0,0,"C");
		$pdf->SetXY(0,180);
		$pdf->Cell(0,6,"Sample Copy Not To Be Used",0,0,"C");*/
		$pdf->Output("Pay-in-Slip-[{$_SESSION['AppID']}].pdf","D");
		unset($pdf);
		exit();
	}
	else {
		$pdf->SetFont("Courier","",10);
		$pdf->Cell(200,3,"------------------------------------------------------------------------------------------------------------",0,1,"C");
		$pdf->Ln(10);
	}
	
}
?>