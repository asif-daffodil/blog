<?php
require_once "header.php";
require_once "./components/homeComponents/slider/slider.php";
// select latest 3 post from posts table
$getPost = $conn->query("SELECT * FROM posts ORDER BY id DESC LIMIT 3");
// conver into Associative array
$posts = $getPost->fetch_all(MYSQLI_ASSOC);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Latest Post</h1>
        </div>
        <?php
        foreach ($posts as $post) {
        ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="./images/blog/<?= $post['img'] ?>" class="card-img-top" alt="<?= $post['title'] ?>" style="height:320px; width:100%; object-fit: cover">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post['title'] ?></h5>
                        <p class="card-text"><?= substr($post['details'], 0, 130) ?>...</p>
                        <a href="./single-post.php?pid=<?= $post['id'] ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php
require_once "footer.php";
?>