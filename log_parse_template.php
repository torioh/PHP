<?php
if($argc < 2) {
    echo "input file is required\n";
    die();
}

for($i = 1; $i < $argc; $i++) {
   echo "input files:".$argv[$i]."\n";
   $input[] = $argv[$i];
}
error_reporting(E_ALL ^ E_NOTICE);
ini_set("memory_limit", "1086M");

foreach ($input as $file_name) {

    $fp = fopen ("$file_name", "r");
    if(!$fp) {
      echo "can not find input file:".$file_name."\n";
      die();
    }
    $cnt = 1;
    while (!feof ($fp)) {
        $buffer = fgets($fp);

        // do something here
            
        $cnt++;
    }
    fclose ($fp);
}

