<?php
include 'service.php';

$mode = $_GET['mode'];

switch ($mode){
    case 'get_data':
        $data['data'] = getData();
        $data['status'] = true;
        break;
    case 'insert_data':
        $tendm = $_GET['tendm'];
        $url = $_GET['url'];
        $ghichu = $_GET['ghichu'];

        $data['status'] = insertData($tendm, $url, $ghichu);

        break;
    case 'edit_data':
        $id = $_GET['id'];
        $tendm = $_GET['tendm'];
        $url = $_GET['url'];
        $ghichu = $_GET['ghichu'];

        $data['status'] = editData($id, $tendm, $url, $ghichu);
        break;
    case 'remove_data':
        $id = $_GET['id'];

        $data['status'] = removeData($id);
        break;
    default:
        $data = "Wrong mode";
}

// Convert -> JSON
$json = json_encode($data);
echo $json;


function getData()
{
    $conn = getConnection();

    if ($conn == null) {
        echo "Co loi xay ra";
        die();
    }

    $query = "select id, name, url, note FROM category WHERE is_deleted = false ";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    if (!isset($data)) {
        $data = [];
    }
    closeConnection($conn);
    return $data;
}

function insertData($tendm, $url, $ghichu){
    $conn = getConnection();
    $query = "insert into category
                      (name, url, note)
                      value 
                      (:name, :url, :note)";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
       ":name" => $tendm,
       ":url" => $url,
        ":note" => $ghichu
    ]);
    closeConnection($conn);
    return $result;
}

function editData($id, $tendm, $url, $ghichu){
    $conn = getConnection();
    $query = "
        UPDATE category SET
          name = :name,
          note = :note,
          url = :url
        WHERE 
          id = :id ";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":id" => $id,
        ":name" => $tendm,
        ":url" => $url,
        ":note" => $ghichu
    ]);
    closeConnection($conn);
    return $result;
}

function removeData($id){
    $conn = getConnection();
    $query = "UPDATE category SET
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