<?php
class CounterModel extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function newVisitor(){
        
    }
    
    public function countVisitors(){
        return 0;
    }
}