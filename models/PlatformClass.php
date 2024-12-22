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

    public $username;

    public function __construct($postID, $userID, $postText, $postImage, $postLikes, $timestamp = null, $username = null)
    {
        $this->postID = $postID;
        $this->userID = $userID;
        $this->postText = $postText;
        $this->postImage = $postImage;
        $this->postLikes = $postLikes;
        $this->timestamp = $timestamp;
        $this->username = $username;
    }
}

class Comments
{
    public $commentID;
    public $postID;
    public $userID;
    public $commentText;
    public $username;

    public function __construct($commentID, $postID, $userID, $commentText, $username = null)
    {
        $this->commentID = $commentID;
        $this->postID = $postID;
        $this->userID = $userID;
        $this->commentText = $commentText;
        $this->username = $username;
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
        $query = "
            SELECT p.postID, p.userID, p.postText, p.postImage, p.postLikes, p.timestamp, u.username
            FROM post p
            LEFT JOIN user u ON p.userID = u.ID
            ORDER BY p.timestamp DESC
        ";
        $result = $this->db->query($query);
        $posts = [];

        while ($row = $result->fetch_assoc()) {
            $posts[] = new Post(
                $row['postID'],
                $row['userID'],
                $row['postText'],
                $row['postImage'],
                $row['postLikes'],
                $row['timestamp'],
                $row['username']
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

        if ($stmt) {
            $stmt->bind_param('i', $postID);
            if ($stmt->execute()) {
                echo "Post deleted successfully";
                exit();
            } else {
                echo "Error deleting post: " . $stmt->error;
                exit();
            }
        } else {
            echo "Error preparing statement: " . $this->db->error;
            exit();
        }
    }


    public function getCommentsForPost($postID)
    {
        $query = "
        SELECT c.commentText, c.userID, u.username
        FROM comments c
        JOIN user u ON c.userID = u.ID
        WHERE c.postID = ?
    ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }

        return $comments;
    }

    public function insertComment($postID, $userID, $commentText)
    {
        $query = "INSERT INTO comments (postID, userID, commentText) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iis", $postID, $userID, $commentText);
        $stmt->execute();
    }

    public function getPostByID($postID)
    {
        $query = "
            SELECT p.postID, p.userID, p.postText, p.postImage, p.postLikes, p.timestamp, u.username
            FROM post p
            LEFT JOIN user u ON p.userID = u.ID
            WHERE p.postID = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $postID);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return new Post(
                $row['postID'],
                $row['userID'],
                $row['postText'],
                $row['postImage'],
                $row['postLikes'],
                $row['timestamp'],
                $row['username']
            );
        } else {
            return null;
        }
    }

    public function getUserPosts($userID)
    {
        $query = "
            SELECT p.postID, p.userID, p.postText, p.postLikes, p.timestamp, u.username
            FROM post p
            LEFT JOIN user u ON p.userID = u.ID
            WHERE p.userID = ?  -- Filter posts by user ID
            ORDER BY p.timestamp DESC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userID);
        $stmt->execute();

        $posts = [];
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $posts[] = new Post(
                $row['postID'],
                $row['userID'],
                $row['postText'],
                null,
                $row['postLikes'],
                $row['timestamp'],
                $row['username']
            );
        }

        return $posts;
    }

    public function insertLike($postID, $userID)
    {
        $query = "INSERT INTO likes (postID, userID) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $postID, $userID);
        $stmt->execute();
    }

    public function deleteLike($postID, $userID)
    {
        $query = "DELETE FROM likes WHERE postID = ? AND userID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $postID, $userID);
        $stmt->execute();
    }

    public function checkIfLiked($postID, $userID)
    {
        $query = "SELECT * FROM likes WHERE postID = ? AND userID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $postID, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function getLikesCount($postID)
    {
        $query = "SELECT COUNT(*) AS likesCount FROM likes WHERE postID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $postID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['likesCount'];
    }
}
