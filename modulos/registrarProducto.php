<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../assets/css/styles.css">
<?php
require_once '../modulos/clases/usuarios.php';
session_start();
$usuario = new usuarios();
if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
    require_once './clases/MYSQL.php';
    $mysql = new MYSQL();
    $mysql->conectar();
    $consulta = $mysql->efectuarConsulta("SELECT id_usuario,nombre_usuario FROM productos.usuarios where usuarios.estado = 1");
    $mysql->desconectar();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../assets/css/login-register.css">
        <title>Registrar producto</title>
    </head>

    <body>
        <div class="sidebar" id="sidebar" style="height: 100%;">
            <div class="container-fluid">
                <div class="row">
                    <div class="active" id="active" style="justify-content: center;">
                        <div class="logoIMG">
                            <a href="dashboard.php"><img src="../assets/media/LOGO.png" alt="LOGO" srcset="../assets/media/LOGO.png" id="logoIMGCONT" style="width: 60px; height: 60px;"></a>
                        </div>
                        <div class="d-flex align-self-center logoMENU">
                            <img src="./assets/media/menu.png" alt="LOGO MENU" srcset="./assets/media/menu.png" id="logoMENU" style="width: 0px; height: 0px;">
                        </div>
                    </div>
                </div>
                <div class="row d-block" id="containerALIST">
                    <div class="col"><a href="./dashboard.php">Inicio</a></div>
                    <div class="col"><a href="./dashboard.php?datos=productos">Productos</a></div>
                    <div class="col"><a href="./registrarProducto.php">Registrar producto</a></div>

                    <div class="col">
                        <a href="./cerrarsesion.php" class="cerrarSesion">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">

            <section class="container contenido">
                <div class="login-container">
                    <div class="circle circle-one"></div>
                    <div class="form-container">
                        <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                        <h1 class="opacity">Registrar Producto</h1>
                        <form action="../modulos/registroProducto.php" method="post">
                            <input type="text" placeholder="Nombre" name="nameProduct" />
                            <input type="number" placeholder="Cantidad" name="stockProduct" />
                            <select name="imageProduct">
                                <option value="0">Selecciona una imagen</option>
                                <option value="../assets/media/productos/KIT-CILINDRO.png">Kit cilindro</option>
                                <option value="../assets/media/productos/TURBO.png">Turbo</option>
                                <option value="../assets/media/productos/VALVULA-MOTO.png">Valvula de moto</option>
                                <option value="../assets/media/productos/KIT-ARRASTRE.png">Kit de arrastre</option>
                                <option value="../assets/media/productos/FILTRO.png">Filtro</option>
                                <option value="../assets/media/productos/CARBURADOR.png">Carburador</option>
                                <option value="../assets/media/productos/BUJIA-IRIDIUM.png">Bujia iridium</option>
                                <option value="../assets/media/productos/BOBINA-ALTA.png">Bobina de alta</option>
                                <option value="../assets/media/productos/BARRAS-MOTO.png">Barras de moto</option>
                                <option value="../assets/media/productos/ACELERADOR.png">Acelerador</option>
                            </select>
                            <select name="userRegister">
                                <option value="0">Selecciona un usuario</option>
                                <?php
                                while ($fila = mysqli_fetch_array($consulta)) {

                                ?>
                                    <option value="<?php echo $fila[0]; ?>"><?php echo $fila[1]; ?></option>
                                <?php } ?>
                            </select>
                            <button type="submit" class="opacity">Registrar</button>
                        </form>

                    </div>
                    <div class="circle circle-two"></div>
                </div>
                <div class="theme-btn-container"></div>
            </section>
        </div>
        <script src="../assets/js/login-register.js"></script>
        <script src="../assets/js/main.js"></script>
    </body>

    </html>




<?php
}
