<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [
        'Session_helper', 'Mandatory_helper', 'Datetime_helper', 'NumberFormat_helper', 'Versioning_helper',
        'Upload_path_helper', 'Wa_helper', 'Get_data_helper'
    ];

    /**
     * Constructor.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param LoggerInterface   $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.: $this->session = \Config\Services::session();
        $this->session = \Config\Services::session();
        $language = \Config\Services::language();
        $language->setLocale($this->session->lang);

        // Check for session expiration
        // $this->checkSession();
    }

    /**
     * Checks if the session has expired and logs out the user if necessary.
     */
    protected function checkSession()
    {
        // Set your session timeout in seconds (e.g., 600 seconds for 10 minutes)
        $sessionTimeout = 7200;

        // Check if the session has a timestamp
        if ($this->session->has('last_activity')) {
            $lastActivity = $this->session->get('last_activity');
            $currentTime = time();

            // If the session has expired, log out the user
            if (($currentTime - $lastActivity) > $sessionTimeout) {
                // Destroy the session and redirect to the login page
                $this->session->destroy();
                return redirect()->to('/')->send();
            }
        }

        // Update the last activity timestamp
        $this->session->set('last_activity', time());
    }
}
