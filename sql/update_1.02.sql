INSERT INTO  `indieclasses`.`applied_updates` (
`id` ,
`version` ,
`applied`
)
VALUES (
NULL ,  '1.02', NOW( ));

--
-- Add class price range (for sliding-scale)
--
ALTER TABLE `classes` ADD COLUMN `price_range` int(3) DEFAULT NULL AFTER `price`;

ALTER TABLE `classes` ADD COLUMN `threshold` int(3) DEFAULT NULL AFTER `price_range`;

ALTER TABLE `classes` ADD COLUMN `threshold_type` varchar(20) DEFAULT 'students' AFTER `threshold`;

UPDATE classes SET threshold=min_attendees WHERE 1;

ALTER TABLE `classes` DROP COLUMN `min_attendees`;
