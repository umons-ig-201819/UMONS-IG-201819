<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * http://example.com/index.php/welcome
     * - or -
     * http://example.com/index.php/welcome/index
     * - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        // Old Message
        // $this->load->view('welcome_message');

        // New message
        $this->load->helper('url');
        $this->load->view('home');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> branch 'master' of git@github.com:umons-ig-201819/UMONS-IG-201819.git
