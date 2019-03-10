<?php
class Home extends CI_Controller
{
 
    public function main()
    {
        //Loading url helper
        $this->load->helper('url');
        
        $this->load->view('home');
    }
}
?>