<?php
require_once('library.php');
initHTML5page();
IncludeCSS();
jQueryInclude();
IncludeCSS("css/jquery.Jcrop.css");
IncludeJS("js/jquery.Jcrop.js");
$_SESSION['AppID'] = "ASPA";
?>
<style type="text/css">
  .photo{
    margin-right:10px;
    width: 90px;height:120px;
    float: left;
    background-size: 90px 120px;
  }
</style>
</head>
<body>
  <div class="TopPanel">
    <div class="LeftPanelSide"></div>
    <div class="RightPanelSide"></div>
    <h1><?php echo AppTitle; ?></h1>
  </div>
  <div class="Header">
  </div>
  <?php
  require_once("topmenu.php");
  ?>
  <div class="content">
    <?php
    $Data = new DB();
    $Qry = "Select * from " . MySQL_Pre . "Admits";
    $Data->do_sel_query($Qry);
    while ($row = $Data->get_row()) {
      ?>
      <div class="Notice">
        <div class="photo" style="background-image:url('ShowPhoto.php?AppID=<?php echo $row['AppID']; ?>');"></div>
        <b><?php echo $row['AppID'] . " (" . $row['MobileNo'] . ") <br />Roll: " . $row['RollNo']; ?>:</b>
        <br /> <small><i><?php echo "AppID: {$row['AppSlNo']} <br />Name: {$row['AppName']}"; ?></i> </small>
        <b><br/>DOB:<?php echo $row['AppDOB']; ?></b>
        <small><br/><i><?php echo $row['GuardianName'] . " <br />" . $row['Address'] . " <br />Uploaded On: " . date("l d F Y g:i:s A", strtotime($row['UploadedOn'])); ?></i></small>
      </div>

    <?php }
    ?>
  </div>
  <div class="pageinfo"><?php pageinfo(); ?></div>
  <div class="footer"><?php footerinfo(); ?></div>
</body>
</html>