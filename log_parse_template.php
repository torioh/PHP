<?php
if($argc < 2) {
 echo "input file is required";
 die();
}

for($i = 1; $i < $argc; $i++) {
   echo "input files:".$argv[$i]."\n";
   $input[] = $argv[$i];
}
error_reporting(E_ALL ^ E_NOTICE);
ini_set("memory_limit", "1086M");
$count = 0;

$current_directory = getcwd();
$output_file = $current_directory."/output_".$input[0];

print $output_file;

$output = array();

foreach ($input as $file_name) {

    // ƒtƒ@ƒCƒ‹“Çž‚Ý
    $fp = fopen ("$file_name", "r");
    if(!$fp) {
      echo "can not find input file:".$file_name."\n";
      die();
    }
    while (!feof ($fp)) {
        $buffer = fgets($fp);

        // do something here
    }
}

fclose ($fp);