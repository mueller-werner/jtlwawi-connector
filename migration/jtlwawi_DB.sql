SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `jtlwawi_einstellungen`
-- ----------------------------
DROP TABLE IF EXISTS `jtlwawi_einstellungen`;
CREATE TABLE `jtlwawi_einstellungen` (
  `cName` varchar(255) NOT NULL DEFAULT '',
  `cWert` varchar(255) DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `jtlwawi_martikel`
-- ----------------------------
DROP TABLE IF EXISTS `jtlwawi_martikel`;
CREATE TABLE `jtlwawi_martikel` (
  `product_id` int(10) unsigned NOT NULL DEFAULT '0',
  `kArtikel` int(10) unsigned DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `jtlwawi_mbestellpos`
-- ----------------------------
DROP TABLE IF EXISTS `jtlwawi_mbestellpos`;
CREATE TABLE `jtlwawi_mbestellpos` (
  `kBestellPos` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_item_id` int(10) unsigned DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`kBestellPos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `jtlwawi_mkategorie`
-- ----------------------------
DROP TABLE IF EXISTS `jtlwawi_mkategorie`;
CREATE TABLE `jtlwawi_mkategorie` (
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `kKategorie` int(10) unsigned DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `jtlwawi_mvariation`
-- ----------------------------
DROP TABLE IF EXISTS `jtlwawi_mvariation`;
CREATE TABLE `jtlwawi_mvariation` (
  `kEigenschaft` int(10) unsigned NOT NULL DEFAULT '0',
  `attribute_name` varchar(255) DEFAULT NULL,
  `kArtikel` int(11) DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL DEFAULT '0',
  `attribute_id` int(10) unsigned NOT NULL DEFAULT '0',
  `product_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attribute_id`),
  KEY `kEigenschaft` (`kEigenschaft`),
  KEY `product_id` (`product_id`),
  KEY `attribute_name` (`attribute_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `jtlwawi_mvariationswert`
-- ----------------------------
DROP TABLE IF EXISTS `jtlwawi_mvariationswert`;
CREATE TABLE `jtlwawi_mvariationswert` (
  `attribute_value` varchar(255) NOT NULL DEFAULT '',
  `kEigenschaftsWert` int(10) unsigned DEFAULT NULL,
  `kEigenschaft` int(10) unsigned DEFAULT NULL,
  `kArtikel` int(11) DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL DEFAULT '0',
  `attribute_id` int(10) unsigned NOT NULL DEFAULT '0',
  `attribute_value_id` int(10) unsigned NOT NULL DEFAULT '0',
  `product_id` int(10) unsigned NOT NULL DEFAULT '0',
  `attribute_value_ganz` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`attribute_value_id`),
  KEY `product_id` (`product_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `kEigenschaftsWert` (`kEigenschaftsWert`),
  KEY `attribute_value` (`attribute_value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `jtlwawi_sentorders`
-- ----------------------------
DROP TABLE IF EXISTS `jtlwawi_sentorders`;
CREATE TABLE `jtlwawi_sentorders` (
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dGesendet` datetime DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `jtlwawi_sync`
-- ----------------------------
DROP TABLE IF EXISTS `jtlwawi_sync`;
CREATE TABLE `jtlwawi_sync` (
  `cName` varchar(255) DEFAULT NULL,
  `cPass` varchar(255) DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `jtlwawi_sync`
-- ----------------------------
BEGIN;
INSERT INTO `jtlwawi_sync` VALUES ('admin', 'pass', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ssc_orders`
-- ----------------------------
DROP TABLE IF EXISTS `ssc_orders`;
CREATE TABLE `ssc_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `cdate` datetime NOT NULL,
  `customer_note` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
