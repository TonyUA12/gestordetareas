<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email{
    protected $email;
    protected $name;
    protected $token;

    public function __construct($email, $name, $token){
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function sendConfirmation(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '16c73396f8ed1e';
        $mail->Password = 'f5fd47d44c91e3';

        $mail->setFrom('cuentas@gestionate.com');
        $mail->addAddress('cuentas@gestionate.com', 'gestionate.com');
        $mail->Subject = 'Confirma Tu Cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola ". $this->email ."</strong> Tu cuenta ah sido creada en GESTIONATE, confirmala en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='https://gestionate.webeacontony.com/confirmaccount?token=". $this->token ."'> Confirmar Cuenta</a>";
        $contenido .= "<p>Si no reconoces la cuenta, ignora el mensaje</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        //Send Email
        $mail->send();
    }

    public function sendInstructions(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '16c73396f8ed1e';
        $mail->Password = 'f5fd47d44c91e3';

        $mail->setFrom('cuentas@gestionate.com');
        $mail->addAddress('cuentas@gestionate.com', 'gestionate.com');
        $mail->Subject = 'Recupera tu cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola ". $this->email ."</strong> Crea tu nueva contraseña en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='https://gestionate.webeacontony.com/resetpassword?token=". $this->token ."'> Reestablecer Contraseña </a>";
        $contenido .= "<p>Si no reconoces el correo, ignora el mensaje</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        //Send Email
        $mail->send();
    }
}