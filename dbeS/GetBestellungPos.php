<?PHP 
/**
GetBestellungPos.php?KeyBestellung=100000001-1

Bsp.: 
"13";"100000001-1";"837";"T-Shirt Lord Of The Rinks (Black)-M";"15.9664";"0.0000";"1.0000"; 
"14";"100000001-1";"837";"T-Shirt Lord Of The Rinks (Black)-XS";"10";"0.0000";"2.0000"; 
"15";"100000001-1";"0";"Versandkosten (Paketversand / Lastschrift)";"15";"0";"1"; 0
**/
include("log.php");

if($_POST['KeyBestellung']) {
	
	include ('DATABASE_config.php');
	$result = mysql_query("SELECT * FROM ssc_orderPOS WHERE order_id = '".$_POST['KeyBestellung']."'") or die(mysql_error());
	while ($row = mysql_fetch_assoc($result)) {
			echo '"'.implode('";"',$row).'"';
			echo "\n";
	}
	echo " 0";
	
}else{
	echo 1;
}
 ?>

