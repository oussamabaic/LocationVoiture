<?php
include('../Service/Config.php');
include('../Metier/User.php');
include('../Metier/voiture.php');
$sess = -1;

if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["password"]);
	  //filtre et validation du formulaire
    $user1 = new User();
    $user1 = $user1->getuser3($email, $pass);
    if ($user->login($user1)) {
        $message = "Bienvenue";
        $sess = 1;
        header("Location: show.php?message=$message");
    } else {
        header('Location: Logoin.php?message=Error');
    }
}

if ($sess != 1) {
    echo "<style>
        .aficher{ 
            visibility:hidden;
        }
    </style>";
}



if (isset($_POST['btn_sign_up'])) {

    // image protection
    $image = checkInput($_FILES['photo']['name']);
    // hena dekhel chemien libiti tesiftlih photo :)
    $imagePath = '../img/' . basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        /* Vérifier l'image */

    $imageError = "<span class=\"text-danger\">Ce champ <strong>image</strong> ne peut pas être Vide</span>";
    $isSuccess = false;
    if (!empty($image)) {
        echo "<script>alert('true');</script>";
        if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtention != "gif") {
            $imageError = "<span class=\"text-danger\">Les fichiers autorises sont:<strong> .jpg, .jpeg, .png, .gif </strong></span>";
            $isUploadSuccess = false;
        }
        if (file_exists($imagePath)) {
            $imageError = "<span class=\"text-danger\">Le fichier <strong>existe déja</strong></span>";
            $isUploadSuccess = false;
        }
        if ($_FILES['photo']['size'] > 800000) {
            $imageError = "<span class=\"text-danger\">Le fichier ne doit pas dépasser <strong>les 500KB </strong></span>";
            $isUploadSuccess = false;
        }
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $imagePath)) {
            $imageError = "<span class=\"text-danger\"><strong>Il y a eu une erreur lors de l'upload</strong></span>";
            $isUploadSuccess = false;
        }
    }
//Après clic sur le bouton "Envoyer" envoie de données par post
  //récupération et protection des données envoyées
    $username = htmlspecialchars($_POST["nom_user"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = htmlspecialchars($_POST["email"]);
    $pass = htmlspecialchars($_POST["password"]);
  //filtre et validation du formulaire
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $user = new User();
        $user = $user->getuser1($username, $prenom, $email, $pass, $image);
        $cs = new User_Service();

        if ($cs->register($user)) {
            $message = "Inscription à réussi";
            header("Location: Login.php?message=Inscription à réussi");
        } else {
            header('Location: Login.php?message=Error');
        }
    } else {
        header('Location: Login.php?message=email error : Email Entred Not Found !');
    }

}
function checkInput($data)
{
    $data = filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    return $data;
}
//les autres pages peuvent envoyer un message dans L’URL. On le  récupère ici pour l'afficher dans l’élément "div.message"
if (isset($_GET["message"])) {
    $message = $_GET["message"];
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
    <script src="main.js"></script>
    <style>
        .cont_form_sign_up input{
            margin-top:10px !important;
        }
        .alert{
            color: red;
            background-color: beige;
            display: unset;
            margin-top: 123px;
            position: absolute;
            top: 314px;
            left: 117px;
            font-size: 23px;
        }
    </style>
</head>

<body>
        <div class="cotn_principal" style="background-image: url('../img/body.jpg');background-repeat: round;">
            <div class="cont_centrar">

                <div class="cont_login">
                    <div class="cont_info_log_sign_up">
                        <div class="col_md_login">
                            <div class="cont_ba_opcitiy">

                                <h2>LOGIN</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
                            </div>
                        </div>
                        <div class="col_md_sign_up">
                            <div class="cont_ba_opcitiy">
                                <h2>SIGN UP</h2>


                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                                <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
                            </div>
                        </div>
                    </div>


                    <div class="cont_back_info">
                        <div class="cont_img_back_grey">
                            <img src="img/background.jpg" alt="" />
                        </div>

                    </div>
                    <form action="Login.php" method="POST">
                    <div class="cont_forms">
                        <div class="cont_img_back_">
                            <img src="img/background.jpg" alt="" />
                        </div>
                        <div class="cont_form_login">
                            <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
                            <h2>LOGIN</h2>
                            <input type="text" placeholder="Email" name="email" />
                            <input type="password" placeholder="Password" name="password" />
                            <button class="btn_login" name="login" type="submit" onclick="cambiar_login()">LOGIN</button>
                        </div>
                        </form>

                        <form action="Login.php" method="post" enctype="multipart/form-data" >
                        <div class="cont_form_sign_up">
                            <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
                            <h2>SIGN UP</h2>
                            <input type="text" placeholder="Email" name="email"/>
                            <input type="text" placeholder="Nom" name="nom_user" />
                            <input type="text" placeholder="Prenom" name="prenom" />
                            <input type="password" placeholder="Password" name="password" />
                            
                            <input type="file" id="image" name="photo" />
                            <button class="btn_sign_up" name="btn_sign_up" type="submit" onclick="cambiar_sign_up()">SIGN UP</button>

                        </div>
                        </form>
                    </div>
                    <?php 
                    if (isset($message)) {
                        echo "<div class=\"alert alert-danger\">
                        <strong>$message</strong>; 
                        </div>
                        </div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    
    <script>
    /* ------------------------------------ Click on login and Sign Up to  changue and view the effect
---------------------------------------
*/

    function cambiar_login() {
        document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_login";
        document.querySelector('.cont_form_login').style.display = "block";
        document.querySelector('.cont_form_sign_up').style.opacity = "0";

        setTimeout(function() {
            document.querySelector('.cont_form_login').style.opacity = "1";
        }, 400);

        setTimeout(function() {
            document.querySelector('.cont_form_sign_up').style.display = "none";
        }, 200);
    }

    function cambiar_sign_up(at) {
        document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_sign_up";
        document.querySelector('.cont_form_sign_up').style.display = "block";
        document.querySelector('.cont_form_login').style.opacity = "0";

        setTimeout(function() {
            document.querySelector('.cont_form_sign_up').style.opacity = "1";
        }, 100);

        setTimeout(function() {
            document.querySelector('.cont_form_login').style.display = "none";
        }, 400);


    }



    function ocultar_login_sign_up() {

        document.querySelector('.cont_forms').className = "cont_forms";
        document.querySelector('.cont_form_sign_up').style.opacity = "0";
        document.querySelector('.cont_form_login').style.opacity = "0";

        setTimeout(function() {
            document.querySelector('.cont_form_sign_up').style.display = "none";
            document.querySelector('.cont_form_login').style.display = "none";
        }, 500);

    }
    </script>

</body>

</html>