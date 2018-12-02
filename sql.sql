

DROP database IF EXISTS `queueSystem`;
CREATE database `queueSystem`;


use queueSystem;

#--------------------------UserInfoTable----------------------------------

DROP TABLE IF EXISTS `UserInfoTable`;

CREATE TABLE `UserInfoTable` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id`int(11) DEFAULT NULL,
  `flag`int(11) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#--------------------------CustomerInfoTable----------------------------------

DROP TABLE IF EXISTS `CustomerInfoTable`;

CREATE TABLE `CustomerInfoTable` (
  `customer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#--------------------------StoreInfoTable----------------------------------

DROP TABLE IF EXISTS `StoreInfoTable`;

CREATE TABLE `StoreInfoTable` (
  `store_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `decribe` varchar(32) DEFAULT NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#--------------------------QueueTable----------------------------------

DROP TABLE IF EXISTS `QueueTable`;

CREATE TABLE `QueueTable` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#--------------------------StoreStateTable----------------------------------

DROP TABLE IF EXISTS `StoreStateTable`;

CREATE TABLE `StoreStateTable` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `open` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#CREATE USER 'queue_guest'@'%' IDENTIFIED BY 'qw#SDWe34+5fd_';
#GRANT SELECT, INSERT, UPDATE  ON queueSystem.* TO 'queue_guest'@'%';
#flush privileges;
