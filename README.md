jtlwawi-connector
=================

JTLwawi to MySQL Webshop Connector


=============  System requirements  =============

    * Webserver:
          o PHP 5 or greater
          o Mysql

    * client:
          o JTL-Wawi v 0.99629 or greater 

=============  Installation instructions  =======


1) create a new url reachable folder on ure webserver 

2) put the dbeS folder there.

3) Import the contents of migration/jtlwawi_DB.sql into your database.

4) Adjust the entries in dbes/DATABASE_config.php to your specific needs.

5) Create a webshop from your JTL-Wawi installation:
          * Einstellungen -> Webshop-Einstellungen -> Hinzufügen
          * At this point, it is important to enter the correct URL pointing to the synchronisation scripts residing on the installation, WITHOUT the dbeS subfolder
                + i.e.: the connector was installed in /connector/dbeS. Enter the following information: http://<yourdomain>/connector. 
          * A basic connectivity check can be performed by clicking "Testen" 








*** TODO *** 

1) DOCUMENTATION 

2) functions

GetZahlungsInfo
setArtikel 
AnfangsNummern
Attribute
getCountArtikel
GetHaendlerKunden
Kategorie
KategorieArtikel
KategoriePict
News
setArtikelBild
SetFirma
SetHaendlerKunden
setKategorieBild
VersandArt
ArtikelPict
getArtikel



---- hier nur ein snipp it als vorläufigen Documentation Ersatz ------ 

Die Schnittstelle funktioniert mit POST Request an eine in JTLwawi hinterlegte URL.
Als Referenz habe ich die vorhanden JTL-Wawi Connectoren von JTL selbst unter (http://www.jtl-software.de/JTL-Wawi-Download) und eine Open Source Implementierung für Magento ( http://www.jtlmage.de ) genommen. Alle connectoren basieren auf PHP. 

Eine Teil der Schnittstellen Dokumentation ist unter http://sourceforge.net/apps/mediawiki/jtlmage/index.php?title=Development zu finden.

In meiner Implementierung existieren in einer Datenbank 8 Tabellen. ( Funktion steht in der Beschreibung der Tabelle selbst ) Hier aber noch mal kurz umrissen. 

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