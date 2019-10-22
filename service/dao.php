<?php
interface dao{
	function add($o);
	function update($o);
	function supprimer($o);
	function findById($id);
	function findAll();
}

?>