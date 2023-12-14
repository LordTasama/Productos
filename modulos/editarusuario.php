<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../assets/css/styles.css">
<?php
require_once '../modulos/clases/usuarios.php';
session_start();
$usuario = new usuarios();
if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
?>
    <link rel="stylesheet" href="../assets/css/login-register.css">
    <script src="../assets/js/login-register.js"></script>

    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">Editar usuario</h1>
                <form action="../modulos/editar.php" method="post">
                    <input type="text" placeholder="Correo" name="emailUser" />
                    <input type="text" placeholder="Usuario" name="nameUser" />
                    <input type="password" placeholder="Contraseña" name="passwordUser" />
                    <button type=" submit" class="opacity">Guardar Cambios</button>
                    <input type="text" style="visibility: hidden; width:0px;height:0px;" value="<?php echo $_GET['id'] ?>" name="idUser">
                </form>

            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
<?php
}
