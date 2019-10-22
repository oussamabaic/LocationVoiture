<?php
class Reservation_Service implements dao
{
	public $d;
    private $db;

    function __construct()
    {
        $c = new Connexion();

        $this->db = $c->getdb();
    }
    function add($reservation)
    {
        $st = $this->db->prepare('INSERT INTO reservation VALUES(NULL,?,?,?,?,?)');
        if($st->execute(array($reservation->getdateD(),$reservation->getdateF(),$reservation->getid_user(),$reservation->getid_voiture(),$reservation->getid_marque())))
        {
            return true;
        }
        else{
            return false;
        }
    }
    function filter($reservation)
    {
        $st = $this->db->prepare("SELECT * FROM reservation WHERE dateD >= ? AND dateF <= ?");
        if($st->execute(array($reservation->getdateD(),$reservation->getdateF())))
        {
            return $st->fetchAll();
        }
        else{
            return null;
        }
    }
    function findAll()
 	{

	 	 $st =	$this->db->prepare('SELECT * from reservation');
	 	 if ($st->execute()) {
	 	 	return $st->fetchAll();
	 	 }
	 	 else{
	 	 	return null;
	 	 }
     }
     function findById($idV)
 	{
	 	 $st =	$this->db->prepare('SELECT * FROM reservation WHERE id_reservation=?');
	 	 if ($st->execute(array($idV))) {
	 	 	$row = $st->fetch(PDO::FETCH_OBJ);
	 	 	$ss = new reservation_Service();
	 	 	return new reservations($row->title,$row->nbrVoiture);
	 	 }
	 	 else{
	 	 	echo "Problème ";
	 	 	return null;
	 	 }
 	} 
 	function update($reservation)
 	{
 	 	 $st =$this->db->prepare('UPDATE reservation set title=? , nbrVoiture=?  where id_reservation=?');
	 	 if ($st->execute(array($reservation->gettitle(),$reservation->getnbrVoiture()))) {
	 	 	return true;
	 	 }
	 	 else{
	 	 	return false;
	 	 }
 	 
 	}
 	function supprimer($reservation)
 	{

	 	 $st =	$this->db->prepare('DELETE FROM reservations where id_reservation=?');
	 	 if ($st->execute(array($reservation->getid_reservation()))) {
	 	 	return true;
	 	 }
	 	 else{
	 	 	return false;
	 	 }
 	}
 	function Selectreservation()
 	{
 		 $st =	$this->db->prepare('SELECT * FROM reservations WHERE id_reservation=:id');
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