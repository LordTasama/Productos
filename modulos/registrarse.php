<link rel="stylesheet" href="../assets/css/login-register.css">
<script src="../assets/js/login-register.js"></script>

<section class="container">
    <div class="login-container">
        <div class="circle circle-one"></div>
        <div class="form-container">
            <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
            <h1 class="opacity">Registro</h1>
            <form action="../modulos/registro.php" method="post">
                <input type="text" placeholder="Correo" name="emailUser" />
                <input type="text" placeholder="Usuario" name="nameUser" />
                <input type="password" placeholder="Contraseña" name="passwordUser" />
                <button type="submit" class="opacity">Registrarse</button>
            </form>
            <div class="login-forget opacity">
                <a href="">¿Ya tienes una cuenta?</a>
                <a href="../index.php">Iniciar Sesión</a>

            </div>
        </div>
        <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
</section>