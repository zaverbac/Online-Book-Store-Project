<!-- Figure 2: Search Screen by Alexander -->
<!DOCTYPE HTML>

<html>

<head>
    <title>SEARCH - 3-B.com</title>
    <script>
        function checkIfEmpty() {
            const search = document.getElementById("searchfor");
            const searchButton = document.getElementById("searchbutton");

            if(search.value === "") {
                searchButton.disabled = true;
            } else {
                searchButton.disabled = false;
            }
        }
    </script>
</head>

<body onload="checkIfEmpty()">
    <table align="center" style="border:1px solid blue;">
        <tr>
            <td>Search for: </td>
            <form action="screen3.php" method="get">
                <td><input id="searchfor" name="searchfor" onchange="checkIfEmpty()" /></td>
                <td><input id="searchbutton" type=submit name=search value=Search></td>
            </tr>
        <tr>
            <td>Search In: </td>
            <td>
                <select name="searchon[]" multiple>
                    <option value="anywhere" selected='selected'>Keyword anywhere</option>
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="publisher">Publisher</option>
                    <option value="isbn">ISBN</option>
                </select>
            </td>
            <td><a href="shopping_cart.php"><input type="button" name="manage" value="Manage Shopping Cart" /></a></td>
        </tr>
        <tr>
            <td>Category: </td>
            <td><select name="category">
                    <option value='all' selected='selected'>All Categories</option>
                    <option value="Fiction">Fiction</option>
                </select></td>
            </form>
            <form action="index.php" method="post">
                <td><input type="submit" name="exit" value="EXIT 3-B.com" /></td>
            </form>
        </tr>
    </table>
</body>

</html>