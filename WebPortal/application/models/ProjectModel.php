<?php

/**
 * \file      models/ProjectModel.php
 * \author    EmilieG
 * \version   1.0
 * \date      2019-03-25
 * \brief     Model to manage projects for the Wallesmart database
 *
 * \details   This class is supposed to be used with the codeigniter framework
 */
class ProjectModel extends CI_Model
{

    /**
     * __construct() is the constructor which initiates the connection to the database
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    // -------------------------------------------------------------
    // -------------------- INSERT ---------------------------------
    // -------------------------------------------------------------

    /**
     * addProject() is a method for adding a project
     *
     * @param $userID is
     *            is the id of the owner of the project
     * @param $project is
     *            an array containing project data
     * @param $project['pname'] (required)
     *            contains the name of the project
     * @param $project['pdescription'] (optional)
     *            contains the description of the project
     * @param $project['pdate_start'] (required)
     *            contains the date of the beginning of the project
     * @param $project['pdate_end'] (required)
     *            contains the date of the end of the project
     *            
     * @return new project id if insert succeeded and FALSE if not + name of the creator of the project
     */
    public function addProject($userID, $project = NULL)
    {
        if (empty($userID))
            return false;

        if (empty($project['pname']))
            return false;
        if (empty($project['pdate_start']))
            return false;
        if (empty($project['pdate_end']))
            return false;

        $pName = $project['pname'];
        $pDateStart = $project['pdate_start'];
        $pDateEnd = $project['pdate_end'];

        $sql = "INSERT INTO projet
				(p_nom, p_description, p_date_start, p_date_end, p_id_createur)
				VALUES (?,?,?,?,?)";

        $pDescription = NULL;
        if (isset($project['pdescription']))
            $pDescription = $project['pdescription'];

        if (! $this->db->query($sql, array(
            $pName,
            $pDescription,
            $pDateStart,
            $pDateEnd,
            $userID
        ))) {
            return false;
        }
        // 0=demande effectuee, 1=OK, 2=refus
        $projectID = $this->db->insert_id();
        $sql = "INSERT INTO fichier_projet (p_id_fichier, fp_id_projet, fp_demande_acces, fp_demande_date)
            SELECT f.f_id,$projectID,f.f_visible_awe,NOW()
            FROM fichierappli AS f";
        $this->db->query($sql);
        return $projectID;
    }

    /**
     * addUserProject() is a method for adding a member into a project
     *
     * @param $userID (required)
     *            is the id of a participant
     * @param $projectID (required)
     *            is the id of the project
     * @param $userProject ['role_project']
     *            (optional) contains the role of the participant in the project
     * @param $userProject ['gestion']
     *            (required) means if a participant may manage the project (1) or not (0) =default
     *            
     * @return TRUE if insert succeeded and FALSE if not
     */
    public function addUserProject($userID, $projID, $userProject)
    {
        if (empty($userID))
            return false;
        if (empty($projID))
            return false;

        $gestion = $userProject['gestion'];
        $roleProject = $userProject['role_project'];

        $sql = "INSERT INTO utilisateur_projet
				(up_id_participant, up_id_projet, up_role_pour_ce_projet, up_gestion)
				VALUES (?,?,?,?)";

        $roleProject = NULL;
        if (isset($userProject['role_project']))
            $roleProject = $userProject['role_project'];
        $gestion = '0';
        if (isset($userProject['gestion']))
            $gestion = intval($userProject['gestion']);

        if (! $this->db->query($sql, array(
            intval($userID),
            intval($projID),
            $roleProject,
            intval($gestion)
        ))) {
            return false;
        }

        return true;
    }

    // -------------------------------------------------------------
    // -------------------- SELECT ---------------------------------
    // -------------------------------------------------------------

    /**
     * getProject() this method returns a project based on its id
     *
     * @param $projID project id
     *            
     * @return a project with the firstname and lastname of project creator
     *         <br> $response['id'] is the project id
     *         <br> $response['project_name'] is the name of the project
     *         <br> $response['date_start'] is the date when the projet begin
     *         <br> $response['date_end'] is the date when the projet end
     *         <br> $response['owner_lastname'] is the lastname of creator
     *         <br> $response['owner_firstname'] is the firstname of creator
     *         <br> $response['project_description'] is the description of the project
     */
    public function getProject($projID)
    {
        if (is_null($projID))
            return NULL;
        $sql = "SELECT
					p_id AS id,
					p_nom AS project_name,
					p_date_start AS date_start,
					p_date_end AS date_end,
					u.ut_nom AS owner_lastname,
                    u.ut_prenom as owner_firstname,
                    p_description AS project_description
				FROM projet
				JOIN utilisateur AS u
				ON u.ut_id=p_id_createur
				WHERE p_id=?";
        $query = $this->db->query($sql, array(
            $projID
        ));
        $project = $query->result_array();

        return $project;
    }

