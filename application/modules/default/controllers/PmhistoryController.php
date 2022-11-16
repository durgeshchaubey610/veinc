<?php

/**
 * Description of pmhistroyController
 *
 * @author Mohd Emadullah
 */
class PmhistoryController extends Ve_Controller_Base {
    
    public function init()  {
       parent::init();
       $this->_helper->layout()->setLayout('newlayout');  
       $this->notesModel = new Model_Notes();
       $this->nm = new Zend_Session_Namespace('notes_message');
       $this->accessHelper = $this->_helper->access;
       $this->note_location = 22;
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
    }
    
    public function historyAction(){
        $pmTemplate =  new Model_PmTemplate();
        $user_id = $_SESSION['Zend_Auth']['storage']->uid;
        $cust_id = $_SESSION['Zend_Auth']['storage']->cust_id;
        $role_id = $_SESSION['Zend_Auth']['storage']->role_id;
        $companyListing = '';
        $buildingMapper = new Model_Building();
        $rModel = new Model_Report();
        if ($role_id == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($user_id);
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
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds))) {
            $build_ID = $_COOKIE['build_cookie'];
        } else {
            setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");
        }

        if ($companyListing != '') {
            if ($build_ID != '')
                $select_build_id = $build_ID;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }

        $_SESSION['current_building'] = $select_build_id;
        
        $taskReading = $pmTemplate->getTaskReading($select_build_id);
             
        $pmwoHistoryDetails = $pmTemplate->getPmWorkorderHistoryDetail($select_build_id,$taskReading[0]['Reading_Task']);
        // $pmwoHistorySortDetails = $pmTemplate->getPmWorkorderHistorySortDetail($select_build_id,$taskReading[0]['Reading_Task']);
        // // echo "<pre>";
        // if(count($pmwoHistorySortDetails) > 0){
        //     $title = array();
        //     foreach($pmwoHistorySortDetails as $key => $value){
        //         $title = $pmTemplate->getPmWorkorderHistorySortTitleDetailHC($select_build_id,$value['PM_WO_Number'],$value['Reading_Task']);   
        //         $title = $pmTemplate->getPmWorkorderHistorySortTitleDetailHNC($select_build_id,$value['PM_WO_Number'],$value['Reading_Task']);      
                
        //         foreach($title as $k => $v){
        //             if($v['Parent_ID'] != 0){
        //                 $title[$k]['child'] = $pmTemplate->getPmWorkorderHistoryTitleChildDetail($v['Parent_ID'], $v['PM_WO_Number']);
        //             }else{
        //                 $title[$k]['child'] = array();
        //             }
        //         }

        //         $pmwoHistorySortDetails[$key]['title'] = $title;
        //         unset($title);
        //     }
        // }
        // print_r($pmwoHistorySortDetails);
        // die;
        
        $pmHistoryNotes = $pmTemplate->getPmWoNotes($select_build_id);
        
        $this->view->taskReading = $taskReading;
        $this->view->companyListing = $companyListing;
        $this->view->select_build_id = $select_build_id;
        $pmEquipmentName = $pmTemplate->getallEquipmentNameByBuildId($select_build_id);
        $this->view->pmEquipmentName = $pmEquipmentName;
        $this->view->pmwoHistoryDetails = $pmwoHistoryDetails;
        //$this->view->pmwoHistorySortDetails = $pmwoHistorySortDetails;
        $this->view->userId = $user_id;
        $this->view->pmHistoryNotes = $pmHistoryNotes;
        
    }
    
    /*
     * Here for onchange of search for
     */

    public function searchforAction() {
        $data = $this->_request->getParams();
        $user_id = $_SESSION['Zend_Auth']['storage']->uid;
        $cust_id = $_SESSION['Zend_Auth']['storage']->cust_id;
        $role_id = $_SESSION['Zend_Auth']['storage']->role_id;
        $companyListing = '';
        $buildingMapper = new Model_Building();
        if ($role_id == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($user_id);
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
        $this->view->select_build_id = $select_build_id;

        $pmtemplate = new Model_PmTemplate();
        $AllEquipment = $pmtemplate->getEquipmentDetailForHistory($select_build_id, $data);
        echo json_encode($AllEquipment);
        die;
    }
    
    /*
     * Here for onchange of equipment unit for
     */

    public function searchforunitAction() {
        $data = $this->_request->getParams();
        $user_id = $_SESSION['Zend_Auth']['storage']->uid;
        $cust_id = $_SESSION['Zend_Auth']['storage']->cust_id;
        $role_id = $_SESSION['Zend_Auth']['storage']->role_id;
        $companyListing = '';
        $buildingMapper = new Model_Building();
        if ($role_id == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($user_id);
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
        $this->view->select_build_id = $select_build_id;

        $pmtemplate = new Model_PmTemplate();
        $AllEquipment = $pmtemplate->getWoByequipment($select_build_id, $data);
        echo json_encode($AllEquipment);
        die;
    }
    
    public function filterpmhistorydetailsAction(){
        $data = $this->_request->getParams();
        $this->_helper->layout()->disableLayout();
        $pmTemplate =  new Model_PmTemplate();
        $user_id = $_SESSION['Zend_Auth']['storage']->uid;
        $cust_id = $_SESSION['Zend_Auth']['storage']->cust_id;
        $role_id = $_SESSION['Zend_Auth']['storage']->role_id;
        $companyListing = '';
        $buildingMapper = new Model_Building();
        $rModel = new Model_Report();
        if ($role_id == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($user_id);
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
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds))) {
            $build_ID = $_COOKIE['build_cookie'];
        } else {
            setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");
        }

        if ($companyListing != '') {
            if ($build_ID != '')
                $select_build_id = $build_ID;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }

        $_SESSION['current_building'] = $select_build_id;
        $taskReading = $pmTemplate->getTaskReading($select_build_id);
        $newData = array();
        foreach($data['alldata'] as $datas){
            $newData[$datas['name']] = $datas['value'];           
            
        }
        
        $pmEquipmentDetails = $pmTemplate->getPmWOHistoryEquipmentDetail($select_build_id,$newData);
        
        $pmwoHistorySortDetails = $pmTemplate->getPmWorkorderHistorySortDetail($select_build_id, $taskReading[0]['Reading_Task'], $newData);
        // echo "<pre>";
        $title = array();
        foreach($pmwoHistorySortDetails as $key => $value){
            $titlehaschild = $pmTemplate->getPmWorkorderHistorySortTitleDetailHC($select_build_id,$value['PM_History_ID'],$value['PM_WO_Number'],$value['Reading_Task'], true);   
            $titlehasnochild = $pmTemplate->getPmWorkorderHistorySortTitleDetailHC($select_build_id,$value['PM_History_ID'],$value['PM_WO_Number'],$value['Reading_Task'], false);   
            //$titlehasnochild = $pmTemplate->getPmWorkorderHistorySortTitleDetailHNC($select_build_id,$value['PM_History_ID'],$value['PM_WO_Number'],$value['Reading_Task']);   
            if(!empty($titlehaschild) && !empty($titlehasnochild)){
                $title = array_merge_recursive($titlehaschild, $titlehasnochild);
            }elseif(!empty($titlehaschild)){
                $title = $titlehaschild;
            }elseif(!empty($titlehasnochild)){
                $title = $titlehasnochild;
            }
            foreach($title as $k => $v){
                if($v['Parent_ID'] != 0){
                    $title[$k]['child'] = $pmTemplate->getPmWorkorderHistoryTitleChildDetail($select_build_id,$v['Parent_ID'], $v['PM_WO_Number']);
                }else{
                    $title[$k]['child'] = array();
                }
            }

            $pmwoHistorySortDetails[$key]['title'] = $title;
            unset($title);
        }
        // print_r($pmwoHistorySortDetails);
        // die;
        
        $pmHistoryNotes = $pmTemplate->getPmWoNotes($select_build_id);
        
        $this->view->taskReading = $taskReading;        
        $this->view->pmEquipmentDetails = $pmEquipmentDetails;       
        $this->view->companyListing = $companyListing;
        $this->view->select_build_id = $select_build_id;
        $this->view->pmwoHistorySortDetails = $pmwoHistorySortDetails;
        $this->view->pmHistoryNotes = $pmHistoryNotes;
        $this->view->userId = $user_id;
        
        
        $this->_helper->viewRenderer('filterpmhistorydetails');
        
    }
    
    public function pmhistoryreadingdetailsAction(){
        $data = $this->_request->getParams();
        $this->_helper->layout()->disableLayout();
        $pmTemplate =  new Model_PmTemplate();
        $user_id = $_SESSION['Zend_Auth']['storage']->uid;
        $cust_id = $_SESSION['Zend_Auth']['storage']->cust_id;
        $role_id = $_SESSION['Zend_Auth']['storage']->role_id;
        $companyListing = '';
        $buildingMapper = new Model_Building();
        $rModel = new Model_Report();
        if ($role_id == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($user_id);
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
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds))) {
            $build_ID = $_COOKIE['build_cookie'];
        } else {
            setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");
        }

        if ($companyListing != '') {
            if ($build_ID != '')
                $select_build_id = $build_ID;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }

        $_SESSION['current_building'] = $select_build_id;
                
        //$taskReading = $pmTemplate->getTaskReading($select_build_id);
        $newData = array();
        foreach($data['alldata'] as $datas){
            $newData[$datas['name']] = $datas['value'];           
            
        }
        $reading = 'R';  
        //$pmwoHistoryDetails = $pmTemplate->getPmWorkorderHistoryReadingDetail($select_build_id,$reading, $newData['historySearch']);            
        $pmwoHistorySortDetails = $pmTemplate->getPmWorkorderHistoryReadingSortDetail($select_build_id,$reading, $newData);            
        //echo "<pre>";
        $title = array();
        foreach($pmwoHistorySortDetails as $key => $value){
            $titlehaschile = $pmTemplate->getPmWorkorderHistoryReadingSortTitleDetailHC($select_build_id,$value['PM_History_ID'],$value['PM_WO_Number'], $value['Reading_Task'], true);   
            $titlehasnotitle = $pmTemplate->getPmWorkorderHistoryReadingSortTitleDetailHC($select_build_id,$value['PM_History_ID'],$value['PM_WO_Number'], $value['Reading_Task'], false);   
            //$titlehasnotitle = $pmTemplate->getPmWorkorderHistoryReadingSortTitleDetailHNC($select_build_id,$value['PM_History_ID'],$value['PM_WO_Number'], $value['Reading_Task']);   
            if(!empty($titlehaschile) && !empty($titlehasnotitle)){
                $title = array_merge_recursive($titlehaschile, $titlehasnotitle);
            }elseif(!empty($titlehaschile)){
                $title = $titlehaschile;
            }elseif(!empty($titlehasnotitle)){
                $title = $titlehasnotitle;
            }
            // echo "<pre>";
            // print_r($title);
            // print_r($titlehaschile);
            // print_r($titlehasnotitle);
            //die;
            foreach($title as $k => $v){
                if($v['Parent_ID'] != 0){
                    $title[$k]['child'] = $pmTemplate->getPmWorkorderHistoryReadingTitleChildDetail($select_build_id,$v['Parent_ID'], $v['PM_WO_Number']);
                }else{
                    $title[$k]['child'] = array();
                }
            }

            $pmwoHistorySortDetails[$key]['title'] = $title;
            unset($title);
        }
        // print_r($pmwoHistorySortDetails);
        // die;
        
        
        $this->view->taskReading = $taskReading;
                
        $this->view->pmEquipmentDetails = $pmEquipmentDetails;       
        $this->view->companyListing = $companyListing;
        $this->view->select_build_id = $select_build_id;
        $this->view->pmwoHistorySortDetails = $pmwoHistorySortDetails;
        
        
        $this->_helper->viewRenderer('pmhistoryreadingdetails');
        
    }
    
    public function pmhistorytaskdetailsAction(){
        $data = $this->_request->getParams();
        $this->_helper->layout()->disableLayout();
        $pmTemplate =  new Model_PmTemplate();
        $user_id = $_SESSION['Zend_Auth']['storage']->uid;
        $cust_id = $_SESSION['Zend_Auth']['storage']->cust_id;
        $role_id = $_SESSION['Zend_Auth']['storage']->role_id;
        $companyListing = '';
        $buildingMapper = new Model_Building();
        $rModel = new Model_Report();
        if ($role_id == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($user_id);
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
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds))) {
            $build_ID = $_COOKIE['build_cookie'];
        } else {
            setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");
        }

        if ($companyListing != '') {
            if ($build_ID != '')
                $select_build_id = $build_ID;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }

        $_SESSION['current_building'] = $select_build_id;
                
        //$taskReading = $pmTemplate->getTaskReading($select_build_id);
        $newData = array();
        foreach($data['alldata'] as $datas){
            $newData[$datas['name']] = $datas['value'];           
            
        }
        // print_r($newData);
        // die;
        $task = 'T';
        // if(!empty($newData['equipmentname'])){
        //     $pmwoHistoryDetails = $pmTemplate->getPmWorkorderHistoryDetail($select_build_id,$task, $newData);
            
        // } else {
        //     $pmwoHistoryDetails = $pmTemplate->getPmWorkorderHistoryDetail($select_build_id,$task);
        // }

        $pmwoHistorySortDetails = $pmTemplate->getPmWorkorderHistorySortDetail($select_build_id,$task, $newData);            
        //echo "<pre>";
        $title = array();
        foreach($pmwoHistorySortDetails as $key => $value){
            $titlehaschild = $pmTemplate->getPmWorkorderHistorySortTitleDetailHC($select_build_id,$value['PM_History_ID'],$value['PM_WO_Number'],$value['Reading_Task'], true);   
            $titlehasnochild = $pmTemplate->getPmWorkorderHistorySortTitleDetailHC($select_build_id,$value['PM_History_ID'],$value['PM_WO_Number'],$value['Reading_Task'], false);   
            //$titlehasnochild = $pmTemplate->getPmWorkorderHistorySortTitleDetailHNC($select_build_id,$value['PM_History_ID'],$value['PM_WO_Number'],$value['Reading_Task']);   
            if(!empty($titlehaschild) && !empty($titlehasnochild)){
                $title = array_merge_recursive($titlehaschild, $titlehasnochild);
            }elseif(!empty($titlehaschild)){
                $title = $titlehaschild;
            }elseif(!empty($titlehasnochild)){
                $title = $titlehasnochild;
            }
            
            // echo "<pre>";
            // print_r($title);
            foreach($title as $k => $v){
                if($v['Parent_ID'] != 0){
                    $title[$k]['child'] = $pmTemplate->getPmWorkorderHistoryTitleChildDetail($select_build_id,$v['Parent_ID'], $v['PM_WO_Number']);
                }else{
                    $title[$k]['child'] = array();
                }
            }

            $pmwoHistorySortDetails[$key]['title'] = $title;
            unset($title);
        }
        // print_r($pmwoHistorySortDetails);
        // die;
          
        $this->view->taskReading = $taskReading;
                
        $this->view->pmEquipmentDetails = $pmEquipmentDetails;       
        $this->view->companyListing = $companyListing;
        $this->view->select_build_id = $select_build_id;
        $this->view->pmwoHistorySortDetails = $pmwoHistorySortDetails;
        
        
        $this->_helper->viewRenderer('pmhistorytaskdetails');
        
    }
    public function pmhistorynotesAction() {
        $building_id = $this->_getParam('buiild_id', '');
        $this->_helper->layout()->setLayout('popuplayout');
        $pmTemplate = new Model_PmTemplate();
        $pmHistoryNotes = $pmTemplate->getPmWoNotes($building_id);
        $this->view->pmHistoryNotes = $pmHistoryNotes;
    }
    
    /**
     * This is for sorting of PH History Notes / Comments by date
     */
    public function sortpmhistorynotesbydateAction() {
        $this->_helper->layout()->disableLayout();
        $pmTemplate = new Model_PmTemplate();
        $user_id = $_SESSION['Zend_Auth']['storage']->uid;
        $cust_id = $_SESSION['Zend_Auth']['storage']->cust_id;
        $role_id = $_SESSION['Zend_Auth']['storage']->role_id;
        $companyListing = '';
        $buildingMapper = new Model_Building();
        if ($role_id == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($user_id);
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
        $this->view->select_build_id = $select_build_id;
        $data = $this->_request->getPost();
        $this->_helper->viewRenderer('sortpmhistorynotesbydate');
        $pmHistoryNotes = $pmTemplate->getPmWoNotes($select_build_id,$data);
        $this->view->pmHistoryNotes = $pmHistoryNotes;
        $this->view->id = $data['id'];
    }
    
    public function sortpmhistorybyworkorderAction(){
        $params = $this->_request->getParams();
        $this->_helper->layout()->disableLayout();
        $pmTemplate =  new Model_PmTemplate();
        $user_id = $_SESSION['Zend_Auth']['storage']->uid;
        $cust_id = $_SESSION['Zend_Auth']['storage']->cust_id;
        $role_id = $_SESSION['Zend_Auth']['storage']->role_id;
        $companyListing = '';
        $buildingMapper = new Model_Building();
        $rModel = new Model_Report();
        if ($role_id == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($user_id);
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
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds))) {
            $build_ID = $_COOKIE['build_cookie'];
        } else {
            setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");
        }

        if ($companyListing != '') {
            if ($build_ID != '')
                $select_build_id = $build_ID;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }

        $_SESSION['current_building'] = $select_build_id;
        
        //$taskReading = $pmTemplate->getTaskReading($select_build_id);
        $newData = array();
        foreach($params['alldata'] as $datas){
            $newData[$datas['name']] = $datas['value'];           
            
        }
        $task = 'T';
        $data = $this->_request->getPost();
        if(!empty($newData['equipmentname'])){
            $newData['id'] = $data['id'];
            $pmwoHistoryDetails = $pmTemplate->sortPmWorkorderHistoryDetailByWO($select_build_id,$task,$newData);
        } else {
            $pmwoHistoryDetails = $pmTemplate->sortPmWorkorderHistoryDetailByWO($select_build_id,$task,$data);
        }        
        
        $pmHistoryNotes = $pmTemplate->getPmWoNotes($select_build_id);
        
        $this->view->taskReading = $taskReading;
        $this->view->companyListing = $companyListing;
        $this->view->select_build_id = $select_build_id;
        $pmEquipmentName = $pmTemplate->getallEquipmentNameByBuildId($select_build_id);
        $this->view->pmEquipmentName = $pmEquipmentName;
        $this->view->pmwoHistoryDetails = $pmwoHistoryDetails;
        $this->view->userId = $user_id;
        $this->view->pmHistoryNotes = $pmHistoryNotes;
        $this->_helper->viewRenderer('sortpmhistorybyworkorder');
        
    }
    
    public function sortpmhistoryreadingbyworkorderAction(){
        $params = $this->_request->getParams();
        $this->_helper->layout()->disableLayout();
        $pmTemplate =  new Model_PmTemplate();
        $user_id = $_SESSION['Zend_Auth']['storage']->uid;
        $cust_id = $_SESSION['Zend_Auth']['storage']->cust_id;
        $role_id = $_SESSION['Zend_Auth']['storage']->role_id;
        $companyListing = '';
        $buildingMapper = new Model_Building();
        $rModel = new Model_Report();
        if ($role_id == '9') {
            $companyListing = $buildingMapper->getCompanyBuilding($cust_id);
        } else {
            $user_build_mod = new Model_UserBuildingModule();

            $buildinglists = $user_build_mod->getUserBuildingIds($user_id);
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
        if (empty($build_ID) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds))) {
            $build_ID = $_COOKIE['build_cookie'];
        } else {
            setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");
        }

        if ($companyListing != '') {
            if ($build_ID != '')
                $select_build_id = $build_ID;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }

        $_SESSION['current_building'] = $select_build_id;
        
        //$taskReading = $pmTemplate->getTaskReading($select_build_id);
        
        $newData = array();
        foreach($params['alldata'] as $datas){
            $newData[$datas['name']] = $datas['value'];           
            
        }
        $reading = 'R';
        $data = $this->_request->getPost();
        if(!empty($newData['equipmentname'])){
            $newData['id'] = $data['id'];
            $pmwoHistoryDetails = $pmTemplate->sortPmWorkorderHistoryReadingDetailByWO($select_build_id,$reading,$newData);            
        } else {
            $pmwoHistoryDetails = $pmTemplate->sortPmWorkorderHistoryReadingDetailByWO($select_build_id,$reading,$data);
        }
        
        
        $pmHistoryNotes = $pmTemplate->getPmWoNotes($select_build_id);
        
        $this->view->taskReading = $taskReading;
        $this->view->companyListing = $companyListing;
        $this->view->select_build_id = $select_build_id;
        $pmEquipmentName = $pmTemplate->getallEquipmentNameByBuildId($select_build_id);
        $this->view->pmEquipmentName = $pmEquipmentName;
        $this->view->pmwoHistoryDetails = $pmwoHistoryDetails;
        $this->view->userId = $user_id;
        $this->view->pmHistoryNotes = $pmHistoryNotes;
        $this->_helper->viewRenderer('sortpmhistoryreadingbyworkorder');
        
    }
    
}    
