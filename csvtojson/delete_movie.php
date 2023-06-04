<?php
// Get the database connection
require_once 'connection.php';

// Create a database object
$database = new database();
$db = $database->connection();

// Check if the movie ID is provided
if (isset($_GET['id'])) {
    $movieId = $_GET['id'];

    // Prepare the SQL statement
    $sql = "DELETE FROM MOVIE WHERE id = :id";

    // Bind the movie ID to the parameter
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $movieId);

    // Execute the query
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->rowCount() > 0) {
            echo "Movie deleted successfully.";
        } else {
            echo "No movie found with the provided ID.";
        }
    } else {
        echo "Error deleting movie.";
    }
} else {
    echo "Invalid movie ID.";
}

// Close the database connection
$db = null;

?>