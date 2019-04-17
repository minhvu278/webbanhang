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
function getTitle(){
    return "Tin tức";
}

include 'partial/header.php';


$id = $_GET['id'];
function getSingleNews($id)
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
    news.created_time
from news
	JOIN author as au on news.author_id = au.id
    JOIN category as cat on news.cat_id = cat.id
where
	news.is_deleted = false 
	AND cat.is_deleted = false
    AND au.is_deleted = false
    AND news.id =  $id ";
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

$new = getSingleNews($id);

$newItem = $new[0];
$catSummary = getCategorySummary();

?>

<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Post content -->
            <div class="col-md-8">
                <div class="section-row sticky-container">
                    <div class="main-post">
                        <h3><?php echo $newItem['title'] ?></h3>
                        <?php echo $newItem['content'] ?>
                    </div>
                    <div class="post-shares sticky-shares">
                        <a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
                        <a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>

                <!-- ad -->
                <div class="section-row text-center">
                    <a href="#" style="display: inline-block;margin: auto;">
                        <img class="img-responsive" src="./img/ad-2.jpg" alt="">
                    </a>
                </div>
                <!-- ad -->


            </div>
            <!-- /Post content -->

            <!-- aside -->
            <div class="col-md-4">
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

                <!-- archive -->
                <div class="aside-widget">
                    <div class="section-title">
                        <h2>Archive</h2>
                    </div>
                    <div class="archive-widget">
                        <ul>
                            <li><a href="#">January 2018</a></li>
                            <li><a href="#">Febuary 2018</a></li>
                            <li><a href="#">March 2018</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /archive -->
            </div>
            <!-- /aside -->
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