    public function listProjects($filter = NULL, $and = false){
        $where = '';
        $and   = $and ? ' AND': ' OR';
        $eq    = array('id' => 'p_id','date_start' => 'p_date_start','date_end' => 'p_date_end');
        $like  = array('project_name' => 'p_nom','owner_lastname' => 'u.ut_nom','owner_firstname' => 'u.ut_prenom','project_description' => 'p_description');
        foreach($eq as $k => $v){
            if(array_key_exists($k,$filter))
                $where .= "$and $v = ".$filter[$k];
        }
        foreach($like as $k => $v){
            if(array_key_exists($k,$filter))
                $where .= "$and $v LIKE '%".$filter[$k]."%'";
        }
        if(strlen($where)>0){
            $where = ' WHERE '.substr($where, strlen($and));
        }
        $sql   = "SELECT
					p_id AS id,
					p_nom AS project_name,
					p_date_start AS date_start,
					p_date_end AS date_end,
					u.ut_nom AS owner_lastname,
                    u.ut_prenom as owner_firstname,
                    p_description AS project_description
				FROM projet
				JOIN utilisateur AS u
				ON u.ut_id=p_id_createur $where ORDER BY p_nom ASC";
        $query = $this->db->query($sql);
        $projects = $query->result_array();
        
        return $projects;
    }
    
