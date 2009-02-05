CREATE TABLE `[prefix]__groups` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
);

INSERT INTO `[prefix]__groups` (`name`) VALUES ('SuperAdmin');
INSERT INTO `[prefix]__groups` (`name`) VALUES ('Amdin');

CREATE TABLE `[prefix]__users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `password_reset` varchar(64) NOT NULL,
  `activation_code` varchar(64) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  `active` tinyint(1) unsigned NOT NULL,
  `created` datetime,
  `modified` datetime,
  PRIMARY KEY  (`id`),
  KEY `group_id` (`group_id`)
); 

CREATE TABLE `[prefix]__groups_permissions` (
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
);

CREATE TABLE `[prefix]__groups_users` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
);

CREATE TABLE `[prefix]__permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
);
