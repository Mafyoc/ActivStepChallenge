
<?php //Read data from MySQL
function createForm($rowID){
    include('connect-mysql.php');
    $sql = "SELECT * FROM customers WHERE id = $rowID";
    $result = $conn->query($sql);

    if($result){
        $id = $result->$id;
        $name = $result->$name;
        $phone = $result->$phone;
        $email = $result->$email;
        $accref = $result->$accref;
    }

        $form = "<form"." "."action="."submit-form.php"." "."method="."post".">
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
        $html .= '<tr>'  . $newLine ;
        foreach ($row as $key => $value ){
            $html .=   "<td>" . $value . "</td>"  . $newLine ;
        }
        $rowID = $row['id'];
        $html .= "<td>
                          <input type="."button"." "."value="."EDIT"." "."id="."$rowID"." "."name="."editButton"." "."onclick="."createForm($rowID)".">
                  </td>
              </tr>" . $newLine ;
    }
        // closing table
        $html .=   "</table>"   . $newLine ;
    }
    else{
        $html = "0 entries in database";
    }

    return $html;
}
?>
<!doctype HTML>
<html>
<head>
    <title>Matts Customer Details</title>
    <link rel="stylesheet" href="StyleSheet.css" />
</head>
<body>
    <h1>Customer Details</h1>
    <div style="position:sticky;top:0;background-color: #e3e3e3;padding-top: 15px;">
        <?php echo createForm($rowID); ?>
    </div>
    <div>
        <?php
        echo createTable();
        ?>
    </div>
</body>
</html>