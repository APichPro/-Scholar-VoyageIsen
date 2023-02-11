<?php
include 'php/class.php';
$bdd = connexionbdd();

$id_voyage = $_GET["id"];

$stmt = $bdd->query("SELECT * FROM voyage WHERE id_voyage = '$id_voyage'");
$voyage_modif = $stmt->fetchall(PDO::FETCH_CLASS,'voyage');

$voyagetest = tailletable("SELECT COUNT(*) FROM voyage WHERE id_voyage = '$id_voyage'" , $bdd);

if(!empty($_FILES['image'])){
  if($_FILES['image']['error'] != 4)
  {
    $dossier = 'img/bg-img/';
    $fichier = basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier);
    unlink ('img/bg-img/'.$_GET['id'].'.jpg');
    rename('img/bg-img/'.$fichier.'', 'img/bg-img/'.$_GET['id'].'.jpg');
  }
}
$res = $bdd->prepare("UPDATE voyage SET Libelle = :Libelle , cout = :cout , duree = :duree , code_mc_pays = :code_mc_pays , description = :description WHERE id_voyage = '$id_voyage' ");


if(!empty($_POST['Libelle'])){

  $res->bindValue(':Libelle',  $_POST["Libelle"],    PDO::PARAM_STR);
}else{

  $res->bindValue(':Libelle',   $voyage_modif[0]->getLibelle(),    PDO::PARAM_STR);
}
if(!empty($_POST['code_mc_pays'])){

  $res->bindValue(':code_mc_pays', codemcpays($_POST['code_mc_pays'], $bdd),    PDO::PARAM_STR);
}else{

  $res->bindValue(':code_mc_pays', $voyage_modif[0]->getcode_mc_pays(),    PDO::PARAM_STR);
}
if(!empty($_POST['description'])){

  $res->bindValue(':description',  $_POST['description'],    PDO::PARAM_STR);
}else{

  $res->bindValue(':description',   $voyage_modif[0]->getdescription(),    PDO::PARAM_STR);
}
if(!empty($_POST['duree'])){

  if($_POST["duree"] >= 0){

    $res->bindValue(':duree',  $_POST["duree"],    PDO::PARAM_STR);

  }else{
    echo 'erreur';
    $res->bindValue(':duree',   $voyage_modif[0]->getduree(),    PDO::PARAM_STR);
  }

}else{

  $res->bindValue(':duree',   $voyage_modif[0]->getduree(),    PDO::PARAM_STR);
}

if(!empty($_POST['cout'])){

  if ($_POST["cout"] >= 0) {

    $res->bindValue(':cout',  $_POST["cout"],    PDO::PARAM_STR);

  }else{
    echo 'erreur';
    $res->bindValue(':cout',   $voyage_modif[0]->getcout(),    PDO::PARAM_STR);
  }

}else{

  $res->bindValue(':cout',   $voyage_modif[0]->getcout(),    PDO::PARAM_STR);
}

//execution de la requete

if($res->execute()){
}
else {
}
?>
<html lang="en">

<head>
  <?php function edition() {
    $options = "Width=700,Height=700" ;
    $window.open( "edition.php", "edition", options ) ; } ?>
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
          <form action="index.html" method="get">
            <input type="search" name="search-form-input" id="searchFormInput" placeholder="Type your keyword ...">
            <button type="submit"><i class="icon_search"></i></button>
          </form>
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

    <?php
    $id = $_GET['id'];
    $stmt = $bdd->query("SELECT * FROM voyage WHERE id_voyage = '$id'");
    $voyage = $stmt->fetchall(PDO::FETCH_CLASS,'voyage');
    echo '
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/admin.jpg);">
    <div class="container h-100">
    <div class="row h-100 align-items-end">
    <div class="col-12">
    <div class="breadcrumb-content d-flex align-items-center justify-content-between pb-5">
    <h2 class="room-title">'.$voyage[0]->getLibelle().'</h2>
    <h2 class="room-price">'.$voyage[0]->getcout().'<span> €</span></h2>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Rooms Area Start -->
    <div class="roberto-rooms-area section-padding-100-0">
    <div class="container">
    <div class="row">
    <div class="col-12 col-lg-8">
    <!-- Single Room Details Area -->

    <div class="single-room-details-area mb-50">
    <!-- Room Thumbnail Slides -->
    <div class="room-thumbnail-slides mb-50">
    <div id="room-thumbnail--slide" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
    <div class="carousel-item active">
    <img src="img/bg-img/'.$voyage[0]->getid_voyage().'.jpg" class="d-block w-100" alt="">
    </div>
    </div>

    </div>
    </div>

    <div class="room-features-area d-flex flex-wrap mb-50">
    <h6>Durée: <span>'.$voyage[0]->getduree().'</span></h6>
    <h6>Pays: <span>'.nompays($voyage[0]->getcode_mc_pays() , $bdd).'</span></h6>
    </div>
    <div class="container row">
    <div  style = " word-wrap: break-word; " class="col-12 col-lg-8">'.$voyage[0]->getdescription().' </div>
    </div>'
    ;

    ?>
  </div>
</div>
<div class="hotel-reservation--area mb-100">
  <div class="col-12 col-lg-4">
    <div class="form-group mb-30">
    <?php
    echo '<form enctype="multipart/form-data" action="modificationvoyage.php?id='.$voyage[0]->getid_voyage().'" method="post">';
    ?>
    <label for="Libelle">Libelle : </label>
    <input class = " mb-15" type="text" name="Libelle"/>
    <br>
    <label for="description">Description: </label>
    <textarea class = " mb-15" type="text" cols="30" rows="5" name="description">
    </textarea>
    <br>
    <label for="cout">Cout: </label>
    <input class = " mb-15" type="number" name="cout"/>
    <br>

    <label for="image">Image:</label>
    <input class = " mb-15" type="file" name="image" >
    <br>

    <label for="duree">Durée:</label>
    <input class = " mb-15" type="number" name="duree"/>
    <br>

    <label for="code_mc_pays">Pays:</label>
    <SELECT class = " mb-15" name = "code_mc_pays">
      <?php selectpays(); ?>
    </SELECT>
    <br>

    <input type ="submit" class="btn roberto-btn w-100 " value = "Modifier"/>
  </p>
</form>
</div>

</div>
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
