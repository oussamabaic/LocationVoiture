<?php
class Marque_Service implements dao
{
	public $d;
    private $db;

    function __construct()
    {
        $c = new Connexion();

        $this->db = $c->getdb();
    }
    function add($marque)
    {
        $st = $this->db->prepare('INSERT INTO marques VALUES(NULL,?,?)');
        if($st->execute(array($marque->gettitle(),$marque->getnbrVoiture())))
        {
            return true;
        }
        else{
            return false;
        }
    }
    function findAll()
 	{

	 	 $st =	$this->db->prepare('SELECT * from marques');
	 	 if ($st->execute()) {
	 	 	return $st->fetchAll();
	 	 }
	 	 else{
	 	 	return null;
	 	 }
     }
     function findById($idV)
 	{
	 	 $st =	$this->db->prepare('SELECT * FROM marques WHERE id_marque=?');
	 	 if ($st->execute(array($idV))) {
	 	 	$row = $st->fetch(PDO::FETCH_OBJ);
	 	 	$ss = new Marque_Service();
	 	 	return new Marques($row->title,$row->nbrVoiture);
	 	 }
	 	 else{
	 	 	echo "Problème ";
	 	 	return null;
	 	 }
 	} 
 	function update($marque)
 	{
 	 	 $st =$this->db->prepare('UPDATE marque set title=? , nbrVoiture=?  where id_marque=?');
	 	 if ($st->execute(array($marque->gettitle(),$marque->getnbrVoiture()))) {
	 	 	return true;
	 	 }
	 	 else{
	 	 	return false;
	 	 }
 	 
 	}
 	function supprimer($marque)
 	{

	 	 $st =	$this->db->prepare('DELETE FROM marques where id_marque=?');
	 	 if ($st->execute(array($marque->getid_marque()))) {
	 	 	return true;
	 	 }
	 	 else{
	 	 	return false;
	 	 }
 	}
 	function SelectMarque()
 	{
 		 $st =	$this->db->prepare('SELECT * FROM marques WHERE id_marque=:id');
 		 $st->bindParam(":id", $id);
	 	 if ($st->execute()) {
	 	 	return $st->fetchAll();
	 	 }
	 	 else{
	 	 	return null;
	 	 }
 	}
}

?>