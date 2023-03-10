<?php

  require_once('database.php');

  // Database connection.
  $db = dbConnect();
  if (!$db)
  {
    header ('HTTP/1.1 503 Service Unavailable');
    exit;
  }

  // Check the request.
  $requestType = $_SERVER['REQUEST_METHOD'];
  $request = substr($_SERVER['PATH_INFO'], 1);
  $request = explode('/', $request);
  $requestRessource = array_shift($request);
  
  // Check the id associated to the request.
  $id = array_shift($request);
  if ($id == '')
    $id = NULL;
  $data = false;

  // Photos request.
  if ($requestRessource == 'voyage')
  {
    if ($id != NULL)
      $data = dbRequestvoyage($db, intval($id));
    else
      $data = dbRequestvoyages($db);
  }

  // User request 
  if ($requestRessource == 'user')
  {
    $data = dbRequestusers($db);
  }

  // Send data to the client.
  header('Content-Type: text/plain; charset=utf-8');
  header('Cache-control: no-store, no-cache, must-revalidate');
  header('Pragma: no-cache');
  header('HTTP/1.1 200 OK');
  echo json_encode($data);
  exit;
?>
