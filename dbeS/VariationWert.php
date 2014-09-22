<?PHP 
include ('DATABASE_config.php');
mysql_query("INSERT IGNORE INTO ssc_map_var VALUES ('".$_POST['KeyEigenschaftWert']."','".$_POST['KeyEigenschaft']."','".$_POST['Name']."')") or die(mysql_error());

include('echo_OK.php') 
?>
