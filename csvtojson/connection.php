<?php
header('Content-Type: application/json');

class database {
    // Database credentials
    private $host = "localhost";
    private $db_name = "webtechw10";
    private $username = "root";
    private $password = "afikah";
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
        id VARCHAR(30) PRIMARY KEY NOT NULL,
        title VARCHAR(255) ,
        type VARCHAR(30) ,
        description TEXT ,
        release_year INT ,
        age_certification VARCHAR(10) ,
        runtime INT ,
        genres VARCHAR(255) ,
        production_countries VARCHAR(255) ,
        seasons VARCHAR(10),
        imdb_id VARCHAR(30) ,
        imdb_score FLOAT ,
        imdb_votes INT ,
        tmdb_popularity FLOAT ,
        tmdb_score FLOAT 
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