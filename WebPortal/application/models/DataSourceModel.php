<?php
/**
 * \file      models/DataSourceModel.php
 * \author    EmilieG
 * \version   1.0
 * \date      2019-03-22
 * \brief     Model to manage files linked with users and projects for the Wallesmart database
 *
 * \details   This class is supposed to be used with the codeigniter framework
 */

class DataSourceModel extends CI_Model{
    
    /**
     * __construct() is the constructor which initiates the connection to the database
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
    }

    //////////////////////////////////////////FAILED///////////////////////////////////////////////////////
    ///////////////////////BECAUSE GETVISIBILITY DON T GIVE THE GOOD VALUE/////////////////////////////////
     /*/**
     * addFileUser() is a method for adding a data source for a user
     *      
     * @param $fileID (required) is the id of a data source
     * @param $userID (required) is the id of a user
     * @param $fileUser (required) is an array containing the informations the types of access has a user for a data source
     * @param $fileUser ['read'] (required) means if a user may read a data source or not (0) = default
     * @param $fileUser ['modify'] (required) means if a user may modify a data source or not (0) = default
     * @param $fileUser ['remove'] (required) means if a user may remove a data source or not (0) = default
     * @param $fileUser ['askaccess'] (required) means if an access request is refused (2), if it is accepted (1) or if the request is made (0) = default
     
     * @return TRUE if insert succeeded and FALSE if not
     */
    /*public function addFileUser($fileID,$userID,$fileUser)
     {
     if(empty($fileID)) return false;
     if(empty($userID)) return false;
     
     $visible=$this->getVisibility($fileID);
     
     $sql = "INSERT INTO utilisateur_fichier
     (uf_id_invite, uf_id_fichier, uf_lire, uf_modifier, uf_effacer,uf_demande_acces, uf_demande_date)
     VALUES (?,?,?,?,?,?,NOW())";
     
     $fuRead='0'; 		if(isset($fileUser['read'])) 			$fuRead=intval($fileUser['read']);
     $fuModify='0';		if(isset($fileUser['modify']))			$fuModify=intval($fileUser['modify']);
     $fuRemove='0';		if(isset($fileUser['remove']))			$fuRemove=intval($fileUser['remove']);
     
     if( ! $this->db->query($sql, array(intval($userID), intval($fileID), $fuRead, $fuModify, $fuRemove, intval($visible))) )
     {
     return false;
     }
     
     return true;
     
     }
     /**
     * getVisibility() this method returns a file based on its id
     
     * @param $fileID file id
     
     * @return a file the informations about the data source
     * <br> $response['visible'] default visibility attribute of data source (0=hidden, 1=visible, 2=on demand)
     
     */
    
     /*public function getVisibility($fileID)
     {
     
     $sql='SELECT f_visible_awe AS visible FROM fichierappli WHERE f_id=?';
     $query = $this->db->query($sql,intval($fileID));
     $visible = $query->result();
     
     return intval($visible);
     }*/
    
    //-------------------------------------------------------------
    //-------------------- INSERT ---------------------------------
    //-------------------------------------------------------------
    /**
	 * addDataSourceApp() is a method for adding a file

	 * @param $userID is is the id of the owner of the data source
	 * @param $dataSource is an array containing the informations about the data source
	 * @param $dataSource ['name'] (required) is the name of the data source
	 * @param $dataSource ['url'] (optional) is the access url to the data source (default value=NULL)
	 * @param $dataSource ['appli'] (optional) means if the id is an application (1) or not (0) =default
	 * @param $dataSource ['config'] (optional) could be, for exemple, a JSON app configuration file
	 * @param $dataSource ['visible'] (required) means if the data source have to be hidden (=2), visible (=1) or on demand (=0, default)
	 * @return new data source id if insert succeeded and FALSE if not
	 */
	public function addDataSourceApp($userID,$dataSource=NULL)
	{
		if(empty($userID)) return false;
		if(empty($dataSource ['name'])) return false;
		
		$fName = $dataSource['name'];
		
		$sql = "INSERT INTO fichierappli
					(f_id_proprio, f_nom, f_url, f_appli, f_config, f_visible_awe, f_dateajout)
					VALUES (?,?,?,?,?,?,NOW())";
		
		$fURL=NULL; 		if(isset($dataSource ['url'])) $fURL=$dataSource ['url'];
		$fAppli=0; 			if(isset($dataSource ['appli'])) $fAppli=intval($dataSource ['appli']);
		$fConfig=NULL; 		if(isset($dataSource ['config'])) $fConfig=$dataSource ['config'];
		$fVisible=0; 		if(isset($dataSource ['visible'])) $fVisible=intval($dataSource ['visible']);
			
		if( ! $this->db->query($sql, array(intval($userID), $fName, $fURL, intval($fAppli), $fConfig, intval($fVisible))) )
		{
			return false;
		}
		
		return $this->db->insert_id();
		
	}
		
