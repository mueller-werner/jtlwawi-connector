<?PHP 
/**
SetBestellung.php?KeyBestellung=100000001-1
Bsp.:
0  (feeback Bestellung abgeholt)

$_POST["action"] 
6 = Versand 
5 = von wawi abgeholt

bei 6
$_POST["VersandInfo"]
$_POST["VersandDatum"]
$_POST["Tracking"]
**/
include("log.php");

if($_POST['KeyBestellung']) {	
	include ('DATABASE_config.php');
	$result = mysql_query("UPDATE ssc_order SET status = CURRENT_DATE() WHERE order_id = '".$_POST['KeyBestellung']."'") or die(mysql_error());
	echo " 0";
}else{
	echo 1;
}

?>
