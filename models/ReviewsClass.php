<?php
include_once 'C:\xampp\htdocs\SWE Project\SWE_Phase1\app\config\db_config.php';

class Reviews
{
    public $id;
    public $reviewText;  // Changed to camel case

    public $reviewDate;  // Changed to camel case

    public $reviewUserName;  // Changed to camel case

    function __construct($reviewText, $reviewDate, $reviewUserName)
    {
        $this->reviewText = $reviewText;  // Changed to camel case
        $this->reviewDate = $reviewDate;  // Changed to camel case
        $this->reviewUserName = $reviewUserName;  // Changed to camel case
    }

    function setId($id)  // Changed to camel case
    {
        $this->id = $id;
    }

    static function getAllReviews()  // Changed to camel case
    {
        global $conn;
        $sql = "SELECT * FROM reviews";
        $result = mysqli_query($conn, $sql);
        $reviews = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $review = new Reviews($row["reviewText"], $row["reviewDate"], $row["reviewUserName"]);  // Changed to camel case
                $review->id = $row["ID"];
                array_push($reviews, $review);
            }
        }
        return $reviews;
    }

    static function getLastNumberOfReviews($numberOFReviews) {
        global $conn;
        $sql = "SELECT * FROM reviews ORDER BY ID DESC LIMIT $numberOFReviews";
        $result = mysqli_query($conn, $sql);
        $reviews = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $review = new Reviews($row["reviewText"], $row["reviewDate"], $row["reviewUserName"]);  // Changed to camel case
                $review->id = $row["ID"];
                array_push($reviews, $review);
            }
        }
        return $reviews;
    }

    function addReviewIntoDB($review)
    {
        global $conn;
        $sql = "INSERT INTO reviews (reviewText, reviewDate, reviewUserName) VALUES ('$review->reviewText', '$review->reviewDate', '$review->reviewUserName')";  // Changed to camel case
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    static function deleteReviewFromDB($reviewId)  // Changed to camel case
    {
        global $conn;
        $sql = "DELETE FROM reviews WHERE id = '$reviewId'";  // Changed to camel case
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}
