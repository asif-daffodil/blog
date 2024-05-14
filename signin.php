<?php
require_once "header.php";
if (isset($_SESSION['email'])) {
    header("location: ./");
}

if (isset($_POST['sign123'])) {
    $uemail = $_POST['uemail'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email='$uemail'";
    $checkEmail = $conn->query($sql);
    if ($checkEmail->num_rows > 0) {
        $row = $checkEmail->fetch_object();
        if (password_verify($password, $row->password)) {
            $_SESSION['email'] = $uemail;
            $_SESSION['name'] = $row->name;
            $_SESSION['img'] = $row->img;
            $_SESSION['role'] = $row->role;
            echo "<script>toastr.success('login successful');setTimeout(()=> location.href='index.php', 2000)</script>";
        } else {
            echo "<script>toastr.error('Invalid password')</script>";
        }
    }
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto mt-5 p-4 border rounded shadow">
            <h1 class="mb-2">Sign In</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <input type="email" name="uemail" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Your Password" required>
                </div>
                <div class="mb-3">
                    <input type="submit" name="sign123" class="btn btn-primary" value="Sign In">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once "footer.php";
?>