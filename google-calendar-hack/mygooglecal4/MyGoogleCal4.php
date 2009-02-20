<?php
/*******************************************************************************
 * FILE: MyGoogleCal4.php
 *
 * DESCRIPTION:
 *  This script is an intermediary between an iframe and Google Calendar that
 *  allows you to override the default style.
 *
 * USAGE:
 *  <iframe src="MyGoogleCal4.php?src=user%40domain.tld"></iframe>
 *
 *  where user@domain.tld is a valid Google Calendar account.
 *
 * VALID QUERY STRING PARAMETERS:
 *    title:         any valid url encoded string 
 *                   if not present, takes title from first src
 *    showTitle:     0 or 1 (default)
 *    showNav:       0 or 1 (default)
 *    showDate:      0 or 1 (default)
 *    showTabs:      0 or 1 (default)
 *    showCalendars: 0 or 1 (default)
 *    mode:          WEEK, MONTH (default), AGENDA
 *    height:        a positive integer (should be same height as iframe)
 *    wkst:          1 (Sun; default), 2 (Mon), or 7 (Sat)
 *    hl:            en, zh_TW, zh_CN, da, nl, en_GB, fi, fr, de, it, ja, ko, 
 *                   no, pl, pt_BR, ru, es, sv, tr
 *                   if not present, takes language from first src
 *    bgcolor:       url encoded hex color value, #FFFFFF (default)
 *    src:           url encoded Google Calendar account (required)
 *    color:         url encoded hex color value     
 *                   must immediately follow src
 *    
 *    The query string can contain multiple src/color pairs.  It's recommended 
 *    to have these pairs of query string parameters at the end of the query 
 *    string.
 *
 * HISTORY:
 *   03 December 2008 - Original release
 *                      Uses technique from MyGoogleCal2 for all browsers,
 *                      rather than giving IE special treatment.
 *   16 December 2008 - Modified MyGoogleCal4js.php so that the regex does a
 *                      general match rather than specifically look for the
 *                      variable 'Ac'.
 *                      
 *   
 * ACKNOWLEDGMENTS:
 *   Michael McCall (http://www.castlemccall.com/) for pointing out "htmlembed"
 *   Mike (http://mikahn.com/) for the link to the online CSS formatter
 *
 * copyright (c) by Brian Gibson
 * email: bwg1974 yahoo com
 ******************************************************************************/

/* URL for overriding stylesheet
 * The best way to create this stylesheet is to 
 * 1) Load "http://www.google.com/calendar/embed?src=user%40domain.tld" in a
 *    browser,
 * 2) View the source (e.g., View->Page Source in Firefox),
 * 3) Copy the relative URL of the stylesheet (i.e., the href value of the 
 *    <link> tag), 
 * 4) Load the stylesheet in the browser by pasting the stylesheet URL into 
 *    the address bar so that it reads similar to:
 *    "http://www.google.com/calendar/d003e2eff7c42eebf779ecbd527f1fe0embedcompiled.css"
 * 5) Save the stylesheet (e.g., File->Save Page As in Firefox)
 * Edit this new file to change the style of the calendar.
 *
 * As an alternative method, take the URL you copied in Step 3, and paste it
 * in the URL field at http://mabblog.com/cssoptimizer/uncompress.html.
 * That site will automatically format the CSS so that it's easier to edit.
 */
$stylesheet = 'mygooglecal4.css';

/*******************************************************************************
 * DO NOT EDIT BELOW UNLESS YOU KNOW WHAT YOU'RE DOING
 ******************************************************************************/

// URL for the calendar
$url = "";
if(count($_GET) > 0) {
  $url = "http://www.google.com/calendar/embed?" . $_SERVER['QUERY_STRING'];
}

// Request the calendar
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$buffer = curl_exec($ch);
curl_close($ch);

// Point stylesheet and javascript to custom versions
$pattern = '/(<link.*>)/';
$replacement = '<link rel="stylesheet" type="text/css" href="' . $stylesheet . '" />';
$buffer = preg_replace($pattern, $replacement, $buffer);

$pattern = '/src="(.*js)"/';
$replacement = 'src="MyGoogleCal4js.php?$1"';  
$buffer = preg_replace($pattern, $replacement, $buffer);

// display the calendar
print $buffer;
?>
