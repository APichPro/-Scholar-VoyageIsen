<?php
  include 'php/class.php';
  $bdd = connexionbdd();

  if(empty($_POST['Libelle']) || empty($_POST['code_mc_pays']) || empty($_POST['description']) || empty($_POST['duree']) || empty($_POST['cout']) || empty($_FILES['image'])){
    echo 'Erreur Remplicer tout les champs';
  }else{


//preparation de la requete

$res = $bdd->prepare("INSERT INTO voyage (Libelle , cout , duree, code_mc_pays , description) VALUES(:Libelle ,:cout,:duree,:code_mc_pays,:description )");

  $res->bindValue(':Libelle',  $_POST["Libelle"],    PDO::PARAM_STR);
  $res->bindValue(':code_mc_pays', codemcpays($_POST['code_mc_pays'], $bdd),    PDO::PARAM_STR);
  $res->bindValue(':description',  $_POST['description'],    PDO::PARAM_STR);
  $res->bindValue(':duree',  $_POST["duree"],    PDO::PARAM_STR);
  $res->bindValue(':cout',  $_POST["cout"],    PDO::PARAM_STR);


if($res->execute()){
}
else {
}
$sql = "SELECT  MAX(id_voyage) as max FROM voyage";
$test = $bdd->query($sql);
$data = $test->fetch(PDO::FETCH_ASSOC);
$idmax=$data['max'];


if($_FILES['image']['error'] != 4)
{
 $dossier = 'img/bg-img/';
 $fichier = basename($_FILES['image']['name']);
 move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier);

 rename('img/bg-img/'.$fichier.'', 'img/bg-img/'.$idmax.'.jpg');
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
    <?php function edition() {
      $options = "Width=700,Height=700" ;
      $window.open( "edition.php", "edition", options ) ; } 
    ?>
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
  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/admin.jpg);">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <div class="breadcrumb-content text-center">
            <h2 class="page-title">Création d'un voyage</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Rooms Area Start -->
    <div class="roberto-rooms-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <!-- Single Room Details Area -->

                    <div class="hotel-reservation--area mb-100">

                        <div class="room-thumbnail-slides mb-50">
                            <div id="room-thumbnail--slide" class="carousel slide" data-ride="carousel">
                                <div class="form-group mb-30">
                                  <form enctype="multipart/form-data" action="" method="post">
                                    <label for="Libelle">Libelle : </label>
                                    <input class = " mb-15" type="text" name="Libelle"/>
                                    <br>

                                    <br>
                                    <label for="cout">Cout: </label>
                                    <input class = " mb-15" type="number" name="cout"/>
                                    <br>

                                    <label for="duree">Durée :</label>
                                    <input class = " mb-15" type="number" name="duree"/>
                                    <br>

                                    <label for="code_mc_pays">Pays :</label>
                                    <SELECT class = " mb-50" name = "code_mc_pays">
                                    <?php
                                    selectpays();
                                    ?>
                                    </SELECT>
                                    <br>
                                    <label for="image">Image :</label>
                                    <input class = " mb-15" type="file" name="image" >

                                    <br>
                                    <label for="description">Description : </label>
                                    <textarea class = " mb-15" type="text" cols="30" rows="5" name="description">
                                    </textarea>
                                    <br>
                                    <input class = "roberto-btn" type ="submit" value = "Creer"/>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <p></p>
                    </div>
                    </div>
                    <div class="hotel-reservation--area mb-100">
                    <div class="col-12 col-lg-4">
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
