<?php

return [
    // Success messages
    'success' => [
        'auth_url_generated' => 'Authentication URL generated successfully.',
        'user_authenticated' => 'User authenticated successfully with Google.',
        'account_linked' => 'Google account linked successfully.',
        'account_unlinked' => 'Google account unlinked successfully.',
    ],

    // Error messages
    'fails' => [
        'authorization_code_missing' => 'Authorization code not found.',
        'token_exchange_failed' => 'Error exchanging code for token: {error}',
        'authentication_failed' => 'Google authentication failed.',
        'user_info_failed' => 'Error getting user information from Google.',
        'user_update_failed' => 'Error updating user information.',
        'user_creation_failed' => 'Error creating new user.',
        'user_not_authenticated' => 'User not authenticated.',
        'google_account_already_linked' => 'This Google account is already linked to another user.',
        'account_link_failed' => 'Error linking Google account.',
        'account_unlink_failed' => 'Error unlinking Google account.',
    ],

    // Validation messages
    'validations' => [
        'code_required' => 'Authorization code is required.',
        'code_invalid' => 'Authorization code is invalid.',
        'user_id_required' => 'User ID is required.',
        'user_id_numeric' => 'User ID must be numeric.',
    ],
];
