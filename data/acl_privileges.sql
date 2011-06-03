CREATE TABLE `acl_privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(64) NOT NULL,
  `controller` varchar(64) NOT NULL,
  `action` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;