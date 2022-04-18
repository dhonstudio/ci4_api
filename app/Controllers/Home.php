<?php

namespace App\Controllers;

use App\Models\ApiUsersModel;

class Home extends BaseController
{
    public function index()
    {
        // if ($this->auth() == true) {

        $db         = db_connect($this->request->uri->getSegment(1));
        $table      = model($this->request->uri->getSegment(2) . 'Model', true, $db);
        $findAll    = $table->findAll();
        // $user       = $table
        //     ->where('username', 'admin')
        //     ->findAll()[0];
        // $matchUser  = $user['password'] == password_verify('admin', $user['password']) ? true : false;

        return $this->response->setJSON(array(
            'response'  => 'success',
            'status'    => 200,
            'data'      => $findAll
        ));

        // dd($api_users);

        // return view('welcome_message');
        // }
    }

    private function auth()
    {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');

        $db         = db_connect($this->request->uri->getSegment(1));
        $auth       = new ApiUsersModel();
        $user       = $auth
            ->where('username', $_SERVER['PHP_AUTH_USER'])
            ->findAll()[0];

        return $user['password'] == password_verify($_SERVER['PHP_AUTH_PW'], $user['password']) ? true : false;
    }
}
