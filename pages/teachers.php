<?php
$this->start('page_title');
echo "Teach independent yoga classes";
$this->end();

?>
<div class="eleven columns">
	<h3>Teach Independently. Make Yoga a Career.</h3>
	<p>Teaching for yoga studios is great. They find the students, provide the space and
		collect the payments. You get to just show up, do what you love, get paid and go
		home. Unfortunately, after teaching for a few months, you quickly realise this 
		isn't going to pay enough to make yoga the career you dream of. It's time to 
		take the next step.</p>
	<p>Teaching yoga independently is a realistic option that opens to doors to making a 
		real career out of yoga and <?= Configure::read('Company.name') ?> is here to make it easier than 
		ever.</p>
	<h3>How <?= Configure::read('Company.name') ?> Works</h3>
	<p>Yoga teachers enjoy offering classes independently for a variety of reasons. 
		<?= Configure::read('Company.name') ?> is here to make that possible.</p>
	<p><strong>Step 1:</strong> Find a studio space you can rent. If you teach for a 
		studio already, often they will provide you a discount rate to use the space 
		privately. Ask your studios!</p>
	<p><strong>Step 2:</strong> Post your class on <?= Configure::read('Company.name') ?>. You get to choose 
		your rate, minimum number of students and anything else about your class.</p>
	<p><strong>Step 3:</strong> Promote your listing to students and have them 
		pre-register and pre-pay through <?= Configure::read('Company.name') ?>. This means
		you don't need to go through the hassle of collecting payments from students ever again. 
		If you get your minimum number of 
		students before the registration deadline, you can book your studio space and 
		guarantee you'll get paid for the class!</p>
	<h3>Pricing</h3>
	<p><?= Configure::read('Company.name') ?> takes $1.70 from every $10.00 a student pays - or 17% of 
		student fees. The rest goes entirely to you.<p>
	<p>We don't charge you any money for cancelled or unsuccessful classes.</p>
	<p>Let's look at an example of how this works out for a realistic class. Imagine
		you decide to put on a Hatha class for $15 per student and a minimum of 15
		students.</p>
	<p>We collect the student registration fees:</p>
	<p><strong>$15 x 15 students = $225</strong></p>
	<p>Our fee is 17% of that amount.</p>
	<p><strong>$225 x 17% = $38.25</strong></p>
	<p>We write you a check for the rest as soon as you've taught the class.</p>
	<p><strong>$225 - $38.25 = $186.75 for you</strong></p>
	<p>That sounds like a pretty good deal! Remember, we will automatically cancel the
		class if you don't get your minimum number of registered students. This means 
		you don't have to worry about showing up for half-empty classes. </p>
	<h4>If you're ready to make a career of yoga, scroll up top and fill in your information.</h4>
</div>
<div class="five columns">
	<div style="background-color: #f7f7f7; border: 1px solid #ccc; border-radius: 10px; padding: 30px;">
		<?php
		$complete = $this->fetch('signup-complete');

		if($complete) {
			?>
			<p><strong>Thank you for signing up! We will be in touch soon!</strong></p>
			<?
		} else {
			?>
			<form method="post" action="/teacher_signup.php">
				<h4>Get started today</h4>
				<label for="fname">First Name</label>
				<input type="text" name="fname" id="fname" />
				<label for="lname">Last Name</label>
				<input type="text" name="lname" id="lname" />
				<label for="email">Email Address</label>
				<input type="email" name="email" id="email" />
				<input type="submit" value="Sign Up" />
			</form>
			<?php
		}
		?>
	</div>
</div>