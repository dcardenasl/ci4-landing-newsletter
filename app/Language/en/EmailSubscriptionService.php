<?php

return [
    'success' => [
        'email_registered' => 'Registration successful! A welcome email has been sent to your inbox.',
        'subscription_found' => 'Subscription found',
        'subscription_list_found' => 'Subscription list retrieved successfully',
        'subscription_deleted' => 'Subscription deleted successfully',
    ],
    'fails' => [
        'welcome_email_error' => 'Error sending welcome email.',
        'recaptcha_invalid' => 'Invalid verification token',
        'subscription_not_found'        => 'Subscription not found',
        'subscription_list_not_found'   => 'Could not retrieve subscription list',
        'subscription_delete_failed'    => 'Could not delete subscription',
    ],
    'validations' => [
        'id_required' => 'ID is required',
        'email_required' => 'The email field is required.',
        'email_valid' => 'The email field must contain a valid email address.',
        'email_unique' => 'This email already exists in the system.',
        'recaptcha_required' => 'Verification token required',
        'recaptcha_valid' => 'Invalid verification token',
        'recaptcha_invalid' => 'Invalid verification token',
    ],
    'emails' => [
        'from_name' => 'FILMA Support',
        'user_name' => 'FILMA User',
        'welcome' => [
            'subject' => 'Welcome to the FILMA community!',
            'title' => 'Welcome to FILMA {email}!',
            'preheader' => 'Welcome to the great FILMA community where you can search and offer audiovisual services in one place',
            'first_paragraph' => 'Thank you for registering with FILMA and helping grow this wonderful community.',
            'second_paragraph' => 'If you have any issues, please write to us at {support_email} so we can help you.',
        ],
    ],
];
