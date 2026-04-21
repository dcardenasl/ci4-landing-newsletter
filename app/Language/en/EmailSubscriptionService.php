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
        'from_name' => 'NewsLanding',
        'user_name' => 'Subscriber',
        'welcome' => [
            'subject' => 'Welcome to NewsLanding!',
            'title' => 'Welcome to NewsLanding {email}!',
            'preheader' => 'You\'ve subscribed to the NewsLanding template demo. We\'ll keep you updated.',
            'first_paragraph' => 'Thanks for subscribing to NewsLanding.',
            'second_paragraph' => 'If you have any issues, write to us at {support_email} and we\'ll help you.',
        ],
    ],
];
