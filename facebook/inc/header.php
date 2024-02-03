<nav class="navbar sticky-top navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Facebook</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/facebook/index.php">Ana Sayfa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/facebook/post/postekle.php">Post Ekle</a>
                </li>
            </ul>
            <a href="/facebook/oturum/register.php" class="btn btn-outline-light me-2" type="button">Kayıt Ol</a>
            <a href="/facebook/oturum/login.php" class="btn btn-outline-light me-2" type="button">Giriş yap</a>
            <form class="d-flex" role="search" action="ara.php" method="get">
                <input class="form-control me-2" name="ara" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-dark text-white" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>