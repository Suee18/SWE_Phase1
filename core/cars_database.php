<?php
class Database {
    private $host = '127.0.0.1'; 
    private $db_name = 'cars_database'; 
    private $username = 'root'; 
    private $password = ''; 
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Use PDO for database connection
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Connection error: " . $exception->getMessage());
        }

        return $this->conn;
    }
}

// Initialize the $db variable globally
$database = new Database();
$db = $database->getConnection();
?>
