<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiUsersModel extends Model
{
    protected $table = 'api_users';

    //~ Custom DBGroup
    // protected $DBGroup = 'tests;

    protected $primaryKey = 'id_user';
    protected $useTimestamps = true;

    //~ Allow insert
    protected $allowedFields = ['username', 'password'];
}
