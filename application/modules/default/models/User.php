<?php 
error_reporting(0);
class Model_User extends Zend_Db_Table_Abstract {

   protected $_name = 'users';   
   protected $_tab_role = 'users';   
   public $_errorMessage='';
   
    /* Get all users/staff detail */
    public function getUserByName($name,$companyID='') {
        $select=$this->select()->where('userName like ?',"%$name%");
        if($companyID){
			$select = $select->where('cust_id=?',$companyID);
			$select = $select->where('role_id!=?',9);
			$select = $select->where('role_id!=?',5);
			$select = $select->where('role_id!=?',7);
		}
		//echo $select->__toString();				
        $res=$this->fetchAll($select);
        return ($res && sizeof($res)>0)? $res->toArray() : false ;	
    } 
    
     /* Get all users/staff detail */
    public function getUserByEmail($name,$companyID='') {
        $select=$this->select()->where('email like ?',"%$name%");
        if($companyID){
			$select = $select->where('cust_id=?',$companyID);
			$select = $select->where('role_id!=?',9);
			$select = $select->where('role_id!=?',5);
			$select = $select->where('role_id!=?',7);
		}
		//echo $select->__toString();				
        $res=$this->fetchAll($select);
        return ($res && sizeof($res)>0)? $res->toArray() : false ;	
    }
    
    public function getUserById($uid) {
       
        if($uid){
	      $select=$this->select()->where('uid =?',$uid);					
             $res=$this->fetchAll($select);
           return ($res && sizeof($res)>0)? $res : false ;
        }else return false;	
    } 

    
    /* Update  users detail by ID */		
    public function updateUser($data,$id){
        $this->_errorMessage="";
        $where = $this->getAdapter()->quoteInto('uid = ?', $id);	
        unset($data['uid']);
        unset($data['module']);
        unset($data['building']);
        unset($data['distribution']);
        try {
            $this->update($data,$where);
            return true;
        }catch(Exception $e){    		
            echo $e->getMessage(); die();
        }	
    }

    /* Save user/client */
    public function insertUser($data) {				
        try{
            unset($data['uid']);
            unset($data['module']);
            unset($data['building']);
            unset($data['distribution']);
            $this->_errorMessage="";   	   	
            //$data['password']=md5($data['uPass']);		
            $data['regDate']=date('Y-m-d H:i:s');	
            return $this->insert($data);		
        } catch(Exception $e)	{	
            echo $e->getMessage();die;
        }
    }
    /**
     * isUserExist check user exist or not
     * 
     * @param String $username
     * 
     * @return Array (it user exist reture user detail other wise empty array)
     * @author : Brijesh Kumar
     */
    public function isUserExist($username) {
        $select=$this->select()->where('userName = ?', $username);
        $select = $select->orwhere('email= ?',$username);			
        $res=$this->fetchAll($select);
        return ($res && sizeof($res)>0)? $res->toArray() : false ;	
    }
    
    /**
     * setPasskey is used to set the passkey for reset password
     * 
     * @param string $passkey, Int $id
     * 
     * @return boolean True/False
     */
    public function setPasskey($passkey, $id) {
        $where = $this->getAdapter()->quoteInto('uid = ?', $id);
        try {
            $this->update(array(
                "passkey"           => $passkey,
                "passkeyStatus"     => 1,
                "passkeyTime"      => date('Y-m-d h:i:s')
            ), $where);
            return true;
        }catch(Exception $e){    		
            echo $e->getMessage(); die();
        }
    }
	 public function passkey($passkey) {
        $select=$this->select()->where('passkey = ?', $passkey);				
        $res=$this->fetchAll($select);
		//echo sizeof($res);exit;
        return ($res && sizeof($res)>0)? $res->toArray() : false ;	
    }
	// Update Password
    public function updateresetpassword($password,$passkey) {
        $where = $this->getAdapter()->quoteInto('passkey = ?', $passkey);
        try {
            $this->update(array(
                "password"           => $password,
                "passkey"           => '',
                "passkeyStatus"     => 0                
            ), $where);
            return true;
        }catch(Exception $e){    		
            echo $e->getMessage(); die();
        }
    }
    
