<?php

namespace Model;

use Model\ActiveRecord;

class Task extends ActiveRecord {
    protected static $tabla = 'tasks';
    protected static $columnasDB = ['id', 'task', 'url', 'description', 'ownerId', 'dueDate', 'status'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->task = $args['task'] ?? null;
        $this->description = $args['description'] ?? null;
        $this->url = $args['url'] ?? null;
        $this->ownerId = $args['ownerId'] ?? null;
        $this->dueDate = $args['dueDate'] ?? null;
        $this->status = $args['status'] ?? 0;
        
    }

    public function validateTask(){
        if(!$this->task){
            self:: $alertas['error'][] = 'El Titulo de la tarea es obligatoria';
        }

        if(!$this->description){
            self:: $alertas['error'][] = 'La descripción de la tarea es obligatoria';
        }


        if(!$this->dueDate){
            self:: $alertas['error'][] = 'La fecha de vencimiento es obligatoria';
        }

        return self::$alertas;
    }

}