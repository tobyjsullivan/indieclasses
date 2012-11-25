<script type="text/javascript">
function showContact() {
	<?php
	$email = Configure::read('Company.email');
	$parts = split('@', $email);
	?>
	$('#contact-span').html('Email us at <?= $parts[0] ?>');
	$('#contact-span').append('@');
	$('#contact-span').append('<?= $parts[1] ?>');
}
</script>

<div class="sixteen columns">

	<h3>Yoga Teachers</h3>
	<p>Interested in teaching independently? Make more money, build your following and enjoy more freedom.</p>
	<p>We want to hear from teachers who are interested in using <?= Configure::read('Company.name') ?>. <span id="contact-span"><a href="javascript:showContact();">Get in touch</a></span>.
	
	<h3>Current Classes</h3>
	<p><strong><a href="/ckdls">Four Weeks of Hatha Yoga with Hailey</a></strong><br>
		November 29th - December 20th, Thursdays at 6:15 pm, $25 for 4 classes<br />
		by <a href="http://haileyblackburn.com" target="_blank">Hailey Blackburn</a> 
		at Vancouver Corporate Yoga, 134 - 1055 W Georgia St, Vancouver, BC</p>
</div>