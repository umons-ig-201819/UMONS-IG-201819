<?php
class CounterModel extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function newVisitor(){
        $sql    = "INSERT IGNORE INTO counter (day) VALUES (CURRENT_DATE())";
        $this->db->query($sql);
        $sql    = "UPDATE counter SET value=value+1 WHERE day=CURRENT_DATE()";
        $this->db->query($sql);
    }
    
    public function countVisitors(){
        $sql    = "SELECT value AS value FROM counter WHERE day=CURRENT_DATE()";
        $query  = $this->db->query($sql)->row_array();
        if(empty($query)) return 0;
        return $query['value'];
    }
}