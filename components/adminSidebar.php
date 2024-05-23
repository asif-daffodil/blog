<ul class="nav flex-column adminSidebar">
    <li class="nav-item">
        <a class="nav-link <?= $pageName == 'dashboard.php' ? 'fw-bold text-white' : 'text-secondary' ?>" href="dashboard.php">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $pageName == 'category.php' ? 'fw-bold text-white' : 'text-secondary' ?>" href="category.php">Category</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $pageName == 'all-post.php' || $pageName == 'add-new-post.php' ? 'fw-bold text-white' : 'text-secondary' ?>" href="javascript:void(0)">Post &rAarr;</a>
        <ul class="subMenu">
            <li><a href="all-post.php">All Post</a></li>
            <li><a href="add-new-post.php">Add New Post</a></li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./">View Website</a>
    </li>
</ul>