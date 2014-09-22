<?
// DATABASE CONFIG
	$db="";
	$username="";
	$password="";
	$host="localhost";

//END DATABASE CONFIG

mysql_connect($host,$username,$password) or die("Keine Verbindung moeglich");
mysql_select_db($db) or die("Die Datenbank existiert nicht");

?>