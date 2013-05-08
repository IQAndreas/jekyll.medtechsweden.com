

<?php
//Set the date so we can store it in the text file. 
$tdate = date("dS F Y h:i:s A");
 
//Check if there is a referer
if (!$HTTP_REFERER) { $HTTP_REFERER = "(NONE)"; }
 
 
//Store it in the counter.txt file ! DONT FORGET TO SET COUNTER.TXT CHMOD 777 !
$fp = fopen("counter.txt", "a");
$ip = $_SERVER['REMOTE_ADDR'];
$line = "IP Address: $ip - Date: $tdate - Referer: $HTTP_REFERER - Browser: $HTTP_USER_AGENT\n";
fwrite($fp, $line);
fclose($fp);
 
 
echo "The server is experiencing an unusual amount of requests. Please try again later."
?>

