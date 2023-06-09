<?php
/**
 * Conference Module
 * 
 * 
 * @package    Zend
 * @subpackage Controller
 * @author     Gurubaksh Singh
 */
//error_reporting(0);

class ConferenceController extends Ve_Controller_Base {

    private $userId = '';
    private $roleId = '';

    public function init() {
        parent::init();
        $this->_helper->layout()->setLayout('newlayout');
        $this->accessHelper = $this->_helper->access;
        $this->dist_location = 14;
        $this->etemplate_location = 21;
    }

    // Call befor any action and check is user login or not
    public function preDispatch() {
        if (!Zend_Auth::getInstance()->hasIdentity())
            $this->_redirect('/index');
        $level = (Zend_Auth::getInstance()->getStorage()->read()) ? Zend_Auth::getInstance()->getStorage()->read()->role_id : '';
        $this->userId = Zend_Auth::getInstance()->getStorage()->read()->uid;
        $this->roleId = Zend_Auth::getInstance()->getStorage()->read()->role_id;
        $this->cust_id = Zend_Auth::getInstance()->getStorage()->read()->cust_id;
        $this->croom_page = 15;
        $this->cschedule_page = 15;
    }

    public function indexAction() {
        
    }

    public function conavailabilityAction() {
        $companyListing = '';
        $buildingMapper = new Model_Building();
        if ($this->roleId == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
            if ($buildinglists) {
                $build_id_array = array();
                foreach ($buildinglists as $buildlist)
                    $build_id_array[] = $buildlist['building_id'];
                $companyListing = $buildingMapper->getBuildingList($build_id_array);
            }
        }
        foreach ($companyListing as $cl) {
            $buildIds[] = $cl['build_id'];
        }

        $build_ID = $this->_getParam('bid', '');
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds)))
            $build_ID = $_COOKIE['build_cookie'];
        else
            $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");

        if ($companyListing != '') {
            if ($build_ID != '')
                $select_build_id = $build_ID;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }
        $user_id=$_SESSION['Zend_Auth']['storage']->uid;
        $final=$this->getViewAccess($select_build_id);
        $this->view->userId=$user_id;
        $this->view->viewacess=$final;
        $this->view->companyListing = $companyListing;
        $this->view->custID = $this->cust_id;
        $this->view->select_build_id = $select_build_id;
        $this->view->roleId = $this->roleId;
        $this->view->acessHelper = $this->accessHelper;
        $this->view->croom_location = 24;
        $this->view->month = date('m', strtotime('last Sunday'));
        $this->view->lastdate = date('d', strtotime('last Sunday'));
        
    }

    public function conavailabilitydemoAction() {
        $companyListing = '';
        $buildingMapper = new Model_Building();
        if ($this->roleId == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
            if ($buildinglists) {
                $build_id_array = array();
                foreach ($buildinglists as $buildlist)
                    $build_id_array[] = $buildlist['building_id'];
                $companyListing = $buildingMapper->getBuildingList($build_id_array);
            }
        }
        foreach ($companyListing as $cl) {
            $buildIds[] = $cl['build_id'];
        }

        $build_ID = $this->_getParam('bid', '');
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds)))
            $build_ID = $_COOKIE['build_cookie'];
        else
            $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");

        if ($companyListing != '') {
            if ($build_ID != '')
                $select_build_id = $build_ID;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }
        $user_id=$_SESSION['Zend_Auth']['storage']->uid;
        $final=$this->getViewAccess($select_build_id);
        $this->view->userId=$user_id;
        $this->view->viewacess=$final;
        $this->view->companyListing = $companyListing;
        $this->view->custID = $this->cust_id;
        $this->view->select_build_id = $select_build_id;
        $this->view->roleId = $this->roleId;
        $this->view->acessHelper = $this->accessHelper;
        $this->view->croom_location = 24;
        $this->view->month = date('m', strtotime('last Sunday'));
        $this->view->lastdate = date('d', strtotime('last Sunday'));
        
    }
    public function getViewAccess($bid){
        
        $checkscheduler = new Model_ConferenceSchedule();
        $getscheduler=$checkscheduler->getcrDetailsByBid($bid);

        foreach($getscheduler as $da){
            $getcs=$checkscheduler->getCrdata($da->schedule_id);
            $data[]=$this->getshowday($getcs[0]->week_days_id);
        }
        foreach($data as $get){
            foreach ($get as $get){
                $final[$get]=$get;
            }
        }
        return $final;
    }

        public function getshowday($id){
        
        switch($id){
            case 1:
               $ids=array(0,1,2,3,4,5,6);
               break;
            case 2:
               $ids=array(1,2,3,4,5);
               break;            
           case 3:
               $ids=array(0,6);
               break;            
           case 4:
               $ids=array(1,3,5);
               break;            
           case 5:
               $ids=array(2,4);
               break;            
           case 6:
               $ids=array(1);
               break;                    
          case 7:
               $ids=array(2);
               break;                    
           case 8:
               $ids=array(3);
               break;                    
           case 9:
               $ids=array(4);
               break;                    
           case 10:
               $ids=array(5);
               break;                    
           case 11:
               $ids=array(6);
               break;                    
           case 12:
               $ids=array(0);
               break;                  
            
        }
        return $ids;
    }
    
    public function croomsetupAction() {
        $companyListing = '';
        $buildingMapper = new Model_Building();
        if ($this->roleId == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
            if ($buildinglists) {
                $build_id_array = array();
                foreach ($buildinglists as $buildlist)
                    $build_id_array[] = $buildlist['building_id'];
                $companyListing = $buildingMapper->getBuildingList($build_id_array);
            }
        }
        foreach ($companyListing as $cl) {
            $buildIds[] = $cl['build_id'];
        }
        $build_ID = $this->_getParam('bid', '');
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds)))
            $build_ID = $_COOKIE['build_cookie'];
        else
            $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");

        if ($companyListing != '') {
            if ($build_ID != '')
                $select_build_id = $build_ID;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }
        $cscheduleMapper = new Model_ConferenceSchedule();
        $crDetails = $cscheduleMapper->getcrDetailsByBid($select_build_id);
        $cscheduleDetails = $cscheduleMapper->getCScheduleByBid($select_build_id);
        $week_days = new Model_WeekDays();
        $page = $this->_getParam('page', 1);
        $pageObj = new Ve_Paginator();
        $paginator_croom = $pageObj->fetchPageDataResult($crDetails, $page, $this->croom_page);
        $paginator_cschedule = $pageObj->fetchPageDataResult($cscheduleDetails, $page, $this->cschedule_page);
        $this->view->days_of_the_week = $week_days->getWeekDays();
        $this->view->companyListing = $companyListing;
        $this->view->custID = $this->cust_id;
        $this->view->select_build_id = $select_build_id;
        $this->view->cscheduleDetails = $paginator_cschedule;
        $this->view->crDetails = $paginator_croom;
        $this->view->roleId = $this->roleId;
        $this->view->acessHelper = $this->accessHelper;
        $this->view->croom_location = 25;
    }

    public function showcroomlistAction() {
        $param = $this->getRequest()->getParams();
        if (isset($param['buildingId'])) {
            /*             * ***  fetch Conference Room ***** */
            $search_array = array();
            $page = isset($param['page']) ? $param['page'] : 1;
            $search_by = $param['search_by'];
            $search_value = $param['search_value'];
            $search_array[$search_by] = $search_value;
            $pageObj = new Ve_Paginator();
            $buildId = $param['buildingId'];
            $cscheduleMapper = new Model_ConferenceSchedule();
            $crDetails = $cscheduleMapper->getcrDetailsByBid($buildId, $search_array);
            $crdetails_paginator = $pageObj->fetchPageDataResult($crDetails, $page, $this->croom_page);
            $conference_template = new Zend_View();
            $conference_template->setScriptPath(APPLICATION_PATH . '/modules/default/views/scripts/conference/');
            $conference_template->assign('crDetails', $crdetails_paginator);
            $conference_template->assign('page', $page);
            $conference_template->assign('select_build_id', $buildId);
            $conference_template->assign('roleId', $this->roleId);
            $conference_template->assign('userId', $this->userId);
            $conference_template->assign('acessHelper', $this->accessHelper);
            $conference_template->assign('croom_location', 25);

            $bodyText = $conference_template->render('croom_list.phtml');

            $paging_html = '';
            if (count($crDetails) > 0 && !empty($crDetails)) {
                $paging_html .= '<tr><td colspan="5">';
                $paging_html .= Zend_View_Helper_PaginationControl::paginationControl($crdetails_paginator, 'Sliding', 'croom_pagination.phtml');
                $paging_html .= '</td></tr>';
            }else{
                $paging_html .= '<tr><td colspan="5">';
                $paging_html .= "No record found";
                $paging_html .= '</td></tr>';
            }
            //echo $bodyText;
            $bodyText = $bodyText . '' . $paging_html;
            $data = array('status' => 'success', 'content' => $bodyText);
            echo json_encode($data);
            exit;
        }
        exit(0);
    }

    public function conflistAction() {
        
        $companyListing = '';
        $buildingMapper = new Model_Building();
        if ($this->roleId == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
            if ($buildinglists) {
                $build_id_array = array();
                foreach ($buildinglists as $buildlist)
                    $build_id_array[] = $buildlist['building_id'];
                $companyListing = $buildingMapper->getBuildingList($build_id_array);
            }
        }
        foreach ($companyListing as $cl) {
            $buildIds[] = $cl['build_id'];
        }

        $build_ID = $this->_getParam('bid', '');
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds)))
            $build_ID = $_COOKIE['build_cookie'];
        else
            $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");

        if ($companyListing != '') {
            if ($build_ID != '')
                $select_build_id = $build_ID;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }
        $this->view->companyListing=$companyListing;
        $this->view->select_build_id=$select_build_id;
        
        
        $msgId = $this->_getParam('msg', 0);
        $page = $this->_getParam('page', 1);
        //var_dump($this->_getParams());
        $msg = '';
        if ($msgId == 1) {
            $msg = 'Email template save successfully.';
        }

        if ($msgId == 2) {
            $msg = 'Error occurred.';
        }

        if ($msgId == 3) {
            $msg = 'Bad request.';
        }

        if ($msgId == 4) {
            $msg = 'Email template deleted successfully.';
        }

        $em = new Zend_Session_Namespace('etemp_message');
        if (!isset($em->msg)) {
            $em->msg = $msg;
            if (isset($page) && $page != 1)
                $this->_redirect('/conference/conflist/page/' . $page);
            else
                $this->_redirect('/conference/conflist');
        }
       
        $emailModel = new Model_Email();
        $eid = '';
       //echo $this->Buil
        $emailData = $emailModel->loadEmailTemplate($eid, "", 9, $select_build_id);
       
        $pageObj = new Ve_Paginator();
        $paginator = $pageObj->fetchPageDataResult($emailData, $page, 15);
         
        $this->view->emailData = $paginator;
        $this->view->roleId = $this->roleId;
        $this->view->userId = $this->userId;
        $this->view->acessHelper = $this->accessHelper;
        $this->view->etemplate_location = $this->etemplate_location;
        
    }

    public function contempcreate() {
        /*$roleMapper = new Model_Role();
        $roleDetail = $roleMapper->getRole();
        $this->view->roleDetails = $roleDetail;
        $this->view->roleId = $this->roleId;
        $this->view->userId = $this->userId;
        $this->view->acessHelper = $this->accessHelper;
        $this->view->etemplate_location = $this->etemplate_location;
         */
    }

    public function vetempAction() {
        $data = $this->_request->getPost();
        $build_ID = $data['bid'];
        $type = $data['type'];
        /* Check Email Template Test Verifycat */
        $emailModel = new Model_Email();
        $getvalidation = $emailModel->emailtemplateChecker($build_ID, 9, $type);
        //print_r($getvalidation);
        $msg =array();
        if(!empty($getvalidation)){
            $msg['status'] ="fail";
            $msg['msg'] = "Only one custom template allowed, please edit existing template";
            
        }else{
            $msg['status'] ="sucess";
            $msg['msg'] = "";
        }
    echo json_encode($msg);
    exit();
    }
    
    public function contempcreateAction() {
        $roleMapper = new Model_Role();
        $roleDetail = $roleMapper->getRole();
        $build_ID = $this->_getParam('bid', '');
        $type = $this->_getParam('type', '');
        
        if(!empty($type)){
           $this->view->type=$type;
        }else{
            $this->view->type="";
        }
        $this->view->build_ID=$build_ID;
        $this->view->roleDetails = $roleDetail;
        $this->view->roleId = $this->roleId;
        $this->view->userId = $this->userId;
        $this->view->acessHelper = $this->accessHelper;
        $this->view->etemplate_location = $this->etemplate_location;
    }
        

    public function showcschedulelistAction() {
        $param = $this->getRequest()->getParams();
        if (isset($param['buildingId'])) {
            /*             * ***  fetch building priority ***** */
            $search_array = array();
            $page = isset($param['page']) ? $param['page'] : 1;
            $search_by = $param['search_by'];
            $search_value = $param['search_value'];
            $search_array[$search_by] = $search_value;
            $pageObj = new Ve_Paginator();
            $buildId = $param['buildingId'];
            $cscheduleMapper = new Model_ConferenceSchedule();
            $cscheduleDetails = $cscheduleMapper->getCScheduleByBid($buildId, $search_array);
            $cschedule_paginator = $pageObj->fetchPageDataResult($cscheduleDetails, $page, $this->cschedule_page);
            $conference_template = new Zend_View();
            $conference_template->setScriptPath(APPLICATION_PATH . '/modules/default/views/scripts/conference/');

            $conference_template->assign('cscheduleDetails', $cschedule_paginator);
            $conference_template->assign('page', $page);
            $conference_template->assign('select_build_id', $buildId);
            $conference_template->assign('roleId', $this->roleId);
            $conference_template->assign('userId', $this->userId);
            $conference_template->assign('acessHelper', $this->accessHelper);
            $conference_template->assign('croom_location', 25);
            $bodyText = $conference_template->render('cschedule_list.phtml');

            $paging_html = '';
            if (count($cscheduleDetails) > 0 && !empty($cscheduleDetails)) {
                $paging_html .= '<tr><td colspan="5">';
                $paging_html .= Zend_View_Helper_PaginationControl::paginationControl($cschedule_paginator, 'Sliding', 'cschedule_pagination.phtml');
                $paging_html .= '</td></tr>';
            }else{
                $paging_html .= '<tr><td colspan="5">';
                $paging_html .= "No record found! ";
                $paging_html .= '</td></tr>';
            }
            //echo $bodyText;
            $bodyText = $bodyText . '' . $paging_html;
            $data = array('status' => 'success', 'content' => $bodyText);
            echo json_encode($data);
            exit;
        }
        exit(0);
    }

    public function consetupAction() {
        echo 'aaaa';
        exit(0);
    }

    public function cemailnotificationAction() {
        echo 'aaaa';
        exit(0);
    }

    public function createconroomAction() {

        $this->_helper->layout()->setLayout('popuplayout');
        $build_ID = $this->_getParam('bid', '');
        $cscheduleMapper = new Model_ConferenceSchedule();
        $cscheduleDetails = $cscheduleMapper->getCScheduleByBid($build_ID, array(), 1);
        $cPlan = $cscheduleMapper->getCPlan();
        $this->view->cscheduleDetails = $cscheduleDetails;
        $this->view->cPlan = $cPlan;
        $this->view->bid = $build_ID;
    }

    public function addfileAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();


        if (!empty($data['bId'])) {
            $this->view->bId = $data['bId'];
        } else {
            $this->view->room_id = $data['room_id'];
            $this->view->name = htmlentities($data['name']);
            $this->view->url = $data['url'];
        }
    }

    public function savecroomAction() {
        $this->_helper->layout()->disableLayout();
        $msgArray = array();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['room_name'] != '' && $data['location'] != '' && $data['status'] != '' && $data['schedule_id'] != '') {

                $cscheduleMapper = new Model_ConferenceSchedule();
                $crdata['room_name'] = htmlentities($data['room_name']);
                $crdata['status'] = $data['status'];
                $insert_id = $cscheduleMapper->insertcrData($crdata);
                $crAccess['room_id'] = $insert_id;
                $crAccess['location'] = htmlentities($data['location']);
                $crAccess['building_id'] = $data['building_id'];
                $crAccess['schedule_id'] = $data['schedule_id'];
                $crAccess['tenant_admin'] = $data['tenant_admin'];
                $crAccess['tenant_user'] = $data['tenant_user'];
                $crAccess['auto_billing'] = $data['auto_billing'];
                $crAccess['recurrence_building_user'] = $data['recurrence_building_user'];
                $crAccess['recurrence_tenant_admin'] = $data['recurrence_tenant_admin'];
                $crAccess['recurrence_tenant_user'] = $data['recurrence_tenant_user'];
                $access_insert_id = $cscheduleMapper->insertcrAccess($crAccess);
                $userMapper = new Model_User();
                $userData = $userMapper->getAllAccountUserOfBuilding($data['building_id']);
                $user_id = array();
                foreach ($userData as $userDataVal) {
                    $user_id[] = $userDataVal->uid;
                }
                $conferenceData['building_id'] = $data['building_id'];
                $conferenceData['userId'] = $this->userId;
                $conferenceData['room_name'] = $data['room_name'];
                $conferenceData['room_title'] = $data['room_name'];
                //$cscheduleMapper->sendConferenceEmail(implode(",", $user_id), $conferenceData);
                $crrateSch = json_decode($data['rate_sch']);
                foreach ($crrateSch as $crrateVal) {
                    $crrateData['plan'] = $crrateVal->plan;
                    $crrateData['cost'] = $crrateVal->cost;
                    $crrateData['min'] = $crrateVal->min;
                    $crrateData['max'] = $crrateVal->max;
                    $crrateData['room_id'] = $insert_id;
                    $rate_insert_id = $cscheduleMapper->insertcrRateSch($crrateData);
                }

                if (isset($_FILES['file']) && !empty($_FILES)) {
                    foreach ($_FILES['file']['name'] as $key => $file_name) {
                        $filetype = array("application/pdf", "image/jpg", "image/jpeg", "image/png");

                        if ($_FILES['file']['size'][$key] < 5242880 || in_array($_FILES['file']['size'][$key], $filetype)) {
                            $uploaddir = BASE_PATH . 'public/conference_room/';
                            $uploadfile_name = 'cr-' . time() . '-' . basename($file_name);
                            $uploadfile = $uploaddir . '' . $uploadfile_name;
                            if (!file_exists($uploaddir)) {
                                mkdir($uploaddir, 0777, true);
                            }
                            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $uploadfile);
                            $file_name = $uploadfile_name;
                            $insertFData = array();
                            $insertFData['room_id'] = $insert_id;
                            $insertFData['design_name'] = htmlentities(urldecode($key));
                            $insertFData['attachment'] = $file_name;
                            $rate_insert_id = $cscheduleMapper->insertcrLayout($insertFData);
                        } else {
                            $msgArray['status'] = 'error';
                            $msgArray['msg'] = 'Form is not properly filled.';
                        }
                    }
                }
                $msgArray['status'] = 'success';
                $msgArray['msg'] = 'Conference Room Added successfully.';
            } else {
                $msgArray['status'] = 'error';
                $msgArray['msg'] = 'Form is not properly filled.';
            }
        }
        echo json_encode($msgArray);
        exit();
    }

    public function createconmultiroomAction() {
        $this->_helper->layout()->setLayout('popuplayout');
        $build_ID = $this->_getParam('bid', '');
        $cscheduleMapper = new Model_ConferenceSchedule();
        $cscheduleDetails = $cscheduleMapper->getCScheduleByBid($build_ID, array(), 1);
        $crDetails = $cscheduleMapper->getcrDetailsByBid($build_ID, array(), 1);
        $cPlan = $cscheduleMapper->getCPlan();
        $this->view->cscheduleDetails = $cscheduleDetails;
        $this->view->cPlan = $cPlan;
        $this->view->bid = $build_ID;
        //$this->view->crDetails = $crDetails;
    }
    
    public function multiroomselectedAction(){
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if($data['action']=='add'){           
                $cscheduleMapper = new Model_ConferenceSchedule();
                $cscheduleDetails = $cscheduleMapper->getCroomById($data['sid']);
                $this->view->crDetails = $cscheduleDetails;
                $this->view->action = $data['action'];
            }else{
                $cscheduleMapper = new Model_ConferenceSchedule();            
                $cscheduleDetails = $cscheduleMapper->getCroomById($data['sid']);
                $this->view->crDetails = $cscheduleDetails;
                $this->view->action = $data['action'];
            }
        }
        
    }

    public function addnewscheduleAction() {
        $this->_helper->layout()->setLayout('popuplayout');
        $build_ID = $this->_getParam('bid', '');
        $week_days = new Model_WeekDays();
        $this->view->days_of_the_week = $week_days->getWeekDays();
        $this->view->building_id = $build_ID;
    }

    public function editcscheduleAction() {
        $this->_helper->layout()->setLayout('popuplayout');
        $build_ID = $this->_getParam('bid', '');
        $sid = $this->_getParam('sid', '');
        $cscheduleMapper = new Model_ConferenceSchedule();
        $scheduleDetails = $cscheduleMapper->getCScheduleBySid($sid);
        $week_days = new Model_WeekDays();
        $this->view->days_of_the_week = $week_days->getWeekDays();
        $this->view->building_id = $build_ID;
        $this->view->sid = $sid;
        $this->view->scheduleDetails = $scheduleDetails[0];
    }

    public function savenewscheduleAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $message = array();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            $sid = $data['sid'];
            unset($data['sid']);
            $cscheduleMapper = new Model_ConferenceSchedule();
            if ($sid == '') {
                try {
                    $result = $cscheduleMapper->insertCSchedule($data);
                    $message['status'] = 'success';
                    $message['msg'] = 'New schedule created successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error Occurred during the create new schedule';
                }
            } else {
                try {
                    $result = $cscheduleMapper->updateCSchedule($data, $sid);
                    $message['status'] = 'success';
                    $message['msg'] = 'Schedule updated successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error Occurred during the update schedule';
                }
            }
        }
        echo json_encode($message);
        exit(0);
    }

    public function deletecscheduleAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['sid'] != '') {
                try {
                    $cscheduleMapper = new Model_ConferenceSchedule();
                    $deleteRate = $cscheduleMapper->deleteCSchedule($data['sid']);
                    $message['status'] = 'success';
                    $message['msg'] = 'Schedule deleted successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error Occurred during the delete schedule';
                }
            }
        }
        echo json_encode($message);
        exit(0);
    }

    public function editconroomAction() {
        $this->_helper->layout()->setLayout('popuplayout');
        $croom_ID = $this->_getParam('cid', '');
        $build_ID = $this->_getParam('bid', '');
        $cscheduleMapper = new Model_ConferenceSchedule();
        $cscheduleDetails = $cscheduleMapper->getCScheduleByBid($build_ID, array(), 1);
        $crDetails = $cscheduleMapper->getcrDetails($croom_ID);
        $cPlan = $cscheduleMapper->getCPlan();
        $this->view->cscheduleDetails = $cscheduleDetails;
        $this->view->cPlan = $cPlan;
        $this->view->bid = $croom_ID;
        $this->view->crDetails = $crDetails;
        $this->view->build_id = $build_ID;
    }

    public function updatecroomAction() {
        //print_r($this->_request->getPost());
        //print_r($this->_request->getPost());
        //$data = $this->_request->getPost();
        $this->_helper->layout()->disableLayout();
        $msgArray = array();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['room_name'] != '' && $data['location'] != '' && $data['status'] != '' && $data['schedule_id'] != '') {
                $cscheduleMapper = new Model_ConferenceSchedule();
                $cid = $data['cid'];
                $crdata['room_name'] =htmlentities($data['room_name']);
                $crdata['status'] = $data['status'];
                $cscheduleMapper->updatecrData($crdata, $cid);
                $crAccess['room_id'] = $cid;
                $crAccess['location'] = htmlentities($data['location']);
                $crAccess['schedule_id'] = $data['schedule_id'];
                $crAccess['tenant_admin'] = $data['tenant_admin'];
                $crAccess['tenant_user'] = $data['tenant_user'];
                $crAccess['auto_billing'] = $data['auto_billing'];
                $crAccess['recurrence_building_user'] = $data['recurrence_building_user'];
                $crAccess['recurrence_tenant_admin'] = $data['recurrence_tenant_admin'];
                $crAccess['recurrence_tenant_user'] = $data['recurrence_tenant_user'];
                $access_insert_id = $cscheduleMapper->updatecrAccess($crAccess, $cid);

                $crrateSch = json_decode($data['rate_sch']);
                if(!empty($crrateSch))
                    $rate_insert_id = $cscheduleMapper->deletecrRateSch($cid);
                foreach ($crrateSch as $crrateVal) {
                    $crrateData['plan'] = $crrateVal->plan;
                    $crrateData['cost'] = $crrateVal->cost;
                    $crrateData['min'] = $crrateVal->min;
                    $crrateData['max'] = $crrateVal->max;
                    $crrateData['room_id'] = $cid;
                    $rate_insert_id = $cscheduleMapper->insertcrRateSch($crrateData);
                }
                if ($data['delete_id'] != '') {
                    $delete_id = rtrim($data['delete_id'], ',');

                    $cscheduleMapper->deleteAttachment($delete_id);
                }

                if (isset($_FILES['file']) && !empty($_FILES)) {
                    foreach ($_FILES['file']['name'] as $key => $file_name) {
                        $filetype = array("application/pdf", "image/jpg", "image/jpeg", "image/png");

                        if ($_FILES['file']['size'][$key] < 5242880 || in_array($_FILES['file']['size'][$key], $filetype)) {
                            $uploaddir = BASE_PATH . 'public/conference_room/';
                            $uploadfile_name = 'cr-' . time() . '-' . basename($file_name);
                            $uploadfile = $uploaddir . '' . $uploadfile_name;
                            if (!file_exists($uploaddir)) {
                                mkdir($uploaddir, 0777, true);
                            }
                            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $uploadfile);
                            $file_name = $uploadfile_name;
                            if (is_int($key)){
                                $updateFData = array();
                                $updateFData['room_id'] = $cid;
                                if (!empty($file_name)) {
                                    $updateFData['attachment'] = $file_name;
                                }
                                $d_id = $key;                                
                                if (!empty($data[$key]))
                                    $updateFData['design_name'] = htmlentities(urldecode($data[$key]));
                                $rate_insert_id = $cscheduleMapper->updatedsgAccess($updateFData, $d_id);
                            }else {
                                $insertFData = array();
                                $insertFData['room_id'] = $cid;
                                $insertFData['design_name'] = htmlentities(urldecode($key));
                                $insertFData['attachment'] = $file_name;
                                $rate_insert_id = $cscheduleMapper->insertcrLayout($insertFData);
                            }
                        } else {
                            $msgArray['status'] = 'error';
                            $msgArray['msg'] = 'Form is not properly filled.';
                        }
                    }
                }

                if (!empty($data['file'])) {
                    foreach ($data['file'] as $key => $val) {
                        $updateFData = array();
                        $d_id = $key;
                        $updateFData['design_name'] = htmlentities(urldecode($val));
                        $rate_insert_id = $cscheduleMapper->updatedsgAccess($updateFData, $d_id);
                    }
                }
    
                $msgArray['status'] = 'success';
                $msgArray['msg'] = 'Conference Room Edit successfully.';
            } else {
                $msgArray['status'] = 'error';
                $msgArray['msg'] = 'Form is not properly filled.';
            }
        }
        echo json_encode($msgArray);
        exit();
    }

    public function updatecmultiroomAction() {
        $this->_helper->layout()->disableLayout();
        $msgArray = array();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['room_name'] != '' && $data['location'] != '' && $data['status'] != '' && $data['schedule_id'] != '') {
                $cscheduleMapper = new Model_ConferenceSchedule();
                $cid = $data['cid'];
                $crdata['room_name'] = htmlentities($data['room_name']);
                $crdata['status'] = $data['status'];
                $cscheduleMapper->updatecrData($crdata, $cid);
                $crAccess['room_id'] = $cid;
                $crAccess['location'] = htmlentities($data['location']);
                $crAccess['schedule_id'] = $data['schedule_id'];
                $crAccess['tenant_admin'] = $data['tenant_admin'];
                $crAccess['tenant_user'] = $data['tenant_user'];
                $crAccess['recurrence_building_user'] = $data['recurrence_building_user'];
                $crAccess['recurrence_tenant_admin'] = $data['recurrence_tenant_admin'];
                $crAccess['recurrence_tenant_user'] = $data['recurrence_tenant_user'];
                $crAccess['auto_billing'] = $data['auto_billing'];
                $croom_to_list = json_decode($data['croom_to_list']);
                $crAccess['multi_id'] = implode(",", $croom_to_list);
                $access_insert_id = $cscheduleMapper->updatecrAccess($crAccess, $cid);
                
                $crrateSch = json_decode($data['rate_sch']);
                if(!empty($crrateSch)){
                    $rate_insert_id = $cscheduleMapper->deletecrRateSch($cid);
                    foreach ($crrateSch as $crrateVal) {
                        $crrateData['plan'] = $crrateVal->plan;
                        $crrateData['cost'] = $crrateVal->cost;
                        $crrateData['min'] = $crrateVal->min;
                        $crrateData['max'] = $crrateVal->max;
                        $crrateData['room_id'] = $cid;
                        $rate_insert_id = $cscheduleMapper->insertcrRateSch($crrateData, $cid);
                    }
                }
                if ($data['delete_id'] != '') {
                    $delete_id = rtrim($data['delete_id'], ',');

                    $cscheduleMapper->deleteAttachment($delete_id);
                }

                if (isset($_FILES['file']) && !empty($_FILES)) {
                    foreach ($_FILES['file']['name'] as $key => $file_name) {
                        $filetype = array("application/pdf", "image/jpg", "image/jpeg", "image/png");

                        if ($_FILES['file']['size'][$key] < 5242880 || in_array($_FILES['file']['size'][$key], $filetype)) {
                            $uploaddir = BASE_PATH . 'public/conference_room/';
                            $uploadfile_name = 'cr-' . time() . '-' . basename($file_name);
                            $uploadfile = $uploaddir . '' . $uploadfile_name;
                            if (!file_exists($uploaddir)) {
                                mkdir($uploaddir, 0777, true);
                            }
                            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $uploadfile);
                            $file_name = $uploadfile_name;
                            if (is_int($key)) {
                                $updateFData = array();
                                $updateFData['room_id'] = $cid;
                                if (!empty($file_name)) {
                                    $updateFData['attachment'] = $file_name;
                                }
                                $d_id = $key;                                
                                if (!empty($data[$key]))
                                    $updateFData['design_name'] = htmlentities(urldecode($data[$key]));
                                $rate_insert_id = $cscheduleMapper->updatedsgAccess($updateFData, $d_id);
                               
                            }else {
                                $insertFData = array();
                                $insertFData['room_id'] = $cid;
                                $insertFData['design_name'] = htmlentities(urldecode($key));
                                $insertFData['attachment'] = $file_name;
                                $rate_insert_id = $cscheduleMapper->insertcrLayout($insertFData);
                            }
                        } else {
                            $msgArray['status'] = 'error';
                            $msgArray['msg'] = 'Form is not properly filled.';
                        }
                    }
                }

                if (!empty($data['file'])) {
                    foreach ($data['file'] as $key => $val) {
                        $updateFData = array();
                        $d_id = $key;
                        $updateFData['design_name'] = htmlentities(urldecode($val));
                        $rate_insert_id = $cscheduleMapper->updatedsgAccess($updateFData, $d_id);
                    }
                }
                $msgArray['status'] = 'success';
                $msgArray['msg'] = 'Conference Room Added successfully.';
            } else {
                $msgArray['status'] = 'error';
                $msgArray['msg'] = 'Form is not properly filled.';
            }
        }
        echo json_encode($msgArray);
        exit();
    }

    public function deletecroomAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['cid'] != '') {
                try {
                    $cscheduleMapper = new Model_ConferenceSchedule();
                    $deleteRate = $cscheduleMapper->deleteCRoom($data['cid']);
                    $message['status'] = 'success';
                    $message['msg'] = 'Schedule deleted successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error Occurred during the delete schedule';
                }
            }
        }
        echo json_encode($message);
        exit(0);
    }
    
    public function deletecrroomAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['crid'] != '') {
                try {
                    $cscheduleMapper = new Model_ConferenceSchedule();
                    $bdetails=$cscheduleMapper->getcrbookDetails($data['crid']);
                    $data=$bdetails[0];
                    $tnuserModel = new Model_TenantUser();
                    $tuserdetails = $tnuserModel->getTenantUserById($data->created_user);
                    $tudetails=$tuserdetails[0];
                    
                    $tnuserModel = new Model_TenantUser();
                    $tuserdetailsnew = $tnuserModel->getTenantUsers($tudetails->tenantId);
                    
                    $tenant = new Model_Tenant();
                    $tenantuser = $tenant->getTenantByUid($data->created_user);
                    $tuser=$tenantuser[0];
                    
                    $crdetails=$cscheduleMapper->getcdDetails($data->croom_id); 
                    
                    $layoutDetails = $cscheduleMapper->check_id($data->design_id);
                    $design=$layoutDetails[0]->attachment;
                    $designName=$layoutDetails[0]->design_name;
                    
                    $conferenceData['email'] = $tudetails->email;
                    $conferenceData['phone'] =  $tudetails->phoneNumber;
                    $conferenceData['start_time'] = $data->start_time;
                    $conferenceData['end_time'] = $data->end_time;
                    $conferenceData['booking_date'] = date("F jS, Y",strtotime($data->requested_date));
                    $conferenceData['building_id'] = $data->building_id;
                    $conferenceData['tenant'] = $data->tenant;
                    $conferenceData['created_user'] = $data->created_user;                
                    $conferenceData['design'] = '<a href="'.BASEURL.'public/conference_room/'.$design.'">'.$designName.'</a>';                
                    $conferenceData['meeting_title'] = $data->meeting_title;                
                    $conferenceData['userId'] = $this->userId;  
                    $conferenceData['room_name'] = $crdetails[0]->room_name;
                    $conferenceData['room_title'] = $crdetails[0]->room_name;
                    
                    $email_group_model = new Model_EmailGroup();
                    $emailGroup = $email_group_model->get_email_group_by_building_id($data->building_id);
                    foreach($emailGroup as $ge){
                        if(strpos(trim($ge['group_name']),'ference')){
                            $emailgroupdata=$ge;
                        }
                    }
                    if(!empty($emailgroupdata)){
                        $gdata= $cscheduleMapper->getuserformail($emailgroupdata['id']);                    
                    }else{                    
                        $gdata= $cscheduleMapper->getuserformail($emailGroup[0]['id']);
                    }
 
                    foreach($tuserdetailsnew as $tuserid){
                        if($tuserid->cc_enable==0)
                            continue;
                        $user_id[]=$tuserid->uid;
                    }
                    foreach($gdata as $rs){
                        $user_id[]=$rs->user_id;
                    }
                    $user_id[]=$data->created_user;
                    if($_SESSION['Admin_User']['role_id']==7 || $_SESSION['Admin_User']['role_id']==5){
                        $user_id[]=$_SESSION['Admin_User']['user_id'];
                    }
                    //current tinant id 
                    //$user_id[]=$data'created_user'];
                    
                    //print_r($conferenceData);
                    //die;
                    $cscheduleMapper->sendConferenceEmail(implode(",", $user_id), $conferenceData,'delete');
                   // print_r($data);
                    if($data->booking_type!=""){
                        if($data->parent_id==0){
                            $crid = $cscheduleMapper->GetAllChieldBooking($data->crid);
                        }else{
                            $crid = $cscheduleMapper->GetAllupcommingbooking($data->parent_id,$data->end_date);
                        }
                    }else{
                        $deleteRate = $cscheduleMapper->deleteCrRoom($data->crid);
                    }
                    ///die;
                    
                    //$deleteRate = $cscheduleMapper->deleteCrRoom($data->crid);
                    $message['status'] = 'success';
                    $message['msg'] = 'Schedule deleted successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error Occurred during the delete schedule';
                }
            }
        }
        echo json_encode($message);
        exit(0);
    }
    
    

    public function savemulticroomAction() {
        $this->_helper->layout()->disableLayout();
        $msgArray = array();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['room_name'] != '' && $data['location'] && $data['status'] != '' && $data['schedule_id'] != '') {


                $cscheduleMapper = new Model_ConferenceSchedule();
                $crdata['room_name'] = htmlentities($data['room_name']);
                $crdata['status'] = $data['status'];
                $insert_id = $cscheduleMapper->insertcrData($crdata);
                $crAccess['room_id'] = $insert_id;
                $crAccess['building_id'] = $data['building_id'];
                $crAccess['schedule_id'] = $data['schedule_id'];
                $crAccess['tenant_admin'] = $data['tenant_admin'];
                $crAccess['tenant_user'] = $data['tenant_user'];
                $crAccess['recurrence_building_user'] = $data['recurrence_building_user'];
                $crAccess['recurrence_tenant_admin'] = $data['recurrence_tenant_admin'];
                $crAccess['recurrence_tenant_user'] = $data['recurrence_tenant_user'];
                $crAccess['auto_billing'] = $data['auto_billing'];
                $crAccess['location'] = htmlentities($data['location']);
                $crAccess['multi_mode'] = 1;
                $croom_to_list = json_decode($data['croom_to_list']);
                $crAccess['multi_id'] = implode(",", $croom_to_list);

                $access_insert_id = $cscheduleMapper->insertcrAccess($crAccess);

                $userMapper = new Model_User();
                $userData = $userMapper->getAllAccountUserOfBuilding($data['building_id']);
                $user_id = array();
                foreach ($userData as $userDataVal) {
                    $user_id[] = $userDataVal->uid;
                }
                $conferenceData['building_id'] = $data['building_id'];
                $conferenceData['userId'] = $this->userId;
                $conferenceData['room_name'] = $data['room_name'];
                $conferenceData['room_title'] = $data['room_name'];
                //$cscheduleMapper->sendConferenceEmail(implode(",", $user_id), $conferenceData);

                $crrateSch = json_decode($data['rate_sch']);
                foreach ($crrateSch as $crrateVal) {
                    $crrateData['plan'] = $crrateVal->plan;
                    $crrateData['cost'] = $crrateVal->cost;
                    $crrateData['min'] = $crrateVal->min;
                    $crrateData['max'] = $crrateVal->max;
                    $crrateData['room_id'] = $insert_id;
                    $rate_insert_id = $cscheduleMapper->insertcrRateSch($crrateData);
                }

                if (isset($_FILES['file']) && !empty($_FILES)) {
                    foreach ($_FILES['file']['name'] as $key => $file_name) {
                        $filetype = array("application/pdf",  "image/jpg", "image/jpeg", "image/png");

                        if ($_FILES['file']['size'][$key] < 5242880 || in_array($_FILES['file']['size'][$key], $filetype)) {
                            $uploaddir = BASE_PATH . 'public/conference_room/';
                            $uploadfile_name = 'cr-' . time() . '-' . basename($file_name);
                            $uploadfile = $uploaddir . '' . $uploadfile_name;
                            if (!file_exists($uploaddir)) {
                                mkdir($uploaddir, 0777, true);
                            }
                            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $uploadfile);
                            $file_name = $uploadfile_name;
                            $insertFData = array();
                            $insertFData['room_id'] = $insert_id;
                            $insertFData['design_name'] = htmlentities($key);
                            $insertFData['attachment'] = $file_name;
                            $rate_insert_id = $cscheduleMapper->insertcrLayout($insertFData);
                        } else {
                            $msgArray['status'] = 'error';
                            $msgArray['msg'] = 'Form is not properly filled.';
                        }
                    }
                }
                $msgArray['status'] = 'success';
                $msgArray['msg'] = 'Conference Room Added successfully.';
            } else {
                $msgArray['status'] = 'error';
                $msgArray['msg'] = 'Form is not properly filled.';
            }
        }
        echo json_encode($msgArray);
        exit();
    }

    public function editconmultiroomAction() {
        $this->_helper->layout()->setLayout('popuplayout');
        $croom_ID = $this->_getParam('cid', '');
        $build_ID = $this->_getParam('bid', '');
        $cscheduleMapper = new Model_ConferenceSchedule();
        $cscheduleDetails = $cscheduleMapper->getCScheduleByBid($build_ID, array(), 1);
        $crDetails = $cscheduleMapper->getcrDetailsByBid($build_ID, array(), 1);
        $creditDetails = $cscheduleMapper->getcrDetails($croom_ID);
        $cPlan = $cscheduleMapper->getCPlan();
        $this->view->cscheduleDetails = $cscheduleDetails;
        $this->view->cPlan = $cPlan;
        $this->view->bid = $croom_ID;
        $this->view->creditDetails = $creditDetails;
        $this->view->crDetails = $crDetails;
    }

    public function changemonthAction() {
        $this->_helper->layout()->disableLayout();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {


            $companyListing = '';
            $buildingMapper = new Model_Building();

            if ($this->roleId == '9') {
                $companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
            } else {
                $user_build_mod = new Model_UserBuildingModule();

                $buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
                if ($buildinglists) {
                    $build_id_array = array();
                    foreach ($buildinglists as $buildlist)
                        $build_id_array[] = $buildlist['building_id'];
                    $companyListing = $buildingMapper->getBuildingList($build_id_array);
                }
            }
            foreach ($companyListing as $cl) {
                $buildIds[] = $cl['build_id'];
            }
            $build_ID = $this->_getParam('bid', '');
            if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds)))
                $build_ID = $_COOKIE['build_cookie'];
            else
                $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");

            if ($companyListing != '') {
                if ($build_ID != '')
                    $select_build_id = $build_ID;
                else
                    $select_build_id = $companyListing[0]['build_id'];
            }
            $final=$this->getViewAccess($select_build_id);
            $this->view->viewacess=$final;
            $this->view->companyListing = $companyListing;
            $this->view->custID = $this->cust_id;
            $this->view->select_build_id = $select_build_id;
            $this->view->roleId = $this->roleId;
            $this->view->acessHelper = $this->accessHelper;
            $this->view->croom_location = 25;
            $data = $this->_request->getPost();
        }
        
        if($data['page']!=='auser'){
            //$this->view->tenantId = $data['page'];           
            $role=$_SESSION['Admin_User']['role_id'];
            if($data['type']=='tuser'){
                $tnuserModel = new Model_TenantUser();
                $tnuserdetail = $tnuserModel->getTenantUserById($data['page']);
                $this->view->type=$data['type'];
                $this->view->role_id=$tnuserdetail[0]->role_id;
                $this->view->tid=$tnuserdetail[0]->uid;
            }else{
                $this->view->type=$data['type'];
                $this->view->role_id=$tnuserdetail[0]->role_id;
                $this->view->tid=$data['page'];  
            }
           
        } else{
            $this->view->tenantId = "tenant";
        }       
        $this->view->month = $data['month'];
        $this->view->year = $data['year'];
        $this->view->page = $data['page'];
    }

    public function changeweeklyAction() {
        $this->_helper->layout()->disableLayout();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {

            $companyListing = '';
            $buildingMapper = new Model_Building();

            if ($this->roleId == '9') {
                $companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
            } else {
                $user_build_mod = new Model_UserBuildingModule();

                $buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
                if ($buildinglists) {
                    $build_id_array = array();
                    foreach ($buildinglists as $buildlist)
                        $build_id_array[] = $buildlist['building_id'];
                    $companyListing = $buildingMapper->getBuildingList($build_id_array);
                }
            }
            foreach ($companyListing as $cl) {
                $buildIds[] = $cl['build_id'];
            }
            $build_ID = $this->_getParam('bid', '');
            if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds)))
                $build_ID = $_COOKIE['build_cookie'];
            else
                $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");

            if ($companyListing != '') {
                if ($build_ID != '')
                    $select_build_id = $build_ID;
                else
                    $select_build_id = $companyListing[0]['build_id'];
            }

            $this->view->companyListing = $companyListing;
            $this->view->custID = $this->cust_id;
            $this->view->select_build_id = $select_build_id;
            $this->view->roleId = $this->roleId;
            $this->view->acessHelper = $this->accessHelper;
            $this->view->croom_location = 25;
            $data = $this->_request->getPost();
        }

        $this->view->month = $data['month']; //date('m',strtotime('last Sunday'));
        $this->view->lastdate = $data['lastdate']; //date('Y',strtotime('last Sunday'));
        $this->view->page = $data['page'];
        $this->view->year = $data['year'];
    }

    public function changedailyAction() {
        $this->_helper->layout()->disableLayout();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {

            $companyListing = '';
            $buildingMapper = new Model_Building();

            if ($this->roleId == '9') {
                $companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
            } else {
                $user_build_mod = new Model_UserBuildingModule();

                $buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
                if ($buildinglists) {
                    $build_id_array = array();
                    foreach ($buildinglists as $buildlist)
                        $build_id_array[] = $buildlist['building_id'];
                    $companyListing = $buildingMapper->getBuildingList($build_id_array);
                }
            }
            foreach ($companyListing as $cl) {
                $buildIds[] = $cl['build_id'];
            }
            $build_ID = $this->_getParam('bid', '');
            if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds)))
                $build_ID = $_COOKIE['build_cookie'];
            else
                $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");

            if ($companyListing != '') {
                if ($build_ID != '')
                    $select_build_id = $build_ID;
                else
                    $select_build_id = $companyListing[0]['build_id'];
            }

            $this->view->companyListing = $companyListing;
            $this->view->custID = $this->cust_id;
            $this->view->select_build_id = $select_build_id;
            $this->view->roleId = $this->roleId;
            $this->view->acessHelper = $this->accessHelper;
            $this->view->croom_location = 25;
            $data = $this->_request->getPost();
        }

        $this->view->month = $data['month']; //date('m',strtotime('last Sunday'));
        $this->view->days = $data['day']; //date('Y',strtotime('last Sunday'));	
        $this->view->page = $data['page'];
        $this->view->year = $data['year'];
    }

    public function scheduleAction() {
        $this->_helper->layout()->disableLayout();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {


            $companyListing = '';
            $buildingMapper = new Model_Building();

            if ($this->roleId == '9') {
                $companyListing = $buildingMapper->getCompanyBuilding($this->cust_id);
            } else {
                $user_build_mod = new Model_UserBuildingModule();

                $buildinglists = $user_build_mod->getUserBuildingIds($this->userId);
                if ($buildinglists) {
                    $build_id_array = array();
                    foreach ($buildinglists as $buildlist)
                        $build_id_array[] = $buildlist['building_id'];
                    $companyListing = $buildingMapper->getBuildingList($build_id_array);
                }
            }
            foreach ($companyListing as $cl) {
                $buildIds[] = $cl['build_id'];
            }
            $build_ID = $this->_getParam('bid', '');
            if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds)))
                $build_ID = $_COOKIE['build_cookie'];
            else
                $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");

            if ($companyListing != '') {
                if ($build_ID != '')
                    $select_build_id = $build_ID;
                else
                    $select_build_id = $companyListing[0]['build_id'];
            }
           // $cscheduleMapper = new Model_ConferenceSchedule();
           // date
           // $bookingDetails = $cscheduleMapper->getBookingEvent($from_date, $to_date, $select_build_id);

            $this->view->companyListing = $companyListing;
            $this->view->custID = $this->cust_id;
            $this->view->select_build_id = $select_build_id;
            $this->view->roleId = $this->roleId;
            $this->view->acessHelper = $this->accessHelper;
            $this->view->croom_location = 25;
            $data = $this->_request->getPost();
        }
        if(!empty($data['page'])){
            $this->view->page = $data['page'];
        }
        $this->view->month = $data['month'];
        $this->view->year = $data['year'];
        $this->view->date = $data['date'];
		

    }

    public function createbookingAction() {
        $this->_helper->layout()->setLayout('popuplayout');
        $month = $this->_getParam('month', '');
        $build_ID = $this->_getParam('bid', '');
        $year = $this->_getParam('year', '');
        $day = $this->_getParam('day', '');
        $this->view->select_build_id = $build_ID;
        $this->view->month = $month;
        $this->view->year = $year;
        $this->view->requested_date = $year . '/' . $month . '/' . $day;
        $da=$year . '/' . $month . '/' . $day;
        $cscheduleMapper = new Model_ConferenceSchedule();
        $getvalidday=$cscheduleMapper->getcrvaliddays($build_ID,$da);        
        //$crDetails = $cscheduleMapper->getcrDetailsByBid($build_ID, array(),1 );
        $this->view->fullDate=$da;    
        $this->view->crDetails = $getvalidday;
    }
    
    
    //recurrencesetup
    
    public function recurrencesetupAction(){
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $rid = $this->_getParam('roomId', '');
        $requested_date = $this->_getParam('requested_date', '');
        $cscheduleMapper = new Model_ConferenceSchedule();
        $weeksdays        = $cscheduleMapper->getroomavaliabledays($rid);
        $d = $this->getshowday($weeksdays[0]->week_days_id);
        $days=array('0'=>'Sunday','1'=>'Monday','2' => 'Tuesday','3' => 'Wednesday','4'=>'Thursday','5' =>'Friday','6' => 'Saturday');
        $dayname = array();
        foreach($d as $dn){
            $dayname[] = $days[$dn];
        }
        //$view_weeks = $this->getweeknameandday($requested_date);
        $this->view->fullDate=$da;    
        $this->view->crDetails = $getvalidday;
        $this->view->roomavaliable =  $weeksdays[0]->title;
        $this->view->viewWeeks = $view_weeks;
        $this->view->avaliabledays = $dayname;
        $this->view->requestdate = $requested_date;
    }
    
    public function editrecurrencesetupAction(){
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $rid = $this->_getParam('roomId', '');
        $howaften = $this->_getParam('howaften', '');
        $daterang = $this->_getParam('daterang', '');
        $inputdata = $this->_getParam('inputdata', '');
        if($daterang == 2){
            $this->view->number = $inputdata;
        }else if($daterang == 3){
            $this->view->date = $inputdata;
        }
        $this->view->daterang = $daterang;
        $this->view->howaften = $howaften;
        $cscheduleMapper = new Model_ConferenceSchedule();
        $weeksdays        = $cscheduleMapper->getroomavaliabledays($rid);
        $this->view->fullDate=$da;    
        $this->view->crDetails = $getvalidday;
        $this->view->roomavaliable =  $weeksdays[0]->title;
    }
    
   
    
    public function editbookingAction() {
        $this->_helper->layout()->setLayout('popuplayout');
        $month = $this->_getParam('month', '');
        $build_ID = $this->_getParam('bid', '');
        $year = $this->_getParam('year', '');
        $day = $this->_getParam('day', '');
        $crid = $this->_getParam('crid', '');
        $tid = $this->_getParam('tid', '');
        $page = $this->_getParam('page', '');
        $this->view->page=$page;
        $this->view->select_build_id = $build_ID;
        $this->view->month = $month;
        $this->view->year = $year;
        $this->view->requested_date = $year . '/' . $month . '/' . $day;
        $da=$year . '/' . $month . '/' . $day;
        $this->view->fullDate=$da; 
        $this->view->crid = $crid;
        $this->view->tid = $tid;

        //$cscheduleMapper = new Model_ConferenceSchedule();
        //$crDetails = $cscheduleMapper->getcrDetailsByBid($build_ID, array(),1 );
        
        $da=$year . '/' . $month . '/' . $day;        
        $cscheduleMapper = new Model_ConferenceSchedule();
        $getvalidday=$cscheduleMapper->getcrvaliddays($build_ID,$da);
        $this->view->crDetails = $getvalidday;
        //$this->view->crDetails = $crDetails;
    }

    public function selecttnuserAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $tId = $this->_getParam('tId', '');
        $sId = $this->_getParam('sId', '');
        $tnuserModel = new Model_TenantUser();
        $tnuserdetail = $tnuserModel->getTenantUsers($tId);
        $tnModel = new Model_Tenant();
        $tndetail = $tnModel->getTenantById($tId);
        $this->view->tnuserData = $tnuserdetail;
        $this->view->tnData = $tndetail[0];

        if(!empty($sId)){
            $this->view->sId = $sId;        
            $this->view->action="edit";
        }

    }

    public function addemailphoneAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $uId = $this->_getParam('uid', '');
        $userMapper = new Model_User();
        $userDetails = $userMapper->getUserById($uId);
        $output['email'] = $userDetails[0]->email;
        $output['phoneNumber'] = $userDetails[0]->phoneNumber;
        echo json_encode($output);
        exit(0);
    }

    public function showdesignAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $cid = $this->_getParam('cid', '');
        $did = $this->_getParam('did', '');
        $cscheduleMapper = new Model_ConferenceSchedule();
        $layoutDetails = $cscheduleMapper->getcrDesignLayout($cid);
        $this->view->layoutDetails = $layoutDetails;
        $this->view->did = $did;

    }
    
    public function dateschedulerAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();
        $cid = $this->_getParam('cid', '');
        $start_time = $this->_getParam('start_time', '');
        $end_time = $this->_getParam('end_time', '');
        $valid = 0;
        $cscheduleMapper    =   new Model_ConferenceSchedule();
        $layoutDetails      =   $cscheduleMapper->getscheduletime($cid); 
        $crDetails          =   $cscheduleMapper->getcrRateSchdata($cid);
        $crRecurrence       =   $cscheduleMapper->get_recurrence_access($cid);

        $rec_build_user     =   $crRecurrence[0]->recurrence_building_user;
        $rec_tenant_admin   =   $crRecurrence[0]->recurrence_tenant_admin;
        $rec_tenant_user    =   $crRecurrence[0]->recurrence_tenant_user;        
        $user_role          =   $_SESSION['Admin_User']['role_id'];
        
        
        if($rec_build_user==1 && ($user_role==1 || $user_role==2 || $user_role==3 || $user_role==4 || $user_role==6 )){
           $valid =1; 
        }
        
        if($rec_tenant_admin==1 && ($user_role==1 || $user_role==5) ){
           $valid =1; 
        }
        
        if($rec_tenant_user==1 && ($user_role==1 || $user_role==7) ){
           $valid =1; 
        }
        
        //echo $valid;
        
        $this->view->crDetails = $crDetails;
        $this->view->layoutDetails = $layoutDetails;
        $this->view->start_time = $start_time;
        $this->view->end_time = $end_time;
        $this->view->crRecurrence = $valid;
        //$this->view->did = $did;
    }

     public function typeschedulerAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();
        $cid = $this->_getParam('cid', '');
        $start_time = $this->_getParam('start_time', '');
        $end_time = $this->_getParam('end_time', '');
        $plan = $this->_getParam('plan', '');
        
        $cscheduleMapper = new Model_ConferenceSchedule();
        $layoutDetails = $cscheduleMapper->getscheduletime($cid);
        $cscheduleMapper = new Model_ConferenceSchedule();
        $crDetails = $cscheduleMapper->getcrRateSchdata($cid);
        $this->view->crDetails = $crDetails;
        $this->view->layoutDetails = $layoutDetails;
        $this->view->start_time = $start_time;
        $this->view->end_time = $end_time;
        $this->view->plan = $plan;
    }

    function checkavaliablecrAction() {
        $this->_helper->layout()->disableLayout();
        $msgArray = array();
        $check = false;
        $check1 = true;
        $check3 = false;
        $chmin=false;
        $chmax=false;
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            //print_r($data);
            $cscheduleMapper = new Model_ConferenceSchedule();
            try {
                $data['start_time'] = date('H:i', strtotime($data['start_time']));
                $data['end_time'] = date('H:i', strtotime($data['end_time'])); 
                $st=strtotime($data['start_time']);
                $et=strtotime($data['end_time']);
                $getdata= $cscheduleMapper->getcrRateSchdatavalid($data['croom_id'],$data['plan']);
                $diff = abs($et - $st) / 3600;
                $min=$getdata[0]->min;
                $max=$getdata[0]->max;
                if($min > $diff){
                    $chmin=true;
                }
                if($diff > $max  ){
                    $chmax=true;
                }
                
                
                if(strtotime($data['start_time']) == strtotime($data['end_time'])){
                    $check3=true;
                }
				
                $chmultimode = $cscheduleMapper->getcrDetails($data['croom_id']);
                //echo $chmultimode[0]->multi_mode;
                if($chmultimode[0]->multi_mode==1){
                    $data['multiroomid'] = $data['croom_id'];
                    $data['croom_id']=$chmultimode[0]->multi_id.",".$data['multiroomid'];
                    
                }
                
               
                
               // $chmultimode = $cscheduleMapper->getcrDetailsData($data['croom_id']);
                //print_r($data);
  
                if(!empty($data['crid'])){
                    $data['crid'] = $data['crid'];
                    $response = $cscheduleMapper->updatecheckavaliablecr($data);
                }else{
                    $response = $cscheduleMapper->checkavaliablecr($data);
                }
                
                if ($response){
                    $gg1 = date("Y-m-d", strtotime($data['requested_date']));
                    $startTime = new DateTime($gg1 . ' ' . $data['start_time']);
                    $endTime = new DateTime($gg1 . ' ' . $data['end_time']);
                    //$startTime = strtotime($data['start_time']);
                    //$endTime = strtotime($data['end_time']);
                    foreach($response as $val) {
                        $timestamp = strtotime($val->end_time) + 59 * 60;
                        $time = date('h:i A', $timestamp);
                        if(strtotime($data['requested_date']) == strtotime($val->requested_date)){
                            $gg = date("Y-m-d", strtotime($val->requested_date));
                        }else{
                            $gg = date("Y-m-d", strtotime($val->end_date));
                        }
                        $existStart = new DateTime($gg . ' ' . $val->start_time);
                        $existEnd = new DateTime($gg . ' ' . $time);
//                      $existStart = strtotime($val->start_time);
//                      $existEnd   = strtotime($time);
//                      print_r($existEnd);
                        if ($startTime > $existEnd && $endTime > $existEnd) {
                            $check = true;
                        } else if ($endTime < $existStart && $startTime < $existStart) {
                            $check = true;
                        } else {
                            $check1 = false;
                        }
                    }
//                    var_dump($check);
//                    var_dump($check1);
//                    var_dump($check3);
//                    print_r($response);
//                    die;
                     
                } else {
                    $check = true;
                }
                //print_r($data);
                //print_r($response);
                //die;
            } catch (Exception $ex) {
                
            }
                
            if ($check1 && $check && $check3===false && $chmin === false && $chmax === false) {
                //print_r($data);
                //die;
                $cscheduleMapper = new Model_ConferenceSchedule();
                //$weeksdays = $cscheduleMapper->getroomavaliabledays($rid);
                if(empty($data['multiroomid'])){
                    $room_access = $cscheduleMapper->getscheduletime($data['croom_id']);  
                }else{
                    $room_access = $cscheduleMapper->getscheduletime($data['multiroomid']);
                }
                
                
                if($room_access[0]->recurrence_building_user){
                    
                    $staus = $this->validationrecurrence($data);
                    if(!$staus){                        
                        $msgArray['status'] = 'error';
                        $msgArray['msg'] = 'There is a time conflict with the reoccurring booking, please select another "How Often" ';
                        
                    }else{
                        
                        $last_date = $this->getlastdate($data);
                        $msgArray['status'] = 'success';
                        $msgArray['enddate'] = $last_date;
 
                    }
                    
                }else{
                    $msgArray['status'] = 'success';
                }
                
            }else if($check3===true){
                $msgArray['status'] = 'error';
                $msgArray['msg'] = 'Booking Not Allow To Same Time.';
            }elseif($chmin===true){
                $msgArray['status'] = 'error';
                $msgArray['msg'] = 'Booking Not Allow To Min time duration';
            }elseif($chmax===true){
                $msgArray['status'] = 'error';
                $msgArray['msg'] = 'Booking Not Allow To Max time duration.';
            }else{
                $msgArray['status'] = 'error';
                $msgArray['msg'] = 'Conference room is already booked in this duration.';
            }
        }
        echo json_encode($msgArray);

        exit(0);
    }
    
    public function validationrecurrence($data1){
        //print_r($data1);
       // die;
        $rid = $data1['croom_id'];
        $start_time = strtotime($data1['start_time']) - 59 * 60;
        $stime = date('h:i A', $start_time);
        $shour = date('h', $start_time);
        if($shour == 12){
            $stime = "00".date(':i A', $start_time);
        }
        //echo $stime;
        $end_time = strtotime($data1['end_time']) + 59 * 60;
        $etime = date('h:i A', $end_time);
        $ehour = date('h', $start_time);
        if($ehour == 12){
            $etime = "00".date(':i A', $start_time);
        }
        $valid = true;
        $crid = "";
        if(!empty($data1['crid'])){
            $crid = $data1['crid'];
        }
        $cscheduleMapper = new Model_ConferenceSchedule();
        $last_date = $this->getlastdate($data1);
        $data = $cscheduleMapper->getCroomRequestBytime($stime,$etime,$data1['croom_id'],$data1['requested_date'],$last_date,$crid);
        $room_access = $cscheduleMapper->getroomavaliabledays($data1['croom_id']);        
        //print_r($data);
       // die;
        $first = $this->getbookingdatelist($data1);
        //print_r($first);
        //die;
        $bookdates = array();
        foreach($data as $allbooking){
            $booking = (array)$allbooking;
            
            if($booking['booking_type']=='yearly'){
                //print_r($booking);
                $dates = $this->getbookingdatelist($booking);
                foreach($dates AS $bdata){
                   array_push($bookdates,$bdata); 
                }
                
            }
            if($booking['booking_type']=='monthly'){
                //print_r($booking);
                $dates = $this->getbookingdatelist($booking);
                foreach($dates AS $bdata){
                   array_push($bookdates,$bdata); 
                }
                
            }
            if($booking['booking_type']=='weekly'){
                //print_r($booking);
                $dates = $this->getbookingdatelist($booking);
                foreach($dates AS $bdata){
                   array_push($bookdates,$bdata); 
                }
                
            }
            if($booking['booking_type']=='daily'){
                $dates = $this->getbookingdatelist($booking);
                foreach($dates AS $bdata){
                   array_push($bookdates,$bdata); 
                }
            }
        }
        //print_r($first);
        //print_r($bookdates);
        //die;
        $bookind  = array_intersect($first,$bookdates);
        if(empty($bookind)){
            $valid = true;
        }else{
            $valid = false;
        }
        return $valid;
        // var_dump($valid);
    }
    
    public function getlastdate($data){
        
            $rec_sec = $data['booking_type'];
            $cscheduleMapper = new Model_ConferenceSchedule();
            
            /* case start for all the recurrence setup to get last date for all the booking */
            switch($rec_sec){
                
                case 'daily':
                        $no = "";
                        if($data['Rang_type']==1){
                            $no = 365;
                        }else if($data['Rang_type']==2){
                            $no = $data['rang_value'];
                        }else if($data['Rang_type']==3){
                            $endDate = $data['rang_value'];
                            $room_access = $cscheduleMapper->getroomavaliabledays($data['croom_id']);
                            $startDate = $data['requested_date'];
                            $weID = $room_access[0]->week_days_id;
                            $days = $this->getshowday($weID);
                            $day = $this->getDateForSpecificDayBetweenDates($startDate,$endDate,$days);
                            return end($day);
                        }
                        $room_access = $cscheduleMapper->getroomavaliabledays($data['croom_id']);
                        $startDate = $data['requested_date'];
                        $weID = $room_access[0]->week_days_id;
                        $days = $this->getshowday($weID);
                        $endDate  = date('Y-m-d', strtotime("+730 days",strtotime($data['requested_date'])));
                        $day = $this->getDateForSpecificDayBetweenDates($startDate,$endDate,$days);
                        //print_r($day);
                        return $day[$no-1];
                    
                    break;
                case 'weekly':
                    
                            $no = "";
                            if($data['Rang_type']==1){
                                $no = 52;
                            }else if($data['Rang_type']==2){
                                $no = $data['rang_value'];
                            }else if($data['Rang_type']==3){
                                $endDate = $data['rang_value'];
                                $room_access= date('w',  strtotime($data['requested_date']));
                                $days[] =$room_access;
                                $startDate = $data['requested_date']; 
                                $day = $this->getDateForSpecificDayBetweenDates($startDate,$endDate,$days);
                                //print_r($day);
                                return end($day);
                            }
                            ///$room_access = $cscheduleMapper->getroomavaliabledays($data['croom_id']);
                            $room_access= date('w',  strtotime($data['requested_date']));
                            $days[] =$room_access;
                            $startDate = $data['requested_date'];
                            $endDate  = date('Y-m-d', strtotime("+730 days",strtotime($data['requested_date'])));
                            $day = $this->getDateForSpecificDayBetweenDates($startDate,$endDate,$days);
                            //print_r($day);
                            return $day[$no-1];
                    
                    break;
                case 'monthly':                    
                            $no = "";
                            if($data['Rang_type']==1){
                                $no = 24;
                            }else if($data['Rang_type']==2){
                                $no = $data['rang_value'];
                            }else if($data['Rang_type']==3){
                                
                                $endDate = strtotime($data['rang_value']);                                
                                $startDate = strtotime($data['requested_date']);
                                $room_access= date('w',  strtotime($data['requested_date']));
                                $days[] = $room_access;
                                $day = $this->getDateForSpecificDayBetweenDatesMonthly($startDate,$endDate,$days);
                                $diff = ((date("Y",$endDate) - date("Y",$startDate)) * 12) + (date("m",$endDate) - date("m",$startDate));
                                $finaldates = $this->GetAllsamedayallmonth($data['requested_date'],$diff+1);
                                $rang = array();
                                foreach($finaldates as $dates){
                                    if(strtotime($dates)<= $endDate){
                                        $rang[] = $dates;
                                    }
                                }
                                return end($rang);
                            }
                            $finaldates = $this->GetAllsamedayallmonth($data['requested_date'],$no);
                            return end($finaldates);
                break;
                
                case 'yearly':
                        $no = "";
                        if($data['Rang_type']==1){
                            $no = 2;
                        }else if($data['Rang_type']==2){
                            $no = $data['rang_value'];
                        }else if($data['Rang_type']==3){

                            $endDate = strtotime($data['rang_value']);                                
                            $startDate = strtotime($data['requested_date']);
                            $data = $this->getweeknameandday($data['requested_date']);
                            echo $startyear = date("Y",$startDate);
                            $diff = ((date("Y",$endDate) - date("Y",$startDate))); 
                            $rang1 = array();
                            for($i=0;$i<=$diff;$i++){
                                $year = $startyear + $i;
                                $rang[] = date("Y-m-d",strtotime($data." of ". date("F",$startDate)." ".$year));
                            }
                            
                            foreach($rang as $dates){
                                    if(strtotime($dates)<= $endDate){
                                        $rang1[] = $dates;
                                    }
                                }
                            
                           // print_r($rang1);
                            //die;
                            return end($rang1);
                        }
                        $endDate = strtotime($data['rang_value']);                                
                        $startDate = strtotime($data['requested_date']);
                        $room_access = date('w',strtotime($data['requested_date']));
                        $data = $this->getweeknameandday($data['requested_date']);
                        $startyear = date("Y",$startDate);                        
                        $current_day = $data." of ".date("m",$startDate)." ".date("Y",$startDate);
                        $dates = array();
                           for($i=0;$i<=$no;$i++){
                             $year = $startyear + $i;
                            $dates[] = date("Y-m-d",strtotime($data." of ". date("F",$startDate)." ".$year));
                        }
                        //print_r($dates);
                        //$finaldates = $this->GetAllsamedayallmonth($data['requested_date'],$no);
                        return end($dates);
                break;
                
            }
        
    }
    
    public function getbookingdatelist($data){
        
            $rec_sec = $data['booking_type'];
            $cscheduleMapper = new Model_ConferenceSchedule();
            
            /* case start for all the recurrence setup to get last date for all the booking */
            switch($rec_sec){
                
                case 'daily':
                        $no = "";
                        if($data['Rang_type']==1){
                            $no = 365;
                        }else if($data['Rang_type']==2){
                            $no = $data['rang_value'];
                        }else if($data['Rang_type']==3){
                            $endDate = $data['rang_value'];
                            $room_access = $cscheduleMapper->getroomavaliabledays($data['croom_id']);
                            $startDate = $data['requested_date'];
                            $weID = $room_access[0]->week_days_id;
                            $days = $this->getshowday($weID);
                            //$endDate  = date('Y-m-d', strtotime("+730 days",strtotime(now)));
                            $day = $this->getDateForSpecificDayBetweenDates($startDate,$endDate,$days);
                            return $day;
                        }
                        $room_access = $cscheduleMapper->getroomavaliabledays($data['croom_id']);
                        $startDate = $data['requested_date'];
                        $weID = $room_access[0]->week_days_id;
                        $days = $this->getshowday($weID);
                        $endDate  = date('Y-m-d', strtotime("+730 days",strtotime($data['requested_date'])));
                        $day = $this->getDateForSpecificDayBetweenDates($startDate,$endDate,$days);
                        //print_r($day);
                        $finalEndDate = $day[$no-1];
                        $allbooking = $this->getDateForSpecificDayBetweenDates($startDate,$finalEndDate,$days);
                        return $allbooking;
                    
                    break;
                case 'weekly':
                    
                            $no = "";
                            if($data['Rang_type']==1){
                                $no = 52;
                            }else if($data['Rang_type']==2){
                                $no = $data['rang_value'];
                            }else if($data['Rang_type']==3){
                                $endDate = $data['rang_value'];
                                $room_access= date('w',  strtotime($data['requested_date']));
                                $days[] =$room_access;
                                $startDate = $data['requested_date']; 
                                $day = $this->getDateForSpecificDayBetweenDates($startDate,$endDate,$days);
                                return $day;
                            }
                            $room_access= date('w',  strtotime($data['requested_date']));
                            $days[] =$room_access;
                            $startDate = $data['requested_date'];
                            $endDate  = date('Y-m-d', strtotime("+730 days",strtotime($data['requested_date'])));
                            $day = $this->getDateForSpecificDayBetweenDates($startDate,$endDate,$days);
                            $finalEndDate = $day[$no-1];
                            $allbooking = $this->getDateForSpecificDayBetweenDates($startDate,$finalEndDate,$days);
                            return $allbooking;
                    break;
                    
                case 'monthly':
                    
                        $no = "";
                        if($data['Rang_type']==1){
                            $no = 24;
                        }else if($data['Rang_type']==2){
                            $no = $data['rang_value'];
                        }else if($data['Rang_type']==3){

                            $endDate = strtotime($data['rang_value']);
                            $startDate = strtotime($data['requested_date']);
                            $room_access= date('w',  strtotime($data['requested_date']));
                            $days[] = $room_access;
                            $day = $this->getDateForSpecificDayBetweenDatesMonthly($startDate,$endDate,$days);
                            $diff = ((date("Y",$endDate) - date("Y",$startDate)) * 12) + (date("m",$endDate) - date("m",$startDate));
                            $finaldates = $this->GetAllsamedayallmonth($data['requested_date'],$diff+1);
                            $rang = array();
                            foreach($finaldates as $dates){
                                if(strtotime($dates)<= $endDate){
                                    $rang[] = $dates;
                                }
                            }
                            return $rang;
                        }
                        $finaldates = $this->GetAllsamedayallmonth($data['requested_date'],$no);
                        return $finaldates;
                break;
                case 'yearly':
                        $no = "";
                        if($data['Rang_type']==1){
                            $no = 2;
                        }else if($data['Rang_type']==2){
                            $no = $data['rang_value'];
                        }else if($data['Rang_type']==3){

                            $endDate = strtotime($data['rang_value']);                                
                            $startDate = strtotime($data['requested_date']);
                            $data = $this->getweeknameandday($data['requested_date']);
                            echo $startyear = date("Y",$startDate);
                            $diff = ((date("Y",$endDate) - date("Y",$startDate))); 
                            $rang1 = array();
                            for($i=0;$i<=$diff;$i++){
                                $year = $startyear + $i;
                                $rang[] = date("Y-m-d",strtotime($data." of ". date("F",$startDate)." ".$year));
                            }
                            
                            foreach($rang as $dates){
                                    if(strtotime($dates)<= $endDate){
                                        $rang1[] = $dates;
                                    }
                                }
                            return $rang1;
                        }
                        $endDate = strtotime($data['rang_value']);                                
                        $startDate = strtotime($data['requested_date']);
                        $room_access = date('w',strtotime($data['requested_date']));
                        $data = $this->getweeknameandday($data['requested_date']);
                        $startyear = date("Y",$startDate);                        
                        $current_day = $data." of ". date("m",$startDate)." ".date("Y",$startDate);
                        $dates = array();
                           for($i=0;$i<=$no;$i++){
                             $year = $startyear + $i;
                            $dates[] = date("Y-m-d",strtotime($data." of ". date("F",$startDate)." ".$year));
                        }
                        return $dates;
                break;
                
            } 
        
    }
    
    /* View all same day in every month  */
    public function GetAllsamedayallmonth($reqdate,$nofmonth)
            {
                        $currentMonth = date("m",strtotime($reqdate));
                        $endmonth = $currentMonth + ($nofmonth - 1);
                        $year = date("Y",strtotime($reqdate));
                        $data = $this->getweeknameandday($reqdate);
                        $month = array();
                        for($i=$currentMonth;$i<=$endmonth;$i++){
                            if($i<=12){                                  
                                $month[] =  date("F Y",strtotime("12-$i-$year"));
                            }else if($i<=24){
                                $m = $i - 12;
                                if($i == 13){
                                    $year = $year + 1;
                                }                                    
                                $month[] = date("F Y",strtotime("12-$m-$year"));
                            }else if($i<=36){
                                $m = $i - 24;
                                if($i == 25){
                                    $year = $year + 1;
                                }                                    
                                $month[] = date("F Y",strtotime("12-$m-$year"));
                            }
                        }
                        //print_r($month);
                        $datesArray = array();
                        foreach($month as $cdate){
                            $datesArray[] =date("Y-m-d",strtotime($data." of ".$cdate)); 
                        }
                        return $datesArray;
            }
    
    
    
    /* get avaliablility for days */
    public function getDateForSpecificDayBetweenDates($startDate,$endDate,$day_numbers){
            $endDate = strtotime($endDate);
            $finaldates = array();
            $days=array('0'=>'Sunday','1'=>'Monday','2' => 'Tuesday','3' => 'Wednesday','4'=>'Thursday','5' =>'Friday','6' => 'Saturday');
            foreach($day_numbers as $day_number)
            for($i = strtotime($days[$day_number], strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
                    $date_array[]=date('Y-m-d',$i);
            asort($date_array);
            foreach($date_array as $dates){
                            $finaldates[] = $dates;
            }
            return $finaldates;
    }
    
    /* get all the data  */
     public function getweeknameandday($date){
	
        $y = date("Y",strtotime($date));
	$m =date("F",strtotime($date));
        $day = date("l",strtotime($date));
	$d = strtotime($date);
	
	$f = strtotime("first ".$day." of ".$m." ".$y);
	$s = strtotime("second ".$day." of ".$m." ".$y);
	$t = strtotime("third ".$day." of ".$m." ".$y);
	$fo = strtotime("fourth ".$day." of ".$m." ".$y);
	$l = strtotime("last ".$day." of ".$m." ".$y);
	if($f == $d){
		$data = "first ".$day;//array(0,1,2,3,4);
	}else if($s == $d){
		$data = "Second ".$day;//array(1,2,3,4);
	}else if($t == $d){
		$data = "Third ".$day;//array(2,3,4);
	}else if($fo == $d){
		$data = "Fourth ".$day;//array(3,4);
	}else if($l == $d){
		$data = "Last ".$day;//array(4);
	}
	//$viewAt = array("First Week","Second Week","Third Week","Fourth Week","Last Week");
	//$result  = array();
        //print_r($data);
	//foreach($data as $ds){
	//		$result[] =$viewAt[$ds]; 
	//}
        //print_r($result);
	return $data;
	
    }
    
    /* get avaliablility for days */
    public function getDateForSpecificDayBetweenDatesMonthly($startDate,$endDate,$day_numbers){
            //echo $startDate;
            $endDate = strtotime($endDate);
            $finaldates = array();
            $days=array('0'=>'Sunday','1'=>'Monday','2' => 'Tuesday','3' => 'Wednesday','4'=>'Thursday','5' =>'Friday','6' => 'Saturday');
            foreach($day_numbers as $day_number){
                for($i = strtotime($days[$day_number], strtotime($startDate)); $i <= $endDate; ){                    
                    $i = strtotime($days[$day_number], $i);
                    $finaldates[] = date('Y-m-d',$i);
                    $i = strtotime('+1 month', $i);
                }
            }
            
            return $finaldates;
    }
    
/////// End recurrence booking validation /////////    

    public function savecroomrequestAction() {
        $this->_helper->layout()->disableLayout();
        $msgArray = array();

        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            $cscheduleMapper = new Model_ConferenceSchedule();
            //$respose=$cscheduleMapper->checkavaliablecr($data);
            $getdata = $cscheduleMapper->getcdDetails($data['croom_id']);

            try {
                $tnuserModel = new Model_TenantUser();
                $tuserdetails = $tnuserModel->getTenantUsers($data['tenant']);
                $tenant = new Model_Tenant();
                $tenantuser = $tenant->getTenantByUser($data['created_user']);
                $createdUser=$tenantuser[0]->firstName." ".$tenantuser[0]->lastName;
                $tenantdetails = $tenant->getTenantByUser($tuserdetails[0]->uid); 
                $tenant=$tenantdetails[0]->tenantName;
                $cscheduleMapper = new Model_ConferenceSchedule();
                $layoutDetails = $cscheduleMapper->check_id($data['design_id']);
                $design=$layoutDetails[0]->attachment;
                $designName=$layoutDetails[0]->design_name;
                //print_r($layoutDetails);
                //$this->view->layoutDetails = $layoutDetails;
                $conferenceData['booking_type'] = $data['booking_type'];
                $conferenceData['Rang_type'] = $data['Rang_type'];
                $conferenceData['rang_value'] = $data['rang_value'];               
                $conferenceData['email'] = $data['email'];
                $conferenceData['phone'] = $data['phone'];
                $conferenceData['start_time'] = $data['start_time'];
                $conferenceData['end_time'] = $data['end_time'];
                $conferenceData['booking_date'] = date("F jS, Y",strtotime($data['requested_date']));
                unset($data['email']);
                unset($data['phone']);
                $parent_id = $cscheduleMapper->insertcrRequestData($data);
                if($data['booking_type']!=""){
                    $avalibebooking = $this->getbookingdatelist($data);
                    for($i=1;$i<count($avalibebooking);$i++){
                        $data['parent_id'] = $parent_id;
                        $data['requested_date'] = $avalibebooking[$i];
                        $data['end_date']   = $avalibebooking[$i];
                        $data['Rang_type'] = "";
                        $data['rang_value'] = "";
                        $data['booking_type'] = "Recurrence";
                        $cscheduleMapper->insertcrRequestData($data);
                    }
                }
                /* Email send list */
                $email_group_model = new Model_EmailGroup();
                $emailGroup = $email_group_model->get_email_group_by_building_id($data['building_id']);
                foreach($emailGroup as $ge){
                    if(strpos(trim($ge['group_name']),'ference')){
                        $emailgroupdata=$ge;
                    }
                }
                if(!empty($emailgroupdata)){
                    $gdata= $cscheduleMapper->getuserformail($emailgroupdata['id']);                    
                }else{                    
                    $gdata= $cscheduleMapper->getuserformail($emailGroup[0]['id']);
                }
                foreach($tuserdetails as $tuserid){
                    if($tuserid->cc_enable==0)
                        continue;
                    $user_id[]=$tuserid->uid;
                }
                foreach($gdata as $rs){
                    $user_id[]=$rs->user_id;
                }
                if($_SESSION['Admin_User']['role_id']==7 || $_SESSION['Admin_User']['role_id']==5){
                    $user_id[]=$_SESSION['Admin_User']['user_id'];
                }
                //current tinant id 
                $user_id[]=$data['created_user'];
                $conferenceData['building_id'] = $data['building_id'];
                $conferenceData['tenant'] = $tenant;
                $conferenceData['created_user'] = $createdUser;                
                $conferenceData['design'] = '<a href="'.BASEURL.'public/conference_room/'.$design.'">'.$designName.'</a>';                
                $conferenceData['meeting_title'] = $data['meeting_title'];                
                $conferenceData['userId'] = $this->userId;  
                $conferenceData['room_name'] = $getdata[0]->room_name;
                $conferenceData['room_title'] = $getdata[0]->room_name;
                //print_r($conferenceData);
                $cscheduleMapper->sendConferenceEmail(implode(",", $user_id), $conferenceData);
                $msgArray['status'] = 'success';
                $msgArray['msg'] = 'Conference Room Request Added successfully.';
            } catch (Exception $e) {
                $msgArray['status'] = 'error';
                $msgArray['msg'] = 'Form is not properly filled.';
            }
            echo json_encode($msgArray);
        }
        exit(0);
    }
    
     public function updatecroomrequestAction() {
        $this->_helper->layout()->disableLayout();
        $msgArray = array();
        $getdata=array();
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            $getdata['tenant']=$data['tenant'];
            //$getdata['created_user']=$data['created_user'];
            $getdata['meeting_title']=$data['meeting_title'];
            $getdata['croom_id']=$data['croom_id'];
            $getdata['design_id']=$data['design_id'];
            $getdata['schedule_id']=$data['schedule_id'];
            $getdata['building_id']=$data['building_id'];
            $getdata['requested_date']=$data['requested_date'];
            $getdata['start_time']=$data['start_time'];
            $getdata['end_time']=$data['end_time'];
            $getdata['booking_type']=$data['booking_type'];
            $getdata['Rang_type']=$data['Rang_type'];
            $getdata['rang_value']=$data['rang_value'];
            $w_id['crid']=$data['crid'];
            
            
            $cscheduleMapper = new Model_ConferenceSchedule();
            //$respose=$cscheduleMapper->checkavaliablecr($data);
            $getdataa = $cscheduleMapper->getcdDetails($data['croom_id']);

            try {
                $cscheduleMapper->updatecrRequestData($getdata,$w_id);
                //print_r($data);
                //$parent_id = $cscheduleMapper->insertcrRequestData($data);
                if($getdata['booking_type']!=""){
                    $avalibebooking = $this->getbookingdatelist($getdata);
                    for($i=1;$i<count($avalibebooking);$i++){
                        $getdata['parent_id'] = $w_id;
                        $getdata['requested_date'] = $avalibebooking[$i];
                        $getdata['end_date']   = $avalibebooking[$i];
                        $getdata['Rang_type'] = "";
                        $getdata['rang_value'] = "";
                        $getdata['booking_type'] = "Recurrence";
                        unset($getdata['design_id']);
                        $cscheduleMapper->insertcrRequestData($getdata);
                    }
                }
                $tnuserModel = new Model_TenantUser();
                $tuserdetails = $tnuserModel->getTenantUsers($data['tenant']);
                $tenant = new Model_Tenant();
                
                $tenantuser = $tenant->getTenantByUser($data['created_user']);
                $createdUser=$tenantuser[0]->firstName." ".$tenantuser[0]->lastName;
                
                $tenantdetails = $tenant->getTenantByUser($tuserdetails[0]->uid);
                $tenant=$tenantdetails[0]->tenantName;
                
                $cscheduleMapper = new Model_ConferenceSchedule();
                $layoutDetails = $cscheduleMapper->check_id($data['design_id']);
                $design=$layoutDetails[0]->attachment;
                $designName=$layoutDetails[0]->design_name;
                $conferenceData['email'] = $data['email'];
                $conferenceData['phone'] = $data['phone'];
                $conferenceData['start_time'] = $data['start_time'];
                $conferenceData['end_time'] = $data['end_time'];
                $conferenceData['booking_date'] = date("F jS, Y",strtotime($data['requested_date']));
                /* Email send list */
                $email_group_model = new Model_EmailGroup();
                $emailGroup = $email_group_model->get_email_group_by_building_id($data['building_id']);
                foreach($emailGroup as $ge){
                    if(strpos(trim($ge['group_name']),'ference')){
                        $emailgroupdata=$ge;
                    }
                }
                if(!empty($emailgroupdata)){
                    $gdata= $cscheduleMapper->getuserformail($emailgroupdata['id']);
                }else{
                    $gdata= $cscheduleMapper->getuserformail($emailGroup[0]['id']);
                }
                foreach($tuserdetails as $tuserid){
                    if($tuserid->cc_enable==0)
                        continue;
                    $user_id[]=$tuserid->uid;
                }
                foreach($gdata as $rs){
                    $user_id[]=$rs->user_id;
                }
                if($_SESSION['Admin_User']['role_id']==7 || $_SESSION['Admin_User']['role_id']==5){
                    $user_id[]=$_SESSION['Admin_User']['user_id'];
                }
                $user_id[]=$data['created_user'];
                $conferenceData['building_id'] = $data['building_id'];
                $conferenceData['tenant'] = $tenant;
                $conferenceData['created_user'] = $createdUser;                
                $conferenceData['design'] = '<a href="'.BASEURL.'public/conference_room/'.$design.'">'.$designName.'</a>';                
                $conferenceData['meeting_title'] = $data['meeting_title'];                
                $conferenceData['userId'] = $this->userId;  
                $conferenceData['room_name'] = $getdataa[0]->room_name;
                $conferenceData['room_title'] = $getdataa[0]->room_name;
                $cscheduleMapper->sendConferenceEmail(implode(",", $user_id), $conferenceData);
				
                $msgArray['status'] = 'success';
                $msgArray['msg'] = 'Conference Room Request Added successfully.';
            } catch (Exception $e) {
                $msgArray['status'] = 'error';
                $msgArray['msg'] = 'Form is not properly filled.';
            }
            echo json_encode($msgArray);
        }
        exit(0);
    }
    
    

    public function showdateintervalAction() {
        $data = $this->_request->getPost();
        if (!empty($data['interval'])) {
            if ($data['action'] == 'add') {
                $start = strtotime($data['start']);
                $tNow = strtotime('+480 minutes', $start);
                echo date("h:i A", $tNow);
            } else if ($data['action'] == 'sub') {
                $start = strtotime($data['start']);
                $tNow = strtotime('-480 minutes', $start);
                if (date("d", $start) > date("d", $tNow)) {
                    echo "Error";
                } else {
                    echo date("h:i A", $tNow);
                }
            }
        }else if(!empty($data['changehr'])){
                $start = strtotime($data['start']);
                $tNow = strtotime('+60 minutes', $start);
                echo date("h:i A", $tNow);
                   
        } else {
            if ($data['action'] == 'add') {
                $start = strtotime($data['start']);
                $tNow = strtotime('+240 minutes', $start);
                echo date("h:i A", $tNow);
            } else if ($data['action'] == 'sub') {
                $start = strtotime($data['start']);
                $tNow = strtotime('-240 minutes', $start);
                if (date("d", $start) > date("d", $tNow)) {
                    echo "Error";
                } else {
                    echo date("h:i A", $tNow);
                }
            }
        }
        die;
    }
    
    
    public function checkscheduleAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $schedule_name = $this->_getParam('schedule_name');
        $bid = $this->_getParam('bid');
        $cscheduleMapper = new Model_ConferenceSchedule();
        
        $schedulerDetail = $cscheduleMapper->isScheduleExist($schedule_name,$bid);
        
        if (!empty($schedulerDetail))
            echo true;
        else
            echo false;

        exit();
    }
    
    public function checkcroomAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $room_name = $this->_getParam('room_name');
        $bid = $this->_getParam('bid');
        $cscheduleMapper = new Model_ConferenceSchedule();
        $schedulerDetail = $cscheduleMapper->isCRoomExist($room_name,$bid);
        if (!empty($schedulerDetail))
            echo true;
        else
            echo false;

        exit();
    }
    
    




    public function checkeditcroomAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $room_name = $this->_getParam('room_name');
        $cid = $this->_getParam('cid');
        $bid = $this->_getParam('bid');
        $cscheduleMapper = new Model_ConferenceSchedule();
        $schedulerDetail = $cscheduleMapper->isEditCRoomExist($room_name,$cid,$bid);
        if (!empty($schedulerDetail))
            echo true;
        else
            echo false;

        exit();
    }
    
  public  function showendtimelimitAction(){
        $data = $this->_request->getPost();
        $start_time=$data['start'];
        $end_time=$data['end'];
        $plan=$data['plan'];
        $room=$data['room'];
        $cscheduleMapper = new Model_ConferenceSchedule();
        $crDetails = $cscheduleMapper->getcrRateSchget($room,$plan);
        $this->view->min=$crDetails[0]->min;
        $this->view->max=$crDetails[0]->max;
        $this->view->start_time = $start_time;
        $this->view->end_time = $end_time;
    }
    
   public function getschedulerAction(){
        $data =$this->_request->getPost();
        $sid = $data['sid'];
        $cscheduleMapper = new Model_ConferenceSchedule();
        $sdata = $cscheduleMapper->getCrdata($sid);        
        $to_time = strtotime($sdata[0]->start_time);
        $from_time = strtotime($sdata[0]->end_time);
        $minuts = round(abs($to_time - $from_time) / 60,2);
        $data = array("total"=>$minuts/60);
        echo json_encode($data);
        die;
    }

}

?>
