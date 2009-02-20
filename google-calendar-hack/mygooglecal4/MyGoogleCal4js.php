<?php header("Content-type: application/x-javascript");
/*******************************************************************************
 * FILE: MyGoogleCal4js.php
 *
 * DESCRIPTION:
 *  Companion file for MyGoogleCal4.php to edit the javascript file that
 *  generates the Google Calendar.
 *   
 * USAGE:
 *  There are no user-editable parameters.
 *
 * copyright (c) by Brian Gibson
 * email: bwg1974 yahoo com
 ******************************************************************************/
// URL for the javascript
$url = "";
if(count($_GET) > 0) {
  $url = "http://www.google.com/calendar/" . $_SERVER['QUERY_STRING'];
}

// Request the javascript
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$buffer = curl_exec($ch);
curl_close($ch);

// Fix URLs in the javascript
$pattern = '/this\.[a-zA-Z]{2}\+"calendar/';
$replacement = '"http://www.google.com/calendar';
$buffer = preg_replace($pattern, $replacement, $buffer);

// Display the javascript
print $buffer;
?>