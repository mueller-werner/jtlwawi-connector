<?PHP
/**
GetPosEiegntschfaten.php?KeyBestellPos=13

Bsp.:
"13";"13";;;"0"; 0
**/
include("log.php");

if($_POST['KeyBestellPos']) {	
	include ('DATABASE_config.php');
	$result = mysql_query("SELECT * FROM ssc_orderPOSvar WHERE pos_id = '".$_POST['KeyBestellPos']."'") or die(mysql_error());
	while ($row = mysql_fetch_assoc($result)) {
		echo '"'.implode('";"',$row).'"';
	}
	echo "\n 0";
}else{
	echo 1;
}
?>
