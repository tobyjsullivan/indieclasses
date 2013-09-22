INSERT INTO  `indieclasses`.`applied_updates` (
`id` ,
`version` ,
`applied`
)
VALUES (
NULL ,  '1.06', NOW( ));

--
-- Add class private flag
--
ALTER TABLE `classes` ADD COLUMN `private` INT(1) NOT NULL DEFAULT '0';
