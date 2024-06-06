//CAMBIAR ESTADO

function handleChangeStatus(event){
    const button = event.target;
    
    const id = button.getAttribute('id');
    const status = button.getAttribute('status'); 

    const taskStatus = {
        id: id,
        status: status
    }
    confirmChangeStatus(taskStatus);

}

function confirmChangeStatus(taskStatus) {
    Swal.fire({
        title: '¿Seguro de cambiar estado?',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            changeStatus(taskStatus);
        } 
        window.location = "http://localhost:3000/dashboard";
    })
}

async function changeStatus(taskStatus){
    const {id, status} = taskStatus;
    const datos = new FormData();
    datos.append('id', id);
    datos.append('status', status);

    try {
        const url = 'http://localhost:3000/task/status';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
        const resultado = await respuesta.json();

        if(resultado.resultado) {
            Swal.fire('Cambiado!', resultado.mensaje, 'success');
        }
        
    } catch (error) {
        
    }
}

//ELIMINAR

function handleDeleteButtonClick(event) {
    const button = event.target;

    const id = button.getAttribute('id');
    const task = button.getAttribute('task');
    const url = button.getAttribute('url');
    const ownerId = button.getAttribute('ownerId');
    const description = button.getAttribute('description');
    const dueDate = button.getAttribute('dueDate');
    const taskDates = {
        id: id,
        task: task,
        url: url,
        ownerId: ownerId,
        description: description,
        dueDate: dueDate        
    }
    confirmDeleteTask(taskDates);

}

function confirmDeleteTask(taskDates) {
    Swal.fire({
        title: '¿Eliminar Tarea?',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteTask(taskDates);
        } 
        window.location = "http://localhost:3000/dashboard";
    })
}

async function deleteTask(taskDates) {
    const {id, task, url, ownerId, description, dueDate} = taskDates;
    const datos = new FormData();
    datos.append('id', id);
    datos.append('task', task);
    datos.append('url', url);
    datos.append('ownerId', ownerId);
    datos.append('description', description);
    datos.append('dueDate', dueDate);

    try {
        const url = 'http://localhost:3000/task/delete';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();

        if(resultado.resultado) {
            Swal.fire('Eliminado!', resultado.mensaje, 'success');
            
        }
        
    } catch (error) {
        
    }
}

