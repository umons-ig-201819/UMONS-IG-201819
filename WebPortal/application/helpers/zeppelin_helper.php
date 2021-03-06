<?php
/**
 * @author   Jean-Sébastien Lerat
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/interpreter.html
 https://zeppelin.apache.org/docs/0.8.1/usage/rest_api/notebook.html
 */

if(!defined('ZEPPELIN_URL')){
    define('ZEPPELIN_URL','http://192.168.2.168/zeppelin'); #'http://192.168.2.169:8080';
}

if(!function_exists('get_binded_interpreters')){
    function get_binded_interpreters($noteID){
        $information  = json_decode(file_get_contents(ZEPPELIN_URL."/api/notebook/interpreter/bind/$noteID"),true);
        $interpreters = array();
        foreach($information['body'] as $tab){
            array_push($interpreters,$tab['id']);
        }
        sort($interpreters);
        return $interpreters;
    }
}

if(!function_exists('bind_interpreter')){
    function bind_interpreter($noteID,$interpreters){
        $headers = array('http' =>
            array(
                'method'  => 'PUT',
                'header'  => 'Content-Type: application/json',
                'content' => json_encode($interpreters)
            )
        );
        $context  = stream_context_create($headers);
        $information = json_decode(file_get_contents(ZEPPELIN_URL."/api/notebook/interpreter/bind/$noteID", true, $context),true);
        return $information['status'] == 'OK';
    }
}

if(!function_exists('create_note_if_not_exists')){
    /**
     * Check if a given node (by name) already exists. If not, it creates this node (purpose: new user workspace).
     * @param ZeppelinRef $name
     * @param JSON $notesList Zeppelin full nodes list under JSON format
     * @return JSON node information (newly created or already exists)
     */
    function create_note_if_not_exists($name,$notesList=null){
        if(is_null($notesList)){
            $notesList = json_decode(file_get_contents(ZEPPELIN_URL.'/api/notebook'),true);
        }
        $notesList = $notesList['body'];
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
        $result = json_decode(file_get_contents(ZEPPELIN_URL.'/api/notebook', true, $context),true);
        return $result['body'];
    }
}


if(!function_exists('get_note_information')){
    function get_note_name($noteID){
        $information = json_decode(file_get_contents(ZEPPELIN_URL."/api/notebook/$noteID"),true);
        return $information['body']['name'];
    }
}

if(!function_exists('list_paragraphs')){
    /***
     * List all paragraphs of a given node
     * @param ZeppelinRef $noteID The given node unique identifier
     * @return array Array of paragraph, each indice contains an associative array 'dateCreated', 'dateStarted', 'title', 'text' and 'id'
     */
    function list_paragraphs($noteID,$content=false){
        $information = json_decode(file_get_contents(ZEPPELIN_URL."/api/notebook/$noteID"),true);
        $information = $information['body']['paragraphs'];
        $result      = array();
        foreach($information as $paragraph){
            $tmp = array( 'note'  => $noteID );
            $tmp['title']          = array_key_exists('title'       ,$paragraph) ? $paragraph['title']          : '' ;
            $tmp['text']           = array_key_exists('text'        ,$paragraph) ? $paragraph['text']           : '' ;
            $tmp['results']        = array_key_exists('config'      ,$paragraph) ? $paragraph['config']         : '' ;
            $tmp['id']             = array_key_exists('id'          ,$paragraph) ? $paragraph['id' ]            : '' ;
            $tmp['dateCreated']    = array_key_exists('dateCreated' ,$paragraph) ? strtotime($paragraph['dateCreated' ])   : '' ;
            $tmp['dateStarted']    = array_key_exists('dateStarted' ,$paragraph) ? strtotime($paragraph['dateStarted' ])   : '' ;
            if($content){
                if(         array_key_exists('results',$paragraph)
                    &&  array_key_exists('msg',$paragraph['results'])
                    &&  array_key_exists(0,$paragraph['results']['msg'])
                    &&  array_key_exists('data',$paragraph['results']['msg'][0])
                    &&  array_key_exists('type',$paragraph['results']['msg'][0])
                    &&  $paragraph['results']['msg'][0]['type'] == 'TABLE'
                  ){
                      $values = explode("\n",$paragraph['results']['msg'][0]['data']);
                      $tmp['content'] = array_map(function ($x){ return explode("\t",$x); }, $values);
                }else{
                    $tmp['content'] = array();
                }
            }
            if(!empty($tmp['results'])){
                if(array_key_exists('results',$tmp['results'])){
                    $tmp['results'] = $tmp['results']['results'];
                }else{
                    $tmp['results']='';
                }
            }
            array_push($result,$tmp);
        }
        return $result;
    }
}

