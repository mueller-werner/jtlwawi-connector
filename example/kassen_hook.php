<?PHP
include ('DATABASE_config.php');
$global_steuer = "19";
$add_shipping_costs = ($_POST['SHIPPING']) ? true : false;
$add_discount = ($total_gutschein) ? true : false;
$bestellnummer = $verw_zweck;

// KUNDE
$kunde_anrede = "";
$kunde_title = "";
$kunde_vorname = $_POST['vorname'];
$kunde_nachname = $_POST['nachname'];
$kunde_firma = "";
$kunde_strasse = trim($_POST['strasse']." ".$_POST['hausnummer']);
$kunde_plz = $_POST['plz'];
$kunde_ort = $_POST['wohnort'];
$kunde_land = $_POST['land'];
$kunde_fon = $_POST['tel'];
$kunde_fax = "";
$kunde_email = ($_POST['email']) ? strtolower($_POST['email']) : 'test@testlauf.de';
$kunde_haendler = "";
$kunde_rabatt = "";
$kunde_steuer = $global_steuer;
$kunde_newsletter = ($_POST['newsletter'] == "Yes") ? "Y" : "N";
$kunde_bdate = mach_datum($_POST['birthday']);
$kunde_adresszusatz = "";
$kunde_website = "";

$Kunde_array = array(
	$kundennummer,		//Kundenummer
	$kundennummer,		//Kundenummer 
	'',					//k.p.
	$kunde_anrede,		//Anrede (Herr|Frau)
	$kunde_title,		//Title
	$kunde_vorname,		//Vorname
	$kunde_nachname,	//Nachname
	$kunde_firma,		//Firmenname
	$kunde_strasse,		//Strasse + Hausnummer
	$kunde_plz,			//PLZ
	$kunde_ort,			//Ort
	$kunde_land,		//Land
	$kunde_fon,			//Rufnummer
	$kunde_fax,			//Fax
	$kunde_email,		//email
	$kunde_haendler,	//Händler (N|Y)
	$kunde_rabatt,		//Rabatt
	$kunde_steuer,		//Steuer
	$kunde_newsletter,	//Newsletter (N|Y)
	$kunde_bdate,		//Geburtsdatum
	$kunde_adresszusatz,//Adresszusatz
	$kunde_website		//Webseite
);

// KUNDENUMMER ermitteln SONST erzeugen
$resultkundennr = mysql_query("SELECT customer_id FROM ssc_customer WHERE email != '' AND email = '".$kunde_email."'") or die(mysql_error());
if(mysql_num_rows($resultkundennr)>0) {
	$kundennummer = mysql_result($resultkundennr, 0);
}else{
	mysql_query("INSERT INTO ssc_customer VALUES ('".implode('\',\'', $Kunde_array)."')") or die("ssc_customer:".mysql_error());
	$kundennummer =  mysql_insert_id();
}


// BESTELLUNG mit WEBSHOP FLAG
$zahlweise = 'Zahlungweise: '.$_POST['payment'];
$bestelldatum = date('Y-m-d H:m:s');
$kommentar = $_POST['message'];
$webshopflag = 'HE';

$Bestellung_array = array(
	$bestellnummer_ref,	//Bestellnummer wird an GetBestellungPos.php übermittelt
	$bestellnummer,		//Bestellnummer (?)
	$kundennummer,		//Kundennummer
	$bestellnummer_ref,	//Bestellnummer wird an GetAdresse.php übermittelt
	0, 					//VersandKey -1,0
	'', 				//VersandInfo
	'', 				//Versanddatum
	'', 				//Tracking Nr
	$zahlweise, 		//Information zur Zahlweise
	'', 				//Abgeholt
	'', 				//Status
	$bestelldatum,		//Bestelldatum
	$bestellnummer,		//Bestellnummer wird als Auftragsnummer an JTLwawi Übertragen
	$kommentar			//Kunden Kommentar
);

mysql_query("INSERT INTO ssc_order VALUES ('".implode('\',\'', $Bestellung_array)."','".$webshopflag."')") or die("ssc_order:".mysql_error());
$bestellnummer_ref =  mysql_insert_id();
mysql_query("UPDATE ssc_order SET ext_id2=$bestellnummer_ref WHERE order_id=$bestellnummer_ref");


