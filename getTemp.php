<?php

header("Content-type: text/xml"); 

$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$database = "LeiDB"; 

$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
mysql_select_db($database, $linkID) or die("Could not find database."); 

parse_str($_SERVER['QUERY_STRING']);

if($start!=null and $end!=null){
$query = "SELECT * FROM TempMeas WHERE Time >='".$start."' AND TIME <='".$end."' ORDER BY Time ASC"; 
}
else{
$query = "SELECT * FROM TempMeas ORDER BY Time ASC"; 
}

$resultID = mysql_query($query, $linkID) or die("Data not found."); 

$xml_output = "<?xml version=\"1.0\"?>\n"; 
$xml_output .= "<entries>\n"; 

for($x = 0 ; $x < mysql_num_rows($resultID) ; $x++){ 
    $row = mysql_fetch_assoc($resultID); 
    $xml_output .= "\t<entry>\n"; 
    $xml_output .= "\t\t<time>" . $row['Time'] . "</time>\n";         
    $xml_output .= "\t\t<temperature>" . $row['Temp'] . "</temperature>\n"; 
    $xml_output .= "\t</entry>\n"; 
} 

$xml_output .= "</entries>"; 

echo $xml_output; 
?>