<?php
$class = $this->fetch('class');

$this->start('page_title');
echo $class->getTitle();
$this->end();

$this->start('css');
?>
<link rel="stylesheet" href="css/pages.class.css">
<?php
$this->end();
?>
<div class="row">
	<div class="three columns">
		<div class="price-box">
			<p class="price">$25</p>
			<?php
			$num_registered = $class->getNumRegistered();
			$min = $class->getMinAttendees();
			$max = $class->getMaxAttendees();

			$below_min = $num_registered < $min;
			$full = $num_registered >= $max;

			$past_deadline = time() > $class->getDeadline();

			if(!($full || $past_deadline)) {
				?>
				<p><a href="<?= 'purchase.php?class='.$class->getToken() ?>" class="register-now button remove-bottom">Register Now</a></p>
				<?php
			}

			if($past_deadline) {
				?>
				<p>Sorry, the registration deadline for this class has passed.</p>
				<?php
			} else if($below_min) {
				?>
				<p>This class needs <?= $min - $num_registered ?> more students*</p>
				<p class="help remove-bottom"><a href="#how-it-works">* What is this?</a></p>
				<?php
			} else if (!$full) {
				?>
				<p>This class is happening! Register before it is full!</p>
				<?php
			} else {
				?>
				<p>Sorry, this class is full!</p>
				<?php
			}
			?>
		</div>
	</div>
	<div class="ten columns">
		<h3>Four Weeks of Hatha Yoga with Hailey</h3>
		<p><strong>November 29th to December 20th, Thursdays at 6:15 pm</strong></p>
		<p>Taught by <a href="http://haileyblackburn.com" target="_blank">Hailey Blackburn</a></p>
		<p>Location: Vancouver Corporate Yoga, 134 - 1055 W Georgia St, Vancouver, BC</p>
		<p><strong>Registration Deadline: 9:00 am November 28th</strong></p>
		<h3>Invite friends to this class</h3>
		<p>Copy this address: <strong><?= Configure::read('Company.url').'/'.$class->getToken() ?></strong></p>
	</div>
	<div class="three columns">
		<div class="picture">
			<img src="images/doggy.jpg" />
		</div>
	</div>
</div>
<div class="row">
	<div class="sixteen columns">
		<h4>About This Class</h4>
		<p>Friends, I would like to invite you to a four week series of hatha yoga. Before the holidays when everything is about food, it will be great to get some extra exercise! Only $25 for four classes which will be collected before the day of the first class.<br />
		<br />
		One hour classes 6:15 pm Thursdays November 29th to December 20th. This class is suitable for all levels and mats can be provided.<br />
		<br />
		It only takes 8 students to put on this series so sign up now!<br />
		<br />
		Namaste,<br />
		Hailey</p>
	</div>
</div>
<div class="sixteen columns">
	<h2><a name="how-it-works"></a>How <?= Configure::read('Company.name') ?> Works</h2>
	<p>* Hailey Blackburn is interested in offering a 
		yoga class independently. In order to do this, she 
		needs a minimum number of students to register and pay
		so she can afford to rent a space and make it
		worth her time. <?= Configure::read('Company.name') ?> is here to safely
		and conveniently collect your registration fees on her 
		behalf. If there are not enough registered students
		by the deadline, <?= Configure::read('Company.name') ?> will cancel
		the class and will not charge your credit card. Please note 
		that any registration fees for successfully filled 
		classes cannot be refunded and will be paid to Hailey
		Blackburn.</p>
	<p><strong>Are you a yoga teacher? Want to offer an independent class like this?</strong> Check out <a href="/"><?= Configure::read('Company.name') ?></a></p>
</div>