<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../assets/css/styles.css">
<?php

// controla el inicio de sesión

// se verifica que existan datos en el formulario
try {
    require_once '../modulos/clases/usuarios.php';
    session_start();
    $usuario = new usuarios();
    if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
        if (isset($_POST['nameUser']) && !empty($_POST['nameUser'] &&
            isset($_POST['passwordUser'])) && !empty($_POST['passwordUser']) && isset($_POST['emailUser']) && !empty($_POST['emailUser'])) {
            // se hace el llamado del modelo de conexión y consultas


            // se capturan las variables que vienen desde el formulario

            $correo = $_POST['emailUser'];
            $user = $_POST['nameUser'];
            $pass = md5($_POST['passwordUser']);
            $idUser = $_POST['idUser'];
            echo $idUser;

            // se instancia la clase, es decir, se llama para poder usar sus métodos
            require_once './clases/MYSQL.php';

            $mysql = new MYSQL();


            $mysql->conectar();

            $mysql->efectuarConsulta("UPDATE productos.usuarios set usuarios.nombre_usuario = '$user',usuarios.correo='$correo',usuarios.password='$pass' where usuarios.id_usuario = $idUser");


            $mysql->desconectar();

?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
                <link rel="stylesheet" href="../assets/css/login-register.css">
                <title>Edición exitosa</title>
            </head>

            <body>

                <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: "Usuario editado correctamente",
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then((result) => {

                        if (result.dismiss === Swal.DismissReason.timer) {
                            open("../modulos/dashboard.php", "_self");
                        }
                    });
                    window.addEventListener("click", () => {
                        open("../modulos/dashboard.php", "_self");
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
                        title: "Verifica si hay campos vacíos",
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then((result) => {

                        if (result.dismiss === Swal.DismissReason.timer) {
                            open("../modulos/dashboard.php", "_self");
                        }
                    });
                    window.addEventListener("click", () => {
                        open("../modulos/dashboard.php", "_self");
                    });
                </script>
            </body>

            </html>
    <?php
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
                    open("../modulos/dashboard.php", "_self");
                }
            });
            window.addEventListener("click", () => {
                open("../modulos/dashboard.php", "_self");
            });
        </script>
    </body>

    </html>
<?php
}
