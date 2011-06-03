CREATE TABLE IF NOT EXISTS `accounts_role_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` unsigned int(10) NOT NULL,
  `role_id` unsigned int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;