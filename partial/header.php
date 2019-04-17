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

$categories = getData();
?>
<!-- Header -->
<header id="header">
    <!-- Nav -->
    <div id="nav">
        <!-- Main Nav -->
        <div id="nav-fixed">
            <div class="container">
                <!-- logo -->
                <div class="nav-logo">
                    <a href="index.php" class="logo"><img src="http://goldidea.com.vn/upload/images/24h.jpg" alt="" style="
    width: 200px;
    height: 100px;
"></a>
                </div>
                <!-- /logo -->

                <!-- nav -->
                <ul class="nav-menu nav navbar-nav">
                    <?php
                        foreach ($categories as $cate){
                            echo "<li><a href=\"category.php?id={$cate['id']}\">{$cate['name']}</a></li>";
                        }
                    ?>
                </ul>
                <!-- /nav -->

                <!-- search & aside toggle -->
                <div class="nav-btns">
                    <button class="aside-btn"><i class="fa fa-bars"></i></button>
                    <button class="search-btn"><i class="fa fa-search"></i></button>
                    <div class="search-form">
                        <input class="search-input" type="text" name="search" placeholder="Enter Your Search ...">
                        <button class="search-close"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /search & aside toggle -->
            </div>
        </div>
        <!-- /Main Nav -->

        <!-- Aside Nav -->
        <div id="nav-aside">
            <!-- nav -->
            <div class="section-row">
                <ul class="nav-aside-menu">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="#">Join Us</a></li>
                    <li><a href="#">Advertisement</a></li>
                    <li><a href="contact.html">Contacts</a></li>
                </ul>
            </div>
            <!-- /nav -->

            <!-- widget posts -->
            <div class="section-row">
                <h3>Recent Posts</h3>
                <div class="post post-widget">
                    <a class="post-img" href="blog-post.html"><img src="./theme/img/widget-2.jpg" alt=""></a>
                    <div class="post-body">
                        <h3 class="post-title"><a href="blog-post.html">Pagedraw UI Builder Turns Your Website Design Mockup Into Code Automatically</a></h3>
                    </div>
                </div>

                <div class="post post-widget">
                    <a class="post-img" href="blog-post.html"><img src="./theme/img/widget-3.jpg" alt=""></a>
                    <div class="post-body">
                        <h3 class="post-title"><a href="blog-post.html">Why Node.js Is The Coolest Kid On The Backend Development Block!</a></h3>
                    </div>
                </div>

                <div class="post post-widget">
                    <a class="post-img" href="blog-post.html"><img src="./theme/img/widget-4.jpg" alt=""></a>
                    <div class="post-body">
                        <h3 class="post-title"><a href="blog-post.html">Tell-A-Tool: Guide To Web Design And Development Tools</a></h3>
                    </div>
                </div>
            </div>
            <!-- /widget posts -->

            <!-- social links -->
            <div class="section-row">
                <h3>Follow us</h3>
                <ul class="nav-aside-social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div>
            <!-- /social links -->

            <!-- aside nav close -->
            <button class="nav-aside-close"><i class="fa fa-times"></i></button>
            <!-- /aside nav close -->
        </div>
        <!-- Aside Nav -->
    </div>
    <!-- /Nav -->

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <ul class="page-header-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li><?php echo getTitle()?></li>
                    </ul>
                    <h1><?php
                        echo getTitle()
                        ?></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
</header>
<!-- /Header -->