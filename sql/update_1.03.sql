INSERT INTO  `indieclasses`.`applied_updates` (
`id` ,
`version` ,
`applied`
)
VALUES (
NULL ,  '1.03', NOW( ));


--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `teacher_id` int(6) unsigned zerofill NOT NULL,
  `subscribed` datetime NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `teacher_id` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
