<?php
require_once "header.php";
if (!isset($_SESSION['email'])) {
    header("location: ./signin.php");
}

$id = $_GET['pid'] ?? header("location: ./all-post.php");
$getPost = $conn->query("SELECT * FROM posts WHERE id='$id'");
$post = $getPost->num_rows > 0 ? $getPost->fetch_object() : header("location: ./all-post.php");

$allCatQuery = $conn->query("SELECT * FROM categories");
$allCats = $allCatQuery->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['update-post'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $category = $conn->real_escape_string($_POST['category']);
    $details = $conn->real_escape_string($_POST['details']);
    $img = $_FILES['img']['name'];
    $imgTmp = $_FILES['img']['tmp_name'];
    $imgExt = pathinfo($img, PATHINFO_EXTENSION);
    $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

    // Check if image exists in the request
    if (!empty($img)) {
        // Delete previous image
        $prevImg = $post->img;
        if (!empty($prevImg)) {
            unlink("./images/blog/$prevImg");
        }

        // Upload new image
        if (in_array($imgExt, $allowedExt)) {
            $newImg = uniqid() . ".$imgExt";
            move_uploaded_file($imgTmp, "./images/blog/$newImg");
        } else {
            echo "<script>toastr.error('Invalid Image Format')</script>";
            exit;
        }
    }

    // Update the database
    $updatePost = $conn->query("UPDATE posts SET title='$title', category_id='$category', details='$details'" . (!empty($img) ? ", img='$newImg'" : "") . " WHERE id='$id'");
    if ($updatePost) {
        echo "<script>toastr.success('Post Updated')</script>";
        echo "<script>setTimeout(()=> location.href='./all-post.php', 2000)</script>";
    } else {
        echo "<script>toastr.error('Post not updated')</script>";
    }
}

?>
<div class="container-fluid">
    <div class="row">
        <div style="width: 200px;" class="min-vh-100 bg-dark col-1">
            <?php include_once('./components/adminSidebar.php') ?>
        </div>
        <div class="col-md-6">
            <h2 class="my-4">Edit Post</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" placeholder="Post Title" name="title" class="form-control" required value="<?= $post->title ?>">
                </div>
                <div class="mb-3">
                    <select name="category" id="" class="form-control" required>
                        <option value="">--Select Category--</option>
                        <?php foreach ($allCats as $cat) { ?>
                            <option value="<?= $cat['id'] ?>" <?= $post->category_id == $cat['id'] ? 'selected' : null ?>><?= $cat['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <textarea name="details" id="" cols="30" rows="10" class="form-control" placeholder="Post Details">
                        <?= $post->details ?>
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="fi">
                        <h2>Featured Image</h2>
                        <img src="./images/blog/<?= $post->img ?>" alt="" class="img-fluid" style="max-height:100px">
                        <input type="file" name="img" class="form-control d-none" id="fi">
                    </label>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Update Post" class="btn btn-dark" name="update-post">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.4.2/ckeditor.min.js" integrity="sha512-z5R1qDiHpqoswJJOldglYtCSpaDg3JUEoZL/M/4LDCL6XUwB2cHmCtzCXWcCbA3CCuGxTCxdKA9ybTJu2zqTng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    ClassicEditor
        .create(document.querySelector('textarea'))
        .catch(error => {
            console.error(error);
        });
</script>