<!-- This file contains the database connection code. -->
<?php
    // Main database connection file.
    function databaseConnection()
    {
        $servername = 'localhost';
        $username = 'admin';
        $password = 'COSC471Database';
        $dbname = 'Library';
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        echo "MySQL connection failed.";
        }

        return $conn;
    }
?>