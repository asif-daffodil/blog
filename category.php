<?php
require_once "header.php";
$allCatData = $conn->query("SELECT * FROM categories");
$allCat = $allCatData->fetch_all(MYSQLI_ASSOC);
?>
<div class="container-fluid">
    <div class="row d-flex position-fixed w-100">
        <div style="width: 200px;" class="min-vh-100 bg-dark col-1">
            <?php include_once('./adminSidebar.php') ?>
        </div>
        <div class="col flex-grow-1">
            <div class="row">
                <div class="col-md-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>