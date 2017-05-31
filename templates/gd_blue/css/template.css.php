<?php


//require_once '../../helpers.php';

// send default cacheing headers and content type
header('Pragma: cache');
header('Cache-Control: public');
header('Content-Type: text/css');

$modTimes = array();

/**
 * Make sure to add any newly created css file to this array
 */
$cssFiles = array(
    'reset',
    'grid_r12',
    'nav-horizontal',
    /* 'font-awesome.min', */
    'template'         // make sure this comes last, we want to be able to override anything in there!
);

// check last modified times
foreach ($cssFiles as $file) if (is_file($tmp = './'.$file.'.css')) $modTimes[$file] = filemtime($tmp);

// Get last modified time of file
//$modTimes['shared'] = getlastmod();

// exit out of script if cached on client
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
    $cliModTime = dateToTimestamp($_SERVER['HTTP_IF_MODIFIED_SINCE']);
    if (max($modTimes) <= $cliModTime) {
        header('HTTP/1.x 304 Not Modified');
        exit;
    }
}

/**
 * send last modified date of file to client so it will have date for server
 * on next request.
 * Technically we could just send the current time (as PEAR does) rather
 * than the actual modify time of the file since either way would get the
 * correct behavior, but since we already have the actual modified time of
 * the file, we'll just use that.
 */
$srvModDate = timestampToDate(max($modTimes));
header("Last-Modified: $srvModDate");

// Now include files
foreach ($cssFiles as $file) if (file_exists('./'.$file.'.css')) include './'.$file.'.css';

// copied from PEAR HTTP Header.php (comments stripped)
// Author: Wolfram Kriesing <wk@visionp.de>
// Changes: mktime() to gmmktime() to make work in timezones other than GMT
function dateToTimestamp($date)
{
    $months = array_flip(array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'));
    preg_match('~[^,]*,\s(\d+)\s(\w+)\s(\d+)\s(\d+):(\d+):(\d+).*~', $date, $splitDate);
    $timestamp = @gmmktime($splitDate[4], $splitDate[5], $splitDate[6], $months[$splitDate[2]]+1, $splitDate[1], $splitDate[3]);
    return $timestamp;
}
// copied from PEAR HTTP.php Date function (comments stripped)
// Author: Stig Bakken <ssb@fast.no>
function timestampToDate($time)
{
    if (ini_get("y2k_compliance") == true) {
        return gmdate("D, d M Y H:i:s \G\M\T", $time);
    } else {
        return gmdate("F, d-D-y H:i:s \G\M\T", $time);
    }
}

?>
