<?php

return [
    'success' => [
        'user_found' => 'Usuario encontrado exitosamente',
        'user_list_found' => 'Listado de usuarios encontrado existosamente',
        'user_updated' => 'Usuario actualizado existosamente',
        'user_deleted' => 'Usuario eliminado exitosamente',
    ],
    'fails' => [
        'user_not_found' => 'Usuario no encontrado.',
        'user_list_not_found' => 'Listado de usuarios no encontrado',
        'user_update_failed' => 'Usuario no actualizado',
        'user_delete_failed' => 'Usuario no eliminado',
    ],
    'validations' => [
        'id_required' => 'El campo id es requerido.',
        'name_required' => 'El campo nombre es requerido.',
        'email_required' => 'El campo email es requerido.',
        'email_valid' => 'El campo email no parece ser un correo válido.',
        'email_unique' => 'Este email ya existe en el sistema.',
        'password_required' => 'El campo contraseña es requerido.',
        'password_min' => 'La contraseña debe tener un mínimo de 8 caracteres.',
        'password_max' => 'La contraseña no debe tener más de 45 caracteres.',
    ],
];
