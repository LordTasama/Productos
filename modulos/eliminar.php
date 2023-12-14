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

    try {
        if (isset($_GET['id_Usuario'])) {
            $mysql->conectar();
            $id = $_GET['id_Usuario'];


            $mysql->efectuarConsulta("UPDATE productos.usuarios set usuarios.estado = 0 where usuarios.id_usuario = $id");

            $mysql->desconectar();
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
                <link rel="stylesheet" href="../assets/css/login-register.css">
                <title>Desactivación exitosa del usuario</title>
            </head>

            <body>

                <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: "Usuario desactivado correctamente",
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then((result) => {

                        if (result.dismiss === Swal.DismissReason.timer) {
                            open("dashboard.php", "_self");
                        }
                    });
                    window.addEventListener("click", () => {
                        open("dashboard.php", "_self");
                    });
                </script>
            </body>

            </html>
        <?php
        } else {
            if (isset($_GET['id_Producto'])) {
                $mysql->conectar();
                $id = $_GET['id_Producto'];
                $mysql->efectuarConsulta("UPDATE productos.productos set productos.estado = 0 where productos.id_producto = $id");

                $mysql->desconectar();
            }

        ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
                <link rel="stylesheet" href="../assets/css/login-register.css">
                <title>Desactivación exitosa</title>
            </head>

            <body>

                <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: "Producto desactivado correctamente",
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then((result) => {

                        if (result.dismiss === Swal.DismissReason.timer) {
                            open("dashboard.php?datos=productos", "_self");
                        }
                    });
                    window.addEventListener("click", () => {
                        open("dashboard.php?datos=productos", "_self");
                    });
                </script>
            </body>

            </html>
        <?php
        }
    } catch (mysqli_sql_exception $ex) {

        $error_code = $ex->getCode();
        if ($error_code == 1451) {
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
                        icon: 'error',
                        title: "No se pudo eliminar el usuario, ya que está asociado a otra tabla",
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then((result) => {

                        if (result.dismiss === Swal.DismissReason.timer) {
                            open("dashboard.php", "_self");
                        }
                    });
                    window.addEventListener("click", () => {
                        open("dashboard.php", "_self");
                    });
                </script>
            </body>

            </html>

            <?php
        } else {
            if (isset($_GET['id_Usuario'])) {
            ?>
                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
                    <link rel="stylesheet" href="../assets/css/login-register.css">
                    <title>Error exitosa</title>
                </head>

                <body>

                    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: "Algo ocurrió al eliminar al usuario(Error interno)...",
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then((result) => {

                            if (result.dismiss === Swal.DismissReason.timer) {
                                open("dashboard.php", "_self");
                            }
                        });
                        window.addEventListener("click", () => {
                            open("dashboard.php", "_self");
                        });
                    </script>
                </body>

                </html>

            <?php
            } else {
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
                            icon: 'error',
                            title: "Algo ocurrió al eliminar al producto(Error interno)...",
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then((result) => {

                            if (result.dismiss === Swal.DismissReason.timer) {
                                open("dashboard.php?datos=productos", "_self");
                            }
                        });
                        window.addEventListener("click", () => {
                            open("dashboard.php?datos=productos", "_self");
                        });
                    </script>
                </body>

                </html>


<?php
            }
        }
    }
}
