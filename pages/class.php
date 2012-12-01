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
	<div class="four columns">
		<div class="price-box">
			<?php
			$price = '$'.$class->getPrice();

			if($class->getPriceRange() != null) {
				$price .= '-'.($class->getPrice() + $class->getPriceRange());
			}
			?>
			<p class="price"><?= $price ?></p>
			<?php
			$num_registered = $class->getNumRegistered();
			$amount_paid = $class->getAmountPaid();

			$threshold = $class->getThreshold();
			$threshold_type = $class->getThresholdType();
			if($threshold_type == 'students') {
				$below_min = $num_registered < $threshold;
			} else if($threshold_type == 'fees') {
				$below_min = $amount_paid < $threshold;
			} else {
				throw new Exception('Unknown threshold type: '.$threshold_type);
			}

			$max = $class->getMaxAttendees();

			$full = $num_registered >= $max;
			$cancelled = $class->isCancelled();

			$past_deadline = time() > $class->getDeadline();

			if(!($full || $past_deadline || $cancelled)) {
				?>
				<p><a href="<?= 'purchase.php?class='.$class->getToken() ?>" class="register-now button remove-bottom">Register Now</a></p>
				<?php
			}

			if ($cancelled) {
				?>
				<p>This class has been cancelled.</p>
				<?php
			} else if($past_deadline) {
				?>
				<p>Sorry, the registration deadline for this class has passed.</p>
				<?php
			} else if($below_min) {
				if($threshold_type == 'students') {
					$need_line = "This class needs ".($threshold - $num_registered)." more students";
				} else if($threshold_type == 'fees') {
					$need_line = "This class needs $".($threshold - $amount_paid)." more in registrations";
				}
				?>
				<p><?= $need_line ?>*</p>
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
	<div class="nine columns">
		<h3><?= $class->getTitle() ?></h3>
		<?php
		// $when_line = "November 29th to December 20th, Thursdays at 6:15 pm";
		$start = $class->getStartDate(); // As EPOC time representing start date and start time of day
		$time_fmt = "g:i A";
		$start_time = date($time_fmt, $start);
		$reps = $class->getRepetitions();
		if($reps == 1) {
			$date_fmt = "l F jS, Y";
			$start_date = date($date_fmt, $start);
		} else {
			$date_fmt = "F jS, Y";
			$start_day = date($date_fmt, $start);
			$end = $start + (7 * 24 * 60 * 60 * ($reps - 1));
			$end_day = date($date_fmt, $end);
			$dow = date('l', $start).'s';
			$start_date = $start_day.' to '.$end_day.', '.$dow;
		}
		$when_line = $start_date.' at '.$start_time;
		?>
		<p><strong><?= $when_line ?></strong></p>
		<?php
		$teacher = $class->getTeacher();
		?>
		<p>Taught by <a href="<?= $teacher->getWebsite() ?>" target="_blank"><?= $teacher->getName() ?></a></p>
		<?php
		$space = $class->getSpace();
		$unit = $space->getUnit();
		$space_line = $space->getName().', '.($unit == null || $unit == ''?'':$unit.' - ').$space->getAddress().', '.$space->getCity();
		?>
		<p>Location: <?= $space_line ?></p>
		<?php
		$deadline_fmt = "g:i a F jS, Y";
		$deadline = date($deadline_fmt, $class->getDeadline());
		?>
		<p><strong>Registration Deadline: <?= $deadline ?></strong></p>
		<h3>Invite friends to this class</h3>
		<p>Copy this address: <strong><?= Configure::read('Company.url').'/'.$class->getToken() ?></strong></p>
	</div>
	<div class="three columns">
		<div class="picture">
			<img src="<?= 'images/cls_'.$class->getToken().'.jpg' ?>" />
		</div>
	</div>
</div>
<div class="row">
	<div class="sixteen columns">
		<h4>About This Class</h4>
		<p><?= nl2br($class->getDescription()) ?></p>
	</div>
</div>
<div class="sixteen columns">
	<h2><a name="how-it-works"></a>How <?= Configure::read('Company.name') ?> Works</h2>
	<p>* <?= $teacher->getName() ?> is interested in offering a 
		yoga class independently. In order to do this, she 
		needs a minimum number of students to register and pay
		so she can afford to rent a space and make it
		worth her time. <?= Configure::read('Company.name') ?> is here to safely
		and conveniently collect your registration fees on the teacher's
		behalf. If there are not enough registered students
		by the deadline, <?= Configure::read('Company.name') ?> will cancel
		the class and will not charge your credit card. Please note 
		that any registration fees for successfully filled 
		classes cannot be refunded and will be paid to <?= $teacher->getName() ?>.</p>
	<p><strong>Are you a yoga teacher? Want to offer an independent class like this?</strong> Check out <a href="/"><?= Configure::read('Company.name') ?></a></p>
</div>