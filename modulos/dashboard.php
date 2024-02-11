<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<?php
try {
    require_once './clases/MySQL.php';

    $mysql = new MYSQL();
    $mysql->conectar();
    $consulta = $mysql->efectuarConsulta("SELECT * FROM productos.usuarios ORDER BY estado DESC");
    $mysql->desconectar();

    require_once '../modulos/clases/usuarios.php';
    session_start();
    $usuario = new usuarios();
    if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
        function cargarUsuarios($consulta)
        {
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../assets/css/styles.css">

                <title>Inicio</title>
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
                    <span style="visibility: hidden;">.</span>
                    <div class="container contenido">
                        <h1 class="text-center">Usuarios</h1>
                        <div class="row d-flex justify-content-between">
                            <div class="row">
                                <table class="display dataTable" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                Id
                                            </th>
                                            <th>
                                                Usuario
                                            </th>
                                            <th>
                                                Correo
                                            </th>
                                            <th>
                                                Contraseña
                                            </th>
                                            <th>
                                                Estado
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($fila = mysqli_fetch_array($consulta)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $fila[0]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila[1]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila[2]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $fila[3]; ?>
                                                </td>
                                                <td>
                                                    <?php if ($fila[4] == 1) {
                                                        echo 'Activo';
                                                    } else {
                                                        echo 'Inactivo';
                                                    } ?>
                                                </td>
                                                <td>
                                                    <a href="editarusuario.php?id=<?php echo $fila[0] ?>&user=<?php echo $fila[1] ?>&correo=<?php echo $fila[2]  ?>&pass=<?php echo $fila[3] ?>">✎</a>
                                                </td>
                                                <td><a href="eliminar.php?id_Usuario=<?php echo $fila[0] ?>">🗑</a></td>
                                            </tr>

                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>


                <script src="../assets/js/main.js"></script>
            </body>

            </html>

        <?php //} 
            // else {
            //     header("Location: index.php");
            // } 
        }

        function cargarProductos($consulta, $mysql)
        {
        ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../assets/css/styles.css">
                <title>Inicio</title>
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
                                    <img src="../assets/media/LOGO.png" alt="LOGO MENU" srcset="../assets/media/LOGO.png" id="logoMENU" style="width: 0px; height: 0px;">
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
                    <span style="visibility: hidden;">.</span>
                    <div class="container contenido">
                        <h1 class="text-center">Productos</h1>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col d-flex">
                                    <div class="div">
                                        <form action="./imprimirInforme.php">
                                            <button type="submit" class="btn btn-success">Pdf</button>
                                        </form>
                                    </div>
                                    <div class="div ms-3">
                                        <form action="./imprimirExcel.php">
                                            <button type="submit" class="btn btn-success">Excel</button>
                                        </form>
                                    </div>



                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <table class="display" style="width:100%" id="tableResponsive">
                                <thead>
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            Cantidad
                                        </th>
                                        <th>
                                            Imagen
                                        </th>
                                        <th>
                                            Estado
                                        </th>
                                        <th>
                                            Usuario
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($fila = mysqli_fetch_array($consulta)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $fila[0]; ?>
                                            </td>
                                            <td>
                                                <?php echo $fila[1]; ?>
                                            </td>
                                            <td>
                                                <?php echo $fila[2]; ?>
                                            </td>
                                            <td>
                                                <img src="<?php echo $fila[3] ?>" alt="IMAGEN" srcset="<?php echo $fila[3] ?>" style="width:50px;height:50px">
                                            </td>
                                            <td>
                                                <?php
                                                if ($fila[4] == 1) {
                                                    echo 'Activo';
                                                } else {
                                                    echo 'Inactivo';
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $mysql->conectar();
                                                $consultaUser = $mysql->efectuarConsulta("SELECT nombre_usuario FROM productos.usuarios where usuarios.id_usuario = $fila[5]");
                                                $mysql->desconectar();
                                                while ($fila1 = mysqli_fetch_array($consultaUser)) {
                                                    echo $fila1[0];
                                                }

                                                ?>
                                            </td>
                                            <td>
                                                <a href="editarproducto.php?id=<?php echo $fila[0] ?>&nombre=<?php echo $fila[1] ?>&cantidad=<?php echo $fila[2] ?>&imagen=<?php echo $fila[3] ?>&usuario=    
                                                <?php
                                                $mysql->conectar();
                                                $consultaUser = $mysql->efectuarConsulta("SELECT nombre_usuario FROM productos.usuarios where usuarios.id_usuario = $fila[5]");
                                                $mysql->desconectar();
                                                while ($fila1 = mysqli_fetch_array($consultaUser)) {
                                                    echo $fila1[0];
                                                }

                                                ?>">✎</a>
                                            </td>
                                            <td><a href="eliminar.php?id_Producto=<?php echo $fila[0] ?>">🗑</a></td>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <script src="../assets/js/main.js"></script>
            </body>

            </html>
    <?php
        }
        if (isset($_GET['datos'])) {
            if ($_GET['datos'] == "productos") {
                $mysql->conectar();
                $consulta = $mysql->efectuarConsulta("SELECT * FROM productos.productos ORDER BY estado DESC");
                $mysql->desconectar();
                cargarProductos($consulta, $mysql);
            } else {
                cargarUsuarios($consulta);
            }
        } else {
            cargarUsuarios($consulta);
        }
    } else {
        header("Location: ../index.php");
    }
} catch (Exception $ex) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
        <link rel="stylesheet" href="../assets/css/login-register.css">
        <title>Error</title>
    </head>

    <body>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                icon: 'Upps',
                title: "Algo ocurrió(Error interno)...",
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            }).then((result) => {

                if (result.dismiss === Swal.DismissReason.timer) {
                    open("../index.php", "_self");
                }
            });
            window.addEventListener("click", () => {
                open("../index.php", "_self");
            });
        </script>
    </body>

    </html>
<?php
}

?>