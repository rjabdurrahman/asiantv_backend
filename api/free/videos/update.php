<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/free/free_videos.php';
  include_once '../../../helpers/helper.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $post->id = $data->id;

  $post->title = base64_encode($data->title);
  $post->categories_id = $data->categories_id;

  if(!empty($data->thumbnail)){
    $post->thumbnail = base64_encode($data->thumbnail);
  }else{
    $post->thumbnail = base64_encode(youtubeVideoLinkToThumbnail($data->link));
  }

  $post->link = base64_encode($data->link);

  // Update post
  if($post->update()) {
    echo json_encode(
      array('message' => 'Post Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Updated')
    );
  }