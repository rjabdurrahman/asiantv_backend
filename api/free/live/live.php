<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../../config/Database.php';
  include_once '../../../models/tv/livetv.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $tv = new LiveTV($db);

  // Blog post query
  $result = $tv->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $tv_arr = array();
    // $tv_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $tv_item = array(
        'id' => $id,
        'url' => $url,
        'published_at' => $published_at
      );

      // Push to "data"
      array_push($tv_arr, $tv_item);
      // array_push($tv_arr['data'], $tv_item);
    }

    // Turn to JSON & output
    echo json_encode($tv_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }