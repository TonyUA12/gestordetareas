<?php include_once __DIR__  . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="form" method="POST" action="/perfil">
        <div class="field">
            <label for="name">Nombre</label>
            <input
                type="text"
                value="<?php echo $usuario->name; ?>"
                name="nombre"
                placeholder="Tu Nombre"
                disabled
            />
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input
                type="email"
                value="<?php echo $usuario->email; ?>"
                name="email"
                placeholder="Tu Email"
                disabled
            />
        </div>

        <input type="submit" value="Guardar Cambios">
    </form>
</div>


<?php include_once __DIR__  . '/footer-dashboard.php'; ?>