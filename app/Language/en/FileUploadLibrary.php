<?php

return [
    'success' => [
        'file_uploaded' => 'File successfully uploaded',
    ],
    'fails' => [
        'invalid_file' => 'Invalid file',
        'file_already_moved' => 'File already moved',
        'directory_not_created' => 'Directory was not created',
        'file_move_failed' => 'File upload failed',
        'file_too_large' => 'File is too large',
        'invalid_file_type' => 'File type not allowed',
        'dangerous_file_type' => 'Dangerous file type detected',
        'extension_not_allowed' => 'File extension not allowed',
        'mime_extension_mismatch' => 'File type and extension do not match',
        'invalid_image_content' => 'File content does not match image format',
    ],
    'validations' => [
        'file_required' => 'The file field is required.',
        'is_image' => 'File is not a valid, uploaded image file.',
        'mime_in' => 'File does not have a valid mime type.',
        'max_size' => 'File is too large of a file.'
    ]
];
