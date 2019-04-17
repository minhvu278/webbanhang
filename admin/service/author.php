<?php
include 'service.php';

$mode = $_GET['mode'];

switch ($mode){
    case 'get_data':
        $data['data'] = getData();
        $data['status'] = true;
        break;
    case 'insert_data':
        $tentacgia = $_GET['tentacgia'];

        $data['status'] = insertData($tentacgia);
        break;
    case 'edit_data':
        $id = $_GET['id'];
        $tentacgia = $_GET['tentacgia'];

        $data['status'] = editData($id, $tentacgia);
        break;
    case 'remove_data':
        $id = $_GET['id'];

        $data['status'] = removeData($id);
        break;
    default:
        $data = "Wrong mode";
}

$json = json_encode($data);
echo $json;

function getData(){
    $conn = getConnection();
    if($conn == null){
        echo "Co loi xay ra";
        die();
    }

    $query = "select id, name from author where is_deleted = false ";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

    if(!isset($data)){
        $data = [];
    }
    closeConnection($conn);
    return $data;
}

function insertData($tentacgia){
    $conn = getConnection();
    $query = "insert into author
                (name)
                value 
                (:name)";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
       ":name" => $tentacgia
    ]);
    closeConnection($conn);
    return $result;
}

function editData($id, $tentacgia){
    $conn = getConnection();
    $query = "
        UPDATE author SET
          name = :name
        WHERE 
          id = :id ";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":id" => $id,
        ":name" => $tentacgia
    ]);
    closeConnection($conn);
    return $result;
}

function removeData($id){
    $conn = getConnection();
    $query = "UPDATE author SET
              is_deleted = true
              WHERE 
              id = :id";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":id" => $id
    ]);
    closeConnection($conn);
    return $result;
}
?>
