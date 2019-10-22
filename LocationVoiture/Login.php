<?php
include('../Service/Config.php');
include('../Metier/User.php');
include('../Metier/voiture.php');
$sess=-1;

if (isset($_POST['login'])) {
	  $email= htmlspecialchars($_POST["email"]);
      $pass = htmlspecialchars($_POST["password"]);
	  //filtre et validation du formulaire
          $user1 = new User();
          $user1 = $user1->getuser3($email,$pass);
          if($user->login($user1)){
          	$message= "Bienvenue";
          	$sess=1;
            header("Location: show.php?message=$message");
          }
          else{
            header('Location: index.php?message=Error');
          }
}

if($sess!=1)
{
    echo "<style>
        .aficher{ 
            visibility:hidden;
        }
    </style>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
    <script src="main.js"></script>
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
                <div class="cont_forms">
                    <div class="cont_img_back_">
                        <img src="img/background.jpg" alt="" />
                    </div>
                    <div class="cont_form_login">
                        <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
                        <h2>LOGIN</h2>
                        <input type="text" placeholder="Email" name="email" />
                        <input type="password" placeholder="Password" name="password" />
                        <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
                    </div>

                    <div class="cont_form_sign_up">
                        <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
                        <h2>SIGN UP</h2>
                        <input type="text" placeholder="Email" />
                        <input type="text" placeholder="User" />
                        <input type="password" placeholder="Password" />
                        <input type="password" placeholder="Confirm Password" />
                        <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>

                    </div>

                </div>

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