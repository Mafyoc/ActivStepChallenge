<?php //Read data from MySQL
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
                $html .= "<td><input id="."editButton"." "."name="."{$row['id']}"." "."value="."edit"." type="."button"."></td></tr>" . $newLine ;
        }
        // closing table
        $html .=   "</table>"   . $newLine ;
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
    <div style="position:sticky;top:0;">
        <form action="submit-form.php" method="post" >
            <div id="formElement">
                <label>ID: </label>
                <br />
                <input type="number" name="id" />
            </div>
            <div id="formElement">
                <label>Name: </label>
                <br />
                <input type="text" name="name" />
            </div>
            <div id="formElement">
                <label>Phone: </label>
                <br />
                <input type="tel" name="phone" />
            </div>
            <div id="formElement">
                <label>Email: </label>
                <br />
                <input type="email" name="email" />
            </div>
            <div id="formElement">
                <label>Accref: </label>
                <br />
                <input type="text" name="accref" />
            </div>
            <div id="formElement">
                <input type="submit"  value="submit" name="submit" id="submit"/>
            </div>
        </form>
    </div>
    <?php
        echo createTable();
    ?>

</body>
</html>