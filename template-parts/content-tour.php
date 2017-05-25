<?php
	$args = array('post_type' => 'event_dates');
	$loop = new WP_Query( $args );
	$events_array = array();

	while ( $loop->have_posts() ) {
		$loop->the_post(); 
		$post_id = get_the_ID();

		$event = array();
		$event["name"] = get_the_title();
		$event["date"] = get_post_meta($post_id, 'dates_date', true); 
		$event["time"] = get_post_meta($post_id, 'dates_time', true);
		$event["location"] = get_post_meta($post_id, 'dates_location', true);
		$event["address"] = get_post_meta($post_id, 'dates_address', true);
		$event["organizer"] = get_post_meta($post_id, 'dates_organizer', true);
		$event["organizer_link"] = get_post_meta($post_id, 'dates_organizer_link', true);
		$event["tickets"] = get_post_meta($post_id, 'dates_tickets', true);
		$event["ical_filename"] = get_post_meta($post_id, 'dates_ical_filename', true);

		$events_array[] = $event;

	}

	function invenDescSort($item1,$item2)
	{
	    if (strtotime($item1['date']) == strtotime($item2['date'])){
    		return (str_replace(':', '', $item1['time']) > str_replace(':', '', $item2['time'])) ? 1 : -1;
	    }else {
	    	return (strtotime($item1['date']) > strtotime($item2['date'])) ? 1 : -1;
		}
	}
	usort($events_array,'invenDescSort');
?>


<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#upcoming">Termine</a></li>
	<li><a data-toggle="tab" href="#formerevents">Vergangene Veranstaltungen</a></li>
</ul>

<div class="tab-content">
	<div id="upcoming" class="tab-pane fade in active">
		<table class="table">
			<tr>
				<th>Datum</th>
				<th>Uhrzeit</th>
				<th>Veranstalter</th>
				<th>Ort</th>
				<th>Name</th>
				<th></th>
			</tr>
			<?php
				date_default_timezone_set('Europe/Berlin');

				foreach ( $events_array as $event ) {
					//Datum analysieren -> vergangen oder bevorstehend?
						$timestamp_now = time();
						$timestamp_event = strtotime($event["date"]." ".$event["time"].":0");

					//iCal-Datei-Link generieren
						$time = $time = "T".str_replace(":", "", $event["time"])."00";
						$icalLink = "/../../../../wp-admin/ical/".$event["ical_filename"].".ics";

					//Kommende Veranstaltungen
					if($timestamp_now <= $timestamp_event){
					?>
					<tr>
						<td><?php echo $event["date"]; ?> <a href=<?php echo $icalLink; ?>><span class="dashicons dashicons-calendar-alt"></span></a></td>
						<td><?php echo $event["time"]; ?></td>
						<?php if($event["organizer_link"] !== ""){?>
							<td><a target="_blank" href=<?php echo $event['organizer_link'];?>><?php echo $event["organizer"]; ?></a></td>
						<?php }else{ ?>
							<td><?php echo $event["organizer"]; ?></td>
						<?php } ?>
						<td>
							<?php 
								//String für Google-Maps aufbereiten (Leerzeichen durch '+' ersetzen, sowie formatieren in UTF8)
								$address = $event["address"];
								$address = str_replace(' ', '+', $address);
								$address = str_replace(',', '', $address);
								$address = "http://maps.google.de/maps?q=".$address; 

								echo "<a target='_blank' href='".$address."'>".$event["location"]."</a>"
							?>
						</td>
						<td><?php echo $event["name"]; ?></td>
						<?php if($event["tickets"] !== ""){?>
							<td><a target="_blank" href=http://<?php echo $event['tickets']; ?>><button class="btn btn-success btn-xs">Tickets</button></a></td>
						<?php }else{?>
							<td></td>
						<?php } ?>
					</tr>
			<?php }} ?>
		</table>
	</div>

	<div id="formerevents" class="tab-pane">
		<table class="table">
			<tr>
				<th>Datum</th>
				<th>Uhrzeit</th>
				<th>Veranstalter</th>
				<th>Ort</th>
				<th>Name</th>
			</tr>
			<?php
				date_default_timezone_set('Europe/Berlin');

				foreach ( $events_array as $event ) {
					//Datum analysieren -> vergangen oder bevorstehend?
						$timestamp_now = time();
						$timestamp_event = strtotime($event["date"]." ".$event["time"].":0");

					//Vergangene Veranstaltungen
					if($timestamp_now > $timestamp_event){
					?>
					<tr>
						<td><?php echo $event["date"]; ?></td>
						<td><?php echo $event["time"]; ?></td>
						<?php if($event["organizer_link"] !== ""){?>
							<td><a target="_blank" href=http://<?php echo $event['organizer_link']; ?>><?php echo $event["organizer"]; ?></a></td>
						<?php }else{ ?>
							<td><?php echo $event["organizer"]; ?></td>
						<?php } ?>
						<td>
							<?php 
								//String für Google-Maps aufbereiten (Leerzeichen durch '+' ersetzen, sowie formatieren in UTF8)
								$address = $event["address"];
								$address = str_replace(' ', '+', $address);
								$address = str_replace(',', '', $address);
								$address = "http://maps.google.de/maps?q=".$address; 

								echo "<a target='_blank' href='".$address."'>".$event["location"]."</a>"
							?>
						</td>
						<td><?php echo $event["name"]; ?></td>
					</tr>
			<?php }} ?>
		</table>
	</div>
</div>
