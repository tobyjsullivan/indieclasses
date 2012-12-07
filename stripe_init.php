<?php
require_once('lib/Stripe.php');
Stripe::setApiKey(Configure::read('Stripe.skey'));

?>