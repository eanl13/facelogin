<?php
session_start(); 

mysql_connect("localhost","root",""); 
mysql_select_db("fb"); 

$fbayar = array(); 
$fbayar['appId']="1399433880302955"; 
$fbayar['secret']="42fdd8f98adc55515284ab35efe6a806"; 
