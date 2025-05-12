<style>
    .navbar-nav a,
    .navbar-nav .nav-item .nav-link {
        font-size: 19px;
        /* Ajusta el valor según tus preferencias */
    }
</style>
<nav class="navbar navbar-expand-lg" style="background-color:#000975e0">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="../diseño/img/logo.png" style="width: 50px;" alt="">
        </a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <div class="navbar-toggler"><img src="../diseño/img/lista1.png" alt="lista" width="25px"></div>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <?php
            $rol = $_SESSION['rol'];
            if ($rol == 1) {
            ?>
                <ul class="navbar-nav ml-auto">
                    <!-- Usuario  -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">
                            Usuario
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="./usuario.php" class="dropdown-item">Registrar Usuario</a>
                            </li>
                            <li>
                                <a href="./lista_usuario.php" class="dropdown-item">Lista de Usuarios</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Entidad -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">
                            Entidad
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="./entidad.php" class="dropdown-item">Registrar Entidad</a>
                            </li>
                            <li class="dropend">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">Lista de entidades</a>
                                <ul class="dropdown-menu">
                                    <li><a href="./lista_entidad.php" class="dropdown-item">Lista de personas con Ruc</a></li>
                                    <li><a href="./lista_natural.php" class="dropdown-item">Lista de personas con Dni</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Compra -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">
                            Compra
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="./compra.php" class="dropdown-item">Registrar Compra</a>
                            </li>
                            <li>
                                <a href="./lista_compra.php" class="dropdown-item">Lista de Compra</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Menu de productos -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">
                            Productos
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="./categoria.php">Categoria</a>
                            </li>
                            <li class="dropend">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">Subcategoria</a>
                                <ul class="dropdown-menu">
                                    <li><a href="subcategoria.php" class="dropdown-item">Registrar subcategoria</a></li>
                                    <li><a href="lista_subcategoria.php" class="dropdown-item">Lista de subcategorias</a></li>
                                </ul>
                            </li>
                            <li class="dropend">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">Marca</a>
                                <ul class="dropdown-menu">
                                    <li><a href="marca.php" class="dropdown-item">Registrar Marca</a></li>
                                    <li><a href="lista_marca.php" class="dropdown-item">Lista de Marcas</a></li>
                                </ul>
                            </li>
                            <li class="dropend">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">Serie</a>
                                <ul class="dropdown-menu">
                                    <li><a href="familia.php" class="dropdown-item">Registrar Series</a></li>
                                    <li><a href="lista_familia.php" class="dropdown-item">Lista de Series</a></li>
                                </ul>
                            </li>
                            <li class="dropend">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">Modelo</a>
                                <ul class="dropdown-menu">
                                    <li><a href="modelo.php" class="dropdown-item">Registrar Modelo</a></li>
                                    <li><a href="lista_modelo.php" class="dropdown-item">Lista de Modelos</a></li>
                                </ul>
                            </li>
                            <li class="dropend">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">Producto</a>
                                <ul class="dropdown-menu">
                                    <li><a href="producto.php" class="dropdown-item">Registrar Producto</a></li>
                                    <li><a href="lista_producto.php" class="dropdown-item">Lista de Productos</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul>

            <?php } elseif ($rol == 2) { ?>
                <ul class="navbar-nav ml-auto">


                    <!-- Entidad -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">
                            Entidad
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropend">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">Lista de entidades</a>
                                <ul class="dropdown-menu">
                                    <li><a href="./lista_entidad.php" class="dropdown-item">Registrar de personas con Ruc</a></li>
                                    <li><a href="./lista_natural.php" class="dropdown-item">Lista de personas con Dni</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Menu de productos -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">
                            Productos
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropend">
                                <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" href="#">Producto</a>
                                <ul class="dropdown-menu">
                                    <li><a href="lista_producto.php" class="dropdown-item">Lista de Productos</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>


                    <!-- Productos -->

                </ul>
            <?php } else {
                echo 'error de menu';
            } ?>

            <!-- cerrar sesion -->
            <ul class="navbar-nav" style="margin-left:auto;">
                <li class="nav-item dropdown d-flex">
                    <img src="../diseño/img/perfil.png" alt="cerra sesion" width="40px">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">
                        <?php echo $row['nombres'] ;?>
                    </a>
                    <ul class="dropdown-menu ">
                        <li>
                            <a href="../contenido/cerrar.php" class="nav-link text-center"><img src="../diseño/img/image (1).png" alt="cerra sesion" width="40px">Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>