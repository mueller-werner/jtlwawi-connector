SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `ssc_customer`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_customer`;
CREATE TABLE `ssc_customer` (
  `customer_id` int(11) NOT NULL auto_increment,
  `ext_id` varchar(25) NOT NULL default '',
  `free` varchar(255) default NULL,
  `form` varchar(255) default NULL,
  `title` varchar(255) default NULL,
  `vorname` varchar(255) default NULL,
  `surname` varchar(255) default NULL,
  `firm` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `zip` varchar(255) default NULL,
  `city` varchar(255) default NULL,
  `land` varchar(255) default NULL,
  `phone` varchar(255) default NULL,
  `fax` varchar(255) default NULL,
  `email` varchar(255) NOT NULL default '',
  `dealer` char(1) default NULL,
  `discount` char(1) default NULL,
  `vat` varchar(255) default NULL,
  `newsletter` char(1) default NULL,
  `bdate` date default NULL,
  `sub_address` varchar(255) default NULL,
  `website` varchar(255) default NULL,
  PRIMARY KEY  (`customer_id`)
) TYPE=InnoDB COMMENT='Kunden für JTLwawi';

-- ----------------------------
--  Table structure for `ssc_customerShipping`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_customerShipping`;
CREATE TABLE `ssc_customerShipping` (
  `order_id` int(25) NOT NULL default '0',
  `customer_id` int(11) NOT NULL default '0',
  `vorname` varchar(255) NOT NULL default '',
  `surname` varchar(255) NOT NULL default '',
  `firm` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `zip` varchar(5) NOT NULL default '',
  `city` varchar(255) NOT NULL default '',
  `land` varchar(255) NOT NULL default '',
  `fon` varchar(255) NOT NULL default '',
  `fax` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `typ` varchar(255) NOT NULL default '',
  `form` varchar(255) NOT NULL default '',
  `sub_address` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`order_id`),
  KEY `customer_id` (`customer_id`)
) TYPE=InnoDB COMMENT='Bestellung Versandadresse kein trigger für Bestell,Kunden';

-- ----------------------------
--  Table structure for `ssc_map_sku`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_map_sku`;
CREATE TABLE `ssc_map_sku` (
  `JTL_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `sku` varchar(255) NOT NULL default '',
  `VKBrutto` decimal(11,4) NOT NULL default '0.0000',
  `dealerVKBrutto` decimal(11,4) NOT NULL default '0.0000',
  `hersteller` varchar(255) NOT NULL default '',
  `KurzBeschreibung` varchar(255) NOT NULL default '',
  `Beschreibung` varchar(255) NOT NULL default '',
  `neu` char(1) NOT NULL default '',
  `TopAngebot` char(1) NOT NULL default '',
  `Lieferstatus` varchar(255) NOT NULL default '',
  `aktion` int(2) NOT NULL default '0',
  PRIMARY KEY  (`JTL_id`),
  KEY `sku` (`sku`)
) TYPE=InnoDB COMMENT='Artikelnummern zu Artikel_id';

-- ----------------------------
--  Table structure for `ssc_map_var`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_map_var`;
CREATE TABLE `ssc_map_var` (
  `JTL_var_id` int(11) NOT NULL default '0',
  `JTL_tmp_id` int(11) NOT NULL default '0',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`JTL_var_id`,`value`),
  KEY `jtlid` (`JTL_tmp_id`)
) TYPE=InnoDB COMMENT='Bestellvariation';

-- ----------------------------
--  Table structure for `ssc_map_var2art`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_map_var2art`;
CREATE TABLE `ssc_map_var2art` (
  `JTL_tmp_id` int(11) NOT NULL default '0',
  `JTL_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`JTL_tmp_id`),
  KEY `jtlid` (`JTL_id`)
) TYPE=InnoDB COMMENT='Artikel_id zu Variation';

-- ----------------------------
--  Table structure for `ssc_order`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_order`;
CREATE TABLE `ssc_order` (
  `order_id` int(25) NOT NULL auto_increment,
  `ext_id` varchar(20) default NULL,
  `customer_id` int(11) NOT NULL default '0',
  `ext_id2` varchar(255) default NULL,
  `shipping_key` varchar(255) NOT NULL default '0',
  `shipping_info` varchar(255) default NULL,
  `shipping_date` date default NULL,
  `tracking_nr` varchar(255) default NULL,
  `payment` varchar(255) NOT NULL default '',
  `delivered` varchar(255) default NULL,
  `status` varchar(255) default NULL,
  `order_date` datetime default NULL,
  `ext_id3` varchar(20) default NULL,
  `comment` varchar(255) default NULL,
  `webshop` char(2) NOT NULL default '',
  PRIMARY KEY  (`order_id`),
  KEY `customer_id` (`customer_id`)
) TYPE=InnoDB COMMENT='Bestellungen für JTLwawi';

-- ----------------------------
--  Table structure for `ssc_orderPOS`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_orderPOS`;
CREATE TABLE `ssc_orderPOS` (
  `pos_id` int(30) NOT NULL auto_increment,
  `order_id` int(25) NOT NULL default '0',
  `sku` varchar(255) NOT NULL default '',
  `sku_name` varchar(255) NOT NULL default '',
  `sku_price` varchar(255) default NULL,
  `sku_tax` varchar(255) NOT NULL default '',
  `sku_qty` int(11) NOT NULL default '1',
  PRIMARY KEY  (`pos_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `orderid` FOREIGN KEY (`order_id`) REFERENCES `ssc_order` (`order_id`) ON DELETE CASCADE
) TYPE=InnoDB COMMENT='Bestellpostion für JTLwawi';