	/**
	 * addFileProject() is a method to link a data source to a project
	 
	 * @param $dataSourceID (required) is the id of a data source
	 * @param $projectID (required) is the id of the project
	 * @param $askAccess (required) means if an access request is refused (2), if it is accepted (1) or if it is made (0) = default
	 
	 * @return TRUE if insert succeeded and FALSE if not
	 */
	public function addDataSourceProject($dataSourceID,$projectID,$askAccess)
	{
		if(empty($dataSourceID)) return false;
		if(empty($projectID)) return false;
			
		$sql = "INSERT INTO fichier_projet
					(fp_id_fichier, fp_id_projet, fp_demande_acces, fp_demande_date)
					VALUES (?,?,?,NOW())";
			
		if( ! $this->db->query($sql, array(intval($dataSourceID), intval($projID), intval($askAccess))) )
		{
			return false;
		} 
		return true;
		
	}

	/**
	 * addFileUser() is a method to add a data source for a user

	 * @param $dataSourceID (required) is the id of a data source
	 * @param $userID (required) is the id of a user
	 * @param $dataSourceUser (required) is an array containing the informations of the type of access has a user for a data source
	 * @param $dataSourceUser ['read'] (required) means if a user may read a data source or not (0) = default
	 * @param $dataSourceUser ['modify'] (required) means if a user may modify a data source or not (0) = default
	 * @param $dataSourceUser ['remove'] (required) means if a user may remove a data source or not (0) = default
	 * @param $dataSourceUser ['askaccess'] (required) means if an access request is refused (2), if it is accepted (1) or if the request is made (0) = default
	 
	 * @return TRUE if insert succeeded and FALSE if not
	 */
	public function addFileUser($dataSourceID,$userID,$dataSourceUser)
	{
	    if(empty($dataSourceID)) return false;
	    if(empty($userID)) return false;
		
		$sql = "INSERT IGNORE INTO utilisateur_fichier
					(uf_id_invite, uf_id_fichier, uf_lire, uf_modifier, uf_effacer, uf_demande_acces, uf_demande_date)
					VALUES (?,?,?,?,?,?,NOW())";
		
		$fuRead='0'; 		if(isset($dataSourceUser['read'])) 			    $fuRead=intval($dataSourceUser['read']);
		$fuModify='0';		if(isset($dataSourceUser['modify']))			$fuModify=intval($dataSourceUser['modify']);
		$fuRemove='0';		if(isset($dataSourceUser['remove']))			$fuRemove=intval($dataSourceUser['remove']);
		$askAccess = '0';   if(isset($dataSourceUser['askaccess']))         $askAccess=intval($dataSourceUser['askaccess']);
		
		if( ! $this->db->query($sql, array(intval($userID), intval($dataSourceID), intval($fuRead), intval($fuModify), intval($fuRemove), intval($askAccess))) )
		{
			return false;
		}
		
		return true;
		
	}
	
	//-------------------------------------------------------------
	//-------------------- DELETE ---------------------------------
	//-------------------------------------------------------------
	  
	/**
     * deleteDataSource() delete a data source based on its id
     
     * @param $dataSourceID
     
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
     */
	public function deleteDataSource($dataSourceID)
    {
        if(is_null($dataSourceID)) return false;
        
		$sql="DELETE FROM fichierappli WHERE f_id= ?";
        
		if( ! $this->db->query($sql, array(intval($dataSourceID))) ) return false;
		return true;
    
	}
    
	/**
	 * deleteUserDataSource() remove a data source for a specific user
	 
	 * @param $userID
	 * @param $dataSourceID
	 
	 * @return a boolean (TRUE if deletion has been applied, FALSE if not)
	 */
	public function deleteUserDataSource($userID, $dataSourceID)
    {
        if(empty($dataSourceID)) return false;
        if(empty($dataSourceID)) return false;
        
		$sql="DELETE FROM utilisateur_fichier WHERE uf_id_fichier=? AND uf_id_invite=?";
		
		if( ! $this->db->query($sql, array(intval($userID), intval($dataSourceID))) ) return false;
        return true;  
    
	}
	
