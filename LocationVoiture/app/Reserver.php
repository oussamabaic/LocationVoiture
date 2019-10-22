<?php

include('../Service/Config.php');
include('../Metier/User.php');
include('../Metier/Voiture.php');
include('../Metier/Marques.php');
include('../Metier/Reservation.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php
    if($_SESSION['user_session']=="")
    {
        header("Location: Login.php?message=LogIn");
    }
    $id_voiture = $_GET["id_voiture"];


    if (isset($_POST['Reserver'])) {
        //Après clic sur le bouton "Envoyer" envoie de données par post
        if (count($_POST)>1) {
          //récupération et protection des données envoyées
          $dateD= htmlspecialchars($_POST["dateD"]);
          $dateF= htmlspecialchars($_POST["dateF"]);
          $id_user = htmlspecialchars($_POST["id_user"]);
          $id_voiture = htmlspecialchars($_POST["id_voiture"]);
          $id_marque = htmlspecialchars($_POST["id_marque"]);
          //filtre et validation du formulaire
                  $vv = new Reservation_Service();
                  $reservation = new reservation($dateD,$dateF,$id_user,$id_voiture,$id_marque);
                  if($vv->add($reservation))
                  {
                    $message= "l'ajoute à réussi";
                      header("Location: show.php?message=l'ajoute à réussi");
                  }
                  else{
                    header('Location: show.php?message=Error');
                  }
            
          }
        }
    
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>SalamaCars</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="../css/style1.css" />
    <link type="text/css" rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <script src="../js/jquery.min.js" type="text/javascript" charset="utf-8" async defer></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="show.php">Salama Cars</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="show.php">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>


        </div>
    </nav>
    <form action="" method="POST">
    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-md-push-5">
                        <div class="booking-cta">
                            <h1>Make your reservation</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi facere, soluta magnam
                                consectetur molestias itaque
                                ad sint fugit architecto incidunt iste culpa perspiciatis possimus voluptates aliquid
                                consequuntur cumque quasi.
                                Perspiciatis.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-pull-7">
                        <div class="booking-form">
                            <form>
                                <div class="form-group">
                                <?php
                                    $ss = new Voiture_Service();
                                    $tc = $ss->findById($id_voiture); 

                                    $nom_voiture=$tc->getnom_voiture();
                                    $model=$tc->getmodel();
                                    $id_marque=$tc->getid_marque();

                                    $ms = new Marque_Service();
                                    $tm = $ms->findById($id_marque); 
                                    $title=$tm->gettitle();

                                                ?>
                                    <input class="form-control" readonly type="text" value="<?php echo $nom_voiture ." ".$title ." ".$model; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span class="form-label">Check In</span>
                                            <input class="form-control" name="dateD" type="date" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <span class="form-label">Check out</span>
                                            <input class="form-control" name="dateF" type="date" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <span class="form-label">Id User</span>
                                            <select class="form-control" readonly name="id_user">
                                                <option><?php echo $_SESSION['user_session']; ?></option>
                                            </select>
                                            <span class="select-arrow"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <span class="form-label">Id Voiture</span>
                                            <select class="form-control" readonly name="id_voiture">
                                                <option><?php echo $id_voiture; ?></option>
                                            </select>
                                            <span class="select-arrow"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <span class="form-label">Id Marque</span>
                                            <select class="form-control" readonly name="id_marque">
                                                <option><?php echo $id_marque; ?></option>
                                            </select>
                                            <span class="select-arrow"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-btn">
                                    <button class="submit-btn" name="Reserver">Reserver</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <script>
    $(document).ready(function() {
        $(".pageProfile").css({
            'visibility': 'hidden'
        });
        $(".dropdown").click(function() {
            $(".pageProfile").css({
                'visibility': 'visible'
            });
            $(".pageProfile").toggle();
        });
    });
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>