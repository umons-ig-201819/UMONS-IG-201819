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
        echo 'Aucune m�thode dans le controleur home pour cette page';        
    }
    
    
    
}
?>