<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $return     = array(
            'response'  => 'success',
            'status'    => 200
        );

        $db         = db_connect($this->request->uri->getSegment(1));
        $table      = model($this->request->uri->getSegment(2) . 'Model', true, $db);
        $findAll    = $table->findAll();

        if (count($findAll) != count($findAll, COUNT_RECURSIVE))
            $return['total'] = count($findAll);

        $return['data'] = $findAll;

        return $this->response->setJSON($return);
    }
}
