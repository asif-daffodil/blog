<?php
require_once "header.php";
if (!isset($_SESSION['email'])) {
    header("location: ./signin.php");
}

if (isset($_POST['upPro'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    $update = $conn->query("UPDATE users SET name='$name', dob='$dob', gender='$gender' WHERE email='$email'");
    if ($update) {
        echo "<script>toastr.success('Profile updated')</script>;setTimeout(()=> location.href='update-profile', 2000)";
    } else {
        echo "<script>toastr.error('Profile not updated')</script>";
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Update Profile</h1>
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= $userInfo->name ?? null ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $userInfo->email ?? null ?>" readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="<?= $userInfo->dob ?? null ?>" required>
                        </div>
                        <!-- gender -->
                        <div class="mb-3">
                            <label for="" class="form-check-label">Gender</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="male" name="gender" value="Male" <?= isset($userInfo->gender) && $userInfo->gender == "Male" ? "checked" : null ?>>
                                <label for="male" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="female" name="gender" value="Female" <?= isset($userInfo->gender) && $userInfo->gender == "Female" ? "checked" : null ?>>
                                <label for="female" class="form-check-label">Female</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="upPro">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>