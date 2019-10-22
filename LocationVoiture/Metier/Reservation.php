<?php
/**
* 
*/
class Reservation 
{
	private $id_res,$dateD,$dateF,$id_user,$id_voiture,$id_marque;
	function  __construct($dd,$df,$idu,$idv,$idm)
    {
        $this->dateD=$dd;
        $this->dateF=$df;
        $this->id_user=$idu;
        $this->id_voiture=$idv;
        $this->id_marque=$idm;
    }
	function getid_res(){
		return $this->id_res;
	}
	function getdateD(){
		return $this->dateD;
	}
	function getdateF(){
		return $this->dateF;
	}
	function getid_user(){
		return $this->id_user;
	}
	function getid_voiture(){
		return $this->id_voiture;
    }
    function getid_marque(){
		return $this->id_marque;
	}

    

	function setid_res($i){
		$this->id_res=$i;
	}
	function setdateD($dd){
		$this->dateD=$dd;
	}
	function setdateF($df){
		$this->dateD=$df;
	}
    function setid_user($idu){
		$this->id_user=$idu;
	}
	function setid_voiture($idv){
		$this->id_voiture=$idv;
    }
    function setid_marque($idm){
		$this->id_marque=$idm;
	}

}



?>