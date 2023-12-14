<?php




// controla el inicio de sesión

// se verifica que existan datos en el formulario

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

    $mysql->desconectar();
    $fila = mysqli_fetch_assoc($usuarios);


    if (mysqli_num_rows($usuarios) > 0) {
        // Inicie sesión
        session_start();

        require_once '../modulos/clases/usuarios.php';

        // Llamamos la clase usuarios
        $usuario = new usuarios();

        // Capture de la consulta el nombre del empleado
        $usuario->setUsuario($fila['Nombre_Usuario']);
        $usuario->setId($fila['Id']);

        // Dos variables, info de usuario y otra para validar.
        $_SESSION['usuario'] = $usuario;

        $_SESSION['acceso'] = true;

        //$usuarios = $mysql->efectuarConsulta("INSERT INTO loginphp.usuario values('','$user','$pass')");
      
        header("Location: dashboard.php");
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
    <title>Document</title>
</head>

<body style="background-color: #0f3460;">
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   Swal.fire({
       icon: 'error',
       title: 'Nombre o contraseña incorrectos',
       text: 'Error',
       footer: '.'
   });
   setTimeout(function() {
    location.href = "../index.php"
}, 2000);
  
</script> 
    </body>

</html>



      <?php
    
}
}
      ?>