	/**
	 * deleteDataSourceProject() remove a data source for a specific project
	 
	 * @param $dataSourceID
	 * @param $projID
	 
	 * @return a boolean (TRUE if deletion has been applied, FALSE if not)
	 */
	public function deleteDataSourceProject($dataSourceID, $projID)
    {
        if(empty($dataSourceID)) return false;
        if(empty($projID)) return false;
        
        $sql="DELETE FROM fichier_projet WHERE fp_id_projet=? AND fp_id_projet=?";
        
        if( ! $this->db->query($sql, array(intval($dataSourceID), intval($projID))) ) return false;
        return true;
        
    }
    
    /**
     * deleteAllDataSourcesUser() remove all data sources for a specific user
     
     * @param $userID
     
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
     */
    public function deleteAllDataSourcesUser($userID)
    {
        if(empty($userID)) return false;
        
        $sql="DELETE FROM utilisateur_fichier WHERE uf_id_invite=?";
        
		if( ! $this->db->query($sql, array(intval($userID))) ) return false;
        return true;
        
    }
	
	/**
     * deleteAllUsersDataSource() remove all users for a specific data source
     
     * @param $dataSourceID
     
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
     */
    public function deleteAllUsersDataSource($dataSourceID)
    {
        if(empty($dataSourceID)) return false;
        
        $sql="DELETE FROM utilisateur_fichier WHERE uf_id_fichier=?";
        
        if( ! $this->db->query($sql, array(intval($dataSourceID))) ) return false;
        return true;
        
    }
	
	/**
     * deleteAllProjectsDataSource() remove all projects for a specific data source
     
     * @param $dataSourceID
     
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
     */
    public function deleteAllProjectsDataSource($dataSourceID)
    {
        if(empty($dataSourceID)) return false;
        
        $sql="DELETE FROM fichier_projet WHERE fp_id_fichier=?";
        
        if( ! $this->db->query($sql, array(intval($dataSourceID))) ) return false;
        return true;
        
    }
	
	/**
     * deleteAllDataSourcesProject() remove all data sources for a specific project
     
     * @param $projectID
     
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
     */
    public function deleteAllDataSourcesProject($projectID)
    {
        if(empty($projectID)) return false;
        
        $sql="DELETE FROM fichier_projet WHERE fp_id_projet=?";
		
        if( ! $this->db->query($sql, array(intval($projectID))) ) return false;
        return true;
        
    }
	
	//-------------------------------------------------------------
    //-------------------- UPDATE ---------------------------------
    //-------------------------------------------------------------
	
	 /**
     * updateDataSource() is a method for updating a specific data source
     
	 * @param $userID is is the id of the owner of the data source
	 * @param $dataSource is an array containing the informations about the data source
	 * @param $dataSourceID is the id of the data source
	 * @param $dataSource ['name'] (optional) is the new name of the data source
	 * @param $dataSource ['url'] (optional) is the new access url to the data source (default value=NULL)
	 * @param $dataSource ['appli'] (optional) means if the id is an application (1) or not (0) =default
	 * @param $dataSource ['config'] (optional) could be, for exemple, a JSON app configuration file
	 * @param $dataSource ['visible'] (optional) means if the data source have to be hidden (=2), visible (=1) or if it is accessible on request (=0)
     
     * @return TRUE if update succeeded and FALSE if not
     */
    public function updateDataSource($dataSourceID,$userID = NULL,$dataSource = NULL)
    {       
        if(empty($dataSourceID)) return false;

        $first=true;
        $params = array();
        $sql="UPDATE fichierappli SET ";
        
        if(isset($userID))
        {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' f_id_proprio = ? ';
                $params[] = $userID;
        }
        if(isset($dataSource['name']))
        {
            if(!empty($dataSource['name']))
            {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' f_nom = ? ';
                $params[] = $dataSource['name'];
            }
        }
        if(isset($dataSource['url']))
        {
            if(!empty($dataSource['url']))
            {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' f_url = ? ';
                $params[] = $dataSource['url'];
            }
        }
        if(isset($dataSource ['appli']))
        {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' f_appli = ? ';
                $params[] = $dataSource ['appli'];
        }
        if(isset($dataSource ['config']))
        {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' f_config = ? ';
                $params[] = $dataSource ['config'];
        }
        if(isset($dataSource ['visible']))
        {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' f_visible_awe = ? ';
                $params[] = $dataSource ['visible'];
        }
		
        $sql.= " WHERE f_id= ? ";
        $params[] = intval($dataSourceID);
        
        if($first) return false;
        
        if( ! $this->db->query($sql, $params) ) return false;
        else return true;
      
    }
    
