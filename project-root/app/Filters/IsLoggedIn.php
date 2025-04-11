<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IsLoggedIn implements FilterInterface
{
    public function before(RequestInterface $request, $args = null)
    {
        $session = session(); 
        
        if (!$session->get('loggedIn')) {
           
            return redirect()->to(site_url(''));
        }

        
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $args = null)
    {
        
    }
}