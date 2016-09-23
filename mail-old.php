#!/usr/bin/php

<?php
$file = fopen("/var/www/ub_documents/fetch_mail/test.txt","w");
echo fwrite($file,"Hello World. Testing!");
fclose($file);i
//header("Location: http://unibuilder.net/bWFpbF9mZXRjaC9pbmRleA--");exit;
    /* Read the message from STDIN */
    $fd = fopen("php://stdin", "r");
    $email = ""; // This will be the variable holding the data.
    while (!feof($fd)) {
        $email .= fread($fd, 1024);
    }
    fclose($fd);
    /* Saves the data into a file */
    $fdw = fopen("/var/www/ub_documents/fetch_mail/pipemail.txt", "w+");
    fwrite($fdw, $email);
    fclose($fdw);
    /* Script End */

    //Call the method to process the file then move the file to processed directory
    header("Location: http://unibuilder.net/bWFpbF9mZXRjaC9pbmRleA--");
    // header("Location: http://unibuilder.net/mail_fetch/index");
    ?>
~

