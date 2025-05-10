<?php

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        // Add first_name and last_name to allowed fields
        $this->allowedFields = array_merge($this->allowedFields, ['first_name', 'last_name']);
    }
}