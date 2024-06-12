<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fin_demo";

// Get the question from the request
$data = json_decode(file_get_contents('php://input'), true);
$question = $data['question'];

try {
    // Create a connection to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare a SQL statement to select the answer based on the question
    $stmt = $conn->prepare("SELECT answer FROM qa WHERE question LIKE :question");
    $stmt->bindValue(':question', "%$question%", PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the answer from the result set
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        // If a matching answer is found, return it
        $answer = $row['answer'];
    } else {
        // If no matching answer is found, return a default response
        $answer = "I'm sorry, I don't have an answer for that.";
    }

    // Return the answer as JSON
    echo json_encode(['answer' => $answer]);
} catch(PDOException $e) {
    // If an error occurs, return an error message
    echo json_encode(['error' => 'An error occurred while fetching the answer.']);
}
