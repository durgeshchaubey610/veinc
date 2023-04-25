<?php

class CompleteController extends Ve_Controller_Base {

    public function init() {
        parent::init();
        $this->_helper->layout()->setLayout('newlayout');
        $this->accessHelper = $this->_helper->access;
        $this->closewo_location = 4;
    }

    // Call befor any action and check is user login or not
    public function preDispatch() {
        if (!Zend_Auth::getInstance()->hasIdentity())
            $this->_redirect('/index');
        $level = (Zend_Auth::getInstance()->getStorage()->read()) ? Zend_Auth::getInstance()->getStorage()->read()->role_id : '';
        $this->userId = Zend_Auth::getInstance()->getStorage()->read()->uid;
        $this->roleId = Zend_Auth::getInstance()->getStorage()->read()->role_id;
        $this->cust_id = Zend_Auth::getInstance()->getStorage()->read()->cust_id;
    }

    public function workorderAction() {
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

        $wnum = $this->_getParam('wnum', '');

        $build_ID = $this->_getParam('bid', '');
        $select_build_id = $build_ID;
        /*         * *******set building in cookie ********* */
        $buildIds = array();
        foreach ($companyListing as $cl) {
            $buildIds[] = $cl['build_id'];
        }

        if (empty($select_build_id) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds)))
            $select_build_id = $_COOKIE['build_cookie'];
        else
            $set_cookie = setcookie('build_cookie', $select_build_id, time() + (86400 / 24), "/");

        if ($companyListing != '') {
            if ($select_build_id != '')
                $select_build_id = $select_build_id;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }

        $woModel = new Model_WorkOrder();
        $msg = '';
        $this->view->woData = '';
        if ($wnum != '' && $build_ID != '') {
            $wnData = $woModel->getWoIdByNoNBId($wnum, $build_ID);

            if ($wnData) {
                $woId = $wnData[0]['woId'];
                $woData = $woModel->getWorkOrderInfo($woId);
                //var_dump($woData);			
                //exit;
                $this->view->woData = ($woData) ? $woData[0] : $woData;
            } else
                $msg = 'Invalid Work Order Number Or Building Id';
        } else
            $msg = 'Enter Work Order No.';

        $this->view->msg = $msg;
        $this->view->custID = $this->cust_id;
        $this->view->companyListing = $companyListing;
        $this->view->select_build_id = $select_build_id;
        $this->view->wnum = $wnum;
        $this->view->roleId = $this->roleId;
        $this->view->userId = $this->userId;
        $this->view->acessHelper = $this->accessHelper;
        $this->view->closewo_location = $this->closewo_location;
        $this->view->userId = $this->userId;
        $adminNamespace = new Zend_Session_Namespace('Admin_User');
        $this->view->admin_role_id = $adminNamespace->role_id;
    }
    
    
    public function reloadworkorderAction() {
         $this->_helper->layout()->disableLayout();
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

        $wnum = $this->_getParam('wnum', '');

        $build_ID = $this->_getParam('bid', '');
        $select_build_id = $build_ID;
        /*         * *******set building in cookie ********* */
        $buildIds = array();
        foreach ($companyListing as $cl) {
            $buildIds[] = $cl['build_id'];
        }

        if (empty($select_build_id) && (isset($_COOKIE['build_cookie']) && in_array($_COOKIE['build_cookie'], $buildIds)))
            $select_build_id = $_COOKIE['build_cookie'];
        else
            $set_cookie = setcookie('build_cookie', $select_build_id, time() + (86400 / 24), "/");

        if ($companyListing != '') {
            if ($select_build_id != '')
                $select_build_id = $select_build_id;
            else
                $select_build_id = $companyListing[0]['build_id'];
        }

        $woModel = new Model_WorkOrder();
        $msg = '';
        $this->view->woData = '';
        if ($wnum != '' && $build_ID != '') {
            $wnData = $woModel->getWoIdByNoNBId($wnum, $build_ID);

            if ($wnData) {
                $woId = $wnData[0]['woId'];
                $woData = $woModel->getWorkOrderInfo($woId);
                //var_dump($woData);			
                //exit;
                $this->view->woData = ($woData) ? $woData[0] : $woData;
            } else
                $msg = 'Invalid Work Order Number Or Building Id';
        } else
            $msg = 'Enter Work Order No.';

        $this->view->msg = $msg;
        $this->view->custID = $this->cust_id;
        $this->view->companyListing = $companyListing;
        $this->view->select_build_id = $select_build_id;
        $this->view->wnum = $wnum;
        $this->view->roleId = $this->roleId;
        $this->view->userId = $this->userId;
        $this->view->acessHelper = $this->accessHelper;
        $this->view->closewo_location = $this->closewo_location;
        $this->view->userId = $this->userId;
        $adminNamespace = new Zend_Session_Namespace('Admin_User');
        $this->view->admin_role_id = $adminNamespace->role_id;
    }
    

// end of work report

    public function showeditwoAction() {
        $this->_helper->layout()->disableLayout();
        $woId = $this->_getParam('woId', '');
        $woModel = new Model_WorkOrder();
        $this->view->woData = '';
        if ($woId != '') {
            $woData = $woModel->getWorkOrderInfo($woId);
            $this->view->woData = $woData[0];
        } else {
            echo 'Error occurred to open show edit';
            exit(0);
        }
    }

// end of show edit wo

    public function showtuserAction() {
        $this->_helper->layout()->disableLayout();
        $tId = $this->_getParam('tId', '');
        if ($tId != '') {
            $tuserModel = new Model_TenantUser();
            $tuserList = $tuserModel->getTenantUsers($tId);
            $this->view->tuserList = $tuserList;
        } else {
            echo 'Error Occurred';
            exit(0);
        }
    }

    /** end of show tenant user * */
    public function tuserinfoAction() {
        $tuid = $this->_getParam('tuid', '');
        $message = '';
        $userData = '';
        if ($tuid != '') {
            $tuserModel = new Model_TenantUser();
            $tuserinfo = $tuserModel->getTenantUserById($tuid);
            if ($tuserinfo) {
                $tuData = $tuserinfo[0];
                $userData = array(
                    'suite' => $tuData->suite_location,
                    'email' => $tuData->email,
                    'phone' => $tuData->phoneNumber
                );
                $message = 'success';
            } else {
                $message = 'error';
            }
        }
        echo json_encode(array('message' => $message, 'userData' => $userData));
        exit(0);
    }

    public function updatewoinfoAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            //print_r($data);
            if ($data['tenant'] == '' || $data['date_received'] == '' || $data['time_received'] == '' || $data['create_user'] == '' || $data['wo_request'] == "") {
                echo 'error';
                exit(0);
            } else {
                $woModel = new Model_WorkOrder();
                $workOrder = $woModel->getWorkOrder($data['woId']);
                $this->setTimezone($workOrder[0]['building']);
                $updateData = array();
                $updateData['tenant'] = $data['tenant'];
                $updateData['create_user'] = $data['create_user'];
                $updateData['date_requested'] = date('Y-m-d', strtotime($data['date_received']));
                $updateData['time_requested'] = $data['time_received'];
                $updateData['work_order_request'] = $data['wo_request'];
                $updateData['category'] = $data['category'];
                if ($data['status'] == 1) {
                    $updateData['category'] = $data['category'];
                    $whlModel = new Model_WoHistoryLog();
                    $whData = array();
                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'category';
                    $whData['current_value'] = $data['curr_cat'];
                    $whData['change_value'] = $data['category'];
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $whData['user_id'] = $this->userId;
                    $insertWHL = $whlModel->insertHistoryLog($whData);
                }
                try {
                    $woModel = new Model_WorkOrder();
                    $whlModel = new Model_WoHistoryLog();
                    $wocurrentlog = $whlModel->getWoCurrentLog($data['woId']);
                    $updateWo = $woModel->updateWorkOrder($updateData, $data['woId']);
                    /*                     * *******History Log ******** */

                    $whData2 = array();
                    $whData2['woId'] = $data['woId'];
                    $whData2['log_type'] = 'work order';
                    $whData2['current_value'] = json_encode($wocurrentlog[0]);
                    $whData2['change_value'] = json_encode($data);
                    $whData2['created_at'] = date('Y-m-d H:i:s');
                    $whData2['user_id'] = $this->userId;
                    $insertWHL = $whlModel->insertHistoryLog($whData2);

                    echo 'success';
                } catch (Exception $e) {
                    //echo $e->getMessage();
                    echo 'error';
                }
            }
        }
        exit(0);
    }

    /** end of work order info  * */
    public function woparameterAction() {
        $this->_helper->layout()->disableLayout();
        $bId = $this->_getParam('bId', '');
        $wpModel = new Model_WoParameter();
        $wpData = '';
        if ($bId != '') {
            $wpDetails = $wpModel->getWoParameterByBid($bId);
            $wpData = ($wpDetails) ? $wpDetails[0] : '';
        }
        $this->view->bId = $bId;
        $this->view->wpData = $wpData;
    }

    /** end of show wo parameter * */
    public function updateparameterAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            //print_r($data);
            try {
                $wpModel = new Model_WoParameter();
                $wpDetails = $wpModel->getWoParameterByBid($data['building']);
                $wpId = ($wpDetails) ? $wpDetails[0]['wpId'] : '0';
                if ($wpId != '0') {
                    $updateData = $wpModel->updateWoParameter($data, $wpId);
                } else {
                    $insertData = $wpModel->insertWoParameter($data);
                }
                echo 'success';
            } catch (Exception $e) {
                echo 'error';
            }
        }
        exit(0);
    }

    /** end of update wo parameter * */
    public function showdescAction() {
        $this->_helper->layout()->disableLayout();
        $woId = $this->_getParam('woId', '');
        $wdModel = new Model_WorkDescription();
        $wdData = '';
        if ($woId != '') {
            $wpDetails = $wdModel->getDescByWoId($woId);
            $wdData = ($wpDetails) ? $wpDetails[0] : '';
        }
        $noteModel = new Model_Notes();
        $this->view->noteList = $noteModel->getNotesByCustId($this->cust_id);
        $this->view->woId = $woId;
        $this->view->wdData = $wdData;
    }

