<?php
/**
 * \file      models/UserModel.php
 * \author    VirginieVD
 * \version   1.0
 * \date      2019-03-15
 * \brief     Model to manage users, roles, rights and advices for the Wallesmart database
 *
 * \details   This class is supposed to be used with the codeigniter framework
 */
class UserModel extends CI_Model {

	/**
	* __construct() is the constructor which initiates the connection to the database
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	
	}
	
	/**
	* authentification() is a method for querying if an user have or not an account
	
	* @param $login
	* @param $password (will be hashed inside this method with a SHA1 function)
		
	* @return an array containing user informations
	* @see getUser() for the data structure of returned user
	*/
	public function authentification($login,$password)
	{
		$sql="SELECT
					ut_id AS id,
					ut_nom AS lastname,
					ut_prenom AS firstname,
					ut_date_naiss AS birthdate,
					ut_mail AS email,
					ut_tel AS phone,
					ut_gsm AS mobile,
					ut_sexe AS gender,
					ut_login AS login,
					ut_visible_awe AS visible,
					ut_accepter_conseil AS advice
				FROM utilisateur 
				WHERE ut_login=? AND ut_password=?";
		$query = $this->db->query($sql, array($login,sha1($password)));
		$user=$query->row_array();
		
		//---- if not access
		if(is_null($user)) return false;
		if(is_null($user['id'])) return false;
		//--- if ok
		return $user;
				
	}
	
	//-------------------------------------------------------------
	//-------------------- SELECT ---------------------------------
	//-------------------------------------------------------------

	/**
	* getUserRoles() returns all roles for a specific user
	
	* @param $userid	
		
	* @return an array of roles (name order)
	* @see getRole() for returned data structure
	*/	
	public function getUserRoles($userid)
	{
		if(is_null($userid)) return NULL;
		$sql="SELECT 
					r_id AS id, 
					r_nom AS name, 
					r_description AS description
				FROM role 
				JOIN utilisateur_role ON r_id=ur_id_role	
				WHERE ur_id_ut=? 
				ORDER BY r_nom";
		$query = $this->db->query($sql, array($userid));
		$roles=$query->result_array();		
		
		return $roles;
	}	
	
	/**
	* getRoles() returns all roles
			
	* @return an array of roles (name order)
	* @see getRole() for returned data structure
	*/	
	public function getRoles()
	{

		$sql="SELECT 
					r_id AS id, 
					r_nom AS name, 
					r_description AS description
				FROM role 
				ORDER BY r_nom";
		$query = $this->db->query($sql);
		$role=$query->result_array();		
		
		return $role;
	}	
	
	/**
	* getRole() returns role informations based on it's id
	
	* @param $roleid	
		
	* @return an array containing role informations
	* <br> $response['id'] role id
	* <br> $response['name'] role name (unique)
	* <br> $response['description'] role description
	*/		
	public function getRole($roleid)
	{
		if(is_null($roleid)) return NULL;
		$sql="SELECT 
					r_id AS id, 
					r_nom AS name, 
					r_description AS description
				FROM role 
				WHERE r_id=?";
		$query = $this->db->query($sql, array($roleid));
		$role=$query->row_array();		
		
		return $role;
	}	
	
	/**
	* get_userRights() returns all the rights of a specific user
	
	* @param $userid
			
	* @return an array of rights (name order)
	* @see getRight() for returned data structure
	*/	
	public function getUserRights($userid)
	{
		if(is_null($userid)) return NULL;
		$sql="SELECT 
					DISTINCT d_id AS id, 
					d_nom AS name, 
					d_description AS description 
				FROM droit
				JOIN role_droit ON rd_id_droit=d_id 
				JOIN utilisateur_role ON ur_id_role=rd_id_role	
				WHERE ur_id_ut=? 
				ORDER BY d_nom";
		$query = $this->db->query($sql, array($userid));
		$droits=$query->result_array();		
		
		return $droits;		
	}
	
	/**
	* getRights() returns all rights
			
	* @return an array of rights (name order)
	* @see getRight() for returned data structure
	*/		
	public function getRights()
	{
		$sql="SELECT 
					d_id AS id, 
					d_nom AS name, 
					d_description AS description 
				FROM droit 
				ORDER BY d_nom";
		$query = $this->db->query($sql);
		$droits=$query->result_array();		
		
		return $droits;		
	}
	
