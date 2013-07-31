#!/usr/bin/php
<?php
/* 
   Hadoop Map routine that parses MacOSX appfirewall logs stored in
   /private/var/log/appfirewall.log.X 
   under MacOSX 10.8.x
    
*/

// Return the IP address
function getIP($str) {
	if (preg_match('/(\d{1,3}).(\d{1,3}).(\d{1,3}).(\d{1,3})/', $str, $ip)) {
		$ip = "{$ip[1]}.{$ip[2]}.{$ip[3]}.{$ip[4]}";
	} else {
		$ip = false;
	}
	return $ip;
}

// Return the type of hit on the firewall
function findReason($str) {
	if (strpos($str, 'Deny netbiosd')) return 'Deny netbiosd';
	if (strpos($str, 'Stealth Mode')) return 'Stealth Mode';
	return false;
}

// Find out how many times the last entry was repeated (if necessary)
function repeatFactor($str) {
	if (preg_match('/repeated(.*?)time/', $str, $factor)) {
		return (trim($factor[1]));
	} else {
		return false;
	}
}

// Save the previous line just in case a "repeated" statement
// is next.
$old_line = false;

$std_in = fopen("php://stdin", "r");

while($line = fgets($std_in)) {
	$repeat = repeatFactor($line);
	if ($repeat and $old_line) {
		for ($i = 1; $i <= $repeat; $i++) {
	 		echo $old_line;
		}
		continue;
	}

	$ip = getIP($line);
	if ($ip) {
		$reason = findReason($line);
		if ($reason) {
			$old_line =  $ip."\t".$reason."\n";
			echo $old_line;
		}
	}
}


fclose($std_in);
?>
