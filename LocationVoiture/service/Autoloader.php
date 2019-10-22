<?php
/**
* 
*/
class Autoloader
{
	static function register()
	{
		spl_autoload_register(array(__CLASS__,'charger1'));
		
		
	}
	static function charger1($classname)
	{
		if (file_exists('../Metier/'.$classname.'.class.php')) {
			require '../Metier/'.$classname.'.class.php';
		}
		if (file_exists('../service/'.$classname.'.php')) {
			require '../service/'.$classname.'.php';
		}
		
		
	}
	
}

?>