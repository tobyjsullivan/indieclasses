<?php
// Company Configuration
Configure::write('Company.name', 'Indie Classes');
Configure::write('Company.url', 'http://indieclasses.com');
Configure::write('Company.email', 'contact@indieclasses.com');
Configure::write('Company.no-reply', 'no-reply@indieclasses.com');

// Debug info
Configure::write('Instance.debug', '1');

// Stripe Configuration
Configure::write('Stripe.pkey', '');
Configure::write('Stripe.skey', '');

// MySQL Configuration
Configure::write('Mysql.hostname', 'localhost');
Configure::write('Mysql.username', '');
Configure::write('Mysql.password', '');
Configure::write('Mysql.database', '');

// Mail Configuration
Configure::write('Mail.host', 'ssl://email-smtp.us-east-1.amazonaws.com');
Configure::write('Mail.port', '465');
Configure::write('Mail.authenticate', true);
Configure::write('Mail.username', '');
Configure::write('Mail.password', '');


?>