	public function getUsersByCompany($companyID){
	  if(!empty($companyID)){	
	        $select=$this->select()->where('cust_id = ?', $companyID);				
            $res=$this->fetchAll($select);
            return ($res && sizeof($res)>0)? $res->toArray() : false ;
	    }else
	    return false;
	}
	
	public function changePassword($password,$id){
		$this->_errorMessage="";
        $where = $this->getAdapter()->quoteInto('uid = ?', $id);	
        
        try {
            $this->update(array(
                "password"           => md5($password)                
            ),$where);
            return true;
        }catch(Exception $e){    		
            echo $e->getMessage(); die();
        }	
	}
	
	public function deleteCompanyUser($companyID){
		if(!empty($companyID) && $companyID !=0){
			   try{
				  $this->delete('cust_id = '.$companyID);
				  return true;
				}catch(Exception $e){
					return false;
				}
			}
	}
        
        
	
	public function getCompanyAdminUser(){
		$db = Zend_Db_Table::getDefaultAdapter(); 
		$select = $db->select()
				 ->from(array('u' => 'users'), array('uid','userName','firstName','lastName','email'))
				 ->joinInner(array('cp' => 'company'), 'u.cust_id = cp.cust_id', array('companyName', 'cust_id'))
				 ->where('u.remove_status = ?', '0')
				 ->where('u.role_id = ?', '9')
				 ->where('cp.status = ?', '1');				 				 
			$res = 	 $db->fetchAll($select);
        return ($res && sizeof($res)>0)? $res : false ;
	}


     public function tenantUserExist($username, $roleId) {
        $select=$this->select()->where('userName = ?', $username)->where('role_id = ?', $roleId);                
        $res=$this->fetchAll($select);
        return ($res && sizeof($res)>0)? true : false ;  
    }
    
    public function getAllUserOfBuildingAdmin($user_id){
		if($user_id){
			$db = Zend_Db_Table::getDefaultAdapter(); 				 
			$query = 'SELECT DISTINCT u.uid, u.firstName, u.lastName, u.email FROM `users` as u, 
					  user_building_module_access as ub WHERE ub.user_id = u.uid AND 
					  ub.building_id IN (SELECT ubm.building_id FROM user_building_module_access as ubm  
					  WHERE ubm.user_id="'.$user_id.'" ) AND u.uid!='.$user_id;		 
													 
				$res = 	 $db->fetchAll($query);
			return ($res && sizeof($res)>0)? $res : false ;
		}else
		   return false;
	}
	
	public function getAllUserOfBuilding($building){
		if($building){
			$db = Zend_Db_Table::getDefaultAdapter(); 				 
			$query = 'SELECT DISTINCT u.uid, u.firstName, u.lastName, u.email FROM `users` as u, 
					  user_building_module_access as ub WHERE ub.user_id = u.uid AND 
					  ub.building_id = "'.$building.'"';		 
													 
				$res = 	 $db->fetchAll($query);
			return ($res && sizeof($res)>0)? $res : false ;
		}else
		   return false;
	}


    public function getAllAccountUserOfBuilding($building){
        if($building){
            $db = Zend_Db_Table::getDefaultAdapter();                
            $query = 'SELECT DISTINCT u.uid, u.firstName, u.lastName, u.email FROM `users` as u, 
                      user_building_module_access as ub WHERE ub.user_id = u.uid AND 
                      ub.building_id = "'.$building.'"';         
                                                     
                $res =   $db->fetchAll($query);
            return ($res && sizeof($res)>0)? $res : false ;
        }else
           return false;
    }
    
