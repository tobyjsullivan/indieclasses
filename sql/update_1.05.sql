INSERT INTO  `indieclasses`.`applied_updates` (
`id` ,
`version` ,
`applied`
)
VALUES (
NULL ,  '1.05', NOW( ));


--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `to` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `body` longtext NOT NULL,
  `sent` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;