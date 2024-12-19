<?php
include_once __DIR__ . '/../models/PlatformClass.php';


class PostController
{
    public static function getAllPosts()
    {
        return Posts::getPosts();
    }

    public static function getPost($postID)
    {
        return Posts::getPostById($postID);
    }

    public static function addPost($postText, $postImage, $userID)
    {
        return Posts::createPost($postText, $postImage, $userID);
    }

    public static function editPost($postID, $postText, $postImage)
    {
        return Posts::updatePost($postID, $postText, $postImage);
    }

    public static function removePost($postID)
    {
        return Posts::deletePost($postID);
    }
}
?>


?>