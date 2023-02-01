<?php

include("include/auth_session.php");
require('include/db.php');
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "DELETE FROM clients WHERE id=$id";
    $conn->query($sql);
}
header("location: home.php");
exit;
?>