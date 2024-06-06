<?php include_once __DIR__ . '/header-dashboard.php' ?>

    <?php if(count($tasks) === 0){ ; ?>
        <p class="no-task">No tienes tareas aún</p>
    <?php } else {?>
        <ul class="tasks-list">
            <?php foreach($tasks as $task) { ?>
                <div class="task">
                    <p class="task-tittle"><?php echo $task->task ?></p>
                    <div class="task-dates">
                        <p class="task-description"><strong>Descripción: </strong> <?php echo $task->description ?></p>
                        <p class="task-dueDate"><strong>Fecha de Vencimiento:</strong> <?php echo $task->dueDate ?> </p>

                        <div class="options">
                            <div class="button update-task">
                                <a href='/update?id=<?php echo $task->id ?>'>Editar</a>
                            </div>
                            
                            <button
                                type="button"
                                class="delete-task"
                                name="delete-task"
                                onclick="handleDeleteButtonClick(event)"
                                id = '<?php echo $task->id ?>'
                                task = '<?php echo $task->task ?>'
                                url = '<?php echo $task->url ?>'
                                ownerId = '<?php echo $task->ownerId ?>'
                                description = '<?php echo $task->description ?>'
                                dueDate = '<?php echo $task->dueDate ?>'
                                id="delete-task"
                                >Eliminar
                            </button>
                            <?php if($task->status == 1) {?>
                                <button 
                                    type="button"
                                    class="change-status-green"
                                    name="change-status-green"
                                    id = '<?php echo $task->id ?>'
                                    onclick="handleChangeStatus(event)"
                                    status = '<?php echo $task->status ?>'
                                >
                                    COMPLETADO
                                </button>
                            <?php }else {?>
                                <button 
                                    type="button"
                                    class="change-status-orchid"
                                    name="change-status-orchid"
                                    id = '<?php echo $task->id ?>'
                                    onclick="handleChangeStatus(event)"
                                    status = '<?php echo $task->status ?>'
                                >
                                    PROGRESO
                                </button>
                            <?php }?>
                        </div>
                    </div>
                    
                    
                    
                </div>
            <?php } ?>
        </ul>
    <?php } ?>

<?php include_once __DIR__ . '/footer-dashboard.php' ?>

<?php
$script .= '
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="build/js/tasks.js"></script>
';

?>