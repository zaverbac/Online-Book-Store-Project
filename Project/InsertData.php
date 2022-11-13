<!--This file contains functions used to insert data into the Library database-->
<?php

?>










<!-- Ignore this for now
error_reporting(E_ALL);
    include 'DatabaseConnection.php'; 

    $conn = databaseConnection();
    if (isset($_POST['register_submit']))
    {
        $username = $_POST['username'];
        $pin = $_POST['pin'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $credit_card = $_POST['credit_card'];
        $card_number = $_POST['card_number'];
        $expiration = $_POST['expiration'];

        $sql = "INSERT INTO dummyUser(username, pin, fname, lname, address, city, zip, creditcard, cardnumber, expiration) VALUES ('$username', $pin, '$firstname', '$lastname', '$address', '$city', $zip, '$credit_card', $card_number, '$expiration')";
        $result = $conn->query($sql);

        echo "Data Inserted!";
    }
-->