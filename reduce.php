#!/usr/bin/php
<?php
/* 
   Hadoop Reduce routine that counts the number of times
   Stealth mode and netbiosd hits are made on the firewall
   and from which IP addresses.
    
*/

// Wrap everything in a function so that HipHop can optimize it
function runAll() {
   
   $std_in = fopen("php://stdin", "r");

   $cntarr = array();

   while ($line = fgets($std_in)) {

      $arr = explode("\t", $line);

      if (trim($arr[1]) ==  'Deny netbiosd') isset($cntarr['D '.$arr[0]]) ? $cntarr['D '.$arr[0]]++ : $cntarr['D '.$arr[0]]=1;
      if (trim($arr[1]) ==  'Stealth Mode') isset($cntarr['S '.$arr[0]]) ? $cntarr['S '.$arr[0]]++ : $cntarr['S '.$arr[0]]=1;
                                                                         
   }

   fclose($std_in);

   foreach ($cntarr as $k => $v) {
 	   echo $k."\t".$v."\n";
   }
}

runAll();

?>
