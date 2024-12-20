<?php
include_once __DIR__ . '/../models/ReviewsClass.php';

interface ReviewStrategyInterface
{
    public function addReview($reviewData);
    public function deleteReview($reviewID);
}


class ReviewDatabaseStrategy implements ReviewStrategyInterface
{
    public function addReview($reviewData)
    {
        $review = new Reviews(
            $reviewData['reviewText'],
            $reviewData['reviewCategory'],
            $reviewData['reviewDate'],
            $reviewData['reviewRating'],
            $reviewData['userID']
        );
        return $review->addReviewIntoDB($review);
    }

    public function deleteReview($reviewID)
    {
        return Reviews::deleteReviewFromDB($reviewID);
    }
    public function getCategories()
    {
        return Reviews::getAllCategoriesFromDB();
    }
}


class ReviewController
{
    private $strategy;

    public function __construct(ReviewStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public static function getHighRatedReviews($rating = 3)
    {
        return Reviews::getReviewsByRating($rating);
    }

    public function addReview($reviewData)
    {
        return $this->strategy->addReview($reviewData);
    }

    public function deleteReview($reviewID)
    {
        return $this->strategy->deleteReview($reviewID);
    }

    public static function getAllCategories()
    {
        return Reviews::getAllCategoriesFromDB();
    }

    public static function getNumberOfReviews($numberOfReviews)
    {
        return Reviews::getLastNumberOfReviews($numberOfReviews);
    }
}
