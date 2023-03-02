<!doctype HTML>
<html>
<head>
    <title>Matts Customer Details</title>
    <link rel="stylesheet" href="StyleSheet.css" />
</head>
<body>
    <h1>Customer Details</h1>
    <div>

        <?php //Read data from MySQL
        include('connect-mysql.php');
        $sql = "SELECT * FROM customers";
        $result = $conn->query($sql);
        function createTable($result) {
            if($result->num_rows > 0){
                echo "<table border='1'>
            <tr>
                <th>ID</th>
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
            }   //this function dynamically outputs a basic HTML table from the mysql result
            else{
                echo "0 entries in database";
            }
        }   //creates a table or outputs that there are no entries

        if(isset($_POST['return'])) {
            createTable($result);
        } else{
            createTable($result);
        }

        $conn->close();
        ?>
    </div>
    <form action="submit-form.php" method="post">
        <label>ID (enter an existing ID to update or leave blank for new entry): </label> <input type="number" name="id" placeholder="ID" /><br />
        <label>Name: </label><input type="text" name="name" placeholder="Name" /><br />
        <label>Phone: </label><input type="tel" name="phone" placeholder="Phone" /><br />
        <label>Email: </label><input type="email" name="email" placeholder="Email" /><br />
        <label>Accref: </label><input type="text" name="accref" placeholder="Accref" /><br />
        <input type="submit" value="submit" name="submit" id="submit" />
    </form>
</body>
</html>