-- ----------------------------
--  Table structure for `ssc_orderPOS_copy`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_orderPOS_copy`;
CREATE TABLE `ssc_orderPOS_copy` (
  `pos_id` int(30) NOT NULL auto_increment,
  `order_id` int(25) NOT NULL default '0',
  `sku` varchar(255) NOT NULL default '',
  `sku_name` varchar(255) NOT NULL default '',
  `sku_price` varchar(255) default NULL,
  `sku_tax` varchar(255) NOT NULL default '',
  `sku_qty` int(11) NOT NULL default '1',
  PRIMARY KEY  (`pos_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `ssc_orderPOS_copy_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ssc_order` (`order_id`) ON DELETE CASCADE
) TYPE=InnoDB COMMENT='Bestellpostion für JTLwawi';

-- ----------------------------
--  Table structure for `ssc_orderPOSvar`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_orderPOSvar`;
CREATE TABLE `ssc_orderPOSvar` (
  `var_id` int(11) NOT NULL auto_increment,
  `pos_id` int(30) NOT NULL default '0',
  `free` varchar(255) default NULL,
  `var_name` varchar(255) NOT NULL default '',
  `var_price` varchar(255) default NULL,
  PRIMARY KEY  (`var_id`),
  UNIQUE KEY `pos2var` (`pos_id`,`var_name`),
  KEY `pos_id` (`pos_id`),
  CONSTRAINT `posid` FOREIGN KEY (`pos_id`) REFERENCES `ssc_orderPOS` (`pos_id`) ON DELETE CASCADE
) TYPE=InnoDB COMMENT='Bestellvariation für JTLwawi';

-- ----------------------------
--  Table structure for `ssc_orderPOSvar_copy`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_orderPOSvar_copy`;
CREATE TABLE `ssc_orderPOSvar_copy` (
  `var_id` int(11) NOT NULL auto_increment,
  `pos_id` int(30) NOT NULL default '0',
  `free` varchar(255) default NULL,
  `var_name` varchar(255) NOT NULL default '',
  `var_price` varchar(255) default NULL,
  PRIMARY KEY  (`var_id`),
  UNIQUE KEY `pos2var` (`pos_id`,`var_name`),
  KEY `pos_id` (`pos_id`),
  CONSTRAINT `ssc_orderPOSvar_copy_ibfk_1` FOREIGN KEY (`pos_id`) REFERENCES `ssc_orderPOS` (`pos_id`) ON DELETE CASCADE
) TYPE=InnoDB COMMENT='Bestellvariation für JTLwawi';

-- ----------------------------
--  Table structure for `ssc_order_copy`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_order_copy`;
CREATE TABLE `ssc_order_copy` (
  `order_id` int(25) NOT NULL auto_increment,
  `ext_id` varchar(20) default NULL,
  `customer_id` int(11) NOT NULL default '0',
  `ext_id2` varchar(255) default NULL,
  `shipping_key` varchar(255) NOT NULL default '0',
  `shipping_info` varchar(255) default NULL,
  `shipping_date` date default NULL,
  `tracking_nr` varchar(255) default NULL,
  `payment` varchar(255) NOT NULL default '',
  `delivered` varchar(255) default NULL,
  `status` varchar(255) default NULL,
  `order_date` datetime default NULL,
  `ext_id3` varchar(20) default NULL,
  `comment` varchar(255) default NULL,
  `webshop` char(2) NOT NULL default '',
  PRIMARY KEY  (`order_id`),
  KEY `customer_id` (`customer_id`)
) TYPE=InnoDB COMMENT='Bestellungen für JTLwawi';

SET FOREIGN_KEY_CHECKS = 1;
