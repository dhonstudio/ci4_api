<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiusersModel extends Model
{
    protected $table = 'api_users';

    protected $primaryKey = 'id_user';
    protected $useTimestamps = true;

    //~ Allow insert
    protected $allowedFields = ['username', 'password'];
}
