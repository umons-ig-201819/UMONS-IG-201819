<?php
class Home extends CI_Controller
{
 
    public function main()
    {
        //Loading url helper
        $this->load->helper('url');        
        $this->load->view('home');
    }
    public function index()
    {        
        echo 'Aucune méthode dans le controleur home pour cette page';        
    }
    public function help()
    {
        //Loading url helper
        $this->load->helper('url');
        $this->load->view('help');
    }
    public function connect()
    {
        //Loading url helper
        $this->load->helper('url');
        $this->load->view('connect');
    }
    public function nscript()
    {
        //Loading url helper
        $this->load->helper('url');
        $this->load->view('inscript');
    }    
}
?>