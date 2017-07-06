<?php
$path = dirname(__FILE__);

$path1 = explode("/",$path,-1);
$path1[count($path1)+1]='db.conf';
$finalpath = implode("/",$path1);

$handle = fopen($finalpath, "r");
while (!feof($handle))
{
  $line = fgets($handle);

  $data = explode("\"",$line);

    if($data[0]=='$hostname = ')
    {
      $hostname= $data[1];
    }
    elseif($data[0]=='$port = ')
    {
     $port= $data[1];
    }
    elseif($data[0]=='$username = ')
    {
     $username= $data[1];
    }
    elseif($data[0]=='$password = ')
    {
     $password= $data[1];
    }
    elseif($data[0]=='$database = ')
    {
     $database= $data[1];
    }
 }

?>
