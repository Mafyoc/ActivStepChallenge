<?php
if($_POST){
    $URL = "https://activtest.uk/matt/";
    include('connect-mysql.php');
    $sql = "SELECT * FROM customers WHERE id=$_POST"."['editButton']";
    $result = $conn->query($sql);
    if($result){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $accref = $_POST['accref'];
    }
    //$form = "<form"." "."action="."submit-form.php"." "."method="."post".">
    //        <div id="."formElement".">
    //            <label>ID: </label>
    //            <br />
    //            <input type="."number"." "."name="."id"." "."value=$id".">
    //        </div>
    //        <div id="."formElement".">
    //            <label>Name: </label>
    //            <br />
    //            <input type="."text"." "."name="."name"." "."value=$name".">
    //        </div>
    //        <div id="."formElement".">
    //            <label>Phone: </label>
    //            <br />
    //            <input type="."tel"." "."name="."phone"." "."value=$phone".">
    //        </div>
    //        <div id="."formElement".">
    //            <label>Email: </label>
    //            <br />
    //            <input type="."email"." "."name="."email"." "."value=$email".">
    //        </div>
    //        <div id="."formElement".">
    //            <label>Accref: </label>
    //            <br />
    //            <input type="."text"." "."name="."accref"." "."value=$accref".">
    //        </div>
    //        <div id="."formElement".">
    //            <input type="."submit"." "."value="."submit"." "."name="."submit"." "."id="."submit"." />
    //        </div>
    //    </form>";
}
header( "Location: $URL", true, 303 );
