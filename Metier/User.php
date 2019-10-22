<?php
/**
* 
*/
class User 
{
	private $id_user,$nom_user,$prenom,$email,$pass,$photo;
	function __construct()
	{   
		
	}
	function getid_user(){
		return $this->id_user;
	}
	function getnom_user(){
		return $this->nom_user;
	}
	function getprenom(){
		return $this->prenom;
	}
	function getemail(){
		return $this->email;
	}
	function getpass(){
		return $this->pass;
	}
	function getphoto(){
		return $this->photo;
	}

	function setid_user($i){
		$this->id_user=$i;
	}
	function setnom_user($n){
		$this->nom_user=$n;
	}
	function setprenom($pr){
		$this->prenom=$pr;
	}
	function setemail($e){
		$this->email=$e;
	}
	function setpass($p){
		$this->pass=$p;
	}
	function setphoto($ph){
		$this->photo=$ph;
	}

	function getuser1($n,$pr,$e,$p,$ph){
		$u= new User();
		$u->setnom_user($n);
		$u->setprenom($pr);
		$u->setemail($e);
		$u->setpass($p);
		$u->setphoto($ph);
		return $u;
	}
	function getuser2($i,$n,$pr,$e,$p){
		$u= new User();
		$u->setid_user($i);
		$u->setnom_user($n);
		$u->setprenom($pr);
		$u->setemail($e);
		$u->setpass($p);
		return $u;
	}
	function getuser3($e,$p){
		$u= new User();
		$u->setemail($e);
		$u->setpass($p);
		return $u;
	}
}



?>