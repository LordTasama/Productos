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
    require_once './clases/MYSQL.php';
    $mysql = new MYSQL();
    $mysql->conectar();
    if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
        if (isset($_POST['nameUser']) && !empty($_POST['nameUser']) &&
            isset($_POST['emailUser']) && !empty($_POST['emailUser'])) {
            // se hace el llamado del modelo de conexión y consultas


            // se capturan las variables que vienen desde el formulario

            $correo = $_POST['emailUser'];
            $user = $_POST['nameUser'];
            $pass = $_POST['hiddenPassword'];
         
            $inputPass = $_POST['passwordUser'];
            $inputPass = str_replace(" ","",$inputPass);
            $passEmpty = $mysql->efectuarConsulta("SELECT COUNT(*) FROM productos.usuarios where nombre_usuario = '$user' and usuarios.password = '$inputPass'");

            if (mysqli_fetch_array($passEmpty)[0] == 0 && $inputPass != ""){
                $pass = md5($_POST['passwordUser']);
         
            }
           
            $idUser = $_POST['idUser'];
            $status = $_POST['status'];
         

            // se instancia la clase, es decir, se llama para poder usar sus métodos
          


         

            $usuarioRepetido = $mysql->efectuarConsulta("SELECT count(*) FROM productos.usuarios where UPPER(usuarios.nombre_usuario) = UPPER('$user') and id_usuario != $idUser");
            $usuarioRepetido = mysqli_fetch_assoc($usuarioRepetido);
            if (implode($usuarioRepetido) > 0) {
?>
                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
                    <link rel="stylesheet" href="../assets/css/login-register.css">
                    <title>Usuario ya existe</title>
                </head>

                <body>

                    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                    <script>
                        document.querySelector("body").innerHTML = "";
                        Swal.fire({
                            icon: 'error',
                            title: "Usuario ya existe, intenta con otro",
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


                $mysql->efectuarConsulta("UPDATE productos.usuarios set usuarios.nombre_usuario = '$user',usuarios.correo='$correo',usuarios.password='$pass',estado = $status where usuarios.id_usuario = $idUser");



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
                    document.querySelector("body").innerHTML = "";
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
            }
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
