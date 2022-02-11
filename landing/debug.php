<?php

function logwrite($msg)
{
    $src = "log.txt";

    $fp = fopen($src, "r");
    $log = fread($fp, filesize($src));
    fclose($fp);
    $log .= date("Y-m-d H:i:s").": ".$msg."\r\n";
    $fp = fopen($src, "w");
    fputs($fp, $log);
    fclose($fp);
}


