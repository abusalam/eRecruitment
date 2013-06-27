<?php

require_once('library.php');
session_start();
// Make sure an ID was passed
if (isset($_SESSION['AppID'])) {
  $PhotoID = $_SESSION['AppID'];
  // Connect to the database
  $Data = new DB();
  // Fetch the file information
  $query = " SELECT `File`,`Size`,`mime` FROM " . MySQL_Pre . "Photos "
          . " WHERE `AppID` ='{$PhotoID}'";
  $result = $Data->do_sel_query($query);
  if ($result > 0) {
    $row = $Data->get_row();
    header("Content-Type: " . $row['mime']);
    header("Content-Length: " . strlen($row['File']));
    echo $row['File'];
  }
  $Data->do_close();
}
exit;
?>
