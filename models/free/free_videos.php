<?php 
  class Post {
    // DB stuff
    private $conn;
    private $table = 'free_videos';

    // Post Properties
    public $id;
    public $title;
    public $categories_id;
    public $thumbnail;
    public $link;
    public $createdAt;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT *  FROM ' . $this->table . ' ORDER BY createdAt DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
  public function read_single() {
    // Create query
    $query = 'SELECT * FROM '. $this->table .' WHERE id = ?';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // // Bind ID
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set properties
    $this->title = $row['title'];
    $this->categories_id = $row['categories_id'];
    $this->thumbnail = $row['thumbnail'];
    $this->link = $row['link'];
    $this->createdAt = $row['createdAt'];
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET title = :title, categories_id = :categories_id, thumbnail = :thumbnail, link = :link';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->categories_id = htmlspecialchars(strip_tags($this->categories_id));
          $this->thumbnail = htmlspecialchars(strip_tags($this->thumbnail));
          $this->link = htmlspecialchars(strip_tags($this->link));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':categories_id', $this->categories_id);
          $stmt->bindParam(':thumbnail', $this->thumbnail);
          $stmt->bindParam(':link', $this->link);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET title = :title, categories_id = :categories_id, thumbnail = :thumbnail, link = :link
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->categories_id = htmlspecialchars(strip_tags($this->categories_id));
          $this->thumbnail = htmlspecialchars(strip_tags($this->thumbnail));
          $this->link = htmlspecialchars(strip_tags($this->link));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':categories_id', $this->categories_id);
          $stmt->bindParam(':thumbnail', $this->thumbnail);
          $stmt->bindParam(':link', $this->link);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM  free_videos WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          // $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }