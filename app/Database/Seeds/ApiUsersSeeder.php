<?php

namespace App\Database\Seeds;

use App\Models\ApiusersModel;
use CodeIgniter\Database\Seeder;

class ApiUsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username'  => 'admin',
            'password'  => password_hash('admin', PASSWORD_DEFAULT)
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO api_users (username, password) VALUES(:username:, :password:)", $data);

        // Using Query Builder
        // $this->db->table('api_users')->insert($data);

        //~ Using Model
        $ApiUsersModel = new ApiusersModel();

        $ApiUsersModel->insert($data);
    }
}
