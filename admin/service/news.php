<?php
include 'service.php';

$mode = $_REQUEST['mode'];

switch ($mode) {
    case 'get_data':
        $data['data'] = getData();
        $data['status'] = true;
        break;
    case 'insert_data':
        $author_id = $_REQUEST['author_id'];
        $cat_id = $_REQUEST['cat_id'];
        $title = $_REQUEST['title'];
        $images = $_REQUEST['images'];
        $content = $_REQUEST['content'];
        $view = $_REQUEST['view'];

        $data['status'] = insertData($author_id, $cat_id, $title, $images,$content, $view);
        break;
    case 'edit_data':
        $id = $_GET['id'];
        $author_id = $_GET['author_id'];
        $cat_id = $_GET['cat_id'];
        $title = $_GET['title'];
        $images = $_GET['images'];
        $content = $_GET['content'];
        $view = $_GET['view'];
//        editData($id, $author_id, $cat_id, $title, $images, $content, $view)
        $data['status'] = editData($id, $author_id, $cat_id, $title, $images, $content, $view);
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

function getData()
{
    $conn = getConnection();
    if ($conn == null) {
        echo "Co loi xay ra";
        die();
    }

    $query = "select  
	news.id, news.author_id, au.name as 'author_name',
    news.cat_id, cat.name as 'category_name', 
    news.title, news.images, news.content, news.view,
    news.display_content 
from news
	JOIN author as au on news.author_id = au.id
    JOIN category as cat on news.cat_id = cat.id
where
	news.is_deleted = false 
	AND cat.is_deleted = false
    AND au.is_deleted = false  ";
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

function insertData($author_id, $cat_id, $title, $images, $content, $view)
{
    $conn = getConnection();
    $query = "insert into news
                (author_id, cat_id, title, images, content, view)
                value 
                (:author_id, :cat_id, :title, :images,:content, :view)";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":author_id" => $author_id,
        ":cat_id" => $cat_id,
        ":title" => $title,
        ":images" => $images,
        ":content" => $content,
        ":view" => $view,

    ]);
    closeConnection($conn);
    return $result;
}

function editData($id, $author_id, $cat_id, $title, $images, $content, $view)
{
    $conn = getConnection();
    $query = "
        UPDATE news SET
          author_id = :author_id,
          cat_id = :cat_id,
          title = :title,
          images = :images,
          content = :content,
          view = :view
        WHERE 
          id = :id ";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([
        ":id" => $id,
        ":author_id" => $author_id,
        ":cat_id" => $cat_id,
        ":title" => $title,
        ":images" => $images,
        ":content" => $content,
        ":view" => $view
    ]);
    closeConnection($conn);
    return $result;
}

function removeData($id)
{
    $conn = getConnection();
    $query = "UPDATE news SET
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
