<!doctype html>
<link href="StyleSheet.css" type="text/css" />
<html>
<head>
    <link rel="stylesheet" href="StyleSheet.css" />
</head>
<body>
    <?php //submit form details to mysql
    include('connect-mysql.php');

    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $accref = $_POST['accref'];

    $result = $conn->query("SELECT * FROM customers WHERE id = '$id'");

    if($result->num_rows == 0){     //checks if the submitted id already exists
        if(isset($_POST['submit']) && $_POST['id']!=NULL){  

            $sql = "INSERT INTO customers (id, name, phone, email, accref) VALUES ('$id', '$name', '$phone', '$email', '$accref')";
            $rs = $conn->query($sql);

            if($rs){
                echo 'Your entry has been added successfully';
            } 
            else{
                echo 'ERROR entry not added';
            }
        }
    }           //inserts new entry to database if number of rows with submitted id is 0
    else{
        if(isset($_POST['submit']) && $_POST['id']!=NULL)

        $sql = "UPDATE customers SET id = '$id', name = '$name', phone = '$phone', email = '$email', accref = '$accref' WHERE id = '$id'";
        $rs = $conn->query($sql);

        if($rs){
            echo 'Your entry at has been updated successfully';
        } else{
            echo 'ERROR entry not updated';
        }
    }           //update entry in database if submitted id already exists
    ?>
    <br />
    <form>
        <input type="BUTTON" value="Homepage" onclick="window.location.href='https://activtest.uk/matt/'" />
    </form>

</body>
</html>