    /**
     * updateDataSourceUser() is a method for updating the access of a user to a data source
     
     * @param $dataSourceID contains the id of the data source
	 * @param $userID is the id of the user
     * @param $dataSourceUser ['read'] (optional) means if a user may read a data source or not (0) = default
	 * @param $dataSourceUser ['modify'] (optional) means if a user may modify a data source or not (0) = default
	 * @param $dataSourceUser ['remove'] (optional) means if a user may remove a data source or not (0) = default
	 * @param $dataSourceUser ['askaccess'] (optional) means if an access request is refused (2), if it is accepted (1) or if the request is made (0) = default
		   
     * @return TRUE if update succeeded and FALSE if not
     */
    public function updateDataSourceUser($dataSourceID, $userID, $dataSourceUser = NULL)
    {       
        if(is_null($dataSourceID)) return false;
        if(is_null($userID)) return false;
		
		$first=true;
        $params = array();
        $sql="UPDATE utilisateur_fichier SET ";
        
        if(isset($dataSourceUser['read']))
        {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' uf_lire = ? ';
                $params[] = intval($dataSourceUser['read']);
        }
        if(isset($dataSourceUser['modify']))
        {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' uf_modifier = ? ';
                $params[] = intval($dataSourceUser['modify']);
        }
        if(isset($dataSourceUser['remove']))
        {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' uf_effacer = ? ';
                $params[] = intval($dataSourceUser['remove']);
        }
        if(isset($dataSourceUser['askaccess']))
        {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' uf_demande_acces = ? ';
                $params[] = intval($dataSourceUser['askaccess']);
        }
        
        $sql.= " WHERE uf_id_fichier= ".intval($dataSourceID)." AND uf_id_invite = ".intval($userID);
        
        if($first) return false;
        
        if( ! $this->db->query($sql, $params) ) return false;
        else return true;
        
    }
	
	/**
     * updateDataSourceProject() is a method for updating the access of a project to a data source
     
     * @param $dataSourceID contains the id of the the id of the data source
	 * @param $projectID is the ID of the project
	 * @param $askAccess (required) means if an access request is refused (2), if it is accepted (1) or if the request is made (0) = default
		   
     * @return TRUE if update succeeded and FALSE if not
     */
    public function updateDataSourceProject($dataSourceID, $projectID, $askAccess)
    {       
        if(is_null($dataSourceID)) return false;
        if(is_null($projectID)) return false;
        		
		$first=true;
        $params = array();
        $sql="UPDATE fichier_projet SET ";
        
		if(isset($askAccess))
        {
                if($first) $first=false;
                else $sql.=', ';
                
                $sql.=' fp_demande_acces = ? ';
                $params[] = intval($askAccess);
        }
        
        $sql.= " WHERE fp_id_projet= ".intval($projectID)." AND fp_id_fichier = ".intval($dataSourceID);
        
        if($first) return false;
        
        if( ! $this->db->query($sql, $params) ) return false;
        else return true;
        
    }
	
	//-------------------------------------------------------------
    //-------------------- SELECT ---------------------------------
    //-------------------------------------------------------------
	

	/**
     * getDataSource() this method returns a data source based on its id
     
     * @param $dataSourceID data source id
     
     * @return a data source with its informations
     * <br> $response['id'] is the data source id
     * <br> $response['owner_id'] is the owner id
     * <br> $response['name']is the name of the data source
     * <br> $response['url'] is the url of the data source
     * <br> $response['application'] 0 for file and 1 for application
     * <br> $response['configuration'] is the configuration File
     * <br> $response['visible'] default visibility attribute for user files (0=hidden, 1=visible, 2=on demand)
     * <br> $response['add_date'] is the creation date of the data source in the database
     */
    public function getDataSource($dataSourceID)
    {
        if(is_null($dataSourceID)) return NULL;
        
        $sql="SELECT
					f_id AS id,
					f_id_proprio AS owner_id,
					f_nom AS name,
					f_url AS url,
					f_appli AS application,
                    f_config AS configuration_file,
                    f_visible_awe AS visible,
                    f_dateajout AS add_date
				FROM fichierappli
				WHERE (f_visible_awe = 0 OR f_visible_awe = 1) AND f_id = ? ";
        $query = $this->db->query($sql, array($dataSourceID));
        $File=$query->row_array();
        
        return $File;
    
	}
	
