<?php
class Voiture_Service implements dao
{
	public $d;
    private $db;

    function __construct()
    {
        $c = new Connexion();

        $this->db = $c->getdb();
    }
    function add($voiture)
    {
		$st = $this->db->prepare('INSERT INTO voiture VALUES(NULL,?,?,?,?,?,?,?)');
        if($st->execute(array($voiture->getnom_voiture(),$voiture->getphoto(),$voiture->gettype(),$voiture->getvitesse(),$voiture->getmodel(),$voiture->getreserver(),$voiture->getid_marque())))
        {
			var_dump($st);
            return true;
        }
        else{
            return false;
        }
    }
    function findAll()
 	{
		$d="oyssama";

	 	 $st =	$this->db->prepare('SELECT * from voiture');
	 	 if ($st->execute()) {
	 	 	return $st->fetchAll();
	 	 }
	 	 else{
	 	 	return null;
	 	 }
     }
     function findById($id_voiture)
 	{
	 	 $st =	$this->db->prepare('SELECT * FROM voiture WHERE id_voiture=?');
	 	 if ($st->execute(array($id_voiture))) {
	 	 	$row = $st->fetch(PDO::FETCH_OBJ);
	 	 	$ss = new Marque_Service();
	 	 	return new Voiture($row->nom_voiture,$row->photo,$row->type,$row->vitesse,$row->model,$row->reserver,$row->id_marque);
	 	 }
	 	 else{
	 	 	echo "Problème ";
	 	 	return null;
	 	 }
 	} 
 	function update($voiture)
 	{
 	 	 $st =$this->db->prepare('UPDATE voiture set nom_voiture=? , photo=? , type=? , vitesse=?, model=? , reserver=?, id_marque=? where id_voiture=?');
	 	 if ($st->execute(array($voiture->getid_voiture(),$voiture->getnom_voiture(),$voiture->getphoto(),$voiture->gettype(),$voiture->getvitesse(),$voiture->getmodel(),$voiture->getreserver(),$voiture->getid_marque()))) {
	 	 	return true;
	 	 }
	 	 else{
	 	 	return false;
	 	 }
 	 
 	}
 	function supprimer($voiture)
 	{

	 	 $st =	$this->db->prepare('DELETE FROM voiture where id_voiture=?');
	 	 if ($st->execute(array($voiture->getid_voiture()))) {
	 	 	return true;
	 	 }
	 	 else{
	 	 	return false;
	 	 }
 	}
 	function SelectProd()
 	{
 		 $st =	$this->db->prepare('SELECT * FROM voiture WHERE id_voiture=:id_voiture');
 		 $st->bindParam(":id_voiture", $id_voiture);
	 	 if ($st->execute()) {
	 	 	return $st->fetchAll();
	 	 }
	 	 else{
	 	 	return null;
	 	 }
 	}
}

?>