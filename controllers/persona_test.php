<?php
require_once __DIR__ . '/../app/config/db_config.php';
require_once __DIR__ . '/../models/PersonasModel.php';
require_once __DIR__ . '/../models/CarsModel.php';
require_once __DIR__ . '../SessionManager.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/UsersClass.php';


class PersonasController
{
    public $questions;
    public $personas;
    private $carsModel;
    private $personasModel; // Composition instead of inheritance

    public function __construct($conn)
    {
        $this->carsModel = new CarsModel($conn);       // Instantiate CarsModel
        $this->personasModel = new PersonasModel($conn); // Instantiate PersonasModel
        $this->initializePersonas();
        $this->initializeQuestions();
    }

    // Initialize personas dynamically from the database
    public function initializePersonas()
    {
        $personasFromDb = $this->personasModel->getAllPersonasAsArray();

        $this->personas = [];
        if ($personasFromDb !== false) {
            foreach ($personasFromDb as $persona) {
                $this->personas[$persona['personaName']] = [
                    'name' => $persona['personaName'],
                    'id' => $persona['personaID'],
                    'icon' => $persona['personaIcon'],
                    'description' => $persona['personaDescription'],
                    'weight' => 0 // Initialize the weight to 0
                ];
            }
        } else {
            throw new Exception("Error fetching personas from the database.");
        }
    }
    // Initialize the questions
    public function initializeQuestions()
    {
        $this->questions = [
            1 => [
                'question' => 'What is your primary use for a car?',
                'answers' => [
                    'A' => [
                        'text' => 'Commuting in the city',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/commuting.png',
                        'scores' => ['City Slicker' => 4, 'Budget Conscious' => 3]
                    ],
                    'B' => [
                        'text' => 'Family trips and daily school runs',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/family-icon.png',
                        'scores' => ['Family First' => 5]
                    ],
                    'C' => [
                        'text' => 'Long road trips or off-roading adventures',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/long-road.png',
                        'scores' => ['Performance Enthusiast' => 400, 'Adventurer' => 2]
                    ],
                    'D' => [
                        'text' => 'Enjoying the luxury of driving',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/fun-icon.png',
                        'scores' => ['Luxury Seeker' => 4, 'Classic Car Lover' => 3]
                    ],
                    'E' => [
                        'text' => 'I don’t know',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png',
                        'scores' => ['The Path Finder' => 1]
                    ]
                ]
            ],
            2 => [
                'question' => 'How important is fuel efficiency to you?',
                'answers' => [
                    'A' => [
                        'text' => 'Extremely important - I want an electric/hybrid car',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/electric-car-icon.png',
                        'scores' => ['Eco-Warrior' => 5]
                    ],
                    'B' => [
                        'text' => 'Fairly Important - I am open to both',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/balance-icon.png',
                        'scores' => ['Budget Conscious' => 3]
                    ],
                    'C' => [
                        'text' => 'Not a priority - I focus more about performance',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/performance-icon.png',
                        'scores' => ['Performance Enthusiast' => 4]
                    ],
                    'D' => [
                        'text' => 'Not a matter - I care more about the driving experience',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/driving-icon.png',
                        'scores' => ['Classic Car Lover' => 4]
                    ],
                    'E' => [
                        'text' => 'I don’t know',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png',
                        'scores' => ['The Path Finder' => 1]
                    ]
                ]
            ],
            3 => [
                'question' => 'How many passengers do you typically accommodate?',
                'answers' => [
                    'A' => [
                        'text' => 'Just me or one other person',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/two-people-icon.png',
                        'scores' => ['Performance Enthusiast' => 3, 'Tech Geek' => 2]
                    ],
                    'B' => [
                        'text' => '3-4 people',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/group-of-people-icon.png',
                        'scores' => ['Eco-Warrior' => 3, 'Budget Conscious' => 4]
                    ],
                    'C' => [
                        'text' => '5 or more people',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/family-icon.png',
                        'scores' => ['Family First' => 5]
                    ],
                    'D' => [
                        'text' => 'It depends on the occasion',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/flexible-icon.png',
                        'scores' => ['Luxury Seeker' => 3]
                    ],
                    'E' => [
                        'text' => 'I don’t know',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png',
                        'scores' => ['The Path Finder' => 1]
                    ]
                ]
            ],
            4 => [
                'question' => 'What’s your budget range for a new car?',
                'answers' => [
                    'A' => [
                        'text' => 'Under $20,000',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/dollar-sign-icon.png',
                        'scores' => ['Budget Conscious' => 5]
                    ],
                    'B' => [
                        'text' => '$20,000 - $50,000',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/price-tag-icon.png',
                        'scores' => ['Eco-Warrior' => 4, 'Family First' => 4]
                    ],
                    'C' => [
                        'text' => 'Over $50,000',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/luxury-icon.png',
                        'scores' => ['Luxury Seeker' => 5, 'Performance Enthusiast' => 3]
                    ],
                    'D' => [
                        'text' => 'Money’s no issue – I’m after the experience',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/money-bag-icon.png',
                        'scores' => ['Classic Car Lover' => 5, 'Luxury Seeker' => 4]
                    ],
                    'E' => [
                        'text' => 'I don’t know',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png',
                        'scores' => ['The Path Finder' => 2]
                    ]
                ]
            ],
            5 => [
                'question' => 'How important is having the latest technology in your car?',
                'answers' => [
                    'A' => [
                        'text' => 'Very important - I want all the latest gadgets',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/gadgets-icon.png',
                        'scores' => ['Tech Geek' => 5, 'Luxury Seeker' => 4]
                    ],
                    'B' => [
                        'text' => 'Its a nice bonus but not essential',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/bonus-icon.png',
                        'scores' => ['Eco-Warrior' => 3, 'Performance Enthusiast' => 3]
                    ],
                    'C' => [
                        'text' => 'Not necessary - Im more focused on driving mechanics',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/steering-wheel-icon.png',
                        'scores' => ['Classic Car Lover' => 4]
                    ],
                    'D' => [
                        'text' => 'I prefer practical tech for safety and convenience',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/safety-icon.png',
                        'scores' => ['Family First' => 4]
                    ],
                    'E' => [
                        'text' => 'I dont know',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png',
                        'scores' => ['The Path Finder' => 2]
                    ]
                ]
            ],

            6 => [
                'question' => 'What kind of road conditions do you usually drive on?',

                'answers' => [
                    'A' => [
                        'text' => 'City streets and highways',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/city-icon.png',
                        'scores' => ['City Slicker' => 4, 'Tech Geek' => 3, 'Eco-Warrior' => 3]
                    ],
                    'B' => [
                        'text' => 'Suburban or rural roads',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/countryside-icon.png',
                        'scores' => ['Family First' => 4, 'Budget Conscious' => 4]
                    ],
                    'C' => [
                        'text' => 'Rough terrain, off-road, or long-distance',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/offroad-icon.png',
                        'scores' => ['Performance Enthusiast' => 5]
                    ],
                    'D' => [
                        'text' => 'I love scenic and classic drives',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/scenic-icon.png',
                        'scores' => ['Classic Car Lover' => 5]
                    ],
                    'E' => [
                        'text' => 'I dont know',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png',
                        'scores' => ['The Path Finder' => 2]
                    ]
                ]
            ],
            7 => [
                'question' => 'How important is safety when choosing a car?',
                'answers' => [
                    'A' => [
                        'text' => 'It\'s my top priority',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/safety-icon.png',
                        'scores' => ['Family First' => 5, 'Budget Conscious' => 3]
                    ],
                    'B' => [
                        'text' => 'Fairly important - but I also consider performance',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/balance-icon.png',
                        'scores' => ['Performance Enthusiast' => 3, 'Eco-Warrior' => 4]
                    ],
                    'C' => [
                        'text' => 'Safety matters, but comfort and style come first',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/comfort-icon.png',
                        'scores' => ['Luxury Seeker' => 4, 'Classic Car Lover' => 3]
                    ],
                    'D' => [
                        'text' => 'Not a primary concern - I prioritize fun driving experience',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/fun-icon.png',
                        'scores' => ['Classic Car Lover' => 5]
                    ],
                    'E' => [
                        'text' => 'I don’t know',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png',
                        'scores' => ['The Path Finder' => 1]
                    ]
                ]
            ],

            8 => [
                'question' => 'Do you care about the environmental impact?',
                'answers' => [
                    'A' => [
                        'text' => 'Yes, Im committed to sustainable choices',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/recycle-icon.png',
                        'scores' => ['Eco-Warrior' => 5]
                    ],
                    'B' => [
                        'text' => 'Somewhat but not my main concern',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/balance-icon.png',
                        'scores' => ['Family First' => 3, 'Budget Conscious' => 4]

                    ],
                    'C' => [
                        'text' => 'Not really I care more about performance',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/performance-icon.png',
                        'scores' => ['Performance Enthusiast' => 4]

                    ],
                    'D' => [
                        'text' => 'Im more into classic aesthetics and luxury',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/luxury-icon.png',
                        'scores' => ['Classic Car Lover' => 4, 'Luxury Seeker' => 3]

                    ],
                    'E' => [
                        'text' => 'I dont know',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png',
                        'scores' => ['The Path Finder' => 2]

                    ]
                ]
            ],

            9 => [
                'question' => 'What type of car body style do you prefer?',
                'answers' => [
                    'A' => [
                        'text' => 'Compact cars or sedans',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/compact-car-icon.png',
                        'scores' => ['Eco-Warrior' => 4, 'Budget Conscious' => 4, 'City Slicker' => 3]
                    ],
                    'B' => [
                        'text' => 'SUVs or minivans',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/suv-icon.png',
                        'scores' => ['Family First' => 5, 'Performance Enthusiast' => 3]
                    ],
                    'C' => [
                        'text' => 'Sleek, stylish luxury sedans or coupes',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/luxury-icon.png',
                        'scores' => ['Luxury Seeker' => 5, 'Classic Car Lover' => 4]
                    ],
                    'D' => [
                        'text' => 'Sports cars or performance vehicles',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/classic-icon.png',
                        'scores' => ['Performance Enthusiast' => 5]
                    ],
                    'E' => [
                        'text' => 'I dont know',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png',
                        'scores' => ['The Path Finder' => 2]
                    ]
                ]

            ],

            10 => [
                'question' => 'How would you describe your ideal driving experience?',
                'answers' => [
                    'A' => [
                        'text' => 'Quiet, smooth, and eco-friendly',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/comfort-icon.png',
                        'scores' => ['Eco-Warrior' => 5]
                    ],
                    'B' => [
                        'text' => 'Safe and comfortable for my family',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/family-icon.png',
                        'scores' => ['Family First' => 5]
                    ],
                    'C' => [
                        'text' => 'Luxurious and tech-enhanced',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/luxury-icon.png',
                        'scores' => ['Luxury Seeker' => 5, 'Tech Geek' => 4]
                    ],
                    'D' => [
                        'text' => 'Fast and exhilarating',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/sports-car-icon.png',
                        'scores' => ['Performance Enthusiast' => 5]
                    ],
                    'E' => [
                        'text' => 'Nostalgic and stylish',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/classic-icon.png',
                        'scores' => ['Classic Car Lover' => 5]
                    ],
                    'F' => [
                        'text' => 'I dont know',
                        'icon' => '../../../public_html/media/Persona_Test_Images/Test_Images/icons/i_dont_know.png',
                        'scores' => ['The Path Finder' => 2]
                    ]
                ]
            ],

        ];
    }
    // Calculate persona weights based on responses
    public function calculatePersonas($responses)
    {
        foreach ($responses as $questionId => $answer) {
            if (!isset($this->questions[$questionId])) {
                throw new Exception("Invalid question ID: $questionId.");
            }

            if (!isset($this->questions[$questionId]['answers'][$answer])) {
                throw new Exception("Invalid answer for question ID: $questionId.");
            }

            foreach ($this->questions[$questionId]['answers'][$answer]['scores'] as $personaName => $weight) {
                if (!isset($this->personas[$personaName])) {
                    $this->personas[$personaName] = [
                        'name' => $personaName,
                        'id' => null,
                        'icon' => 'default-icon.png',
                        'description' => 'Description not available.',
                        'weight' => 0
                    ];
                }
                $this->personas[$personaName]['weight'] += $weight;
            }
        }

        return $this->personas;
    }
//================TAKING THE TEST=================
    public function handleFormSubmission()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $responses = $_POST['answers'] ?? [];

