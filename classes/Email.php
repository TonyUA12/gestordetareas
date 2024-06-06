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
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@gestionate.com');
        $mail->addAddress('cuentas@gestionate.com', 'gestionate.com');
        $mail->Subject = 'Confirma Tu Cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola ". $this->email ."</strong> Tu cuenta ah sido creada en GESTIONATE, confirmala en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='". $_ENV['APP_URL'] ."/confirmaccount?token=". $this->token ."'> Confirmar Cuenta</a>";
        $contenido .= "<p>Si no reconoces la cuenta, ignora el mensaje</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        //Send Email
        $mail->send();
    }

    public function sendInstructions(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@gestionate.com');
        $mail->addAddress('cuentas@gestionate.com', 'gestionate.com');
        $mail->Subject = 'Recupera tu cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola ". $this->email ."</strong> Crea tu nueva contraseña en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='". $_ENV['APP_URL'] ."/resetpassword?token=". $this->token ."'> Reestablecer Contraseña </a>";
        $contenido .= "<p>Si no reconoces el correo, ignora el mensaje</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;

        //Send Email
        $mail->send();
    }
}