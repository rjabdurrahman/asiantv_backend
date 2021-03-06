<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if (!empty(isset($_GET['cname'])) && isset($_GET['cname']))
{

    if (!empty(isset($_GET['total'])) && isset($_GET['total']))
    {

        include_once '../../../config/Database.php';
        include_once '../../../models/free/free_videos.php';

        // Instantiate DB & connect
        $database = new Database();
        $db = $database->connect();

        // Instantiate blog post object
        $post = new Post($db);

        // Blog post query
        $result = $post->read_recent($_GET['cname'], $_GET['total']);
        // Get row count
        $num = $result->rowCount();

        // Check if any posts
        if ($num > 0)
        {
            // Post array
            $posts_arr = array();
            // $posts_arr['data'] = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);

                $post_item = array(
                    'id' => $id,
                    'title' => $title,
                    'categories_id' => $categories_id,
                    'thumbnail' => $thumbnail,
                    'link' => $link,
                    'length' => $length,
                    'likes' => $likes,
                    'createdAt' => $createdAt
                );

                // Push to "data"
                array_push($posts_arr, $post_item);
                // array_push($posts_arr['data'], $post_item);
                
            }

            // Turn to JSON & output
            echo json_encode($posts_arr);

        }
        else
        {
            // No Posts
            echo json_encode(array(
                'message' => 'No Posts Found'
            ));
        }
    }
    else
    {
        echo json_encode(array(
            'message' => 'How many result you want?'
        ));
    }

}
else
{
    echo json_encode(array(
        'message' => 'Give me category name'
    ));
}