// close show description 

    public function savedescriptionAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['description'] == '') {
                echo 'error';
                exit(0);
            }
            //print_r($data);3
            
            try {
                $woModel = new Model_WorkOrder();
                $workOrder = $woModel->getWorkOrder($data['woId']);
                $this->setTimezone($workOrder[0]['building']);
                $data['description'] = addslashes($data['description']);
                $wdModel = new Model_WorkDescription();
                $wpDetails = $wdModel->getDescByWoId($data['woId']);
                $id = ($wpDetails) ? $wpDetails[0]['id'] : '0';
                $whlModel = new Model_WoHistoryLog();
                $current_details_value = $whlModel->getWoHistoryLogByLog($data['woId'], 'Description of Work', $this->userId);
                $whData = array();
                $whData['woId'] = $data['woId'];
                $whData['log_type'] = 'Description of Work';
                if ($id != '0') {
                    $whData['current_value'] = ($current_details_value[0]['change_value'] != Null) ? $current_details_value[0]['change_value'] : '';
                } else {
                    $whData['current_value'] = '';
                }

                $whData['change_value'] = json_encode($data);
                $whData['user_id'] = $this->userId;
                $whData['created_at'] = date('Y-m-d H:i:s');
                $insertWHL = $whlModel->insertHistoryLog($whData);
                if ($id != '0') {
                    $updateData = $wdModel->updateDescription($data, $id);
                } else {
                    $insertData = $wdModel->insertDescription($data);
                }
                echo 'success';
            } catch (Exception $e) {
                echo 'error';
            }
        }
        exit(0);
    }

// close save description

    public function laborformAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $this->view->woId = $data['woId'];       
        $date_in = $data['date_in'].' '.$data['time_in'];
        $date_out = $data['date_out'] . ' '.$data['time_out'];
        $this->view->date_in =$date_in;
        $this->view->date_out =$date_out;
        $to_time = strtotime($date_in);
        $from_time = strtotime($date_out);
        $minuts= round(abs($to_time - $from_time) / 60,2);
        $hours = floor($minuts / 60);
        $minutes = ($minuts % 60);
        
        //$num_padded = sprintf("%02d", $l_days);
        $showtime=sprintf("%02d", $hours) .':'.sprintf("%02d", $minutes);
        $wpModel = new Model_WoParameter();
	$wpDetails = $wpModel->getWoParameterByBid($data['bId']);
        //print_r($wpDetails);
        $default=0;
        //echo $wpDetails[0]['time_min_charge'];
        $Tmc=explode(" ",$wpDetails[0]['time_min_charge']);
        if($Tmc[1]=='Minutes'){
              $time="00:".$Tmc[0];
            if($Tmc[0] > $minuts){
                $default=1;
            }else{
                $default=0;
            }
        }else{
             $time=$Tmc[0].":00";
            if($Tmc[0] > $hours){
                $default=1;
            }else{
                $default=0;
            }
        }
       
        if($default==1)
            $this->view->job_time=$time;
        else{
            $this->view->job_time=$showtime;
        }
       

    }

// close add labor form

    public function savelaborAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            $message = array();
            $current_details_value = '';
            if ($data['emp_id'] == '' || $data['charge_hour'] == '' || $data['rate_charge'] == '' || $data['job_time'] == '') {
                $message['status'] = 'error';
                $message['msg'] = 'Fill the Form Properly';
            } else {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    $this->setTimezone($workOrder[0]['building']);
                    $laborModel = new Model_Labor();
                    //print_r($data);
                    $whlModel = new Model_WoHistoryLog();
                    if (isset($data['lid']) && $data['lid'] != '') {
                        $current_details_value = $whlModel->getWoHistoryLogByLabor($data['lid']);
                        $current_details_value = json_encode($current_details_value[0]);
                        $updateLabor = $laborModel->updateLabor($data, $data['lid']);
                    } else {
                        $insertData = $laborModel->insertLabor($data);
                    }



                    $whData = array();

                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'Labor';
                    if (isset($data['lid']) && $data['lid'] != '') {
                        $whData['current_value'] = $current_details_value;
                    } else {
                        $whData['current_value'] = '';
                    }
                    if (isset($insertData)) {
                        $data['lid'] = $insertData;
                    }
                    $whData['change_value'] = json_encode($data);
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $whData['user_id'] = $this->userId;
                    $insertWHL = $whlModel->insertHistoryLog($whData);

                    $message['status'] = 'success';
                    $message['msg'] = 'Labor data has been saved successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error Occurred during the save labor data';
                }
            }
        } else {
            $message['status'] = 'error';
            $message['msg'] = 'Error Occurred during the save labor data';
        }
        echo json_encode($message);
        exit(0);
    }

// close save labor charge data

    public function editlaborAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $this->view->lid = $data['lid'];
        if ($data['lid'] != '') {
            $laborModel = new Model_Labor();
            $this->view->laborData = $laborModel->getLabor($data['lid']);
        } else {
            echo 'Invalid data';
            exit(0);
        }
    }

// close edit labor form

    public function editlabortempAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->indexNumber = $data['indexNumber'];
        $this->view->savelaborArray = $data['savelaborArray'];
        if ($data['indexNumber'] != '') {
            
        } else {
            echo 'Invalid data';
            exit(0);
        }
    }

// close edit labor form

    public function deletelaborAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['lid'] != '') {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    $this->setTimezone($workOrder[0]['building']);
                    $whlModel = new Model_WoHistoryLog();
                    $whData = array();
                    $current_details_value = $whlModel->getWoHistoryLogByLabor($data['lid']);
                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'Labor';
                    $whData['current_value'] = json_encode($current_details_value[0]);
                    $whData['change_value'] = '';
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $whData['user_id'] = $this->userId;
                    $insertWHL = $whlModel->insertHistoryLog($whData);
                    $laborModel = new Model_Labor();
                    $deleteLabor = $laborModel->deleteLabor($data['lid']);
                    echo 'true';
                } catch (Exception $e) {
                    echo 'false';
                }
            }
        }
        exit(0);
    }

// close delete labor charge

    public function addbserviceAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $this->view->woId = $data['woId'];
    }

// close add building service form

    public function savebuildingserviceAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            $message = array();
            $current_details_value = '';
            if ($data['service'] == '' || $data['charge'] == '' || $data['amount_requested'] == '') {
                $message['status'] = 'error';
                $message['msg'] = 'Fill the Form Properly';
            } else {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    $this->setTimezone($workOrder[0]['building']);
                    $data['comment'] = addslashes($data['comment']);
                    $bserviceModel = new Model_BuildingService();
                    $whlModel = new Model_WoHistoryLog();
                    if (isset($data['bsId']) && $data['bsId'] != '') {
                        $current_details_value = $whlModel->getWoHistoryLogByBuilding($data['bsId']);
                        $current_details_value = json_encode($current_details_value[0]);
                        $updateBuildingService = $bserviceModel->updateBuildingService($data, $data['bsId']);
                    } else {
                        $insertData = $bserviceModel->insertBuildingService($data);
                    }


                    $whData = array();

                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'building services';
                    if (isset($data['bsId']) && $data['bsId'] != '') {
                        $whData['current_value'] = $current_details_value;
                    } else {
                        $whData['current_value'] = '';
                    }
                    if (isset($insertData)) {
                        $data['bsId'] = $insertData;
                    }
                    $whData['change_value'] = json_encode($data);
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $whData['user_id'] = $this->userId;
                    $insertWHL = $whlModel->insertHistoryLog($whData);

                    $message['status'] = 'success';
                    $message['msg'] = 'Building Service Charge has been saved successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error Occurred during the save building service charge';
                }
            }
        } else {
            $message['status'] = 'error';
            $message['msg'] = 'Error Occurred during the save building service charge';
        }
        echo json_encode($message);
        exit(0);
    }

