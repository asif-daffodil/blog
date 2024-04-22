<?php
$filename = basename($_SERVER['PHP_SELF'])
?>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Batch 234</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $filename === 'index.php' ? 'active' : null ?>" aria-current="page" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $filename === 'about.php' ? 'active' : null ?>" href="./about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $filename === 'blog.php' ? 'active' : null ?>" href="./blog.php">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $filename === 'contact.php' ? 'active' : null ?>" href="./contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $filename === 'signin.php' ? 'active' : null ?>" href="./signin.php">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $filename === 'signup.php' ? 'active' : null ?>" href="./signup.php">Sign Up</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Update Profile</a></li>
                        <li><a class="dropdown-item" href="#">Profile Picture</a></li>
                        <li><a class="dropdown-item" href="#">Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="./signout.php">Sign out</a></li>
                    </ul>
                </li>
            </ul>
            <div>
                <form action="./search.php" class="d-flex input-group" role="search">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</nav>