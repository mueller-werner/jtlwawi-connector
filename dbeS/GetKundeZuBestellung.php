<?PHP
/**
GetKundeZuBestellung.php?KeyBestellung=100000001-1

Bsp.:
"9999998";"9999998";;"*****";;;"Johannes";"Müller-Werner";;"Musterstrasse. 6";"12345";"Berlin";"AF";"030 12345678";;"joahnnes.mw@icloud.com";;;"19";;;;; 0

**/
include("log.php");

if($_POST['KeyBestellung']) {
	include ('DATABASE_config');
	$result = mysql_query("SELECT
								ssc_customer.customer_id, 
								ssc_customer.ext_id, 
								free,
								'*****',
								form, 
								title, 
								vorname, 
								surname, 
								firm, 
								address, 
								zip, 
								city, 
								land, 
								phone, 
								fax, 
								email, 
								dealer, 
								discount, 
								tax, 
								newsletter, 
								DATE_FORMAT(bdate,'%d.%m.%Y'),
								sub_address, 
								website
						FROM ssc_customer INNER JOIN ssc_order USING(customer_id)
						WHERE order_id =  '".$_POST['KeyBestellung']."'"
			) or die(mysql_error());
	while ($row = mysql_fetch_assoc($result)) {
		echo '"'.implode('";"',$row).'"';
	}
	echo "\n 0";
}else{
	echo 1;
}
?>
