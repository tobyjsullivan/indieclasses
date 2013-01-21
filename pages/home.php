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

<div class="row">
<div class="span7 offset1">

	<h3>Take a Class</h3>
	<?php
	$db = new Database();

	$sql = "SELECT id FROM classes WHERE deadline>NOW() AND cancelled is NULL AND private='0' ORDER BY start_date";

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
			$time_fmt = "g:i A";
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
			$price_range = $class->getPriceRange();
			$price = $class->getPrice();
			$price_line = '$'.$price.($price_range != null ? '-'.($price + $price_range) : '');
			$qty_line = $reps == 1 ? '' : ' for '.$reps.' classes';

			$teacher = $class->getTeacher();

			$space = $class->getSpace();
			$unit = $space->getUnit();
			$space_line = $space->getName().', '.($unit == null || $unit == ''?'':$unit.' - ').$space->getAddress().', '.$space->getCity();
			?>
			<p><strong><a href="<?= '/'.$class->getToken() ?>"><?= $class->getTitle() ?></a></strong><br>
				<?= $when_line ?>, <?= $price_line.$qty_line ?><br />
				by <a href="<?= $teacher->getWebsite() ?>" target="_blank"><?= $teacher->getName() ?></a> 
				at <?= $space_line ?></p>
			<?php
		}
	}
	?>
</div>

<div class="span3">

	<h3>Yoga Teachers</h3>
	<p><em>Interested in teaching independently?</em><br />
	 Make more money, build your following and enjoy more freedom.</p>
	<p><a href="/teachers.php">Click here to learn more.</a></p>
	<p>We want to hear from teachers who are interested in using <?= Configure::read('Company.name') ?>. <span id="contact-span"><a href="javascript:showContact();">Get in touch</a></span>.</p>

	
</div>

</div> <!-- /.row -->