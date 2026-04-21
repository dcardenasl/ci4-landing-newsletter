<?php

return [
    'success' => [
        'user_found' => 'User successfully found',
        'user_list_found' => 'User list successfully found',
        'user_updated' => 'User successfully updated',
        'user_deleted' => 'User successfully removed',
    ],
    'fails' => [
        'user_not_found' => 'User not found.',
        'user_list_not_found' => 'User list not found',
        'user_update_failed' => 'User update failed',
        'user_delete_failed' => 'User remove failed',
    ],
    'validations' => [
        'id_required' => 'The name field is required.',
        'name_required' => 'The name field is required.',
        'email_required' => 'The email field is required.',
        'email_valid' => 'The email field must contain a valid email address.',
        'email_unique' => 'This email already exists in the system.',
        'password_required' => 'The password field is required.',
        'password_min' => 'The password must be at least 8 characters long.',
        'password_max' => 'The password must not exceed 45 characters.',
    ],
];
