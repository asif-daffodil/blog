<?php
require_once "header.php";
if (!isset($_SESSION['email'])) {
    header("location: ./signin.php");
}

$id = $_GET['pid'] ?? header("location: ./all-post.php");
$getPost = $conn->query("SELECT * FROM posts WHERE id='$id'");
$post = $getPost->num_rows > 0 ? $getPost->fetch_object() : header("location: ./all-post.php");

if (isset($_POST['delete-post'])) {
    $img = $post->img;
    if (!empty($img)) {
        unlink("./images/blog/$img");
    }
    $deletePost = $conn->query("DELETE FROM posts WHERE id='$id'");
    if ($deletePost) {
        echo "<script>toastr.success('Post Deleted')</script>";
        echo "<script>setTimeout(()=> location.href='./all-post.php', 2000)</script>";
    } else {
        echo "<script>toastr.error('Post not deleted')</script>";
    }
}

?>
<div class="container-fluid">
    <div class="row">
        <div style="width: 200px;" class="min-vh-100 bg-dark col-1">
            <?php include_once('./components/adminSidebar.php') ?>
        </div>
        <div class="col-md-6">
            <h2 class="my-4">Delete Post</h2>
            <h3 class="text-danger">
                Do you realy want to delete the post?
            </h3>
            <form action="" method="post" class="d-inline me-1">
                <input type="submit" name="delete-post" class="btn btn-danger" value="Yes">
            </form>
            <a href="./all-post.php" class="btn btn-success">No</a>
        </div>
    </div>
</div>