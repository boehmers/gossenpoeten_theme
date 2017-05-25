<?php

function createICalFile($event_array){
	$filepath = "ical/";
	$filename = str_replace(" ", "_", $event_array["title"]).'-'.$event_array["start"];

	$kb_ical = fopen($filepath.$filename.'.ics', 'w');


	$kb_ics_content = 'BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//gossenpoeten//gossenpoeten.de//DE
CALSCALE:GREGORIAN
BEGIN:VEVENT
DTSTART:'.$event_array["start"].'
LOCATION:'.$event_array["location"].'
DTSTAMP:'.$event_array["current_time"].'
SUMMARY:'.$event_array["title"].'
URL;VALUE=URI:'.$event_array["url"].'
UID:'.$event_array["current_time"].'-'.$event_array["start"].'@gossenpoeten.de 
END:VEVENT
END:VCALENDAR';
	fwrite($kb_ical, $kb_ics_content);

	fclose($kb_ical);
	return $filename;
}
