<?
// DATABASE CONFIG
	$db="";
	$db_table="jtlwawi_sync";
	$username="";
	$password="";
	$host="localhost";

//END DATABASE CONFIG

mysql_connect($host,$username,$password) or die("Keine Verbindung moeglich");
mysql_select_db("$db") or die("Die Datenbank existiert nicht");
if(!mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$db_table."'"))) die("Die Tabelle existiert nicht");

?>