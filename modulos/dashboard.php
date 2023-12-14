<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../assets/css/styles.css">

<?php
try {
    require_once './clases/MySQL.php';

    $mysql = new MYSQL();
    $mysql->conectar();
    $consulta = $mysql->efectuarConsulta("SELECT * FROM productos.usuarios where usuarios.estado = 1");
    $mysql->desconectar();

    require_once '../modulos/clases/usuarios.php';
    session_start();
    $usuario = new usuarios();
    if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
        function cargarUsuarios($consulta)
        {
?>
            <div class="container">
                <div class="row d-flex justify-content-between">

                    <div class="col d-flex mt-3 justify-content-end">
                        <form action="./cerrarsesion.php" method="post">
                            <a href="./dashboard.php?datos=productos" class="btn btn-primary">Productos</a>
                            <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <table class="table table-dark table-striped table-bordered ">
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
                                        <a href="editarusuario.php?id=<?php echo $fila[0] ?>&user=<?php echo $fila[1] ?>">✎</a>
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
        <?php //} 
            // else {
            //     header("Location: index.php");
            // } 
        }

        function cargarProductos($consulta, $mysql)
        {
        ?>
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col d-flex mt-3 justify-content-start">
                        <form>
                            <a href="./registrarProducto.php" class="btn btn-primary">Registrar producto</a>

                        </form>
                    </div>
                    <div class="col d-flex mt-3 justify-content-end">
                        <form action="./cerrarsesion.php" method="post">
                            <a href="./dashboard.php" class="btn btn-primary">Usuarios</a>
                            <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-dark table-striped table-bordered ">
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
                                        <?php if ($fila[4] == 1) {
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
                                        <a href="editarproducto.php?id=<?php echo $fila[0] ?>&user=<?php echo $fila[1] ?>">✎</a>
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
    <?php
        }
        if (isset($_GET['datos'])) {
            if ($_GET['datos'] == "productos") {
                $mysql->conectar();
                $consulta = $mysql->efectuarConsulta("SELECT * FROM productos.productos where productos.estado = 1");
                $mysql->desconectar();
                cargarProductos($consulta, $mysql);
            } else {
                cargarUsuarios($consulta);
            }
        } else {
            cargarUsuarios($consulta);
        }
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