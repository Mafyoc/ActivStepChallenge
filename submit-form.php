<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="StyleSheet.css" />
    <meta http-equiv="refresh" content="0; url=https://activtest.uk/matt/" />
</head>
<body>
    <?php //submit form details to mysql
    include('connect-mysql.php');
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $accref = $_POST['accref'];

    $result = $conn->query("SELECT * FROM customers WHERE id");
    function newEntry($conn, $id, $name, $phone, $email, $accref){
        $sql = "INSERT INTO customers (id, name, phone, email, accref) VALUES ('$id', '$name', '$phone', '$email', '$accref')";
        $rs = $conn->query($sql);

        if($rs){
            return 'New entry successfully added';
        }
        else{
            return 'ERROR entry not added';
        }
    }
    function updateEntry($conn, $id, $name, $phone, $email, $accref){
        $sql = "UPDATE customers SET id = '$id', name = '$name', phone = '$phone', email = '$email', accref = '$accref' WHERE id = '$id'";
        $rs = $conn->query($sql);

        if($rs){
            return 'Entry has been successfully updated';
        } 
        else{
            return 'ERROR entry not updated';
        }
    }


    if(($id >= "1") && ($result->num_rows >= $id)){     //checks if the submitted id already exists
        return updateEntry($conn, $id, $name, $phone, $email, $accref);
    }           //updates existing entry when ID is in range
    else if ($id == NULL){
        return newEntry($conn, $id, $name, $phone, $email, $accref);
    }           //makes a new entry in database if ID is not in range
    else{
        return "INVALID ID";
    }
    
    ?>
    <br />
</body>
</html>
