/*
MySQL Data Transfer
Source Host: localhost
Source Database: mydb
Target Host: localhost
Target Database: mydb
Date: 2011/6/3 13:59:12
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for users
-- ----------------------------
CREATE TABLE `cadastroclientes` (
	`id` int(11) NOT NULL auto_increment,
	`nome` varchar(50) default NULL,
	`email` varchar(200) default NULL,
	`setor` varchar(200) default NULL,
	`exame` varchar(200) default NULL,
	`sinonimia` varchar(200) default NULL,
	`unidade` varchar(200) default NULL,
	`valoref` varchar(200) default NULL,
	`metodologia` varchar(200) default NULL,
	`prazo` varchar(200) default NULL,
	`apoio` varchar(200) default NULL,
	`material` varchar(200) default NULL,
	`jejum` varchar(200) default NULL,
	`valor` varchar(200) default NULL,
	`coleta` varchar(200) default NULL,
	`encaminha` varchar(200) default NULL,
	`uso` varchar(200) default NULL,
	`obs` varchar(200) default NULL,
	`ospt` varchar(200) default NULL,
	`status` varchar(200) default NULL,
 
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
