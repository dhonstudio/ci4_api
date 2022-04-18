<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db         = db_connect($this->request->uri->getSegment(1));
        $table      = model($this->request->uri->getSegment(2) . 'Model', true, $db);
        $findAll    = $table->findAll();

        return $this->response->setJSON(array(
            'response'  => 'success',
            'status'    => 200,
            'data'      => $findAll
        ));
    }
}
