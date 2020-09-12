<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/tv/livetv.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $tv = new LiveTV($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $tv->id = 1;

  $tv->url = base64_encode($data->url);
 

  // Update post
  if($tv->update()) {
    echo json_encode(
      array('message' => 'Live TV Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Live TV Not Updated')
    );
  }