	 /**
     * getOwnedDataSources() this method returns the data sources that belong to a user
     
     * @param $userID user id
     
     * @return data sources with the firstname and lastname of the owner
     * <br> $response['id'] is the data source id
     * <br> $response['file_name'] is the name of the data source
     * <br> $response['url'] is the URL of the data source
     * <br> $response['application'] 0 for file and 1 for application
     * <br> $response['configuration'] is the configuration File
     * <br> $response['visible'] default visibility attribute for user files (0=hidden, 1=visible, 2=on demand)
     * <br> $response['add_date'] is the creation date of the data source in the database
     */
	public function getOwnedDataSources($userID)
    {
        if(is_null($userID)) return NULL;
        
        $sql="SELECT
					f_id AS id,
					f_nom AS file_name,
					f_url AS url,
					f_appli AS application,
                    f_config AS configuration,
                    f_visible_awe AS visible,
                    f_dateajout AS add_date
				FROM fichierappli
				WHERE f_id_proprio=?";
        $query = $this->db->query($sql, array($userID));
        $ownerFiles=$query->row_array();
        
        return $ownerFiles;
    
	}
 	
	/**
	* getDataSources() is a method for searching data sources in the database
	
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['file_name'] is optional and contains the name (can be partial) of searched data source(s)
	* @param $filter['file_url'] is optional and contains the url (can be partial) of searched data source(s)
	* @param $filter['application'] is optional and contains 0 for file and 1 for application
	* @param $filter['visible'] is optional and contains the default visible attribute for other users (0=hidden, 1=visible, 2=on demand)
	* @param $filter['add_date'] is optional and contains date when the data source(s) was/were added
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	
	* @return an array of data sources (ordered by date)
	* @see getFiles() for the data structure of returned data sources
	*/
	public function getDataSources($filter = NULL, $and = false)
	{
        $sql="SELECT
            	 f_id AS id,
            	 f_nom AS file_name,
            	 f_url AS file_url,
            	 f_appli AS application,
            	 f_config AS confiduration_file,
            	 f_dateajout AS add_date,
            	 f_id_proprio AS ownerID,
            	 f_visible_awe AS visible
            	 FROM fichierappli
                 WHERE (f_visible_awe = 0 OR f_visible_awe = 1) ";
        
        $params = array();
	 
        if(!is_null($filter))
        {
            $first=true;
            $operator=' OR ';
            if($and) $operator=' AND ';
            
            foreach($filter as $k => $v)
            {
                if($k=='file_name')
                {
                    if($first)
                    {
                        $sql.=' AND ( ';
                        $first=false;
                    }
                    else
                    {
                        $sql.=$operator;
                    }
                    $sql.='f_nom LIKE ?';
                    $params[] = '%'.$v.'%'; 
                }
                
                if($k=='file_url')
                {
                    if($first)
                    {
                        $sql.=' AND ( ';
                        $first=false;
                    }
                    else
                    {
                        $sql.=$operator;
                    }
                    $sql.='f_url LIKE ?';
                    $params[] = '%'.$v.'%';
                }

                if($k=='application')
                {
                    if($first)
                    {
                        $sql.=' AND ( ';
                        $first=false;
                    }
                    else
                    {
                        $sql.=$operator;
                    }
                    $sql.='f_appli = ?';
                    $params[] = $v ;
                }

                if($k=='add_date')
                {
                    if($first)
                    {
                        $sql.=' AND ( ';
                        $first=false;
                    }
                    else
                    {
                        $sql.=$operator;
                    }
                    $sql.='DATE(f_dateajout) = ?';
                    $params[] = $v ;
                }
                
                if($k=='ownerID')
                {
                    if($first)
                    {
                        $sql.=' AND ( ';
                        $first=false;
                    }
                    else
                    {
                        $sql.=$operator;
                    }
                    $sql.='f_id_proprio LIKE ?';
                    $params[] = $v ;
                }

                if($k=='visible')
                {
                    if($first)
                    {
                        $sql.=' AND ( ';
                        $first=false;
                    }
                    else
                    {
                         $sql.=$operator;
                    }
                    $sql.='f_visible_awe = ?';
                    $params[] = $v ;
                }
            }
            $sql.=' ) ';  	 
        }
        $sql.=' ORDER BY f_dateajout DESC';

        $query = $this->db->query($sql, $params);
        $dataSources=$query->result_array();

        return $dataSources;
	 }
	
