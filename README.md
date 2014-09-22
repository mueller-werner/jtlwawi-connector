jtlwawi-connector
=================

JTLwawi to MySQL Webshop Connector



*** TODO DOCUMENTATION ***


---- hier nur ein snipp it aus einer email als vorläufigen ersatz ------ 

Die Schnittstelle funktioniert mit POST Request an eine in JTLwawi hinterlegte URL.
Als Referenz habe ich die vorhanden JTL-Wawi Connectoren von JTL selbst unter (http://www.jtl-software.de/JTL-Wawi-Download) und eine Open Source Implementierung für Magento ( http://www.jtlmage.de ) genommen. Alle connectoren basieren auf PHP. 

Eine Teil der Schnittstellen Dokumentation ist unter http://sourceforge.net/apps/mediawiki/jtlmage/index.php?title=Development zu finden.

Dafür existieren in einer Datenbank 8 Tabellen. ( Funktion steht in der Beschreibung der Tabelle selbst ) Hier aber noch mal kurz umrissen. 

ssc_customer - jeder Kunde einer Bestellung der nicht zugeordnet werden kann wird hier neu erstellt.
ssc_customerShipping - für jeden Bestellung wird hier die Lieferanschrift nochmals hinterlegt (lösung für das problem: bekannter kunde aber abweichende Lieferanschrift)
ssc_order - Die Bestellung
ssc_oderPOS - Die einzelnen Position zu einer Bestellung
ssc_oderPOSvar - Die jeweilige Variation zu den Postionen einer Bestellung

Die Schnittstelle erwartet die Artikelnummer die intern in JTLwawi angelegt wurden und leider nicht die Artikelnummer die man selbst vergibt. Gleiches gilt für die Variationen. Daher benötige ich noch 3 weiter Tabellen

ssc_map_sku - Artikelnummer aus dem Onlineshop zu Artikelnummer aus JTLwawi
ssc_map_var - Variations String aus dem Onlineshop zu Variations_id aus JTLwawi
ssc_map_var2sku - Tabelle zum Referenzieren Artikel_id zu Variation_id

befüllt werden diese im Synchronisation Prozess von JTLwawi selbst mit Aufruf der Dateien 
Artikel.php, Variation.php und VariationWert.php und sind Teil der Schnittstelle.

Wie der abgleich der Bestellungen abläuft ist hier beschrieben: http://sourceforge.net/apps/mediawiki/jtlmage/index.php?title=Development

Um die fehlenden Information zu ergänzen und den Prozess zu verfolgen kann man in Kombination mit der Datei log.php ein logfile "JTLwawi.log" erstellen.