<?php
include_once __DIR__ . '/../app/config/db_config.php';

class Posts
{
    public $postID;
    public $postText;
    public $postImage;
    public $postLikes;
    public $userID;

    function __construct($postText, $postImage, $postLikes, $userID)
    {
        $this->postText = $postText;
        $this->postImage = $postImage;
        $this->postLikes = $postLikes;
        $this->userID = $userID;
    }

    function setPostID($postID)
    {
        $this->postID = $postID;
    }

    static function getPosts()
    {
        global $conn;
        $sql = "SELECT * FROM post";
        $result = mysqli_query($conn, $sql);
        $posts = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $post = new Posts(
                    $row["postText"],
                    $row["postImage"],
                    $row["postLikes"],
                    $row["userID"]
                );
                $post->postID = $row["postID"];
                array_push($posts, $post);
            }
        }
        return $posts;
    }

    static function getPostById($postID)
    {
        global $conn;
        $sql = "SELECT * FROM post WHERE postID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $post = new Posts(
                $row["postText"],
                $row["postImage"],
                $row["postLikes"],
                $row["userID"]
            );
            $post->postID = $row["postID"];
            return $post;
        }
        return null;
    }

    static function createPost($postText, $postImage, $userID)
    {
        global $conn;
        $sql = "INSERT INTO post (postText, postImage, postLikes, userID) VALUES (?, ?, 0, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $postText, $postImage, $userID);
        return $stmt->execute();
    }

    static function updatePost($postID, $postText, $postImage)
    {
        global $conn;
        $sql = "UPDATE post SET postText = ?, postImage = ? WHERE postID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $postText, $postImage, $postID);
        return $stmt->execute();
    }

    static function deletePost($postID)
    {
        global $conn;
        $sql = "DELETE FROM post WHERE postID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postID);
        return $stmt->execute();
    }
}