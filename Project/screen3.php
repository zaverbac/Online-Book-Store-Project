<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->

<?php
    # Global variables for the search information
    include 'DatabaseConnection.php'; 
    session_start();

    $conn = databaseConnection();
    $cart = &$_SESSION['cart'];
    $searchfor = $_GET['searchfor'];
    $searchon = $_GET['searchon'];
    $category = $_GET['category'];
    $select = "";
    $isLike = ""; //Entirty of where clause

    $parsed_searchfor = explode(",",$searchfor);
  
    // Add to cart
    if (isset($_POST['addCart']))
    {
        array_push($cart, $_POST['addCart']);
    }


    // Search for books
    if($searchon[0] == "anywhere") {
        for ($i = 0; $i < 4; $i++)
        {
            switch ($i) {
                case 0:
                    $search = "title";
                    break;
                case 1:
                    $search = "author";
                    break;
                case 2:
                    $search = "publisher";
                    break;
                case 3:
                    $search = "isbn";
                    break;
            }
            
            for($j = 0; $j < count($parsed_searchfor); $j++) {
                $isLike .= "$search LIKE '%$parsed_searchfor[$j]%'";

                if($j != count($parsed_searchfor) - 1) {
                    $isLike .= " OR ";
                }
            }

            if($i != 3) {
                $isLike .= " OR ";
            }
        }
    } else {
        for($i = 0; $i < count($searchon); $i++) {
            for($j = 0; $j < count($parsed_searchfor); $j++) {
                $isLike .= "$searchon[$i] LIKE '%$parsed_searchfor[$j]%'";
                if($j != count($parsed_searchfor) - 1) {
                    $isLike .= " OR ";
                }
            }

            if($i != count($searchon) - 1) {
                $isLike .= " OR ";
            }
        }
    }

    if($category != "all") {
        $isLike .= "AND category='$category'";
    }

    $sql = "SELECT * FROM Book WHERE $isLike";
    $result = $conn->query($sql);
?>

<!DOCTYPE HTML>

<html>

<head>
    <title> Search Result - 3-B.com </title>
    <script>
    //redirect to reviews page
    function review(isbn, title) {
        console.log("test");
        window.location.href = "screen4.php?isbn=" + isbn + "&title=" + title;
    }
    </script>
</head>

<body>
    <table align="center" style="border:1px solid blue;">
        <tr>
            <td align="left">

                <h6>
                    <fieldset>Your Shopping Cart has 0 items</fieldset>
                </h6>

            </td>
            <td>
                &nbsp
            </td>
            <td align="right">
                <form action="shopping_cart.php" method="post">
                    <input type="submit" value="Manage Shopping Cart">
                </form>
            </td>
        </tr>
        <tr>
            <td style="width: 350px" colspan="3" align="center">
                <div id="bookdetails"
                    style="overflow:scroll;height:180px;width:400px;border:1px solid black;background-color:LightBlue">
                    <table>
                        <?php
                            if ($result->num_rows > 0) 
                            {
                                while($row = $result->fetch_assoc()) 
                                {
                                    $title = $row["title"];
                                    $author = $row["author"];
                                    $publisher = $row["publisher"];
                                    $isbn = $row["isbn"];

                                    echo "<tr>";
                                    echo "<td align='left'><form method='post''><button name='addCart' value='$isbn' id='cartButton'>Add to cart</button></form></td>";
                                    echo "<td rowspan='2' align='left'>$title</br>By $author</br><b>Publisher:</b>$publisher,</br><b>ISBN:</b> $isbn</t><br><b>Price:</b> $20</td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td align='left'><button name='review' id='review' onclick=\"review('$isbn', '$title')\">Reviews</button></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td colspan='2'><p>_______________________________________________</p></td>";
                                    echo "</tr>";
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
            <td align="center">
                <form action="confirm_order.php" method="get">
                    <input type="submit" value="Proceed To Checkout" id="checkout" name="checkout">
                </form>
            </td>
            <td align="center">
                <form action="screen2.php" method="post">
                    <input type="submit" value="New Search">
                </form>
            </td>
            <td align="center">
                <form action="index.php" method="post">
                    <input type="submit" name="exit" value="EXIT 3-B.com">
                </form>
            </td>
        </tr>
    </table>
</body>

</html>