<?php

return [
    'success' => [
        'email_registered' => 'Registro exitoso. Un correo de bienvenida ha sido enviado a su inbox.',
        'subscription_found' => 'Subscripción encontrada',
        'subscription_list_found' => 'Listado de subscripciones obtenido exitosamente',
        'subscription_deleted' => 'Subscripción eliminada exitosamente',
    ],
    'fails' => [
        'welcome_email_error' => 'Error enviando el correo de bienvenida.',
        'recaptcha_invalid' => 'Token de verificación inválido',
        'subscription_not_found'        => 'La subscripción no fue encontrada',
        'subscription_list_not_found'   => 'No se pudo obtener el listado de subscripciones',
        'subscription_delete_failed'    => 'No se pudo eliminar la subscripción',
    ],
    'validations' => [
        'id_required' => 'El ID es obligatorio',
        'email_required' => 'El campo email es requerido.',
        'email_valid' => 'El campo email no parece ser un correo válido.',
        'email_unique' => 'Este email ya existe en el sistema.',
        'recaptcha_required' => 'Token de verificación requerido',
        'recaptcha_valid' => 'Token de verificación inválido',
        'recaptcha_invalid' => 'Token de verificación inválido',
    ],
    'emails' => [
        'from_name' => 'NewsLanding',
        'user_name' => 'Suscriptor',
        'welcome' => [
            'subject' => '¡Bienvenid@ a NewsLanding!',
            'title' => '¡Bienvenid@ a NewsLanding!',
            'preheader' => 'Te has suscrito a la demo de la plantilla NewsLanding. Te mantendremos al tanto.',
            'first_paragraph' => 'Gracias por suscribirte a NewsLanding.',
            'second_paragraph' => 'Si tienes algún problema, escríbenos a {support_email} y te ayudaremos.',
        ],
    ],
];
