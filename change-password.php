<?php
require_once "header.php";
if (!isset($_SESSION['email'])) {
    header("location: ./signin.php");
}
if (isset($_POST['changePassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $checkEmail = $conn->query($sql);
    if ($checkEmail->num_rows > 0) {
        $row = $checkEmail->fetch_object();
        if (password_verify($oldPassword, $row->password)) {
            if ($newPassword === $confirmPassword) {
                $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updatePassword = $conn->query("UPDATE users SET password='$newPassword' WHERE email='$email'");
                if ($updatePassword) {
                    echo "<script>toastr.success('Password updated')</script>";
                    echo "<script>setTimeout(()=> location.href='change-password.php', 2000)</script>";
                } else {
                    echo "<script>toastr.error('Password not updated')</script>";
                }
            } else {
                echo "<script>toastr.error('New Password and Confirm Password do not match')</script>";
            }
        } else {
            echo "<script>toastr.error('Invalid password')</script>";
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Change Password</h1>
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="oldPassword" class="form-label">Old Password</label>
                            <input type="password" name="oldPassword" id="oldPassword" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" name="newPassword" id="newPassword" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="changePassword" class="btn btn-primary" value="Change Password">
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