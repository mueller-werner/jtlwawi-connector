<?PHP 
include ('DATABASE_config.php');
mysql_query("INSERT IGNORE INTO ssc_map_sku VALUES ('".$_POST['KeyArtikel']."','".$_POST['ArtikelName']."','".$_POST['ArtikelNo']."')") or die(mysql_error());

include('echo_OK.php') 

?>
