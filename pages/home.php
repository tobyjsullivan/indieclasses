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

	<h3>Current Classes</h3>
	<?php
	$db = new Database();

	$sql = "SELECT id FROM classes WHERE deadline>NOW() AND cancelled is NULL ORDER BY start_date";

	if(!($res = $db->query($sql))) {
		throw new Exception("Failed to fetch classes: ".$db->error);
	}

	if($res->num_rows == 0) {
		?>
		<p><em>There are currently no available classes.</em></p>
		<?php
	} else {
		while($row = $res->fetch_assoc()) {
			$class = new _Class($row['id']);

			$start = $class->getStartDate(); // As EPOC time representing start date and start time of day
			$time_fmt = "g:i a";
			$start_time = date($time_fmt, $start);
			$reps = $class->getRepetitions();
			if($reps == 1) {
				$date_fmt = "l F jS";
				$start_date = date($date_fmt, $start);
			} else {
				$date_fmt = "F jS";
				$start_day = date($date_fmt, $start);
				$end = $start + (7 * 24 * 60 * 60 * ($reps - 1));
				$end_day = date($date_fmt, $end);
				$dow = date('l', $start).'s';
				$start_date = $start_day.' to '.$end_day.', '.$dow;
			}
			$when_line = $start_date.' at '.$start_time;
			$qty_line = $reps == 1 ? '' : ' for '.$reps.' classes';

			$teacher = $class->getTeacher();

			$space = $class->getSpace();
			$unit = $space->getUnit();
			$space_line = $space->getName().', '.($unit == null || $unit == ''?'':$unit.' - ').$space->getAddress().', '.$space->getCity();
			?>
			<p><strong><a href="<?= '/'.$class->getToken() ?>"><?= $class->getTitle() ?></a></strong><br>
				<?= $when_line ?>, <?= '$'.$class->getPrice().$qty_line ?><br />
				by <a href="<?= $teacher->getWebsite() ?>" target="_blank"><?= $teacher->getName() ?></a> 
				at <?= $space_line ?></p>
			<?php
		}
	}
	?>
	<!-- 
	<p><strong><a href="/ckdls">Four Weeks of Hatha Yoga with Hailey</a></strong><br>
		November 29th - December 20th, Thursdays at 6:15 pm, $25 for 4 classes<br />
		by <a href="http://haileyblackburn.com" target="_blank">Hailey Blackburn</a> 
		at Vancouver Corporate Yoga, 134 - 1055 W Georgia St, Vancouver, BC</p>
	-->

	<h3>Yoga Teachers</h3>
	<p><em>If you make enough money as a yoga teacher working with studios, you don't need <?= Configure::read('Company.name') ?>. Otherwise, read on.</em></p>
	<p>Interested in teaching independently? Make more money, build your following and enjoy more freedom.</p>
	<p>We want to hear from teachers who are interested in using <?= Configure::read('Company.name') ?>. <span id="contact-span"><a href="javascript:showContact();">Get in touch</a></span>.
	
</div>