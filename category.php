<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include 'partial/header_script.php';
    ?>
    <title>Website tin tức</title>

</head>
<body>
<?php

include 'partial/header.php';

function getCategoryById($id)
{
    $conn = getConnection();

    if ($conn == null) {
        echo "Co loi xay ra";
        die();
    }

    $query = "select id, name, url, note FROM category WHERE id = $id AND is_deleted = false";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        return $row;
    }

    closeConnection($conn);
    return false;
}
function getNewsByCategory($cat_id)
{
    $conn = getConnection();
    if ($conn == null) {
        echo "Co loi xay ra";
        die();
    }

    $query = "select  
	news.id, news.author_id, au.name as 'author_name',
    news.cat_id, cat.name as 'category_name', 
    news.title, news.images, news.content, news.view 
from news
	JOIN author as au on   news.author_id = au.id
    JOIN category as cat on news.cat_id = cat.id
where
	news.is_deleted = false 
	AND cat.is_deleted = false
    AND au.is_deleted = false  
    AND cat.id = $cat_id";
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


function getCategorySummary()
{
    $conn = getConnection();
    if ($conn == null) {
        echo "Co loi xay ra";
        die();
    }

    $query = "SELECT 
	cat_id, cat.name as cat_name, count(news.id) as total
FROM news
	join category as cat on cat.id = news.cat_id
WHERE
	news.is_deleted = false
 AND cat.is_deleted = false
GROUP by cat_id";
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

$id = $_GET['id'];
$cat_id = $_GET['id'];
$category = getCategoryById($id);
$news = getNewsByCategory($cat_id);
$catSummary = getCategorySummary();

function getTitle()
{
    $id = $_GET['id'];
    $category = getCategoryById($id);
    if ($category) {
        return $category['name'];
    }

    return "";
}

?>


<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                <div class="row">

                    <?php

                    if ($news) {
                        foreach ($news as $new) {
                            echo '<div class="col-md-12">';
                            echo '<div class="post post-row">';
                            echo "<a class=\"post-img\" href=\"news.php?id={$new['id']}\"><img src=\"{$new['images']}\" alt=\"\"></a>";
                            echo '<div class="post-body">';
                            echo '<div class="post-meta">';
                            echo "<a class=\"post-category cat-2\" href=\"category.php?id={$new['cat_id']}\">{$new['category_name']}</a>";
                            echo "<span class=\"post-date\">March 27, 2018</span>";

                            echo '</div>';
                            echo "<h3 class=\"post-title\"><a href=\"news.php?id={$new['id']}\">{$new['title']}</a></h3>";
                            echo "<p>{$new['content']}</p>";

                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<h3>Danh mục này chưa có bài viết nào</h3>';
                    }




                    ?>

                    <!-- /post -->

                    <div class="col-md-12">
                        <div class="section-row">
                            <button class="primary-button center-block">Load More</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- ad -->
                <div class="aside-widget text-center">
                    <a href="#" style="display: inline-block;margin: auto;">
                        <img class="img-responsive" src="theme/img/ad-1.jpg" alt="">
                    </a>
                </div>
                <!-- /ad -->

                <!-- catagories -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2>Danh mục tin tức</h2>
                    </div>
                    <div class="category-widget">
                        <ul>
                            <?php
                            $cssClass = ['cat-1', 'cat-2', 'cat-3', 'cat-4'];
                            foreach ($catSummary as $catSum) {
                                $cssIndex = $catSum['cat_id'] % 4;
                                echo "<li><a href=\"category.php?id={$catSum['cat_id']}\" class=\"{$cssClass[$cssIndex]}\">{$catSum['cat_name']}<span>{$catSum['total']}</span></a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- /catagories -->

                <!-- tags -->
                <div class="aside-widget">
                    <div class="tags-widget">
                        <ul>
                            <?php
                            foreach ($catSummary as $catSum) {
                                echo "<li><a href=\"#\">{$catSum['cat_name']}</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- /tags -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->

<?php
include 'partial/footer.php';
include 'partial/footer_script.php';
?>
</body>
</html>
