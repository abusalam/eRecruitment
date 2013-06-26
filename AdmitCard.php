<?php
ini_set('display_errors', 'On');

use LibDB as FN;

require_once('./login/functions.php');
initHTML5page();
?>
<head>
  <title>eRecruitment Application Status - Paschim Medinipur</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="robots" content="noarchive,noodp" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta name="description" content="Online application for recruitment of different posts in Paschim Medinipur"/>
  <?php
  FN\IncludeCSS();
  FN\jQueryInclude();
  FN\IncludeCSS("css/jquery.Jcrop.css");
  FN\IncludeJS("js/jquery.Jcrop.js");
  ?>
  <style type="text/css">
    form div.upload { overflow:hidden; }

    form div.upload label { font-weight:bold; display:block; margin-bottom:0.25em; }

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
  require_once 'AppFormData.php';
  ?>
  <div class="content">
    <?php
    ShowMsg();
    switch ($_SESSION['Step']) {
      default:
        ?>
        <h2>eRecruitment Application Status</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="FieldGroup">
            <h3>Applicant ID:</h3>
            <input type="text" name="AppID" maxlength="4" />
          </div>
          <div class="FieldGroup">
            <h3>Mobile No:</h3>
            <input type="text" name="AppMobile" maxlength="10" />
          </div>
          <input type="submit" value="Show Status" name="CmdShow" />
          <div style="clear:both;"></div>
        </form>
        <?php
        break;
      case "ShowData":
        ?>
        <h2>eRecruitment Application Status</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="FieldGroup">
            <div class="FieldLabel">Post Applied For:</div>
            <span class="ShowField">
              <?php
              $Data = new DB();
              echo $Data->do_max_query("select CONCAT(PostName,' [',PostGroup,']-',Category) as ResName"
                      . " from " . MySQL_Pre . "Posts P," . MySQL_Pre . "Categories C," . MySQL_Pre . "Reserved R"
                      . " Where P.PostID=R.PostID AND C.CatgID=R.CatgID AND ResID=" . $Data->SqlSafe($_SESSION['PostData']['AppPostID']));
              ?>
            </span>
          </div>
          <div class="FieldGroup">
            <div class="FieldLabel">E-Mail Address:</div>
            <span class="ShowField"><?php echo $_SESSION['PostData']['AppEmail']; ?></span>
          </div>
          <div class="FieldGroup">
            <div class="FieldLabel">Mobile No:</div>
            <span class="ShowField"><?php echo $_SESSION['PostData']['AppMobile']; ?></span>
          </div>
          <div class="FieldGroup">
            <div class="FieldLabel">Educational Qualification:</div>
            <span class="ShowField"><?php echo $_SESSION['PostData']['AppQlf']; ?></span>
          </div>
          <div style="clear:both;"></div>
          <hr />
          <div class="FieldGroup">
            <div class="FieldLabel">Applicant Name:</div>
            <span class="ShowField"><?php echo $_SESSION['PostData']['AppName']; ?></span>
            <div class="FieldLabel">Father/Husband Name:</div>
            <span class="ShowField"><?php echo GetVal($_SESSION['PostData'], "GuardianName"); ?></span>
            <div class="FieldLabel">Date of Birth:</div>
            <span class="ShowField"><?php echo date("d/m/Y", strtotime($_SESSION['PostData']['AppDOB'])); ?></span><br/>
            <div class="FieldLabel">Sex(Male/Female):</div>
            <span class="ShowField"><?php echo ($_SESSION['PostData']['AppSex'] == "M") ? "Male" : "Female"; ?></span><br/>
            <div class="FieldLabel">Religion:</div>
            <span class="ShowField"><?php echo $_SESSION['PostData']['AppRel']; ?></span><br/>
            <div class="FieldLabel">Caste:</div>
            <span class="ShowField"><?php echo $_SESSION['PostData']['AppCaste']; ?></span><br/>
          </div>
          <div class="FieldGroup">
            <div class="FieldLabel">Nationality:</div>
            <span class="ShowField"><?php echo $_SESSION['PostData']['AppNation']; ?></span>
            <div class="FieldLabel">Present Address:</div>
            <span class="ShowField"><?php echo str_replace("\\r\\n", "\r\n", $_SESSION['PostData']['AppPreA']); ?></span>
            <br/>
            <div class="FieldLabel">Pincode:</div>
            <span class="ShowField"><?php echo $_SESSION['PostData']['AppPrePin']; ?>
            </span><br/>
            <div class="FieldLabel">Permanent Address:</div>
            <span class="ShowField">
              <?php
              echo str_replace("\\r\\n", "\r\n", $_SESSION['PostData']['AppPerA']);
              ?>
            </span>
            <br/>
            <div class="FieldLabel">Pincode:</div>
            <span class="ShowField">
              <?php echo $_SESSION['PostData']['AppPerPin']; ?>
            </span>
            <br/>
          </div>
          <div class="FieldGroup">
            <div class="<?php echo ($_SESSION['PostData']['AppPH']) ? "CheckYes" : "CheckNo"; ?>">Are you Physically Challanged?</div>
            <div class="<?php echo ($_SESSION['PostData']['AppCS']) ? "CheckYes" : "CheckNo"; ?>">Have you any Knowledge in Computer?</div>
            <div class="<?php echo ($_SESSION['PostData']['AppOT']) ? "CheckYes" : "CheckNo"; ?>">Do you know ordinary Type-Writing?</div>
            <div class="<?php echo ($_SESSION['PostData']['AppSH']) ? "CheckYes" : "CheckNo"; ?>">Do you know Shorthand (English/Bengali)?</div>
            <div class="<?php echo ($_SESSION['PostData']['AppGS']) ? "CheckYes" : "CheckNo"; ?>">Are you a Govt. Servant?</div>
            <div class="<?php echo ($_SESSION['PostData']['AppOQ']) ? "CheckYes" : "CheckNo"; ?>">Do you have any Other Qualifications?</div>
          </div>
          <div style="clear:both;"></div>
          <div class="FieldGroup">
            <div class="FieldLabel">Aplication Submitted On:</div>
            <span class="ShowField"><?php echo "" . date("d/m/Y H:i:s A", strtotime($_SESSION['PostData']['FiledOn'])); ?></span>
          </div>
          <div class="FieldGroup">
            <div class="FieldLabel">Application Status:</div>
            <span class="ShowField"><?php echo $_SESSION['PostData']['Status']; ?></span>
          </div>
          <div class="FieldGroup">
            <div class="FieldLabel">Last Updated On:</div>
            <span class="ShowField"><?php echo "" . date("d/m/Y H:i:s A", strtotime($_SESSION['PostData']['LastUpdate'])); ?></span>
          </div>
          <div style="clear:both;"></div>
          <input type="submit" value="Proceed To Upload Photo" name="CmdPhoto" />
        </form>
        <?php
        break;
      case "InitAdmit":
        ?>
        <h2>eRecruitment Upload Photo</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
          <div class="UploadPhoto">
            <img class="ViewPhoto" />
            <label>Select a Photograph:</label>
            <input type="file" id="AdmitPhoto" name="AdmitPhoto" accept="image/*" required />
          </div>

          <script type="text/javascript">
            function updateCoords(c) {
              $('#x').val(c.x);
              $('#y').val(c.y);
              $('#w').val(c.w);
              $('#h').val(c.h);
            }
            ;
            $('input[type=file]').change(function(e) {
              if (typeof FileReader == "undefined")
                return true;

              var elem = $(this);
              var files = e.target.files;

              for (var i = 0, file; file = files[i]; i++) {
                if (file.type.match('image.*')) {
                  var reader = new FileReader();
                  reader.onload = (function(theFile) {
                    return function(e) {
                      var image = e.target.result;
                      previewDiv = $('.ViewPhoto', elem.parent());
                      previewDiv.attr({"src": image,
                        "complete": function() {
                          $('.ViewPhoto').Jcrop({
                            bgColor: 'black',
                            bgOpacity: .4,
                            setSelect: [0, 0, 180, 240],
                            aspectRatio: 3 / 4,
                            allowSelect: false,
                            onSelect: updateCoords});
                        }
                      });
                    };
                  })(file);
                  reader.readAsDataURL(file);
                }
              }
            });
          </script>
          <div style="clear:both;"></div>
          <input type="text" id="x" name="x" />
          <input type="text" id="y" name="y" />
          <input type="text" id="w" name="w" />
          <input type="text" id="h" name="h" />
          <input type="submit" value="Generate Admit" name="CmdSaveAdmit" />
        </form>
        <?php
        break;
      case "ShowAdmit":
        //$_SESSION['Step'] = "InitAdmit";
        ?>
        <h2>eRecruitment Applicant Photo</h2>
        <img src="ShowPhoto.php" />
        <?php
        break;
    }
    ?>
  </div>
  <div class="pageinfo"><?php pageinfo(); ?></div>
  <div class="footer"><?php footerinfo(); ?></div>
</body>
</html>