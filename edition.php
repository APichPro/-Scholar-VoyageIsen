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
<script type="text/javascript"> window.print() ; </script>
<?php
include 'php/class.php';
$bdd = connexionbdd();
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
                    <h2 class="room-price">'.$voyage[0]->getcout().'<span>/ Par jour</span></h2>
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
                                    <img src="img/bg-img/'.$voyage[0]->getid_voyage().'" class="d-block w-100" alt="">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Room Features -->
                    <div class="room-features-area d-flex flex-wrap mb-50">
                        <h6>Durée: <span>'.$voyage[0]->getduree().'</span></h6>
                        <h6>Pays: <span>'.$voyage[0]->getcode_mc_pays().'</span></h6>
                    </div>
                    <p>'.$voyage[0]->getdescription().'</p>

                </div>';
                ?>
                </div>
                <div class="hotel-reservation--area mb-100">
                <div class="col-12 col-lg-4">
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>
