<?php

return [
    // Mensajes de éxito
    'success' => [
        'auth_url_generated' => 'URL de autenticación generada correctamente.',
        'user_authenticated' => 'Usuario autenticado correctamente con Google.',
        'account_linked' => 'Cuenta de Google vinculada correctamente.',
        'account_unlinked' => 'Cuenta de Google desvinculada correctamente.',
    ],

    // Mensajes de error
    'fails' => [
        'authorization_code_missing' => 'Código de autorización no encontrado.',
        'token_exchange_failed' => 'Error al intercambiar código por token: {error}',
        'authentication_failed' => 'Error en la autenticación con Google.',
        'user_info_failed' => 'Error al obtener información del usuario de Google.',
        'user_update_failed' => 'Error al actualizar información del usuario.',
        'user_creation_failed' => 'Error al crear nuevo usuario.',
        'user_not_authenticated' => 'Usuario no autenticado.',
        'google_account_already_linked' => 'Esta cuenta de Google ya está vinculada a otro usuario.',
        'account_link_failed' => 'Error al vincular cuenta de Google.',
        'account_unlink_failed' => 'Error al desvincular cuenta de Google.',
    ],

    // Mensajes de validación
    'validations' => [
        'code_required' => 'El código de autorización es requerido.',
        'code_invalid' => 'El código de autorización no es válido.',
        'user_id_required' => 'El ID del usuario es requerido.',
        'user_id_numeric' => 'El ID del usuario debe ser numérico.',
    ],
];
