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