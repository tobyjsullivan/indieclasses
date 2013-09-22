INSERT INTO  `indieclasses`.`applied_updates` (
`id` ,
`version` ,
`applied`
)
VALUES (
NULL ,  '1.01', NOW( ));

--
-- Add class status
--
ALTER TABLE `classes` ADD COLUMN `cancelled` datetime DEFAULT NULL;