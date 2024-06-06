<?php
namespace Model;

class User extends ActiveRecord{
    
    protected static $tabla = 'users';
    protected static $columnasDB = ['id', 'name', 'email', 'password', 'token', 'confirm'];

    public $id;
    public $name;
    public $email;
    public $password;
    public $password2;
    public $token;
    public $confirm;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['password'] ?? null;
        $this->password2 = $args['password2'] ?? null;
        $this->token = $args['token'] ?? null;
        $this->confirm = $args['confirm'] ?? 0;
    }

    public function validateLogin(){
        if(!$this->email){
            self::$alertas['error'][] = 'El Email del usuario es obligatorio';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Email no válido';
        }

        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña del usuario es obligatorio';
        }
        return self::$alertas;
    }

    public function validateNewAccount(){
        if(!$this->name){
            self::$alertas['error'][] = 'El nombre del usuario es obligatorio';
        }

        if(!$this->email){
            self::$alertas['error'][] = 'El Email del usuario es obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña del usuario es obligatorio';
        }

        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }

        if($this->password !== $this->password2){
            self::$alertas['error'][] = 'Las contraseñas son distintas';
        }

        return self::$alertas;
    }

    public function validateEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Email no válido';
        }

        return self::$alertas;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function generateToken(){
        $this->token = uniqid();
    }

    public function validatePassword(){
        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es es obligatorias';
        }

        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }

        return self::$alertas;
    }

}