	 public function getAccessibleDataSources($userID){
	     $userID = intval($userID);
	     $sql = "
            SELECT
    	       `ds`.`f_id`              AS `id`,
               `ds`.`f_id_proprio`      AS `owner_id`,
               `ds`.`f_nom`             AS `name`,
               `ds`.`f_url`             AS `url`,
               `ds`.`f_appli`           AS `is_application`,
               `ds`.`f_visible_awe`     AS `visibility`,
               `ds`.`f_dateajout`       AS `published`
    	     FROM `fichierappli` AS `ds`
             WHERE
                    `ds`.`f_visible_awe`=1
                OR  `ds`.`f_id_proprio`= $userID
                OR  $userID IN (SELECT `c_id_conseiller` FROM `conseil` WHERE `c_id_utilisateur` = `ds`.`f_id_proprio`)
                OR  $userID IN (
                                    SELECT `up`.`up_id_participant`
                                    FROM `utilisateur_projet` AS `up`
                                    LEFT JOIN `projet` AS `p` ON `up`.`up_id_projet`=`p`.`p_id`
                                    LEFT JOIN `fichier_projet` AS `fp` ON `fp`.`fp_id_projet`=`p`.`p_id`
                                    WHERE `fp`.`fp_demande_acces`=1 AND `fp`.`fp_id_fichier`=`ds`.`f_id`
                               )
	     ";
	     $query = $this->db->query($sql);
	     $dataSources=$query->result_array();
	     
	     return $dataSources;
	 }
	 
