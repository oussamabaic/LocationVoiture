<?php
/**
* 
*/
class Marques 
{
	private $id_marque,$title,$nbrVoiture;
	function  __construct($t,$nb)
    {
        $this->title=$t;
        $this->nbrVoiture=$nb;
    }
	function getid_marque(){
		return $this->id_marque;
	}
	function gettitle(){
		return $this->title;
	}
	function getnbrVoiture(){
		return $this->nbrVoiture;
	}
	

	function setid_marque($i){
		$this->id_marque=$i;
	}
	function settitle($t){
		$this->title=$t;
	}
	function setnbrVoiture($nb){
		$this->nbrVoiture=$nb;
	}

}



?>