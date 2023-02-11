<?php

include 'php/class.php';

$bdd = connexionbdd();

if (!isset($_GET['Action'])) $_GET['Action']="";
$Action = $_GET['Action'];

if ($Action=="valider")
{
  $id_voyage = $_GET['id'];
  $mailinscription = $_GET['mail'];
  $requete = $bdd->prepare("UPDATE inscrit SET validation = 1 WHERE id_voyage = '$id_voyage' AND mail = '$mailinscription'");
  if($requete->execute()){
  }
  else {
    echo "erreur";
  }
}
if ($Action=="refuser")
{
  $id_voyage = $_GET['id'];
  $mailinscription = $_GET['mail'];
  $requete = $bdd->prepare("UPDATE inscrit SET validation = 2 WHERE id_voyage = '$id_voyage' AND mail = '$mailinscription'");
  if($requete->execute()){
  }
  else {
    echo "erreur";
  }
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>IsenVoyage</title>
  <link rel="shortcut icon" href="img/core-img/plane.ico">
  <link rel="stylesheet" href="style_moderateur.css">
</head>
<body>
  <header class="header-area">
    <div class="search-form d-flex align-items-center">
      <div class="container">
      </div>
    </div>

    <!-- Top Header Area Start -->
    <div class="top-header-area">
      <div class="container">
        <div class="row">

          <div class="col-6">
            <div class="top-header-content">
              <a href="#"><i class="icon_phone"></i> <span>07 91 25 34 82</span></a>
              <a href="#"><i class="icon_mail"></i> <span>info.isenvoyage@gmail.com</span></a>
            </div>
          </div>

          <div class="col-6">
            <div class="top-header-content">
              <div class="top-social-area ml-auto">
                <a href="#"><span>Espace de Moderation</span></i></a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="main-header-area">
      <div class="classy-nav-container breakpoint-off">
        <div class="container">
          <!-- Classy Menu -->
          <nav class="classy-navbar justify-content-between" id="robertoNav">

            <!-- Logo -->
            <a class="nav-brand" href="index_moderateur.html"><img src="img/core-img/logo.png" alt=""></a>

            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
              <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>

            <!-- Menu -->
            <div class="classy-menu">
              <!-- Menu Close Button -->
              <div class="classycloseIcon">
                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
              </div>
              <!-- Nav Start -->
              <div class="classynav">
                <ul id="nav">
                  <li class="active"><a href="./index_moderateur.html">Acceuil</a></li>
                  <li><a href="./voyage_moderateur.php">Consulter les Voyages</a></li>
                  <li><a href="./validation_voyage_moderateur.php">Valider les Voyages</a></li>
                  <li><a href="./modification_voyage_moderateur.php">Modifier Voyages</a></li>
                  <li><a href="./modification_pays.php">Modifier pays</a></li>
                </ul>
              </div>
              <!-- Nav End -->
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- Header Area End -->

  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/admin.jpg);">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <div class="breadcrumb-content text-center">
            <h2 class="page-title">Validation des inscriptions</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="roberto-rooms-area section-padding-100-0">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-8">
          <!-- Code pour les voyage  -->

          <?php

           if (( $_POST['validation_recherche'] == 3) && empty($_POST['mail'])){

            $requete1 = "SELECT * FROM inscrit ";

            $stmt = $bdd->query($requete1);
            $inscrit = $stmt->fetchall(PDO::FETCH_CLASS,'inscrit');

            $nombre_inscrit = tailletable("SELECT COUNT(*) FROM inscrit" , $bdd);

          }else if ($_POST["validation_recherche"] == 3 && !empty($_POST['mail'])){

            $mail = $_POST['mail'];
            $requete2 = "SELECT * FROM inscrit WHERE mail = '$mail'";

            $stmt = $bdd->query($requete2);
            $inscrit = $stmt->fetchall(PDO::FETCH_CLASS,'inscrit');

            $nombre_inscrit = tailletable("SELECT COUNT(*) FROM inscrit  WHERE  mail = '$mail'" , $bdd);


          }else if ($_POST["validation_recherche"] != 3 && !empty($_POST['mail'])){

            $mail = $_POST['mail'];

            $validation_recherche = $_POST['validation_recherche'];

            $requete2 = "SELECT * FROM inscrit WHERE mail = '$mail' AND validation= '$validation_recherche' ";

            $stmt = $bdd->query($requete2);
            $inscrit = $stmt->fetchall(PDO::FETCH_CLASS,'inscrit');

            $nombre_inscrit = tailletable("SELECT COUNT(*) FROM inscrit  WHERE  mail = '$mail' AND validation = '$validation_recherche' " , $bdd);


          }else if ($_POST['validation_recherche'] != 3 && empty($_POST['mail'])){

            $validation_recherche = $_POST['validation_recherche'];

            $requete1 = "SELECT * FROM inscrit WHERE validation = '$validation_recherche' ";

            $stmt = $bdd->query($requete1);
            $inscrit = $stmt->fetchall(PDO::FETCH_CLASS,'inscrit');

            $nombre_inscrit = tailletable("SELECT COUNT(*) FROM inscrit WHERE validation = '$validation_recherche'" , $bdd);

        }


            if ($nombre_inscrit[0] == 0) {

              echo "Pas d'inscription";
            }


          for($i = 0 ;  $i <= ($nombre_inscrit[0])-1 ; $i++){
            $mail = $inscrit[$i]->getmail();
            $id_voyage = $inscrit[$i]->getid_voyage();

            $con = $bdd->query("SELECT * FROM voyage WHERE id_voyage= '$id_voyage' ");
            $voyage = $con->fetchall(PDO::FETCH_CLASS,'voyage');

            $con2 = $bdd->query("SELECT * FROM utilisateur WHERE mail= '$mail' ");
            $utilisateur = $con2->fetchall(PDO::FETCH_CLASS,'utilisateur');

            echo '<div class="single-room-area d-flex align-items-center mb-100">
            <!-- Room Thumbnail -->
            <div class="room-thumbnail">
            <img src="img/bg-img/'.$voyage[0]->getid_voyage().'.jpg" alt="">
            </div>
            <!-- Room Content -->
            <div class="room-content">
            <h2>'.$utilisateur[0]->getnom().' '.$utilisateur[0]->getprenom().'</h2>
            <h4>'.$inscrit[$i]->getmail() .'<span></span></h4>
            <h4>'.$voyage[0]->getlibelle() .'<span></span></h4>
            <div class="room-feature">
            <h6>Depart: <span>'.$inscrit[$i]->getdate_debut().'</span></h6>
            <h6>Durée:<span>'.$voyage[0]->getduree().'</span></h6>
            <h6>Retour: <span>'.$inscrit[$i]->getdate_fin().'</span></h6>
            <h6>Cout: <span>'.$voyage[0]->getcout().'</span></h6>
            </div>
            ';

            if($inscrit[$i]->getvalidation() == 0){
              echo'
              <a href="validation_voyage_moderateur.php?Action=valider&id='.$voyage[0]->getid_voyage().'&mail='.$utilisateur[0]->getmail().'" title="valider" class="btn roberto-btn w-100  mb-30">valider</a>
              <a href="validation_voyage_moderateur.php?Action=refuser&id='.$voyage[0]->getid_voyage().'&mail='.$utilisateur[0]->getmail().'" title="refuser" class="btn roberto-btn w-100  mb-30">refuser</a>
              </div>
              </div>'
              ;
            }else if($inscrit[$i]->getvalidation() == 1){
              echo'
              <span class="btn roberto-btn w-100 mb-30" style = "background-color:green;" >Accepter</span>
              </div>
              </div>';

            }else if($inscrit[$i]->getvalidation() == 2){
              echo'
              <span class="btn roberto-btn w-100 mb-30" style = "background-color:red ; ">Refuser</span>
              </div>
              </div>';
            }
          }
          ?>

        </div>

        <div class="col-12 col-lg-4">
          <!-- Hotel Reservation Area -->
          <div class="hotel-reservation--area mb-100">
            <form action="validation_voyage_moderateur.php" method="post">
              <div class="form-group mb-30">
                <label for="checkInDate">Date</label>

                <div class="row no-gutters">

                <div class="col-6">
                <input type="text" class="input-small form-control" name="mail" placeholder="mail">
              </div>
              <div class="col-6">
                <select name="validation_recherche" id="guests" class="form-control">
                  <option value = "3"> All</option>
                  <option value = "0"> En attente </option>
                  <option value = "1"> valider </option>
                  <option value = "2"> refuser </option>
                </select>
            </div>

          </div>

    </div>
    <div class="form-group mb-30">
      <div class="row">
        <div class="col-6">

        </div>
      </div>
    </div>
    <div class="form-group mb-50">
    </div>
    <div class="form-group" >
      <button type="submit" class="btn roberto-btn w-100 mb-30" >Chercher un Voyage</button>
    </div>
  </form>
</div>
</div>
</div>
</div>
</div>
<footer class="footer-area section-padding-80-0">
  <!-- Main Footer Area -->
  <div class="main-footer-area">
    <div class="container">
      <div class="row align-items-baseline justify-content-between">
        <!-- Single Footer Widget Area -->
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="single-footer-widget mb-80">
            <span>info.isenvoyage@gmail.com</span>
            <span>07 91 25 34 82</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Copywrite Area -->
  <div class="container">
    <div class="copywrite-content">
      <div class="row align-items-center">
        <div class="col-12 col-md-8">
          <!-- Copywrite Text -->
          <div class="copywrite-text">
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tous droit reservée | Merci
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Footer Area End -->

<!-- **** All JS Files ***** -->
<!-- jQuery 2.2.4 -->
<script src="js/jquery.min.js"></script>
<!-- Popper -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- All Plugins -->
<script src="js/roberto.bundle.js"></script>
<!-- Active -->
<script src="js/default-assets/active.js"></script>

</body>
</html>
