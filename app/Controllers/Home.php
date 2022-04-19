<?php

namespace App\Controllers;

class Home extends BaseController
{
    //~ Switch $basicAuth on Config/Routes in line 37 to false if not use Basic Auth
    //~ And define api_users db in Filters/BasicauthFilter

    public function index()
    {
        $return = array(
            'response'  => 'success',
            'status'    => 200
        );

        if ($this->request->uri->getSegment(1) == '') return $this->_Error();

        try {
            $db = db_connect($this->request->uri->getSegment(1) . '_' . ENVIRONMENT);
        } catch (\Exception $e) {
            return $this->_Error();
        }

        $table = model(ucwords($this->request->uri->getSegment(2)) . 'Model', true, $db);

        if ($table === null) {
            return $this->_Error(404);
        }

        $findAll    = $table->findAll();

        if (count($findAll) != count($findAll, COUNT_RECURSIVE))
            $return['total'] = count($findAll);

        $return['data'] = $findAll;

        return $this->response->setJSON($return);
    }

    private function _Error($status = 500)
    {
        $return = array(
            'response'  => 'failed',
            'status'    => $status
        );
        $this->response->setStatusCode($status);
        return $this->response->setJSON($return);
        die;
    }
}
