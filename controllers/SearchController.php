<?php
require_once __DIR__ . '/../app/config/db_config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'searchDropList':
            if (isset($_POST['searchTerm'])) {
                $searchTerm = $_POST['searchTerm'];
                echo json_encode(searchDropList($searchTerm));
            }
            break;
    }
}

function searchDropList($searchTerm) {
    global $conn;

    $searchTerm = "%" . strtolower($searchTerm) . "%"; // Add wildcards

    $sql = "SELECT make, model, year
    FROM cars 
    WHERE LOWER(make) LIKE '$searchTerm' 
    OR LOWER(model) LIKE '$searchTerm' 
    OR LOWER(description) LIKE '$searchTerm' 
    OR LOWER(type) LIKE '$searchTerm' 
    OR LOWER(Engine) LIKE '$searchTerm'
    OR year LIKE '$searchTerm'";

    $result = $conn->query($sql);

    $cars = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cars[] = [
                'make' => $row['make'],
                'model' => $row['model'],
                'year' => $row['year']
            ];
        }
    }

    return $cars;
}