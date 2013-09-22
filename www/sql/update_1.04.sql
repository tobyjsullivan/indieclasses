INSERT INTO  `indieclasses`.`applied_updates` (
`id` ,
`version` ,
`applied`
)
VALUES (
NULL ,  '1.04', NOW( ));

--
-- Add class status
--
ALTER TABLE `classes` ADD COLUMN `succeeded` datetime DEFAULT NULL;

--
-- Fixing incorrect column type
--
ALTER TABLE  `registrations` CHANGE  `stripe_charge_id`  `stripe_charge_id` VARCHAR( 20 ) NULL DEFAULT NULL;