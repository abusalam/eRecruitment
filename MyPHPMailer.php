<?php
include ("eMailConfig.php");
include("./PHPMailer/class.phpmailer.php");
include("./PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

function GMailSMTP($AppEMail,$AppName,$Subject,$Body){
	$eMail= new PHPMailer();
	$eMail->IsSMTP();
	$eMail->SMTPAuth   = true;                  // enable SMTP authentication
	$eMail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$eMail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$eMail->Port       = 465;                   // set the SMTP port

	$eMail->Username   = GMail_UserID;  // GMAIL username
	$eMail->Password   = GMail_Pass;            // GMAIL password

	$eMail->From       = GMail_UserID;
	$eMail->FromName   = UserName;


	$eMail->Subject    = $Subject;
	$eMail->AltBody    = "View this page in HTML"; //Text Body
	$eMail->WordWrap   = 50; // set word wrap

	$eMail->MsgHTML($Body);

	$eMail->AddReplyTo(GMail_UserID,UserName);

	//$eMail->AddAttachment("/path/to/file.zip");             // attachment
	//$eMail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment

	$eMail->AddAddress($AppEMail,$AppName);

	$eMail->IsHTML(true); // send as HTML
	if(!$eMail->Send()) {
		$Resp['Status']= "Mailer Error: " . $eMail->ErrorInfo;
		$Resp['Sent']=FALSE;
	} else {
		$Resp['Status']="Message has been sent";
		$Resp['Sent']=TRUE;
	}
	$Resp['IP']="Requested From:".$_SERVER['REMOTE_ADDR'];
	return json_encode($Resp);
}
//if($_SERVER["REMOTE_ADDR"]==AllowedIP)
//{
	echo GMailSMTP(GetVal($_POST,'AppEmail'), GetVal($_POST,'AppName'), GetVal($_POST,'Subject'), GetVal($_POST,'Body'));
//}
?>