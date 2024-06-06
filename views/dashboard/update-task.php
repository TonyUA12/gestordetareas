<?php include_once __DIR__ . '/header-dashboard.php' ?>

    <div class="container-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form class="form" method="POST" acction="/update-task">
            <div class="field">
                <label for="name">Titulo de la Tarea</label>
                <input 
                    type="text"
                    name="task"
                    id="task"
                    placeholder="Nombre de la Tarea"
                    value='<?php echo $nameTask ?>'
                    >
            </div>
            <div class="field">
                <label for="name">Descripción</label>
                <textarea 
                    name="description" 
                    id="description"
                    placeholder="Ingrese la descripción de la tarea"><?php echo $description ?></textarea>
            </div>
            <div class="field">
                <label for="name">Fecha de Vencimiento</label>
                <input 
                    type="date" 
                    name="dueDate" 
                    id="dueDate"
                    value='<?php echo $dueDate ?>'>
            </div>
            <input 
                type="submit"
                value="Actualizar Tarea">
        </form>
    </div>

<?php include_once __DIR__ . '/footer-dashboard.php' ?>