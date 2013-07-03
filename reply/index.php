<?php
ini_set('display_errors', 'On');
require_once( '../library.php');
initpage();
?>
<head>
  <meta name="robots" content="noarchive">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Reply Helpline - Paschim Medinipur</title>
  <style type="text/css" media="all" title="CSS By Abu Salam Parvez Alam">
    <!--
    @import url("../css/Style.css");
    -->
  </style>
</head>
<body>
  <div class="TopPanel">
    <div class="LeftPanelSide"></div>
    <div class="RightPanelSide"></div>
    <h1>
      <?php echo AppTitle; ?>
    </h1>
  </div>
  <div class="Header"></div>
  <?php
  require_once("../topmenu.php");
  ?>
  <div class="content">
    <h2>Helpline Reply Queries:</h2>
    <?php
    $Data = new DB();
    if (GetVal($_REQUEST, 'AdminUpload') == '1') {
      ?>
      <form name="frmLogin" method="post"
            action="<?php $_SERVER['PHP_SELF'] ?>">
        <label for="ReplyTo">To:</label> <select name="ReplyTo">
          <?php
          $Query = "SELECT HelpID,CONCAT('[',Replied,'] ',AppID) as `AppName` FROM " . MySQL_Pre . "Queries order by Replied,HelpID desc";
          $Data->show_sel("HelpID", "AppName", $Query, $_POST['ReplyTo']);
          ?>
        </select> <b>Show in FAQ:</b>
        <input type="radio" id="ShowFAQ" name="ShowFAQ" value="1" />
        <label for="ShowFAQ">Yes</label>
        <input type="radio" id="ShowFAQ" name="ShowFAQ" value="2" checked="checked"/>
        <label for="ShowFAQ">No</label><br />
        <label for="ReplyTxt">Reply:</label><br />
        <textarea id="ReplyTxt" name="ReplyTxt" rows="4" cols="80"
                  maxlength="300"></textarea>
        <input style="width: 80px;" type="submit" value="Reply" />
      </form>
      <?php
      if (isset($_POST['ReplyTo']) && ($_POST['ReplyTo'] != "") && ($_POST['ReplyTxt'] != "")) {
        $Query = "Update " . MySQL_Pre . "Helpline set Replied=" . intval($_POST['ShowFAQ']) . ", ReplyTxt='"
                . $Data->SqlSafe($_POST['ReplyTxt']) . "',ReplyTime=CURRENT_TIMESTAMP Where HelpID=" . $Data->SqlSafe($_POST['ReplyTo']);
        $Data->do_ins_query($Query);
        $Data->do_sel_query("Select AppName,AppEmail,TxtQry,ReplyTxt from " . MySQL_Pre . "Helpline Where HelpID=" . $Data->SqlSafe($_POST['ReplyTo']));
        $PostData = $Data->get_row();
        $AppMobile = $Data->do_max_query("Select AppMobile from " . MySQL_Pre . "AppIDMobileMap Where AppID='" . $PostData['AppName'] . "'");
        $_SESSION['AppID'] = $PostData['AppName'];
        if (intval($_POST['ShowFAQ']) === 1) {
          $Data->SendSMS($PostData['ReplyTxt'] . "\r\n--\r\neRecruitment 2013", $AppMobile);
          $_SESSION['Msg'] = "SMS sent to {$_SESSION['AppID']} Mobile: " . $AppMobile;
        }
        $PostData['Subject'] = "Helpline Reply from Paschim Medinipur Judgeship";
        $PostData['Body'] = HelplineReply($PostData['AppName'], $PostData['TxtQry'], $PostData['ReplyTxt']);
      }
      $Qry = "Select * from " . MySQL_Pre . "Queries"
              . " Where Replied!=1 Order by Replied,HelpID DESC";
    } else {
      $Qry = "Select * from " . MySQL_Pre . "Queries"
              . " Where RollNo is NULL Order by HelpID DESC";
    }
    $Data->do_sel_query($Qry);
    ShowMsg();
    //echo $Qry;
    $_SESSION['AppID'] = 'ASPA';
    while ($row = $Data->get_row()) {
      ?>
      <div class="Notice">
        <div style="margin-right:10px;width: 90px;height:120px;float: left;background-size: 90px 120px;background-image:url('../ShowPhoto.php?AppID=<?php echo $row['AppID']; ?>');"></div>
        <b><?php echo htmlspecialchars($row['AppID'] . "(" . $row['AppMobile'] . ") Roll: " . $row['RollNo']); ?>:</b><br />
        <?php echo str_replace("\r\n", "<br />", $row['TxtQry']); ?>
        <br /> <small><i><?php echo "From IP: {$row['IP']} On: " . date("l d F Y g:i:s A ", strtotime($row['QryTime'])); ?>
          </i> </small><br/><br/>
        <b>Reply[<?php echo $row['Replied']; ?>]:</b>
        <p>
          <i>&ldquo;<?php echo str_replace("\r\n", "<br />", $row['ReplyTxt']); ?>&rdquo;
          </i>
        </p>
        <small><i><?php echo "[" . $row['AppEmail'] . "] Replied On: " . date("l d F Y g:i:s A", strtotime($row['ReplyTime'])); ?></i></small>
      </div>

    <?php }
    ?>
  </div>
  <div class="pageinfo">
    <?php pageinfo(); ?>
  </div>
  <div class="footer">
    <?php footerinfo(); ?>
  </div>
</body>
</html>
