<?php
session_start();
require 'Autoloader.php';
Autoloader::register();

$db = new Connexion();
$user = new User_Service();	
?>