    public function getmoduleOfBuilding($building){
        if($building){
            $db = Zend_Db_Table::getDefaultAdapter();                
            $query = 'SELECT module_id FROM `building_module_access` where building_id="'.$building.'"';
            $res =   $db->fetchAll($query);
            return ($res && sizeof($res)>0)? $res : false ;
        }else
           return false;
    }
	
	public function deleteUser($user_id){
		if(!empty($user_id) && $user_id !=0){
			$where = $this->getAdapter()->quoteInto('uid = ?', $user_id);			
			try {
				$this->update(array(
					"remove_status"           => 1,
					"remove_date" =>date('Y-m-d')                
				),$where);
				return true;
			}catch(Exception $e){    		
				echo $e->getMessage(); die();
			}
		}
	}
	
	/********Move delete user in history record *******/
	public function historyUser($user_id){
		if(!empty($user_id) && $user_id !=0){
			$where = $this->getAdapter()->quoteInto('uid = ?', $user_id);			
			try {
				$this->update(array(
					"history_remove"           => 1,
					"history_date" =>date('Y-m-d')                
				),$where);
				return true;
			}catch(Exception $e){    		
				echo $e->getMessage(); die();
			}
		}
	}
	
	/******** delete history user *******/
	public function deleteHistoryUser($user_id){
		if(!empty($user_id) && $user_id !=0){					
			try {
				$this->delete('uid = '.$user_id);
				return true;
			}catch(Exception $e){    		
				echo $e->getMessage(); die();
			}
		}
	}
	
	/**
	 * check user name
	 */ 
	 
	 public function checkUserName($userName,$uid=''){
		$select=$this->select()->where('userName = ?', $userName);
        if(!empty($uid)){
			$select = $select->where('uid <> ?', $uid);
		}			
        $res=$this->fetchAll($select);
        return ($res && sizeof($res)>0)? $res->toArray() : false ;
	 }
	 
	 /**
	 * check user email
	 */ 
	 
	 public function checkUserEmail($email,$uid=''){
		$select=$this->select()->where('email = ?', $email);
        if(!empty($uid)){
			$select = $select->where('uid <> ?', $uid);
		}			
        $res=$this->fetchAll($select);
        return ($res && sizeof($res)>0)? $res->toArray() : false ;
	 }
	 
	 /********get User by Ids in set ******/
	 
	 public function getUserBySetIds($ids){		 
        if(!empty($ids)){
		$select=$this->select();
		$select = $select->where("uid IN ($ids)");
		$select = $select->where('status=?','1');
		$select = $select->where('remove_status=?','0');						
        $res=$this->fetchAll($select);
        return ($res && sizeof($res)>0)? $res->toArray() : false ;
        }else
        false;
	 }
	 
	 public function getUserInfo($userId){
		 if($userId){
           $db = Zend_Db_Table::getDefaultAdapter();                
           $select = $db->select()
                      ->from(array('us' => 'users'))                      
                      ->joinLeft(array('ro'=>'role'),'ro.roleID = us.role_id',array('role_title'=>'ro.title'))                      
                      ->where('us.uid=?',$userId);
           $res = $db->fetchAll( $select );      
            return ($res && sizeof($res)>0)? $res : false ;
        }else
           return false;
		}
	  public function getHeaderData($cust_id){
		$uri = BASEURL; 
		/*******Get voc-tech logo********/
		$sdModel = new Model_SystemDefault();
		$sdData = $sdModel->getSystemDefault();
		$emailContent = $sdData[0];
		$voc_logo =  $emailContent['voc_logo'];            

		if(isset($voc_logo) && !empty($voc_logo)){
			$voctech_logo_src	=	'<img src="'.$uri.'public/images/uploads/'.$voc_logo.'">';
		}else{ $voctech_logo_src=""; }


		/*******Get Company Data********/
		$accModel = new Model_Account();
		$accData = $accModel->getcompany($cust_id);
		$aData = $accData[0];
		
		$building_logo_src="";

		// Company logo
		if(isset($aData['company_logo']) && !empty($aData['company_logo'])){
			$building_logo_src	=	'<img src="'.$uri.'public/images/clogo/'.$aData['company_logo'].'">';
		}else{
			//$building_logo_src	=	'<img src="'.$uri.'/public/images/logo.png">';				
			$building_logo_src	=	'';				
		}

		$data['building_logo_src']	=	$building_logo_src;
		$data['voctech_logo_src']	=	$voctech_logo_src;
		$data['corp_account_number']	=	$aData['corp_account_number'];
		$data['date']	=	$this->getDateFormat();
		return $data;
		  
	  }
	  public function getFooterData(){
		$uri = BASEURL; 
		/*******Get voc-tech logo********/
		$sdModel = new Model_SystemDefault();
		$sdData = $sdModel->getSystemDefault();
		$emailContent = $sdData[0];
        $footer_info =  $emailContent['footer_info'];
        $emailSubject = $emailContent['subject'];

		$data['footer_info']	=	$footer_info;
		//$data['subject']		=	$emailSubject;
		return $data;
		  
	  }
	  
