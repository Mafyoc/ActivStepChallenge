<!doctype HTML>
<html>
<head>
    <title>Matts Activstep challenge</title>
    <link rel="stylesheet" href="StyleSheet.css" />
</head>
<body>
    <h1>Customer Details</h1>
    <div>

        <?php //Read data from MySQL
        include('connect-mysql.php');
        $sql = "SELECT * FROM customers";
        $result = $conn->query($sql);
        //this function dynamically outputs a basic HTML table from the mysql result
        function createTable($result) {
            echo "<table border='1'>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Accref</th>
            </tr>";

            while($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['accref'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        if ($result->num_rows > 0) {
            // output data of each row
            echo createTable($result);
        } else {
            echo "0 entries in database";
        }

        $conn->close();
        ?>
    </div>

    <form action="submit-form.php" method="post">
        <label>ID: </label> <input type="number" name="id" placeholder="ID" /><br />
        <label>Name: </label><input type="text" name="name" placeholder="Name" /><br />
        <label>Phone: </label><input type="text" name="phone" placeholder="Phone" /><br />
        <label>Email: </label><input type="email" name="email" placeholder="Email" /><br />
        <label>Accref: </label><input type="text" name="accref" placeholder="Accref" /><br />
        <input type="submit" value="submit" name="submit" id="submit" />
    </form>
</body>
</html>