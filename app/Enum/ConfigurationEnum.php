<?php

namespace App\Enum;

enum ConfigurationEnum : string
{
    case LAST_SYNCED_USERS = 'last_synced_users';
    case LAST_SYNCED_BENEFICIARY = 'last_synced_beneficiary';
    case LAST_SYNCED_AIDS = 'last_synced_aids';
    case LAST_SYNCED_DISTRIBUTIONS = 'last_synced_distributions';
    case LAST_SYNCED_DISTRIBUTIONS_SESSIONS = 'last_synced_distributions_sessions';
    case LAST_SYNCED_VILLAGE = 'last_synced_village';
    case LAST_SYNCED_ORIENTATIONS = 'last_synced_orientations';
    case LAST_SYNCED_STRUCTURES = 'last_synced_structures';
    case LAST_SYNCED_PRESCRIBERS = 'last_synced_prescribers';
    case LAST_SYNCED_FOLDERS = 'last_synced_folders';
}
