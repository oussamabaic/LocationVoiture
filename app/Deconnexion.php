<?php
include '../Service/Config.php';

if ($user->logout()) {
	header("Location: Login.php");
}


?>