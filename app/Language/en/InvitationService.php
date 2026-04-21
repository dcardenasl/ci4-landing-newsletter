<?php
// app/Language/en/InvitationService.php

return [
    'success' => [
        'invitation_created'      => 'Invitation has been created successfully',
        'invitation_found'        => 'Invitation found',
        'invitation_list_found'   => 'Invitations list retrieved successfully',
        'invitation_updated'      => 'Invitation has been updated successfully',
        'invitation_deleted'      => 'Invitation has been deleted successfully',
    ],
    'fails' => [
        'invitation_create_failed'    => 'Failed to create invitation',
        'invitation_not_found'        => 'Invitation not found',
        'invitation_list_not_found'   => 'Could not retrieve invitations',
        'invitation_update_failed'    => 'Failed to update invitation',
        'invitation_delete_failed'    => 'Failed to delete invitation',
    ],
    'validations' => [
        'id_required'           => 'ID is required',
        'max_uses_required'     => 'Maximum number of uses is required',
        'max_uses_integer'      => 'Maximum number of uses must be an integer',
        'max_uses_greater_than' => 'Maximum number of uses must be greater than 0',
        'type_required'         => 'Invitation type is required',
        'type_in_list'          => 'Type must be: newsletter, registration, admin, premium or event',
    ],
];
