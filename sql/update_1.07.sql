INSERT INTO  `indieclasses`.`applied_updates` (
`id` ,
`version` ,
`applied`
)
VALUES (
NULL ,  '1.07', NOW( ));

--
-- Table structure for table `newsletter_recipients`
--

CREATE TABLE IF NOT EXISTS `newsletter_recipients` (
  `id` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `created` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE  `registrations` CHANGE  `amount`  `amount` DECIMAL( 11, 2 ) NOT NULL;