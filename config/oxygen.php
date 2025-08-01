<?php

return [

    // static API KEY for the application
    'apiKey' => env('API_KEY', false),

    // disable dashboard login in dev for easier testing
    'dashboardAuthentication' => env('DASHBOARD_AUTHENTICATION', true),

    // page display settings
    'dashboard' => [
        'perPage' => 50,
    ],

    // Standard Date formats
    'dateFormat' => 'd/M/Y',

    'dateTimeFormat' => 'd/M/Y h:i A',

    'timeFormat' => 'h:i A',

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    // file/size limits
    'maxFileSizeMb' => env('MAX_UPLOAD_SIZE_MB', 2),

    // Auth Model assignment
    'abilityModel' => \App\Entities\Auth\Ability::class,
    'abilityRepository' => \App\Entities\Auth\AbilityRepository::class,
    'roleModel' => \App\Entities\Auth\Role::class,
    'roleRepository' => \App\Entities\Auth\RolesRepository::class,

    'tenantModel' => \EMedia\Oxygen\Entities\Auth\MultiTenant\Tenant::class,
    'tenantRepository' => \EMedia\Oxygen\Entities\Auth\MultiTenant\TenantRepository::class,
    'multiTenantActive' => false,

    'invitationRepository' => \EMedia\Oxygen\Entities\Invitations\InvitationRepository::class,
];
