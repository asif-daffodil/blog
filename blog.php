<?php
require_once "header.php";
$pageno = $_GET['pageno'] ?? header("location: ./blog.php?pageno=1");
$selectQyery = $conn->query("SELECT * FROM posts");
$totalPost = $selectQyery->num_rows;
$limitPerPage = 6;
$totalPage = ceil($totalPost / $limitPerPage);
$offset = ($pageno - 1) * $limitPerPage;
$getPost = $conn->query("SELECT * FROM posts ORDER BY id DESC LIMIT $offset, $limitPerPage");
$posts = $getPost->fetch_all(MYSQLI_ASSOC);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Blog Page</h1>
        </div>
        <?php foreach ($posts as $post) { ?>
            <div class="col-md-4 p-3">
                <div class="card">
                    <img src="./images/blog/<?= $post['img'] ?>" class="card-img-top" alt="<?= $post['title'] ?>" style="height:320px; width:100%; object-fit: cover">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post['title'] ?></h5>
                        <p class="card-text"><?= substr($post['details'], 0, 100) ?>...</p>
                        <a href="./single-post.php?pid=<?= $post['id'] ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $pageno <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="./blog.php?pageno=<?= $pageno - 1 ?>">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPage; $i++) { ?>
                        <li class="page-item <?= $pageno == $i ? 'active' : '' ?>">
                            <a class="page-link" href="./blog.php?pageno=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php } ?>
                    <li class="page-item <?= $pageno >= $totalPage ? 'disabled' : '' ?>">
                        <a class="page-link" href="./blog.php?pageno=<?= $pageno + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <?php
    require_once "footer.php";
    ?>