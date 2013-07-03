<?php
require_once('library.php');
initHTML5page();
?>
</head>
<body>
  <h2>eRecruitment Send SMS</h2>
  <?php
  switch (TRUE) {
    case (GetVal($_POST, "CmdShow") === "Search"):
      $Data = new DB();
      $Query = "Select `AppID` from " . MySQL_Pre . "AppIDMobileMap "
              . "Where `AppMobile` like '%" . GetVal($_POST, "AppMobile") . "%'";
      $AppID = $Data->do_max_query($Query);
      if ($AppID !== 0) {
        $TextSMS = "Applicant ID:{$AppID} \r\n--\r\neRecruitment 2013";
      } else {
        $TextSMS = "Mobile No. Not Found \r\n--\r\neRecruitment 2013";
      }
      $Data->do_close();
      break;
    case (GetVal($_POST, "CmdShow") === "Send"):
      $Data = new DB();
      $Data->SendSMS(GetVal($_POST, "TestSMS"), GetVal($_POST, "AppMobile"));
      $Data->do_close();
      break;
    default:
      $MobileNo = GetVal($_POST, "AppMobile");
      $TextSMS = GetVal($_POST, "TestSMS");
      break;
  }
  ?>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="number" name="AppMobile" maxlength="10" Value="<?php echo $MobileNo; ?>"/><br/>
    <textarea name="TestSMS" rows="6" maxlength="160"><?php echo $TextSMS; ?></textarea>
    <div style="clear:both;"></div>
    <input type="submit" value="Search" name="CmdShow" />
    <input type="submit" value="Send" name="CmdShow" />
  </form>
</body>
</html>