<?php
require_once __DIR__ . '/../app/config/db_config.php';

class PersonasModel {
    // Database connection
    private $conn;

    // Table name
    private $table = "persona";

    // Column names
    private $personaID = "personaID";
    private $personaName = "personaName";
    private $personaIcon = "personaIcon";
    private $personaCounter = "personaCounter";
    private $personaDescription = "personaDescription";

    // Constructor with DB connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to get all personas, ordered by personaName ascending
    public function getPersonas() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY " . $this->personaName . " ASC";
        $result = $this->conn->query($query);

        if ($result === false) {
            error_log("Error executing query: " . $this->conn->error);
            return false;
        }

        return $result;
    }

    public function getAllPersonasAsArray() {
        $personasArray = array(); // Initialize the array
        
        $query = "SELECT * FROM " . $this->table . " ORDER BY " . $this->personaName . " ASC";
        $result = $this->conn->query($query);
    
        $logFile = __DIR__ . '/debug_log.txt'; // Path to the log file
    
        if ($result === false) {
            $errorMessage = "Error executing query: " . $this->conn->error . PHP_EOL;
            file_put_contents($logFile, $errorMessage, FILE_APPEND); // Log the error message
            return false;
        }
    
        // Loop through the result and store each persona in the array
        while ($row = $result->fetch_assoc()) {
            // Write the entire row to the log file for debugging
            $logMessage = "Persona: " . print_r($row, true) . PHP_EOL;
            file_put_contents($logFile, $logMessage, FILE_APPEND);
            
            // Push each persona as an associative array
            $personasArray[] = $row;
        }
    
        return $personasArray;
    }



    public function incrementPersonaCounter($personaName)
    {
        // Ensure that the connection is not null
        if ($this->conn === null) {
            throw new Exception("Database connection is not initialized.");
        }
    
        $query = "UPDATE " . $this->table . " SET " . $this->personaCounter . " = " . $this->personaCounter . " + 1 WHERE " . $this->personaName . " = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }
    
        // Bind the parameter
        $stmt->bind_param('s', $personaName);
    
        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error executing query: " . $stmt->error);
            return false;
        }
    }


    // Method to delete a persona
    public function deletePersona($personaID) {
        $query = "DELETE FROM " . $this->table . " WHERE " . $this->personaID . " = ?";

        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }

        // Bind the parameter
        $stmt->bind_param('i', $personaID);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error executing query: " . $stmt->error);
            return false;
        }
    }
}
?>