if(!function_exists('json_clear')){
    function json_clear($rawText){
        $rawText = preg_replace('%\\\\([a-z])%','\\\\\\\\\1',$rawText);
        $rawText = str_replace("\n",'\\n',$rawText);
        $rawText = preg_replace('/"/','\\"',$rawText);
        return $rawText;
    }
}

if(!function_exists('create_paragraph')){
    function create_paragraph($noteID,$name,$textContent,$results=''){
        if(empty($results)){
            $results = '';
        }else{
            $results = ", \"config\": { \"results\": ".json_encode($results).'}';
        }
        // Create a copy of the first paragraph of the $originNote to $workingNote entitled with the $originNote identifier
        $headers = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => "Content-Type: application/json",//'Content-Type: application/x-www-form-urlencoded',
                'content' => '{"title": "'.$name.'", "text": "'.json_clear($textContent).'"'.$results.'}'
            )
        );
        $context       = stream_context_create($headers);
        $result        = json_decode(file_get_contents(ZEPPELIN_URL."/api/notebook/$noteID/paragraph", true, $context),true);
        $paragraphID   = $result['body'];
        $paragraph     = json_decode(file_get_contents(ZEPPELIN_URL."/api/notebook/$noteID/paragraph/$paragraphID"),true);
        $paragraph     = $paragraph['body'];
        $paragraph['note'] = $noteID;
        foreach($paragraph as $key => $value){
            if(preg_match('/^date/', $key)){
                $paragraph[$key] = strtotime($value);
            }
        }
        return $paragraph;
    }
}

if(!function_exists('delete_paragraph')){
    function delete_paragraph($noteID, $paragraphID){
        $headers = array('http' =>
            array(
                'method'  => 'DELETE'
            )
        );
        $context  = stream_context_create($headers);
        file_get_contents(ZEPPELIN_URL."/api/notebook/$noteID/paragraph/$paragraphID",true,$context);
    }
}

if(!function_exists('delete_note')){
    function delete_note($noteID){
        $headers = array('http' =>
            array(
                'method'  => 'DELETE'
            )
        );
        $context  = stream_context_create($headers);
        file_get_contents(ZEPPELIN_URL."/api/notebook/$noteID",true,$context);
    }
}

if(!function_exists('run_async_paragraph')){
    function run_async_paragraph($noteID,$paragraphID){
        $headers = array('http' => array( 'method'  => 'POST' ) );
        $context  = stream_context_create($headers);
        file_get_contents(ZEPPELIN_URL."/api/notebook/job/$noteID/$paragraphID",true,$context);
    }
}

if(!function_exists('run_sync_paragraph')){
    function run_sync_paragraph($noteID,$paragraphID){
        $headers = array('http' => array( 'method'  => 'POST' ) );
        $context  = stream_context_create($headers);
        file_get_contents(ZEPPELIN_URL."/api/notebook/run/$noteID/$paragraphID",true,$context);
    }
}

if(!function_exists('run_paragraph')){
    function run_paragraph($noteID,$paragraphID){
        run_async_paragraph($noteID,$paragraphID);
    }
}

