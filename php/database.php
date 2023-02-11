<?php


  require_once('constants.php');

  //----------------------------------------------------------------------------
  //--- dbConnect --------------------------------------------------------------
  //----------------------------------------------------------------------------
  // Create the connection to the database.
  // \return False on error and the database otherwise.
  function dbConnect()
  {
    try
    {
      $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8',
        DB_USER, DB_PASSWORD);
    }
    catch (PDOException $exception)
    {
      error_log('Connection error: '.$exception->getMessage());
      return false;
    }
    return $db;
  }

  //----------------------------------------------------------------------------
  //--- dbRequestvoyages ---------------------------------------------------------
  //----------------------------------------------------------------------------
  // Function to get the voyages.
  // \param db The connected database.
  // \return The list of voyages titles.
  function dbRequestvoyages($db)
  {
    try
    {
      $request = 'select id_voyage, Libelle, description, duree, cout, code_mc_pays from voyage';
      $statement = $db->prepare($request);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
  }
  
  //----------------------------------------------------------------------------
  //--- dbRequestvoyage ----------------------------------------------------------
  //----------------------------------------------------------------------------
  // Function to get a specific voyage.
  // \param db The connected database.
  // \param id The id of the wanted voyage.
  // \return The voyage data.
   
  
  function dbRequestvoyage($db, $id)
  {
    try
    {
      $request = 'select id_voyage, Libelle, description, duree, cout, code_mc_pays from voyage
                  where id_voyage = :id';
      $statement = $db->prepare($request);
      $statement->bindParam(':id', $id, PDO::PARAM_INT);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
  }

  //----------------------------------------------------------------------------
  //--- dbRequestusers ---------------------------------------------------------
  //----------------------------------------------------------------------------
  // Function to get the users.
  // \param db The connected database.
  // \return The list of users titles.
  function dbRequestusers($db)
  {
    try
    {
      $request = 'select mail, mod_passe from utilisateur';
      $statement = $db->prepare($request);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception)
    {
      error_log('Request error: '.$exception->getMessage());
      return false;
    }
    return $result;
  }
?>