	/**
	* get_rights() returns all the rights corresponding to a specific role
	
	* @param $roleid
			
	* @return an array of rights (name order)
	* @see getRight() for returned data structure
	*/		
	public function getRoleRights($roleid)
	{
		if(is_null($roleid)) return NULL;
		$sql="SELECT 
					d_id AS id, 
					d_nom AS name, 
					d_description AS description 
				FROM droit
				JOIN role_droit ON rd_id_droit=d_id 
				WHERE rd_id_role=? 
				ORDER BY d_nom";
		$query = $this->db->query($sql, array($roleid));
		$droits=$query->result_array();		
		
		return $droits;		
	}

	/**
	* getRight() return a right based on its id
	
	* @param $rightid	
		
	* @return an array containing right informations
	* <br> $response['id'] right id
	* <br> $response['name'] right name (unique)
	* <br> $response['description'] right description
	*/		
	public function getRight($rightid)
	{
		if(is_null($rightid)) return NULL;
		$sql="SELECT 
					d_id AS id, 
					d_nom AS name, 
					d_description AS description 
				FROM droit
				JOIN role_droit ON rd_id_droit=d_id 
				WHERE rd_id_role=? 
				ORDER BY d_nom";
		$query = $this->db->query($sql, array($rightid));
		$droit=$query->row_array();		
		
		return $droit;		
	}
	
	/**
	* getUser() this method returns user informations based on its user id
	
	* @param $userid
		
	* @return an array containing user informations
	* <br> $response['id'] is the user id
	* <br> $response['lastname'] 
	* <br> $response['firstname'] 
	* <br> $response['birthdate'] 
	* <br> $response['email'] 
	* <br> $response['phone'] 
	* <br> $response['mobile']
	* <br> $response['gender'] 0 for female and 1 for male
	* <br> $response['login'] 
	* <br> $response['visible'] default visibility attribute for user files (0=hidden, 1=visible, 2=on demand)
	* <br> $response['advice']  1 if a user is ok to receive advices and 0 if not
	*/
	public function getUser($userid) 			
	{ 
		if(is_null($userid)) return NULL;
		$sql="SELECT 
					ut_id AS id,
					ut_nom AS lastname,
					ut_prenom AS firstname,
					ut_date_naiss AS birthdate,
					ut_mail AS email,
					ut_tel AS phone,
					ut_gsm AS mobile,
					ut_sexe AS gender,
					ut_login AS login,
					ut_visible_awe AS visible,
					ut_accepter_conseil AS advice
				FROM utilisateur
				WHERE ut_id=?";
		$query = $this->db->query($sql, array($userid));
		$user=$query->row_array();		
		
		return $user;
	}
	
