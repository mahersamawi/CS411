<?
session_start();

$server = 'localhost';
$username   = 'goatcalc_admin';
$password   = 'admin123';
$database   = 'goatcalc_main';

if(!mysql_connect($server, $username, $password))
{
	exit('Error: could not establish database connection');
}
if(!mysql_select_db($database))
{
	exit('Error: could not select the database');
}
?>