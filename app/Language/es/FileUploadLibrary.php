<?php

return [
    'success' => [
        'file_uploaded' => 'Archivo subido con éxito',
    ],
    'fails' => [
        'invalid_file' => 'Archivo no válido',
        'file_already_moved' => 'El archivo ya ha sido movido',
        'directory_not_created' => 'No se creó el directorio',
        'file_move_failed' => 'Error en la carga del archivo',
        'file_too_large' => 'El archivo es demasiado grande',
        'invalid_file_type' => 'Tipo de archivo no permitido',
        'dangerous_file_type' => 'Tipo de archivo peligroso detectado',
        'extension_not_allowed' => 'Extensión de archivo no permitida',
        'mime_extension_mismatch' => 'El tipo de archivo y la extensión no coinciden',
        'invalid_image_content' => 'El contenido del archivo no coincide con el formato de imagen',
    ],
    'validations' => [
        'file_required' => 'El campo de archivo es obligatorio.',
        'is_image' => 'El archivo no es una imagen válida y cargada.',
        'mime_in' => 'El archivo no tiene un tipo MIME válido.',
        'max_size' => 'El archivo es demasiado grande.'
    ]
];