if(!function_exists('create_csv_source')){
    function create_csv_source($nodeName,$interpreterName,$path){// TODO specify that one per user
        // Create interpreter
        $json =   '{
    "name": "'.$interpreterName.'",
    "group": "jdbc",
    "properties": {
        "default.url":{"name":"default.url","value":"jdbc:relique:csv:'.dirname($path).'/?suppressHeaders\u003dfalse\u0026useQuotes\u003dtrue\u0026separator\u003d%2C\u0026fileExtension\u003d.csv\u0026ignoreNonParseableLines\u003dtrue","type":"string"},
        "default.driver":{"name":"default.driver","value":"org.relique.jdbc.csv.CsvDriver","type":"string"},
        "zeppelin.jdbc.principal":{"name":"zeppelin.jdbc.principal","value":"","type":"string"},
        "default.completer.ttlInSeconds":{"name":"default.completer.ttlInSeconds","value":"120","type":"number"},
        "default.password":{"name":"default.password","value":"","type":"password"},
        "default.completer.schemaFilters":{"name":"default.completer.schemaFilters","value":"","type":"textarea"},
        "default.splitQueries":{"name":"default.splitQueries","value":false,"type":"checkbox"},
        "default.user":{"name":"default.user","value":"root","type":"string"},
        "zeppelin.jdbc.concurrent.max_connection":{"name":"zeppelin.jdbc.concurrent.max_connection","value":"10","type":"number"},
        "common.max_count":{"name":"common.max_count","value":"1000","type":"number"},
        "default.precode":{"name":"default.precode","value":"","type":"textarea"},
        "zeppelin.jdbc.auth.type":{"name":"zeppelin.jdbc.auth.type","value":"","type":"string"},
        "default.statementPrecode":{"name":"default.statementPrecode","value":"","type":"string"},
        "zeppelin.jdbc.concurrent.use":{"name":"zeppelin.jdbc.concurrent.use","value":true,"type":"checkbox"},
        "zeppelin.jdbc.keytab.location":{"name":"zeppelin.jdbc.keytab.location","value":"","type":"string"},
        "zeppelin.jdbc.interpolation":{"name":"zeppelin.jdbc.interpolation","value":false,"type":"checkbox"}
    },
    "interpreterGroup": [
        {
            "name":"sql",
            "class":"org.apache.zeppelin.jdbc.JDBCInterpreter",
            "defaultInterpreter":false,
            "editor":{"language":"sql","editOnDblClick":false,"completionSupport":true}
        }
    ],
    "dependencies": [
        {"groupArtifactVersion":"net.sourceforge.csvjdbc:csvjdbc:1.0.34","local":false}
    ],
    "option": {
        "remote":true,
        "port":-1,
        "perNote":"shared",
        "perUser":"shared",
        "isExistingProcess":false,
        "setPermission":false,
        "owners":[],
        "isUserImpersonate":false
    }
}';
        $headers = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => "Content-Type: application/json",//'Content-Type: application/x-www-form-urlencoded',
                'content' => $json
            )
        );
        $context  = stream_context_create($headers);
        @file_get_contents(ZEPPELIN_URL.'/api/interpreter/setting', true, $context);
        // Create initial note
        $json = '{
"name": "'.$nodeName.'",
"paragraphs": [
    {
      "title": "query",
      "text": "%'.$interpreterName.'
SELECT * FROM '.preg_replace('/\.(.+)$/','',basename($path)).';"
    }
]
}';
        $headers = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $json
            )
        );
        $context  = stream_context_create($headers);
        $result = json_decode(file_get_contents(ZEPPELIN_URL.'/api/notebook', true, $context),true);
        return $result['body'];
    }
}

