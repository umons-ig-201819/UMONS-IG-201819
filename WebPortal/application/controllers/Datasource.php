<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasource extends CI_Controller {
    public const ZEPPELIN_URL = 'http://192.168.2.169:8080';
    public function __construct(){
        parent::__construct();
        $this->load->model('DataSourceModel');
    }
    /*
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/interpreter.html
     https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/notebook.html
     */
    private function createNoteIfNotExists($notesList=null){
        if(is_null($notesList)){
            $notesList = json_decode(file_get_contents(self::ZEPPELIN_URL.'/api/notebook'),true);
        }
        $notesList = $notesList['body'];
        $name = "user/work-".$this->session->UserID;
        foreach($notesList as $note){
            if($note['name']==$name) return $note['id'];
        }
        $headers = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => '{"name": "'.$name.'"}'
            )
        );
        $context  = stream_context_create($headers);
        $result = json_decode(file_get_contents(self::ZEPPELIN_URL.'/api/notebook', true, $context),true);
        return $result['body'];
    }
    private function listParagraphs($noteID){
        $information = json_decode(file_get_contents(self::ZEPPELIN_URL."/api/notebook/$noteID"),true);
        $information = $information['body']['paragraphs'];
        $result      = array();
        foreach($information as $paragraph){
            $tmp = array();
            $tmp['title'] = array_key_exists('title',$paragraph) ? $paragraph['title'] : '' ;
            $tmp['text']  = array_key_exists('text' ,$paragraph) ? $paragraph['text' ] : '' ;
            $tmp['id']    = array_key_exists('id'   ,$paragraph) ? $paragraph['id' ]   : '' ;
            array_push($result,$tmp);
        }
        return $result;
    }
    private function getWorkingCopy($originNote,$notesList=null){// Must have access to $sourceID
        if(is_null($notesList)){
            $notesList = json_decode(file_get_contents(self::ZEPPELIN_URL.'/api/notebook'),true);
        }
        $workingNote = $this->createNoteIfNotExists($notesList);
        $paragraphs  = $this->listParagraphs($workingNote);
        $paragraphID = null;
        foreach($paragraphs as $paragraph){
            if($paragraph['title'] == $originNote)
                $paragraphID = $paragraph['id'];
        }
        if(is_null($paragraphID)){
            // Create a copy of the first paragraph of the $originNote to $workingNote entitled with the $originNote identifier
            $source = $this->listParagraphs($originNote);
            $headers = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => '{"title": "'.$originNote.'", "text": "'.preg_replace('/"/','\\"',$source[0]['text']).'"}'// TODO check if dubble-quotes (") is properly handled
                )
            );
            print('@'.$headers['http']['content'].'@');
            $context      = stream_context_create($headers);
            $result      = json_decode(file_get_contents(self::ZEPPELIN_URL."/api/notebook/$workingNote/paragraph", true, $context),true);
            $paragraphID = $result['body'];
        }else{
            // Update
            file_get_contents(self::ZEPPELIN_URL."/api/notebook/job/$workingNote/$paragraphID");
        }
        return self::ZEPPELIN_URL."/#/notebook/$workingNote/paragraph/$paragraphID?asIframe";
    }
    public function index($sourceID=''){
        $sources = $this->DataSourceModel->getAccessibleDataSources($this->session->UserID);
        
        $options = array(
            ''         => 'Veuillez s&eacute;lectionner une source',
        );
        
        foreach($sources as $source){
            $options[$source['url']] = $source['name'];
        }
        
        if(!preg_match('/^[0-9a-zA-Z]+$/', $sourceID)) $sourceID = '';
        
        $url = null;
        if(!empty($sourceID) && array_key_exists($sourceID, $options)){
            $url = $this->getWorkingCopy($sourceID);
        }

        $data = array(
            'selected'          => $sourceID,
            'url'               => $url,
            'options'           => $options
        );
        
        $this->load->view('header');
        $this->load->view('datasource',$data);
        $this->load->view('footer');
    }
    public function addSource(){
        if($this->input->post('action')){
            $userID                         = $this->session->UserID;
            $path_parts                     = pathinfo($_FILES["datafile"]["name"]);
            
            $config = array(
                'upload_path'          => "/var/nfs/general/$userID/",
                'allowed_types'        => 'csv|mdb|accdb',
                'max_size'             => 100,
                'file_ext_tolower'     => true,
                'detect_mime'          => true,
                'file_name'            => dechex(time()).'.'.strtolower($path_parts['extension'])
            );
            
            $this->load->library('upload', $config);
            
            /*
            if(!$this->upload->do_upload('userfile')){
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('upload_form', $error);
            }else{
                $data = array('upload_data' => $this->upload->data());
                $this->load->view('upload_success', $data);
            }*/
        }
        
        
        $this->load->view('header');
        $this->load->view('upload');
        $this->load->view('footer');
    }
    public function addAdvisor($advisorID=null){
    
    }
}
