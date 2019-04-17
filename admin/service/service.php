<?php
function getConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "websitetintuc";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");
        return $conn;
    } catch (PDOException $e) {
        echo "Error:  " . $e->getMessage();
        return null;
    }

}

function closeConnection($conn)
{
    $conn = null;
}


?>