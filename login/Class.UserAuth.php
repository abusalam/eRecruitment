<?php
namespaceeRecruitment\login;
useeRecruitment\library\GetVal;
include '../library.php';
class UserAuth {
	const AUTH_BROWSE = 0;
	const AUTH_LOGIN = 1;
	const AUTH_LOGGEDIN = 2;
	const AUTH_IDLE_TIMEOUT = 3;
	const AUTH_LOGGEDOUT = 4;
	private $PrevToken;
	private $AuthToken;
	Private $Status;
	private $TokenUpdated;
	private $Message;
	private $UseCred;
	private $SessionName;
	private $SessionID;
	function __construct ($UseCred = TRUE) {
		if (!isset($_SESSION)) {
			if (isset($_COOKIE))
				foreach ($_COOKIE as $SessName => $SessID) {
					$this->SessionName = $SessName;
					$this->SessionID = $SessID;
				}
			if (empty($this->SessionName))
				$this->SessionName = RandStr(rand(10, 20));
			$this->SessionName = session_name($this->SessionName);
			session_start();
			session_regenerate_id(TRUE);
			$this->SessionName = session_name();
		}
		$this->TokenUpdated = FALSE;
		$this->Status = (GetVal($_SESSION, 'AuthStatus') === NULL) ? self::AUTH_BROWSE : GetVal($_SESSION, 'AuthStatus');
		$this->AuthToken = GetVal($_SESSION, 'AuthToken');
		$this->PrevToken = GetVal($_SESSION, 'PrevToken');
		$this->UseCred = $UseCred;
	}
	private function Login () {
		$Str=<<<EOF
				<form action="{$_SERVER['PHP_SELF']}" method="post">
				<label for="UserID">User ID:</label><input type="text" id="UserID" name="UserID" />
				<label for="UserPass">Current Password:</label><input type="password" id="UserPass" name="UserPass" />
				<input type="hidden" id="UserID" name="UserID" /><input type="submit" />
				</form>
EOF;
		echo $Str;
		$this->Status = self::AUTH_LOGIN;
	}
	public function AuthCheck () {
		switch ($this->Status) {
			case self::AUTH_BROWSE:
				if ($this->UseCred) {
					$this->Login();
				}
				break;
			case self::AUTH_LOGIN:
				break;
		}
	}
	private function CheckSess () {
		$_SESSION['Debug'] = GetVal($_SESSION, 'Debug') . "InCheckSESS";
		if ((!isset($_SESSION['LoggedOfficerID'])) && (!isset($_SESSION['BlockCode']))) {
			return "Browsing";
		}
		if (isset($_REQUEST['LogOut'])) {
			return "LogOut";
		} else
			if ($_SESSION['LifeTime'] < (time() - (LifeTime * 60))) {
				return "TimeOut(" . $_SESSION['LifeTime'] . "-" . (time() - (
					LifeTime * 60)) . ")";
			} else
				if ($_SESSION['LMS_SID'] != $_COOKIE['LMS_SID']) {
					$_SESSION['Debug'] = "(" . $_SESSION['LMS_SID'] . "=" .
						$_COOKIE['LMS_SID'] . ")";
					return "Stolen(" . $_SESSION['LMS_SID'] . "=" . $_COOKIE[
						'LMS_SID'] . ")";
				} else {
					return "Valid";
				}
	}
	public function GetToken () {
		if (!$this->TokenUpdated) {
			$this->PrevToken = $this->AuthToken;
			$this->AuthToken = $this->SessionID;
			$this->TokenUpdated = TRUE;
		}
		return $this->AuthToken;
	}
	public function ChangePwd () {
		echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">"
				."<label for=\"OldUserPass\">Current Password:</label><input type=\"password\" id=\"OldUserPass\" name=\"OldUserPass\" />"
				."<label for=\"NewUserPass\">New Password:</label><input type=\"password\" id=\"NewUserPass\" name=\"NewUserPass\" />"
				."<label for=\"CnfUserPass\">Confirm New Password:</label><input type=\"password\" id=\"CnfUserPass\" name=\"CnfUserPass\" />"
				."<input type=\"hidden\" id=\"AuthToken\" name=\"AuthToken\" value=\"".$this->GetToken()."\" /><input type=\"submit\" />"
			."</form>";
	}
	private function Logout () {
	}
	function __destruct () {
		$_SESSION['AuthStatus'] = $this->Status;
		$_SESSION['PrevToken'] = $this->PrevToken;
		$_SESSION['AuthToken'] = $this->AuthToken;
	}
}
?>
