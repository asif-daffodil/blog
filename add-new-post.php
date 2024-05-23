<?php
require_once "header.php";
// get categories
$allCat = $conn->query("SELECT * FROM categories");
$allCats = $allCat->fetch_all(MYSQLI_ASSOC);
?>
<div class="container-fluid">
    <div class="row d-flex position-fixed w-100">
        <div style="width: 200px;" class="min-vh-100 bg-dark col-1">
            <?php include_once('./components/adminSidebar.php') ?>
        </div>
        <div class="col flex-grow-1">
            <div class="row">
                <div class="col-md-6">
                    <h2>Add New Post</h2>
                    <form action="./all-post.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="text" placeholder="Post Title" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <select name="category" id="" class="form-control" required>
                                <option value="">--Select Category--</option>
                                <?php foreach ($allCats as $cat) { ?>
                                    <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <textarea name="details" id="" cols="30" rows="10" class="form-control" placeholder="Post Details"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">
                                Featured Image
                                <input type="file" name="img" class="form-control" required>
                            </label>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Add Post" class="btn btn-dark" name="add-post">
                        </div>
                    </form>
                </div>
            </div>
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
<?php
require_once "footer.php";
?>