<?
session_start();
$db;
getDbConnection($db);
$masterEmail="scott.blanchard@norcom-usa.com";
function buildState($collection="",$selectName=""){
	$z=array("AK","AL","AR","AZ","CA","CO","CT","DC","DE","FL","GA","HI","IA","ID","IL","IN","KS","KY","LA","MA","MD","ME","MI","MN","MO","MP","MS","MT","NC","ND","NE","NH","NJ","NM","NV","NY","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VA","VT","WA","WI","WV","WY");
	echo "<option value=\"\"></option>";
	foreach($z as $y){?>
        <option value="<?=$y?>"<?=is_array($collection) && strlen(trim($selectName)) && $collection[$selectName]==$y?" selected=\"selected\"":""?>><?=$y?></option>
    <? }
}
function recordError($message,$dataArray=array()){
	global $masterEmail, $db;
	#echo $message;
}
function validateText($val){
	return !preg_match("/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i",$val);
}
function validateEmailAddress($val){
	return filter_var($val,FILTER_VALIDATE_EMAIL);
}
/***************************  DATABASE RELATED FUNCTIONS   **********************************/
function getDbConnection(&$dbConnection){
	$path=str_replace("norcomusa/www","norcomusa/",$_SERVER['DOCUMENT_ROOT'])."m.ini";
	$h=fopen($path,"r") or die("database connection failed");
	$c=explode("||",trim(fread($h,filesize($path))));
	$dbConnection=mysql_connect($c[0],$c[2],$c[3]);
	mysql_select_db($c[1],$dbConnection);
}
function query($sql){
	global $db;
	return mysql_query($sql,$db);	
}
function getRecordAssoc($rs){
	return ($rs)?mysql_fetch_assoc($rs):0;
}
function getRecordCount($rs){
	return ($rs)?mysql_num_rows($rs):0;
}
function getAffectedRows(){
	global $db;
	return mysql_affected_rows($db);
}
function getLastID(){
	global $db;
	return mysql_insert_id($db);
}
?>
