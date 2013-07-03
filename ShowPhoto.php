<?php

require_once('library.php');
session_start();
// Make sure an ID was passed
if (GetVal($_SESSION, 'AppID') !== NULL) {
  if ((GetVal($_GET, 'AppID') !== NULL) && (GetVal($_SESSION, 'AppID') == "ASPA")) {
    $PhotoID = $_GET['AppID'];
  } else {
    $PhotoID = $_SESSION['AppID'];
  }
  // Connect to the database
  $Data = new DB();
  // Fetch the file information
  $query = " SELECT `File`,`Size`,`mime` FROM " . MySQL_Pre . "Photos "
          . " WHERE `AppID` ='{$PhotoID}'";
  $result = $Data->do_sel_query($query);
  if ($result > 0) {
    $row = $Data->get_row();
    header("Content-type: " . $row['mime']);
    header("Content-length: " . strlen($row['File']));
    echo $row['File'];
  }
  $Data->do_close();
}
exit;
?>
