<?PHP 
/**
getAdresse.php?KeyAdresse=100000001-1

Bsp.:
"100000001-1";"9999998";"Johannes";"Müller-Werner";;"Agricolastr. 6";"10555";"Berlin";"AF";"030 41724421";;"j.werner@ssc-united.com";;;; 0
**/
include("log.php");

if($_POST['KeyAdresse']) {	
	include ('DATABASE_config.php');
	$result = mysql_query("SELECT * FROM ssc_customerShipping WHERE order_id = '".$_POST['KeyAdresse']."'") or die(mysql_error());
	while ($row = mysql_fetch_assoc($result)) {
		echo '"'.implode('";"',$row).'"';
	}
	echo " 0";
}else{
	echo 1;
}
 ?>
