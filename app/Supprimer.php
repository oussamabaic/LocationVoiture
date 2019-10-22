<?php
include('../Service/Config.php');
include('../Metier/User.php');
include('../Metier/voiture.php');

if($user->is_loggedin()){
     
  //Supprimer l'exercice dont l'id est envoyé avec l'URL
  $id_voiture = htmlspecialchars($_GET["id_voiture"]);
  $ss = new Voiture_Service();
  if ($ss->supprimer($ss->findById($id_voiture))) {
    $message= "la Voiture  été supprimé avec succés";
  }else{
    $mesasge="Erreur pendant la suppression du Voiture";
  }
   
  //Redirection vers la page exercice.php avec un message résultat de la suppression 
   header("Location: show.php?message=$message");


}
else{
header("Location: Login.php");
}
