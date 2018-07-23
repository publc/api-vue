<?php

return [
    'responses' => [
        'ok' => [
            'errors' => false,
            'response' => 'Su correo fue enviado correctamente',
            'message' => 'Gracias por comunicarte con nosotros, pronto nos comunicaremos contigo.'
        ],
        'fail' => [
            'errors' => true,
            'response' => 'Ups! El correo no pudo ser enviado',
            'message' => 'Te pedimos disculpas por las molestias que pueda generarte, 
                                intenta comunicarte de nuevo mas tarde.'
        ]
    ]
];
