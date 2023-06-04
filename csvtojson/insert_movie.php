<?php
//Get the database connection
require_once 'connection.php';

// Create a database object
$database = new database();
$db = $database->connection();

// Check if the movie ID is provided
if (isset($_GET['id'])) {
    $movieId = $_GET['id'];

    // Retrieve the movie data from the JSON file based on the ID
    $json = file_get_contents('csvjson.json');
    $data = json_decode($json, true);

    $selectedMovie = null;

    // Find the movie with the matching ID
    foreach ($data as $movie) {
        if ($movie['id'] === $movieId) {
            $selectedMovie = $movie;
            break;
        }
    }

    if ($selectedMovie) {
        // Prepare the SQL statement
        $sql = "INSERT INTO MOVIE (id, title, description, release_year, genres) VALUES (:id, :title, :description, :release_year, :genres)";

        // Get the values for the selected movie
        $id = $selectedMovie['id'];
        $title = $selectedMovie['title'];
        $description = $selectedMovie['description'];
        $release_year = $selectedMovie['release_year'];
       $genres = $selectedMovie['genres'];

        // Bind values to the parameters
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':release_year', $release_year);
        $stmt->bindParam(':genres', $genres);

        // Execute the query
        if ($stmt->execute()) {
            echo "Movie inserted successfully.";
        } else {
            echo "Error inserting movie.";
        }
    } else {
        echo "Movie not found.";
    }
} else {
    echo "Invalid movie ID.";
}

// Close the database connection
$db = null;
?>