            if (empty($responses)) {
                throw new Exception("No responses provided. Please answer the questions.");
            }

            $personasWeight = $this->calculatePersonas($responses);

            // Sort personas by weight
            usort($personasWeight, function ($a, $b) {
                return $b['weight'] <=> $a['weight'];
            });

            // Get the top persona
            $topPersona = reset($personasWeight);
            if ($topPersona === false) {
                throw new Exception("Top Persona could not be determined.");
            }

            // Increment the counter for the top persona using PersonasModel
            if (!$this->personasModel->incrementPersonaCounter($topPersona['name'])) {
                error_log("Failed to increment persona counter for: " . $topPersona['name']);
            }

            // Fetch cars associated with the top persona using CarsModel
            $personaId = $topPersona['id'];
            $cars = $this->carsModel->getCarsByPersona($personaId);

            // Increment RecommendationCount for each car
            foreach ($cars as $car) {
                $this->carsModel->incrementRecommendationCount($car['ID']);
            }

            //    SessionManager::updatePersonaID($topPersona['id']);
            // Start session and update personaID in the session
            SessionManager::startSession();
            if (!SessionManager::updatePersonaID($personaId)) {
                error_log("Failed to update personaID in the session for user.");
            }
            // SessionManager::updatePersonaIDInDatabase();
        
            
            // Store the results in a session
            session_start();
            $_SESSION['topPersona'] = $topPersona;
            $_SESSION['cars'] = $cars;

            // Redirect to the results view
            header('Location: ../app/views/user/persona.php');
            exit;


            $filePath = __DIR__ . '/debug_sessionManager.txt';    
            file_put_contents($filePath, print_r($_SESSION, true));  // Check if session data is available
    

        }
    }



    

}

// Instantiate the controller and handle form submission
try {
    $controller = new PersonasController($conn);
    $controller->handleFormSubmission();
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
    exit;
}
