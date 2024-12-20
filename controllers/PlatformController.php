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
}
