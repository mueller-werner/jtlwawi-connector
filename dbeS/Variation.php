<?PHP 
include ('DATABASE_config.php');
mysql_query("INSERT IGNORE INTO ssc_map_var2art VALUES ('".$_POST['KeyEigenschaft']."','".$_POST['KeyArtikel']."')") or die(mysql_error());

include('echo_OK.php') 
?>