// BESTELL POSITIONEN
foreach($cart->get_contents() as $item) {
	$artikel_exp = explode("|",$item['info'],2);
	$artikel_preis = number_format($item['price'],2);
	$artikel_steuer = $global_steuer;
	$artikel_anzahl = $item['qty'];
	$varitions_array = array("-XS.","-S.","-M.","-M-L.","-L.","-XL.","-XXL.","-3XL.","--.","-128-140.","-140-152.","-152-164.","-116-128.","-36-40.","-41-46.");
	$artikel_sku = substr(str_replace($varitions_array,".",$artikel_exp[0]."."),0,-1);

	$sku_result = mysql_query("SELECT JTL_id FROM ssc_map_sku WHERE sku='".$artikel_sku."'") or die(mysql_error());
	if(mysql_num_rows($sku_result)>0) {
		$artikel_id = mysql_result($sku_result,0);
	}else{
		$artikel_name = $artikel_exp[0];
	}


	$BestellungPos_array = array(
		$bestellnummer_pos,						//Position der Bestellung
		$bestellnummer_ref,						//Bestellnummer
		$artikel_id,							//Artikelnummer (muss ofenbar mit den ids von JTLwawi gemachted werden IST NICHT ARTIKEL NUMMER in JTLwawi)
		$artikel_name,							//Artikelname (wird offenbar nur verarbeitet wenn Artikelnummer nicht machted)
		$artikel_preis, 						//Artikel Einzelpreis
		$artikel_steuer,						//Steuer
		$artikel_anzahl							//Menge
	);

		mysql_query("INSERT INTO ssc_orderPOS VALUES ('".implode('\',\'', $BestellungPos_array)."')") or die("ssc_orderPos:".mysql_error());
		$bestellnummer_pos =  mysql_insert_id();

		// VARATION
	  if($artikel_id){
 		$variations_name = end(explode("-",$artikel_exp[0]));
 		$var_result =  mysql_query("SELECT ssc_map_var.JTL_var_id FROM ssc_map_var INNER JOIN ssc_map_var2art USING (JTL_tmp_id) WHERE JTL_id = $artikel_id AND `value` LIKE '%".$variations_name."%'");
 		if(mysql_num_rows($var_result)>0) {
			$variations_id = mysql_result($var_result,0);
			$variation_preis = "";

			$BestellungPosEigenschaft = array(
				$bestellPosition,						//variations_id
				$bestellnummer_pos,						//Position der Bestellung
				'',										//k.p.
				$variations_id,							//variation jtl id
				$variation_preis						//preis zuschlag (in % ?)
			);
			mysql_query("INSERT INTO ssc_orderPOSvar VALUES ('".implode('\',\'', $BestellungPosEigenschaft)."')") or die("ssc_orderPosvar : ".mysql_error());
		};
	  };

	  unset($artikel_name);
	  unset($artikel_id);
	  unset($bestellnummer_pos);
};

if($add_shipping_costs) {
	$versandname  = "POST VERSAND";
	$versandkosten = $_POST['SHIPPING'];

	$BestellungPos_array = array(
		'',										//Position der Bestellung
		$bestellnummer_ref,						//Bestellnummer
		0,										//Artikelnummer (variation abschneiden?)
		$versandname,							//Artikelname
		$versandkosten, 						//Artikel Einzelpreis
		$artikel_steuer,						//Steuer
		1										//Menge
	);

	mysql_query("INSERT INTO ssc_orderPOS VALUES ('".implode('\',\'', $BestellungPos_array)."')") or die("ssc_orderPos:".mysql_error());

};

if($add_discount) {
	$versandname  = "Rabatt";
	$gutscheinwert = ($total_gutschein > 0) ? $total_gutschein*-1 : $total_gutschein;

	$BestellungPos_array[] = array(
		'',										//Position der Bestellung
		$bestellnummer_ref,						//Bestellnummer
		0,										//Artikelnummer (variation abschneiden?)
		$versandname,							//Artikelname
		$gutscheinwert, 						//Artikel Einzelpreis (in % ?)
		$artikel_steuer,						//Steuer
		1										//Menge
	);

	mysql_query("INSERT INTO ssc_orderPOS VALUES ('".implode('\',\'', $BestellungPos_array)."')") or die("ssc_orderPos:".mysql_error());
}

// KUNDEN ADRESSE
$KundeAdr_array = array(
	$bestellnummer_ref,	//Bestellernummer Muss der selbe Wert sein wie Felder 1,2 und 4 in GetBestellung.php, sonst kann JTL die Lieferadresse nicht verknüpfen
	$kundennummer,		//Kundenummer
	$kunde_vorname,		//Vorname
	$kunde_nachname,	//Nachname
	$kunde_firma,		//Firmenname
	$kunde_strasse,		//Strasse + Hausnummer
	$kunde_plz,			//PLZ
	$kunde_ort,			//Ort
	$kunde_land,		//Land
	$kunde_fon,			//Rufnummer
	$kunde_fax,			//Fax
	$kunde_email,		//email
	'',					//Type (?)
	$kunde_anrede,		//Anrede (Herr|Frau)
	$kunde_adresszusatz //Adresszusatz
);

mysql_query("INSERT INTO ssc_customerShipping VALUES ('".implode('\',\'', $KundeAdr_array)."')") or die("ssc_customerShipping:".mysql_error());
?>