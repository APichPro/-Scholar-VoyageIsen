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
                <a href="#"><span>Espace de Modération</span></i></a>
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
            <h2 class="page-title">Tous Les Voyages</h2>
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

          include 'php/class.php';
          $bdd = connexionbdd();

          if (empty($_POST['libelle']) && empty($_POST['pays']) && empty($_POST['max'])){




            $stmt = $bdd->query('SELECT * FROM voyage');
            $voyage = $stmt->fetchall(PDO::FETCH_CLASS,'voyage');

            $nombre_voyage = tailletable('SELECT COUNT(*) FROM voyage' , $bdd);




          }else if (!empty($_POST["libelle"]) && ($_POST['pays'] != '' )){

            $codepays = codemcpays($_POST['pays'],$bdd);
            $libelle = $_POST['libelle'];
            $cout = $_POST['max'];

            $stmt = $bdd->query("SELECT * FROM voyage WHERE code_mc_pays = '$codepays' AND Libelle= '$libelle'");
            $voyage = $stmt->fetchall(PDO::FETCH_CLASS,'voyage');

            $nombre_voyage = tailletable("SELECT COUNT(*) FROM voyage  WHERE  code_mc_pays = '$codepays' AND Libelle = '$libelle' " , $bdd);



          }else if ($_POST['pays'] != '' && !empty($_POST['max'])){


            $codepays = codemcpays($_POST['pays'],$bdd);
            $cout = $_POST['max'];

            $stmt = $bdd->query("SELECT * FROM voyage WHERE code_mc_pays = '$codepays' AND cout <= '$cout' ");
            $voyage = $stmt->fetchall(PDO::FETCH_CLASS,'voyage');

            $nombre_voyage = tailletable("SELECT COUNT(*) FROM voyage  WHERE  code_mc_pays = '$codepays' AND cout <= '$cout' " , $bdd);


          }else if ($_POST['libelle'] != '' && !empty($_POST['max'])){


            $libelle = $_POST['libelle'];
            $cout = $_POST['max'];

            $stmt = $bdd->query("SELECT * FROM voyage WHERE Libelle = '$libelle' AND cout <= '$cout' ");
            $voyage = $stmt->fetchall(PDO::FETCH_CLASS,'voyage');

            $nombre_voyage = tailletable("SELECT COUNT(*) FROM voyage  WHERE  Libelle = '$libelle' AND cout <= '$cout' " , $bdd);



          }else if (!empty($_POST['libelle'])){





            $libelle = $_POST['libelle'];

            $stmt = $bdd->query("SELECT * FROM voyage WHERE Libelle= '$libelle' ");
            $voyage = $stmt->fetchall(PDO::FETCH_CLASS,'voyage');

            $nombre_voyage = tailletable("SELECT COUNT(*) FROM voyage WHERE Libelle= '$libelle' " , $bdd);





          }else if (!empty($_POST['pays'])){





            $codepays = codemcpays($_POST['pays'],$bdd);

            $stmt = $bdd->query("SELECT * FROM voyage WHERE code_mc_pays = '$codepays'");
            $voyage = $stmt->fetchall(PDO::FETCH_CLASS,'voyage');

            $nombre_voyage = tailletable("SELECT COUNT(*) FROM voyage WHERE code_mc_pays = '$codepays'" , $bdd);





          }else if (!empty($_POST['max'])) {




            $cout = $_POST['max'];

            $stmt = $bdd->query("SELECT * FROM voyage WHERE cout <= '$cout'");
            $voyage = $stmt->fetchall(PDO::FETCH_CLASS,'voyage');

            $nombre_voyage = tailletable("SELECT COUNT(*) FROM voyage WHERE cout <= '$cout'" , $bdd);
          }


          if ($nombre_voyage[0] == 0) {

            echo "Pas de voyage";
          }





          for($i = 0 ;  $i <= ($nombre_voyage[0])-1 ; $i++){ //boucle d'affichage des voyages sur la page
            echo '<div class="single-room-area d-flex align-items-center mb-100">
            <!-- Room Thumbnail -->
            <div class="room-thumbnail">
            <img src="img/bg-img/'.$voyage[$i]->getid_voyage().'.jpg" alt="">
            </div>
            <!-- Room Content -->
            <div class="room-content">
            <h2>'.$voyage[$i]->getcode_mc_pays() .'</h2>
            <h4>'.$voyage[$i]->getcout() .'<span> €</span></h4>
            <div class="room-feature">
            <h6>Pays: <span>'.nompays($voyage[$i]->getcode_mc_pays() , $bdd) .'</span></h6>
            <h6></h6>
            <h6>Durée: <span>'.$voyage[$i]->getduree().' jours</span></h6>
            </div>
            <a href="infovoyage_moderateur.php?id='.$voyage[$i]->getid_voyage().'" class="btn view-detail-btn">Voir plus <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            </div>
            </div>';
          }
          ?>  
        </div>

        <div class="col-12 col-lg-4">
          <div class="hotel-reservation--area mb-100">
            <form action="voyage_moderateur.php" method="post">
              <div class="form-group mb-30">

      </div>
    </div>
    <div class="form-group mb-30">
      <label for="guests">Pays</label>
      <div class="row">
        <div class="col-6">
          <select name="pays" id="guests" class="form-control">
            <?php selectpays(); ?>
          </select>
        </div>
        <div class="col-6">
          <input type="text" class="input-small form-control" name="libelle" placeholder="Voyage">
        </div>
      </div>
    </div>
    <div class="form-group mb-50">

      <div class="slidecontainer">
        <input type="range" min="0" max="10000" value="10000" name = "max" class="slider2" id="myRange2">
        <p>Cout Max: <span id="max"></span></p>
      </div>
        <script>
        var slider2 = document.getElementById("myRange2");
        var output = document.getElementById("max");
        output.innerHTML = slider2.value;

        slider2.oninput = function() {
          output.innerHTML = this.value;
        }
        </script>

    </div>
    <div class="form-group">
      <button type="submit" class="btn roberto-btn w-100">Chercher un Voyage</button>
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
