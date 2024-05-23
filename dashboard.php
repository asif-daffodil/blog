<?php
require_once "header.php";
?>
<div class="container-fluid">
    <div class="row d-flex position-fixed w-100">
        <div style="width: 200px;" class="min-vh-100 bg-dark col-1">
            <?php include_once('./components/adminSidebar.php') ?>
        </div>
        <div class="col flex-grow-1">
            Dashboard
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>