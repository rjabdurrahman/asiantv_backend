<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../../config/Database.php';
  include_once '../../../models/free/free_videos.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get ID
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $post->read_single();

  // Create array
  $post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'categories_id' => $post->categories_id,
    'thumbnail' => $post->thumbnail,
    'link' => $post->link,
    'length' => $post->length,
    'likes' => $post->likes,
    'createdAt' => $post->createdAt
  );

  // Make JSON
  print_r(json_encode($post_arr));