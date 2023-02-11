<?php
session_start();
if(isset($_POST['mail']) && isset($_POST['mod_passe']))
{
    include 'class.php';

    $db = connexionbdd();
    
    $mail = $_POST['mail'];
    $password = $_POST['mod_passe'];

    $test = $db->query("SELECT COUNT(*) FROM utilisateur WHERE mail = '$mail' and mod_passe = '$password'");
    $utilisateurtest = $test->fetch();

    if($mail !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateur where 
              mail = '".$mail."' and mod_passe = '".$password."' ";


          $stmt = $db->query("SELECT * FROM utilisateur WHERE mail = '$mail'");
          $utilisateur = $stmt->fetchall(PDO::FETCH_CLASS,'user');



        if($utilisateurtest!=0) // mail et mot de passe correctes
        {
            
            $_SESSION["nom"] = $utilisateur[0]->getnom();
            $_SESSION["prenom"] = $utilisateur[0]->getprenom();
           $_SESSION['mail'] = $mail;
           header('Location: ../index.html');
        }
        else
        {
           header('Location: mail.php?erreur=1'); // mail ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: mail.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: mail.php');
}
?>

<html>
<head>
    <meta charset="utf-8">
    <title>VoyageIsen</title>
    <link rel="shortcut icon" href="../img/core-img/plane.ico">
    <link rel="stylesheet" href="../style.css">>
</head>
<body>
    <header class="header-area">
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
                            <!-- Top Social Area -->
                            <div class="top-social-area ml-auto">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <section class="welcome-area">>
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-12">
                                <div class="welcome-text text-center">
                                <div id="container">                                        
                                        <form action="verification.php" method="POST">
                                            <h1>Connexion</h1>
                                            
                                            <label><b>Email</b></label>
                                            <input type="text" placeholder="Entrez votre adresse email" name="mail" required>

                                            <label><b>Mot de passe</b></label>
                                            <input type="password" placeholder="Entrer le mot de passe" name="mod_passe" required>

                                            <input type="submit" id='submit' value='LOGIN' >
                                            <?php
                                            if(isset($_GET['erreur'])){
                                                $err = $_GET['erreur'];
                                                if($err==1 || $err==2)
                                                    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                                            }
                                            ?>
                                        </form>
                                </div>


                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </header>

    <footer class="footer-area section-padding-80-0">
        <div class="main-footer-area">
            <div class="container">
                <div class="row align-items-baseline justify-content-between">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-80">
                            <span>info.isenvoyage@gmail.com</span>
                            <span>07 91 25 34 82</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-lg-4">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Abonner vous</h5>
                            <span>Vous abonner vous permettra de ne pas rater les bon plan disponible sur le site</span>

                            <!-- Newsletter Form -->
                            <form action="index.html" class="nl-form">
                                <input type="email" class="form-control" placeholder="Enter your email...">
                                <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </form>
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
                          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                          Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tous droit reservée | Merci  
                          </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <!-- Social Info -->
                        <div class="social-info">
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>