<?php
require_once "header.php";
$pid = $_GET['pid'] ?? header("location: ./blog.php");
$getPost = $conn->query("SELECT * FROM posts WHERE id='$pid'");
$post = $getPost->num_rows > 0 ? $getPost->fetch_object() : header("location: ./blog.php");

// get 4 random post
$getPost = $conn->query("SELECT * FROM posts ORDER BY RAND() LIMIT 4");
$randomPosts = $getPost->fetch_all(MYSQLI_ASSOC);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="./images/blog/<?= $post->img ?>" class="img-fluid shadow" alt="<?= $post->title ?>">
        </div>
        <div class="col-md-6 py-3">
            <h1><?= $post->title ?></h1>
            <p class="mt-3"><?= $post->details ?></p>
        </div>
        <div class="col-md-2">
            <h3>Random Posts</h3>
            <?php foreach ($randomPosts as $rPost) { ?>
                <div class="card mb-3">
                    <img src="./images/blog/<?= $rPost['img'] ?>" class="card-img-top" alt="<?= $rPost['title'] ?>" style="height: 100px; object-fit: cover">
                    <div class="card-body">
                        <h5 class="card-title"><?= $rPost['title'] ?></h5>
                        <a href="./single-post.php?pid=<?= $rPost['id'] ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>