<?PHP 
include ('DATABASE_config.php');
mysql_query("INSERT IGNORE INTO ssc_map_sku VALUES ('".$_POST['KeyArtikel']."','".$_POST['ArtikelName']."','".$_POST['ArtikelNo']."','".$_POST['ArtikelVKBrutto']."','".$_POST['ArtikelVKHaendlerBrutto']."','".$_POST['Hersteller']."','".$_POST['ArtikelKurzBeschreibung']."','".$_POST['ArtikelBeschreibung']."','".$_POST['Neu']."','".$_POST['TopAngebot']."','".$_POST['Lieferstatus']."','".$_POST['action']."')") or die(mysql_error());
include('echo_OK.php');
?>
