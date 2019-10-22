<?php
include('../Service/Config.php');
include('../Metier/User.php');
include('../Metier/voiture.php');
$sess=-1;
if($_SESSION['user_session']=="")
{
    header("Location: Login.php?message=Pleas Sing In Our Sing Up");
}
if(isset($_GET["message"])=="l'ajoute à réussi")
{
    echo "<script>alert('l'ajoute à réussi')</script>";
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
    <link rel="stylesheet" type="text/css" href="../css/Swagtastic.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css">

    <!-- Plugin CSS -->
    <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../css/freelancer.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">SalamaCars</a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded"
                type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Voitures</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">About</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Contact</a>
                    </li>
                    <?php if($_SESSION['rolle'] == "admin") {?>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="Admin.php">Add Voiture</a>
                    </li>
                    <?php } ?>
                        <button class="btn btn-danger"><a href="Deconnexion.php" style="color:white;text-decoration:none">Deconnexion</a></button>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
        <div class="container">
        <h2 style="color:white;"><?php echo $_SESSION['rolle']; ?></h2>
            <img class="img-fluid mb-5 d-block mx-auto" src="<?php echo "../img/avatar/".$_SESSION['photo']; ?>" alt="">
            <h2 class="text-uppercase mb-0" style="color:#2c3e50;">Louer une voiture au <b>Maroc</b></h2>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Voitures</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <?php
            $ss = new Voiture_Service();
            $tc = $ss->findAll();
            $a=0;
            foreach($tc as $row) {
                $a+=1;
        ?>
                <div class="col-md-6 col-lg-4">
                    <a class="portfolio-item d-block mx-auto" name="portfolio" href="#portfolio-modal-<?php echo $a;echo $id=$row["id_voiture"];?>">
                        <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                            <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                                <i class="fas fa-search-plus fa-3x"><?php echo $row['nom_voiture']; ?></i>
                            </div>
                        </div>
                        <img class="img-fluid" id="imageVoiture" src="<?php echo $row['photo']; ?>" alt="" style="max-width: 100%;height: 214px;margin-top: 10px;margin-bottom: 10px;">
                        <p style="visibility:hidden;"><?php echo $row["id_voiture"] ?></p>
                    </a>
                    </a>
                    <?php //if($sess==1) { ?>
                    <div class="btn-group" class="aficher">
                    <?php echo '
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a  href=\'Reserver.php?id_voiture='.$row["id_voiture"].'\'>Reserver</a></button> 
                                ';?> 
                    <?php if($_SESSION['rolle'] == "admin") { echo '<a class="btn btn-danger" href=\'Supprimer.php?id_voiture='.$row["id_voiture"].'\' onclick=\"return confirm("Vous voulez vraiment supprimer c\'ette Voiture")\">Supprimer</a>'.'<a class="btn btn-success" href=\'Modiffier.php?id_voiture='.$row["id_voiture"].'\' ">Modiffier</a>';}?>
                    </div>
                    <small class="text-muted">9 mins</small>
                    <?php //} ?>
                </div>

                <?php } ?>
            </div>
        </div>
    </section>

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
    <section id="contact">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Contact Me</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Name</label>
                                <input class="form-control" id="name" type="text" placeholder="Name" required="required"
                                    data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Email Address</label>
                                <input class="form-control" id="email" type="email" placeholder="Email Address"
                                    required="required"
                                    data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Phone Number</label>
                                <input class="form-control" id="phone" type="tel" placeholder="Phone Number"
                                    required="required"
                                    data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Message"
                                    required="required"
                                    data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

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
    <?php
            $ss = new Voiture_Service();
            $tc = $ss->findAll();
            $c=0;
            foreach($tc as $row) {
                $c+=1;
        ?>
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-<?php echo $c;echo $id=$row["id_voiture"]; ?>">
        <div class="portfolio-modal-dialog bg-white">
            <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
                <i class="fa fa-3x fa-times"></i>
            </a>
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <?php 
                         $ss = new Voiture_Service();
                         $tc = $ss->findById($id); 

                         $nom_voiture=$tc->getnom_voiture();
                        ?>
                        <h2 class="text-secondary text-uppercase mb-0"><?php echo $nom_voiture; ?></h2>
                        <hr class="star-dark mb-5">
                        <img class="img-fluid mb-5" src="<?php echo $row['photo']; ?>" alt="">
                        <p class="mb-5">
                            <table id="tableV" class="table table-striped">
                                <tr>
                                    <th>Type</th>
                                    <td><?php echo $row['type']; ?></td>
                                </tr>
                                <tr>
                                    <th>Vitesse</th>
                                    <td><?php echo $row['vitesse']; ?></td>
                                </tr>
                                <tr>
                                    <th>Modele</th>
                                    <td><?php echo $row['model']; ?></td>
                                </tr>
                                <tr>
                                    <th>Reservation</th>
                                    <td><?php echo $row['reserver']; ?></td>
                                </tr>
                            </table>
                            <h3>Reservation : N --> Non Reserver # O --> Reservé </h3>
                            <?php echo '
                                    <button type="button" style="width: 143px !important;" class="btn btn-sm btn-outline-secondary"><a style="font-size: 32px;" href=\'Reserver.php?id_voiture='.$row["id_voiture"].'\'>Reserver</a></button> 
                                ';?>
                        </p>
                        <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                            <i class="fa fa-close"></i>
                            Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <?php } ?>

    

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

</body>

</html>