	 /**
	* getUserDataSources() is a method for searching the data sources of a user in the database
	
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['file_name'] is optional and contains the name (can be partial) of searched data source(s)
	* @param $filter['f_read'] is optional and contains the right to read the searched data source(s) or not
	* @param $filter['f_modify'] is optional and contains the right to modify the searched data source(s) or not 
	* @param $filter['f_remove'] is optional and contains the right to remove the searched data source(s) or not
	* @param $filter['access_state'] is optional and contains the access state (0=on demand, 1=OK, 2=KO) the searched data source(s) or not
	* @param $filter['ask_date'] is optional and contains the date when the user asked an access to the searched data source(s) or not
	* @param $filter['file_url'] is optional and contains the url of the searched data source(s) or not
	* @param $filter['application'] is optional and contains 1 if it's an application and 0 if not 
	* @param $filter['config'] is optional and contains the config file
	* @param $filter['visible'] is optional and contains the default visible attribute for user data sources (0=hidden, 1=visible, 2=on demand)
	* @param $filter['add_date'] is optional and contains the creation date of searched data source(s)
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	
	* @return an array of files (ordered by date)
	* @see getUserDataSources() for the data structure of returned files
	*/
	 public function getUserDataSources($userID,$filter = NULL, $and = false) 			
	{ 
	    if(is_null($userID)) return NULL;

	    $sql="SELECT
					uf_id_fichier AS fileID,
                    a.f_nom AS file_name,
					uf_lire AS f_read,
					uf_modifier AS f_modify,
					uf_effacer AS f_remove,
					uf_demande_acces AS access_state,
					uf_demande_date AS ask_date,
					a.f_url AS file_url,
					a.f_appli AS application, 
                    a.f_config AS configuration_file,
					a.f_visible_awe As visible,
					a.f_dateajout AS add_date           										
				FROM utilisateur_fichier
				JOIN fichierappli AS a
				ON utilisateur_fichier.uf_id_fichier=a.f_id
				WHERE uf_id_invite = ?";
		
	    $params = array();
	    $params [] = intval($userID); 
		
		if(!is_null($filter))
		{
		
			$first=true;	
			$operator=' OR ';
			if($and) $operator=' AND ';

			foreach($filter as $k => $v)
			{
				if($k=='file_name') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='a.f_nom LIKE ?';
					$params[] = '%'.$v.'%';

				}	
				if($k=='file_url') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='a.f_url LIKE ?';
					$params[] = '%'.$v.'%';
				}	
				if($k=='application') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='a.f_appli = ?';
					$params[] = $v;
				}
				if($k=='add_date') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='DATE(a.f_dateajout) = ?';
					$params[] = $v;
				}	
				if($k=='visible') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='a.f_visible_awe = ?';
					$params[] = $v;
				}
				
				if($k=='access_state') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='uf_demande_acces = ?';
					$params[] = $v;
				}			
			    if($k=='ask_date') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='DATE(uf_demande_date) = ?';
					$params[] = $v;
				}			
			}
			$sql.=' ) ';
		}
			
		$sql.=' ORDER BY a.f_dateajout DESC';		

		$query = $this->db->query($sql, $params);
		$dataSources=$query->result_array();		
		
		return $dataSources;
	}
	
	/**
	* getDataSourceUsers() is a method for searching the users of a data source in the database
	
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['user_name'] is optional and contains the lastname (can be partial) of searched user(s)
	* @param $filter['user_firstname'] is optional and contains the firstname (can be partial) of searched user(s)
	* @param $filter['access_state'] is optional and is a boolean which is for the access state (0 = asked, 1 OK, 2 KO)
	* @param $filter['ask_date'] is optional and contains  date when the user asked an access to the searched data source
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	
	* @return an array of data source(s) (ordered by date)
	* @see getDataSourceFiles() for the data structure of returned files
	*/
	public function getDataSourceUsers($dataSourceID,$filter = NULL, $and = false) 			
	{ 
	    if(is_null($dataSourceID)) return NULL;
	    
	    $sql="SELECT
					a.f_nom AS file_name,
					uf_id_invite AS userID,
                    utilisateur.ut_nom AS user_name,
                    utilisateur.ut_prenom AS user_firstname,
                    uf_lire AS f_read,
					uf_modifier AS f_modify,
					uf_effacer AS f_remove,
					uf_demande_acces AS access_state,
					uf_demande_date AS ask_date						
				FROM fichierappli AS a
				JOIN utilisateur_fichier
				ON a.f_id = utilisateur_fichier.uf_id_fichier
                JOIN utilisateur 
                ON utilisateur_fichier.uf_id_invite = utilisateur.ut_id
				WHERE (a.f_visible_awe = 0 OR a.f_visible_awe = 1) AND uf_id_fichier = ?";
		
		$params = array();
		$params[]=intval($dataSourceID);
		
		if(!is_null($filter))
		{
		
			$first=true;	
			$operator=' OR ';
			if($and) $operator=' AND ';

			foreach($filter as $k => $v)
			{		
				if($k=='user_name') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='utilisateur.ut_nom LIKE ?';
					$params[] = '%'.$v.'%';
				}
				if($k=='user_firstname')
				{
				    if($first)
				    {
				        $sql.=' AND ( ';
				        $first=false;
				    }
				    else
				    {
				        $sql.=$operator;
				    }
				    $sql.='utilisateur.ut_prenom LIKE ?';
				    $params[] = '%'.$v.'%';
				}
				
				if($k=='access_state') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='uf_demande_acces = ?';
					$params[] = $v;
				}			
			    if($k=='ask_date') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='DATE(uf_demande_date) = ?';
					$params[] = $v;
				}			
			}
			$sql.=' ) ';
		}
			
		$sql.=' ORDER BY uf_demande_date DESC';		

		$query = $this->db->query($sql, $params);
		$users=$query->result_array();		
		
		return $users;
	
	}
	
	/**
	* getProjectDataSources() is a method for searching the data sources of a project in the database
	
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['file_name'] is optional and contains the name (can be partial) of searched data source(s)
	* @param $filter['file_url'] is optional and contains the url of the searched data source(s) or not
	* @param $filter['application'] is optional and contains 1 if it's an application and 0 if not 
	* @param $filter['config'] is optional and contains the config file
	* @param $filter['visible'] is optional and contains the default visible attribute for user data sources (0=hidden, 1=visible, 2=on demand)
	* @param $filter['add_date'] is optional and contains the creation date of searched data source(s)
    * @param $filter['access_state'] is optional and contains the access state (0=on demand, 1=OK, 2=KO) to the searched data source(s) or not
	* @param $filter['ask_date'] is optional and contains the date when asked an access to the searched data source(s) or not
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	
	* @return an array of data sources (ordered by date)
	* @see getProjectDataSources() for the data structure of returned data sources
	*/
	public function getProjectDataSources($projecID,$filter = NULL, $and = false) 			
	{ 
	    if(is_null($projecID)) return NULL;
	    $sql="SELECT
					fp_id_projet AS projectID,
					fp_id_fichier AS fileID,
					fp_demande_acces AS access_state,
					fp_demande_date AS ask_date,
					a.f_nom AS file_name,
					a.f_url AS file_url,
					a.f_appli AS application, 
                    a.f_config AS confiduration_file,
					a.f_visible_awe As visible,
					a.f_dateajout AS add_date           										
				FROM fichier_projet
				JOIN fichierappli AS a
				ON fichier_projet.fp_id_fichier=a.f_id
				WHERE fp_id_projet = ? ";
		
		$params = array();
		$params [] = intval($projecID);
		
		if(!is_null($filter))
		{

		    $first=true;	
			$operator=' OR ';
			if($and) $operator=' AND ';

			foreach($filter as $k => $v)
			{
				if($k=='file_name') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='a.f_nom LIKE ?';
					$params[] = '%'.$v.'%';

				}	
				if($k=='file_url') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='a.f_url LIKE ?';
					$params[] = '%'.$v.'%';
				}	
				if($k=='application') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='a.f_appli = ?';
					$params[] = $v;
				}
				if($k=='add_date') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='DATE(a.f_dateajout) = ?';
					$params[] = $v;
				}	
				if($k=='visible') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='a.f_visible_awe = ?';
					$params[] = $v;
				}
				
				if($k=='access_state') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='fp_demande_acces = ?';
					$params[] = $v;
				}			
    			if($k=='ask_date') 
    				{ 
    					if($first)
    					{
    						$sql.=' AND ( ';
    						$first=false;
    					} 
    					else
    					{
    						$sql.=$operator;
    					}
    					$sql.='DATE(fp_demande_date) = ?';
    					$params[] = $v;
    				}			
    			}
			$sql.=' )';
		}
			
		$sql.=' ORDER BY a.f_dateajout DESC';		

		$query = $this->db->query($sql, $params);
		$dataSources=$query->result_array();		
		
		return $dataSources;
	}
	
	/**
	* getDataSourceProjects() is a method for searching the projects linked with a data source in the database
	
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['project_name'] is optional and contains the name (can be partial) of searched project(s)
	* @param $filter['ask_access'] is optional and contains the access state (0=on demand, 1=OK, 2=KO) to the searched project(s)
	* @param $filter['ask_date'] is optional and contains the date when asked an access to the searched project(s)
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing the search query with OR operators and TRUE for AND operators
	
	* @return an array of files (ordered by date)
	* @see getUserDataSources() for the data structure of returned projects
	*/
	public function getDataSourceProjects($dataSourceID, $filter = NULL, $and = false) 			
	{ 
	    if(is_null($dataSourceID)) return NULL;
	    $sql="SELECT
                    p.fp_id_projet AS project_ID,
                    projet.p_nom AS project_name,
                    p.fp_demande_acces AS access_state,
					p.fp_demande_date AS ask_date         										
				FROM fichier_projet AS p
				JOIN projet
				ON p.fp_id_fichier=p_id
				WHERE p.fp_id_fichier = ?";
		
		$params = array();
		$params [] = intval($dataSourceID);
		
		if(!is_null($filter))
		{
		
			$first=true;	
			$operator=' OR ';
			if($and) $operator=' AND ';

			foreach($filter as $k => $v)
			{
				if($k=='project_name') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='projet.p_nom LIKE ?';
					$params[] = '%'.$v.'%';
				}
				if($k=='access_state') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='p.fp_demande_acces = ?';
					$params[] = $v;
				}			
			    if($k=='ask_date') 
				{ 
					if($first)
					{
						$sql.=' AND ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='DATE(p.fp_demande_date) = ?';
					$params[] = $v;
				}
			}
			$sql.=' ) ';
		}
			
		$sql.=' ORDER BY projet.p_date_start DESC';		

		$query = $this->db->query($sql, $params);
		$projects=$query->result_array();		
		
		return $projects;
	
	}
	
}
