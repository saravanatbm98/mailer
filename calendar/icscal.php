<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
/**
 * Get the event ID 
 */
$event_id = @$_GET['event_id'];
/**
 * If no event ID or event_id is not an integer, do nothing 
 */
if ( !$event_id || !is_numeric( $event_id ) ) {
    die();
}
/**
 * Event information 
 */
//$event = get_event($event_id);
$event = array(
    'event_name' => 'Test Event',
    'event_description' => 'This is a test event. This is the description.',
    'event_start' => time(),
    'event_end' => time() + 60*60*2,
    'event_venue' => array(
        'venue_name' => 'Test Venue',
        'venue_address' => '123 Test Drive',
        'venue_address_two' => 'Suite 555',
        'venue_city' => 'Some City',
        'venue_state' => 'Iowa',
        'venue_postal_code' => '12345'
    )
);
$name = $event['event_name'];
$venue = $event['event_venue'];
$location = $venue['venue_name'] . ', ' . $venue['venue_address'] . ', ' . $venue['venue_address_two'] . ', ' . $venue['venue_city'] . ', ' . $venue['venue_state'] . ' ' . $venue['venue_postal_code']; 
$start = date('Ymd', $event['event_start']+18000) . 'T' . date('His', $event['event_start']+18000) . 'Z';
$end = date('Ymd', $event['event_end']+18000) . 'T' . date('His', $event['event_end']+18000) . 'Z';
$description = $event['event_description'];
$slug = strtolower(str_replace(array(' ', "'", '.'), array('_', '', ''), $name));
header("Content-Type: text/Calendar; charset=utf-8");
header("Content-Disposition: inline; filename={$slug}.ics");
echo "BEGIN:VCALENDAR\n";
echo "VERSION:2.0\n";
echo "PRODID:-//LearnPHP.co//NONSGML {$name}//EN\n";
echo "METHOD:REQUEST\n"; // requied by Outlook
echo "BEGIN:VEVENT\n";
echo "UID:".date('Ymd').'T'.date('His')."-".rand()."-learnphp.co\n"; // required by Outlok
echo "DTSTAMP:".date('Ymd').'T'.date('His')."\n"; // required by Outlook
echo "DTSTART:{$start}\n"; 
echo "DTEND:{$end}\n";
echo "LOCATION:{$location}\n";
echo "SUMMARY:{$name}\n";
echo "DESCRIPTION: {$description}\n";
echo "END:VEVENT\n";
echo "END:VCALENDAR\n";