    /**
     * getProjects() this method returns a project based on its id
     *
     * @param $projID project id
     * @param $filter is optional and is an array containing search criterions           
     * @param $filter['id'] is the project id
     * @param $filter['project_name'] is the name of the project
     * @param $filter['project_description'] is the description of the project
     * @param $filter['date_start'] is the date when the projet begin
     * @param $filter['date_end'] is the date when the projet end
     * @param $filter['owner_lastname'] is the lastname of creator
     * @param $filter['owner_firstname'] is the firstname of creator
	 * @param $and is optional and is an boolean which is FALSE (default behavior) for processing teh search query with OR operators and TRUE for AND operators
	 
	 * @return an array of projects (date start descending order)
	 * @see getProjects() for the data structure of returned users
     */
    public function getProjects($filter = NULL, $and = false)
    {
        $sql = "SELECT
					p_id AS id,
					p_nom AS project_name,
					p_date_start AS date_start,
					p_date_end AS date_end,
					u.ut_nom AS owner_lastname,
                    u.ut_prenom as owner_firstname,
                    p_description AS project_description
				FROM projet
				JOIN utilisateur AS u
				ON u.ut_id=p_id_createur";

        $params = array();

        if (! is_null($filter)) {
            $first = true;
            $operator = ' OR ';
            if ($and)
                $operator = ' AND ';

            foreach ($filter as $k => $v) {

                if ($k == 'project_name') {
                    if ($first) {
                        $sql .= ' WHERE ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'p_nom LIKE ?';
                    $params[] = '%' . $v . '%';
                }

                if ($k == 'project_date_start') {
                    if ($first) {
                        $sql .= ' WHERE ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'DATE(p_date_start)=?';
                    $params[] = $v;
                }

                if ($k == 'project_date_end') {
                    if ($first) {
                        $sql .= ' WHERE ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'DATE(p_date_end)=?';
                    $params[] = $v;
                }

                if ($k == 'owner_lastname') {
                    if ($first) {
                        $sql .= ' WHERE ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'u.ut_nom LIKE ?';
                    $params[] = '%' . $v . '%';
                }

                if ($k == 'owner_firstname') {
                    if ($first) {
                        $sql .= ' WHERE ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'u.ut_prenom LIKE ?';
                    $params[] = '%' . $v . '%';
                }
            }
            //$sql .= ')';
        }

        $sql .= ' ORDER BY p_date_start DESC';

        $query = $this->db->query($sql, $params);
        $Projects = $query->result_array();

        return $Projects;
    }

    /**
     * getProjectMembers() this method returns the members of a project based on its id
     *
     * @param $projID project id  
     * @param $filter is optional and is an array containing search criterions   
     * @param $filter['member_lastname'] is the lastname of a member
     * @param $filter['member_firstname'] is the firstname of a member
     * @param $filter['member_role'] is the role of a member
     * @param $filter['member_gestion'] means 1 or 0 (if the participant may not manage the project)
     * @param $filter['owner_lastname'] is the lastname of the project's owner
     * @param $filter['owner_firstname'] is the firstname of the project's owner
	 * @param $and is optional and is an boolean which is FALSE (default behavior) for processing teh search query with OR operators and TRUE for AND operators
	 
	 * @return an array of members for a project (name ascending order)
	 * @see getProjectMembers() for the data structure of returned users
     */
    public function getProjectMembers($projID, $filter = NULL, $and = false)
    {
        if (is_null($projID))
            return NULL;
            $sql = "SELECT  u.ut_nom AS member_lastname, 
                            u.ut_prenom AS member_firstname, 
                            u.ut_id AS member_id, 
                            u.ut_login AS member_username, 
                            up.up_role_pour_ce_projet AS member_role, 
                            up.up_gestion AS member_gestion, 
                            u2.ut_nom AS owner_lastname, 
                            u2.ut_prenom AS owner_firstname
                    FROM utilisateur u
                    	JOIN utilisateur_projet up
                        	ON up_id_participant = ut_id
                        JOIN projet p
                        	ON up_id_projet = p_id
                        JOIN utilisateur u2
                        	ON p_id_createur = u2.ut_id
                    WHERE p_id = $projID";
        
            /*
             * SELECT DISTINCT
					u.ut_id AS member_id,
                    u.ut_nom AS member_lastname,
                    u.ut_prenom as member_firstname
                FROM utilisateur AS u
                JOIN utilisateur_projet AS up
                ON u.ut_id =  up_id_participant
				WHERE
				up_id_projet = $projID
				OR $projID IN (SELECT p.p_id
								FROM projet AS p
								LEFT JOIN utilisateur AS u
								ON u.ut_id=p.p_id_createur)
             */
            
            /* "SELECT DISTINCT
             u.ut_id AS member_id,
             u.ut_nom AS member_lastname,
             u.ut_prenom as member_firstname,
             IF(up.up_id_participant=u.ut_id,up.up_role_pour_ce_projet,NULL) AS role,
             IF(up.up_id_participant=u.ut_id,up.up_gestion,0) AS manage
             FROM utilisateur AS u
             JOIN utilisateur_projet AS up
             ON up.up_id_participant=u.ut_id
             WHERE
             up.up_id_projet = 14
             OR 14 IN (SELECT p.p_id
             FROM projet AS p
             LEFT JOIN utilisateur AS u
             ON u.ut_id=p.p_id_createur)"*/
            
            /*
             * "SELECT DISTINCT
					u.ut_id AS member_id,
                    u.ut_nom AS member_lastname,
                    u.ut_prenom as member_firstname,
                IF(p.p_id_createur=u.ut_id,1,0) AS project_owner
                FROM utilisateur AS u
                JOIN projet AS p
                ON p.p_id_createur=u.ut_id
				WHERE
					p.p_id=14 
                
                	OR 14 IN (SELECT utilisateur_projet.up_id_projet
								FROM utilisateur_projet
								LEFT JOIN utilisateur AS u
								ON u.ut_id=utilisateur_projet.up_id_participant)"
             * */
        

        $params = array();
        //$params[] = $projID;

        if (! is_null($filter)) {
            $first=true;
            $operator=' OR ';
            if($and) $operator=' AND ';

            foreach ($filter as $k => $v) {

                if ($k == 'member_lastname') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'u.ut_nom LIKE ?';
                    $params[] = '%' . $v . '%';
                }

                if ($k == 'member_firstname') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'u.ut_prenom LIKE ?';
                    $params[] = '%' . $v . '%';
                }
                
                if ($k == 'owner_lastname') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'u2.ut_nom LIKE ?';
                    $params[] = '%' . $v . '%';
                }
                
                if ($k == 'owner_firstname') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'u2.ut_nom LIKE ?';
                    $params[] = '%' . $v . '%';
                }

                if ($k == 'member_role') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'up.up_role_pour_ce_projet LIKE ?';
                    $params[] = '%' . $v . '%';
                }

                if ($k == 'member_gestion') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'up.up_gestion = ?';
                    $params[] = $v;
                }
            }
            $sql .= ' ) ';
        }
        $sql .= ' ORDER BY u.ut_nom ASC';

        $query = $this->db->query($sql, $params);
        $projectMembers = $query->result_array();

