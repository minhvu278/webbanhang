<?php
include 'service.php';

$mode = $_GET['mode'];

switch ($mode){
    case 'get_data':
        $data['data'] = getData();
        $data['status'] = true;
        break;
    case 'insert_data':
        $news_id = $_GET['news_id'];
        $name = $_GET['name'];
        $email = $_GET['email'];
        $content = $_GET['content'];

        $data['status'] = insertData($news_id, $name, $email, $content);
        break;
    case 'edit_data':
        $id = $_GET['id'];
        $news_id = $_GET['news_id'];
        $name = $_GET['name'];
        $email = $_GET['email'];
        $content = $_GET['content'];

        $data['status'] = editData($id, $news_id, $name, $email, $content);
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

    $query = "select id, news_id, name, email, content from comments where is_deleted = false ";
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

function insertData($news_id, $name, $email, $content){
    $conn = getConnection();
    $query = "insert into comments
                (news_id, name, email, content)
                value 
                (:news_id, :name, :email, :content)";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":news_id" => $news_id,
        ":name" => $name,
        ":email" => $email,
        ":content" => $content
    ]);
    closeConnection($conn);
    return $result;
}

function editData($id, $news_id, $name, $email, $content){
    $conn = getConnection();
    $query = "
        UPDATE comments SET
          news_id = :news_id,
          name = :name,
          email = :email,
          content = :content
        WHERE 
          id = :id ";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":id" => $id,
        ":news_id" => $news_id,
        ":name" => $name,
        ":email" => $email,
        ":content" => $content
    ]);
    closeConnection($conn);
    return $result;
}

function removeData($id){
    $conn = getConnection();
    $query = "UPDATE comments SET
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
