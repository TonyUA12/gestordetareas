<?php include_once __DIR__ . '/header-dashboard.php' ?>

    <div class="container-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form class="form" method="POST" acction="/create-task">
            <?php include_once __DIR__ . '/task-form.php' ?>
            <input 
                type="submit"
                value="Crear Tarea">
        </form>
    </div>

<?php include_once __DIR__ . '/footer-dashboard.php' ?>