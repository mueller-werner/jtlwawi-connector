<?PHP
/**
 GetBestellung.php

 Bsp.: 
 "100000001-1";"100000001-1";"9999998";"100000001-1";"0";;;;"Zahlungsweise: Lastschrift";;;"27.02.2013";"100000001-1";; 0
**/
include("log.php");

include ('DATABASE_config.php');
$result = mysql_query("SELECT 
							order_id, 
							ext_id, 
							customer_id, 
							ext_id2, 
							shipping_key, 
							shipping_info, 
							IF(shipping_date!='0000-00-00',shipping_date,''),
							tracking_nr, 
							payment, 
							delivered, 
							`status`, 
							DATE_FORMAT(order_date,'%d.%m.%Y'),
							ext_id3, 
							`comment`
						FROM ssc_order 
						WHERE status = '' OR status IS NULL LIMIT 1") or die(mysql_error());
while ($row = mysql_fetch_assoc($result)) {
		echo '"'.implode('";"',$row).'"';
		echo "\n";
}
echo " 0";
?>
