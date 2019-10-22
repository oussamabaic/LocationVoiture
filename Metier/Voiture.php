<?php
/**
* 
*/
class Voiture
{
	private $id_voiture,$nom_voiture,$photo,$type,$vitesse,$model,$reserver,$id_marque;
	function  __construct($nv,$ph,$ty,$vi,$mo,$re,$idm)
    {
        $this->nom_voiture=$nv;
        $this->photo=$ph;
        $this->type=$ty;
        $this->vitesse=$vi;
        $this->model=$mo;
        $this->reserver=$re;
        $this->id_marque=$idm;
    }
	function getid_voiture(){
		return $this->id_voiture;
	}
	function getnom_voiture(){
		return $this->nom_voiture;
	}
	function getphoto(){
		return $this->photo;
	}
	function gettype(){
		return $this->type;
	}
	function getvitesse(){
		return $this->vitesse;
	}
	function getmodel(){
		return $this->model;
    }
    function getreserver(){
		return $this->reserver;
	}
	function getid_marque(){
		return $this->id_marque;
	}

    

	function setid_voiture($i){
		$this->id_voiture=$i;
	}
	function setnom_voiture($nv){
		$this->nom_voiture=$nv;
	}
	function settype($ty){
		$this->type=$ty;
    }
    function setvitesse($vi){
		$this->vitesse=$vi;
	}
	function setmodel($mo){
		$this->model=$mo;
    }
    function setreserver($re){
		$this->reserver=$re;
	}
	function setid_marque($idm){
		$this->id_marque=$idm;
	}
	function setphoto($ph){
		$this->photo=$ph;
	}

}



?>