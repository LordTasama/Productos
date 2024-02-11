<?php

// controla el inicio de sesión

// se verifica que existan datos en el formulario
try {


    if (isset($_POST['nameUser']) && !empty($_POST['nameUser'] &&
        isset($_POST['passwordUser'])) && !empty($_POST['passwordUser'])) {
        // se hace el llamado del modelo de conexión y consultas



        // se capturan las variables que vienen desde el formulario

        $user = $_POST['nameUser'];
        $pass = md5($_POST['passwordUser']);

        // se instancia la clase, es decir, se llama para poder usar sus métodos
        require_once '../modulos/clases/MYSQL.php';

        $mysql = new MYSQL();


        $mysql->conectar();
        $usuarios = $mysql->efectuarConsulta("SELECT * FROM productos.usuarios where usuarios.nombre_usuario = '$user' and usuarios.password = '$pass'");
        $estado = $mysql->efectuarConsulta("SELECT estado FROM productos.usuarios where nombre_usuario = '$user'");

        $mysql->desconectar();
        $fila = mysqli_fetch_assoc($usuarios);
        $fila1 = mysqli_fetch_array($estado);
       
        if (!empty($fila1)) {
       

            if ($fila1[0] == 1) {
                if (mysqli_num_rows($usuarios) > 0) {
                    // Inicie sesión
                    session_start();

                    require_once '../modulos/clases/usuarios.php';

                    // Llamamos la clase usuarios
                    $usuario = new usuarios();

                    // Capture de la consulta el nombre del empleado
                    $usuario->setUsuario($fila['nombre_usuario']);
                    $usuario->setId($fila['id_usuario']);

                    // Dos variables, info de usuario y otra para validar.
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['acceso'] = true;
                    $_SESSION['id'] = $fila['id_usuario'];
                  
                    //$usuarios = $mysql->efectuarConsulta("INSERT INTO loginphp.usuario values('','$user','$pass')");

                     header("Location: dashboard.php");
                } else if (mysqli_num_rows($usuarios) == 0) {
?>
                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">

                        <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
                        <link rel="stylesheet" href="./assets/css/login-register.css">
                        <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                        <title>Nombre/Contraseña Incorrecta</title>
                    </head>

                    <body style="background-color: #1a1a2e;">

                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Nombre o contraseña incorrectos',
                                text: 'Error'
                            });
                            setTimeout(function() {
                                location.href = "../index.php"
                            }, 2000);
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

                    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
                    <link rel="stylesheet" href="./assets/css/login-register.css">
                    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                    <title>Usuario inactivo</title>
                </head>

                <body style="background-color: #1a1a2e;">

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'El usuario está inactivo',
                            text: 'Error'
                        });
                        setTimeout(function() {
                            location.href = "../index.php"
                        }, 2000);
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
                <title>Usuario no existe</title>
            </head>

            <body style="background-color: #1a1a2e;">

                <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: 'question',
                        title: "Usuario no existe.",
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

    <body style="background-color: #1a1a2e;">

        <script src=" ../node_modules/sweetalert2/dist/sweetalert2.all.min.js">
        </script>
        <script>
            Swal.fire({
                icon: 'Error',
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
