<?php
require_once "header.php";
try {
    $img = !empty($userInfo->img) ? $userInfo->img : "demoProfile.png";
} catch (Exception $e) {
    echo $e->getMessage();
}

if (isset($_POST['upProImg'])) {
    $img = $_FILES['img'];
    $imgName = $img['name'];
    $imgTmp = $img['tmp_name'];
    $imgSize = $img['size'];
    $imgError = $img['error'];
    $imgExt = explode(".", $imgName);
    $imgActualExt = strtolower(end($imgExt));
    $allowed = ["jpg", "jpeg", "png"];
    if (in_array($imgActualExt, $allowed)) {
        if ($imgError === 0) {
            if ($imgSize < 5000000) {
                $imgNewName = uniqid("", true) . "." . $imgActualExt;
                $imgDestination = "./images/profilepicture/$imgNewName";
                if (!empty($userInfo->img)) {
                    unlink("./images/profilepicture/$userInfo->img");
                }
                move_uploaded_file($imgTmp, $imgDestination);
                $updateImg = $conn->query("UPDATE users SET img='$imgNewName' WHERE email='$email'");

                if ($updateImg) {
                    echo "<script>toastr.success('Profile Picture updated')</script>";
                    udata();
                    echo "<script>setTimeout(()=> location.href='profile-picture.php', 2000)</script>";
                } else {
                    echo "<script>toastr.error('Profile Picture not updated')</script>";
                }
            } else {
                echo "<script>toastr.error('Image size is too large')</script>";
            }
        } else {
            echo "<script>toastr.error('There was an error uploading your image')</script>";
        }
    } else {
        echo "<script>toastr.error('You cannot upload files of this type')</script>";
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Profile Picture</h1>
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- upload image -->
                        <div class="mb-3">
                            <label for="img" class="form-label">Profile Picture</label>
                            <input type="file" name="img" id="img" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="upProImg">Update Profile Picture</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <img src="<?= "./images/profilepicture/" . htmlspecialchars($img) ?>" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once "footer.php";
    ?>