if(!function_exists('create_access_source')){
    function create_access_source($nodeName,$interpreterName,$path){
        // Create interpreter
$json =   '{
    "name": "'.$interpreterName.'",
    "group": "jdbc",
    "properties": {
        "default.url":{"name":"default.url","value":"jdbc:ucanaccess://'.$path.';memory\u003dfalse","type":"string"},
        "default.driver":{"name":"default.driver","value":"net.ucanaccess.jdbc.UcanaccessDriver","type":"string"},
        "zeppelin.jdbc.principal":{"name":"zeppelin.jdbc.principal","value":"","type":"string"},
        "default.completer.ttlInSeconds":{"name":"default.completer.ttlInSeconds",
        "value":"120","type":"number"},
        "default.password":{"name":"default.password","value":"","type":"password"},
        "default.completer.schemaFilters":{"name":"default.completer.schemaFilters","value":"","type":"textarea"},
        "default.splitQueries":{"name":"default.splitQueries","value":false,"type":"checkbox"},
        "default.user":{"name":"default.user","value":"root","type":"string"},
        "zeppelin.jdbc.concurrent.max_connection":{"name":"zeppelin.jdbc.concurrent.max_connection","value":"10","type":"number"},
        "common.max_count":{"name":"common.max_count","value":"1000","type":"number"},
        "default.precode":{"name":"default.precode","value":"","type":"textarea"},
        "zeppelin.jdbc.auth.type":{"name":"zeppelin.jdbc.auth.type","value":"","type":"string"},
        "default.statementPrecode":{"name":"default.statementPrecode","value":"","type":"string"},
        "zeppelin.jdbc.concurrent.use":{"name":"zeppelin.jdbc.concurrent.use","value":true,"type":"checkbox"},
        "zeppelin.jdbc.keytab.location":{"name":"zeppelin.jdbc.keytab.location","value":"","type":"string"},
        "zeppelin.jdbc.interpolation":{"name":"zeppelin.jdbc.interpolation","value":false,"type":"checkbox"}
    },
    "interpreterGroup": [
        {
            "name":"sql",
            "class":"org.apache.zeppelin.jdbc.JDBCInterpreter",
            "defaultInterpreter":false,
            "editor":{"language":"sql","editOnDblClick":false,"completionSupport":true}
        }
    ],
    "dependencies": [
        {"groupArtifactVersion":"net.sf.ucanaccess:ucanaccess:3.0.1","local":false}
    ],
    "option": {
        "remote":true,
        "port":-1,
        "perNote":"shared",
        "perUser":"shared",
        "isExistingProcess":false,
        "setPermission":false,
        "owners":[],
        "isUserImpersonate":false
    }
}';
        $headers = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => "Content-Type: application/json",//'Content-Type: application/x-www-form-urlencoded',
                'content' => $json
            )
        );
        $context  = stream_context_create($headers);
        $result = json_decode(file_get_contents(ZEPPELIN_URL.'/api/interpreter/setting', true, $context),true);
        
        // Get tables list
        $tables = trim(shell_exec('mdb-tables -1 "'.$path.'"'));
        
        // Create initial note
        $json = '{
"name": "'.$nodeName.'",
"paragraphs": [
    {
      "title": "query",
      "text": "%'.$interpreterName.'
SELECT * FROM '.implode(',',$tables).';"
    }
]
}';
        $headers = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $json
            )
        );
        $context  = stream_context_create($headers);
        $result = json_decode(file_get_contents(ZEPPELIN_URL.'/api/notebook', true, $context),true);
        return $result['body'];
    }
}

if(!function_exists('update_paragraph')){
    function update_paragraph($noteID,$paragraphID,$fields){
        $headers = array('http' =>
            array(
                'method'  => 'PUT',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => json_encode($fields)
            )
        );
        $context  = stream_context_create($headers);
        file_get_contents(ZEPPELIN_URL."/api/notebook/$noteID/paragraph/$paragraphID", true, $context);
    }
}

