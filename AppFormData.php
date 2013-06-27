<?php

if (!isset($_SESSION['Step'])) {
  $_SESSION['Step'] = "Init";
} elseif ((GetVal($_POST, 'InsTerm') == "1") && ($_SESSION['Step'] == "Init"))
  $_SESSION['Step'] = "AppForm";
elseif ((GetVal($_POST, 'ChkDeclr') == "1") && ($_SESSION['Step'] == "AppForm")) {
  $_SESSION['Step'] = "VerifyData";
  $_SESSION['PostData'] = InpSanitize($_POST);
} elseif ((GetVal($_POST, 'CmdVerify') == "Verified All Data Please Proceed") && ($_SESSION['Step'] == "VerifyData")) {
  $Data = new DB();
  $Qry = "Insert Into " . MySQL_Pre . "Applications(`ResID`, `AppName`, `AppEmail`, `AppMobile`, `GuardianName`, `DOB`, `Sex`, `Nationality`,"
          . " `Religion`, `PreAddr`, `PrePinCode`, `PermAddr`, `PermPinCode`, `BelongsFrom`, `PhyHand`, `Qualification`, `ComKnowledge`,"
          . " `OrdTyping`, `Shorthand`, `GovServent`,`AppOQ`,`Status`,`SessionID`,`FiledOn`) "
          . "Values({$_SESSION['PostData']['AppPostID']},'{$_SESSION['PostData']['AppName']}','{$_SESSION['PostData']['AppEmail']}',"
          . "'{$_SESSION['PostData']['AppMobile']}','{$_SESSION['PostData']['GuardianName']}','{$_SESSION['PostData']['AppDOB']}',"
          . "'{$_SESSION['PostData']['AppSex']}','{$_SESSION['PostData']['AppNation']}','{$_SESSION['PostData']['AppRel']}',"
          . "'{$_SESSION['PostData']['AppPreA']}','{$_SESSION['PostData']['AppPrePin']}','{$_SESSION['PostData']['AppPerA']}',"
          . "'{$_SESSION['PostData']['AppPerPin']}','{$_SESSION['PostData']['AppCaste']}','{$_SESSION['PostData']['AppPH']}',"
          . "'{$_SESSION['PostData']['AppQlf']}','{$_SESSION['PostData']['AppCS']}','{$_SESSION['PostData']['AppOT']}',"
          . "'{$_SESSION['PostData']['AppSH']}','{$_SESSION['PostData']['AppGS']}','{$_SESSION['PostData']['AppOQ']}',"
          . "'Waiting for Bank Confirmation','" . session_id() . "',CURRENT_TIMESTAMP)";
  $Inserted = 0;
  //$Inserted=$Data->do_ins_query($Qry);
  $AppID = mysql_insert_id($Data->conn);
  $_SESSION['AppID'] = $Data->do_max_query("Select AppID from " . MySQL_Pre . "AppIDs where AppSlNo={$AppID}");
  $Data->do_close();
  $_SESSION['Qry'] = $Qry . "[{$AppID}]-{$_SESSION['AppID']}";
  if ($Inserted > 0) {
    $_SESSION['Msg'] = "<b>Message:</b> Your Application ID: {$_SESSION['AppID']}";
    $_SESSION['Step'] = "Print";
  } else {
    $_SESSION['Msg'] = "<b>Message:</b> Unable to submit your Application.";
    $_SESSION['Step'] = "AppForm";
  }
} elseif ((GetVal($_POST, 'CmdShow') == "Show Status") && ((GetVal($_POST, 'AppID') !== "")) && (GetVal($_POST, 'AppMobile') !== "")) {
  $Data = new DB();
  $_SESSION['AppID'] = strtoupper($Data->SqlSafe(htmlspecialchars($_POST['AppID'])));
  $Query = "Select A.ResID as `AppPostID`, AppName, GuardianName, AppEmail, Qualification as AppQlf, AppMobile, Fees, DOB as AppDOB, Sex as AppSex,"
          . "Religion as AppRel, BelongsFrom as AppCaste, Nationality as AppNation, PreAddr as AppPreA,PrePinCode as AppPrePin,"
          . "PermAddr as AppPerA, PermPinCode as AppPerPin, PhyHand as AppPH,ComKnowledge as AppCS, OrdTyping as AppOT,ShortHand as AppSH,"
          . "GovServent as AppGS, AppOQ, FiledOn,Status,LastUpdate,AppSlNo from " . MySQL_Pre . "Applications A," . MySQL_Pre . "Reserved R," . MySQL_Pre . "AppIDs P "
          . "Where A.ResID=R.ResID AND P.AppSlNo=A.AppID AND P.AppID='{$_SESSION['AppID']}' AND AppMobile='" . $Data->SqlSafe(htmlspecialchars($_POST['AppMobile'])) . "'";
  $Found = $Data->do_sel_query($Query);
  if ($Found > 0) {
    $Row = $Data->get_row();

    $_SESSION['PostData'] = $Row;
    $PhotoUploaded = $Data->do_max_query("Select AppID from " . MySQL_Pre . "Photos Where AppID='" . $_SESSION['AppID'] . "'");
    if ($PhotoUploaded === $_SESSION['AppID']) {
      $_SESSION['Step'] = "ShowAdmit";
    } else {
      $_SESSION['Step'] = "ShowData";
    }
    $_SESSION['Msg'] = "<b>Applicant ID:</b> " . $_SESSION['AppID'];
  } else {
    $_SESSION['Msg'] = "<b>Message:</b>Application not found!";
    $_SESSION['Step'] = "Init";
  }
  $Data->do_close();
} elseif ((GetVal($_POST, 'CmdPhoto') == "Proceed To Upload Photo") && ($_SESSION['Step'] == "ShowData")) {
  $_SESSION['Step'] = "InitAdmit";
} elseif ((GetVal($_POST, 'CmdSaveAdmit') == "Generate Admit") && ($_SESSION['Step'] == "InitAdmit")) {
  $targ_w = $_POST['w'];
  $targ_h = $_POST['h'];
  $jpeg_quality = 90;
  $img_r = imagecreatefromstring(file_get_contents($_FILES['AdmitPhoto']['tmp_name']));
  $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
  $ImgCopied = imagecopy($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $_POST['w'], $_POST['h']);
  if ($ImgCopied !== false) {
    ob_start();
    imagejpeg($dst_r, null, $jpeg_quality);
    $final_image = ob_get_clean();
  }
  imagedestroy($dst_r);
  imagedestroy($img_r);
  if ($ImgCopied === true) {
    $Data = new DB();
    $Qry = "Insert Into " . MySQL_Pre . "Photos(`FileName`,`AppID`,`File`,`Size`,`mime`)" .
            " Values('" . $_FILES['AdmitPhoto']['name'] . "','" . $_SESSION['AppID'] . "','" . mysql_real_escape_string($final_image) .
            "'," . intval($_FILES['AdmitPhoto']['size']) . ",'" . $_FILES['AdmitPhoto']['type'] . "')";
    $PhotoInserted = $Data->do_ins_query($Qry);
    $PhotoID = mysql_insert_id($Data->conn);
    if ($PhotoInserted > 0) {
      $RollNo = 1 + $Data->do_max_query("Select MAX(RollNo) from " . MySQL_Pre . "Applications Where ResID={$_SESSION['PostData']['AppPostID']}");
      $RollInserted = $Data->do_ins_query("Update " . MySQL_Pre . "Applications Set RollNo={$RollNo} Where AppID={$_SESSION['PostData']['AppSlNo']}");
      if ($RollInserted > 0) {
        $_SESSION['Msg'] = "<b>Message:</b> Photo uploaded for your Application ID: {$_SESSION['AppID']}";
        $_SESSION['PhotoID'] = $PhotoID;
        $_SESSION['Step'] = "ShowAdmit";
      }
    } else {
      $_SESSION['Msg'] = "<b>Message:</b> Unable to upload your photo.";
      $_SESSION['Step'] = "InitAdmit";
    }
    $Data->do_close();
  }
} elseif ((GetVal($_POST, 'CmdGetAdmit') == "Download") && ($_SESSION['Step'] == "ShowAdmit")) {

}

if (GetVal($_POST, 'CmdPrint') == "Search") {
  $Data = new DB();
  $_SESSION['AppID'] = strtoupper($Data->SqlSafe(htmlspecialchars($_POST['AppID'])));
  $Query = "Select AppName,AppMobile,Fees,DOB,FiledOn from " . MySQL_Pre . "Applications A," . MySQL_Pre . "Reserved R," . MySQL_Pre . "AppIDs P "
          . "Where A.ResID=R.ResID AND P.AppSlNo=A.AppID AND P.AppID='{$_SESSION['AppID']}' AND AppMobile='" . $Data->SqlSafe(htmlspecialchars($_POST['AppMobile'])) . "'";
  $Found = $Data->do_sel_query($Query);
  if ($Found > 0) {
    $Row = $Data->get_row();
    $_SESSION['Msg'] = "<b>Message:</b>Applicant: {$Row['AppName']}, Mobile:{$Row['AppMobile']}, Date of Birth: " . date("d/m/Y", strtotime($Row['DOB'])) . ".";
    $_SESSION['Step'] = "Print";
  } else {
    $_SESSION['Msg'] = "<b>Message:</b>Application not found!";
    $_SESSION['Step'] = "Init";
  }
  $Data->do_close();
}
?>