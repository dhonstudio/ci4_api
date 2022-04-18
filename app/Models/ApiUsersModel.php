<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

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