        return $projectMembers;
    }

    /**
     * getUserProjects() this method returns the projects for which a user participates
     *
     * @param $userID the id of the user         
     * @param $filter is optional and is an array containing search criterions
     * @param $filter['project_id'] is the id of the project
     * @param $filter['project_name'] is the name of the project
     * @param $filter['project_date_start'] is the date when the project start
     * @param $filter['project_date_end'] is the date when the project end
     * @param $filter['project_role'] is the role of the member for the project
     * @param $filter['project_gestion'] means 1 or 0 (if the participant may not manage the project)
     * @param $filter['project_owner'] means 1 or 0 (if the participant is not the owner of the project)
	 * @param $and is optional and is an boolean which is FALSE (default behavior) for processing teh search query with OR operators and TRUE for AND operators
	 
	 * @return an array of projects for a user (date start descending order)
	 * @see getUserProjects() for the data structure of returned projects
     */
    public function getUserProjects($userID, $filter = NULL, $and = false)
    {
        if (is_null($userID))
            return NULL;

        $params = array();
        
        $sql = "SELECT DISTINCT
                        p.p_id AS id,
                        p.p_nom AS name,
                        p.p_date_start AS date_start,
                        p.p_date_end AS date_end,
                        IF(p_id_createur=$userID,1,0) AS project_owner,
                        IF(up.up_id_participant=$userID,up.up_role_pour_ce_projet,NULL) AS project_role,
                        IF(up.up_id_participant=$userID,up.up_gestion,0) AS project_gestion
                 FROM projet AS p
                    JOIN utilisateur_projet AS up
                    ON up.up_id_projet = p.p_id
                 WHERE
                     up.up_id_participant = $userID
                     OR $userID IN (SELECT p.p_id_createur FROM projet)";
        
        if (! is_null($filter)) {
            $first = true;
            $operator = ' OR ';
            if ($and)
                $operator = ' AND ';

            foreach ($filter as $k => $v) {

                if ($k == 'project_id') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'p.p_id)=?';
                    $params[] = $v;
                }
                
                if ($k == 'project_name') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'p.p_nom LIKE ?';
                    $params[] = '%' . $v . '%';
                }

                if ($k == 'project_date_end') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'DATE(p.p_date_end)=?';
                    $params[] = $v;
                }
                
                if ($k == 'project_date_start') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'DATE(p.p_date_start)=?';
                    $params[] = $v;
                }

                if ($k == 'project_role') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'up.up_role_pour_ce_projet LIKE ?';
                    $params[] = '%' . $v . '%';
                }

                if ($k == 'project_gestion') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'up.up_gestion = ?';
                    $params[] = $v;
                }

                if ($k == 'project_owner') {
                    if ($first) {
                        $sql .= ' AND ( ';
                        $first = false;
                    } else {
                        $sql .= $operator;
                    }
                    $sql .= 'project_owner = ?';
                    $params[] = $v;
                }
            }
        }
        $sql .= ' ORDER BY p_date_start DESC';

        $query = $this->db->query($sql, $params);
        $userProjects = $query->result_array();

        return $userProjects;
    }

    // -------------------------------------------------------------
    // -------------------- DELETE ---------------------------------
    // -------------------------------------------------------------

    /**
     * deleteProject() delete a project based on its id
     *
     * @param $projID
     *            
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
     */
    public function deleteProject($projID)
    {
        if (is_null($projID))
            return false;
        
        $projID = intval($projID);
        
        $sql = "DELETE FROM fichier_projet WHERE fp_id_projet= ?";
        if (! $this->db->query($sql, array( $projID ))) return false;
        
        $sql = "DELETE FROM projet WHERE p_id= ?";
        if (! $this->db->query($sql, array( $projID ))) return false;
        
        return true;
    }

    /**
     * deleteUserProject() remove a project for a specific user
     *
     * @param $userID
     * @param $projID
     *            
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
     */
    public function deleteUserProject($userID, $projID)
    {
        if (empty($userID))
            return false;
        if (empty($projID))
            return false;

        $sql = "DELETE FROM utilisateur_projet WHERE up_id_participant=? AND up_id_projet=?";
        if (! $this->db->query($sql, array(
            intval($userID),
            intval($projID)
        )))
            return false;

        return true;
    }

    /**
     * deleteAllProjectsUser() remove all projects for a specific user
     *
     * @param $userID
     *            
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
     */
    public function deleteAllProjectsUser($userID)
    {
        if (empty($userID))
            return false;

        $sql = "DELETE FROM utilisateur_projet WHERE up_id_participant=?";
        if (! $this->db->query($sql, array(
            intval($userID)
        )))
            return false;

        return true;
    }

    /**
     * deleteAllUsersProject() remove all users for a specific project
     *
     * @param $projID
     *            
     * @return a boolean (TRUE if deletion has been applied, FALSE if not)
     */
    public function deleteAllUsersProject($projID)
    {
        if (empty($projID))
            return false;

        $sql = "DELETE FROM utilisateur_projet WHERE up_id_projet=?";
        if (! $this->db->query($sql, array(
            intval($projID)
        )))
            return false;

        return true;
    }

    // -------------------------------------------------------------
    // -------------------- UPDATE ---------------------------------
    // -------------------------------------------------------------

    /**
     * updateProject() is a method for updating a project
     *
     * @param $userID is the id of the owner of the project
     * @param $project is an array containing project data
     * @param $project['id'] contains the id
     * @param $project['pname'] contains the name
     * @param $project['pdescription'] contains the description of the project
     * @param $project['pdate_start'] contains the date of the beginning of the project
     * @param $project['pdate_end'] contains the date of the end of the project
     *            
     * @return TRUE if update succeeded and FALSE if not
     */
    public function updateProject($projID, $userID = NULL, $project = NULL)
    {
        if (is_null($project))
            return false;

        if (! isset($projID))
            return false;
        if (empty($projID))
            return false;

        $first = true;
        $params = array();
        $sql = "UPDATE projet SET ";

        if (isset($userID)) {
            if (! empty($project['pname'])) {
                if ($first)
                    $first = false;
                else
                    $sql .= ', ';

                $sql .= ' p_id_createur = ? ';
                $params[] = intval($userID);
            }
        }
        if (isset($project['pname'])) {
            if (! empty($project['pname'])) {
                if ($first)
                    $first = false;
                else
                    $sql .= ', ';

                $sql .= ' p_nom = ? ';
                $params[] = $project['pname'];
            }
        }
        if (isset($project['pdescription'])) {
            if (! empty($project['pdescription'])) {
                if ($first)
                    $first = false;
                else
                    $sql .= ', ';

                $sql .= ' p_description = ? ';
                $params[] = $project['pdescription'];
            }
        }
        if (isset($project['pdate_start'])) {
            if (! empty($project['pdate_start'])) {
                if ($first)
                    $first = false;
                else
                    $sql .= ', ';

                $sql .= ' p_date_start = ? ';
                $params[] = $project['pdate_start'];
            }
        }
        if (isset($project['pdate_end'])) {
            if (! empty($project['pdate_end'])) {
                if ($first)
                    $first = false;
                else
                    $sql .= ', ';

                $sql .= ' p_date_end = ? ';
                $params[] = $project['pdate_end'];
            }
        }

        $sql .= " WHERE p_id= " . intval($projID);

        if ($first)
            return false;

        if (! $this->db->query($sql, $params))
            return false;
        else
            return true;
    }

    /**
     * updateUserProject() is a method for updating a project
     *
     * @param $userID is the member of the project
     * @param $projID contains the id of the project
     * @param $userProject['role'] contains the role of the member for the project
     * @param $userProject['manage'] contains 1 or 0 (if the member may not manage the project)
     *            
     * @return TRUE if update succeeded and FALSE if not
     */
    public function updateUserProject($projID, $userID, $userProject = NULL)
    {
        if (is_null($projID))
            return false;
        if (is_null($userID))
            return false;

        $first = true;
        $params = array();
        $sql = "UPDATE utilisateur_projet SET ";

        if (isset($userProject['role'])) {
            if (! empty($userProject['role'])) {
                if ($first)
                    $first = false;
                else
                    $sql .= ', ';

                $sql .= ' up_role_pour_ce_projet = ? ';
                $params[] = $userProject['role'];
            }
        }
        if (isset($userProject['manage'])) {
            if ($first)
                $first = false;
            else
                $sql .= ', ';

            $sql .= ' up_gestion = ? ';
            $params[] = $userProject['manage'];
        }

        $sql .= " WHERE up_id_projet= " . intval($projID) . " AND up_id_participant = " . intval($userID);

        if ($first)
            return false;

        if (! $this->db->query($sql, $params))
            return false;
        else
            return true;
    }
	/**
	* getUserID() is a method for searching the userID of the last record 
	* @return userID
	* @see function for tests
	*/
	public function getUserID()
	{
	    
	    $sql="SELECT
				ut_id
               FROM utilisateur
				ORDER BY ut_id DESC";
	    $query = $this->db->query($sql);
	    $id=$query->result_array();
	    $lastiduser=$id[0]["ut_id"];
	    return $lastiduser;
	}	
	
	/**
	* getProjectID() is a method for searching the projectID of the last record 
	* @return projectID
	* @see function for tests
	*/
	public function getProjectID()
	{
	    
	    $sql="SELECT
				p_id
				FROM projet
				ORDER BY p_id DESC";
	    $query = $this->db->query($sql);
	    $id=$query->result_array();
	    $lastiddatasource=$id[0]["p_id"];
	    return $lastiddatasource;
	}
	
}