	/**
	* getUsers() is a method for searching users in the database
	
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['lastname'] is optional and contains the lastname (can be partial) of seached user(s)
	* @param $filter['firstname'] is optional and contains the firstname (can be partial) of seached user(s)
	* @param $filter['birthdate'] is optional and contains the birthdate of seached user(s)
	* @param $filter['email'] is optional and contains the email address (can be partial) of seached user(s)
	* @param $filter['phone'] is optional and contains the phone number (can be partial) of seached user(s)
	* @param $filter['mobile'] is optional and contains the mobile phone number (can be partial) of seached user(s)
	* @param $filter['gender'] is optional and is a boolean which is for the gender of searched users (0 = female, 1 is male)
	* @param $filter['login'] is optional and contains the login (can be partial) of seached user(s)
	* @param $filter['visible'] is optional and contains the default visibility attribute for user files (0=hidden, 1=visible, 2=on demand)
	* @param $filter['advice'] is optional and is a boolean which means if a user is ok to receive advices (1) or not (0)
	* @param $and is optional and is an boolean which is FALSE (default behavior) for processing teh search query with OR operators and TRUE for AND operators
	
	* @return an array of users (lastname, firstname ascending order)
	* @see getUser() for the data structure of returned users
	*/
	public function getUsers($filter = NULL, $and = false) 			
	{ 
		
		$sql="SELECT 
					ut_id AS id,
					ut_nom AS lastname,
					ut_prenom AS firstname,
					ut_date_naiss AS birthdate,
					ut_mail AS email,
					ut_tel AS phone,
					ut_gsm AS mobile,
					ut_sexe AS gender,
					ut_login AS login,
					ut_visible_awe AS visible,
					ut_accepter_conseil AS advice
				FROM utilisateur";
		$params = array();
		
		if(!is_null($filter))
		{
		
			$first=true;	
			$operator=' OR ';
			if($and) $operator=' AND ';

			foreach($filter as $k => $v)
			{
				if($k=='lastname') 
				{ 
					if($first)
					{
						$sql.=' WHERE ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='ut_nom LIKE ?';
					$params[] = '%'.$v.'%';

				}	
				if($k=='firstname') 
				{ 
					if($first)
					{
						$sql.=' WHERE ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='ut_prenom LIKE ?';
					$params[] = '%'.$v.'%';
				}	
				if($k=='login') 
				{ 
					if($first)
					{
						$sql.=' WHERE ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='ut_login LIKE ?';
					$params[] = '%'.$v.'%';
				}
				if($k=='phone') 
				{ 
					if($first)
					{
						$sql.=' WHERE ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='ut_tel LIKE ?';
					$params[] = '%'.$v.'%';
				}	
				if($k=='mobile') 
				{ 
					if($first)
					{
						$sql.=' WHERE ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='ut_gsm LIKE ?';
					$params[] = '%'.$v.'%';
				}			
				if($k=='email') 
				{ 
					if($first)
					{
						$sql.=' WHERE ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='ut_mail LIKE ?';
					$params[] = '%'.$v.'%';
				}
				if($k=='birthdate') 
				{ 
					if($first)
					{
						$sql.=' WHERE ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='ut_date_naiss = ?';
					$params[] = $v;
				}
				if($k=='gender') 
				{ 
					if($first)
					{
						$sql.=' WHERE ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='ut_sexe = ?';
					$params[] = $v;
				}		
				if($k=='visible') 
				{ 
					if($first)
					{
						$sql.=' WHERE ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='ut_visible_awe = ?';
					$params[] = $v;
				}
				if($k=='advice') 
				{ 
					if($first)
					{
						$sql.=' WHERE ( ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='ut_accepter_conseil = ?';
					$params[] = $v;
				}			
			}			
			if(!$first) $sql.=' ) ';
			if(isset($filter['role']))
			{
				if(!is_null($filter['role']))
				{
					if($first)
					{
						$sql.=' WHERE  ';
						$first=false;
					} 
					else $sql.=' AND ';		
					$sql.='ut_id IN (SELECT ur_id_ut FROM utilisateur_role WHERE ur_id_role = ?) ';
					$params[] = $filter['role'];				
					
				}
			}
			if(isset($filter['right']))
			{
				if(!is_null($filter['right']))
				{
					if($first)
					{
						$sql.=' WHERE  ';
						$first=false;
					} 
					else $sql.=' AND ';				
					$sql.='ut_id IN (SELECT ur_id_ut FROM utilisateur_role JOIN role_droit ON ur_id_role=rd_id_role WHERE rd_id_droit = ?) ';
					$params[] = $filter['right'];				
				}
			}		
			
		}
		$sql.=' ORDER BY ut_nom, ut_prenom';		

		$query = $this->db->query($sql, $params);
		$users=$query->result_array();		
		
		return $users;
	}
	
	/**
	* loginIsFree() this method checks of a login is not already used
	
	* @param $login
		
	* @return a boolean : FALSE if the login is already used, TRUE if not
	*/	
	public function loginIsFree($login)
	{
		if(empty($login)) return false;
		$logtest=$this->get_users(array("login" => $login));
		if(count($logtest)>0) return false;
		return true;		
	}
	
	/**
	* getUsersFromRole() this method returns all users having a specific role
	
	* @param $roleid
		
	* @return an array of users (lastname, firstname ascending order)
	* @see getUser() for the data structure of returned users
	*/		
	public function getUsersFromRole($roleid)
	{
		if(empty($roleid)) return NULL;
		return $this->get_users(array("role" => intval($roleid)));
	}
	
	/**
	* getAdvices() this method returns an advice based on its id
	
	* @param $dvid advice id
	
	* @return an advices + firstnames and lasnames of users and advisers
	* <br> $response['id'] is the advice id
	* <br> $response['user_id'] is the advised user id
	* <br> $response['advisor_id'] is the advisor id
	* <br> $response['advice'] is the advice text
	* <br> $response['advice_date'] is the creation date of the advice
	* <br> $response['user_lastname'] is the lastname of advised user
	* <br> $response['user_firstname'] is the firstname of advised user
	* <br> $response['advisor_lastname'] is the lastname of advisor
	* <br> $response['advisor_lastname'] is the firstname of advisor
	*/	
	public function getAdvice($advid) 			
	{ 
		if(is_null($advid)) return NULL;
		$sql="SELECT 
					c_id AS id,
					c_id_utilisateur AS user_id,
					c_id_conseiller AS advisor_id,
					c_conseil AS advice,
					c_date AS advice_date,
					u.ut_nom AS user_lastname,
					u.ut_prenom AS user_firstname,
					a.ut_nom AS advisor_lastname,
					a.ut_prenom AS advisor_firstname
				FROM conseil
				JOIN utilisateur AS u 
				ON u.ut_id=c_id_utilisateur
				JOIN utilisateur AS a
				ON a.ut_id=c_id_conseiller
				WHERE c_id=?";
		$query = $this->db->query($sql, array($advid));
		$advice=$query->row_array();		
		
		return $advice;
	}	
	
	
	/**
	* getAdvices() is a method for searching advices in the database
	
	* @param $filter is optional and is an array containing search criterions
	* @param $filter['advice'] is optional and contains a substring which will be searched into the advice's text
	* @param $filter['user_id'] is optional and contains the identifier of the advised user
	* @param $filter['advisor_id'] is optional and contains the identifier of the advisor (which is also an user)
	* @param $filter['advice_date'] is optional and contains the creation date (without time) of one or more advices
	* @param $filter['advice_date_start'] is optional and contains the minimal creation date (without time) of one or more advices
	* @param $filter['advice_date'] is optional and contains the maximal creation date (without time) of one or more advices
	
	* @return an array of advices whith firstnames and lasnames of users and advisers. Results are sorted by advice_date (descending)
	* @see get_advices() for the data structure of an advice
	*/	
	public function getAdvices($filter=NULL)
	{
		$sql="SELECT 
					c_id AS id,
					c_id_utilisateur AS user_id,
					c_id_conseiller AS advisor_id,
					c_conseil AS advice,
					c_date AS advice_date,
					u.ut_nom AS user_lastname,
					u.ut_prenom AS user_firstname,
					a.ut_nom AS advisor_lastname,
					a.ut_prenom AS advisor_firstname
				FROM conseil
				JOIN utilisateur AS u 
				ON u.ut_id=c_id_utilisateur
				JOIN utilisateur AS a
				ON a.ut_id=c_id_conseiller";
				
		$params = array();
		
		if(!is_null($filter))
		{
		
			$first=true;	
			$operator=' AND ';

			foreach($filter as $k => $v)
			{
				if($k=='advice') 
				{ 
					if($first)
					{
						$sql.=' WHERE ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='c_conseil LIKE ? ';
					$params[] = '%'.$v.'%';
				}	
				if($k=='user_id') 
				{ 
					if($first)
					{
						$sql.=' WHERE ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='c_id_utilisateur = ? ';
					$params[] = $v;
				}				
				if($k=='advisor_id') 
				{ 
					if($first)
					{
						$sql.=' WHERE ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='c_id_conseiller =? ';
					$params[] = $v;
				}
				if($k=='advice_date') 
				{ 
					if($first)
					{
						$sql.=' WHERE ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='DATE(c_date) = ? ';
					$params[] = $v;
				}	
				if($k=='advice_date_start') 
				{ 
					if($first)
					{
						$sql.=' WHERE ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='DATE(c_date) >= ? ';
					$params[] = $v;
				}	
				if($k=='advice_date_stop') 
				{ 
					if($first)
					{
						$sql.=' WHERE ';
						$first=false;
					} 
					else
					{
						$sql.=$operator;
					}
					$sql.='DATE(c_date) <= ? ';
					$params[] = $v;
				}			
			}
		}		
		$sql.=" ORDER BY c_date DESC";
		$query = $this->db->query($sql, $params);
		$advices=$query->result_array();	

		return $advices;
	}
	
	/**
	* getUserAdvices() is a method for searching all advices sended to a specific user
	
	* @param $userid contains the identifier of the advised user
	
	* @return an array of advices whith firstnames and lasnames of users and advisers. Results are sorted by advice_date (descending)
	* @see getAdvices() for returned data structure
	*/	
	public function getUserAdvices($userid)
	{
		if(is_null($userid)) return NULL;
		$filter['user_id']=$userid;
		return $this->get_advices($filter);		
	}
	
	/**
	* getAdvisorAdvices() is a method for searching all advices written by a specific user (advisor)
	
	* @param $userid contains the identifier of the advisor
	
	* @return an array of advices whith firstnames and lasnames of users and advisers. Results are sorted by advice_date (descending)
	* @see getAdvices() for returned data structure
	*/	
	public function getAdvisorAdvices($userid)
	{
		if(is_null($userid)) return NULL;
		$filter['advisor_id']=$userid; 		
		return $this->get_advices($filter);		
	}	
	
	//-------------------------------------------------------------
	//-------------------- INSERT ---------------------------------
	//-------------------------------------------------------------
	
	/**
	* addUser() is a method for adding an user
	
	* @param $user is an array containing user data
	* @param $user['lastname'] (required) contains the lastname 
	* @param $user['firstname'] (required) contains the firstname
	* @param $user['birthdate'] (optional) contains the birthdate
	* @param $user['email'] (optional) contains the email address 
	* @param $user['phone'] (optional) contains the phone number
	* @param $user['mobile'] (optional) contains the mobile phone number
	* @param $user['gender'] (optional) 0 for female and 1 for male
	* @param $user['login']  (required) contains the login 
	* @param $user['password'] (required) contains the password, it will be hashed inside this method with a SHA1 function
	* @param $user['visible'] (optional) contains the default visibility attribute for user files (0=hidden=default, 1=visible, 2=on demand)
	* @param $user['advice'] (optional) means if a user is ok to receive advices (1) or not (0) =default

	
	* @return new user id if insert succeeded and FALSE if not
	*/		
	public function addUser($user = NULL)
	{		
		if(is_null($user)) return false;
		
		if(!isset($user['lastname'])) return false;
		if(!isset($user['firstname'])) return false;
		if(!isset($user['login'])) return false;
		if(!isset($user['password'])) return false;

		if(empty($user['lastname'])) return false;
		if(empty($user['firstname'])) return false;
		if(empty($user['login'])) return false;
		if(empty($user['password'])) return false;		
		
		$lastname=$user['lastname'];
		$firstname=$user['firstname'];
		$login=$user['login'];
		$password=sha1($user['password']);

		if(!$this->login_is_free($login)) return false;
		
			
		$sql = "INSERT INTO utilisateur 
				(ut_nom, ut_prenom, ut_date_naiss, ut_mail, ut_tel, ut_gsm, ut_sexe, ut_login, ut_password, ut_visible_awe, ut_accepter_conseil)
				VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		
		
		$birthdate=NULL; 	if(isset($user['birthdate'])) $birthdate=$user['birthdate'];
		$email=NULL; 		if(isset($user['email'])) $email=$user['email'];
		$phone=NULL; 		if(isset($user['phone'])) $phone=$user['phone'];
		$mobile=NULL; 		if(isset($user['mobile'])) $mobile=$user['mobile'];
		$gender=NULL; 		if(isset($user['gender'])) $gender=intval($user['gender']);
		$visible=0; 		if(isset($user['visible'])) $visible=intval($user['visible']);
		$advice=0; 		if(isset($user['advice'])) $advice=intval($user['advice']);
		
		if( ! $this->db->query($sql, array($lastname, $firstname, $birthdate, $email, $phone, $mobile, $gender, $login, $password, $visible, $advice)) )
		{
			return false;
		}
		
		return $this->db->insert_id();
		
	}
	
	/**
	* addUserRole() is a method for adding a role to an user
	
	* @param $userid 
	* @param $roleid 
	
	* @return TRUE if insert succeeded and FALSE if not
	*/		
	public function addUserRole($userid, $roleid)
	{
		if(empty($userid)) return false;
		if(empty($roleid)) return false;
		
		$sql="INSERT IGNORE INTO utilisateur_role (ur_id_ut, ur_id_role) VALUES (?,?)";
		if( ! $this->db->query($sql, array(intval($userid), intval($roleid))) ) return false;
		
		return true;
		
	}
	
	/**
	* addRole() is a method for adding a role
	
	* @param $name (required) role name (must be unique)
	* @param $description (optional) role description
	
	* @return new role id if insert succeeded and FALSE if not
	*/		
	public function addRole($name, $description = NULL)
	{
		if(empty($name)) return false;
		
		$sql="INSERT IGNORE INTO role (r_nom, r_description) VALUES (?,?)";
		if( ! $this->db->query($sql, array($name, $description)) ) return false;
		
		return $this->db->insert_id();
		
	}	
	
	/**
	* addRight() is a method for adding a right
	
	* @param $name (required) right name (must be unique)
	* @param $description (optional) right description
	
	* @return new right id if insert succeeded and FALSE if not
	*/		
	public function addRight($name, $description = NULL)
	{
		if(empty($name)) return false;
		
		$sql="INSERT IGNORE INTO droit (d_nom, d_description) VALUES (?,?)";
		if( ! $this->db->query($sql, array($name, $description)) ) return false;
		
		return $this->db->insert_id();
		
	}	
	
	/**
	* addRoleRight() is a method for adding a right to a role
	
	* @param $roleid 
	* @param $rightid 
	
	* @return TRUE if insert succeeded and FALSE if not
	*/		
	public function addRoleRight($roleid,$rightid)
	{
		if(empty($rightid)) return false;
		if(empty($roleid)) return false;
		
		$sql="INSERT IGNORE INTO role_droit (rd_id_role, rd_id_droit) VALUES (?,?)";
		if( ! $this->db->query($sql, array(intval($roleid),intval($rightid))) ) return false;
		
		return true;
		
	}	

	/**
	* addAdvice() is a method for adding an advice
	
	* @param $userid (required) id of advised user
	* @param $advisor_id (required) id of advisor
	* @param $advice (required) advice text
	
	* @return new advice id if insert succeeded and FALSE if not
	*/		
	public function addAdvice($user_id, $advisor_id, $advice)
	{
		if(empty($user_id)) return false;
		if(empty($advisor_id)) return false;
		if(empty($advice)) return false;
		
		$sql="INSERT IGNORE INTO conseil (c_id_utilisateur, c_id_conseiller, c_conseil, c_date) VALUES (?,?,?,NOW())";
		if( ! $this->db->query($sql, array(intval($user_id), intval($advisor_id), $advice)) ) return false;
		
		return $this->db->insert_id();
		
	}	

	//-------------------------------------------------------------
	//-------------------- UPDATE ---------------------------------
	//-------------------------------------------------------------
		
	/**
	* updateUser() is a method for updating informations of a specific user
	
	* @param $user['id'] (required) user id of the user whose informaions need to be updated 
	* @param $user['lastname'] is optional and contains the lastname
	* @param $user['firstname'] is optional and contains the firstname
	* @param $user['birthdate'] is optional and contains the birthdate
	* @param $user['email'] is optional and contains the email address 
	* @param $user['phone'] is optional and contains the phone number
	* @param $user['mobile'] is optional and contains the mobile phone number
	* @param $user['gender'] is optional, 0 for female and 1 for male
	* @param $user['login'] is optional and contains the login
	* @param $user['visible'] is optional and contains the default visibility attribute for user files (0=hidden, 1=visible, 2=on demand)
	* @param $user['advice'] is optional and means if a user is ok to receive advices (1) or not (0)

	
	* @return TRUE if update succeeded and FALSE if not
	*/		
	public function updateUser($user = NULL)
	{		
	
		if(is_null($user)) return false;
		
		if(!isset($user['id'])) return false;
		if(empty($user['id'])) return false;
		$id=intval($user['id']);
		
		$first=true;
		$params = array();
		$sql="UPDATE utilisateur SET ";
		
		if(isset($user['lastname']))
		{
			if(!empty($user['lastname']))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_nom = ? ';
				$params[] = $user['lastname'];
			}
		}
		if(isset($user['firstname']))
		{
			if(!empty($user['firstname']))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_prenom = ? ';
				$params[] = $user['firstname'];
			}
		}		
		if(isset($user['birthdate']))
		{
			if(!empty($user['birthdate']))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_date_naiss = ? ';
				$params[] = $user['birthdate'];
			}
		}		
		if(isset($user['email']))
		{
			if(!empty($user['email']))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_mail = ? ';
				$params[] = $user['email'];
			}
		}
		if(isset($user['phone']))
		{
			if(!empty($user['phone']))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_tel = ? ';
				$params[] = $user['phone'];
			}
		}
		if(isset($user['mobile']))
		{
			if(!empty($user['mobile']))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_gsm = ? ';
				$params[] = $user['mobile'];
			}
		}
		if(isset($user['gender']))
		{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_sexe = ? ';
				$params[] = intval($user['gender']);
		}		
		if(isset($user['login']))
		{
			if(!empty($user['login']))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_login = ? ';
				$params[] = $user['login'];
			}
		}			
		if(isset($user['password']))
		{
			if(!empty($user['password']))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_password = ? ';
				$params[] = sha1($user['password']);
			}
		}		
		if(isset($user['visible']))
		{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_visible_awe = ? ';
				$params[] = intval($user['visible']);
		}
		if(isset($user['advice']))
		{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' ut_accepter_conseil = ? ';
				$params[] = $user['advice'];
		}		
					
		$sql.= " WHERE ut_id= ? ";
		$params[] = $id;
		
		if($first) return false;
		
		if( ! $this->db->query($sql, $params) ) return false;
		else return true;
		
	}
	
	/**
	* updateUole() is a method for updating name and/or description of a specific role
	
	* @param $id role id (required)
	* @param $name new role name (optional)
	* @param $description new role description (optional)
	
	* @return TRUE if update succeeded and FALSE if not
	*/		
	public function updateRole($id, $name= NULL, $description = NULL)
	{
		if(empty($id)) return false;
		
		$sql="UPDATE role SET ";
		$first=true;
		$params = array();
		
		if(!is_null($name))
		{
			if(!empty($name))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' r_nom = ? ';
				$params[] = $name;
			}
		}
		if(!is_null($description))
		{
			if(!empty($description))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' r_description = ? ';
				$params[] = $description;
			}
		}			
		$sql.= " WHERE r_id= ? ";
		$params[] = intval($id);
		
		if($first) return false;
		
		if( ! $this->db->query($sql, $params) ) return false;
		else return true;
		
	}	
	
	/**
	* updateRight() is a method for updating name and/or description of a specific right
	
	* @param $id right id (required)
	* @param $name new right name (optional)
	* @param $description new right description (optional)
	
	* @return TRUE if update succeeded and FALSE if not
	*/		
	public function updateRight($id, $name = NULL, $description = NULL)
	{
		if(empty($id)) return false;
		
		$sql="UPDATE droit SET ";
		$first=true;
		$params = array();
		
		if(!is_null($name))
		{
			if(!empty($name))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' d_nom = ? ';
				$params[] = $name;
			}
		}
		if(!is_null($description))
		{
			if(!empty($description))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' d_description = ? ';
				$params[] = $description;
			}
		}			
		$sql.= " WHERE d_id= ? ";
		$params[] = intval($id);
		
		if($first) return false;
		
		if( ! $this->db->query($sql, $params) ) return false;
		else return true;
	}	
	
	/**
	* updateAdvice() is a method for updating a specific advice
	
	* @param $id advice id (required)
	* @param $user_id new user id of advised user (optional)
	* @param $advisor_id new user id of advisor (optional)
	* @param $advice new advice text (optional)
	
	* @return TRUE if update succeeded and FALSE if not
	*/		
	public function updateAdvice($id, $user_id = NULL, $advisor_id = NULL, $advice = NULL)
	{
		if(empty($id)) return false;
		
		$sql="UPDATE conseil SET ";
		$first=true;
		$params = array();
		
		if(!is_null($user_id))
		{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' c_id_utilisateur = ? ';
				$params[] = intval($user_id);
		}
		if(!is_null($advisor_id))
		{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' c_id_conseiller = ? ';
				$params[] = intval($advisor_id);
		}
		if(!is_null($advice))
		{
			if(!empty($advice))
			{
				if($first) $first=false;
				else $sql.=', ';
				
				$sql.=' c_conseil = ? ';
				$params[] = $advice;
			}
		}		
		$sql.= " WHERE c_id= ? ";
		$params[] = intval($id);
		
		if($first) return false;
		
		if( ! $this->db->query($sql, $params) ) return false;
		else return true;
	}		

	//-------------------------------------------------------------
	//-------------------- DELETE ---------------------------------
	//-------------------------------------------------------------	
	
	/**
	* deleteUser() delete an user based on its id
	
	* @param $userid
		
	* @return a boolean (TRUE if deletion has been applied, FALSE if not)
	*/		
	public function deleteUser($userid)
	{
		if(is_null($userid)) return false;
		$sql="DELETE FROM utilisateur WHERE ut_id= ?";
		if( ! $this->db->query($sql, array(intval($userid))) ) return false;
		return true;
	}
	
	/**
	* delete_userRole() remove a role for a specific user
	
	* @param $userid
	* @param $roleid
		
	* @return a boolean (TRUE if deletion has been applied, FALSE if not)
	*/		
	public function deleteUserRole($userid, $roleid)
	{
		if(empty($userid)) return false;
		if(empty($roleid)) return false;
		
		$sql="DELETE FROM utilisateur_role WHERE ur_id_ut=? AND ur_id_role=?";
		if( ! $this->db->query($sql, array(intval($userid), intval($roleid))) ) return false;
		
		return true;
		
	}
	
	/**
	* delete_userAllRole() remove all roles for a specific user
	
	* @param $userid
		
	* @return a boolean (TRUE if deletion has been applied, FALSE if not)
	*/	
	public function deleteUserAllRole($userid)
	{
		if(empty($userid)) return false;
		
		$sql="DELETE FROM utilisateur_role WHERE ur_id_ut=?";
		if( ! $this->db->query($sql, array(intval($userid))) ) return false;
		
		return true;
		
	}	
	
	/**
	* deleteRole() delete a role based on its id
	
	* @param $roleid
		
	* @return a boolean (TRUE if deletion has been applied, FALSE if not)
	*/		
	public function deleteRole($roleid)
	{
		if(empty($roleid)) return false;
		
		$sql="DELETE FROM role WHERE r_id=?";
		if( ! $this->db->query($sql, array(intval($roleid))) ) return false;
		
		return true;
		
	}
	
	/**
	* deleteRight() delete a right based on its id
	
	* @param $rightid
		
	* @return a boolean (TRUE if deletion has been applied, FALSE if not)
	*/		
	public function deleteRight($rightid)
	{
		if(empty($rightid)) return false;
		
		$sql="DELETE FROM droit WHERE d_id=?";
		if( ! $this->db->query($sql, array(intval($rightid))) ) return false;
		
		return true;
		
	}
	
	/**
	* deleteRoleRight() remove a right for a specific role
	
	* @param $roleid
	* @param $rightid
		
	* @return a boolean (TRUE if deletion has been applied, FALSE if not)
	*/	
	public function deleteRoleRight($roleid,$rightid)
	{
		if(empty($rightid)) return false;
		if(empty($roleid)) return false;
		
		$sql="DELETE FROM role_droit WHERE rd_id_role = ? AND rd_id_droit=?";
		if( ! $this->db->query($sql, array(intval($roleid),intval($rightid))) ) return false;
		
		return true;
		
	}
	
	/**
	* deleteRoleAllRight() remove all rights for a specific role
	
	* @param $roleid
		
	* @return a boolean (TRUE if deletion has been applied, FALSE if not)
	*/			
	public function deleteRoleAllRight($roleid)
	{
		if(empty($roleid)) return false;
		
		$sql="DELETE FROM role_droit WHERE rd_id_role = ?";
		if( ! $this->db->query($sql, array(intval($roleid))) ) return false;
		
		return true;
		
	}	

	/**
	* deleteAdvice() delete an advice based on its id
	
	* @param $advid advice id	
		
	* @return a boolean (TRUE if deletion has been applied, FALSE if not)
	*/	
	public function deleteAdvice($advid)
	{
		if(empty($advid)) return false;
		
		$sql="DELETE FROM conseil WHERE c_id = ?";
		if( ! $this->db->query($sql, array(intval($advid))) ) return false;
		
		return true;
		
	}		
}
