<?php
function UniqueRandAlpha(){
	$Data=new DB();
	for($i=0;$i<5;$i++)	{
		$AppID=RandStr(4);
		$S=str_split($AppID);
		$Exists=$Data->do_max_query("Select count(*) from ".MySQL_Pre."AppIDs Where AppID='".$AppID."'");
		while ($Exists>0) {
			$AppID=RandStr(4);
		}
		$Data->do_ins_query("Insert into ".MySQL_Pre."AppIDs(AppID) Values('".$AppID."')");
	}
	$Data->do_close();
}
function RsInWords($Amount)
{
	switch($Amount){
		case 200:
			return "Two Hundred Only";
			break;
		case 100:
			return "One Hundred Only";
			break;
		case 50:
			return "Fifty Only";
			break;
		case 25:
			return "Twenty Five Only";
			break;
		default:
			return "Sum of Amount Only";
	}
}
function InpSanitize($PostData){
	$Fields="";
	$Data=new DB();
	foreach ($PostData as $FieldName => &$Value){
		$Value=$Data->SqlSafe($Value);
		//$Fields=$Fields."<br />".$FieldName;
		if(($Value=="") ||(count($PostData)<23)){
			$_SESSION['Msg']="<b>Message:</b> Some Fields left unfilled.";
			$_SESSION['Step']="AppForm";
		}
	}
	unset($Value);
	//$PostData['Fields']=$Fields;
	//echo "Total Fields:".count($PostData);
	return $PostData;
}
function ShowMsg(){
	if(GetVal($_SESSION,"Msg")!=""){
		echo '<span class="Message">'.$_SESSION['Msg'].'</span><br/>';
		$_SESSION['Msg']="";
	}
}
function SendCURL($URL,$Method="GET",$PostData){
	// create a new cURL resource
	$URL=$URL;
	$ch = curl_init();
	if ($Method=="POST")
	{
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);
		curl_setopt($ch, CURLOPT_HEADER, 0);
	}
	else{
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_HEADER, 0);
	}
	//return the transfer as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// $output contains the output string
	$_SESSION['AuthResp']= json_decode(curl_exec($ch));
	// close cURL resource, and free up system resources
	curl_close($ch);
}
function HelplineReply($AppName,$TxtQry,$ReplyTxt){
	$Body= '<h2>'.AppTitle.'</h2><div>'.
				'<b>Your Query:</b><br/>'.
				str_replace("\r\n","<br />",$TxtQry).'<br/><br/>'.
				'<b>Reply:</b>'.
				'<p><i>'.str_replace("\r\n","<br />",$ReplyTxt).'</i></p>'.
			'</div>';
	return $Body;
}

class cURL {
	var $headers;
	var $user_agent;
	var $compression;
	var $cookie_file;
	var $proxy;
	function cURL($cookies=FALSE,$cookie='cookies.txt',$compression='gzip',$proxy='') {
		$this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
		$this->headers[] = 'Connection: Keep-Alive';
		$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
		$this->user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)';
		$this->compression=$compression;
		$this->proxy=$proxy;
		$this->cookies=$cookies;
		if ($this->cookies == TRUE) $this->cookie($cookie);
	}
	function cookie($cookie_file) {
		if (file_exists($cookie_file)) {
			$this->cookie_file=$cookie_file;
		} else {
			fopen($cookie_file,'w') or $this->error('The cookie file could not be opened. Make sure this directory has the correct permissions');
			$this->cookie_file=$cookie_file;
			fclose($this->cookie_file);
		}
	}
	function get($url) {
		$process = curl_init($url);
		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
		curl_setopt($process,CURLOPT_ENCODING , $this->compression);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}
	function post($url,$data) {
		$process = curl_init($url);
		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($process, CURLOPT_HEADER, 1);
		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
		curl_setopt($process, CURLOPT_ENCODING , $this->compression);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy);
		curl_setopt($process, CURLOPT_POSTFIELDS, $data);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process, CURLOPT_POST, 1);
		$return = curl_exec($process);
		$Status=curl_getinfo($process,CURLINFO_HTTP_CODE);
		curl_close($process);
		return $return." Status:".$Status;
	}
	function error($error) {
		echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
		die;
	}
}
?>