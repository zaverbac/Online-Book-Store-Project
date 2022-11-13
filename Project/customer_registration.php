<!-- UI: Prithviraj Narahari, php code: Alexander Martens -->
<!DOCTYPE HTML>

<?php
    include 'DatabaseConnection.php'; 

    $validSubmit = false;
    $submitError = "none";

    $conn = databaseConnection();
    if (isset($_POST['register_submit']))
    {
        $username = $_POST['username'];
        $pin = $_POST['pin'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $streetName = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['state'];
        $zip = $_POST['zip'];
        $credit_card = $_POST['credit_card'];
        $card_number = $_POST['card_number'];
        $expiration = $_POST['expiration'];
        $error = "";

        //Error Checking
        if ($username != "" && $pin != "" && $firstname != "" && $lastname != "" && $streetName != "" && $city != "" && $zip != "" && $country != "" && $credit_card != "" && $card_number != "" && $expiration != "")
        {
            $sql = "SELECT * FROM Customer WHERE username='$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                $error = "Username is taken. Enter a new username";
            } 
            else 
            {
                $sql = "INSERT INTO Customer (username, pin, firstName, lastName, streetName, city, zip, country, cardType, cardNumber, cardExpiration) VALUES ('$username', $pin, '$firstname', '$lastname', '$streetname', '$city', $zip, '$country', '$credit_card', '$card_number', '$expiration')";
                $result = $conn->query($sql);

                header('Location: confirm_order.php');
                die();
            } 
        }
        else
        {
            $error = "All fields must be filled in!";
        }
    }
    else if(isset($_POST['donotregister']))
    {
        alert("This is a test");
    }
?>


<html>

<head>
    <title> CUSTOMER REGISTRATION </title>
    <script>
        function donotregister() {
            alert("In order to proceed with the payment, you need to register first.");
            window.location.href = "screen2.php";
        }
    </script>
</head>

<body>
    <table align="center" style="border:2px solid blue;">
        <tr>
            <form id="register" action="" method="post">
                <td align="right">
                    Username<span style="color:red">*</span>:
                </td>
                <td align="left" colspan="3">
                    <input type="text" id="username" name="username" placeholder="Enter your username">
                </td>
        </tr>
        <tr>
            <td align="right">
                PIN<span style="color:red">*</span>:
            </td>
            <td align="left">
                <input type="password" id="pin" name="pin">
            </td>
            <td align="right">
                Re-type PIN<span style="color:red">*</span>:
            </td>
            <td align="left">
                <input type="password" id="retype_pin" name="retype_pin">
            </td>
        </tr>
        <tr>
            <td align="right">
                Firstname<span style="color:red">*</span>:
            </td>
            <td colspan="3" align="left">
                <input type="text" id="firstname" name="firstname" placeholder="Enter your firstname">
            </td>
        </tr>
        <tr>
            <td align="right">
                Lastname<span style="color:red">*</span>:
            </td>
            <td colspan="3" align="left">
                <input type="text" id="lastname" name="lastname" placeholder="Enter your lastname">
            </td>
        </tr>
        <tr>
            <td align="right">
                Address<span style="color:red">*</span>:
            </td>
            <td colspan="3" align="left">
                <input type="text" id="address" name="address">
            </td>
        </tr>
        <tr>
            <td align="right">
                City<span style="color:red">*</span>:
            </td>
            <td colspan="3" align="left">
                <input type="text" id="city" name="city">
            </td>
        </tr>
        <tr>
            <td align="right">
                State<span style="color:red">*</span>:
            </td>
            <td align="left">
                <select id="state" name="state">
                    <option selected disabled>select a state</option>
                    <option>Michigan</option>
                    <option>California</option>
                    <option>Tennessee</option>
                </select>
            </td>
            <td align="right">
                Zip<span style="color:red">*</span>:
            </td>
            <td align="left">
                <input type="text" id="zip" name="zip">
            </td>
        </tr>
        <tr>
            <td align="right">
                Credit Card<span style="color:red">*</span>
            </td>
            <td align="left">
                <select id="credit_card" name="credit_card">
                    <option selected disabled>select a card type</option>
                    <option>VISA</option>
                    <option>MASTER</option>
                    <option>DISCOVER</option>
                </select>
            </td>
            <td colspan="2" align="left">
                <input type="text" id="card_number" name="card_number" placeholder="Credit card number">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                Expiration Date<span style="color:red">*</span>:
            </td>
            <td colspan="2" align="left">
                <input type="text" id="expiration" name="expiration" placeholder="MM/YY">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" id="register_submit" name="register_submit" value="Register">
            </td>
            </form>
                <td colspan="2" align="center">
                    <button id="donotregister" onclick="donotregister()">Don't Register</button>
                </td>
        </tr>
    </table>
</body>

</html>