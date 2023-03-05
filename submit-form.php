<?php
if($_POST){
    $URL = "https://activtest.uk/matt/";
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
            return "<script>alert('ERROR entry not added');</script>";
        }
    }
    function updateEntry($conn, $id, $name, $phone, $email, $accref){
        $sql = "UPDATE customers SET id = '$id', name = '$name', phone = '$phone', email = '$email', accref = '$accref' WHERE id = '$id'";
        $rs = $conn->query($sql);

        if($rs){
            return 'Entry has been successfully updated';
        }
        else{
            return "<script>alert('ERROR entry not updated');</script>";
        }
    }

if(($id >= "1") && ($result->num_rows >= $id)){
        updateEntry($conn, $id, $name, $phone, $email, $accref);
        header( "Location: $URL", true, 303 );
        exit();
    }      //updates existing entry in database
    else if ($id == NULL){
        newEntry($conn, $id, $name, $phone, $email, $accref);
        header( "Location: $URL", true, 303 );
        exit();
    }      //adds new entry to database
    header( "Location: $URL", true, 303 );
    exit();
}
