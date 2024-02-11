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
                        <form action="../modulos/registroProducto.php" method="post" enctype="multipart/form-data">
                            <input type="text" placeholder="Nombre" name="nameProduct" />
                            <input type="number" placeholder="Cantidad" name="stockProduct" />
                            <div class="d-flex justify-content-center">      
                                <img src="" id="imageOnline" class="img-fluid">
                                          
                            </div>
    
                            <input type="file" name="urlImage" placeholder="Imagen">
                            <input type="text" name="urlImageOnline" placeholder="URL de la imagen (No obligatorio)" id="urlImageOnline">
                            <input type="text" name="userRegister" value="<?php require_once './clases/usuarios.php'; $usuarios = new usuarios(); $usuarios = $_SESSION['usuario'];
                            $nombreUser = $usuarios->getUsuario(); echo $nombreUser;?>" disabled>
                         
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
} else {
    header("Location: ../index.php");
}
