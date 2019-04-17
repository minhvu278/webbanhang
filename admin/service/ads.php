<?php
include 'service.php';

$mode = $_GET['mode'];

switch ($mode){
    case 'get_data':
        $data['data'] = getData();
        $data['status'] = true;
        break;
    case 'insert_data':
        $location = $_GET['location'];
        $hidden = $_GET['hidden'];
        $images = $_GET['images'];
        $url = $_GET['url'];

        $data['status'] = insertData($location, $hidden, $images, $url);
        break;
    case 'edit_data':
        $id = $_GET['id'];
        $location = $_GET['location'];
        $hidden = $_GET['hidden'];
        $images = $_GET['images'];
        $url = $_GET['url'];

        $data['status'] = editData($id, $location, $hidden, $images, $url);
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

    $query = "select id, location, hidden, images, url from ads where is_deleted = false ";
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

function insertData($location, $hidden, $images, $url){
    $conn = getConnection();
    $query = "insert into ads
                (location, hidden, images, url)
                value 
                (:location, :hidden, :images, :url)";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":location" => $location,
        ":hidden" => $hidden,
        ":images" => $images,
        ":url" => $url
    ]);
    closeConnection($conn);
    return $result;
}

function editData($id, $location, $hidden, $images, $url){
    $conn = getConnection();
    $query = "
        UPDATE ads SET
          location = :location,
          hidden = :hidden,
          images = :images,
          url = :url
        WHERE 
          id = :id ";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":id" => $id,
        ":location" => $location,
        ":hidden" => $hidden,
        ":images" => $images,
        ":url" => $url
    ]);
    closeConnection($conn);
    return $result;
}

function removeData($id){
    $conn = getConnection();
    $query = "UPDATE ads SET
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
