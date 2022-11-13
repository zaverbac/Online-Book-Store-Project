<?php
    include 'DatabaseConnection.php'; 
    session_start();

    $conn = databaseConnection();

    $cart = &$_SESSION['cart'];
    $quantitys = array();
    $isbnSearch = "";
    $isbn = "";
    $title = "";
    $author = "";
    $publisher = "";
    $price = "";
    $total = 0;
    $cartAmount = count($cart);

    // Delete from cart
    if (isset($_POST['delete']))
    {
        $index = array_search($_POST['delete'], $cart);

        if ($index == 0) {
            array_shift($cart);
        }
        else {
            array_splice($cart, 1, $index);
        }
    }

    
    for($i = 0; $i < $cartAmount; $i++) {
        // Generate where clause
        $isbnSearch .= "isbn='$cart[$i]'";

        if($i != $cartAmount - 1) {
            $isbnSearch .= " OR ";
        }

        // Get Quantitys
        $bookQNT = "quantity$i";

        if (isset($_POST['recalculate_payment'])) {
            array_push($quantitys, $_POST[$bookQNT]);
        }
        else {
            array_push($quantitys, 1);
        }
    }
?>

<!DOCTYPE HTML>

<html>

<head>
    <title>Shopping Cart</title>
    <script>
        function proceed()
        {
            let loggedIn = "<?php echo $_SESSION['username']?>";

            if (loggedIn == "notLoggedIn") {
                window.location.href = "customer_registration.php";
            }
            else {
                window.location.href = "confirm_order.php";
            }
        }
    </script>
</head>

<body>
    <form id="recalculate" name="recalculate" action="" method="post">
        <table align="center" style="border:2px solid blue;">
            <tr>
                <td align="center">
                    <button type="button" id="checkout_submit" onclick="proceed()">Proceed to Checkout</button>
                </td>
                <td align="center">
                    <form id="new_search" action="screen2.php" method="post">
                        <input type="submit" name="search" id="search" value="New Search">
                    </form>
                </td>
                <td align="center">
                    <form id="exit" action="index.php" method="post">
                        <input type="submit" name="exit" id="exit" value="EXIT 3-B.com">
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
                        <table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
                            <th width='10%'>Remove</th>
                            <th width='60%'>Book Description</th>
                            <th width='10%'>Qty</th>
                            <th width='10%'>Price</th>
                            <?php    
                                $sql = "SELECT * FROM Book WHERE $isbnSearch";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    $count = 0;
                                    $quantityID = "";
                                    while($row = $result->fetch_assoc()) {
                                        $isbn = $row["isbn"];
                                        $title = $row["title"];
                                        $author = $row["author"];
                                        $publisher = $row["publisher"];
                                        $price = $row["price"];
                                        $total += $price * $quantitys[$count];
                                        $quantityID = "quantity$count";

                                        echo "<tr>";
                                        echo "<td><form method='post''><button name='delete' id='delete' value='$isbn'>Delete Item</button></form></td>";                                      
                                        echo "<td>$title</br><b>By</b> $author</br><b>Publisher:</b> $publisher</td>";
                                        echo "<td><input id='$quantityID' name='$quantityID' value='$quantitys[$count]' size='1' /></td>";
                                        echo "<td>$$price</td>";
                                        echo "</tr>";
                                        $count++;
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <input type="submit" name="recalculate_payment" id="recalculate_payment" value="Recalculate Payment"/>
                </td>
                <td align="center">
                    &nbsp;
                </td>
                <td align="center">
                    <?php
                        echo "Subtotal: $$total";
                    ?>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>