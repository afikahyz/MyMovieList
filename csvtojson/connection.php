<?php
header('Content-Type: application/json');

class database {
    // Database credentials
    private $host = "localhost";
    private $db_name = "webtechw10";
    private $username = "root";
    private $password = "";
    public $conn;

    // Get the database connection
    public function connection() {
        $mysql_connect_str = "mysql:host=$this->host;dbname=$this->db_name";
        try {
            $dbConnection = new PDO($mysql_connect_str, $this->username, $this->password);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        } catch (PDOException $e) {
            echo "Database connection error: " . $e->getMessage();
            return null;
        }
    }

    // Create table
    public function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS MOVIE (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(150) NOT NULL,
            type VARCHAR(150) NOT NULL,
            description VARCHAR(300) NOT NULL,
            release_year INT(4) NULL,
            age_certification VARCHAR(30) NULL,
            runtime INT(3) NULL,
            genres VARCHAR(30) NULL,
            production_countries VARCHAR(30) NULL,
            seasons VARCHAR(50) NULL,
            imdb_id VARCHAR(30) NULL,
            imdb_scores FLOAT() NULL,
            imdb_votes VARCHAR(30) NULL,
            tmdb_popularity VARCHAR(30) NULL,
            tmdb_score VARCHAR(30) NULL,           
        )";
        
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
    }
}

// Create a database object
$database = new database();
$database->connection();
$database->createTable();
?>