	  public function getDateFormat($data=null){
		if($data==null) $data=date("Y-m-d h:i:s");
		
		return date("Y-m-d h:i:s", strtotime($data));		  
	  }
		
	public function sendUserMail($detail,$htmlDocId=''){	
                $emailMapper = new Model_Email();

                if($htmlDocId == '') {
                      $htmlDocId = 11; // email template id
                }
                $loadTemplate = $emailMapper->loadEmailTemplate($htmlDocId);
                if($loadTemplate){
            /******Get Building data******/
                $building_names	=	array();
                $building_name	=	"";
                $company_name	=	"";
                $building_suites	=array();
                $building_suite	=	"";
                if(isset($detail['building']) && count($detail['building'])){
                        $buildingModel = new  Model_Building();
                        foreach($detail['building'] as $bd){
                                $building_names[]=$bd['building'];
                                $suite_buildData = $buildingModel->getBuildingByOnlyName($bd['building']);
                                if($suite_buildData[0]['billSuite']) $building_suites[]=$suite_buildData[0]['billSuite'];
                        }
                        $building_name=implode(",",$building_names);
                        $buildData = $buildingModel->getCompanyByOnlyName($detail['building'][0]['building']);
                        //print_r($buildData);
                        //echo $building_name;
                        // die;
                        $company_name=$buildData[0]->companyName;
                        $cost_center_number=$buildData[0]->corp_account_number;		
                        $cust_id=$buildData[0]->cust_id;		
                        $building_suite=implode(",",$building_suites);                                
                }			
                //echo "<br>building_name->".$building_name; 
                //echo "<br>cost_center_number->".$cost_center_number; 
                //echo "<br>company_name->".$company_name;  die;
                //echo "<br>building_suite->".$building_suite;  die;
                $header_data	=	$this->getHeaderData($cust_id);
                $footer_data	=	$this->getFooterData();

                $emailContent = $loadTemplate[0];
            $emailSubject = $emailContent['email_subject'];
            $emailBody = $emailContent['email_content']; 
            
///// header 
			$emailBody = str_replace('[[++companyLogo]]', $header_data['building_logo_src'], $emailBody);
			$emailBody = str_replace('[[++voctechLogo]]', $header_data['voctech_logo_src'], $emailBody);
			$emailBody = str_replace('[[++dateTime]]', $header_data['date'], $emailBody);
			$emailBody = str_replace('[[++costNumber]]', $header_data['corp_account_number'], $emailBody);
///// end header

///// Footer 
			$emailBody = str_replace('[[++footerInfo]]', $footer_data['footer_info'], $emailBody);
///// End Footer

			// Email subject start
			
			$emailSubject = str_replace('[[++date]]', date('m/d/Y h:i a'), $emailSubject);
                        $emailSubject = str_replace('[[++name]]', $detail['name'], $emailSubject);
                        $emailSubject = str_replace('[[++firstName]]', $detail['firstName'], $emailSubject);
                        $emailSubject = str_replace('[[++lastName]]', $detail['lastName'], $emailSubject);
                        $emailSubject = str_replace('[[++username]]', $detail['username'], $emailSubject);  
                        $emailSubject = str_replace('[[++password]]', $detail['gpass'], $emailSubject);
                        $emailSubject = str_replace('[[++role]]', $detail['access'], $emailSubject);
                        $emailSubject = str_replace('[[++userRole]]', $detail['access'], $emailSubject);
                        $emailSubject = str_replace('[[++siteURL]]', BASEURL, $emailSubject);
                        $emailSubject = str_replace('[[++companyName]]', $company_name, $emailSubject);
                        $emailSubject = str_replace('[[++buildingName]]', $building_name, $emailSubject);
                        $emailSubject = str_replace('[[++costNumber]]', $cost_center_number, $emailSubject);
                        $emailSubject = str_replace('[[++userEmail]]', $detail['username'], $emailSubject);  
                        $emailSubject = str_replace('[[++suite]]', $building_suite, $emailSubject);
                        
                        $emailSubject = str_replace('[[++buildingPhoneNumber]]', $detail['buildingPhoneNumber'], $emailSubject);
                        $emailSubject = str_replace('[[++buildingAddress1]]', $detail['buildingAddress1'], $emailSubject);
                        $emailSubject = str_replace('[[++buildingAddress2]]', $detail['buildingAddress2'], $emailSubject);
                        $emailSubject = str_replace('[[++buildingCity]]', $detail['buildingCity'], $emailSubject);
                        $emailSubject = str_replace('[[++buildingState]]', $detail['buildingState'], $emailSubject);
                        $emailSubject = str_replace('[[++buildingPostalCode]]', $detail['buildingPostalCode'], $emailSubject);
                        $emailSubject = str_replace('[[++Title]]', $detail['title'], $emailSubject);
                        $emailSubject = str_replace('[[++phone]]', $detail['office_phone'], $emailSubject);
                        $emailSubject = str_replace('[[++userFullName]]', $detail['fullname'], $emailSubject);
                        $emailSubject = str_replace('[[++currDate]]', date("Y-m-d"), $emailSubject);
			
			
			//Email subject end

            $emailBody = str_replace('[[++date]]', date('m/d/Y h:i a'), $emailBody);
            $emailBody = str_replace('[[++name]]', $detail['name'], $emailBody);
            $emailBody = str_replace('[[++firstName]]', $detail['firstName'], $emailBody);
            $emailBody = str_replace('[[++lastName]]', $detail['lastName'], $emailBody);
            $emailBody = str_replace('[[++username]]', $detail['username'], $emailBody);  
            $emailBody = str_replace('[[++password]]', $detail['gpass'], $emailBody);
            $emailBody = str_replace('[[++role]]', $detail['access'], $emailBody);
            $emailBody = str_replace('[[++siteURL]]', BASEURL, $emailBody);
            $emailBody = str_replace('[[++companyName]]', $company_name, $emailBody);
            $emailBody = str_replace('[[++buildingName]]', $building_name, $emailBody);
            $emailBody = str_replace('[[++costNumber]]', $cost_center_number, $emailBody);
            $emailBody = str_replace('[[++userEmail]]', $detail['username'], $emailBody);  
            $emailBody = str_replace('[[++suite]]', $building_suite, $emailBody);
            $emailBody = str_replace('[[++userRole]]', $detail['access'], $emailBody);
            $emailBody = str_replace('[[++currDate]]', date("Y-m-d"), $emailBody);
            $emailBody = str_replace('[[++buildingPhoneNumber]]', $detail['buildingPhoneNumber'], $emailBody);
            $emailBody = str_replace('[[++buildingAddress1]]', $detail['buildingAddress1'], $emailBody);
            $emailBody = str_replace('[[++buildingAddress2]]', $detail['buildingAddress2'], $emailBody);
            $emailBody = str_replace('[[++buildingCity]]', $detail['buildingCity'], $emailBody);
            $emailBody = str_replace('[[++buildingState]]', $detail['buildingState'], $emailBody);
            $emailBody = str_replace('[[++buildingPostalCode]]', $detail['buildingPostalCode'], $emailBody);
            $emailBody = str_replace('[[++Title]]', $detail['title'], $emailBody);
            $emailBody = str_replace('[[++phone]]', $detail['office_phone'], $emailBody);
            $emailBody = str_replace('[[++userFullName]]', $detail['fullname'], $emailBody);

      						
				$mail = new Zend_Mail('utf-8');				
								
				$mail->addTo($detail['email'], $detail['email']);
				$mail->setSubject($emailSubject);
				
				$setModel = new Model_Setting();
                                $setData = $setModel->getSetting();
				if($setData){
					$setting = $setData[0];
					$mail->setFrom($setting['from_email'],$setting['from_name']);
					$return_path = new Zend_Mail_Transport_Sendmail('-f'.$setting['from_email']);
					if($setting['bcc_email'])
					$mail->addBcc($setting['bcc_email'], $setting['bcc_name']);
				}else{
					$mail->setFrom('support@visionworkorders.com','Vision Work Orders');
					$return_path = new Zend_Mail_Transport_Sendmail('-fsupport@visionworkorders.com');
				}
				Zend_Mail::setDefaultTransport($return_path);					
				$mail->setBodyHtml($emailBody);
                                $res = $mail->send();
                               // print_r($detail['allemails']);
                                //echo "Email list";
                                //die;
//                                foreach($detail['allemails'] as $Email){
//                                    $mail->addTo($Email, $Email);
//                                    $res = $mail->send();
//                                }
                                return $res;
		 }					
			
   }
   
