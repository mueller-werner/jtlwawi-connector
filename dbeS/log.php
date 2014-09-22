<?PHP
	$file = 'JTLwawi.log';
	$content = date("m.d.y H:m:s")." ".$_SERVER['PHP_SELF']."\n";

	foreach ($_POST as $key => $value) {
		$content .= $key.":".$value."\n";
	};

	if ( !file_exists($file)) touch ($file);
	
	$handle = fopen($file, "a");
	fwrite($handle, $content);
	fclose($handle);
	
?>