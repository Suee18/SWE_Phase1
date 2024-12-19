<?php
include_once __DIR__ . '/../app/config/db_config.php';

class Reviews
{
    public $reviewID;     // Renamed from id to reviewID
    public $reviewText;   // Still reviewText
    public $reviewCategory;  // New field
    public $reviewDate;   // Still reviewDate
    public $reviewRating;  // New field
    public $userID;       // New field (foreign key to user table)

    // Constructor now includes reviewCategory, reviewRating, and userID
    function __construct($reviewText, $reviewCategory, $reviewDate, $reviewRating, $userID)
    {
        $this->reviewText = $reviewText;
        $this->reviewCategory = $reviewCategory;
        $this->reviewDate = $reviewDate;
        $this->reviewRating = $reviewRating;
        $this->userID = $userID;
    }

    // Set the reviewID property
    function setReviewID($reviewID)
    {
        $this->reviewID = $reviewID;
    }

    // Get all reviews
    static function getAllReviews()
    {
        global $conn;
        $sql = "SELECT * FROM reviews";
        $result = mysqli_query($conn, $sql);
        $reviews = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Adjust to include new fields from the new DB schema
                $review = new Reviews(
                    $row["reviewText"],
                    $row["reviewCategory"],
                    $row["reviewDate"],
                    $row["reviewRating"],
                    $row["userID"]
                );
                $review->reviewID = $row["reviewID"];  // Renamed field from ID to reviewID
                array_push($reviews, $review);
            }
        }
        return $reviews;
    }

    // Get last n reviews
    static function getLastNumberOfReviews($numberOfReviews)
    {
        global $conn;
        $sql = "SELECT * FROM reviews ORDER BY reviewID DESC LIMIT $numberOfReviews";  // Adjusted for new field names
        $result = mysqli_query($conn, $sql);
        $reviews = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $review = new Reviews(
                    $row["reviewText"],
                    $row["reviewCategory"],
                    $row["reviewDate"],
                    $row["reviewRating"],
                    $row["userID"]
                );
                $review->reviewID = $row["reviewID"];
                array_push($reviews, $review);
            }
        }
        return $reviews;
    }

    //Get reviews 3 and above
    static function getReviewsByRating($rating)
    {
        global $conn;
        $sql = "
        SELECT reviewID, reviewText, reviewCategory, reviewDate, reviewRating, userID
        FROM reviews
        WHERE reviewRating >= ?
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $rating);
        $stmt->execute();
        $result = $stmt->get_result();

        $reviews = [];
        while ($row = $result->fetch_assoc()) {
            $review = new Reviews(
                $row['reviewText'],
                $row['reviewCategory'],
                $row['reviewDate'],
                $row['reviewRating'],
                $row['userID']
            );
            $review->reviewID = $row['reviewID'];
            $reviews[] = $review;
        }

        return $reviews;
    }


    // Add a review to the database
    public function addReviewIntoDB($review)
    {
        global $conn;

        $sql = "INSERT INTO reviews (reviewText, reviewCategory, reviewDate, reviewRating, userID) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssi', $review->reviewText, $review->reviewCategory, $review->reviewDate, $review->reviewRating, $review->userID);

        if (!$stmt->execute()) {
            die('Error executing query: ' . $stmt->error);
        }

        return true;
    }

    // Delete a review from the database
    static function deleteReviewFromDB($reviewID)
    {
        global $conn;
        // Adjusted for new field names
        $sql = "DELETE FROM reviews WHERE reviewID = '$reviewID'";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    // Retrieve all unique review categories
    public static function getAllCategoriesFromDB()
    {
        global $conn;
        $sql = "SELECT reviewCategory, COUNT(*) as count FROM reviews GROUP BY reviewCategory";
        $result = mysqli_query($conn, $sql);
    
        $categories = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = [
                    'category' => $row['reviewCategory'],
                    'count' => $row['count']
                ];
            }
        }
    
        return $categories;
    }
    
}
