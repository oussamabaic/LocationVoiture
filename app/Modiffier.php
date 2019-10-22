<?php
include('../Service/Config.php');
include('../Metier/User.php');
include('../Metier/Voiture.php');
include('../Metier/Marques.php');
include('../Metier/Reservation.php');
$sess=-1;
if($_SESSION['user_session']=="")
{
    header("Location: Login.php?message=Pleas Sing In Our Sing Up");
}
if ($user->is_loggedin()){
        //Après appel de la page on récupéré l'id de l'exercice en question
        if(isset($_GET["id_voiture"])){
            // Récupérer des informations de l'exercice en question qui seront par la suite afficher dans le formulaire en bas
                  $id_voiture = htmlspecialchars($_GET['id_voiture']);
                  $ss = new Voiture_Service();
                  $tc = $ss->findById($id_voiture);
              // Parcourir les lignes de résultat
            if (is_null($tc)) {
              $message="Le Produit est introuvable";
              header("Loation:showt.php?message=$message");
            }
            else{
                $nom_voiture=$tc->getnom_voiture();
                $photo=$tc->getphoto();
                $type=$tc->gettype();
                $vitesse=$tc->getvitesse();
                $model=$tc->getmodel();
                $reserver=$tc->getreserver();
                $id_marque=$tc->getid_marque();
            }
        }

    // Après clic sur le bouton modifier on récupère les données envoyées par la méthode post
   if(isset($_POST['ModiffierrVoiture']))
   {
        //filtre et validation du formulaire
        $nom_voiture = htmlspecialchars($_POST["nom_voiture"]);
        $photo = htmlspecialchars("../img/".$_POST["photo"]);
        $type = htmlspecialchars($_POST["type"]);
        $vitesse= htmlspecialchars($_POST["vitesse"]);
        $model= htmlspecialchars($_POST["model"]);
        $reserver = htmlspecialchars($_POST["reserver"]);
        $id_marque = htmlspecialchars($_POST["id_marque"]);
                     
                      $voiture = new voiture($nom_voiture,$photo,$type,$vitesse,$model,$reserver,$id_marque);
                      $ss = new Voiture_Service();
                      if($ss->update($voiture)){
                        $message= "Le Produit a été Modifier avec succès";
                      }
                      else{
                        $message= "Problème de Modification";
                      }
                      
                    
                    header("Location:show.php?message=$message");
   }
  $sess=1;
   }
    else{
            header("Location: Login.php");
          }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SalamaCars</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../css/Swagtastic.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css">

    <!-- Plugin CSS -->
    <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../css/freelancer.min.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav" style="margin-bottom: 0;">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">SalamaCars</a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded"
                type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" style="float: right;">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="show.php">Voitures</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="show.php">About</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="show.php">Contact</a>
                    </li>
                    <?php if($_SESSION['rolle'] == "admin") {?>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="show.php">Add Voiture</a>
                    </li>
                    <?php } ?>
                    <button class="btn btn-danger"><a href="Deconnexion.php"
                            style="color:white;text-decoration:none">Deconnexion</a></button>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
        <div class="container">
            <img class="img-fluid mb-5 d-block mx-auto" src="../img/profile.png" alt="">
            <h2 class="text-uppercase mb-0">Louer une voiture au <b>Maroc</b></h2>
        </div>
    </header>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <br><br>
    <div class="container register-form">
        <div class="form">
            <div class="note">
                <form action="" method="POST">
                    <p style="font-size:30px;">Ajouter Voiture</p>
            </div>

            <div class="form-content">
                <div class="row">
                    <img src="<?php echo $photo; ?>" alt="" style="margin: auto;margin-bottom: 10px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="<?php echo $nom_voiture ?>" name="nom_voiture" value="" />
                        </div>
                        <div class="form-group">
                            <input type="File" name="photo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="<?php echo $type ?>" name="type"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="<?php echo $vitesse ?>" name="vitesse"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="<?php echo $model ?>" name="model"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="<?php echo $reserver ?>" name="reserver"/>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Marque</h3>
                                <select name="id_marque" id="">
                                    <?php
                                        $dd = new Marque_Service();
                                        $tc = $dd->findAll();
                                        foreach($tc as $row) { 
                                    ?>
                                    <option value="<?php echo $row["id_marque"]; ?>"><?php echo $row["title"]; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" name="ModiffierrVoiture" class="btn btn-success" value="Ajouter Voiture">
                </form>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="about">
        <div class="container">
            <h2 class="text-center text-uppercase text-white">About</h2>
            <hr class="star-light mb-5">
            <div class="row">
                <div class="col-lg-4 ml-auto">
                    <p class="lead">Salama cars est une société Marocaine spécialiste
                        dans la location de voitures depuis plusieurs années. Elle offre un service de qualité avec les
                        meilleurs prix sur tout type de voiture.</p>
                </div>
                <div class="col-lg-4 mr-auto">
                    <p class="lead">Louez un véhicule de SalamaCars de location de voitures et
                        profitez d'un grand nombre d'avantages et de services gratuits..</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Location</h4>
                    <p class="lead mb-0">2215 John Daniel Drive
                        <br>Clark, MO 65243</p>
                </div>
                <div class="col-md-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Around the Web</h4>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                                <i class="fab fa-fw fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                                <i class="fab fa-fw fa-google-plus-g"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                                <i class="fab fa-fw fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                                <i class="fab fa-fw fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                                <i class="fab fa-fw fa-dribbble"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4 class="text-uppercase mb-4">About ISTA</h4>
                    <p class="lead mb-0">SiteWeb created by
                        <a href="#">Salah Takib & Oussama Baich</a>.</p>
                </div>
            </div>
        </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
        <div class="container">
            <small>Copyright &copy; SalamaCars 2018</small>
        </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->

    <!-- Portfolio Modal 1 -->



    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../js/freelancer.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript">
    $(".input").focus(function() {
        $(this).parent().addClass("focus");
    })
    </script>

</body>

</html>