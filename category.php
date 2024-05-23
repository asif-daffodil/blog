<?php
require_once "header.php";
function getCatData()
{
    global $conn;
    $allCatData = $conn->query("SELECT * FROM categories");
    return $allCatData->fetch_all(MYSQLI_ASSOC);
}

$allCat = getCatData();

if (isset($_POST['addCat'])) {
    $catname = $_POST['catname'];
    $token = $_POST['token'];
    $checkToken = $conn->query("SELECT * FROM `token` WHERE `name`='$token'");
    if ($checkToken->num_rows > 0) {
        echo "<script>toastr.error('Category Already Added')</script>";
    } else {
        $conn->query("INSERT INTO `token` (`name`) VALUES ('$token')");
        $conn->query("INSERT INTO categories (`name`) VALUES ('$catname')");
        echo "<script>toastr.success('Category Added')</script>";
        $allCat = getCatData();
    }
}
if (isset($_POST['editCat'])) {
    $catname = $_POST['catname'];
    $catId = $_GET['eid'];
    $conn->query("UPDATE categories SET `name`='$catname' WHERE id='$catId'");
    echo "<script>toastr.success('Category Updated'); setTimeout(()=> location.href='category.php',2000)</script>";
}
if (isset($_POST['deleteCat'])) {
    $catId = $_GET['did'];
    $conn->query("DELETE FROM categories WHERE id='$catId'");
    echo "<script>toastr.success('Category Deleted'); setTimeout(()=> location.href='category.php',2000)</script>";
}
?>
<div class="container-fluid">
    <div class="row d-flex position-fixed w-100">
        <div style="width: 200px;" class="min-vh-100 bg-dark col-1">
            <?php include_once('./components/adminSidebar.php') ?>
        </div>
        <div class="col flex-grow-1">
            <?php if (!isset($_GET['eid']) && !isset($_GET['did'])) { ?>
                <div class="row">
                    <div class="col-md-6">
                        <h1>Categories</h1>
                        <form action="" method="post">
                            <input type="hidden" value="<?= uniqid() ?>" name="token">
                            <div class="mb-3">
                                <input type="text" required name="catname" class="form-control" placeholder="Category Name">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="addCat" class="btn btn-primary">Add Category</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <table>
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($allCat as $cat) {
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $cat['name'] ?></td>
                                        <td>
                                            <a href="category.php?eid=<?= $cat['id'] ?>">Edit</a>
                                            <a href="category.php?did=<?= $cat['id'] ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($_GET['eid'])) { ?>
                <div class="row">
                    <div class="col-md-6">
                        <h1>Edit Category</h1>
                        <?php
                        $catId = $_GET['eid'];
                        $getCatData = $conn->query("SELECT * FROM categories WHERE id='$catId'");
                        $catData = $getCatData->fetch_object();
                        ?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <input type="text" required name="catname" value="<?= $catData->name ?>" class="form-control" placeholder="Category Name">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="editCat" class="btn btn-primary">Edit Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($_GET['did'])) {
            ?>
                <div class="row">
                    <div class="col-md-6 py-3">
                        Do you want to delete this category?
                        <form action="" method="post" class="d-inline">
                            <button type="submit" name="deleteCat" class="btn btn-danger">Yes</button>
                        </form>
                        <a href="category.php" class="btn btn-success ">No</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>