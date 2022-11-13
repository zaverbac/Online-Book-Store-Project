<!-- screen 4: Book Reviews by Prithviraj Narahari, php coding: Alexander Martens-->
<!DOCTYPE html>

<?php
    include 'DatabaseConnection.php'; 

    $conn = databaseConnection();
    $isbn = $_GET['isbn'];
    $title = "";
    $author = "";

    $sql = "SELECT title, author FROM Book WHERE isbn='$isbn'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            $title = $row["title"];
            $author = $row["author"];
        }
    } 
    else 
    {
      echo "0 results";
    } 
?>

<html>

<head>
    <title>Book Reviews - 3-B.com</title>
    <style>
    .field_set 
    {
        border-style: inset;
        border-width: 4px;
    }
    </style>
    <script>
        function back() 
        {
            history.back();
        }
    </script>
</head>

<body>
    <table align="center" style="border:1px solid blue;">
        <tr>
            <td align="center">
                <?php
                echo "<h5>Reviews For: $title <br> By $author</h5>";
                ?>
            </td>
            <td align="left">
                <h5> </h5>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">
                    <table>
                        <?php
                            $sql = "SELECT review FROM Review WHERE isbn='$isbn'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) 
                            {
                                while($row = $result->fetch_assoc()) 
                                {
                                    $review = $row["review"];

                                    echo "<tr><td>" . $review . "</td></tr>";

                                    echo "<tr><td><hr><td><tr>";
                                }
                            } 
                            else 
                            {
                              echo "0 results";
                            } 
                        ?>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <button onclick="back()" method="post">Back</button>
            </td>
        </tr>
    </table>

</body>

</html>