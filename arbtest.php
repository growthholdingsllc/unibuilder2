<?php
$myfile = fopen("arb/arbnewfile.txt", "a") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = json_encode($_POST);
fwrite($myfile, $txt);
fclose($myfile);	
