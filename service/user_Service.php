<?php
 /**
 * 
 */
 class User_Service
 {
 	private $db;
 
 	function __construct()
 	{
 		$c = new Connexion();
 		$this->db = $c->getdb();
    }

    function update($user)
 	{

 	 try {
 	 	$st =$this->db->prepare('UPDATE user SET nom_user=? , prenom=?, email=? , pass=?, photo=?');
 	 if ($st->execute(array($user->getnom_user(),$user->getprenom(),$user->getemail(),$user->getpass(),$user->getphoto()))) {
 	 	return true;
 	 }
 	 else{
 	 	return false;
 	 }
 	 } catch (PDOException $e) {
 	 	echo $e->getMessage();
 	 }
    }
    
 	public function register($user)
    {
      try
       {
           $new_password = password_hash($user->getpass(), PASSWORD_DEFAULT);
   
           $stmt = $this->db->prepare("INSERT INTO user(id_user,nom_user,prenom,email,pass,photo) VALUES(null,?,?,?,?,?)");
           /*$stmt->bindparam(":username", $user->getusername());
           $stmt->bindparam(":email", $user->getemail());
           $stmt->bindparam(":pass", $new_password); */
           $nom=$user->getnom_user();
           $prenom=$user->getprenom();
           $email=$user->getemail();
           $pass=$user->getpass();
           $photo=$user->getphoto();
                   
           if($stmt->execute(array($nom,$prenom,$email,$pass,$photo)))
           {
             return true;
           }
           else{
              return false;
           }
   
           /*if ($stmt->rowCount()>0) {
            	return true;
            }
            return false;*/
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
    function findAll()
 	{

	 	 $st =	$this->db->prepare('SELECT * from user');
	 	 if ($st->execute()) {
	 	 	return $st->fetchAll();
	 	 }
	 	 else{
	 	 	return null;
	 	 }
     }
    public function login($user)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM user WHERE email=?");
          $stmt->execute(array($user->getemail()));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
                $_SESSION['user_session'] = $userRow['id_user'];
                $_SESSION['rolle'] = $userRow['nom_user'];
                $_SESSION['prenom'] = $userRow['prenom'];
                $_SESSION['photo'] = $userRow['photo'];
                return true;
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
      return false;
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }

 }


?>