<?php
include_once __DIR__ . '/../models/PlatformClass.php';


class PlatformController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new PlatformModel($db);
    }

    public function fetchPosts()
    {
        return $this->model->getAllPosts();
    }

    public function createPost($userID, $postText, $postImage)
    {
        $post = new Post(null, $userID, $postText, $postImage, 0, null);
        $this->model->addPost($post);
    }

    public function updatePost($postID, $postText, $postImage)
    {
        $post = new Post($postID, null, $postText, $postImage, null, null);
        $this->model->editPost($post);
    }

    public function removePost($postID)
    {
        $this->model->deletePost($postID);
    }

    public function fetchComments($postID)
    {
        return $this->model->getCommentsForPost($postID);
    }

    public function fetchPostByID($postID)
    {
        return $this->model->getPostByID($postID);
    }

    public function addComment($postID, $userID, $commentText)
    {
        $this->model->insertComment($postID, $userID, $commentText);
    }

    public function likePost($postID, $userID)
    {
        $this->model->insertLike($postID, $userID);
    }

    public function removeLike($postID, $userID)
    {
        $this->model->deleteLike($postID, $userID);
    }

    public function checkIfLiked($postID, $userID)
    {
        return $this->model->checkIfLiked($postID, $userID);
    }

    public function getLikesCount($postID)
    {
        return $this->model->getLikesCount($postID);
    }
}
