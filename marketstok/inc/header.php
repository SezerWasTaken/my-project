<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold pb-2" href="http://localhost/marketstok/urunler.php">Şeker Market</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav fw-medium me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="hover nav-link active" aria-current="page" href="http://localhost/marketstok/urunler.php">Urunler</a>
                </li>
                <?php if (isset($_SESSION["user_id"])) { ?>
                    <li class="nav-item">
                        <a class="hover nav-link" aria-current="page" href="http://localhost/marketstok/urunekle.php">Ürün Ekle</a>
                    </li>
                    <li class="nav-item">
                        <a class="hover nav-link" aria-current="page" href="http://localhost/marketstok/urundetay/urundetay.php">Ürün Detay</a>
                    </li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav fw-medium mx-4 mb-2 mb-lg-0 gap-2">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#exampleModal" href=""><i class="fa-solid fa-basket-shopping fs-4"></i></a>
                </li>
                <?php if (isset($_SESSION["user_mail"])) { ?>
                    <li class="nav-item mt-1">
                        <a class="hover nav-link active fw-semibold" aria-current="page" href="http://localhost/marketstok/oturum/login.php"><i class="fa-solid fa-user mx-2"></i><?php
                                                                                                                                                                                    echo $_SESSION["user_mail"]; ?></a>
                    </li>
                <?php
                } else { ?>
                    <li class="nav-item mt-1">
                        <a class="hover nav-link active fw-semibold" aria-current="page" href="http://localhost/marketstok/oturum/register.php"><i class="fa-solid fa-user-plus mx-2"></i>Kayıt Ol</a>
                    </li>
                    <li class="nav-item mt-1">
                        <a class="hover nav-link active fw-semibold" aria-current="page" href="http://localhost/marketstok/oturum/login.php"><i class="fa-solid fa-user mx-2"></i>Giriş</a>
                    </li>
                <?php } ?>
            </ul>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Sepetindekiler</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item">A list item</li>
                                <li class="list-group-item">A list item</li>
                                <li class="list-group-item">A list item</li>
                            </ol>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="searchInput">
            </form>
        </div>
    </div>
</nav>