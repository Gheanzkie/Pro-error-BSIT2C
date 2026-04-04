<nav class="main-header navbar navbar-expand navbar-warning navbar-dark" style="background-color: #343a40;" id="mainNavbar">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link text-white">
                Home
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link text-white" href="#" id="themeToggle">
                <i class="fas fa-sun"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <?= session()->get('name') ?> 
                <i class="far fa-user-circle ml-1"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" href="<?= base_url('/logout') ?>">
                Logout <i class="fa fa-sign-out-alt fa-fw"></i>
            </a>
        </li>
    </ul>
</nav>