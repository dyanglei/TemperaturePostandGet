<?php

$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$database = "LeiDB"; 

$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
mysql_select_db($database, $linkID) or die("Could not find database."); 

parse_str($_SERVER['QUERY_STRING']);  // parse query string

if($time!=null and $temperature!=null){
$query = "INSERT into TempMeas Values('".$time."', ".$temperature.")"; 
$resultID = mysql_query($query, $linkID) or die("Insert failed."); 
echo "Posted successfully!";
}
else{
echo "Data incomplete!"; 
} 
?>