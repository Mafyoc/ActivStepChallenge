<?php //Read data from MySQL
function createForm(){
    include('connect-mysql.php');
    $sql = "SELECT * FROM customers WHERE id=$id";
    $result = $conn->query($sql);

    if(isset($_POST['editButton'])){
        
    }
    $id = $result['id'];
    $name = $result['name'];
    $phone = $result['phone'];
    $email = $result['email'];
    $accref = $result['accref'];

    $form = "<form"." "."method="."post".">
            <div id="."formElement".">
                <label>ID: </label>
                <br />
                <input type="."number"." "."name="."id"." "."value=$id".">
            </div>
            <div id="."formElement".">
                <label>Name: </label>
                <br />
                <input type="."text"." "."name="."name"." "."value=$name".">
            </div>
            <div id="."formElement".">
                <label>Phone: </label>
                <br />
                <input type="."tel"." "."name="."phone"." "."value=$phone".">
            </div>
            <div id="."formElement".">
                <label>Email: </label>
                <br />
                <input type="."email"." "."name="."email"." "."value=$email".">
            </div>
            <div id="."formElement".">
                <label>Accref: </label>
                <br />
                <input type="."text"." "."name="."accref"." "."value=$accref".">
            </div>
            <div id="."formElement".">
                <input type="."submit"." "."value="."submit"." "."name="."submit"." "."id="."submit"." />
            </div>
        </form>";
    return $form;
}
function createTable(){
    include('connect-mysql.php');
    $sql = "SELECT * FROM customers";
    $result = $conn->query($sql);
    $newLine="\n";

    if($result->num_rows > 0){
        //start table
        $isFirstLine = true;
        $html .= "<table border='1'>".$newLine;

    while($row = $result->fetch_assoc() )
    {
        //Table header
        if($isFirstLine == true){
            $html .= "<tr>".$newLine;
                foreach($row as $key => $value){
                    $html .= "<th>".$key."</th>".$newLine;
                }
            $html .= "<th></th></tr>" . $newLine;
            $isFirstLine = false;
            }
            // table body
            $html .=   '<tr>'  . $newLine ;
                foreach ($row as $key => $value ){
                    $html .=   "<td>" . $value . "</td>"  . $newLine ;
                }
                $html .= "<td>
                              <form"." "."method="."post".">
                                  <input id="."editButton"." "."name="."editButton"." "."value="."edit"." type="."submit".">
                              </form>
                          </td>
                        </tr>" . $newLine ;
        }
        // closing table
        $html .=   "</table>"   . $newLine ;
    }

    return $html;
}
function submitForm(){
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
}
?>

<!doctype HTML>
<html>
<head>
    <title>Matts Customer Details</title>
    <link rel="stylesheet" href="StyleSheet.css" />
    <meta http-equiv="Pragma" content="no-cache" />
</head>
<body>
    <h1>Customer Details</h1>
    <div style="position:sticky;top:0;background-color: #e3e3e3;">
        <?php
            echo createForm();
            unset($_POST['editButton']);

        ?>
    </div>
    <?php
    if (isset($_POST['submit'])){
        echo submitForm();
    }
        echo createTable();
    ?>

</body>
</html>