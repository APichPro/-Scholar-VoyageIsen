<?php
class voyage {
  private $id_voyage;
  private $Libelle;
  private $code_mc_pays;
  private $description;
  private $duree;
  private $cout;

  public function getid_voyage(){
    return $this->id_voyage;
  }
  public function getLibelle(){
    return $this->Libelle;
  }
  public function getcode_mc_pays(){
    return $this->code_mc_pays;
  }
  public function getdescription(){
    return $this->description;
  }
  public function getduree(){
    return $this->duree;
  }
  public function getcout(){
    return $this->cout;
  }
};

class pays {
  private $code_mc_pays;
  private $nom_pays;

  public function getcode_mc_pays(){
    return $this->code_mc_pays;
  }
  public function getnom_pays(){
    return $this->nom_pays;
  }
};
function connexionbdd(){
  define('DB_USER', 'root'); // Renseigner ici l'utilisateur pour ce conecter a la BDD
  define('DB_PASSWORD', ''); // Renseigner ici le mot de pass de l'utilisateur
  define('DB_NAME', 'projetweb'); //Renseigner ici le nom de la BDD
  define('DB_SERVER', '127.0.0.1'); //Renseigner ici le serveur de connexion
  define('DB_PORT' , '3306'); // Renseigner ici le port de connexion

  try{
    return $bdd = new PDO('mysql:host='.DB_SERVER.';port='.DB_PORT.';dbname='.DB_NAME.';charset=utf8',DB_USER,DB_PASSWORD);
  }
  catch(PDOException $e){
    echo "erreur =" .$e->getMessage();
    exit;
  }
}
function nompays($code_pays , $bdd){
  $stmt = $bdd->query("SELECT * FROM pays WHERE code_mc_pays = '".$code_pays."'");
  $pays = $stmt->fetchall(PDO::FETCH_CLASS,'pays');
  return $pays[0]->getnom_pays();
}

function codemcpays($nom_pays , $bdd){
  $stmt = $bdd->query("SELECT * FROM pays WHERE nom_pays = '".$nom_pays."'");
  $pays = $stmt->fetchall(PDO::FETCH_CLASS,'pays');
  return $pays[0]->getcode_mc_pays();
}

function tailletable($requete , $bdd){
  $count = $bdd->query($requete);
  $nombre = $count->fetch();
  return $nombre[0];
}

function selectpays(){
  $bdd = connexionbdd();
  $stmt = $bdd->query("SELECT * FROM pays");
  $pays = $stmt->fetchall(PDO::FETCH_CLASS,'pays');
  echo '<option value = "" >Pays</option>';
  for($i = 0 ;  $i <= (tailletable("SELECT COUNT(*) FROM pays",$bdd)-1) ; $i++){
    echo '<option value = '.$pays[$i]->getnom_pays().' >'.$pays[$i]->getnom_pays().'</option>';
  }
}

class inscrit {
  private $id_voyage;
  private $date_debut;
  private $date_fin;
  private $validation;


  public function getid_voyage(){
    return $this->id_voyage;
  }
  public function getdate_debut(){
    return $this->date_debut;
  }
  public function getdate_fin(){
    return $this->date_fin;
  }
  public function getvalidation(){
    return $this->validation;
  }
  public function getmail(){
    return $this->mail;
  }
};

class utilisateur {
  private $nom;
  private $prenom;
  private $date_naissance;
  private $mail;
  private $mod_passe;


  public function getnom(){
    return $this->nom;
  }
  public function getmod_passe(){
    return $this->mod_passe;
  }
  public function getprenom(){
    return $this->prenom;
  }
  public function getdate_naissance(){
    return $this->validation;
  }
  public function getmail(){
    return $this->mail;
  }
};



  ?>