// close save labor charge data

    public function editbserviceAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $this->view->bsId = $data['bsId'];
        if ($data['bsId'] != '') {
            $bserviceModel = new Model_BuildingService();
            $this->view->bserviceData = $bserviceModel->getBuildingService($data['bsId']);
        } else {
            echo 'Invalid data';
            exit(0);
        }
    }

// close edit building service form

    public function editbservicetempAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->index = $data['index'];
        $this->view->bserviceData = $data['saveBServiceDataArray'];
        $this->view->bId = $data['bId'];
        if ($data['index'] != '') {
            
        } else {
            echo 'Invalid data';
            exit(0);
        }
    }

    public function deletebuildingserviceAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['bsId'] != '') {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    $this->setTimezone($workOrder[0]['building']);
                    $whlModel = new Model_WoHistoryLog();
                    $whData = array();
                    $current_details_value = $whlModel->getWoHistoryLogByBuilding($data['bsId']);
                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'building services';
                    $whData['current_value'] = json_encode($current_details_value[0]);
                    $whData['change_value'] = '';
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $whData['user_id'] = $this->userId;
                    $insertWHL = $whlModel->insertHistoryLog($whData);
                    $bserviceModel = new Model_BuildingService();
                    $deleteBuildingService = $bserviceModel->deleteBuildingService($data['bsId']);
                    echo 'true';
                } catch (Exception $e) {
                    echo 'false';
                }
            }
        }
        exit(0);
    }

// close delete labor charge

    public function addmaterialAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $this->view->woId = $data['woId'];
    }

// close add material charge form

    public function savematerialAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            $message = array();
            $current_details_value = '';
            if ($data['material_id'] == '' || $data['cost'] == '' || $data['cost'] == '0' || $data['markup'] == '' || $data['quantity'] == '' || $data['quantity'] == '0') {
                $message['status'] = 'error';
                $message['msg'] = 'Fill the Form Properly';
            } else {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    $this->setTimezone($workOrder[0]['building']);
                    $mcModel = new Model_MaterialCharge();
                    $whlModel = new Model_WoHistoryLog();
                    if (isset($data['mcId']) && $data['mcId'] != '') {
                        $current_details_value = $whlModel->getWoHistoryLogByMaterial($data['mcId']);
                        $updateMaterial = $mcModel->updateMaterialCharge($data, $data['mcId']);
                        $current_details_value = json_encode($current_details_value[0]);
                    } else {
                        $insertData = $mcModel->insertMaterialCharge($data);
                    }

                    $whData = array();
                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'materials';
                    if (isset($data['mcId']) && $data['mcId'] != '') {
                        $whData['current_value'] = $current_details_value;
                    } else {
                        $whData['current_value'] = '';
                    }

                    if (isset($insertData)) {
                        $data['mcId'] = $insertData;
                    }
                    $whData['change_value'] = json_encode($data);
                    $whData['user_id'] = $this->userId;
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $insertWHL = $whlModel->insertHistoryLog($whData);

                    $message['status'] = 'success';
                    $message['msg'] = 'Material Charge has been saved successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error Occurred during the save material charge';
                }
            }
        } else {
            $message['status'] = 'error';
            $message['msg'] = 'Error Occurred during the save material charge';
        }
        echo json_encode($message);
        exit(0);
    }

// close save material charge data

    public function editmaterialAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $this->view->mcId = $data['mcId'];
        if ($data['mcId'] != '') {
            $mcModel = new Model_MaterialCharge();
            $this->view->materialData = $mcModel->getMaterialCharge($data['mcId']);
        } else {
            echo 'Invalid data';
            exit(0);
        }
    }

// close edit material charge form

    public function editmaterialtempAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $this->view->index = $data['index'];
        $this->view->materialData = $data['savematerialArray'];
        if ($data['index'] != '') {
            
        } else {
            echo 'Invalid data';
            exit(0);
        }
    }

    public function deletematerialAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['mcId'] != '') {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    $this->setTimezone($workOrder[0]['building']);
                    $whlModel = new Model_WoHistoryLog();
                    $whData = array();
                    $current_details_value = $whlModel->getWoHistoryLogByMaterial($data['mcId']);
                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'materials';
                    $whData['current_value'] = json_encode($current_details_value[0]);
                    $whData['change_value'] = '';
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $whData['user_id'] = $this->userId;
                    $insertWHL = $whlModel->insertHistoryLog($whData);
                    $mcModel = new Model_MaterialCharge();
                    $deleteMaterial = $mcModel->deleteMaterialCharge($data['mcId']);
                    echo 'true';
                } catch (Exception $e) {
                    echo 'false';
                }
            }
        }
        exit(0);
    }

