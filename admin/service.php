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
        $conn->exec("set name utf8");
    } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
        return null;
    }
}

function closeConnection($conn)
{
    $conn = null;
}

function getPostData($parameter)
{
    if (isset($_POST[$parameter])) {
        return $_POST[$parameter];
    }
    return "";
}

?>