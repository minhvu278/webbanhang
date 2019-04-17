<?php
include 'service.php';

$mode = $_GET['mode'];

switch ($mode){
    case 'get_data':
        $data['data'] = getData();
        $data['status'] = true;
        break;
    case 'insert_data':
        $name = $_GET['name'];
        $email = $_GET['email'];
        $password = $_GET['password'];
        $role = $_GET['role'];
        $avatar = $_GET['avatar'];
        $address = $_GET['address'];

        $data['status'] = insertData($name, $email, $password, $role, $avatar, $address);
        break;
    case 'edit_data':
        $id = $_GET['id'];
        $name = $_GET['name'];
        $email = $_GET['email'];
        $password = $_GET['password'];
        $role = $_GET['role'];
        $avatar = $_GET['avatar'];
        $address = $_GET['address'];

        $data['status'] = editData($id, $name, $email, $password, $role, $avatar, $address);
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

    $query = "select id, name, email, password, role, avatar, address from users where is_deleted = false ";
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

function insertData($name, $email, $password, $role, $avatar, $address){
    $conn = getConnection();
    $query = "insert into users
                (name, email, password, role, avatar, address)
                value 
                (:name, :email, :password, :role, :avatar, :address)";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":name" => $name,
        ":email" => $email,
        ":password" => $password,
        ":role" => $role,
        ":avatar" => $avatar,
        ":address" => $address
    ]);
    closeConnection($conn);
    return $result;
}

function editData($id, $name, $email, $password, $role, $avatar, $address){
    $conn = getConnection();
    $query = "
        UPDATE users SET
          name = :name,
          email = :email,
          password = :password,
          role = :role,
          avatar = :avatar,
          address = :address
        WHERE 
          id = :id ";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":id" => $id,
        ":name" => $name,
        ":email" => $email,
        ":password" => $password,
        ":role" => $role,
        ":avatar" => $avatar,
        ":address" => $address
    ]);
    closeConnection($conn);
    return $result;
}

function removeData($id){
    $conn = getConnection();
    $query = "UPDATE users SET
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
