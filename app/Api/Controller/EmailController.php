<?php

namespace App\Api\Controller;

use App\Api\Api;

class EmailController extends Api
{

    public function send($data)
    {
        $this->config();
        $this->mailData($data);
        $this->mailBody($data);
        
        try {
            if ($this->mailer->Send()) {
                return $this->app->response()->json([
                    'errors' => true,
                    'response' => 'Su correo fue enviado correctamente',
                    'message' => 'Gracias por comunicarte con Mira Que Lindo, pronto nos comunicaremos contigo.'
                ]);
            }

            return $this->app->response()->json([
                'errors' => false,
                'response' => 'Ups! El correo no pudo ser enviado',
                'message' => 'Te pedimos disculpas por las molestias que pueda generarte, 
                            intenta comunicarte de nuevo mas tarde.'
            ]);
        } catch (\Exception $e) {
            return $this->app->response()->json([
                'errors' => false,
                'response' => 'Ups! El correo no pudo ser enviado',
                'message' => 'Te pedimos disculpas por las molestias que pueda generarte, 
                            intenta comunicarte de nuevo mas tarde.'
            ]);
        }
    }

    protected function mailData($data)
    {
        $mailConfig = $this->config->get('mail');

        $this->mailer->FromName = $data->name;
        $this->mailer->AddAddress($mailConfig->from);
        $this->mailer->AddReplyTo($data->email);
        $this->mailer->Subject = "Consulta Mira Que Lindo";
    }

    protected function mailBody($data)
    {
        $this->mailer->Body = $this->app->response()->mailTemplate('contact', $data);
        $this->mailer->AltBody = "Nombre: {$data->name} \n\n 
                        Telefono: {$data->phone} \n\n
                        Correo: {$data->email} \n\n
                        {$data->query}";
    }

    protected function config()
    {
        $mailConfig = $this->config->get('mail');

        $this->mailer->IsSMTP();
        $this->mailer->IsHTML(true);

        $this->mailer->SMTPAuth = $mailConfig->smtp_auth;
        $this->mailer->Host = $mailConfig->host;
        $this->mailer->Port = $mailConfig->port;
        $this->mailer->CharSet = $mailConfig->charset;
        $this->mailer->Username = $mailConfig->user;
        $this->mailer->Password = $mailConfig->pass;
        $this->mailer->From = $mailConfig->from;
        $this->mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
    }
}
