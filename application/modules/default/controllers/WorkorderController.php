<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Work Order
 *
 * @author Brijesh
 */
class WorkorderController extends Ve_Controller_Base {
    
    public function init()  {
       parent::init();
       $this->_helper->layout()->setLayout('newlayout');
       $this->buildingMapper=new  Model_Building();        
       $this->woMapper = new Model_WorkOrder();
       $this->accessHelper = $this->_helper->access; 
    }
    
    // Call befor any action and check is user login or not
    public function preDispatch()
    {    	
      if (!Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/index');
        }
        
        $level=(Zend_Auth::getInstance()->getStorage()->read())? Zend_Auth::getInstance()->getStorage()->read()->role_id:'';                
        $this->userId=Zend_Auth::getInstance()->getStorage()->read()->uid;
        $this->roleId=Zend_Auth::getInstance()->getStorage()->read()->role_id;
        $this->cust_id = Zend_Auth::getInstance()->getStorage()->read()->cust_id;
        $this->email = Zend_Auth::getInstance()->getStorage()->read()->email;
		$this->firstName = Zend_Auth::getInstance()->getStorage()->read()->firstName;
		$this->lastName = Zend_Auth::getInstance()->getStorage()->read()->lastName;
    }	
 
    /**
     * show list of work order
     * 
     */ 
    public function indexAction(){

		
		$companyListing = '';
        $buildingMapper = new Model_Building();
        if ($this->roleId == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
       
		} else {
            $user_build_mod = new Model_UserBuildingModule();
            $buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
        
			if ($buildinglists) {
				$build_ID = $buildinglists[0]['building_id'];
                // $build_id_array = array();
                foreach ($buildinglists as $buildlist){
                        $build_id_array[] = $buildlist['building_id'];
				 }
                $companyListing = $buildingMapper->getBuildingList($build_id_array);
            }

        }	
        $page = $this->_getParam('page', 1);
        $order = $this->_getParam('order', 'woId');
        $dir = $this->_getParam('dir', 'DESC');
        $wolist = '';
		$per_page_record = $this->_getParam('show', 1);
        $show =  (isset($per_page_record))?$per_page_record:$_COOKIE['show_limit'];
       
		$build_ID = $this->_getParam('bid', '');  
          
        $select_build_id = $build_ID;
        /*         * *******set building in cookie ********* */
        $buildIds = array();
        foreach ($companyListing as $cl) {
            $buildIds[] = $cl['build_id'];
        }
        if ($build_ID == 'all') {
            $set_cookie = setcookie('build_cookie', '', time() + (86400 / 24), "/");
        }
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds))) {
            $build_ID = $_COOKIE['build_cookie'];
        } else {
            $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");
            if ($build_ID == 'all') {
                $build_ID = '';
                $set_cookie = setcookie('build_cookie', '', time() + (86400 / 24), "/");
            }
        }

        //$_COOKIE['build_cookie'];

        $woModel = new Model_WorkOrder();
        $search_array = array();

        if (isset($_REQUEST['submitform'])) {
            if (isset($_POST['search_chkboxstatus']) && $_POST['search_chkboxstatus'] != '') {
                $search_array['search_status'] = $_POST['search_chkboxstatus'];

                setcookie('search_chkboxstatus', serialize($_POST['search_chkboxstatus']), 2147483647, '/');
                
            } else {
                setcookie('search_chkboxstatus', '', 2147483647, '/');
                setcookie('show_limit', serialize($_POST['show_limit']), 2147483647, '/');
            }
        } elseif (!isset($search_array['search_chkboxstatus']) && isset($_COOKIE['search_chkboxstatus'])) {
            $search_array['search_status'] = unserialize($_COOKIE['search_chkboxstatus']);
            
        }
        
        $show = $this->_getParam('show', '');
        if($show != ""){
            setcookie('show_limit', $show, 2147483647, '/');
        }else{
           $show =  $_COOKIE['show_limit'];
        }       

        if(unserialize($show)){
            $show =  unserialize($show);
        }
        //if(!is_int($show) || $show==""){
        if($show==""){
            $show = 25;
        }

		
        $category_name = $this->_getParam('category_name', '');
        if ($category_name != '') {
            $search_array['category_name'] = addslashes($category_name);
            $this->view->category_name = $category_name;
        }

        $tenant_name = $this->_getParam('tenant_name', '');
        if ($tenant_name != '') {
            $search_array['tenant_name'] = addslashes($tenant_name);
            $this->view->tenant_name = $tenant_name;
        }

        $search_wo = $this->_getParam('search_wo', '');
        if ($search_wo != '') {
            $search_array['search_wo'] = $search_wo;
            $this->view->search_wo = $search_wo;
        }

        $from_date = $this->_getParam('from_date', '');
        if ($from_date != '') {
            $search_array['from_date'] = date("Y-m-d", strtotime($from_date));
            $this->view->from_date = date("Y-m-d", strtotime($from_date));
        }

        $to_date = $this->_getParam('to_date', '');
        if ($to_date != '') {
            $search_array['to_date'] = date("Y-m-d", strtotime($to_date));
            $this->view->to_date = date("Y-m-d", strtotime($to_date));
        }


        if ($companyListing != '') {


            /* if($this->roleId=='9'){ */
            if ($build_ID == '') {
				
                $buildIds = array();
                foreach ($companyListing as $cl) {
                    $buildIds[] = $cl['build_id'];
                }
               $wolist = $woModel->getWorkOrderByBuilIds($buildIds, $order, $dir, $search_array,$page, $show);
               $wolistcount = $woModel->getWorkOrderByBuilIdsNew($buildIds, $order, $dir, $search_array);
            } else {
                $wolist = $woModel->getBuildingWorkOrder($build_ID, $order, $dir, $search_array,$page, $show);
              $wolistcount = $woModel->getBuildingWorkOrderNew($build_ID, $order, $dir, $search_array);
            }
			
			
            /* }else{
              //$eguModel = new Model_EmailGroupUsers();
              //$egulist =  $eguModel->getGroupIdByUser($this->userId);
              //$eg_array = array();

              $catIds = array();
              $catModel = new Model_Category();
              $catlist = $catModel->getCategoryByUser($this->userId,$build_ID);
              foreach($catlist as $cl){
              $catIds[] = $cl['cat_id'];
              }

              $catEmaillist =  $catModel->getCategoryByEmailUser($this->userId,$build_ID);

              foreach($catEmaillist as $cel){
              if(!in_array($cel->cat_id,$catIds)){
              $catIds[] = $cel->cat_id;
              }
              }

              $wolist = $woModel->getWorkOrderByCatIds($catIds);
              } */
        }
        // from here
        $total_rows = $wolistcount;
        $no_of_records_per_page = $show;
        $total_pages = ceil($total_rows / $no_of_records_per_page);
         
        $this->view->total_pages = $total_pages;
        $this->view->pageno = $page;
        $this->view->records = sizeof($wolist);
        
        
        $pageObj = new Ve_Paginator();
        //$paginator = $pageObj->fetchPageDataResult($wolist, $page, $show);
        $paginatorNew = $pageObj->fetchPageDataResultNew($wolist, $wolistcount, $page, $show);
        //$lastactivity = $woModel->get_last_activity();
        $this->view->page = $page;
        $view_type = $this->_getParam('view_type', 'line');
        $this->view->custID = $this->cust_id;
        $this->view->companyListing = $companyListing;
        $this->view->select_build_id = $build_ID;
        $this->view->wolist = $paginatorNew;//$paginator;
        $this->view->order = $order;
        $this->view->dir = $dir;
        $this->view->view_type = $view_type;
        $this->view->roleId = $this->roleId;
        $this->view->acessHelper = $this->accessHelper;
        $this->view->dline_location = $this->dline_location;
        $this->view->ddetail_location = $this->ddetail_location;
        $this->view->createnew_location = $this->createnew_location;
        $this->view->closewo_location = $this->closewo_location;
        $this->view->userId = $this->userId;
        // refresh outo load  
        $getsult = $this->gettotalAction();       
        $this->view->count = $getsult;
        $this->view->show = $show;
        if (isset($_REQUEST['submitform'])) {
            if (isset($_POST['search_chkboxstatus']) && $_POST['search_chkboxstatus'] != '') {
                $this->view->statusCookieDetails = $_POST['search_chkboxstatus'];
            }
        } else {

            $statusCookie = new Zend_Controller_Request_Http();
            $statusCookieDetails = $statusCookie->getCookie('search_chkboxstatus');
            $statusCookieDetails = unserialize($statusCookieDetails);
            if ($statusCookieDetails != '') {
                $this->view->statusCookieDetails = $statusCookieDetails;
            }
        }
        $adminNamespace = new Zend_Session_Namespace('Admin_User');
        $this->view->admin_role_id = $adminNamespace->role_id;

 


		 if($this->roleId=='5' || $this->roleId=='7'){
		
			$tenantDefualtbuildinglists = $buildinglists;

			$tId = $this->_getParam('tid');
			if(isset($tId) && !empty($tId)){
				$set_cookie = setcookie('tenant_company', $tId, time() + (86400 / 24), "/");
			}
		    $tenant = new Model_Tenant();
			$tId  = $_COOKIE['tenant_company'];
		if ($tId){				
			$tenantCompanyList = $tenant->getTenantCompanies($this->userId);     
			$tenantuser = $tenant->getTenanyUserByTenantGroup($tId);

			
			$this->view->tId = $tId;				
			$this->view->tenantGroupListArr = $tenantCompanyList;
		}		
		else
		$tenantuser = $tenant->getTenantByUser($this->userId);

		 $tenantData = $tenant->getTenantByUser($this->userId);
		 $tenantInfo = $tenantData[0];
		 $page=$this->_getParam('page',1);
		 $order=$this->_getParam('order','woId');
		 $dir=$this->_getParam('dir','DESC');
		 
		 //for tanant Admin
		 $userId = $this->userId;	
		 if($this->roleId=='5'){	
           $search_array['userId'] = $userId;
 
			$wolist = $woModel->getWorkOrderByBuilIds($buildIds, $order, $dir, $search_array,$page, $show);
			$wolistcount = $woModel->getWorkOrderByBuilIdsNew($buildIds, $order, $dir, $search_array);
		 }else if($this->roleId=='7'){		
				
			if (isset($tId)){	
					// echo $userId;
				$wolist = $this->woMapper->getTenantUserWorkOrder($tId,$order,$dir,$userId,$search_array);	
				
			}else{				
				$wolist = $this->woMapper->getTenantUserWorkOrder($tenantInfo->tenantId,$order,$dir,$userId,$search_array);
			}
		   
		 }		
		//  if($this->roleId=='7')		 
		//  $wolist = $this->woMapper->getTenantWorkOrder($tenantInfo->tenantId,$order,$dir,$this->userId);
		//  else
		//  $wolist = $this->woMapper->getTenantWorkOrder($tenantInfo->tenantId,$order,$dir);
		 $pageObj=new Ve_Paginator();
		 $paginator=$pageObj->fetchPageDataResult($wolist,$page,$show);		 
		 $this->view->page = $page;
		 $this->view->roleId = $this->roleId;
		 //$this->view->tenantuser = $tenantuser[0];
		 $this->view->wolist = $paginator;
		 $this->view->order = $order;
		 $this->view->dir = $dir;

		 
		 $this->tenantDefualtbuildinglists = $tenantDefualtbuildinglists;
		 }
	   $this->view->roleId = $this->roleId;
	 }
    public function gettotalAction(){
        $woModel = new Model_WorkOrder();        
        $lastactivity = $woModel->get_last_activity();
        $lastactivity1 = $woModel->get_last_activity1();
        $lastactivity2 = $woModel->get_last_activity2();
        //echo $total = count($lastactivity)+count($lastactivity1)+count($lastactivity2);
        $total = $lastactivity + $lastactivity1 + $lastactivity2;
        return $total;
    } 


   /***********
    * create work order action
    */
    
    public function createworkorderAction(){		
		$buildingList ='';
		if($this->roleId=='5' || $this->roleId=='7'){
		   /*******get building id of tenant ******/
		   $tenant = new Model_Tenant();
		   $priorityMapper = new Model_Priority();
		   $categoryMapper = new Model_Category();
		   $tenantData = $tenant->getTenantByUser($this->userId);
		   $buildId = $tenantData[0]->buildingId;		   
		   $priorityDetail = $priorityMapper->getBuildingPriorityList($buildId);
		   $categoryDetail = $categoryMapper->getBuildingCategoryList($buildId);		   
		   $userlistArray = array();
		   if($this->roleId=='5'){
			   $tenantId = $tenantData[0]->tenantId;
			   $tUserModel = new Model_TenantUser();
			   $userlistArray = $tUserModel->getTenantUsers($tenantId);
		   }else{
			  $userlistArray =  array((object)array('uid'=>$this->userId,'email'=>$this->email,'firstName'=>$this->firstName,'lastName'=>$this->lastName));
		   }				 
		   $submit_key = rand(10,1000);
		   $formKey = new Zend_Session_Namespace('formkey');
		   $formKey->submit_key = $submit_key;
		   $this->view->buildingList = $buildingList;
		   $this->view->tenantData = (array)$tenantData[0];
		   $this->view->priorityDetail = $priorityDetail;
		   $this->view->categoryDetail = $categoryDetail;
		   $this->view->form_key = $submit_key;
		   $this->view->userlistArray = $userlistArray;
		   $this->view->userId = $this->userId;
	   }
	   $this->view->roleId = $this->roleId;
	}
	
	/**
	 * fetch worked order form with
	 * respect to building id.
	 */ 
	public function ajaxworkorderAction(){
		$data = $this->getRequest()->getPost();		
		if($this->getRequest()->getMethod() == 'POST'){
			$buildId = $data['buildId'];
			$priorityMapper = new Model_Priority();
			$categoryMapper = new Model_Category();
			$buildingMapper = new Model_Building();
			$tenantMapper = new Model_Tenant();
			$priorityDetail = $priorityMapper->getBuildingPriorityList($buildId);
			$categoryDetail = $categoryMapper->getBuildingCategoryList($buildId);			
			$buildingDetail = $buildingMapper->getbuildingbyid($buildId);
			$tenantDetail     = $tenantMapper->getTenantById($this->userId);			
			$tenantInfo = $tenantDetail[0];
			$tenantData       = (array)$tenantInfo;//->toArray();
			$workorder_template = new Zend_View();
			$workorder_template->setScriptPath(APPLICATION_PATH . '/modules/default/views/scripts/workorder/');
			$workorder_template->assign('categoryDetail', $categoryDetail);
			$workorder_template->assign('priorityDetail', $priorityDetail);
			$workorder_template->assign('buildingDetail', $buildingDetail[0]);
			$workorder_template->assign('tenantData', $tenantData);			
			$bodyText = $workorder_template->render('ajaxworkorder.phtml');        
			echo $bodyText;
		}
        exit(0);
	}
	
	/**
	 * Save worke order
	 */ 
	public function saveworkorderAction(){
		$data = $this->getRequest()->getPost();	
						
		if(isset($data) && $data['building']!=''){
			$form_key = $data['form_key'];
			$smsg = new Zend_Session_Namespace('message');
		    $smsg->success_message = '';
		    $smsg->error_message = '';
			$formKey = new Zend_Session_Namespace('formkey');
		    $session_form_key = $formKey->submit_key;
			if($form_key!=$session_form_key){
				$smsg->error_message = 'Invalid Form Key';
				$this->_redirect('/workorder/createworkorder');
			}else{
				$formKey->submit_key='';
			}
			
			/**********check form validation **********/
			$form_valid = true;
			if($data['building']=='' || $data['tenant']=='' || $data['create_user']=='' || $data['category']=='' || $data['work_order_request']==''){
				$form_valid = false;
				$smsg->error_message = 'Form is not properly filled.';
				$this->_redirect('/workorder/createworkorder');
			
			}
			if($_FILES['wo_file']['name']!=''){
			$filetype= array("application/pdf", "image/gif", "image/jpg", "image/jpeg", "image/png" ); 
			
				if($_FILES['wo_file']['size']> 5242880 || !in_array($_FILES['wo_file']['type'], $filetype)){ 
					$form_valid = false;
					$smsg->error_message = 'Form is not properly filled.';
					$this->_redirect('/workorder/createworkorder');
				}
			}
			
			if($form_valid==true){
				try{
					$insertData = array();
					/******************* set timezone through building id ****************************/
					$settimezone = new Model_TimeZone();
					$settimezone -> setTimezone($data['building']);
					/******************* end - set timezone through building id ****************************/
									

					
					$insertData['tenant'] = $data['tenant'];
					// for multi tenant and tenant panel					
                    if(isset($_SESSION['Admin_User']['role_id']) && $_SESSION['Admin_User']['role_id']=="5" ){
						if(isset($_COOKIE['tenant_company'])){
						$tenant_company_arr = explode(",",$_COOKIE['tenant_company']);
						if(isset($tenant_company_arr[0])){
						  $insertData['tenant'] = $tenant_company_arr[0];
						 }
						}
					}

					$insertData['building'] = $data['building'];
					if(isset($data['suite_location'])) $insertData['suite_location'] = $data['suite_location'];
					if(isset($data['suite_location2'])) $insertData['suite_location2'] = $data['suite_location2'];
					$insertData['create_user'] = $data['create_user'];
					$insertData['date_requested'] = $data['date_requested'];
					$insertData['time_requested'] = $data['time_requested'];
					//$insertData['priority'] = $data['priority'];
					$insertData['category'] = $data['category'];
					$insertData['internal_work_order'] = $data['internal_work_order'];
					$insertData['work_order_request'] = $data['work_order_request'];
					$insertData['user_id'] = $this->userId;	
					$insertData['created_at'] = date('Y-m-d H:i:s');
					$woId = $this->woMapper->insertWorkOrder($insertData);
					
					$wpModel = new Model_WorkOrderUpdate();
					$wpData = array();
					$wpData['wo_id'] = $woId;
					$wpData['wo_request'] = $data['work_order_request'];
					$wpData['wo_status'] = 1;
					$wpData['current_update']=1;
					$wpData['created_at'] = date('Y-m-d H:i:s');
					$insertWp = $wpModel->insertWorkOrderUpdate($wpData);
					
					/*************upload file************/
					if($_FILES['wo_file']['name']!=''){						
							$uploaddir = BASE_PATH.'public/work_order/';
							$uploadfile_name = 'Work-order-'.time().'-'. basename($_FILES['wo_file']['name']);                        
							$uploadfile = $uploaddir.''.$uploadfile_name;                        
							if (!file_exists($uploaddir)) {
								mkdir($uploaddir, 0777, true);
							}
							move_uploaded_file($_FILES["wo_file"]["tmp_name"], $uploadfile);						
							$fileTitle = explode('.',basename($_FILES['wo_file']['name']));
							$file_title = $fileTitle[0];
							
							$file_name = $uploadfile_name;
							$insertFData = array();
							$insertFData['woId'] = $woId;
							$insertFData['file_title'] = $file_title;
							$insertFData['file_name'] = $file_name;
							try{
								$fileModel = new Model_WoFiles();
								$insertRecord = $fileModel->insertWoFile($insertFData);															
							}catch(Exception $e){
								echo $e->getMessage();
							}
						}
					
					/********* update work order number *********/
					$wo_number ='';
					if($data['building']!=''){
						$lastWoNum = $this->woMapper->getMaxWoNumber($data['building']);
						$update_wo_num = '';
						if($lastWoNum){
							$update_wo_num = $lastWoNum+1;
						}else{
							$update_wo_num = 1001;
						}
						try{
							$update_num = $this->woMapper->updateWorkOrder(array('wo_number'=>$update_wo_num),$woId);
							$wo_number = $update_wo_num;
						}catch(Exception $e){
							echo $e->getMessage();
						}
						
					}
					$insertData['woId'] = $woId;
					$insertData['wo_number'] = $wo_number;
					$priorityMapper = new Model_Priority();
					$categoryMapper = new Model_Category();
					$buildingMapper = new Model_Building();
					$accoutMapper = new Model_Account();
					$userMapper     = new Model_User();
					$tenantMapper = new Model_Tenant();
					$catDetail = $categoryMapper->getCategoryName($data['category']);
					$priorityDetail = $priorityMapper->getPriorityByCategory($data['category']);
					$buildingDetail = $buildingMapper->getbuildingbyid($data['building']);				
					$tenantDetail     = $tenantMapper->getTenantByUser($this->userId);
					$accountDetail = $accoutMapper->getcompany($buildingDetail[0]['cust_id']);			
					$tenantInfo = $tenantDetail[0];
					$tenantData       = (array)$tenantInfo;
					if($priorityDetail){
						
						$prioritData = (array)$priorityDetail[0];
						$priorityName=  $prioritData['priorityName'];
						$pid = $prioritData['pid'];
					}else{
					 $priorityName = 'Not Assigned';
					 $pid =0;
					}
					/*********** Insert work order schedule ************/
					$schedule_id=0;
					$psModel = new Model_Schedule();
					$startId =1;// for start schedule status;
					$psData = $psModel->getWoSchedule($pid,$startId);
					if($psData){
						$schedule_id = $psData[0]['id'];
					}
					$wssModel = new Model_WoScheduleStatus();
					$wss_data = array();
					$wss_data['worder_id']=	$woId;
					$wss_data['schedule_id']= $schedule_id;
					$wss_data['priority_id']= $pid;
					$wss_data['status']= 1;
					$wss_data['ckey']= md5(time());
					$wss_data['current_status']= 1;
					$wss_data['created_at'] = date('Y-m-d H:i:s');
					$ws_insert = $wssModel->insertWoSchedule($wss_data);			
					/****** send work order mail*******/
					$sendmail = $this->woMapper->sendWorkOrderEmail($woId,$tenantData);
					/***********display print work order *********/				
					$this->view->buildingDetail = $buildingDetail[0];
					$this->view->workOrder = $insertData;
					$this->view->cust_id = $this->cust_id;				
					$this->view->tenantInfo = $tenantData;
					$this->view->categoryName = $catDetail[0]['categoryName'];
					$this->view->priorityName  = $priorityName;
					$this->view->companyName  = $accountDetail[0]['companyName'];
					$this->view->msg = 'Work Order Request Saved Successfully.';
				}catch(Exception $e){
					$this->view->msg = $e->getMessage();
				}
			}	
	    }else{
			$this->_redirect('/workorder/createworkorder');
		}  
	}
	
	/**
	 *print work order 
	 */
	 public function printworkorderAction(){		 
		 $this->_helper->layout()->disableLayout();         
		 $woId = $page=$this->_getParam('woId',0);		
		 $workOrder = $this->woMapper->getWorkOrder($woId);
		 
		 if($workOrder){
		    $workOrderData = $workOrder[0];
		   
		    
		    $buildingMapper = new Model_Building();
		    $accoutMapper = new Model_Account();
		    $userMapper     = new Model_User();
		    $tenantMapper = new Model_Tenant();
		    $categoryMapper = new Model_Category();
		    $priorityMapper = new Model_Priority();
		    $catDetail = $categoryMapper->getCategoryName($workOrderData['category']);
		    $priorityDetail = $priorityMapper->getPriorityByCategory($workOrderData['category']);	   
		    $buildingDetail = $buildingMapper->getbuildingbyid($workOrderData['building']);
			$tenantDetail     = $tenantMapper->getTenantById($workOrderData['tenant']);						
			$tenantInfo = $tenantDetail[0];
			
			$accountDetail = $accoutMapper->getcompany($buildingDetail[0]['cust_id']);
			
			$tenantData       = (array)$tenantInfo;
			if($priorityDetail){
				$prioritData = (array)$priorityDetail[0];
				$priorityName=  $prioritData['priorityName'];
			}else
			$priorityName = 'Not Assigned';
			$this->view->buildingDetail = $buildingDetail[0];
			$this->view->workOrder = $workOrderData;
			$this->view->cust_id = $this->cust_id;			
			$this->view->tenantInfo = $tenantData;
			$this->view->categoryName = $catDetail[0]['categoryName'];
			$this->view->priorityName  = $priorityName;
			$this->view->companyName  = $accountDetail[0]['companyName'];		   
	    }else{
			echo 'Invalid data to print';
			exit;
		}
	 } 
	 
	 /**
	 *view  work order 
	 */
	 public function viewAction(){		 
		 //$this->_helper->layout()->disableLayout();         
		 $woId = $page=$this->_getParam('woId',0);		
		 $workOrder = $this->woMapper->getWorkOrder($woId);
		 
		 if($workOrder){
		    $workOrderData = $workOrder[0];
		   
		    
		    $buildingMapper = new Model_Building();
		    $accoutMapper = new Model_Account();
		    $userMapper     = new Model_User();
		    $tenantMapper = new Model_Tenant();
		    $categoryMapper = new Model_Category();
		    $priorityMapper = new Model_Priority();
		    $catDetail = $categoryMapper->getCategoryName($workOrderData['category']);
		    $priorityDetail = $priorityMapper->getPriorityByCategory($workOrderData['category']);	   
		    $buildingDetail = $buildingMapper->getbuildingbyid($workOrderData['building']);
			$tenantDetail     = $tenantMapper->getTenantById($workOrderData['tenant']);						
			$tenantInfo = $tenantDetail[0];
			$accountDetail = $accoutMapper->getcompany($buildingDetail[0]['cust_id']);
			
			$tenantData       = (array)$tenantInfo;
			if($priorityDetail){
				$prioritData = (array)$priorityDetail[0];
				$priorityName=  $prioritData['priorityName'];
			}else
			$priorityName = 'Not Assigned';
			$this->view->buildingDetail = $buildingDetail[0];
			$this->view->workOrder = $workOrderData;
			$this->view->cust_id = $this->cust_id;			
			$this->view->tenantInfo = $tenantData;
			$this->view->categoryName = $catDetail[0]['categoryName'];
			$this->view->priorityName  = $priorityName;	
			$this->view->companyName  = $accountDetail[0]['companyName'];	   
	    }else{
			echo 'Invalid data to print';
			exit;
		}
	 } 
	
	 
	 
	 /**
	  * Edit work order
	  * 
	  */
	  
	  public function editorderAction(){
		  $woId =$this->_getParam('woId','');
		  if($woId!=''&& !empty($woId)){
			$workOrder = $this->woMapper->getWorkOrder($woId);
			$building = $workOrder[0]['building'];
			$priorityMapper = new Model_Priority();
			$categoryMapper = new Model_Category();
			$buildingMapper = new Model_Building();
			$tenantMapper = new Model_Tenant();
			$priorityDetail = $priorityMapper->getBuildingPriorityList($building);
			$categoryDetail = $categoryMapper->getBuildingCategoryList($building);			
			$buildingDetail = $buildingMapper->getbuildingbyid($building);
			$tenantDetail     = $tenantMapper->getTenantByUser($this->userId);			
			$tenantInfo = $tenantDetail[0];
			$tenantData       = (array)$tenantInfo;//->toArray();
			$this->view->buildingDetail = $buildingDetail[0];
			$this->view->categoryDetail = $categoryDetail;
			$this->view->priorityDetail = $priorityDetail;
			$this->view->tenantData = $tenantData;
			$this->view->workOrder = $workOrder[0];
			$this->view->woId = $woId;
		  }else{
			  echo 'Bad Request';
			 $this->_redirect('/workorder'); 
		  }
	  } 
	  
	  
	  /***
	   * Update Work order
	   */ 
	   public function updateorderAction(){
		   $data = $this->getRequest()->getPost();
		   if(isset($data) && count($data)>0 && $data['wo_id']!=''){
			   $updateData = array();
			   $updateData['date_requested'] = $data['date_requested'];
			   $updateData['time_requested'] = $data['hour'].':'.$data['minute'].' '.$data['am_pm'];;
			   $updateData['priority'] = $data['priority'];
			   $updateData['category'] = $data['category'];
			   $updateData['work_status'] = $data['work_status'];
			   $updateData['work_order_request'] = $data['work_order_request'];			  
			   try{
				   $workOrder = $this->woMapper->updateWorkOrder($updateData,$data['wo_id']);
			   }catch(Exception $e){
				   echo $e->getMessage();
			   }
		   }
		   $this->_redirect('/workorder'); 
	   }
	   
	   /**
	    * Delete work order
	    */
	    
	    public function deleteorderAction(){
			$woId =$this->_getParam('woId','');
		  if($woId!=''&& !empty($woId)){
			  $workOrder = $this->woMapper->deleteWorkOrder($woId);
		  }else{
			  echo 'Bad Request';
			 
		  }
		   $this->_redirect('/workorder');		   		   
		}
		
		/******for testing email flow****/
		
		public function emailorderAction(){
			$woId = 1022;
			$tenantMapper = new Model_Tenant();
			$tenantDetail     = $tenantMapper->getTenantByUser($this->userId);			
			$tenantInfo = $tenantDetail[0];
			$tenantData       = (array)$tenantInfo;//->toArray();
			$sendmail = $this->woMapper->sendWorkOrderEmail($woId,$tenantData);
			exit;
		}
		
		
		public function ajaxworkordernotifyAction(){
			$data = $this->getRequest()->getPost();	
			//print_r($data);	
			if($this->getRequest()->getMethod() == 'POST'){
				$buildId = $data['tenant_buiding'];
				$tenantIds = $data['tenant_location_info'];
				$woModel = new Model_WorkOrder();

				$last_recods = $woModel->getBuildingWorklastOrderDetail($buildId,$tenantIds);
				echo json_encode($last_recods);
				
			}
			exit(0);
		}


		public function getdataAction(){
	    $data = $this->getRequest()->getPost();			
		$build_ID =   $this->_getParam('bid');	

		$companyListing = '';
        $buildingMapper = new Model_Building();
        if ($this->roleId == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
       
		} else {
            $user_build_mod = new Model_UserBuildingModule();
            $buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
        
			if ($buildinglists) {
				$build_ID = $buildinglists[0]['building_id'];
                // $build_id_array = array();
                foreach ($buildinglists as $buildlist){
                        $build_id_array[] = $buildlist['building_id'];
				 }
                $companyListing = $buildingMapper->getBuildingList($build_id_array);
            }

        }	
        $page = $this->_getParam('page', 1);
        $order = $this->_getParam('order', 'woId');
        $dir = $this->_getParam('dir', 'DESC');
        $wolist = '';
		$per_page_record = $this->_getParam('show', 1);
        $show =  (isset($per_page_record))?$per_page_record:$_COOKIE['show_limit'];
       
		$build_ID = $this->_getParam('bid');       
		    
        $select_build_id = $build_ID;
        /*         * *******set building in cookie ********* */
        $buildIds = array();
        foreach ($companyListing as $cl) {
            $buildIds[] = $cl['build_id'];
        }
        if ($build_ID == 'all') {
            $set_cookie = setcookie('build_cookie', '', time() + (86400 / 24), "/");
        }
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds))) {
            $build_ID = $_COOKIE['build_cookie'];
        } else {
            $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");
            if ($build_ID == 'all') {
                $build_ID = '';
                $set_cookie = setcookie('build_cookie', '', time() + (86400 / 24), "/");
            }
        }

        //$_COOKIE['build_cookie'];

        $woModel = new Model_WorkOrder();
        $search_array = array();

        if (isset($_REQUEST['submitform'])) {
            if (isset($_POST['search_chkboxstatus']) && $_POST['search_chkboxstatus'] != '') {
                $search_array['search_status'] = $_POST['search_chkboxstatus'];

                setcookie('search_chkboxstatus', serialize($_POST['search_chkboxstatus']), 2147483647, '/');
                
            } else {
                setcookie('search_chkboxstatus', '', 2147483647, '/');
                setcookie('show_limit', serialize($_POST['show_limit']), 2147483647, '/');
            }
        } elseif (!isset($search_array['search_chkboxstatus']) && isset($_COOKIE['search_chkboxstatus'])) {
            $search_array['search_status'] = unserialize($_COOKIE['search_chkboxstatus']);
            
        }
        
        $show = $this->_getParam('show', '');
        if($show != ""){
            setcookie('show_limit', $show, 2147483647, '/');
        }else{
           $show =  $_COOKIE['show_limit'];
        }       

        if(unserialize($show)){
            $show =  unserialize($show);
        }
        //if(!is_int($show) || $show==""){
        if($show==""){
            $show = 25;
        }
		
        $category_name = $this->_getParam('category_name', '');
        if ($category_name != '') {
            $search_array['category_name'] = addslashes($category_name);
            $this->view->category_name = $category_name;
        }

        $tenant_name = $this->_getParam('tenant_name', '');
        if ($tenant_name != '') {
            $search_array['tenant_name'] = addslashes($tenant_name);
            $this->view->tenant_name = $tenant_name;
        }

        $search_wo = $this->_getParam('search_wo', '');
        if ($search_wo != '') {
            $search_array['search_wo'] = $search_wo;
            $this->view->search_wo = $search_wo;
        }

        $from_date = $this->_getParam('from_date', '');
        if ($from_date != '') {
            $search_array['from_date'] = date("Y-m-d", strtotime($from_date));
            $this->view->from_date = date("Y-m-d", strtotime($from_date));
        }

        $to_date = $this->_getParam('to_date', '');
        if ($to_date != '') {
            $search_array['to_date'] = date("Y-m-d", strtotime($to_date));
            $this->view->to_date = date("Y-m-d", strtotime($to_date));
        }


        if ($companyListing != '') {

			
            /* if($this->roleId=='9'){ */
            if ($build_ID == '') {
				
                $buildIds = array();
                foreach ($companyListing as $cl) {
                    $buildIds[] = $cl['build_id'];
                }
               $wolist = $woModel->getWorkOrderByBuilIds($buildIds, $order, $dir, $search_array,$page, $show);
               $wolistcount = $woModel->getWorkOrderByBuilIdsNew($buildIds, $order, $dir, $search_array);
            } else {
			//echo $build_ID;
			$build_ID = $this->_getParam('bid');
			$tenantId = $this->_getParam('tid');
			$color_code = array('00FFFF', 'FF0000', 'FF00FF', '800000', '008000', '800080', '808000', '0000FF', '00FF00', '00008075', 'FFFF00', '808000', '008080', 'FFA500');
			$building_color = array();
		    $j = 1;
			$tenantlist = explode(',', $tenantId);

            foreach ($tenantlist as $cb) {
                if (isset($color_code[$j]))
                    $building_color[$cb] = $color_code[$j];
                else {
                    $j = 0;
                    $building_color[$cb] = $color_code[$j];
                }
                $j++;
            }
			 $page=$this->_getParam('start');
			 if($this->_getParam('per_page_rec')){
				$show = $this->_getParam('per_page_rec');
			 }else{
			  $show = $this->_getParam('length');
			 }
			
			 $filter_data = array();
			 $filter_data['search_wo'] = $this->_getParam('woid');
			 $filter_data['search_status'] = $this->_getParam('status');
			 if($filter_data['search_status']){
				$filter_data['search_status'] = explode(',',$filter_data['search_status']);
			 }

			 $order = "created_at";
			 $dir="DESC";
             if($tenantId){
				$wolist = $woModel->getBuildingWorkOrderTenantLoc($build_ID, $order, $dir,$filter_data,$page,$show,$tenantId);

			 }else{
				$wolist = $woModel->getBuildingWorkOrder($build_ID, $order, $dir,null,$page, $show);

			 }
            //  echo '<pre>';
			//  print_r($wolist);
			$ssModel = new Model_ScheduleStatus();
			$status_list = $ssModel->getScheduleStatus();
			$status_array = array();
			$view_type = $this->_getParam('view_type', 'line');
 
			$reportModel = new Model_Report();
			$reportDetailLinks = '';
			$dashBoardViewsdetails = '';
			if ($view_type!= 'detail') {
			$reportDetailLinks = $reportModel->getReport($this->custID, 2);
			$dashBoardViewsdetails = $reportModel->getReport($this->custID, 27);
			} else {
			$reportDetailLinks = $reportModel->getReport($this->custID, 3);
			}		   

			if ($dashBoardViewsdetails != '') {
				$dashBoardViewsdetailsoption = $dashBoardViewsdetails[0]->report_option;
				$dashBoardViewsdetailsoption = explode(',', $dashBoardViewsdetailsoption);
				
			if ($dashBoardViewsdetails[0]->Report_Type == 'Flash') {
				$report_type = 'reports/VisionReportEngine/index.php?stimulsoft_client_key=ViewerFx&stimulsoft_';
			}else {
				$report_type = 'vnsreports/index.php?';
			}
		}

			foreach ($status_list as $sl) {
				if ($sl['ssID'] != 8)
					$status_array[$sl['ssID']] = $sl['title'];
				    $workorderallstatus = $workorderallstatus . $sl['ssID'] . ',';
			}
			

			  $record_data = array();

			  if(!empty($wolist)){
				foreach($wolist as $rec){
					$wo_status = $status_array[$rec->wo_status];
					
					 $printStr = '<div class="center">';
					 $printStr .='<div class="text">';			
					
					 $descText = strip_tags($rec->work_order_request);
					 $descText = str_replace("&nbsp;", ' ', $descText);
					 $printStr .= substr($descText, 0, 25);
					 $printStr .=(substr($descText, 30)) ? '...' : '';
					 $printStr .='</div>';					
					if(strlen($descText)>=30){ 
					$printStr .='<div class="text-tooltip " >'. $descText.'</div>';
					 } 
					 $printStr .='</div>';
					 $plusicon='<a ';
					if ($dashBoardViewsdetails[0]->report_target == 1) {
						$plusicon .='target="_blank"';
					
					}						 
					$plusicon .=' href="'. BASEURL;
					$plusicon .= $report_type;
					$plusicon .='report_key=' . $dashBoardViewsdetails[0]->report_mrt;

					if (in_array('[[++user_id]]', $dashBoardViewsdetailsoption)) {
						$plusicon .= '&User=' . $this->userId;
					}
							
						if ((in_array('[[++CostCenterNumber]]', $dashBoardViewsdetailsoption))) {
						$plusicon .= '&Cost_Center_Number=' . $rec->uniqueCostCenter;
						}

						if ((in_array('[[++KeyBuildingNumber]]', $dashBoardViewsdetailsoption))) {
						$plusicon .= '&buildkey=' . $rec->building;
						}

						if (in_array('[[++BatchNumber]]', $dashBoardViewsdetailsoption) && $rec->wo_batch != 0) {
						$plusicon .= '&Batch_Number=' . $rec->wo_batch;
						}

						if ((in_array('[[++WONumber]]', $dashBoardViewsdetailsoption))) {
						$plusicon .= '&WO_Number=' . $rec->wo_number;
						}
							
						if ((in_array('[[++InvoiceNumber]]', $dashBoardViewsdetailsoption)) && $rec->billable_opt == 1) {
						$plusicon .= '&Invoice_Number=' . $rec->wo_number;
						}
							
						if ((in_array('[[++Status_id]]', $dashBoardViewsdetailsoption))) {
						$plusicon .= '&Status=' . $rec->wo_status;
						}
						$plusicon .= '" >';
						$plusicon .='<img';
						$plusicon .=' src="'. BASEURL;																		
						$plusicon .='public/images\printer.png"' .' style="width:20px;">';
						$plusicon .='</a>';	

						$plusicon2='<div style="padding:10px 8px;" tenantid="'.$rec->tenant.'" >';
						$plusicon2 .= '<a href="javascript:void(0)" onclick="showTenantWorkOrder('. $rec->wo_number.','.$rec->woId.')";>';
						$plusicon2 .= '<i id="plus_'. $rec->woId.'" class="fa fa-plus blackfont_color plus_min_icon"></i></a>';
						$plusicon2 .= '</div>';
						$backgroundColor= '"#'.$building_color[$rec->tenant].'"';

						$temp = array(date("m/d/Y", strtotime($rec->date_requested)),$rec->date_requested,$rec->wo_number,$wo_status,
							stripslashes($rec->categoryName),$printStr,$plusicon,$plusicon2,$backgroundColor,$rec->woId
						);
					
					// array_push($temp,$rec->woId);
					// array_push($temp,$rec->tenant);
					// array_push($temp,$rec->category);
					// array_push($temp,$rec->date_requested);
					// array_push($temp,$rec->date_requested);
					// array_push($temp,$rec->date_requested);
					 $record_data[] = $temp;

				}
				

			  }
			  // $wolistcount = $woModel->getBuildingWorkOrderNew($build_ID, $order, $dir, $search_array);
            }
			/*** *
			$jsondataAry = [
				"data" => [
					
					$record_data
					//   [
					// 	 "Tiger Nixon", 
					// 	 "System Architect", 
					// 	 "Edinburgh", 
					// 	 "5421", 
					// 	 "2011-04-25", 
					// 	 "$320,800" 
					//   ], 
					//   [
					// 		"Garrett Winters", 
					// 		"Accountant", 
					// 		"Tokyo", 
					// 		"8422", 
					// 		"2011-07-25", 
					// 		"$170,750" 
					//   ]
				]					
			 ]; 
			  **/
			 $jsondataAry = array();
			// $jsondataAry['draw']=1;
			 $jsondataAry['recordsTotal']= count($record_data);
			 $jsondataAry['data'] =$record_data;
			  echo json_encode($jsondataAry,JSON_UNESCAPED_SLASHES);	

			exit(0);
		
        }
        // from here
      
       
		 if($this->roleId=='5' || $this->roleId=='7'){
		
			$tenantDefualtbuildinglists = $buildinglists;

			$tId = $this->_getParam('tid');
			if(isset($tId) && !empty($tId)){
				$set_cookie = setcookie('tenant_company', $tId, time() + (86400 / 24), "/");
			}
		    $tenant = new Model_Tenant();
			$tId  = $_COOKIE['tenant_company'];
		if ($tId){				
			$tenantCompanyList = $tenant->getTenantCompanies($this->userId);     
			$tenantuser = $tenant->getTenanyUserByTenantGroup($tId);

			
			$this->view->tId = $tId;				
			$this->view->tenantGroupListArr = $tenantCompanyList;
		}		
		else
		$tenantuser = $tenant->getTenantByUser($this->userId);

		 $tenantData = $tenant->getTenantByUser($this->userId);
		 $tenantInfo = $tenantData[0];
		 $page=$this->_getParam('page',1);
		 $order=$this->_getParam('order','woId');
		 $dir=$this->_getParam('dir','DESC');		 
		 //for tanant Admin
		 $userId = $this->userId;	
		 if($this->roleId=='5'){	
           $search_array['userId'] = $userId; 
			$wolist = $woModel->getWorkOrderByBuilIds($buildIds, $order, $dir, $search_array,$page, $show);
			$wolistcount = $woModel->getWorkOrderByBuilIdsNew($buildIds, $order, $dir, $search_array);
		 }else if($this->roleId=='7'){	
				
			if (isset($tId)){	
					// echo $userId;
				$wolist = $this->woMapper->getTenantUserWorkOrder($tId,$order,$dir,$userId,$search_array);	
				
			}else{				
				$wolist = $this->woMapper->getTenantUserWorkOrder($tenantInfo->tenantId,$order,$dir,$userId,$search_array);
			}
		   
		 }		
		//  if($this->roleId=='7')		 
		//  $wolist = $this->woMapper->getTenantWorkOrder($tenantInfo->tenantId,$order,$dir,$this->userId);
		//  else
		//  $wolist = $this->woMapper->getTenantWorkOrder($tenantInfo->tenantId,$order,$dir);
		 $pageObj=new Ve_Paginator();
		 $paginator=$pageObj->fetchPageDataResult($wolist,$page,$show);		 
		 //$this->view->tenantuser = $tenantuser[0];
	 
		 $this->tenantDefualtbuildinglists = $tenantDefualtbuildinglists;
		 
		}


			exit(0);
		}
		public function ajaxworkorderlistAction(){

			$data = $this->getRequest()->getPost();	
			//print_r($data);	
			if($this->getRequest()->getMethod() == 'POST'){

			}
		echo $this->roleId;
		die;

			$companyListing = '';
			$buildingMapper = new Model_Building();
			if ($this->roleId == '9') {
				$companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
		   
			} else {
				$user_build_mod = new Model_UserBuildingModule();
				$buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
			
				if ($buildinglists) {
					$build_ID = $buildinglists[0]['building_id'];
					// $build_id_array = array();
					foreach ($buildinglists as $buildlist){
							$build_id_array[] = $buildlist['building_id'];
					 }
					$companyListing = $buildingMapper->getBuildingList($build_id_array);
				}
	
			}	
			$page = $this->_getParam('page', 1);
			$order = $this->_getParam('order', 'woId');
			$dir = $this->_getParam('dir', 'DESC');
			$wolist = '';
			$per_page_record = $this->_getParam('show', 1);
			$show =  (isset($per_page_record))?$per_page_record:$_COOKIE['show_limit'];
		   
			$build_ID = $this->_getParam('bid', '');  
			  
			$select_build_id = $build_ID;
			/*         * *******set building in cookie ********* */
			$buildIds = array();
			foreach ($companyListing as $cl) {
				$buildIds[] = $cl['build_id'];
			}
			if ($build_ID == 'all') {
				$set_cookie = setcookie('build_cookie', '', time() + (86400 / 24), "/");
			}
			if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds))) {
				$build_ID = $_COOKIE['build_cookie'];
			} else {
				$set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");
				if ($build_ID == 'all') {
					$build_ID = '';
					$set_cookie = setcookie('build_cookie', '', time() + (86400 / 24), "/");
				}
			}
	
			//$_COOKIE['build_cookie'];
	
			$woModel = new Model_WorkOrder();
			$search_array = array();
	
			if (isset($_REQUEST['submitform'])) {
				if (isset($_POST['search_chkboxstatus']) && $_POST['search_chkboxstatus'] != '') {
					$search_array['search_status'] = $_POST['search_chkboxstatus'];
	
					setcookie('search_chkboxstatus', serialize($_POST['search_chkboxstatus']), 2147483647, '/');
					
				} else {
					setcookie('search_chkboxstatus', '', 2147483647, '/');
					setcookie('show_limit', serialize($_POST['show_limit']), 2147483647, '/');
				}
			} elseif (!isset($search_array['search_chkboxstatus']) && isset($_COOKIE['search_chkboxstatus'])) {
				$search_array['search_status'] = unserialize($_COOKIE['search_chkboxstatus']);
				
			}
			
			$show = $this->_getParam('show', '');
			if($show != ""){
				setcookie('show_limit', $show, 2147483647, '/');
			}else{
			   $show =  $_COOKIE['show_limit'];
			}       
	
			if(unserialize($show)){
				$show =  unserialize($show);
			}
			//if(!is_int($show) || $show==""){
			if($show==""){
				$show = 25;
			}
	
			
			$category_name = $this->_getParam('category_name', '');
			if ($category_name != '') {
				$search_array['category_name'] = addslashes($category_name);
				$this->view->category_name = $category_name;
			}
	
			$tenant_name = $this->_getParam('tenant_name', '');
			if ($tenant_name != '') {
				$search_array['tenant_name'] = addslashes($tenant_name);
				$this->view->tenant_name = $tenant_name;
			}
	
			$search_wo = $this->_getParam('search_wo', '');
			if ($search_wo != '') {
				$search_array['search_wo'] = $search_wo;
				$this->view->search_wo = $search_wo;
			}
	
			$from_date = $this->_getParam('from_date', '');
			if ($from_date != '') {
				$search_array['from_date'] = date("Y-m-d", strtotime($from_date));
				$this->view->from_date = date("Y-m-d", strtotime($from_date));
			}
	
			$to_date = $this->_getParam('to_date', '');
			if ($to_date != '') {
				$search_array['to_date'] = date("Y-m-d", strtotime($to_date));
				$this->view->to_date = date("Y-m-d", strtotime($to_date));
			}
	
	
			if ($companyListing != '') {
	
	
				/* if($this->roleId=='9'){ */
				if ($build_ID == '') {
					
					$buildIds = array();
					foreach ($companyListing as $cl) {
						$buildIds[] = $cl['build_id'];
					}
				   $wolist = $woModel->getWorkOrderByBuilIds($buildIds, $order, $dir, $search_array,$page, $show);
				   $wolistcount = $woModel->getWorkOrderByBuilIdsNew($buildIds, $order, $dir, $search_array);
				} else {
					$wolist = $woModel->getBuildingWorkOrder($build_ID, $order, $dir, $search_array,$page, $show);
				  $wolistcount = $woModel->getBuildingWorkOrderNew($build_ID, $order, $dir, $search_array);
				}
				
			
			}
			// from here
			$total_rows = $wolistcount;
			$no_of_records_per_page = $show;
			$total_pages = ceil($total_rows / $no_of_records_per_page);
			 
			$this->view->total_pages = $total_pages;
			$this->view->pageno = $page;
			$this->view->records = sizeof($wolist);
			
			
			$pageObj = new Ve_Paginator();
			//$paginator = $pageObj->fetchPageDataResult($wolist, $page, $show);
			$paginatorNew = $pageObj->fetchPageDataResultNew($wolist, $wolistcount, $page, $show);
			//$lastactivity = $woModel->get_last_activity();
			$this->view->page = $page;
			$view_type = $this->_getParam('view_type', 'line');
			$this->view->custID = $this->cust_id;
			$this->view->companyListing = $companyListing;
			$this->view->select_build_id = $build_ID;
			$this->view->wolist = $paginatorNew;//$paginator;
			$this->view->order = $order;
			$this->view->dir = $dir;
			$this->view->view_type = $view_type;
			$this->view->roleId = $this->roleId;
			$this->view->acessHelper = $this->accessHelper;
			$this->view->dline_location = $this->dline_location;
			$this->view->ddetail_location = $this->ddetail_location;
			$this->view->createnew_location = $this->createnew_location;
			$this->view->closewo_location = $this->closewo_location;
			$this->view->userId = $this->userId;
			// refresh outo load  
			$getsult = $this->gettotalAction();       
			$this->view->count = $getsult;
			$this->view->show = $show;
			if (isset($_REQUEST['submitform'])) {
				if (isset($_POST['search_chkboxstatus']) && $_POST['search_chkboxstatus'] != '') {
					$this->view->statusCookieDetails = $_POST['search_chkboxstatus'];
				}
			} else {
	
				$statusCookie = new Zend_Controller_Request_Http();
				$statusCookieDetails = $statusCookie->getCookie('search_chkboxstatus');
				$statusCookieDetails = unserialize($statusCookieDetails);
				if ($statusCookieDetails != '') {
					$this->view->statusCookieDetails = $statusCookieDetails;
				}
			}
			$adminNamespace = new Zend_Session_Namespace('Admin_User');
			$this->view->admin_role_id = $adminNamespace->role_id;
	
	 
	
	
			 if($this->roleId=='5' || $this->roleId=='7'){
			
				$tenantDefualtbuildinglists = $buildinglists;
	
				$tId = $this->_getParam('tid');
				if(isset($tId) && !empty($tId)){
					$set_cookie = setcookie('tenant_company', $tId, time() + (86400 / 24), "/");
				}
				$tenant = new Model_Tenant();
				$tId  = $_COOKIE['tenant_company'];
			if ($tId){				
				$tenantCompanyList = $tenant->getTenantCompanies($this->userId);     
				$tenantuser = $tenant->getTenanyUserByTenantGroup($tId);
	
				
				$this->view->tId = $tId;				
				$this->view->tenantGroupListArr = $tenantCompanyList;
			}		
			else
			$tenantuser = $tenant->getTenantByUser($this->userId);
	
			 $tenantData = $tenant->getTenantByUser($this->userId);
			 $tenantInfo = $tenantData[0];
			 $page=$this->_getParam('page',1);
			 $order=$this->_getParam('order','woId');
			 $dir=$this->_getParam('dir','DESC');
			 
			 //for tanant Admin
			 $userId = $this->userId;	
			 if($this->roleId=='5'){	
			   $search_array['userId'] = $userId;
	 
				$wolist = $woModel->getWorkOrderByBuilIds($buildIds, $order, $dir, $search_array,$page, $show);
				$wolistcount = $woModel->getWorkOrderByBuilIdsNew($buildIds, $order, $dir, $search_array);
			 }else if($this->roleId=='7'){		
					
				if (isset($tId)){	
						// echo $userId;
					$wolist = $this->woMapper->getTenantUserWorkOrder($tId,$order,$dir,$userId,$search_array);	
					
				}else{				
					$wolist = $this->woMapper->getTenantUserWorkOrder($tenantInfo->tenantId,$order,$dir,$userId,$search_array);
				}
			   
			 }		
			//  if($this->roleId=='7')		 
			//  $wolist = $this->woMapper->getTenantWorkOrder($tenantInfo->tenantId,$order,$dir,$this->userId);
			//  else
			//  $wolist = $this->woMapper->getTenantWorkOrder($tenantInfo->tenantId,$order,$dir);
			 $pageObj=new Ve_Paginator();
			 $paginator=$pageObj->fetchPageDataResult($wolist,$page,$show);		 
			 $this->view->page = $page;
			 $this->view->roleId = $this->roleId;
			 //$this->view->tenantuser = $tenantuser[0];
			 $this->view->wolist = $paginator;
			 $this->view->order = $order;
			 $this->view->dir = $dir;
	
			 
			 $this->tenantDefualtbuildinglists = $tenantDefualtbuildinglists;
			 }
		   $this->view->roleId = $this->roleId;
		 }
		
}

?>