// close delete material

    public function addoutsideAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $this->view->woId = $data['woId'];
    }

    /* close add material charge form */

    public function saveoutsideAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            $message = array();
            $current_details_value = '';
            if ($data['vendor'] == '' || $data['job_cost'] == '' || $data['job_cost'] == '0' || $data['markup'] == '') {
                $message['status'] = 'error';
                $message['msg'] = 'Fill the Form Properly';
            } else {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    $this->setTimezone($workOrder[0]['building']);
                    $osModel = new Model_OutsideService();
                    $whlModel = new Model_WoHistoryLog();
                    if (isset($data['osId']) && $data['osId'] != '') {
                        $current_details_value = $whlModel->getWoHistoryLogByOutside($data['osId']);
                        $current_details_value = json_encode($current_details_value[0]);
                        $updateOutSide = $osModel->updateOutsideService($data, $data['osId']);
                    } else {
                        $insertData = $osModel->insertOutsideService($data);
                    }

                    $whData = array();

                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'outside service';
                    if (isset($data['osId']) && $data['osId'] != '') {
                        $whData['current_value'] = $current_details_value;
                    } else {
                        $whData['current_value'] = '';
                    }
                    if (isset($insertData)) {
                        $data['osId'] = $insertData;
                    }
                    $whData['change_value'] = json_encode($data);
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $whData['user_id'] = $this->userId;
                    $insertWHL = $whlModel->insertHistoryLog($whData);

                    $message['status'] = 'success';
                    $message['msg'] = 'Outside service Charge has been saved successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error Occurred during the save outside service charge';
                }
            }
        } else {
            $message['status'] = 'error';
            $message['msg'] = 'Error Occurred during the save outside service charge';
        }
        echo json_encode($message);
        exit(0);
    }

    /* close save outside service data */

    public function editoutsideAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $this->view->osId = $data['osId'];
        if ($data['osId'] != '') {
            $osModel = new Model_OutsideService();
            $this->view->outsideData = $osModel->getOutsideService($data['osId']);
        } else {
            echo 'Invalid data';
            exit(0);
        }
    }

    /* close edit outside service form */

    public function editoutsidetempAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $this->view->index = $data['index'];
        $this->view->outsideData = $data['saveoutsideArray'];
        if ($data['index'] != '') {
            
        } else {
            echo 'Invalid data';
            exit(0);
        }
    }

    public function deleteoutsideAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['osId'] != '') {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    $this->setTimezone($workOrder[0]['building']);
                    $whlModel = new Model_WoHistoryLog();
                    $whData = array();
                    $current_details_value = $whlModel->getWoHistoryLogByOutside($data['osId']);
                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'outside service';
                    $whData['current_value'] = json_encode($current_details_value[0]);
                    $whData['change_value'] = '';
                    $whData['user_id'] = $this->userId;
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $insertWHL = $whlModel->insertHistoryLog($whData);
                    $osModel = new Model_OutsideService();
                    $deleteOutside = $osModel->deleteOutsideService($data['osId']);
                    echo 'true';
                } catch (Exception $e) {
                    echo 'false';
                }
            }
        }
        exit(0);
    }

    /* close delete outside service */

    public function addnoteAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->woId = $data['woId'];
    }

    /* close add note form */

    public function savenoteAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if (isset($data['notify_tenant'])) {
                $notify_tenant = $data['notify_tenant'];
                unset($data['notify_tenant']);
            }
            if (isset($data['notify_account_user'])) {
                $notify_account_user = $data['notify_account_user'];
                unset($data['notify_account_user']);
            }


            $message = array();
            $current_details_value = '';
            if ($data['note_date'] == '' || $data['note'] == '') {
                $message['status'] = 'error';
                $message['msg'] = 'Fill the Form Properly';
            } else {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    //print_r($workOrder[0]['create_user']);

                    $this->setTimezone($workOrder[0]['building']);
                    $wnModel = new Model_WoNote();
                    $whlModel = new Model_WoHistoryLog();

                    $data['note_date'] = date('Y-m-d', strtotime($data['note_date']));
                    if (isset($data['wnId']) && $data['wnId'] != '') {
                        $current_details_value = $whlModel->getWoHistoryLogByNotes($data['wnId']);
                        $current_details_value = json_encode($current_details_value[0]);
                        $updateNote = $wnModel->updateWoNote($data, $data['wnId']);
                    } else {
                        $data['user_id'] = $this->userId;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $insertData = $wnModel->insertWoNote($data);
                        $tenantMapper = new Model_Tenant();
                        $tenantDetail = $tenantMapper->getTenantById($workOrder[0]['tenant']);
                        $tenantInfo = $tenantDetail[0];
                        ;
                        $tenantData = (array) $tenantInfo;
                        $tenantData['tenantId'] = $tenantData ['id'];
                        $tenantData['note_created_user'] = $workOrder[0]['create_user'];
                        if (isset($insertData) && $insertData != 0) {
                            $tenantData['note_insert_id'] = $insertData;
                            $tenantData['login_roleId'] = $this->roleId;
                            $tenantData['login_userId'] = $this->userId;
                        }
                        if ($notify_tenant == 1) {
                            $sendmail = $woModel->sendEmailToTenant($data['woId'], $tenantData);
                        }
                        if ($notify_account_user == 1) {
                            $sendmail = $woModel->sendEmailToAccountUsers($data['woId'], $tenantData);
                        }
                    }

                    $whData = array();

                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'notes';
                    if (isset($data['wnId']) && $data['wnId'] != '') {
                        $whData['current_value'] = $current_details_value;
                    } else {
                        $whData['current_value'] = '';
                    }
                    if (isset($insertData)) {
                        $data['wnId'] = $insertData;
                    }
                    $whData['change_value'] = json_encode($data);
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $whData['user_id'] = $this->userId;
                    $insertWHL = $whlModel->insertHistoryLog($whData);



                    $message['status'] = 'success';
                    $message['msg'] = 'Note has been saved successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error Occurred during the save note';
                }
            }
        } else {
            $message['status'] = 'error';
            $message['msg'] = 'Error Occurred during the save note';
        }
        echo json_encode($message);
        exit(0);
    }

    /* close save outside service data */

    public function editnoteAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->wnId = $data['wnId'];
        if ($data['wnId'] != '') {
            $wnModel = new Model_WoNote();
            $this->view->wnData = $wnModel->getWoNote($data['wnId']);
        } else {
            echo 'Invalid data';
            exit(0);
        }
    }

    /* close edit note form */

    public function editnotetempAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->index = $data['index'];
        $this->view->wnData = $data['savenoteArray'];
        if ($data['index'] != '') {
            
        } else {
            echo 'Invalid data';
            exit(0);
        }
    }

    public function deletenoteAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['wnId'] != '') {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    $this->setTimezone($workOrder[0]['building']);
                    $whlModel = new Model_WoHistoryLog();
                    $whData = array();
                    $current_details_value = $whlModel->getWoHistoryLogByNotes($data['wnId']);
                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'notes';
                    $whData['current_value'] = json_encode($current_details_value[0]);
                    $whData['change_value'] = '';
                    $whData['user_id'] = $this->userId;
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $insertWHL = $whlModel->insertHistoryLog($whData);

                    $wnModel = new Model_WoNote();
                    $deleteNote = $wnModel->deleteWoNote($data['wnId']);
                    echo 'true';
                } catch (Exception $e) {
                    echo 'false';
                }
            }
        }
        exit(0);
    }

    /* close delete note */

    public function addfileAction() {
        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->woId = $data['woId'];
        $this->view->bId = $data['bId'];
        $this->view->wnum = $data['wnum'];
    }

    /* close add file form */

    public function uploadfileAction() {
        if ($this->getRequest()->getMethod() == 'POST') {
            $data = $this->getRequest()->getPost();
            $wo_file = $_FILES['wo_file'];
            if ($data['file_title'] == '' || $wo_file['name'] == '' || !isset($wo_file['name'])) {
                $message['status'] = 'error';
                $message['msg'] = 'Fill the Form Properly';
            } else {
                if ($_FILES['wo_file']['name'] != '') {
                    $uploaddir = BASE_PATH . 'public/work_order/';
                    $uploadfile_name = 'WO-' . time() . '-' . basename($_FILES['wo_file']['name']);
                    $uploadfile = $uploaddir . '' . $uploadfile_name;
                    if (!file_exists($uploaddir)) {
                        mkdir($uploaddir, 0777, true);
                    }
                    move_uploaded_file($_FILES["wo_file"]["tmp_name"], $uploadfile);
                    $file_name = $uploadfile_name;
                    $insertData = array();
                    $insertData['woId'] = $data['woId'];
                    $insertData['file_title'] = $data['file_title'];
                    $insertData['file_name'] = $file_name;
                    try {
                        $fileModel = new Model_WoFiles();
                        $insertRecord = $fileModel->insertWoFile($insertData);
                        $message['status'] = 'success';
                        $message['msg'] = 'File uploaded successfully.';
                    } catch (Exception $e) {
                        $message['status'] = 'error';
                        $message['msg'] = 'Error occurred during upload file.';
                    }
                }
            }
            $this->_redirect('/complete/workorder/bid/' . $data['bId'] . '/wnum/' . $data['wnum']);
        }

        $this->_redirect('/complete/workorder');
        exit(0);
    }

    /*     * ********close of file upload section******* */

    public function uploadfilecompleteAction() {
        if ($this->getRequest()->getMethod() == 'POST') {
            $data = $this->getRequest()->getPost();
            $wo_file = $_FILES['wo_file'];
            if ($data['file_title'] == '' || $wo_file['name'] == '' || !isset($wo_file['name'])) {
                $message['status'] = 'error';
                $message['msg'] = 'Fill the Form Properly';
            } else {
                $filetype = array("application/pdf", "image/gif", "image/jpg", "image/jpeg", "image/png");

                if ($_FILES['wo_file']['name'] != '' && in_array($_FILES['wo_file']['type'], $filetype) && $_FILES['wo_file']['size'] < 5242880) {
                    $uploaddir = BASE_PATH . 'public/work_order/';
                    $uploadfile_name = 'WO-' . time() . '-' . basename($_FILES['wo_file']['name']);
                    $uploadfile = $uploaddir . '' . $uploadfile_name;
                    if (!file_exists($uploaddir)) {
                        mkdir($uploaddir, 0777, true);
                    }
                    move_uploaded_file($_FILES["wo_file"]["tmp_name"], $uploadfile);
                    $file_name = $uploadfile_name;
                    $insertData = array();
                    $insertData['woId'] = $data['woId'];
                    $insertData['file_title'] = $data['file_title'];
                    $insertData['file_name'] = $file_name;
                    try {
                        echo '<li id="' . time() . '"><input type="hidden" class="pfileupload" woId_id="' . $data['woId'] . '" flag_id="' . $data['file_title'] . '" value="' . $uploadfile_name . '" >';
                        echo '<span> <a target="_blank" href="' . BASEURL . 'public/work_order/' . $uploadfile_name . '">' . $data['file_title'] . '</a></span><a  class="close_bt_hide_cls" href="javascript:void(0)" onclick="deleteFilesTemp(' . time() . ')"><img src="' . BASEURL . 'public/images/delete.png"> </a></li>';
                        $fileModel = new Model_WoFiles();
                        //$insertRecord = $fileModel->insertWoFile($insertData);
                        $message['status'] = 'success';
                        $message['msg'] = 'File uploaded successfully.';
                    } catch (Exception $e) {
                        $message['status'] = 'error';
                        $message['msg'] = 'Error occurred during upload file.';
                    }
                }
            }
            //$this->_redirect('/complete/workorder/bid/'.$data['bId'].'/wnum/'.$data['wnum']); 	
        }

        //$this->_redirect('/complete/workorder');
        exit(0);
    }

    public function uploadfiledatabaseAction() {
        if ($this->getRequest()->getMethod() == 'POST') {
            $data = $this->getRequest()->getPost();
            if ($data['file_title'] == '' || $data['file_name'] == '' || $data['woId'] == '') {
                $message['status'] = 'error';
                $message['msg'] = 'Fill the Form Properly';
            } else {
                $woModel = new Model_WorkOrder();
                $workOrder = $woModel->getWorkOrder($data['woId']);
                $this->setTimezone($workOrder[0]['building']);
                $insertData = array();
                $insertData['woId'] = $data['woId'];
                $insertData['file_title'] = $data['file_title'];
                $insertData['file_name'] = $data['file_name'];
                try {
                    $fileModel = new Model_WoFiles();
                    $insertRecord = $fileModel->insertWoFile($insertData);
                    $whlModel = new Model_WoHistoryLog();
                    $whData = array();

                    $whData['woId'] = $data['woId'];
                    $whData['log_type'] = 'Attachment';
                    $whData['current_value'] = '';
                    $whData['change_value'] = json_encode($data);
                    $whData['user_id'] = $this->userId;
                    $whData['created_at'] = date('Y-m-d H:i:s');
                    $insertWHL = $whlModel->insertHistoryLog($whData);

                    $message['status'] = 'success';
                    $message['msg'] = 'File uploaded successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error occurred during upload file.';
                }
            }
        }

        exit(0);
    }

    public function deletefileAction() {
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost();
            if ($data['wfId'] != '') {
                try {
                    $woModel = new Model_WorkOrder();
                    $workOrder = $woModel->getWorkOrder($data['woId']);
                    $this->setTimezone($workOrder[0]['building']);
                    $fileModel = new Model_WoFiles();
                    $fileData = $fileModel->getWoFiles($data['wfId']);
                    if ($fileData) {
                        $uploaddir = BASE_PATH . 'public/work_order/';
                        $file_name = $fileData[0]['file_name'];
                        $uploadfile = $uploaddir . '' . $file_name;
                        if (file_exists($uploadfile)) {
                            unlink($uploadfile);
                        }
                        $deletefile = $fileModel->deleteWoFile($data['wfId']);
                        echo 'true';

                        $whlModel = new Model_WoHistoryLog();
                        $whData = array();

                        $whData['woId'] = $data['woId'];
                        $whData['log_type'] = 'Attachment';
                        $whData['current_value'] = json_encode($fileData[0]);
                        $whData['change_value'] = '';
                        $whData['user_id'] = $this->userId;
                        $whData['created_at'] = date('Y-m-d H:i:s');
                        $insertWHL = $whlModel->insertHistoryLog($whData);
                    } else
                        echo 'false';
                } catch (Exception $e) {
                    echo 'false';
                }
            }
        }
        exit(0);
    }

    /* close delete files */

    public function wocompleteAction() {
        $message = array();
        $billable_opt = $this->_getParam('billable_opt', 0);
        if ($this->getRequest()->isXmlHttpRequest() && $this->getRequest()->getMethod() == 'POST') {
            $data = $this->_request->getPost(); 
            $woId = $data['woId'];
            $woModel = new Model_WorkOrder();
            $workOrder = $woModel->getWorkOrder($woId);
            $this->setTimezone($workOrder[0]['building']);
            
           

            if ($data['date_cp_in'] == '' || $data['date_cp_out'] == '' || $data['time_in'] == '' || $data['time_out'] == '') {
                $message['status'] = 'error';
                $message['msg'] = 'Fill the Form Properly';
            } else {
                try {
                    $wcModel = new Model_WoComplete();
                    $data['date_cp_in'] = date('Y-m-d', strtotime($data['date_cp_in']));
                    $data['date_cp_out'] = date('Y-m-d', strtotime($data['date_cp_out']));
                    if ($data['wcId'] != '') {
                        $updateData = $wcModel->updateWoComplete($data, $data['wcId']);
                    } else {
                        unset($data['wcId']);
                        $insertData = $wcModel->insertWoComplete($data);
                    }
                    /*                     * ******* update work order status ******** */
                     
                    $status_changed = false;
                    
                    //print_r($currWo);
                    
                    $wpModel = new Model_WorkOrderUpdate();
                    $currWo = $wpModel->getCurrentWoUpdate($woId);
  
                    if ($currWo) {
                   
                        $curr_wo_status = $currWo[0]['wo_status'];
                        if ($curr_wo_status) {
                            $status_changed = true;

                            // checked and removed duplicate but keep lastest one.
                            $wpModel->removeDuplicate($woId);

                            $validateUpdateWordOrderStatus = $wpModel->checkWorkOrderStatusIsExists($woId, $data['wo_status']);
                            // reset work order update
                            //Start Validation for duplicate order status issue created by Dadhi On 31 March
                            if (empty($validateUpdateWordOrderStatus)) {
                                $resetCurrent = $wpModel->updateWorkOrderByWoId(array('current_update' => 0), $woId);
                                $wpData = array();
                                $wpData['wo_id'] = $woId;
                                $wpData['internal_note'] = '';
                                $wpData['wo_status'] = $data['wo_status'];
                                $wpData['current_update'] = 1;
                                $wpData['user_id'] = $this->userId;
                                $wpData['created_at'] = date('Y-m-d H:i:s');
                                //if ($data['wo_status'] == 7) {
                                $wpData['billable_opt'] = $billable_opt;
                                // }
                                $insertWp = $wpModel->insertWorkOrderUpdate($wpData);
                                //die("sanjay");
                                /*                             * *******History Log ******** */
                                $whlModel = new Model_WoHistoryLog();
                                $whData = array();
                                $whData['woId'] = $woId;
                                $whData['log_type'] = 'status';
                                $whData['current_value'] = $curr_wo_status;
                                $whData['change_value'] = $data['wo_status'];
                                $whData['created_at'] = date('Y-m-d H:i:s');
                                $whData['user_id'] = $this->userId;
                                $insertWHL = $whlModel->insertHistoryLog($whData);
                                if ($curr_wo_status == 1) {
                                    $this->sendOnlyBadge($woId);
                                }
                                // update work order schedule
                                $schModel = new Model_Schedule();
                                $schData = $schModel->getSchdeuleByCurrWoStatus($woId, $data['wo_status']);
                                if ($schData) {
                                    $wstModel = new Model_WoScheduleStatus();
                                    // fetch current status work order
                                    $wsDetail = $wstModel->getCurrentWs($woId);
                                    foreach ($wsDetail as $wsd) {
                                        $wsUpdate = $wstModel->updateWoSchedule(array('current_status' => 0), $wsd['wssId']);
                                    }
                                    $wss_data = array();
                                    $wss_data['worder_id'] = $woId;
                                    $wss_data['schedule_id'] = $schData[0]->id;
                                    $wss_data['priority_id'] = $schData[0]->priority_id;
                                    $wss_data['status'] = 1;
                                    //$wss_data['ckey']= md5(time());
                                    $wss_data['current_status'] = 1;
                                    $wss_data['created_at'] = date('Y-m-d H:i:s');
                                    $ws_insert = $wstModel->insertWoSchedule($wss_data);
                                }

                                /** ******work order status complete ****** */
                                if ($data['wo_status'] == '6') {
                                    /** *** description in complete **** */
                                    $desc = 'Printed out Badge and delivered to Tenant';
                                    $desc_arr = array('description' => $desc, 'woId' => $woId);
                                    $wdModel = new Model_WorkDescription();
                                    $wpDetails = $wdModel->getDescByWoId($woId);
                                    // print_R($wpDetails);
                                    //die;
                                    $id = !empty($wpDetails) ? $wpDetails[0]['id'] : '0';
                                    //echo $id;
                                    //die;
                                    if ($id == '0') {
                                        //$updateData = $wdModel->updateDescription($desc_arr, $id);
                                        $insertData = $wdModel->insertDescription($desc_arr);
                                    }
                                    /*else {
                                     $insertData = $wdModel->insertDescription($desc_arr);                                   
                                }*/


                                    $woData = $workOrder[0];
                                    $master_internal_work_order = $woData['master_internal_work_order'];
                                    $wpModel = new Model_WoParameter();
                                    $wpData = '';
                                    if ($woData['building'] != '') {
                                        $wpDetails = $wpModel->getWoParameterByBid($woData['building']);
                                        $wpData = ($wpDetails) ? $wpDetails[0] : '';
                                    }
                                    /*                                 * ***** sent email to tenant and account user ******* */
                                    if ($wpData['email_tenant'] == '1' && $master_internal_work_order != '1') {
                                        $sendTenantMail = $woModel->sendClosedNotification($woId, $this->userId, 'users');
                                    } else {
                                        $sendTenantMail = $woModel->sendClosedNotification($woId, $this->userId, 'users', 1);
                                    }
                                } else if ($data['wo_status'] == 7 && $curr_wo_status != 6) {

                                    $woModel = new Model_WorkOrder();
                                    $workOrder = $woModel->getWorkOrder($woId);
                                    $woData = $workOrder[0];
                                    $master_internal_work_order = $woData['master_internal_work_order'];
                                    $wpModel = new Model_WoParameter();
                                    $wpData = '';
                                    if ($woData['building'] != '') {
                                        $wpDetails = $wpModel->getWoParameterByBid($woData['building']);
                                        $wpData = ($wpDetails) ? $wpDetails[0] : '';
                                    }
                                    /*                                 * ***** sent email to tenant and account user ******* */
                                    if ($wpData['email_tenant'] == '1' && $master_internal_work_order != '1') {
                                        $sendTenantMail = $woModel->sendClosedNotification($woId, $this->userId, 'users');
                                    } else {
                                        $sendTenantMail = $woModel->sendClosedNotification($woId, $this->userId, 'users', 1);
                                    }
                                }
                            } else {
                                $updateStatus = false;
                                if($billable_opt != $currWo[0]['billable_opt']){
                                    $updateStatus = true;
                                }
                                if($data['wo_status'] != $currWo[0]['wo_status']){
                                    $updateStatus = true;
                                }
                                if ($updateStatus == true) {
                                    // update status and set as current
                                    $resetCurrent = $wpModel->updateWorkOrderByWoId(array('current_update' => 0), $woId);
                                    if (isset($validateUpdateWordOrderStatus[0]['upId']) && !empty($validateUpdateWordOrderStatus[0]['upId'])) {
                                        $whUpdtData = array();
                                        $whUpdtData['current_update'] = 1;
                                        $whUpdtData['updated_at'] = date('Y-m-d H:i:s');
                                        $whUpdtData['billable_opt'] = $billable_opt;

                                        $upId = $validateUpdateWordOrderStatus[0]['upId'];
                                        $wpModel->updateWorkOrderByUpId($whUpdtData, $upId);
                                        /*                             * *******History Log ******** */
                                        $whlModel = new Model_WoHistoryLog();
                                        $whData = array();
                                        $whData['woId'] = $woId;
                                        $whData['log_type'] = 'status';
                                        $whData['current_value'] = $curr_wo_status;
                                        $whData['change_value'] = $data['wo_status'];
                                        $whData['created_at'] = date('Y-m-d H:i:s');
                                        $whData['user_id'] = $this->userId;
                                        $insertWHL = $whlModel->insertHistoryLog($whData);
                                        if ($curr_wo_status == 1) {
                                            $this->sendOnlyBadge($woId);
                                        }
                                        // update work order schedule
                                        $schModel = new Model_Schedule();
                                        $schData = $schModel->getSchdeuleByCurrWoStatus($woId, $data['wo_status']);
                                        if ($schData) {
                                            $wstModel = new Model_WoScheduleStatus();
                                            // fetch current status work order
                                            $wsDetail = $wstModel->getCurrentWs($woId);
                                            foreach ($wsDetail as $wsd) {
                                                $wsUpdate = $wstModel->updateWoSchedule(array('current_status' => 0), $wsd['wssId']);
                                            }
                                            $wss_data = array();
                                            $wss_data['worder_id'] = $woId;
                                            $wss_data['schedule_id'] = $schData[0]->id;
                                            $wss_data['priority_id'] = $schData[0]->priority_id;
                                            $wss_data['status'] = 1;
                                            //$wss_data['ckey']= md5(time());
                                            $wss_data['current_status'] = 1;
                                            $wss_data['created_at'] = date('Y-m-d H:i:s');
                                            $ws_insert = $wstModel->insertWoSchedule($wss_data);
                                        }

                                        /** ******work order status complete ****** */
                                        if ($data['wo_status'] == '6') {
                                            /** *** description in complete **** */
                                            $desc = 'Printed out Badge and delivered to Tenant';
                                            $desc_arr = array('description' => $desc, 'woId' => $woId);
                                            $wdModel = new Model_WorkDescription();
                                            $wpDetails = $wdModel->getDescByWoId($woId);
                                            // print_R($wpDetails);
                                            //die;
                                            $id = !empty($wpDetails) ? $wpDetails[0]['id'] : '0';
                                            //echo $id;
                                            //die;
                                            if ($id == '0') {
                                                //$updateData = $wdModel->updateDescription($desc_arr, $id);
                                                $insertData = $wdModel->insertDescription($desc_arr);
                                            }
                                            /*else {
                                         $insertData = $wdModel->insertDescription($desc_arr);                                   
                                    }*/


                                            $woData = $workOrder[0];
                                            $master_internal_work_order = $woData['master_internal_work_order'];
                                            $wpModel = new Model_WoParameter();
                                            $wpData = '';
                                            if ($woData['building'] != '') {
                                                $wpDetails = $wpModel->getWoParameterByBid($woData['building']);
                                                $wpData = ($wpDetails) ? $wpDetails[0] : '';
                                            }
                                            /*                                 * ***** sent email to tenant and account user ******* */
                                            if ($wpData['email_tenant'] == '1' && $master_internal_work_order != '1') {
                                                $sendTenantMail = $woModel->sendClosedNotification($woId, $this->userId, 'users');
                                            } else {
                                                $sendTenantMail = $woModel->sendClosedNotification($woId, $this->userId, 'users', 1);
                                            }
                                        } else if ($data['wo_status'] == 7 && $curr_wo_status != 6) {

                                            $woModel = new Model_WorkOrder();
                                            $workOrder = $woModel->getWorkOrder($woId);
                                            $woData = $workOrder[0];
                                            $master_internal_work_order = $woData['master_internal_work_order'];
                                            $wpModel = new Model_WoParameter();
                                            $wpData = '';
                                            if ($woData['building'] != '') {
                                                $wpDetails = $wpModel->getWoParameterByBid($woData['building']);
                                                $wpData = ($wpDetails) ? $wpDetails[0] : '';
                                            }
                                            /*                                 * ***** sent email to tenant and account user ******* */
                                            if ($wpData['email_tenant'] == '1' && $master_internal_work_order != '1') {
                                                $sendTenantMail = $woModel->sendClosedNotification($woId, $this->userId, 'users');
                                            } else {
                                                $sendTenantMail = $woModel->sendClosedNotification($woId, $this->userId, 'users', 1);
                                            }
                                        }
                                        $message['status'] = 'success';
                                        $message['msg'] = 'Save changes successfully.';
                                    }
                                }

                                // if order status is already exit or go to reverse cases like closed to open
                                // case one when same order status are updated

                            }
                            $message['status'] = 'success';
                            $message['msg'] = 'Save changes successfully.';
                            //validate order status is not exist
                        } //current order 
                    }
                    $message['status'] = 'success';
                    $message['msg'] = 'Save changes successfully.';
                } catch (Exception $e) {
                    $message['status'] = 'error';
                    $message['msg'] = 'Error occurred.';
                }
            }
        } else {
            $message['status'] = 'error';
            $message['msg'] = 'Error Occurred during the save note';
        }
        echo json_encode($message);
        exit(0);
    }

    /*     * ******* close of wo complete ******** */

    public function sendOnlyBadge($woId) {

        $userMapper = new Model_User();
        $woModel = new Model_WorkOrder();
        $bid = $woModel->getBuildingbyworkorder($woId);
        $userData = $userMapper->getAllAccountUserOfBuilding($bid[0]->building);
        $userList = array();
        $androidPushIdList = array();
        $iosPushIdList = array();
        $status = array('1');
        $badges = array();
        if ($userData != '') {
            foreach ($userData as $userDataVal) {
                $userList[] = $userDataVal->uid;
                // Fetch all new work order of user
                $res = $woModel->getWorkorderbystatus($userDataVal->uid, $status);
                $badges[$userDataVal->uid] = $res[0]->count_workorder;
                // End Fetch new work order
            }
            $pushModel = new Model_PushNotification();
            $pushDetails = $pushModel->getPushId($userList);
            if ($pushDetails) {
                foreach ($pushDetails as $pushVal) {

                    // Start Android
                    if ($pushVal['device'] == 1) {
                        $registrationIds = $pushVal['push_id'];
                        $badgescount = $badges[$pushVal['user_id']];
                        //$pushModel->updatePushId(array('badges'=>$$badgescount), $registrationIds);
                        $msg = array
                            (
                            'sound' => 1,
                            'largeIcon' => 'small_icon',
                            'smallIcon' => 'small_icon',
                            'badge' => $badgescount,
                        );
                        $fields = array
                            (
                            'registration_ids' => array($registrationIds),
                            'data' => $msg,
                        );

                        $headers = array
                            (
                            'Authorization: key=' . API_ACCESS_KEY,
                            'Content-Type: application/json'
                        );
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                        $result = curl_exec($ch);

                        curl_close($ch);
                    }
                    // End Android
                    //Start IOS
                    if ($pushVal['device'] == 2) {

                      /*  $registrationIds = $pushVal['push_id'];
                        $tToken[0] = $registrationIds;
                        $badgescount = $badges[$pushVal['user_id']];
                        $tHost = T_HOST;
                        $tPort = 2195;
                        $tCert = PEM_URL.'ck2.pem';
                        $tPassphrase = '1choc3747*1';
                        //$tAlert = 'Category- '.$userDetails['categoryName'] .', Building- '.$userDetails['buildingName'];
                        $tBadge = intval($badgescount);

                        $tPayload = 'APNS Message Handled by LiveCode';
                        $tBody = array();
                        $tBody['aps'] = array('badge' => $tBadge,);
                        $tBody ['payload'] = $tPayload;
                        $tBody = json_encode($tBody);
                        $tContext = stream_context_create();
                        stream_context_set_option($tContext, 'ssl', 'local_cert', $tCert);
                        stream_context_set_option($tContext, 'ssl', 'passphrase', $tPassphrase);
                        $tSocket = stream_socket_client($tHost . ':' . $tPort, $error, $errstr, 30, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $tContext); */
                       // if (!$tSocket)
                        //    exit();
                        //exit ("APNS Connection Failed: $error $errstr" . PHP_EOL);


                       // $tMsg = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $tToken[0])) . pack('n', strlen($tBody)) . $tBody;
                       // $tResult = fwrite($tSocket, $tMsg, strlen($tMsg));

                        //if ($tResult)
                        //echo 'Delivered Message to APNS' . PHP_EOL;
                        //else
                        //echo 'Could not Deliver Message to APNS' . PHP_EOL;
// Close the Connection to the Server.
                        //fclose($tSocket);
                        //die;
                    }
                    // END IOS
                }
            }
        }
    }

    public function searchworkorderbyidAction() {
        $wpModel = new Model_WorkOrderUpdate();
        $query = $this->_request->getParams();
        $currWo = $wpModel->searchWorkOrderById($query['building_id'], $query['workorder']);
        //print_r($currWo );
        $result = array();
        $companyDetail = array();
        $i = 0;
        if ($currWo != '') {
            foreach ($currWo as $key => $value) {
                $result[$i]['wo_number'] = $value->wo_number;
                $result[$i]['wo_number'] = $value->wo_number;
                $i++;
            }

            if (!empty($currWo)) {
                foreach ($result as $key => $user) {
                    $companyDetail[$key]['label'] = '<span class="cnleft">' . $user['wo_number'] . '</span>';
                    $companyDetail[$key]['value'] = $user['wo_number'];
                }
                $header = array();
                $header['label'] = '<span class="cnleft"><strong>Work Order Number</strong></span>';
                $header['value'] = 'Work Order Number';
                array_unshift($companyDetail, $header);
            }
        }
        echo $query["callback"] . "(" . json_encode($companyDetail) . ")";
        exit(0);
    }

    /*     * ******* close of auto workorder list ******** */

    public function indexAction() {
        $this->tenant_location = 12;
        $this->_helper->layout()->setLayout('popuplayout');
        $companyListing = '';

        $tId = $this->_getParam('tId', 0);
        $build_ID = $this->_getParam('bid', '');
        if (empty($build_ID) && isset($_COOKIE['build_cookie']))
            $build_ID = $_COOKIE['build_cookie'];
        else
            $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");

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
        $showbatch = $this->_getParam('batch', '');
        $this->view->batch = $showbatch;
        $this->view->companyListing = $companyListing;
        $this->view->custID = $this->cust_id;
        $this->view->roleId = $this->roleId;
        $this->view->userId = $this->userId;

        $tenantList = '';
        $tenant = new Model_Tenant();


        if ($this->roleId == '5') {
            $tenantList = $tenant->getTenantById($this->userId);
            $this->view->select_build_id = $build_ID;
        } else {
            if ($build_ID != '') {
                $tenantList = $tenant->getTenantByBuildingId($build_ID);
                $this->view->select_build_id = $build_ID;
            } else {
                if ($companyListing != '') {
                    $tenantList = $tenant->getTenantByBuildingId($companyListing[0]['build_id']);
                    $this->view->select_build_id = $companyListing[0]['build_id'];
                }
            }
        }

        $this->view->acesshelper = $this->accessHelper;
        $this->view->tenant_location = $this->tenant_location;
        $this->view->tenantList = $tenantList;
        $this->view->tId = $tId;
        $this->view->bId = $build_ID;
        // Work Order
        $page = $this->_getParam('page', 0);
        $selectedBatch = new Zend_Session_Namespace('selectedBatch');
        if ($page == 0) {
            unset($selectedBatch->workorderid);
        }
        $this->view->selectedBatch = $selectedBatch->workorderid;
        $page = $this->_getParam('page', 1);
        $tid = $this->_getParam('tuid', '');
        $month = $this->_getParam('month', '');
        $year = $this->_getParam('year', '');
        $to = $this->_getParam('to', '');
        $from = $this->_getParam('from', '');
        $this->view->month = $month;
        $this->view->year = $year;
        $this->view->to = $to;
        $this->view->from = $from;
        $searchtodate = '';
        $searchfromdate = '';
        if ($year != '' && $month != '') {
            $searchtodate = $year . '-' . $month . '-' . '31';
            $searchfromdate = $year . '-' . $month . '-' . '01';
        }
        if ($from != '' && $to != '') {
            $searchtodate = $to;
            $searchfromdate = $from;
        }

        $woModel = new Model_WorkOrder();
        $select_build_id = $build_ID;
        $order = $this->_getParam('order', 'woId');
        $dir = $this->_getParam('dir', 'DESC');
        $lastbatch = new Zend_Session_Namespace('lastbatch');
        $lastbatch = $lastbatch->id;

        $search_array = array();
        if ($companyListing != '') {
            if ($build_ID == '') {
                $buildIds = array();
                foreach ($companyListing as $cl) {
                    $buildIds[] = $cl['build_id'];
                }

                $this->view->tuid = $tid;
                $wolist = $woModel->getWorkOrderByBuilIdsFilter($buildIds, $tid, $order, $dir, $search_array, $tid, $showbatch, $lastbatch, $searchtodate, $searchfromdate); 
            } else {

                $this->view->tuid = $tid;
                $wolist = $woModel->getBuildingWorkOrderFilter($build_ID, $tid, $order, $dir, $search_array, $tid, $showbatch, $lastbatch, $searchtodate, $searchfromdate); 
            }
        }


        $pageObj = new Ve_Paginator();
        $paginator = $pageObj->fetchPageDataResult($wolist, $page, 10);
        $this->view->wolist = $paginator;
        $this->view->page = $page;
    }

    public function getworkorderbytenantAction() {
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
        $this->_helper->layout()->disableLayout();
        $page = $this->_getParam('page', 1);
        $woModel = new Model_WorkOrder();
        $build_ID = $this->_getParam('bid', '');
        $tid = $this->_getParam('tuid', '');
        $select_build_id = $build_ID;
        $order = $this->_getParam('order', 'woId');
        $dir = $this->_getParam('dir', 'DESC');
        $search_array = array();

        if ($companyListing != '') {
            if ($build_ID == '') {
                $buildIds = array();
                foreach ($companyListing as $cl) {
                    $buildIds[] = $cl['build_id'];
                }
                $wolist = $woModel->getWorkOrderByBuilIdsFilter($buildIds, $tid, $order, $dir, $search_array);
            } else {
                $wolist = $woModel->getBuildingWorkOrderFilter($build_ID, $tid, $order, $dir, $search_array);
            }
        }
        $pageObj = new Ve_Paginator();
        $paginator = $pageObj->fetchPageDataResult($wolist, $page, 10);
        $this->view->wolist = $paginator;
    }

    public function generatebatchAction() {
        $this->_helper->layout()->disableLayout();
        $woid = $this->_getParam('woid', '');
        $tuid = $this->_getParam('tuid', '');
        $bid = $this->_getParam('bid', '');
        $insertData['building_id'] = $bid;
        $insertData['tenant_id'] = $tuid;
        $wobModel = new Model_WoBatch();
        $lastbatch = new Zend_Session_Namespace('lastbatch');
        unset($lastbatch->id);
        foreach ($woid as $value) {
            $ex = explode('_', $value);
            $lastbatch->id[] = $ex[0];
            $ten[$ex[1]][] = $ex[0];
        }
        foreach ($ten as $key => $value) {
            $insertData['tenant_id'] = $key;
            $woId = $wobModel->generateBatch($insertData);
            $last_bo_num = $wobModel->getMaxBatchNumber($bid, $key);
            $update_bo_num = '';
            if ($last_bo_num) {
                $update_bo_num = $last_bo_num + 1;
            } else {
                $update_bo_num = 1001;
            }
            try {
                $update_num = $wobModel->updateBatch(array('batch_number' => $update_bo_num), $woId);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $woModel = new Model_WorkOrder();
            $update = $woModel->updateWorkOrderBatchid($value, array('wo_batch' => $update_bo_num));
        }
        exit(0);
    }

    public function deletebatchAction() {
        $woid = $this->_getParam('woid', '');
        $wo_batch = $this->_getParam('batchid', '');
        $bid = $this->_getParam('bid', '');
        if ($woid != '') {
            $woModel = new Model_WorkOrder();
            $update = $woModel->deleteBatch(array('wo_batch' => 0), $woid, $wo_batch, $bid);
        }
        exit(0);
    }

    public function selectedbatchAction() {
        $woid = $this->_getParam('woid', '');
        $woiddel = $this->_getParam('woiddel', '');
        $selectedBatch = new Zend_Session_Namespace('selectedBatch');

        if ($woiddel == "true") {
            foreach ($woid as $key => $value) {
                unset($selectedBatch->workorderid[$key]);
            }
        } else {
            if (is_array($selectedBatch->workorderid)) {
                $tt = array_merge($woid, $selectedBatch->workorderid);
                $selectedBatch->workorderid = $tt;
            } else {
                $selectedBatch->workorderid = $woid;
            }
        }
        //print_r($selectedBatch->workorderid);
        echo $data = json_encode($selectedBatch->workorderid);
        exit(0);
    }

    /**
     *
     * Created By- Gurubaksh Singh
     *
     * This function show the listing of already created batches.
     *
     * @param string $companyListing stores the listing of companies.
     * @param sting  $tenantList stores the tenant listing
     * @param Array  @batchlisting stroes all batch listing
     *
     * @func showBatch return all the batch number according to building and tenant
     *
     * @return void
     */
    public function showbatchAction() {
        $this->tenant_location = 12;
        $this->_helper->layout()->setLayout('popuplayout');
        $companyListing = '';
        $build_ID = $this->_getParam('bid', '');
        if (empty($build_ID) && isset($_COOKIE['build_cookie']))
            $build_ID = $_COOKIE['build_cookie'];
        else
            $set_cookie = setcookie('build_cookie', $build_ID, time() + (86400 / 24), "/");

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
        $this->view->companyListing = $companyListing;
        $this->view->custID = $this->cust_id;
        $this->view->roleId = $this->roleId;

        // Tenant Listing

        $tenantList = '';
        $tenant = new Model_Tenant();
        if ($this->roleId == '5') {
            $tenantList = $tenant->getTenantById($this->userId);
            $this->view->select_build_id = $build_ID;
        } else {
            if ($build_ID != '') {
                $tenantList = $tenant->getTenantByBuildingId($build_ID);
                $this->view->select_build_id = $build_ID;
            } else {
                if ($companyListing != '') {
                    $tenantList = $tenant->getTenantByBuildingId($companyListing[0]['build_id']);
                    $this->view->select_build_id = $companyListing[0]['build_id'];
                }
            }
        }
        $this->view->acesshelper = $this->accessHelper;
        $this->view->tenant_location = $this->tenant_location;
        $this->view->tenantList = $tenantList;
        $this->view->bId = $build_ID;
        $this->view->userId = $this->userId;
        $tuid = $this->_getParam('tuid', '');
        $this->view->tuid = $tuid;
        $wob = new Model_WoBatch();
        $batchlisting = $wob->showBatch($build_ID, $tuid);
        //$this->view->batchlisting = $batchlisting;
        $this->view->buildingid = $build_ID;
        $page = $this->_getParam('page', 1);
        $pageObj = new Ve_Paginator();
        $paginator = $pageObj->fetchPageDataResult($batchlisting, $page, 10);
        $this->view->batchlisting = $paginator;
    }

    /**
     *
     * Created By- Gurubaksh Singh
     *
     * This function shows the all work order of batch id.
     *
     * @param string $batchId stores the Batch Number for finding the work order under it.
     * @param Array  $worklistingbybatch stores the listing of work order to batch id.

     * @func loadBatches fetch work order details by the batch.

     * @return void
     */
    public function loadbatchesAction() {
        $this->_helper->layout()->disableLayout();
        $batchId = $this->_getParam('batchId', '');
        $buildingid = $this->_getParam('buildingid', '');
        $wob = new Model_WoBatch();
        $worklistingbybatch = $wob->loadBatches($batchId, $buildingid);
        $this->view->worklistingbybatch = $worklistingbybatch;
    }

    /**
     *
     * Created By- Gurubaksh Singh
     *
     * This function shows the all work order of those are not exiting in batch and they are billable.
     *
     * @param string $worklisting stores the list of work order who billable and not in any batch.
     *
     * @func batchListWorkorder fetch work order that billable and not any batch.

     * @return void
     */
    public function batchlistworkorderAction() {
        $this->_helper->layout()->disableLayout();
        $buildingid = $this->_getParam('bid', '');
        $tuid = $this->_getParam('tuid', '');
        $batchnumber = $this->_getParam('batchnumber', '');
        $wob = new Model_WoBatch();
        $worklisting = $wob->batchListWorkorder($tuid, $buildingid);
        $this->view->worklistingbybatch = $worklisting;
        $this->view->batchnumber = $batchnumber;
        ;
    }

    /**
     *
     * Created By- Gurubaksh Singh
     *
     * This function updates the batch number in work order section or assign work in a exiting batch.
     *
     * @param string $batchId stores the batch id.
     *
     * @func updateWorkOrderBatchid updates the batch id in work order table.

     * @return void
     */
    public function upldatebatchworkorderAction() {
        echo $batchId = $this->_getParam('batchId', '');
        echo $woId = $this->_getParam('woId', '');
        $woIdArr[] = $woId;
        $woModel = new Model_WorkOrder();
        $update = $woModel->updateWorkOrderBatchid($woIdArr, array('wo_batch' => $batchId));
        exit(0);
    }

    public function historyoflaborAction() {

        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $woHModel = new Model_WoHistoryLog();
        $historyDetails = $woHModel->getHistoryLogComplete($data['whId']);
        $this->view->current_value = json_decode($historyDetails[0]['current_value'], true);
        $this->view->change_value = json_decode($historyDetails[0]['change_value'], true);
    }

    public function historyofbuildingAction() {

        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];

        $woHModel = new Model_WoHistoryLog();
        $historyDetails = $woHModel->getHistoryLogComplete($data['whId']);
        $this->view->current_value = json_decode($historyDetails[0]['current_value'], true);
        $this->view->change_value = json_decode($historyDetails[0]['change_value'], true);
    }

    public function historyofmaterialAction() {

        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $woHModel = new Model_WoHistoryLog();
        $historyDetails = $woHModel->getHistoryLogComplete($data['whId']);
        $this->view->current_value = json_decode($historyDetails[0]['current_value'], true);
        $this->view->change_value = json_decode($historyDetails[0]['change_value'], true);
    }

    public function historyofoutsideAction() {

        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $woHModel = new Model_WoHistoryLog();
        $historyDetails = $woHModel->getHistoryLogComplete($data['whId']);
        $this->view->current_value = json_decode($historyDetails[0]['current_value'], true);
        $this->view->change_value = json_decode($historyDetails[0]['change_value'], true);
    }

    public function historyofnotesAction() {

        $this->_helper->layout()->disableLayout();
        $data = $this->getRequest()->getPost();
        $this->view->bId = $data['bId'];
        $woHModel = new Model_WoHistoryLog();
        $historyDetails = $woHModel->getHistoryLogComplete($data['whId']);
        $this->view->current_value = json_decode($historyDetails[0]['current_value'], true);
        $this->view->change_value = json_decode($historyDetails[0]['change_value'], true);
    }

    public function historyofworkorderAction() {
        $buildingid = $this->_getParam('bId', '');
        $this->_helper->layout()->disableLayout();
        $woId = $this->_getParam('woId', '');
        $this->view->current_value = $this->_getParam('current_value', '');
        $this->view->change_value = $this->_getParam('change_value', '');
        $woModel = new Model_WorkOrder();
        $this->view->woData = '';
        if ($woId != '') {
            $woData = $woModel->getWorkOrderInfo($woId);
            $this->view->woData = $woData[0];
        } else {
            echo 'Error occurred to open show edit';
            exit(0);
        }
    }

    public function changepriorityAction() {
        $categoryid = $this->_getParam('categoryId', '');
        if ($categoryid != '') {
            try {
                $priorityMapper = new Model_Priority();
                $priorityDetails = $priorityMapper->getPriorityByCategory($categoryid);
                if ($priorityDetails != '') {
                    echo $priorityDetails[0]->priorityName;
                }
            } catch (Exception $e) {
                
            }
        }
        exit(0);
    }

    public function setTimezone($building_id) {
        $timezone_Model = new Model_TimeZone();
        $build_model = new Model_Building();
        $tz_build_data = $build_model->getbuildingbyid($building_id);

        if (isset($tz_build_data[0]['timezone']) && $tz_build_data[0]['timezone'] != 0) {
            $timezone_data = $timezone_Model->getTimeZone($tz_build_data[0]['timezone']);
            $timezone = $timezone_data[0]['time_value'];
            date_default_timezone_set($timezone);
        } else if ($tz_build_data[0]['timezone'] == 0) {
            date_default_timezone_set(DEFAULT_TIMEZONE);
        }
    }

}