	public function getmultipleUsers($userIds) {
	if($userIds){
           $db = Zend_Db_Table::getDefaultAdapter();                
           $select = $db->select()
                      ->from(array('us' => 'users'), array('uid', 'firstName', 'lastName'));
		   $select = $select->where("us.uid in ($userIds)");
		   $select = $select->where('us.status=?','1');
		   $res = $db->fetchAll( $select );      
            return ($res && sizeof($res)>0)? $res : false ;
        }else
           return false;
	}
        
        public function getupdatelogouttime($userIds,$time) {
                if($userIds){
                  $where=$this->getAdapter()->quoteInto('uid = ?', $userIds);
                  $data=array('logout_time'=> $time);
                    try {
                        $this->update($data,$where);
                        return true;
                    }catch(Exception $e){    		
                        echo $e->getMessage(); die();
                    }
                }
        }
        
        public  function get_logouttime($uid){
          if($uid){
           $db = Zend_Db_Table::getDefaultAdapter();                
           $select = $db->select()
                        ->from(array('us' => 'users'), array( 'logout_time'));
                     $select = $select->where("us.uid in ($uid)");
                     $select = $select->where('us.status=?','1');
                     $res = $db->fetchAll( $select );      
              return ($res && sizeof($res)>0)? $res : false ;
          }else
             return false;
          }
          
          public function get_userfullinfoby_buildingId($building){
             if($building){
			$db = Zend_Db_Table::getDefaultAdapter(); 				 
			$query = 'SELECT DISTINCT u.uid, u.email FROM `users` as u, 
					  user_building_module_access as ub WHERE ub.user_id = u.uid AND 
					  ub.building_id = "'.$building.'" and u.ccwelcomeletter = 1';		 
													 
				$res = 	 $db->fetchAll($query);
			return ($res && sizeof($res)>0)? $res : false ;
		}else
		   return false;
          }
          
          
      
	
}	

