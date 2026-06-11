<?php

if (!function_exists('validate_email')) {
    /**
     * Validate email format
     * 
     * @param string $email Email address to validate
     * @return bool
     */
    function validate_email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (!function_exists('validate_invitation_code')) {
    /**
     * Validate invitation code format
     * Must be alphanumeric, 3-50 characters
     * 
     * @param string $code Invitation code to validate
     * @return bool
     */
    function validate_invitation_code(string $code): bool
    {
        if (empty($code)) {
            return true; // Optional field
        }

        return preg_match('/^[a-zA-Z0-9]{3,50}$/', $code) === 1;
    }
}

if (!function_exists('validate_recaptcha_token')) {
    /**
     * Validate reCAPTCHA token format
     * Should be non-empty string
     * 
     * @param string $token reCAPTCHA token to validate
     * @return bool
     */
    function validate_recaptcha_token(string $token): bool
    {
        return !empty($token) && strlen($token) >= 20;
    }
}

if (!function_exists('sanitize_email')) {
    /**
     * Sanitize email address
     * 
     * @param string $email Email to sanitize
     * @return string
     */
    function sanitize_email(string $email): string
    {
        return strtolower(trim($email));
    }
}
