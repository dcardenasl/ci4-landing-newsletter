<?php

// app/Language/es/InvitationService.php
return [
    'success' => [
        'invitation_created'      => 'La invitación ha sido creada exitosamente',
        'invitation_found'        => 'Invitación encontrada',
        'invitation_list_found'   => 'Lista de invitaciones obtenida exitosamente',
        'invitation_updated'      => 'La invitación ha sido actualizada exitosamente',
        'invitation_deleted'      => 'La invitación ha sido eliminada exitosamente',
    ],
    'fails' => [
        'invitation_create_failed'    => 'Error al crear la invitación',
        'invitation_not_found'        => 'La invitación no fue encontrada',
        'invitation_list_not_found'   => 'No se pudieron obtener las invitaciones',
        'invitation_update_failed'    => 'Error al actualizar la invitación',
        'invitation_delete_failed'    => 'Error al eliminar la invitación',
    ],
    'validations' => [
        'id_required'           => 'El ID es obligatorio',
        'max_uses_required'     => 'El número máximo de usos es obligatorio',
        'max_uses_integer'      => 'El número máximo de usos debe ser un número entero',
        'max_uses_greater_than' => 'El número máximo de usos debe ser mayor a 0',
        'type_required'         => 'El tipo de invitación es obligatorio',
        'type_in_list'          => 'El tipo debe ser: newsletter, registration, admin, premium o event',
    ],
];
