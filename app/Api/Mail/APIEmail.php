<?php

namespace App\Api\Mail;

use App\Core\Api;

class APIEmail extends Api
{

    public function send($data)
    {
        $this->config();
        $this->mailData($data);
        $this->mailBody($data);
        
        $config = $this->config->get('responses', 'mail');

        try {
            if ($this->mailer->Send()) {
                return $this->app->response()->json([
                    'errors' => $config->ok->errors,
                    'response' => $config->ok->response,
                    'message' => $config->ok->message
                ]);
            }

            return $this->app->response()->json([
                'errors' => $config->fail->errors,
                'response' => $config->fail->response,
                'message' => $config->fail->message
            ]);
        } catch (\Exception $e) {
            return $this->app->response()->json([
                'errors' => $config->fail->errors,
                'response' => $config->fail->response,
                'message' => $config->fail->message
            ]);
        }
    }

    protected function mailData($data)
    {
        $subject = $this->config->get('subject', 'mail');

        $mailConfig = $this->config->get('mail');

        $this->mailer->FromName = $data->name;
        $this->mailer->AddAddress($mailConfig->from);
        $this->mailer->AddReplyTo($data->email);
        $this->mailer->Subject = $subject;
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
