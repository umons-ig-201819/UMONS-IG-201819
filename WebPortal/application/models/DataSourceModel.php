<?php 
/**
 * \file      models/DataSourceModel.php
 * \author    EmilieG
 * \version   1.1
 * \date      2019-05-19
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
		$fAppli=0; 	        if(isset($dataSource ['appli'])) $fAppli=intval($dataSource ['appli']);
		$fConfig=NULL; 		if(isset($dataSource ['config'])) $fConfig=$dataSource ['config'];
		$fVisible=0; 		if(isset($dataSource ['visible'])) $fVisible=intval($dataSource ['visible']);
			
		if( ! $this->db->query($sql, array(intval($userID), $fName, $fURL, intval($fAppli), $fConfig, intval($fVisible))) )
		{
			return false;
		}
		
		return true;
			//$this->db->insert_id();
		
	}
     
     /**
      * addAdvisor() is a method for adding a data source for a user
      *
      * @param $sourceID (required) is the id of a data source
      * @param $advisorUsername (required) is the login of a user
      
      * @return the affected rows
      */
     public function addAdvisor($sourceID, $advisorUsername){
         $sourceID        = intval($sourceID);
         $advisorUsername = trim($advisorUsername);
         $sql = "
            INSERT IGNORE INTO `utilisateur_fichier`(`uf_id_invite`, `uf_id_fichier`, `uf_lire`, `uf_modifier`, `uf_effacer`, `uf_demande_acces`, `uf_demande_date`)
            SELECT utilisateur.ut_id, $sourceID, 1, 0, 0, 1, NOW()
            FROM utilisateur
            WHERE utilisateur.ut_login = ? ";
         $this->db->query($sql, array($advisorUsername));
         return $this->db->affected_rows();
     }
     
     /**
      * askAccess() is a method for asking the access to a data source
      *
      * @param $sourceID (required) is the id of a data source
      * @param $userID (required) is the id of a user
      
      */
     public function askAccess($sourceID, $userID){
         $sourceID     = intval($sourceID);
         $userID       = intval($userID);
         //  0=demande effectuee, 1=OK, 2=refus
         $sql = "
            INSERT IGNORE INTO  `utilisateur_fichier`(`uf_id_invite`, `uf_id_fichier`, `uf_lire`, `uf_modifier`, `uf_effacer`, `uf_demande_acces`, `uf_demande_date`)
	       VALUES ($userID, $sourceID, 1, 0, 0, 0, NOW());"
	       ;
	       $this->db->query($sql);
     }
     
     /**
      * addProject() is a method for adding a data source for a user
      *
      * @param $sourceID (required) is the id of a data source
      * @param $projectName (required) is the login of a user
      
      * @return the affected rows
      */
     public function addProject($sourceID, $projectName){
         $sourceID        = intval($sourceID);
         $projectName     = trim($projectName);
         $sql = "
            INSERT IGNORE INTO fichier_projet (fp_id_fichier, fp_id_projet, fp_demande_acces, fp_demande_date)
					SELECT $sourceID,projet.p_id,1,NOW()
            FROM projet
            WHERE projet.p_nom = ? ";
         $this->db->query($sql, array($projectName));
         return $this->db->affected_rows();
     }
     
     /**
      * askAccessProject() is a method for asking the access to a data source
      *
      * @param $sourceID (required) is the id of a data source
      * @param $projectID (required) is the id of a user
      
      */
     public function askAccessProject($sourceID, $projectID){
         $sourceID     = intval($sourceID);
         $projectID       = intval($projectID);
         //  0=demande effectuee, 1=OK, 2=refus
         $sql = "
            INSERT IGNORE INTO  `fichier_projet`(fp_id_fichier, fp_id_projet, fp_demande_acces, fp_demande_date)
	       VALUES ($sourceID, $projectID, 0, NOW());"
	       ;
	       $this->db->query($sql);
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
        $dataSourceID = intval($dataSourceID);
        
        $sql = "DELETE FROM utilisateur_fichier WHERE uf_id_fichier=?";
        if( ! $this->db->query($sql, array($dataSourceID)) ) return false;
        
		$sql="DELETE FROM fichierappli WHERE f_id= ?";
		if( ! $this->db->query($sql, array($dataSourceID)) ) return false;
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
     * revokeAccess() remove a data source for a specific user
     
     * @param $adivsorID is the id of the user invited to the data source
     * @param $ourceID is the data source id
     
     */
    public function revokeAccess($sourceID, $advisorID){
        $sourceID     = intval($sourceID);
        $advisorID    = intval($advisorID);
        //  0=demande effectuee, 1=OK, 2=refus
        $sql = "DELETE FROM `utilisateur_fichier` WHERE `uf_id_invite`=$advisorID AND `uf_id_fichier`=$sourceID";
        $this->db->query($sql);
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
     * acceptAccess() is a method for accepting the access of a user to a data source
     
     * @param $sourceID contains the id of the the id of the data source
     * @param $advisorID is the ID of the user
     
     */
    public function acceptAccess($sourceID, $advisorID){
        $sourceID     = intval($sourceID);
        $advisorID    = intval($advisorID);
        //  0=demande effectuee, 1=OK, 2=refus
        $sql = "UPDATE `utilisateur_fichier` SET `uf_demande_acces`=1 WHERE `uf_id_invite`=$advisorID AND `uf_id_fichier`=$sourceID";
        $this->db->query($sql);
    }
    
    /**
     * refuseAccess() is a method for refusing the access of a user to a data source
     
     * @param $sourceID contains the id of the the id of the data source
     * @param $advisorID is the ID of the user
     
     */
    public function refuseAccess($sourceID, $advisorID){
        $sourceID     = intval($sourceID);
        $advisorID    = intval($advisorID);
        //  0=demande effectuee, 1=OK, 2=refus
        $sql = "UPDATE `utilisateur_fichier` SET `uf_demande_acces`=2 WHERE `uf_id_invite`=$advisorID AND `uf_id_fichier`=$sourceID";
        $this->db->query($sql);
    }
    
    /**
     * acceptAccessProject() is a method for accepting the access of a project to a data source
     
     * @param $sourceID contains the id of the the id of the data source
     * @param $projectID is the ID of the project
     
     */
    public function acceptAccessProject($sourceID, $projectID){
        $sourceID     = intval($sourceID);
        $projectID    = intval($projectID);
        //  0=demande effectuee, 1=OK, 2=refus
        $sql = "UPDATE `fichier_projet` SET `fp_demande_acces`=1 WHERE `fp_id_projet`=$projectID AND `fp_id_fichier`=$sourceID";
        $this->db->query($sql);
    }
    
    /**
     * refuseAccessProject() is a method for refusing the access of a project to a data source
     
     * @param $projectID is the id of the user invited to the data source
     * @param $ourceID is the data source id
     
     */
    public function refuseAccessProject($sourceID, $projectID){
        $sourceID     = intval($sourceID);
        $projectID    = intval($projectID);
        //  0=demande effectuee, 1=OK, 2=refus
        $sql = "UPDATE `fichier_projet` SET `fp_demande_acces`=2 WHERE `fp_id_projet`=$projectID AND `fp_id_fichier`=$sourceID";
        $this->db->query($sql);
    }
	
    //-------------------------------------------------------------
    //-------------------- SELECT ---------------------------------
    //-------------------------------------------------------------

    /**
     * getVisibility() this method returns a data source based on its id
     
     * @param $dataSourceID data source id
     
     * @return the value of the visibility of a data source with its informations

     */
    public function getVisibility($dataSourceID)
    {
	    if(empty($dataSourceID)) return false;
    $sql="SELECT f_visible_awe FROM fichierappli WHERE f_id=?";
    $result = $this->db->query($sql,array($dataSourceID));
    $visible = $result->row_array();
    $access = intval($visible['f_visible_awe']);
    if(is_null($access)) return false;
    return $access;
    }
	
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
        if(is_null($dataSourceID)) return false;
        
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
				WHERE f_id = ? ";
        $query = $this->db->query($sql, array($dataSourceID));
        $file=$query->row_array();
        if(is_null($file['id'])) return true;
        return $file;
    
	}
	
	/**
	 * searchDataSources() is a method for searching data sources in the database
	 
	 * @param $filter is optional and is an array containing search criterions
	 * @param $filter['owner'] is optional and contains the name (can be partial) of the owner of a data source
	 * @param $filter['name'] is optional and contains the name (can be partial) of searched data source(s)

	 * @return an array of data sources (ordered by file name)
	 * @see searchDataSources() for the data structure of returned data sources
	 */	
	public function searchDataSources($filter = NULL, $and = false) {
	    $conditions = '';
	    $prep = array();
	    if(!is_null($filter)){
	        $and = $and ? 'AND' : 'OR';
	        if(array_key_exists('owner',$filter)){
	            $conditions .= "$and utilisateur.ut_login LIKE ?";
	            array_push($prep,"%$filter[owner]%");
	        }
	        if(array_key_exists('name',$filter)){
	            $conditions .= "$and fichierappli.f_nom LIKE ?";
	            array_push($prep,"%$filter[name]%");
	        }
	        if(!empty($conditions)) $conditions = substr($conditions,strlen($and));
	    }
	    $sql = 'SELECT
    	    f_id AS id,
    	    f_nom AS file_name,
    	    f_url AS file_url,
    	    f_appli AS application,
    	    f_config AS confiduration_file,
    	    f_dateajout AS add_date,
    	    f_id_proprio AS ownerID,
    	    f_visible_awe AS visible,
            utilisateur.ut_login AS login
	    FROM fichierappli, utilisateur
	    WHERE fichierappli.f_id_proprio = utilisateur.ut_id';
	    if(!empty($conditions)){
	        $sql = "$sql AND ($conditions) ORDER BY file_name";
	        $query = $this->db->query($sql, $prep);
	        return $query->result_array();
	    }
	    $sql = "$sql ORDER BY file_name";
	    $query = $this->db->query($sql);
	    //if(is_null($query['id'])) return false;
	    return $query->result_array();
	}
 	
    /**
    * getPersonalDataSources() this method returns the data sources that belong to a user

    * @param $userID user id

    * @return datasources of the user
    * <br> $response['id'] is the data source id
    * <br> $response['file_name'] is the name of the data source
    * <br> $response['url'] is the URL of the data source
    * <br> $response['application'] 0 for file and 1 for application
    * <br> $response['configuration'] is the configuration File
    * <br> $response['visible'] default visibility attribute for user files (0=hidden, 1=visible, 2=on demand)
    * <br> $response['add_date'] is the creation date of the data source in the database
    */
	
	public function getPersonalDataSources($userID){
	    $userID = intval($userID);
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
	    $result=$query->result_array();
	    //if(is_null($result['id'])) return false;
	    return $result;
	}
	
	/**
	 * getProjects() is a method for searching the projects linked with a data source in the database
	 
	 * @param $sourceID data source id
	 
	 * @return an array of projects that requested access to a data source
     * <br> $response['id'] is the project id
     * <br> $response['name'] is the name of the project
     * <br> $response['end_date'] is the date of the end of the project
     * <br> $response['state'] is the 'access state' with the possible values 0(=asked), 1(=accepted), 2(=refused)
	 */
	public function getProjects($sourceID){
	    $sourceID = intval($sourceID);
	    $sql="SELECT
                projet.p_id                     AS id,
                projet.p_nom                    AS name,
                projet.p_date_end               AS end_date,
                fichier_projet.fp_demande_acces AS state
              FROM projet, fichier_projet
              WHERE fichier_projet.fp_id_projet = projet.p_id
                AND fichier_projet.fp_id_fichier = ?
        ";
	    $query = $this->db->query($sql, array($sourceID));
	    $result=$query->result_array();
	    //if(is_null($result['id'])) return false;
	    return $result;
	}
	
	/**
	 * getAccessDataSources() is a method to search for data sources that a user has access to
	 
	 * @param $advisorID is the user ID
	 * 
	 * @return an array of data sources
	 * <br> $response['id'] is the data source id
     * <br> $response['file_name'] is the name of the data source
     * <br> $response['url'] is the URL of the data source
     * <br> $response['application'] 0 for file and 1 for application
     * <br> $response['configuration'] is the configuration File
     * <br> $response['visible'] default visibility attribute for user files (0=hidden, 1=visible, 2=on demand)
     * <br> $response['add_date'] is the creation date of the data source in the database
	 */
	public function getAccessDataSources($advisorID){
	    $advisorID = intval($advisorID);
	    $sql="SELECT
					f_id AS id,
					f_nom AS file_name,
					f_url AS url,
					f_appli AS application,
                    f_config AS configuration,
                    f_visible_awe AS visible,
                    f_dateajout AS add_date
				FROM fichierappli, utilisateur_fichier
				WHERE utilisateur_fichier.uf_id_fichier=fichierappli.f_id AND utilisateur_fichier.uf_demande_acces=1 AND utilisateur_fichier.uf_id_invite=?";
	    $query = $this->db->query($sql, array($advisorID));
	    $result=$query->result_array();
	    //if(is_null($result['id'])) return false;
	    return $result;
	}
	
	/**
	 * getAdvisors() is a method to search for users who requested access to data sources
	 
	 * @param $sourceID is the data source ID
	 *
	 * @return an array of users
	 * <br> $response['userid'] is the user id
	 * <br> $response['username'] is the user login
	 * <br> $response['firstname'] is the user firstname
	 * <br> $response['lastname'] is the user lasstname
	 * <br> $response['state'] is the state of accessibility to the data source
	 */
	public function getAdvisors($sourceID){
	    $sourceID = intval($sourceID);
	    $sql="
            SELECT
                utilisateur.ut_id                       AS userid,
                utilisateur.ut_login                    AS username,
                utilisateur.ut_nom                      AS firstname,
                utilisateur.ut_prenom                   AS lastname,
                utilisateur_fichier.uf_demande_acces    AS state
            FROM utilisateur, utilisateur_fichier
            WHERE utilisateur_fichier.uf_id_invite = utilisateur.ut_id
                AND utilisateur_fichier.uf_id_fichier = ?
        ";
	    $query = $this->db->query($sql, array($sourceID));
	    $result=$query->result_array();
	    //if(is_null($result['userid'])) return false;
	    return $result;
	}
	 
	/**
	 * getAccessibleDataSources() is a method to search for users who requested access to data sources
	 
	 * @param $userID is the user ID
	 *
	 * @return an array of data sources
	 * <br> $response['id'] is the data source id
	 * <br> $response['owner_id'] is the owner id
	 * <br> $response['name'] is the name of the data source
	 * <br> $response['is_application'] describes whether the data source is an application or not
	 * <br> $response['visibility'] is the visibility of the data source (0, 1, 2)
	 * <br> $response['published'] is the date when the data source was added
	 */
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
                                    AND DATE(p.p_date_end)>=current_timestamp()
                                )
               OR $userID IN (	SELECT p.p_id_createur 
                         	      FROM projet AS p
                         	      LEFT JOIN fichier_projet AS fp ON fp.fp_id_projet=p.p_id
                         	      WHERE fp.fp_demande_acces=1 AND fp.fp_id_fichier=ds.f_id
                         	      AND DATE(p.p_date_end)>=current_timestamp()
                              )
	     ";
	     $query = $this->db->query($sql);
	     $dataSources=$query->result_array();
	     //if(is_null($dataSources['id'])) return false;
	     return $dataSources;
	 }
	
	/**
	* getUserID() is a method for searching the userID of the last record 
	* @return userID
	* @see function for tests
	*/
	public function getUserID()
	{
	    
	    $sql="SELECT
				f_id,
				f_id_proprio
               FROM fichierappli
				ORDER BY f_id_proprio DESC";
	    $query = $this->db->query($sql);
	    $id=$query->result_array();
	    $lastiduser=$id[0]["f_id_proprio"];
           
	    return $lastiduser;
	}	
	
	/**
	* getDataSourceID() is a method for searching the dataSourceID of the last record 
	* @return dataSourceID
	* @see function for tests
	*/
	public function getDataSourceID()
	{
	    
	    $sql="SELECT
				f_id,
				f_id_proprio
               FROM fichierappli
				ORDER BY f_id DESC";
	    $query = $this->db->query($sql);
	    $id=$query->result_array();
	    $lastiddatasource=$id[0]["f_id"];
	    return $lastiddatasource;
	}
	
	/**
	* getProjetID() is a method for searching the ProjetID of the last record 
	* @return projetID
	* @see function for tests
	*/
	public function getProjetID()
	{
	    
	    $sql="SELECT
				fp_id_fichier,
				fp_id_projet 
               FROM fichier_projet
				ORDER BY fp_id_projet DESC";
	    $query = $this->db->query($sql);
	    $id=$query->result_array();
	    $lastidproj=$id[0]["fp_id_projet"];
	    return $lastidproj;
	}	
	 
	/**
	* getAdvisorID() is a method for searching the advisorID of the last record 
	* @return advisorID
	* @see function for tests
	*/
	public function getAdvisorID()
	{
	    
	    $sql="SELECT
				uf_id_invite,
				uf_id_fichier
               FROM utilisateur_fichier
				ORDER BY uf_id_fichier DESC";
	    $query = $this->db->query($sql);
	    $id=$query->result_array();
	    $lastidadvisor=$id[0]["uf_id_fichier"];
	    return $lastidadvisor;
	}
	/**
	* getAccessUtilisateurFichier() is a method to retrieve the access code from the uilisateur_fichier table
	* @return advisorID
	* @see function for tests
	*/
	public function getAccessUtilisateurFichier($advisorID,$sourceID)
	{
	    
	    $sql="SELECT
				uf_demande_acces as access
               FROM utilisateur_fichier
				WHERE `uf_id_invite`=$advisorID AND `uf_id_fichier`=$sourceID";
	    $query = $this->db->query($sql);
	    $acces=$query->row_array();
	    if(is_null($acces['access'])) return '4';
	    return $acces;
	}
	/**
	* getAccessFichierProjet() is a method for searching the access code of the fichier_projet table 
	* @return access
	* @see function for tests
	*/
	public function getAccessFichierProjet($projectID,$sourceID)
	{
	    
	    $sql="SELECT
				 fp_demande_acces as access
               FROM fichier_projet
				WHERE `fp_id_projet`=$projectID AND `fp_id_fichier`=$sourceID";
	    $query = $this->db->query($sql);
	    $acces=$query->row_array();
            if(is_null($acces['access'])) return '4';
	    return $acces;
	}
}
