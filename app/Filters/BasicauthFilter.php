<?php

namespace App\Filters;

use App\Models\ApiUsersModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class BasicauthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!empty($_SERVER['PHP_AUTH_USER'])) {
            $auth   = new ApiUsersModel();
            $user   = $auth
                ->where('username', $_SERVER['PHP_AUTH_USER'])
                ->findAll()[0];

            $authorized = $user['password'] == password_verify($_SERVER['PHP_AUTH_PW'], $user['password']) ? true : false;
        }

        if (empty($_SERVER['PHP_AUTH_USER']) || $authorized === false) {
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
            //~ Active this if want to create auth bar
            // header('WWW-Authenticate: Basic realm="My Realm"');
            header("HTTP/1.1 401 Unauthorized");

            echo json_encode(array(
                'response'  => 'failed',
                'status'    => 401,
                'message'   => 'unauthorized'
            ));
            die;
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
