<div  class="container create">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php';?>
    <div class="container-sm">
        <p class="page-description">Crear Cuenta</p>
        <form method="POST" action="/createuser" class="form">
        <?php include_once __DIR__ .'/../templates/alertas.php';?>
            <div class="field">
                <label for="name">Nombre</label>
                <input 
                    name="name" 
                    id="name"
                    type="text" 
                    placeholder="Ejem. Pedro Ulloa"
                    autocomplete="name"
                    value="<?php echo $user -> name;?>"
                >
            </div>

            <div class="field">
                <label for="email">Correo</label>
                <input 
                    name="email" 
                    id="email"
                    type="email" 
                    placeholder="Ejem. correo@correo.com"
                    value="<?php echo $user -> email;?>"
                >
            </div>

            <div class="field">
                <label for="password">Contraseña</label>
                <input 
                    name="password" 
                    id="password"
                    type="password" 
                    placeholder="Contraseña"

                >
            </div>

            <div class="field">
                <label for="password2">Repite tu contraseña</label>
                <input 
                    name="password2" 
                    id="password2"
                    type="password"
                    placeholder="Repite tu contraseñá"
                >
            </div>

            <input type="submit" class="boton" value="Crear Cuenta" >
        </form>

        <div class="options">
            <a href="/">Log In</a>
            <a href="/forgotpassword">¿Olvidaste tu contraseña?</a>
        </div>
    </div>

</div>