<?php
include_once __DIR__ . '/../app/config/db_config.php';

class Post
{
    public $postID;
    public $userID;
    public $postText;
    public $postImage;
    public $postLikes;
    public $timestamp;

    public function __construct($postID, $userID, $postText, $postImage, $postLikes, $timestamp = null)
    {
        $this->postID = $postID;
        $this->userID = $userID;
        $this->postText = $postText;
        $this->postImage = $postImage;
        $this->postLikes = $postLikes;
        $this->timestamp = $timestamp;
    }
}


class PlatformModel
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function getAllPosts()
    {
        $query = "SELECT * FROM post";
        $result = $this->db->query($query);
        $posts = [];

        while ($row = $result->fetch_assoc()) {
            $posts[] = new Post(
                $row['postID'],
                $row['userID'],
                $row['postText'],
                $row['postImage'],
                $row['postLikes'],
                $row['Timestamp']
            );
        }
        return $posts;
    }

    public function addPost(Post $post)
    {
        $query = "INSERT INTO post (userID, postText, postImage, postLikes) VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isss', $post->userID, $post->postText, $post->postImage, $post->postLikes);
        $stmt->execute();
    }

    public function editPost(Post $post)
    {
        $query = "UPDATE post SET postText = ?, postImage = ? WHERE postID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $post->postText, $post->postImage, $post->postID);
        $stmt->execute();
    }

    public function deletePost($postID)
    {
        $query = "DELETE FROM post WHERE postID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
    }
}