if(!function_exists('synchronize_workspace')){
    /***
     * Update the given workspace note to synch with the originalParagraphs. Assuming that all paragraph in $workspaceParagraphs are linked to a $originalID paragraph
     * @param unknown $workspaceNoteID
     * @param unknown $workspaceParagraphs List of paragragrahs that are created from a paragraph of the $originalID note
     * @param unknown $originalID The original ID note
     * @param unknown $originalParagraphs List of paragraphs contained in $originalID note. If null, autoloading
     */
    function synchronize_workspace($workspaceNoteID,&$workspaceParagraphs,$originalID,$originalParagraphs=null){
        $originInterpreters    = get_binded_interpreters($originalID);
        $workspaceInterpreters = get_binded_interpreters($workspaceNoteID);
        foreach($originInterpreters as $interpreter){
            if(!in_array($interpreter, $workspaceInterpreters))
                array_push($workspaceInterpreters,$interpreter);
        }
        bind_interpreter($workspaceNoteID,$workspaceInterpreters);
        if(is_null($originalParagraphs)){
            $originalParagraphs = list_paragraphs($originalID);
        }
        foreach($workspaceParagraphs as $pos => $paragraph){
            if(!array_key_exists('origin', $paragraph)){
                $workspaceParagraphs[$pos]['origin'] = explode('_',$paragraph['title'])[0];
            }
        }
        $assoc = array();
        foreach($originalParagraphs as $pos => $paragraph){
            $assoc[$paragraph['id']] = $paragraph;
            $assoc[$paragraph['id']]['process'] = false; 
        }
        foreach($workspaceParagraphs as $pos => $paragraph){
            if(! array_key_exists($paragraph['origin'], $assoc)){
                // Paragraph does not more exists inside original note => remove it
                delete_paragraph($workspaceNoteID,$paragraph['id']);
                unset($workspaceParagraphs[$pos]);
            }else{
                $assoc[$paragraph['origin']]['process'] = true;
                $original       = $assoc[$paragraph['origin']];
                $originDate     = empty($original['dateStarted']) ? $original['dateCreated'] : $original['dateStarted'];
                $paragraphDate  = empty($paragraph['dateStarted']) ? $paragraph['dateCreated'] : $paragraph['dateStarted'];
                $originDate     = intval($originDate);
                $paragraphDate  = intval($paragraphDate);
                if($paragraphDate <= $originDate){
                    // original paragraph content is more recent, need to update old paragraph
                    $fields = array('text' => $original['text']);
                    update_paragraph($workspaceNoteID,$paragraph['id'],$fields);
                    run_paragraph($workspaceNoteID, $paragraph['id']);
                }elseif($paragraphDate < date('Ymd',time()-24*60*60)){
                    // update paragraph result (re-run)
                    run_paragraph($workspaceNoteID, $paragraph['id']);
                }
            }
        }
        foreach($assoc as $id => $value){
            if(!$value['process']){
                // Add newly created paragraphs (exist in original but not in workspace)
                $new = create_paragraph($workspaceNoteID,"${originalID}_".$value['id'],$value['text'],$value['results']);
                array_push($workspaceParagraphs,$new);
                run_paragraph($workspaceNoteID, $new['id']);
            }
        }
    }
}
if(!function_exists('get_user_workspace')){
    /***
     * Get user paragraph workspace for a given note source
     * @param UseIdentifier $userID 
     * @param ZeppelinRef $originNote
     * @param JSON $notesList
     * @return array
     */
    function get_user_workspace($userID,$originNote,$notesList=null){// Must have access to $sourceID
        // Fetch original note informations if not provided
        if(is_null($notesList)){
            $notesList = json_decode(file_get_contents(ZEPPELIN_URL.'/api/notebook'),true);
        }
        // Create working space for user if not exists
        $workingNote = create_note_if_not_exists("user/work-$userID",$notesList);
        // Find all paragraph from workspace attached to the original note
        $paragraphs  = list_paragraphs($workingNote);
        $paragraphs  = array_filter($paragraphs,function($paragraph) use ($originNote){
            return preg_match("/^${originNote}_/", $paragraph['title']);
        });
        synchronize_workspace($workingNote,$paragraphs,$originNote);
        return array_map(
            function($paragraph) use ($workingNote){
                return ZEPPELIN_URL."/#/notebook/$workingNote/paragraph/$paragraph[id]?asIframe";
            },
            $paragraphs
        );
    }
}