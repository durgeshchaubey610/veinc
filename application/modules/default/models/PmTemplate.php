<?php

/**
 * Description of Work Order
 *
 * @author brijesh
 */
class Model_PmTemplate extends Zend_Db_Table_Abstract {

    protected $_name = 'pm_vt_template_typedesignation';
    protected $_tab_role = 'pm_vt_template_typedesignation';
    public $_errorMessage = '';

    public function GetAllTemplateName($search = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_vt_template_name'));
        if ($search != "") {
            $select = $select->where("VT_Template_Name like '%" . $search . "%'");
        }
        $select = $select->order('VT_Template_Name ASC');
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllDesignName($search = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_vt_template_typedesignation'));
        if ($search != "") {
            $select = $select->where("VT_TypeDesignation like '%" . $search . "%'");
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetTemplateNameById($TemplateId) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($TemplateId)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_name'))
                    ->where("VT_Template_Name_ID=?", $TemplateId);
        }

        $res = $db->fetchAll($select);

        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* get all frequency data */

    public function Getallfrequency() {
        $db = Zend_Db_Table::getDefaultAdapter();
        //if(!empty($TemplateId)){
        $select = $db->select()
                ->from(array('pm_au_frequency'), Array('AU_Frequency_ID', 'Name', 'Interval_Value', 'Interval', 'column'));
        /// ->where("type=?","default");
        //}

        $res = $db->fetchAll($select);

        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* get all frequency data */

    public function GetfrequencybyId($id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //if(!empty($TemplateId)){
        $select = $db->select()
                ->from(array('pm_au_frequency'), Array('AU_Frequency_ID', 'Name', 'Interval_Value', 'Interval', 'column'))
                ->where("AU_Frequency_ID=?", $id);
        //}

        $res = $db->fetchAll($select);

        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* get all frequency data */

    public function Getallstartdateadjustment() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                ->from(array('pm_au_startdateadjustment'), Array('AU_sda_ID', 'Name'));
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* get all task job time data */

    public function Getalljobtime() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                ->from(array('pm_au_jobtime'), Array('AU_JobTime_ID', 'JobTime_Name', 'JobTime_Value'));
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* get all Unit of Measure data */

    public function Getallunitofmeasure() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                ->from(array('pm_au_unitofmeasure'), Array('AU_uom_ID', 'Name'));
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetTemplateDetails($TemplateId, $search = "") {

        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($TemplateId)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_typedesignation'))
                    ->where("VT_Template_Name_ID=?", $TemplateId);
            if ($search != "") {
                $select = $select->where("VT_TypeDesignation like '%" . $search . "%'");
            }
            $select = $select->order('VT_TypeDesignation ASC');
            $res = $db->fetchAll($select);
        }

        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetTemplateByName($templateName = "", $template_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($templateName)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_name'))
                    ->where("VT_Template_Name=?", $templateName);
            if (!empty($template_id)) {
                $select = $select->where('VT_Template_Name_ID!=?', $template_id);
            }
            // $select = $select->order('Template_Name ASC');
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function InsertTemplateName($templatedata) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($templatedata)) {
            try {
                $insert = $db->insert('pm_vt_template_name', $templatedata);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function GetTemplateIdByTypeDesignation($typeDesignation = "", $typeDesignation_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($typeDesignation)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_typedesignation'))
                    ->where("VT_TypeDesignation=?", $typeDesignation);
            if (!empty($typeDesignation_id)) {
                $select = $select->where('VT_Template_Designation_ID!=?', $typeDesignation_id);
            }
        }
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function InsertTypeDesignation($typedata) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($typedata)) {
            try {
                $insert = $db->insert('pm_vt_template_typedesignation', $typedata);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function updatetemplate($tempdata, $temp_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($tempdata)) {
            try {
                $condition = array('VT_Template_Name_ID = ' . $temp_id);
                $db->update('pm_vt_template_name', $tempdata, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function Updateviewlist($update, $type) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($update)) {
            try {
                $condition = array("pm_type = '" . $type . "'");
                $db->update('pm_view_tables', $update, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deleteTemplate($template_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('VT_Template_Name_ID = ' . $template_id);
            $db->delete('pm_vt_template_name', $condition);
            //$db->update('croom_rate_schedule', $data, $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function GettypedesignationById($desig_id) {

        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_typedesignation'))
                    ->where("VT_Template_Designation_ID=?", $desig_id);
        }

        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GettemplateByTypeDesignationID($Design_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($Design_id)) {
            $select = $db->select()
                    ->from(array('putt' => 'pm_vt_template_typedesignation'))
                    ->joinInner(array('putn' => 'pm_vt_template_name'), 'putn.VT_Template_Name_ID = putt.VT_Template_Name_ID')
                    ->where("VT_Template_Designation_ID=?", $Design_id);
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function updatetypedesignation($typedata, $type_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($typedata)) {
            try {
                $condition = array('VT_Template_Designation_ID = ' . $type_id);
                $db->update('pm_vt_template_typedesignation', $typedata, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deleteTypeDesignation($type_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('VT_Template_Designation_ID = ' . $type_id);
            $db->delete('pm_vt_template_typedesignation', $condition);
            //$db->update('croom_rate_schedule', $data, $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteTypeDesignationByTemplateId($template_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('VT_Template_Name_ID = ' . $template_id);
            $db->delete('pm_vt_template_typedesignation', $condition);
            //$db->update('croom_rate_schedule', $data, $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /* Tesk module start  */

    public function GetSubseteByName($SubsetName = "", $VT_Template_Task_ID = "", $desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($SubsetName)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_task'))
                    ->where("Task_Instruction=?", $SubsetName)
                    ->where("Parent_ID=?", 0)
                    ->where("VT_Template_Designation_ID=?", $desig_id);
            if (!empty($VT_Template_Task_ID)) {
                $select = $select->where('VT_Template_Task_ID!=?', $VT_Template_Task_ID);
            }
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function insertsubset($SubsetData) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($SubsetData)) {
            try {
                $insert = $db->insert('pm_vt_template_task', $SubsetData);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function insertReadingsubset($SubsetData) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($SubsetData)) {
            try {
                $insert = $db->insert('pm_vt_template_reading', $SubsetData);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function Get_MaxViewOrder($tablename) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($tablename)) {
            $select = $db->select()
                    ->from(array($tablename), array('max(View_order) as View_order'));
            $res = $db->fetchAll($select);
        }
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllSubset($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_vt_template_task'))
                ->where('AU_Frequency_ID IS NULL or AU_Frequency_ID = ""');
        if (!empty($desig_id)) {
            $select = $select->where('VT_Template_Designation_ID=?', $desig_id);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        //print_r($res);
        //die;
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllSubsetReading($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_vt_template_reading'))
                ->where('AU_Frequency_ID IS NULL or AU_Frequency_ID = ""');
        if (!empty($desig_id)) {
            $select = $select->where('VT_Template_Designation_ID=?', $desig_id);
        }
        $res = $db->fetchAll($select);
        //print_r($res);
        //die;
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetSubsetById($id) {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('subset_level'))
                ->where("id=?", $id);
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAlltaskparent($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_vt_template_task'))
                ->where("Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('VT_Template_Designation_ID=?', $desig_id);
        }
        $select = $select->order('view_order ASC');
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAlltask() {
        $db = Zend_Db_Table::getDefaultAdapter();


//        $select1 = $db->select()
//                ->from(array('pm_vt_template_task'))
//                ->where("Parent_ID=?",1);
//        $select2 = $db->select()
//                ->from(array('pm_vt_template_task'))       
//                ->where("Parent_ID=?",0);
        $select1 = 'Select  n.* from  pm_vt_template_task  t ,pm_vt_template_task  n  where t.id=n.Parent_ID  and n.Parent_ID <> 0';
        $select2 = 'Select  * from  pm_vt_template_task  p where p.Parent_ID = 0  order by view_order ASC';

        $select = $db->select()
                ->union(array($select1, $select2));
        //echo $select;
        //die;
        //$select = $db->select()
        //->from(array('pm_vt_template_task'));               
        //$select = $select->order('view_order ASC');        
        //->from(array('t' => 'pm_vt_template_task'));
        // ->joinInner(array('sl' => 'subset_level'), 'sl.id = t.subset_id');
        //$select = $select->order('t.view_order ASC');
        // ->from(array('t' => 'pm_vt_template_task')); 

        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function Inserttask($taskdata) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($taskdata)) {
            try {
                $insert = $db->insert('pm_vt_template_task', $taskdata);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /// update task data        
    public function Updatetask($taskdata, $task_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($taskdata)) {
            try {
                $condition = array('VT_Template_Task_ID = ' . $task_id);
                $db->update('pm_vt_template_task', $taskdata, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function GetTaskBysubsetId($suset_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($suset_id)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_task'))
                    ->where("Parent_ID=?", $suset_id);
        }
        $select = $select->order('view_order ASC');

        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function Updateodrder($data, $task_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {

                $condition = array('VT_Template_Task_ID = ' . $task_id);
                // print_r($data);
                // print_r($condition);
                $db->update('pm_vt_template_task', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function GettaskDataById($task_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($task_id)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_task'))
                    ->where("VT_Template_Task_ID=?", $task_id);
        }
        //$select = $select->order('view_order ASC');
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function deleteReading($task_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('VT_Template_Reading_ID = ' . $task_id);
            $db->delete('pm_vt_template_reading', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // start new section
    // Reading section start

    public function InsertReading($table ,$data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $insert = $db->insert($table, $data);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function GetAllSubset_reading($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_vt_template_reading'))
                ->where('AU_Frequency_ID IS NULL');
        if (!empty($desig_id)) {
            $select = $select->where('VT_Template_Designation_ID=?', $desig_id);
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllReadingParent($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_vt_template_reading'))
                ->where("Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('VT_Template_Designation_ID=?', $desig_id);
        }
        $select = $select->order('view_order ASC');
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetReadingBysubsetId($suset_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($suset_id)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_reading'))
                    ->where("Parent_ID=?", $suset_id);
        }
        $select = $select->order('view_order ASC');

        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetreadingDataById($id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_reading'))
                    ->where("VT_Template_Reading_ID=?", $id);
        }
        //$select = $select->order('view_order ASC');
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /// update task data        
    public function Updatereading($data, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //print_r($taskdata);
        if (!empty($data)) {
            try {
                $condition = array('VT_Template_Reading_ID = ' . $id);
                $db->update('pm_vt_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deleteTask($id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('VT_Template_Task_ID = ' . $id);
            $db->delete('pm_vt_template_task', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteTaskByParentId($parent_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('Parent_ID = ' . $parent_id);
            $db->delete('pm_vt_template_task', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteReadingByParentId($parent_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('Parent_ID = ' . $parent_id);
            $db->delete('pm_au_template_reading', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    //task 
    public function getallparent($Parent_ID) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($Parent_ID)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_task'))
                    ->where("Parent_ID = " . $Parent_ID);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    //reading 
    public function getallparent_reading($Parent_ID) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($Parent_ID)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_task'))
                    ->where("Parent_ID = " . $Parent_ID);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function Updateodrderreading($data, $reading_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {

                $condition = array('VT_Template_Reading_ID = ' . $reading_id);
                $db->update('pm_vt_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /* Reading module start  */

    public function GetSubsetreadingByName($SubsetName, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($SubsetName)) {
            $select = $db->select()
                    ->from(array('pm_au_template_reading'))
                    ->where("Reading_Instruction=?", $SubsetName)
                    ->where("Parent_ID=?", 0);
            if (!empty($id)) {
                $select = $select->where('AU_Template_Reading_ID!=?', $id);
            }
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    ///// group update section start 

    public function update_grouptask($data, $desig_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'VT_Template_Designation_ID=' . $desig_id;
                if ($includesubset == "") {
                    $con .= ' and Parent_ID = 0 ';
                }
                $con .= ' and AU_Frequency_ID is not null';
                $condition = array($con);
                $db->update('pm_vt_template_task', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function update_grouptasksubset($data, $desig_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'VT_Template_Designation_ID=' . $desig_id;
                $con .= ' and Parent_ID = ' . $Parent_ID;
                $con .= ' and AU_Frequency_ID is not null ';
                $condition = array($con);
                $db->update('pm_vt_template_task', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /*  Insert the PM Frequency data  */

    public function InsertFrequencyData($data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $insert = $db->insert('pm_frequency', $data);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /*  Group modification start date of month update function */

    public function update_grouptask_startdateofmonth($data, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'id=' . $id;
                $condition = array($con);
                $db->update('pm_vt_template_task', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /* get all task before update chaeck the date */

    public function Getalltaskbygroupmodification($id, $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_task'));

            if (!empty($includesubset)) {
                $select = $select->where("pm_vt_template_name_id = " . $id . "  and frequency is not null");
            } else {
                $select = $select->where("pm_vt_template_name_id = " . $id . " and Parent_ID = 0 and frequency is not null");
            }
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function Getalltasksubsetbygroupmodification($id, $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_task'))
                    ->where("pm_vt_template_name_id = " . $id . "  and Parent_ID = '" . $Parent_ID . "'");
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* Reading Group modification start */

    public function update_groupreading($data, $desig_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'VT_Template_Designation_ID=' . $desig_id;
                if ($includesubset == "") {
                    $con .= ' and Parent_ID = 0 ';
                }
                $con .= ' and AU_Frequency_ID is not null';
                $condition = array($con);
                $db->update('pm_vt_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    // vt section functions         
    public function update_groupreadingsubset($data, $desig_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'VT_Template_Designation_ID=' . $desig_id;
                $con .= ' and Parent_ID = ' . $Parent_ID;
                $con .= ' and AU_Frequency_ID is not null ';
                $condition = array($con);
                $db->update('pm_vt_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /* get all Reading before update chaeck the date */

    public function Getallreadingbygroupmodification($id, $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_reading'));

            if (!empty($includesubset)) {
                $select = $select->where("pm_vt_template_name_id = " . $id . "  and frequency is not null");
            } else {
                $select = $select->where("pm_vt_template_name_id = " . $id . " and Parent_ID = 0 and frequency is not null");
            }
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /*  Group modification start date of month update function */

    public function update_groupreading_startdateofmonth($data, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'id=' . $id;
                $condition = array($con);
                $db->update('pm_au_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function Getallreadingsubsetbygroupmodification($id, $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_reading'))
                    ->where("pm_vt_template_name_id = " . $id . "  and Parent_ID = '" . $Parent_ID . "'");
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* View table in list */

    public function get_view_table($type) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($type)) {
            $select = $db->select()
                    ->from(array('pm_view_tables'))
                    ->where("pm_type = '" . $type . "'");
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* View table in list */

    public function get_au_view_table($type) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($type)) {
            $select = $db->select()
                    ->from(array('pm_au_view_tables'))
                    ->where("pm_type = '" . $type . "'");
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* Import Template section */

    public function get_all_typedesignation($id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    //->setIntegrityCheck(false) 
                    //->distinct() 
                    ->from(array('pty' => 'pm_vt_template_typedesignation'), array('DISTINCT(pty.VT_TypeDesignation)'))
                    //->from($this->_dbTable, new Zend_Db_Expr('DISTINCT(field_1) as field_1'))
                    //$this->_dbTable, new Zend_Db_Expr('DISTINCT(field_1) as field_1')
                    ->joinInner(array('pt' => 'pm_vt_template_task'), 'pty.VT_Template_Designation_ID = pt.VT_Template_Designation_ID', array('pty.VT_Template_Designation_ID'))
                    ->where("pty.VT_Template_Designation_ID != " . $id);
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function get_subsetbyid($table_name, $desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("VT_Template_Designation_ID = " . $desig_id . " and AU_Frequency_ID is null and Parent_ID = 0");
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function get_taskbysubsetId($table_name, $desig_id, $Parent_ID) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("VT_Template_Designation_ID = " . $desig_id . "  and Parent_ID = " . $Parent_ID);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function get_tabledata($table_name, $desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("VT_Template_Designation_ID = " . $desig_id . " and AU_Frequency_ID is not null  and Parent_ID = 0");
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function get_tabledata_Au($table_name, $desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("AU_Template_Designation_ID = " . $desig_id . " and AU_Frequency_ID is not null  and Parent_ID = 0");
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function get_FrequencydataByID($FreqId) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($FreqId)) {
            $select = $db->select()
                    ->from(array('pm_frequency'))
                    ->where("id = " . $FreqId);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* cronjob module function start */

    public function gettaskdata($temp_id = "") {

        $db = Zend_Db_Table::getDefaultAdapter();
        if (empty($temp_id)) {
            $select = $db->select()
                    ->from(array('pt' => 'pm_vt_template_task'), array('pt.Interval_Value as Interval_Data', 'pt.*'))
                    ->joinInner(array('pf' => 'pm_au_frequency'), 'pt.AU_Frequency_ID = pf.AU_Frequency_ID')
                    ->joinInner(array('ps' => 'pm_au_startdateadjustment'), 'pt.AU_sda_ID = ps.AU_sda_ID')
                    ->where("pt.VT_Template_Designation_ID > 1");
        }
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /*     * *********************************************** Equipment Template ************************* */

    public function GetAllEquipmentTemplateName($search = "", $BId = "", $user_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_au_template_name'));
        if ($search != "") {
            $select = $select->where("AU_Template_Name like '%" . $search . "%'");
        }
        if ($BId != "") {
            $select = $select->where("BuildingID=?", $BId);
        }
        if ($user_id != "") {
            $select = $select->where("user_id=?", $user_id);
        }
        $select = $select->order('AU_Template_Name ASC');

        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllEquipmentTemplateDesignName($search = "", $BId = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_au_template_typedesignation'));
        if ($search != "") {
            $select = $select->where("AU_TypeDesignation like '%" . $search . "%'");
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetEquipmentTemplateNameById($TemplateId, $BId = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($TemplateId)) {
            $select = $db->select()
                    ->from(array('pm_au_template_name'))
                    ->where("AU_Template_Name_ID=?", $TemplateId);
        }

        $res = $db->fetchAll($select);

        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetEquipmentTemplateDetails($TemplateId, $search = "", $BId = "") {

        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($TemplateId)) {
            $select = $db->select()
                    ->from(array('pm_au_template_typedesignation'))
                    ->where("AU_Template_Name_ID=?", $TemplateId);
            if ($search != "") {
                $select = $select->where("AU_TypeDesignation like '%" . $search . "%'");
            }
            $select = $select->order('AU_TypeDesignation ASC');
            //echo $select;
            //die;
            $res = $db->fetchAll($select);
        }

        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetEquipmentTemplateByName($templateName = "", $template_id = "", $building_id = "", $user_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($templateName)) {
            $select = $db->select()
                    ->from(array('pm_au_template_name'))
                    ->where("AU_Template_Name=?", $templateName);
            if (!empty($template_id)) {
                $select = $select->where('AU_Template_Name_ID!=?', $template_id);
            }
            if (!empty($building_id)) {
                $select = $select->where('BuildingID=?', $building_id);
            }
            if (!empty($user_id)) {
                $select = $select->where('user_id=?', $user_id);
            }
            //$select = $select->order('Template_Name ASC');
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function InsertEquipmentTemplateName($templatedata) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($templatedata)) {
            try {
                $insert = $db->insert('pm_au_template_name', $templatedata);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function GetEquipmentTemplateIdByTypeDesignation($typeDesignation = "", $typeDesignation_id = "", $build_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($typeDesignation)) {
            $select = $db->select()
                    ->from(array('putt' => 'pm_au_template_typedesignation'))
                    ->joinInner(array('putn' => 'pm_au_template_name'), 'putn.AU_Template_Name_ID = putt.AU_Template_Name_ID')
                    ->where("AU_TypeDesignation=?", $typeDesignation);
            if (!empty($typeDesignation_id)) {
                $select = $select->where('AU_Template_Designation_ID!=?', $typeDesignation_id);
            }
            if (!empty($build_id)) {
                $select = $select->where('BuildingID=?', $build_id);
            }
            //echo $select;
            //die;
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetEquipmentTemplateByTypeDesignationID($Design_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($Design_id)) {
            $select = $db->select()
                    ->from(array('putt' => 'pm_au_template_typedesignation'))
                    ->joinInner(array('putn' => 'pm_au_template_name'), 'putn.AU_Template_Name_ID = putt.AU_Template_Name_ID')
                    ->where("AU_Template_Designation_ID=?", $Design_id);
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function InsertEquipmentTemplateTypeDesignation($typedata) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($typedata)) {
            try {
                $insert = $db->insert('pm_au_template_typedesignation', $typedata);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function UpdateEquipmentTemplate($tempdata, $temp_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($tempdata)) {
            try {
                $condition = array('AU_Template_Name_ID = ' . $temp_id);
                $db->update('pm_au_template_name', $tempdata, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function UpdateEquipmentTemplateviewlist($update, $type) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($update)) {
            try {
                $condition = array("pm_type = '" . $type . "'");
                $db->update('pm_view_tables', $update, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deleteEquipmentTemplate($template_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('AU_Template_Name_ID = ' . $template_id);
            $db->delete('pm_au_template_name', $condition);
            //$db->update('croom_rate_schedule', $data, $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function GetEquipmentTemplatetypedesignationById($desig_id) {

        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_typedesignation'))
                    ->where("AU_Template_Designation_ID=?", $desig_id);
        }

        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function updateEquipmentTemplatetypedesignation($typedata, $type_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($typedata)) {
            try {
                $condition = array('AU_Template_Designation_ID = ' . $type_id);
                $db->update('pm_au_template_typedesignation', $typedata, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deleteEquipmentTemplateTypeDesignation($type_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('AU_Template_Designation_ID = ' . $type_id);
            $db->delete('pm_au_template_typedesignation', $condition);
            $db->delete('pm_au_template_task', $condition);
            $db->delete('pm_au_template_reading', $condition);
            //$db->update('croom_rate_schedule', $data, $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteEquipmentTemplateTypeDesignationByTemplateId($template_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('AU_Template_Name_ID = ' . $template_id);
            $db->delete('pm_au_template_typedesignation', $condition);
            //$db->update('croom_rate_schedule', $data, $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /* Tesk module start  */

    public function GetEquipmentTemplateSubseteByName($SubsetName = "", $AU_Template_Task_ID = "", $desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($SubsetName)) {
            $select = $db->select()
                    ->from(array('pm_au_template_task'))
                    ->where("Task_Instruction=?", $SubsetName)
                    ->where("Parent_ID=?", 0)
                    ->where("AU_Template_Designation_ID=?", $desig_id);
            if (!empty($AU_Template_Task_ID)) {
                $select = $select->where('AU_Template_Task_ID!=?', $AU_Template_Task_ID);
            }
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function insertEquipmentTemplatesubset($SubsetData) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($SubsetData)) {
            try {
                $insert = $db->insert('pm_au_template_task', $SubsetData);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function insertEquipmentTemplateReadingsubset($SubsetData) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($SubsetData)) {
            try {
                $insert = $db->insert('pm_au_template_reading', $SubsetData);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function GetAllEquipmentTemplateSubset($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_au_template_task'))
                ->where('AU_Frequency_ID IS NULL or AU_Frequency_ID = ""');
        if (!empty($desig_id)) {
            $select = $select->where('AU_Template_Designation_ID=?', $desig_id);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        //print_r($res);
        //die;
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllEquipmentTemplateSubsetReading($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_au_template_reading'))
                ->where('AU_Frequency_ID IS NULL or AU_Frequency_ID = ""');
        if (!empty($desig_id)) {
            $select = $select->where('AU_Template_Designation_ID=?', $desig_id);
        }
        $res = $db->fetchAll($select);
        //print_r($res);
        //die;
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetEquipmentTemplateSubsetById($id) {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('subset_level'))
                ->where("id=?", $id);
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllEquipmentTemplatetaskparent($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('t1'=>'pm_au_template_task'),array('AU_Template_Task_ID'=>'t1.AU_Template_Task_ID','Task_Instruction'=>'t1.Task_Instruction','AU_Frequency_ID'=>'t1.AU_Frequency_ID', 'Start_date'=>'t1.Start_date','Seasonal_Task'=>'t1.Seasonal_Task','Startdate_month'=>'t1.Startdate_month'))
                ->joinLeft(array('t2' => 'email_group'), 't2.id = t1.Assigned_to', array('group_name' => 't2.group_name'))
                ->where("t1.Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('t1.AU_Template_Designation_ID=?', $desig_id);
        }
        $select = $select->order('t1.view_order ASC');
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllEquipmenttaskparent($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        //$select = $db->select()->from(array('t1'=>'pm_au_temporary_template_task'),array('AU_Template_Task_ID'=>'t1.AU_Template_Task_ID'));
        $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_task'), array('count(*) as c'));

        $res = $db->fetchAll($select);

        $count = $res[0]->c;

        if ($count > 0) {
            $table = 'pm_au_temporary_template_task';
        } else {
            $table = 'pm_au_template_task';
        }

        $select = $db->select()
                ->from(array('t1' => $table), array('AU_Template_Task_ID' => 't1.AU_Template_Task_ID', 'AU_Template_Designation_ID' => 't1.AU_Template_Designation_ID', 'Task_Instruction' => 't1.Task_Instruction', 'AU_Frequency_ID' => 't1.AU_Frequency_ID', 'Start_date' => 't1.Start_date', 'Assigned_to' => 't1.Assigned_to', 'Parent_ID' => 't1.Parent_ID'))
                ->joinLeft(array('t2' => 'email_group'), 't2.id = t1.Assigned_to', array('group_name' => 't2.group_name'))
                // ->joinLeft(array('t3' => 'pm_au_equipment_task'), 't3.AU_Template_Task_ID = t1.AU_Template_Task_ID', array('Start_Date' => 't3.Start_Date'))
                //->joinLeft(array('t3' => 'pm_au_temporary'), 't3.AU_Template_Designation_ID = t1.AU_Template_Designation_ID', array('Start_Date' => 't3.Start_Date'))                
                ->where("t1.Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('t1.AU_Template_Designation_ID=?', $desig_id);
        }
        //$select = $select->order('view_order ASC')->group('t1.AU_Template_Task_ID');
        $select = $select->order('view_order ASC');

        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }
    
    public function GetAllEquipmenttaskparentsubset($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        //$select = $db->select()->from(array('t1'=>'pm_au_temporary_template_task'),array('AU_Template_Task_ID'=>'t1.AU_Template_Task_ID'));
        $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_task'), array('count(*) as c'));

        $res = $db->fetchAll($select);

        $count = $res[0]->c;

        if ($count > 0) {
            $table = 'pm_au_temporary_template_task';
        } else {
            $table = 'pm_au_template_task';
        }

        $select = $db->select()
                ->from(array('t1' => $table), array('AU_Template_Task_ID' => 't1.AU_Template_Task_ID', 'AU_Template_Designation_ID' => 't1.AU_Template_Designation_ID', 'Task_Instruction' => 't1.Task_Instruction', 'AU_Frequency_ID' => 't1.AU_Frequency_ID', 'Start_date' => 't1.Start_date', 'Assigned_to' => 't1.Assigned_to', 'Parent_ID' => 't1.Parent_ID'))
                ->joinLeft(array('t2' => 'email_group'), 't2.id = t1.Assigned_to', array('group_name' => 't2.group_name'));
                // ->joinLeft(array('t3' => 'pm_au_equipment_task'), 't3.AU_Template_Task_ID = t1.AU_Template_Task_ID', array('Start_Date' => 't3.Start_Date'))
                //->joinLeft(array('t3' => 'pm_au_temporary'), 't3.AU_Template_Designation_ID = t1.AU_Template_Designation_ID', array('Start_Date' => 't3.Start_Date'))                
                //->where("t1.Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('t1.AU_Template_Designation_ID=?', $desig_id);
        }
        //$select = $select->order('view_order ASC')->group('t1.AU_Template_Task_ID');
        $select = $select->order('view_order ASC');

        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllEquipmentTemplatetask() {
        $db = Zend_Db_Table::getDefaultAdapter();


        //        $select1 = $db->select()
        //                ->from(array('pm_au_template_task'))
        //                ->where("Parent_ID=?",1);
        //        $select2 = $db->select()
        //                ->from(array('pm_au_template_task'))       
        //                ->where("Parent_ID=?",0);
        $select1 = 'Select  n.* from  pm_au_template_task  t ,pm_au_template_task  n  where t.id=n.Parent_ID  and n.Parent_ID <> 0';
        $select2 = 'Select  * from  pm_au_template_task  p where p.Parent_ID = 0  order by view_order ASC';

        $select = $db->select()
                ->union(array($select1, $select2));
        //echo $select;
        //die;
        //$select = $db->select()
        //->from(array('pm_au_template_task'));               
        //$select = $select->order('view_order ASC');        
        //->from(array('t' => 'pm_au_template_task'));
        // ->joinInner(array('sl' => 'subset_level'), 'sl.id = t.subset_id');
        //$select = $select->order('t.view_order ASC');
        // ->from(array('t' => 'pm_au_template_task')); 

        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function InsertEquipmentTemplatetask($taskdata) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($taskdata)) {
            try {
                $insert = $db->insert('pm_au_template_task', $taskdata);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /// update task data        
    public function UpdateEquipmentTemplatetask($taskdata, $task_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($taskdata)) {
            try {
                $condition = array('AU_Template_Task_ID = ' . $task_id);
                $db->update('pm_au_template_task', $taskdata, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function GetEquipmentTemplateTaskBysubsetId($suset_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($suset_id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_task'))
                    ->where("Parent_ID=?", $suset_id);
        }
        $select = $select->order('view_order ASC');

        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function UpdateEquipmentTemplateodrder($data, $task_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {

                $condition = array('AU_Template_Task_ID = ' . $task_id);
                // print_r($data);
                // print_r($condition);
                $db->update('pm_au_template_task', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function GetEquipmentTemplatetaskDataById($task_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($task_id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_task'))
                    ->where("AU_Template_Task_ID=?", $task_id);
        }
        //$select = $select->order('view_order ASC');
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function deleteEquipmentTemplateReading($task_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('AU_Template_Reading_ID = ' . $task_id);
            $db->delete('pm_au_template_reading', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // start new section
    // Reading section start

    public function InsertEquipmentTemplateReading($data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $insert = $db->insert('pm_au_template_reading', $data);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function GetAllEquipmentTemplateSubset_reading($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_au_template_reading'))
                ->where('AU_Frequency_ID IS NULL');
        if (!empty($desig_id)) {
            $select = $select->where('AU_Template_Designation_ID=?', $desig_id);
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* get all frequency data */

    public function GetallEquipmentTemplatefrequency() {
        $db = Zend_Db_Table::getDefaultAdapter();
        //if(!empty($TemplateId)){
        $select = $db->select()
                ->from(array('pm_au_frequency'), Array('AU_Frequency_ID', 'Name', 'Interval_Value', 'Interval', 'column'));
        /// ->where("type=?","default");
        //}

        $res = $db->fetchAll($select);

        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllEquipmentTemplateReadingParent($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('t1'=>'pm_au_template_reading'), array('AU_Template_Reading_ID'=>'t1.AU_Template_Reading_ID','Reading_Instruction'=>'t1.Reading_Instruction', 'AU_Frequency_ID'=>'t1.AU_Frequency_ID', 'Reading_Value'=>'t1.Reading_Value','Tolerance'=>'t1.Tolerance', 'Start_date'=>'t1.Start_date', 'Seasonal_Task'=>'t1.Seasonal_Task', 'Startdate_month'=>'t1.Startdate_month'))
                ->joinLeft(array('t2' => 'email_group'), 't2.id = t1.Assigned_to', array('group_name' => 't2.group_name'))
                ->where("t1.Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('t1.AU_Template_Designation_ID=?', $desig_id);
        }
        $select = $select->order('t1.view_order ASC');

        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }
    
    public function GetAllEquipmentTemplateReadingParentsubset($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('t1'=>'pm_au_template_reading'), array('AU_Template_Reading_ID'=>'t1.AU_Template_Reading_ID','Reading_Instruction'=>'t1.Reading_Instruction', 'AU_Frequency_ID'=>'t1.AU_Frequency_ID', 'Reading_Value'=>'t1.Reading_Value','Tolerance'=>'t1.Tolerance', 'Start_date'=>'t1.Start_date', 'Seasonal_Task'=>'t1.Seasonal_Task', 'Startdate_month'=>'t1.Startdate_month'))
                ->joinLeft(array('t2' => 'email_group'), 't2.id = t1.Assigned_to', array('group_name' => 't2.group_name'));
                //->where("t1.Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('t1.AU_Template_Designation_ID=?', $desig_id);
        }
        $select = $select->order('t1.view_order ASC');

        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllEquipmentReadingParent($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        //$select = $db->select()->from(array('t1'=>'pm_au_temporary_template_reading'), array('AU_Template_Reading_ID'=>'t1.AU_Template_Reading_ID'));

        $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_reading'), array('count(*) as c'));

        $res = $db->fetchAll($select);

        $count = $res[0]->c;
        if ($count > 0) {
            $table = 'pm_au_temporary_template_reading';
        } else {
            $table = 'pm_au_template_reading';
        }

        $select = $db->select()
                ->from(array('t1' => $table), array('AU_Template_Reading_ID' => 't1.AU_Template_Reading_ID', 'AU_Template_Designation_ID' => 't1.AU_Template_Designation_ID', 'AU_Frequency_ID' => 't1.AU_Frequency_ID', 'Reading_Instruction' => 't1.Reading_Instruction', 'Start_date' => 't1.Start_date', 'Assigned_to' => 't1.Assigned_to', 'Parent_ID' => 't1.Parent_ID'))
                ->joinLeft(array('t2' => 'email_group'), 't2.id = t1.Assigned_to', array('group_name' => 't2.group_name'))
                //->joinLeft(array('t3' => 'pm_au_equipment_readings'), 't3.AU_Template_Reading_ID = t1.AU_Template_Reading_ID', array('Start_Date' => 't3.Start_Date'))
                //->joinLeft(array('t3' => 'pm_au_temporary'), 't3.AU_Template_Designation_ID = t1.AU_Template_Designation_ID', array('Start_Date' => 't3.Start_Date'))
                ->where("t1.Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('t1.AU_Template_Designation_ID=?', $desig_id);
        }
        //$select = $select->order('view_order ASC')->group('t1.AU_Template_Reading_ID');
        $select = $select->order('view_order ASC');

        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }
    
    public function GetAllEquipmentReadingParentsubset($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        //$select = $db->select()->from(array('t1'=>'pm_au_temporary_template_reading'), array('AU_Template_Reading_ID'=>'t1.AU_Template_Reading_ID'));

        $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_reading'), array('count(*) as c'));

        $res = $db->fetchAll($select);

        $count = $res[0]->c;
        if ($count > 0) {
            $table = 'pm_au_temporary_template_reading';
        } else {
            $table = 'pm_au_template_reading';
        }

        $select = $db->select()
                ->from(array('t1' => $table), array('AU_Template_Reading_ID' => 't1.AU_Template_Reading_ID', 'AU_Template_Designation_ID' => 't1.AU_Template_Designation_ID', 'AU_Frequency_ID' => 't1.AU_Frequency_ID', 'Reading_Instruction' => 't1.Reading_Instruction', 'Start_date' => 't1.Start_date', 'Assigned_to' => 't1.Assigned_to', 'Parent_ID' => 't1.Parent_ID'))
                ->joinLeft(array('t2' => 'email_group'), 't2.id = t1.Assigned_to', array('group_name' => 't2.group_name'));
                //->joinLeft(array('t3' => 'pm_au_equipment_readings'), 't3.AU_Template_Reading_ID = t1.AU_Template_Reading_ID', array('Start_Date' => 't3.Start_Date'))
                //->joinLeft(array('t3' => 'pm_au_temporary'), 't3.AU_Template_Designation_ID = t1.AU_Template_Designation_ID', array('Start_Date' => 't3.Start_Date'))
               // ->where("t1.Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('t1.AU_Template_Designation_ID=?', $desig_id);
        }
        //$select = $select->order('view_order ASC')->group('t1.AU_Template_Reading_ID');
        $select = $select->order('view_order ASC');

        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetEquipmentTemplateReadingBysubsetId($suset_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($suset_id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_reading'))
                    ->where("Parent_ID=?", $suset_id);
        }
        $select = $select->order('view_order ASC');
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetEquipmentTemplateReadingDataById($id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_reading'))
                    ->where("AU_Template_Reading_ID=?", $id);
        }
        //$select = $select->order('view_order ASC');
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /// update task data        
    public function UpdateEquipmentTemplateReading($data, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //print_r($taskdata);
        if (!empty($data)) {
            try {
                $condition = array('AU_Template_Reading_ID = ' . $id);
                $db->update('pm_au_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deleteEquipmentTemplateTask($id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('AU_Template_Task_ID = ' . $id);
            $db->delete('pm_au_template_task', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteEquipmentTemplateTaskByParentId($parent_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('Parent_ID = ' . $parent_id);
            $db->delete('pm_au_template_task', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteEquipmentTemplateReadingByParentId($parent_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('Parent_ID = ' . $parent_id);
            $db->delete('pm_au_template_reading', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    //task 
    public function getallEquipmentTemplateParent($Parent_ID) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($Parent_ID)) {
            $select = $db->select()
                    ->from(array('pm_au_template_task'))
                    ->where("Parent_ID = " . $Parent_ID);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    //reading 
    public function getallEquipmentTemplateparent_reading($Parent_ID) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($Parent_ID)) {
            $select = $db->select()
                    ->from(array('pm_au_template_task'))
                    ->where("Parent_ID = " . $Parent_ID);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function UpdateEquipmentTemplateTaskByparent($data, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //print_r($taskdata);
        if (!empty($data)) {
            try {
                $condition = array('Parent_ID = ' . $id);
                $db->update('pm_au_template_task', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function UpdateTaskByparent($data, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //print_r($taskdata);
        if (!empty($data)) {
            try {
                $condition = array('Parent_ID = ' . $id);
                $db->update('pm_vt_template_task', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function UpdateReadingByparent($data, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //print_r($taskdata);
        if (!empty($data)) {
            try {
                $condition = array('Parent_ID = ' . $id);
                $db->update('pm_vt_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function UpdateEquipmentTemplateReadingByparent($data, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //print_r($taskdata);
        if (!empty($data)) {
            try {
                $condition = array('Parent_ID = ' . $id);
                $db->update('pm_au_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function UpdateEquipmentTemplateOdrderReading($data, $reading_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {

                $condition = array('AU_Template_Reading_ID = ' . $reading_id);
                $db->update('pm_au_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /* Reading module start  */

    public function GetEquipmentTemplateSubsetreadingByName($SubsetName, $id, $desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($SubsetName)) {
            $select = $db->select()
                    ->from(array('pm_au_template_reading'))
                    ->where("Reading_Instruction=?", $SubsetName)
                    ->where("Parent_ID=?", 0);
            if (!empty($id)) {
                $select = $select->where('AU_Template_Reading_ID!=?', $id);
            }
            if (!empty($id)) {
                $select = $select->where('AU_Template_Designation_ID=?', $desig_id);
            }
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    ///// group update section start 

    public function updateEquipmentTemplate_grouptask($data, $desig_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $desig_id;
                if ($includesubset == "") {
                    $con .= ' and Parent_ID = 0 ';
                }
                $con .= ' and AU_Frequency_ID is not null';
                $condition = array($con);
                $db->update('pm_au_template_task', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function updateEquipmentTemplate_grouptasksubset($data, $desig_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $desig_id;
                $con .= ' and Parent_ID = ' . $Parent_ID;
                $con .= ' and AU_Frequency_ID is not null ';
                $condition = array($con);
                $db->update('pm_au_template_task', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /*  Insert the PM Frequency data  */

    public function InsertEquipmentTemplateFrequencyData($data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $insert = $db->insert('pm_frequency', $data);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /*  Group modification start date of month update function */

    public function updateEquipmentTemplate_grouptask_startdateofmonth($data, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'id=' . $id;
                $condition = array($con);
                $db->update('pm_au_template_task', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /* get all task before update chaeck the date */

    public function GetallEquipmentTemplatetaskbygroupmodification($id, $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_task'));

            if (!empty($includesubset)) {
                $select = $select->where("pm_au_template_name_id = " . $id . "  and frequency is not null");
            } else {
                $select = $select->where("pm_au_template_name_id = " . $id . " and Parent_ID = 0 and frequency is not null");
            }
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* get all frequency data */

    public function GetallEquipmentTemplatestartdateadjustment() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                ->from(array('pm_au_startdateadjustment'), Array('AU_sda_ID', 'Name'));
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* get all task job time data */

    public function GetallEquipmentTemplatejobtime() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                ->from(array('pm_au_jobtime'), Array('AU_JobTime_ID', 'JobTime_Name', 'JobTime_Value'));
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* get all Unit of Measure data */

    public function GetallEquipmentTemplateunitofmeasure() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                ->from(array('pm_au_unitofmeasure'), Array('AU_uom_ID', 'Name'));
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetallEquipmentTemplatetasksubsetbygroupmodification($id, $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_task'))
                    ->where("pm_au_template_name_id = " . $id . "  and Parent_ID = '" . $Parent_ID . "'");
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* Reading Group modification start */

    public function updateEquipmentTemplate_groupreading($data, $desig_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $desig_id;
                if ($includesubset == "") {
                    $con .= ' and Parent_ID = 0 ';
                }
                $con .= ' and AU_Frequency_ID is not null';
                $condition = array($con);
                $db->update('pm_au_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function updateEquipmentTemplate_groupreadingsubset($data, $desig_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $desig_id;
                $con .= ' and Parent_ID = ' . $Parent_ID;
                $con .= ' and AU_Frequency_ID is not null ';
                $condition = array($con);
                $db->update('pm_au_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /* get all Reading before update chaeck the date */

    public function GetallEquipmentTemplatereadingbygroupmodification($id, $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_reading'));

            if (!empty($includesubset)) {
                $select = $select->where("pm_au_template_name_id = " . $id . "  and frequency is not null");
            } else {
                $select = $select->where("pm_au_template_name_id = " . $id . " and Parent_ID = 0 and frequency is not null");
            }
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /*  Group modification start date of month update function */

    public function updateEquipmentTemplate_groupreading_startdateofmonth($data, $id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'id=' . $id;
                $condition = array($con);
                $db->update('pm_au_template_reading', $data, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function GetallEquipmentTemplatereadingsubsetbygroupmodification($id, $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_reading'))
                    ->where("pm_au_template_name_id = " . $id . "  and Parent_ID = '" . $Parent_ID . "'");
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* View table in list */

    public function getEquipmentTemplate_view_table($type) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($type)) {
            $select = $db->select()
                    ->from(array('pm_view_tables'))
                    ->where("pm_type = '" . $type . "'");
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* Import Template section */

    public function get_allEquipmentTemplate_typedesignation($id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($id)) {
            $select = $db->select()
                    //->setIntegrityCheck(false) 
                    //->distinct() 
                    ->from(array('pty' => 'pm_au_template_typedesignation'), array('DISTINCT(pty.AU_TypeDesignation)'))
                    //->from($this->_dbTable, new Zend_Db_Expr('DISTINCT(field_1) as field_1'))
                    //$this->_dbTable, new Zend_Db_Expr('DISTINCT(field_1) as field_1')
                    ->joinInner(array('pt' => 'pm_au_template_task'), 'pty.AU_Template_Designation_ID = pt.AU_Template_Designation_ID', array('pty.AU_Template_Designation_ID'))
                    ->where("pty.AU_Template_Designation_ID != " . $id);
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function getEquipmentTemplate_subsetbyid($table_name, $desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("AU_Template_Designation_ID = " . $desig_id . " and AU_Frequency_ID is null and Parent_ID = 0");
        }
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function getEquipmentTemplate_taskbysubsetId($table_name, $desig_id, $Parent_ID) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("AU_Template_Designation_ID = " . $desig_id . "  and Parent_ID = " . $Parent_ID);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function getEquipmentTemplate_tabledata($table_name, $desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("AU_Template_Designation_ID = " . $desig_id . " and AU_Frequency_ID is not null  and Parent_ID = 0");
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function getEquipmentTemplate_FrequencydataByID($FreqId) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($FreqId)) {
            $select = $db->select()
                    ->from(array('pm_frequency'))
                    ->where("id = " . $FreqId);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    /* cronjob module function start */

    public function getEquipmentTemplatetaskdata($temp_id = "") {

        $db = Zend_Db_Table::getDefaultAdapter();
        if (empty($temp_id)) {
            $select = $db->select()
                    ->from(array('pt' => 'pm_au_template_task'), array('pt.Interval_Value as Interval_Data', 'pt.*'))
                    ->joinInner(array('pf' => 'pm_au_frequency'), 'pt.AU_Frequency_ID = pf.AU_Frequency_ID')
                    ->joinInner(array('ps' => 'pm_au_startdateadjustment'), 'pt.AU_sda_ID = ps.AU_sda_ID')
                    ->where("pt.AU_Template_Designation_ID > 1");
        }
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    // Import Template function

    public function GetallAUTemplateDetails($build_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($build_ID)) {
            $select = $db->select()
                    ->from(array('patn' => 'pm_au_template_name'))
                    ->joinInner(array('patt' => 'pm_au_template_typedesignation'), 'patn.AU_Template_Name_ID = patt.AU_Template_Name_ID')
                    ->where("BuildingID =?", $build_ID)
                    ->order('patn.AU_Template_Name');
        }

        $res = $db->fetchAll($select);
        //echo '<pre>';
        //print_r($res);
        //die;
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetallAUTemplateDetailsByUserId($build_ID = "", $user_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($build_ID)) {
            $select = $db->select()
                    ->from(array('patn' => 'pm_au_template_name'))
                    //->joinInner(array('patt' => 'pm_au_template_typedesignation'), 'patn.AU_Template_Name_ID = patt.AU_Template_Name_ID')
                    ->where("BuildingID =?", $build_ID)
                    ->order('patn.AU_Template_Name');


            //->where("user_id =?",$user_id);
        }
        //echo $select;
        //die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetallVTTemplateDetails() {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('patn' => 'pm_vt_template_name'))
                ->joinInner(array('patt' => 'pm_vt_template_typedesignation'), 'patn.VT_Template_Name_ID = patt.VT_Template_Name_ID')
                ->order('patn.VT_Template_Name');

        $res = $db->fetchAll($select);
        //print_r($res);
        //die;
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetallTaskBysubsetIdImport($suset_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($suset_id)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_task'), array('Task_Instruction', 'VT_Template_Task_ID', 'View_order', 'AU_Frequency_ID'))
                    ->where("Parent_ID=?", $suset_id);
        }
        $select = $select->order('view_order ASC');

        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetallReadingBysubsetIdImport($suset_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($suset_id)) {
            $select = $db->select()
                    ->from(array('pm_vt_template_reading'), array('Reading_Instruction', 'VT_Template_Reading_ID', 'View_order', 'AU_Frequency_ID'))
                    ->where("Parent_ID=?", $suset_id);
        }
        $select = $select->order('view_order ASC');

        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAlltaskparentImport($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                ->from(array('pm_vt_template_task'), array('Task_Instruction', 'VT_Template_Task_ID', 'View_order', 'AU_Frequency_ID'))
                ->where("Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('VT_Template_Designation_ID=?', $desig_id);
        }
        $select = $select->order('view_order ASC');
        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetAllreadingparentImport($desig_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()
                ->from(array('pm_vt_template_reading'), array('Reading_Instruction', 'VT_Template_Reading_ID', 'View_order', 'AU_Frequency_ID'))
                ->where("Parent_ID=?", 0);
        if (!empty($desig_id)) {
            $select = $select->where('VT_Template_Designation_ID=?', $desig_id);
        }
        $select = $select->order('view_order ASC');
        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetTemplateandDesighationDetails_import($desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array('patn' => 'pm_vt_template_name'))
                    ->joinInner(array('patt' => 'pm_vt_template_typedesignation'), 'patn.VT_Template_Name_ID = patt.VT_Template_Name_ID')
                    ->where('VT_Template_Designation_ID=?', $desig_id);
            $res = $db->fetchAll($select);
        }
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetTemplateandDesighationDetailsAu_import($desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array('patn' => 'pm_au_template_name'))
                    ->joinInner(array('patt' => 'pm_au_template_typedesignation'), 'patn.AU_Template_Name_ID = patt.AU_Template_Name_ID')
                    ->where('AU_Template_Designation_ID=?', $desig_id);
            $res = $db->fetchAll($select);
        }
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function getEquipmentTemplate_subsetbyid_import($table_name, $desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("VT_Template_Designation_ID = " . $desig_id . " and AU_Frequency_ID is null and Parent_ID = 0");
        }
        //echo $select;
        // die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function getEquipmentTemplate_taskbysubsetId_import($table_name, $desig_id, $Parent_ID) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("VT_Template_Designation_ID = " . $desig_id . "  and Parent_ID = " . $Parent_ID);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetEquipmentTemplateReadingBysubsetId_import($suset_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($suset_id)) {
            $select = $db->select()
                    ->from(array('pm_au_template_reading'), array('Reading_Instruction', 'AU_Template_Reading_ID', 'Start_date', 'Assigned_to', 'View_order', 'AU_Frequency_ID'))
                    ->joinLeft(array('t2' => 'email_group'), 't2.id = pm_au_template_reading.Assigned_to', array('group_name' => 't2.group_name'))
                    ->where("Parent_ID=?", $suset_id);
        }
        $select = $select->order('view_order ASC');
        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetEquipmentTemplateReadingBysubsetId_import_change($suset_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //$select = $db->select()->from(array('t1'=>'pm_au_temporary_template_reading'), array('AU_Template_Reading_ID'=>'t1.AU_Template_Reading_ID'));
        $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_reading'), array('count(*) as c'));
        $res = $db->fetchAll($select);
        $count = $res[0]->c;
        if ($count > 0) {
            $table = 'pm_au_temporary_template_reading';
        } else {
            $table = 'pm_au_template_reading';
        }
        if (!empty($suset_id)) {
            $select = $db->select()
                    ->from(array('t1' => $table), array('AU_Template_Reading_ID' => 't1.AU_Template_Reading_ID', 'AU_Template_Designation_ID' => 't1.AU_Template_Designation_ID', 'AU_Frequency_ID' => 't1.AU_Frequency_ID', 'Reading_Instruction' => 't1.Reading_Instruction', 'Start_date' => 't1.Start_date', 'Assigned_to' => 't1.Assigned_to', 'Parent_ID' => 't1.Parent_ID'))
                    ->joinLeft(array('t2' => 'email_group'), 't2.id = t1.Assigned_to', array('group_name' => 't2.group_name'))
                    //->joinLeft(array('t3' => 'pm_au_equipment_readings'), 't3.AU_Template_Reading_ID = t1.AU_Template_Reading_ID', array('Start_Date' => 't3.Start_Date'))
                    //->joinLeft(array('t3' => 'pm_au_temporary'), 't3.AU_Template_Designation_ID = t1.AU_Template_Designation_ID', array('Start_Date' => 't3.Start_Date'))
                    ->where("t1.Parent_ID=?", $suset_id);
        }
        $select = $select->order('view_order ASC');
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetallTaskBysubsetId_Import($suset_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($suset_id)) {
            $select = $db->select()
                    ->from(array('t1'=>'pm_au_template_task'), array('Task_Instruction'=>'t1.Task_Instruction', 'AU_Template_Task_ID'=>'t1.AU_Template_Task_ID', 'Start_date'=>'t1.Start_date', 'Assigned_to'=>'t1.Assigned_to', 'View_order'=>'t1.View_order', 'AU_Frequency_ID'=>'t1.AU_Frequency_ID'))
                    ->joinLeft(array('t2' => 'email_group'), 't2.id = t1.Assigned_to', array('group_name' => 't2.group_name'))
                    ->where("t1.Parent_ID=?", $suset_id);
        }
        $select = $select->order('t1.view_order ASC');

        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function GetallTaskBysubsetId_Import_change($suset_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //$select = $db->select()->from(array('t1'=>'pm_au_temporary_template_task'), array('AU_Template_Task_ID'=>'t1.AU_Template_Task_ID'));
        $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_task'), array('count(*) as c'));
        $res = $db->fetchAll($select);
        $count = $res[0]->c;
        if ($count > 0) {
            $table = 'pm_au_temporary_template_task';
        } else {
            $table = 'pm_au_template_task';
        }

        if (!empty($suset_id)) {
            $select = $db->select()
                    ->from(array('t1' => $table), array('AU_Template_Task_ID' => 't1.AU_Template_Task_ID', 'AU_Template_Designation_ID' => 't1.AU_Template_Designation_ID', 'Task_Instruction' => 't1.Task_Instruction', 'AU_Frequency_ID' => 't1.AU_Frequency_ID', 'Start_date' => 't1.Start_date', 'Assigned_to' => 't1.Assigned_to', 'Parent_ID' => 't1.Parent_ID'))
                    ->joinLeft(array('t2' => 'email_group'), 't2.id = t1.Assigned_to', array('group_name' => 't2.group_name'))
                    //->joinLeft(array('t3' => 'pm_au_equipment_task'), 't3.AU_Template_Task_ID = t1.AU_Template_Task_ID', array('Start_Date' => 't3.Start_Date'))
                    //->joinLeft(array('t3' => 'pm_au_temporary'), 't3.AU_Template_Designation_ID = t1.AU_Template_Designation_ID', array('Start_Date' => 't3.Start_Date')) 
                    ->where("t1.Parent_ID=?", $suset_id);
        }
        //$select = $select->order('view_order ASC')->group('t1.AU_Template_Task_ID');
        $select = $select->order('view_order ASC');

        $res = $db->fetchAll($select);
        return $res;
        //return ($res && sizeof($res) > 0) ? $res : false;
    }
    
    

    /*     * ***************** Equipment section start *********************************** */

    public function InsertEquipment($equipmentname) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($equipmentname)) {
            try {
                $insert = $db->insert('pm_au_equipment_name', $equipmentname);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function InsertEquipmentDetails($data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $insert = $db->insert('pm_au_equipment_detail', $data);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function getallEquipmentNameByBuildId($build_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($build_id)) {
            $select = $db->select()
                    ->from(array("pm_au_equipment_name"))
                    ->where("BuildingID =?", $build_id)
                    ->order('AU_Equipment_Name');
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function getallEquipmentDetail($build_id = "", $equipid = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($build_id)) {
            $select = $db->select()
                    ->from(array("pm_au_equipment_detail"))
                    ->where("BuildingID =?", $build_id)
                    ->where("AU_Equipment_Name_ID =?", $equipid);
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function checkEquipment($data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            $select = $db->select()
                    ->from(array("pm_au_equipment_name"), array("AU_Equipment_Name_ID"))
                    ->where("BuildingID = " . $data['BuildingID'] . " and AU_Equipment_Name like '" . $data['AU_Equipment_Name'] . "%'");
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function getEquipmentNameByEquipmentId($equipment_id) {

        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($equipment_id)) {
            $select = $db->select()
                    ->from(array("pm_au_equipment_name"), array("AU_Equipment_Name_ID", "AU_Equipment_Name"))
                    ->where("AU_Equipment_Name_ID = " . $equipment_id . "");
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function updateequipmentname($update, $equipment_id) {

        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($update)) {

            try {
                $condition = array("AU_Equipment_Name_ID = '" . $equipment_id . "'");
                $db->update('pm_au_equipment_name', $update, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function getEquipmentNameByName($equipment_Name, $building_id) {
        //die('come here!');
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($equipment_Name)) {
            $select = $db->select()
                    ->from(array('pm_au_equipment_name'))
                    ->where("AU_Equipment_Name=?", $equipment_Name);

            if (!empty($building_id)) {
                $select = $select->where('BuildingID=?', $building_id);
            }
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function checkUnitWithFloor($data, $building_id) {
        $equipment_id = $data['equipment_id'];
        $unit = $data['unit'];
        $floor = $data['floor'];
        $flag = 0;
        if ($unit == $floor) {
            $flag = 1;
        }
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($equipment_id)) {
            $select = $db->select()
                    ->from(array('pm_au_equipment_detail'));
            if ($flag == 1) {
                $select->where("AU_Equipment_Name_ID=?", $equipment_id);
                $select->where("Equipment_Floor=?", $unit);
            } else {
                $select->where("AU_Equipment_Name_ID=?", $equipment_id);
                $select->where("Equipment_Floor=?", $floor);
                $select->where("Equipment_Unit=?", $unit);
            }

            if (!empty($building_id)) {
                $select = $select->where('BuildingID=?', $building_id);
            }
            $res = $db->fetchAll($select);
            return ($res && sizeof($res) > 0) ? 1 : 0;
        } else {
            return 0;
        }
    }

    public function insertEquipmentTask($data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $insert = $db->insert('pm_au_equipment_task', $data);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function insertEquipmentReadings($data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $insert = $db->insert('pm_au_equipment_readings', $data);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deleteDataFromTemporaryTable() {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $db->delete('pm_au_temporary_template_task');
            $db->delete('pm_au_temporary_template_reading');
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getTemplateTaskIdByDesignationId($table_name, $desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array('t1' => $table_name), array('t1.*'))
                    ->where("t1.AU_Template_Designation_ID = " . $desig_id . "");
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function getTemplateReadingIdByDesignationId($table_name, $desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name), array('AU_Template_Reading_ID', 'Start_date', 'End_date','Startdate_month'))
                    ->where("AU_Template_Designation_ID = " . $desig_id . "");
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function startDateUpdateForTask($data, $desig_id = "", $includesubset = "") {

        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $desig_id;
                $con .= ' AND AU_Frequency_ID is not null';
                $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_task'), array('count(*) as c'));
                $res = $db->fetchAll($select);
                $count = $res[0]->c;
                if ($count > 0) {
                    if ($includesubset == "") {
                        $con .= ' AND Parent_ID = 0 ';
                    }
                    $condition = array($con);
                    $db->update('pm_au_temporary_template_task', $data, $condition);
                } else {
                    $db->query("INSERT INTO pm_au_temporary_template_task (AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at)
SELECT AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at FROM pm_au_template_task as t1
Where t1.AU_Template_Designation_ID='" . $desig_id . "'");
                    if ($includesubset == "") {
                        $con .= ' AND Parent_ID = 0 ';
                    }
                    $condition = array($con);
                    $db->update('pm_au_temporary_template_task', $data, $condition);
                }

                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function startDateUpdateForTaskSubset($data, $desig_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $desig_id;
                $con .= ' and Parent_ID = ' . $Parent_ID;
                $con .= ' and AU_Frequency_ID is not null ';
                $condition = array($con);
                $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_task'), array('count(*) as c'));
                $res = $db->fetchAll($select);
                $count = $res[0]->c;
                if ($count > 0) {

                    $db->update('pm_au_temporary_template_task', $data, $condition);
                } else {
                    $db->query("INSERT INTO pm_au_temporary_template_task (AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at)
SELECT AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at FROM pm_au_template_task as t1
Where t1.AU_Template_Designation_ID='" . $desig_id . "'");
                    $db->update('pm_au_temporary_template_task', $data, $condition);
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function startDateUpdateForReadingRoot($data, $desig_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {

                $con = 'AU_Template_Designation_ID=' . $desig_id;
                //$con .= ' and Parent_ID = ' . $Parent_ID;
                $con .= ' and AU_Frequency_ID is not null ';

                $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_reading'), array('count(*) as c'));
                $res = $db->fetchAll($select);
                $count = $res[0]->c;
                if ($count > 0) {

                    if ($includesubset == "") {
                        $con .= ' AND Parent_ID = 0 ';
                    }
                    $condition = array($con);
                    $db->update('pm_au_temporary_template_reading', $data, $condition);
                } else {
                    $db->query("INSERT INTO pm_au_temporary_template_reading (AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at)
SELECT AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at FROM pm_au_template_reading as t1
Where t1.AU_Template_Designation_ID='" . $desig_id . "'");

                    if ($includesubset == "") {
                        $con .= ' AND Parent_ID = 0 ';
                    }
                    $condition = array($con);
                    $db->update('pm_au_temporary_template_reading', $data, $condition);
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function startDateUpdateForReadingSubset($data, $desig_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $desig_id;
                $con .= ' and Parent_ID = ' . $Parent_ID;
                $con .= ' and AU_Frequency_ID is not null ';
                $condition = array($con);
                $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_reading'), array('count(*) as c'));
                $res = $db->fetchAll($select);
                $count = $res[0]->c;
                if ($count > 0) {
                    $db->update('pm_au_temporary_template_reading', $data, $condition);
                } else {
                    $db->query("INSERT INTO pm_au_temporary_template_reading (AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at)
SELECT AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at FROM pm_au_template_reading as t1
Where t1.AU_Template_Designation_ID='" . $desig_id . "'");
                    $db->update('pm_au_temporary_template_reading', $data, $condition);
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function assignUpdateForTask($data, $desig_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {

                $con = 'AU_Template_Designation_ID=' . $desig_id;
                $con .= ' AND AU_Frequency_ID is not null';
                $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_task'), array('count(*) as c'));
                $res = $db->fetchAll($select);
                $count = $res[0]->c;
                if ($count > 0) {
                    if ($includesubset == "") {
                        $con .= ' AND Parent_ID = 0 ';
                    }
                    $condition = array($con);
                    $db->update('pm_au_temporary_template_task', $data, $condition);
                } else {
                    $db->query("INSERT INTO pm_au_temporary_template_task (AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at)
SELECT AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at FROM pm_au_template_task as t1
Where t1.AU_Template_Designation_ID='" . $desig_id . "'");
                    if ($includesubset == "") {
                        $con .= ' AND Parent_ID = 0 ';
                    }
                    $condition = array($con);
                    $db->update('pm_au_temporary_template_task', $data, $condition);
                }

                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function assignUpdateForTaskSubset($data, $desig_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $desig_id;
                $con .= ' and Parent_ID = ' . $Parent_ID;
                $con .= ' and AU_Frequency_ID is not null ';
                $condition = array($con);
                $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_task'), array('count(*) as c'));
                $res = $db->fetchAll($select);
                $count = $res[0]->c;
                if ($count > 0) {
                    $db->update('pm_au_temporary_template_task', $data, $condition);
                } else {
                    $db->query("INSERT INTO pm_au_temporary_template_task (AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at)
SELECT AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at FROM pm_au_template_task as t1
Where t1.AU_Template_Designation_ID='" . $desig_id . "'");
                    $db->update('pm_au_temporary_template_task', $data, $condition);
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function assignUpdateForReadingRoot($data, $desig_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $desig_id;
                //$con .= ' and Parent_ID = ' . $Parent_ID;
                $con .= ' and AU_Frequency_ID is not null ';

                $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_reading'), array('count(*) as c'));
                $res = $db->fetchAll($select);
                $count = $res[0]->c;
                if ($count > 0) {

                    if ($includesubset == "") {
                        $con .= ' AND Parent_ID = 0 ';
                    }
                    $condition = array($con);
                    $db->update('pm_au_temporary_template_reading', $data, $condition);
                } else {
                    $db->query("INSERT INTO pm_au_temporary_template_reading (AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at)
SELECT AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at FROM pm_au_template_reading as t1
Where t1.AU_Template_Designation_ID='" . $desig_id . "'");

                    if ($includesubset == "") {
                        $con .= ' AND Parent_ID = 0 ';
                    }
                    $condition = array($con);
                    $db->update('pm_au_temporary_template_reading', $data, $condition);
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function assignUpdateForReadingSubset($data, $desig_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $desig_id;
                $con .= ' and Parent_ID = ' . $Parent_ID;
                $con .= ' and AU_Frequency_ID is not null ';
                $condition = array($con);
                $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_reading'), array('count(*) as c'));
                $res = $db->fetchAll($select);
                $count = $res[0]->c;
                if ($count > 0) {
                    $db->update('pm_au_temporary_template_reading', $data, $condition);
                } else {
                    $db->query("INSERT INTO pm_au_temporary_template_reading (AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at)
SELECT AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at FROM pm_au_template_reading as t1
Where t1.AU_Template_Designation_ID='" . $desig_id . "'");
                    $db->update('pm_au_temporary_template_reading', $data, $condition);
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deleteEquipmentName($au_equipment_name_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('AU_Equipment_Name_ID = ' . $au_equipment_name_id);
            $db->delete('pm_au_equipment_name', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteEquipmentdetailByAuEqupmentNameId($au_equipment_name_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('AU_Equipment_Name_ID = ' . $au_equipment_name_id);
            $db->delete('pm_au_equipment_detail', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /*
     * Get Equipment list 
     */

    public function getEquipmentList($buildingId, $sortingData) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_equipment_name'), array('equipmentnameid' => 't1.AU_Equipment_Name_ID', 'AU_Equipment_Name' => 't1.AU_Equipment_Name', 'BuildingID' => 't1.BuildingID'))
                ->joinRight(array('t2' => 'pm_au_equipment_detail'), 't1.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', array('AU_Equipment_Detail_ID' => 't2.AU_Equipment_Detail_ID', 'Floor' => 't2.Equipment_Floor', 'Unit' => 't2.Equipment_Unit', 'Make Model' => 't2.Equipment_Make_Model', 'Location' => 't2.Equipment_Location', 'Notes' => 't2.Equipment_Notes','Equipment_Manual'=>'t2.Equipment_Manual'))
                ->joinLeft(array('t3' => 'pm_au_equipment_task'), 't2.AU_Equipment_Detail_ID = t3.AU_Equipment_Detail_ID', array('NextStartDate' => 't3.Start_Date', 'AU_Equipment_Task_ID' => 't3.AU_Equipment_Task_ID', 'AU_Template_Task_ID' => 't3.AU_Template_Task_ID', 'eqp_Startdate_month' => 't3.Startdate_month'))
                ->joinLeft(array('t4' => 'pm_au_template_task'), 't3.AU_Template_Task_ID = t4.AU_Template_Task_ID', array('auTemplateTaskId' => 't4.AU_Template_Task_ID', 'Task' => 't4.Task_Instruction', 'parentId' => 't4.Parent_ID', 'frequencyId' => 't4.AU_Frequency_ID', 'Startdate_month' => 't4.Startdate_month'))
                ->joinLeft(array('t6' => 'pm_au_template_typedesignation'), 't6.AU_Template_Designation_ID = t4.AU_Template_Designation_ID', array('Template' => 't6.AU_TypeDesignation', 'AU_Template_Name_ID' => 't6.AU_Template_Name_ID'))
                ->joinLeft(array('t7' => 'pm_au_template_name'), 't7.AU_Template_Name_ID = t2.AU_Template_Name_ID', array('AU_Template_Name' => 't7.AU_Template_Name'))
                ->group(array('t1.AU_Equipment_Name'))
                ->group(array('t2.Equipment_Floor'))
                ->group(array('t2.Equipment_Unit'))
                ->group(array('t2.Equipment_Make_Model'))
                ->group(array('t2.Equipment_Location'))
                ->group(array('t6.AU_TypeDesignation'))
                ->where('t2.BuildingID  = ?', $buildingId);
        if ($sortingData['id'] == '0') {
            $select->order('t1.AU_Equipment_Name DESC');
        } else {
            $select->order('t1.AU_Equipment_Name ASC');
        }

        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }

    public function getEquipmentListBy($buildingId, $sortingData) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_equipment_name'), array('equipmentnameid' => 't1.AU_Equipment_Name_ID', 'AU_Equipment_Name' => 't1.AU_Equipment_Name', 'BuildingID' => 't1.BuildingID'))
                ->joinRight(array('t2' => 'pm_au_equipment_detail'), 't1.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', array('AU_Equipment_Detail_ID' => 't2.AU_Equipment_Detail_ID', 'Floor' => 't2.Equipment_Floor', 'Unit' => 't2.Equipment_Unit', 'Make Model' => 't2.Equipment_Make_Model', 'Location' => 't2.Equipment_Location', 'Notes' => 't2.Equipment_Notes','Equipment_Manual'=>'t2.Equipment_Manual'))
                ->joinLeft(array('t3' => 'pm_au_equipment_task'), 't2.AU_Equipment_Detail_ID = t3.AU_Equipment_Detail_ID', array('t3.*', 'eqp_Startdate_month' => 't3.Startdate_month'))
                ->joinLeft(array('t4' => 'pm_au_template_task'), 't3.AU_Template_Task_ID = t4.AU_Template_Task_ID', array('auTemplateTaskId' => 't4.AU_Template_Task_ID', 'Task' => 't4.Task_Instruction', 'NextStartDate' => 't4.Start_date', 'parentId' => 't4.Parent_ID', 'frequencyId' => 't4.AU_Frequency_ID', 'Startdate_month' => 't4.Startdate_month'))
                ->joinLeft(array('t6' => 'pm_au_template_typedesignation'), 't6.AU_Template_Designation_ID = t4.AU_Template_Designation_ID', array('Template' => 't6.AU_TypeDesignation', 'AU_Template_Name_ID' => 't6.AU_Template_Name_ID'))
                ->joinLeft(array('t7' => 'pm_au_template_name'), 't7.AU_Template_Name_ID = t2.AU_Template_Name_ID', array('AU_Template_Name' => 't7.AU_Template_Name'))
                ->group(array('t1.AU_Equipment_Name'))
                ->group(array('t2.Equipment_Floor'))
                ->group(array('t2.Equipment_Unit'))
                ->group(array('t2.Equipment_Make_Model'))
                ->group(array('t2.Equipment_Location'))
                ->group(array('t6.AU_TypeDesignation'))
                ->where('t2.BuildingID  = ?', $buildingId)
                ->where('t1.AU_Equipment_Name_ID  = ?', $sortingData['equipment_name_id']);
        if ($sortingData['id'] == '0') {
            if ($sortingData['type'] == 'floor') {
                $select->order("t2.Equipment_Floor DESC");
            } else if ($sortingData['type'] == 'unit') {
                $select->order("t2.Equipment_Unit DESC");
            } else if ($sortingData['type'] == 'location') {
                $select->order("t2.Equipment_Location DESC");
            }
        } else {
            if ($sortingData['type'] == 'floor') {
                $select->order("t2.Equipment_Floor ASC");
            } else if ($sortingData['type'] == 'unit') {
                $select->order("t2.Equipment_Unit ASC");
            } else if ($sortingData['type'] == 'location') {
                $select->order("t2.Equipment_Location ASC");
            }
        }

        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }
    public function getEquipmentNameList($buildingId) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_equipment_name'), array('equipmentnameid' => 't1.AU_Equipment_Name_ID', 'AU_Equipment_Name' => 't1.AU_Equipment_Name', 'BuildingID' => 't1.BuildingID'))
                     ->where('t1.BuildingID  = ?', $buildingId);
        
        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }
    public function searchEquipment($buildingId, $sortingData) {
        $a1 = $sortingData['eqparts'];
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_equipment_name'), array('equipmentnameid' => 't1.AU_Equipment_Name_ID', 'AU_Equipment_Name' => 't1.AU_Equipment_Name', 'BuildingID' => 't1.BuildingID'))
                ->joinRight(array('t2' => 'pm_au_equipment_detail'), 't1.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', array('AU_Equipment_Detail_ID' => 't2.AU_Equipment_Detail_ID', 'Floor' => 't2.Equipment_Floor', 'Unit' => 't2.Equipment_Unit', 'MakeModel' => 't2.Equipment_Make_Model', 'Location' => 't2.Equipment_Location', 'Notes' => 't2.Equipment_Notes','Equipment_Manual'=>'t2.Equipment_Manual'))
                ->joinLeft(array('t3' => 'pm_au_equipment_task'), 't2.AU_Equipment_Detail_ID = t3.AU_Equipment_Detail_ID', array('AU_Equipment_Task_ID' => 't3.AU_Equipment_Task_ID', 'AU_Template_Task_ID' => 't3.AU_Template_Task_ID', 'Start_Date' => 't3.Start_Date', 'End_Date' => 't3.End_Date', 'Startdate_month' => 't3.Startdate_month', 'Email_group_ID' => 't3.Email_group_ID', 'AU_Assign_Vendor' => 't3.AU_Assign_Vendor', 'Vendor_ID' => 't3.Vendor_ID'))
                ->joinLeft(array('t4' => 'pm_au_template_task'), 't3.AU_Template_Task_ID = t4.AU_Template_Task_ID', array('auTemplateTaskId' => 't4.AU_Template_Task_ID', 'Task' => 't4.Task_Instruction', 'NextStartDate' => 't4.Start_date', 'parentId' => 't4.Parent_ID', 'frequencyId' => 't4.AU_Frequency_ID', 'Startdate_month' => 't4.Startdate_month'))
                ->joinLeft(array('t5' => 'pm_au_template_typedesignation'), 't2.AU_Template_Name_ID = t5.AU_Template_Name_ID', array('Template' => 't5.AU_TypeDesignation'))
                ->group(array('t1.AU_Equipment_Name'))
                ->group(array('t2.Equipment_Floor'))
                ->group(array('t2.Equipment_Unit'))
                ->group(array('t2.Equipment_Make_Model'))
                ->group(array('t2.Equipment_Location'))
                ->group(array('t2.AU_Equipment_Detail_ID'))
                ->where('t2.BuildingID  = ?', $buildingId)
                ->where('t1.AU_Equipment_Name  = ?', $sortingData['eqname']);
        if (!empty($sortingData['eqparts'])) {
            //$select->where('t2.Equipment_Location LIKE ?', $sortingData['eqparts'].'%');
            $select->where("t2.Equipment_Floor LIKE '" . $a1 . "%' or t2.Equipment_Unit LIKE '" . $a1 . "%' or t2.Equipment_Location LIKE '" . $a1 . "%' or t2.Equipment_Make_Model LIKE '" . $a1 . "%' or t5.AU_TypeDesignation LIKE '" . $a1 . "%'");
        }

        //$select->ORwhere('t2.Equipment_Make_Model LIKE ?', $sortingData['eqparts'].'%');
        //$sql = $select->__toString();
        //echo "$sql\n";

        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }

    public function getTemplateTask($equipmentDetailId, $subset_id = '') {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_template_task'), array('AU_Template_Task_ID' => 't1.AU_Template_Task_ID', 'Parent_ID' => 't1.Parent_ID', 'AU_Frequency_ID' => 't1.AU_Frequency_ID', 'Task_Instruction' => 't1.Task_Instruction', 'Startdate_month' => 't1.Startdate_month', 'AU_sda_ID' => 't1.AU_sda_ID', 'Assigned_to' => 't1.Assigned_to', 'Seasonal_Task' => 't1.Seasonal_Task', 'Seasonal_Start_Date' => 't1.Seasonal_Start_Date', 'Seasonal_End_Date' => 't1.Seasonal_End_Date', 'End_date' => 't1.End_date', 'Task_jobtime' => 't1.Task_jobtime', 'View_order' => 't1.View_order', 'overtime' => 't1.overtime', 'AU_Template_Designation_ID' => 't1.AU_Template_Designation_ID','Interval_Value'=>'t1.Interval_Value'))
                ->joinleft(array('t2' => 'pm_au_equipment_task'), 't1.AU_Template_Task_ID=t2.AU_Template_Task_ID', array('AU_Equipment_Task_ID' => 't2.AU_Equipment_Task_ID', 'AU_Template_Task_ID' => 't2.AU_Template_Task_ID', 'Start_date' => 't2.Start_Date', 'Email_group_ID' => 't2.Email_group_ID', 'AU_Assign_Vendor' => 't2.AU_Assign_Vendor', 'eqp_Startdate_month' => 't2.Startdate_month'))
                ->joinleft(array('t3' => 'pm_au_frequency'), 't3.AU_Frequency_ID=t1.AU_Frequency_ID', array('Frequency_name' => 't3.Name'))
                ->joinleft(array('t4' => 'pm_au_startdateadjustment'), 't4.AU_sda_ID=t1.AU_sda_ID', array('startdateadj_name' => 't4.Name'))
                ->joinleft(array('t5' => 'email_group'), 't5.id=t2.Email_group_ID', array('group_name' => 't5.group_name'))
                ->joinLeft(array('t6' => 'pm_au_jobtime'), 't6.JobTime_Value=t1.Task_jobtime', array('JobTime_Name' => 't6.JobTime_Name'))
                ->order('t1.View_order')
                ->order('t1.AU_Template_Task_ID')
                ->where('t2.AU_Equipment_Detail_ID  = ?', $equipmentDetailId);
        if (!empty($subset_id)) {
            $select->where('t2.AU_Template_Task_ID  = ?', $subset_id);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }

    public function getTemplateReading($equipmentDetailId, $subset_id = '') {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_template_reading'), array('AU_Template_Reading_ID' => 't1.AU_Template_Reading_ID', 'Parent_ID' => 't1.Parent_ID', 'AU_Frequency_ID' => 't1.AU_Frequency_ID', 'Reading_Instruction' => 't1.Reading_Instruction', 'Startdate_month' => 't1.Startdate_month', 'AU_sda_ID' => 't1.AU_sda_ID', 'Assigned_to' => 't1.Assigned_to', 'View_order' => 't1.View_order', 'Seasonal_Task' => 't1.Seasonal_Task', 'Reading_Value' => 't1.Reading_Value', 'Tolerance' => 't1.Tolerance', 'Seasonal_Start_Date' => 't1.Seasonal_Start_Date', 'Seasonal_End_Date' => 't1.Seasonal_End_Date', 'End_date' => 't1.End_date', 'Task_jobtime' => 't1.Task_jobtime', 'overtime' => 't1.overtime', 'AU_Template_Designation_ID' => 't1.AU_Template_Designation_ID'))
                ->joinleft(array('t2' => 'pm_au_equipment_readings'), 't1.AU_Template_Reading_ID=t2.AU_Template_Reading_ID', array('AU_Template_Reading_ID' => 't2.AU_Template_Reading_ID', 'Start_date' => 't2.Start_Date', 'Email_group_ID' => 't2.Email_group_ID', 'AU_Equipment_Readings_ID' => 't2.AU_Equipment_Readings_ID', 'AU_Assign_Vendor' => 't2.AU_Assign_Vendor', 'eqp_Startdate_month' => 't2.Startdate_month'))
                ->joinleft(array('t3' => 'pm_au_frequency'), 't3.AU_Frequency_ID=t1.AU_Frequency_ID', array('Frequency_name' => 't3.Name'))
                ->joinleft(array('t4' => 'pm_au_startdateadjustment'), 't4.AU_sda_ID=t1.AU_sda_ID', array('startdateadj_name' => 't4.Name'))
                ->joinleft(array('t5' => 'email_group'), 't5.id=t2.Email_group_ID', array('group_name' => 't5.group_name'))
                ->joinleft(array('t6' => 'pm_au_jobtime'), 't6.JobTime_Value=t1.Task_jobtime', array('JobTime_Name' => 't6.JobTime_Name'))
                ->joinLeft(array('t7' => 'pm_au_unitofmeasure'), 't7.AU_uom_ID=t1.AU_uom_ID', array('Name' => 't7.Name'))
                ->order('t1.View_order')
                ->where('t2.AU_Equipment_Detail_ID  = ?', $equipmentDetailId);
        if (!empty($subset_id)) {
            $select->where('t2.AU_Template_Reading_ID = ?', $subset_id);
        }
        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }

    public function getDateUpdate($data) {
        $yrdata = strtotime($data['dateToUpdate']);
        $updata['Start_date'] = date('M Y', $yrdata);
        //$updata['AU_Template_Designation_ID'] = $data['templateDesignId'];
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $data['templateDesignId'];
                $condition = array($con);

                $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_task'), array('count(*) as c'));
                $res = $db->fetchAll($select);
                $count = $res[0]->c;
                if ($count > 0) {
                    $db->update('pm_au_temporary_template_task', $updata, $condition);

                    $db->update('pm_au_temporary_template_reading', $updata, $condition);
                } else {
                    $db->delete('pm_au_temporary_template_task');

                    $db->delete('pm_au_temporary_template_reading');

                    $db->query("INSERT INTO pm_au_temporary_template_task (AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at)
SELECT AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at FROM pm_au_template_task as t1
Where t1.AU_Template_Designation_ID='" . $data['templateDesignId'] . "'");

                    $db->query("INSERT INTO pm_au_temporary_template_reading (AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at)
SELECT AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at FROM pm_au_template_reading as t1
Where t1.AU_Template_Designation_ID='" . $data['templateDesignId'] . "'");

                    $db->update('pm_au_temporary_template_task', $updata, $condition);

                    $db->update('pm_au_temporary_template_reading', $updata, $condition);
                }

                //$db->delete('pm_au_temporary');
                //$insert = $db->insert('pm_au_temporary', $updata);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function getUpdateAssignToAll($data) {
        $updata['Assigned_to'] = $data['assignto'];
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $con = 'AU_Template_Designation_ID=' . $data['templateDesignId'];
                $condition = array($con);
                $db->update('pm_au_template_task', $updata, $condition);
                $db->update('pm_au_template_reading', $updata, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /*
     * This is for get the Table Name of Task
     */

    public function getTableNameOfTask() {
        $db = Zend_Db_Table::getDefaultAdapter();

        try {
            $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_task'), array('count(*) as c'));
            $res = $db->fetchAll($select);
            $count = $res[0]->c;
            if ($count > 0) {
                $table = 'pm_au_temporary_template_task';
            } else {
                $table = 'pm_au_template_task';
            }
            return $table;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /*
     * This is for get the table name of Reading
     */

    public function getTableNameOfReading() {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_reading'), array('count(*) as c'));
            $res = $db->fetchAll($select);
            $count = $res[0]->c;
            if ($count > 0) {
                $table = 'pm_au_temporary_template_reading';
            } else {
                $table = 'pm_au_template_reading';
            }
            return $table;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /*
     * This is for Update Group email Id
     */

    public function updateEmailGroupId($updata, $desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();

        try {
            $con = 'AU_Template_Designation_ID=' . $desig_id;
            $condition = array($con);
            $select = $db->select()->from(array('t1' => 'pm_au_temporary_template_task'), array('count(*) as c'));
            $res = $db->fetchAll($select);
            $count = $res[0]->c;
            if ($count > 0) {
                $db->update('pm_au_temporary_template_task', $updata, $condition);
                $db->update('pm_au_temporary_template_reading', $updata, $condition);
            } else {

                $db->query("INSERT INTO pm_au_temporary_template_task (AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at)
SELECT AU_Template_Task_ID,AU_Template_Designation_ID,Task_Instruction, AU_Frequency_ID,Interval_Value,Start_date,End_date,Seasonal_Task,Seasonal_Start_Date,Seasonal_End_Date,AU_sda_ID,Startdate_month,Startdate_EOM,Task_jobtime,overtime,Assigned_to,View_order, Parent_ID,User_id,Created_at FROM pm_au_template_task as t1
Where t1.AU_Template_Designation_ID='" . $desig_id . "'");

                $db->query("INSERT INTO pm_au_temporary_template_reading (AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at)
SELECT AU_Template_Reading_ID, AU_Template_Designation_ID, AU_Frequency_ID, Reading_Instruction, Interval_Value, Reading_Value, Tolerance, Start_date, End_date, Seasonal_Task, Seasonal_Start_Date, Seasonal_End_Date, AU_sda_ID, AU_uom_ID, Startdate_month, Startdate_EOM, Task_jobtime, overtime, Assigned_to, View_order, Parent_ID, User_id, Created_at FROM pm_au_template_reading as t1
Where t1.AU_Template_Designation_ID='" . $desig_id . "'");

                $db->update('pm_au_temporary_template_task', $updata, $condition);
                $db->update('pm_au_temporary_template_reading', $updata, $condition);
            }
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateonlystartdateofequipmentdetailtaskroot($data, $eqp_detail_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                if ($includesubset == "") {
                    $db->query("UPDATE pm_au_template_task as t1, pm_au_equipment_task as t2 SET t2.Start_Date='" . $data . "' WHERE t1.AU_Template_Task_ID=t2.AU_Template_Task_ID AND t1.Parent_ID=0 AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                } else {
                    $db->query("UPDATE pm_au_template_task as t1, pm_au_equipment_task as t2 SET t2.Start_Date='" . $data . "' WHERE t1.AU_Template_Task_ID=t2.AU_Template_Task_ID AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function updateonlystartdateofequipmentdetailtasksubset($data, $eqp_detail_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $db->query("UPDATE pm_au_template_task as t1, pm_au_equipment_task as t2 SET t2.Start_Date='" . $data . "' WHERE t1.AU_Template_Task_ID=t2.AU_Template_Task_ID AND t1.Parent_ID='" . $Parent_ID . "' AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function updateonlystartdateofequipmentdetailtask($updata, $eqp_task_id = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($updata)) {
            try {
                $con = 'AU_Equipment_Task_ID=' . $eqp_task_id;
                $condition = array($con);
                $db->update('pm_au_equipment_task', $updata, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /*
     * Equipment dtail reading update start date only on root
     */

    public function updateonlystartdateofequipmentdetailreadingroot($data, $eqp_detail_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                if ($includesubset == "") {
                    $db->query("UPDATE pm_au_template_reading as t1, pm_au_equipment_readings as t2 SET t2.Start_Date='" . $data . "' WHERE t1.AU_Template_Reading_ID=t2.AU_Template_Reading_ID AND t1.Parent_ID=0 AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                } else {
                    $db->query("UPDATE pm_au_template_reading as t1, pm_au_equipment_readings as t2 SET t2.Start_Date='" . $data . "' WHERE t1.AU_Template_Reading_ID=t2.AU_Template_Reading_ID AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /*
     * Equipment detail reading update start date only os susubset
     */

    public function updateonlystartdateofequipmentreadingsubset($data, $eqp_detail_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $db->query("UPDATE pm_au_template_reading as t1, pm_au_equipment_readings as t2 SET t2.Start_Date='" . $data . "' WHERE t1.AU_Template_Reading_ID=t2.AU_Template_Reading_ID AND t1.Parent_ID='" . $Parent_ID . "' AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /**
     * 
     */
    public function updateonlystartdateofequipmentdetailreading($updata, $eqp_task_id = "") {

        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($updata)) {
            try {
                $con = 'AU_Equipment_Readings_ID=' . $eqp_task_id;
                $condition = array($con);
                $db->update('pm_au_equipment_readings', $updata, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function getupdatedfromtemplate($temptdesignid) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_template_task'), array('count(AU_Template_Designation_ID) as total', 'AU_Template_Designation_ID'));
            $select = $select->where('AU_Template_Designation_ID=?', $temptdesignid);
            $select = $select->group('AU_Template_Designation_ID');
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getupdatedfromtemplateReading($temptdesignid) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_template_reading'), array('count(AU_Template_Designation_ID) as total', 'AU_Template_Designation_ID'));
            $select = $select->where('AU_Template_Designation_ID=?', $temptdesignid);
            $select = $select->group('AU_Template_Designation_ID');
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * This is for update the equipment detail of Equipment template
     */
    public function getEquipmentToUpdate() {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_equipment_task'), array('count(t1.AU_Equipment_Detail_ID) as total', 't1.AU_Equipment_Detail_ID'));
            $select = $select->joinLeft(array('t2' => 'pm_au_template_task'), 't1.AU_Template_Task_ID = t2.AU_Template_Task_ID', array('t2.AU_Template_Designation_ID'));
            $select = $select->group('t1.AU_Equipment_Detail_ID');
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getEquipmentToUpdateReading() {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_equipment_readings'), array('count(t1.AU_Equipment_Detail_ID) as total', 't1.AU_Equipment_Detail_ID'));
            $select = $select->joinLeft(array('t2' => 'pm_au_template_reading'), 't1.AU_Template_Reading_ID = t2.AU_Template_Reading_ID', array('t2.AU_Template_Designation_ID'));
            $select = $select->group('t1.AU_Equipment_Detail_ID');
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * If new record added in Template then should be added in equipment details also     * 
     */
    public function InsertEquipmentTemplateTaskInEquipmentDetail($taskdata) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($taskdata)) {
            try {
                $insert = $db->insert('pm_au_equipment_task', $taskdata);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /**
     * If new record added in Reading Template then should be added in equipment details also     * 
     */
    public function InsertEquipmentTemplateReadingInEquipmentDetail($taskdata) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($taskdata)) {
            try {
                $insert = $db->insert('pm_au_equipment_readings', $taskdata);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /**
     * This is for task list the updated equipment
     */
    public function getUpdatedEquipmentTaskList() {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_equipment_detail'), array('count(t1.AU_Equipment_Detail_ID) as Numberoftask', 't1.Equipment_Floor', 't1.Equipment_Unit', 't1.AU_Equipment_Detail_ID'));
            $select = $select->joinLeft(array('t2' => 'pm_au_equipment_name'), 't1.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', array('t2.AU_Equipment_Name'));

            $select = $select->joinLeft(array('t3' => 'pm_au_template_typedesignation'), 't3.AU_Template_Name_ID = t1.AU_Template_Name_ID', array('template_name' => 't3.AU_TypeDesignation'));

            $select = $select->joinLeft(array('t4' => 'pm_au_equipment_task'), 't4.AU_Equipment_Detail_ID = t1.AU_Equipment_Detail_ID', array('t4.AU_Equipment_Task_ID'));

            $select = $select->joinLeft(array('t5' => 'pm_au_template_task'), 't5.AU_Template_Task_ID = t4.AU_Template_Task_ID', array('t5.Created_at'));
            $select = $select->where('t4.AU_Assign_Vendor=?', '');
            $select = $select->group('t1.AU_Equipment_Detail_ID');
            $res = $db->fetchAll($select);            
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /*
     * This is for reading list the updated equipment
     */

    public function getUpdatedEquipmentReadingList() {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_equipment_detail'), array('count(t1.AU_Equipment_Detail_ID) as Numberofreading', 't1.Equipment_Floor', 't1.Equipment_Unit', 't1.AU_Equipment_Detail_ID'));
            $select = $select->joinLeft(array('t2' => 'pm_au_equipment_name'), 't1.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', array('t2.AU_Equipment_Name'));
            $select = $select->joinLeft(array('t3' => 'pm_au_template_typedesignation'), 't3.AU_Template_Name_ID = t1.AU_Template_Name_ID', array('template_name' => 't3.AU_TypeDesignation'));
            $select = $select->joinLeft(array('t4' => 'pm_au_equipment_readings'), 't4.AU_Equipment_Detail_ID = t1.AU_Equipment_Detail_ID',array('t4.AU_Equipment_Readings_ID'));
            $select = $select->joinLeft(array('t5' => 'pm_au_template_reading'), 't5.AU_Template_Reading_ID = t4.AU_Template_Reading_ID',array('t5.Created_at'));
            $select = $select->where('t4.AU_Assign_Vendor=?', '');
            $select = $select->group('t1.AU_Equipment_Detail_ID');
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Update equipment Task and Reading with the Au_assign_vendor
     */
    public function UpdateTaskandReading($update, $eqpdetailid) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($update)) {
            try {
                $condition = array("AU_Equipment_Detail_ID = '" . $eqpdetailid . "'");
                $db->update('pm_au_equipment_task', $update, $condition);
                $db->update('pm_au_equipment_readings', $update, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /**
     * This is Equipment Detail for edit
     */
    public function getEquipmentDetailById($eqpdetailid) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_equipment_detail'), array('t1.AU_Equipment_Detail_ID', 't1.AU_Equipment_Name_ID', 't1.Equipment_Floor', 't1.Equipment_Unit', 't1.Equipment_Location', 't1.Equipment_Serial_Number', 't1.Equipment_Make_Model', 't1.Equipment_Inservice_Date', 't1.Equipment_Notes', 't1.Equipment_Status', 't1.Equipment_Image', 't1.Equipment_Manual'));
            $select = $select->joinLeft(array('t2' => 'pm_au_equipment_name'), 't1.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 't2.AU_Equipment_Name'));
            $select = $select->joinLeft(array('t3' => 'pm_au_template_typedesignation'), 't3.AU_Template_Name_ID = t1.AU_Template_Name_ID', array('t3.AU_Template_Designation_ID', 't3.AU_TypeDesignation', 't3.AU_TypeDescritpion'));
            $select = $select->joinLeft(array('t4' => 'pm_au_template_name'), 't4.AU_Template_Name_ID = t3.AU_Template_Name_ID', array('template_name' => 't4.AU_Template_Name'));
            $select = $select->joinLeft(array('t5' => 'pm_au_equipment_task'), 't5.AU_Equipment_Detail_ID = t1.AU_Equipment_Detail_ID', array('t5.AU_Equipment_Task_ID','t5.Start_Date', 't5.Startdate_month'));
            $select = $select->where('t1.AU_Equipment_Detail_ID=?', $eqpdetailid);
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * This is for save the equipment detail updated data
     */
    public function editequipmentdetail($data, $filename) {
        $eqpdetailid = $data['AU_Equipment_Detail_ID'];
        unset($data['AU_Equipment_Detail_ID']);
        unset($data['file']);
//$update = $data;
       $update = array(
			 "Equipment_Floor" => $data['Equipment_Floor'],
			 "Equipment_Unit" => $data['Equipment_Unit'],
			 "Equipment_Make_Model" => $data['Equipment_Make_Model'],
			 "Equipment_Location" => $data['Equipment_Location'],
			 "Equipment_Serial_Number" => $data['Equipment_Serial_Number'],
			 "Equipment_Inservice_Date" => $data['Equipment_Inservice_Date'],
			 "Equipment_Notes" => $data['Equipment_Notes'],
			 "Equipment_Status" => $data['Equipment_Status'],
			 "Equipment_Image" => $data['Equipment_Image']
         );

        $insertdata = array(
            'AU_Equipment_Detail_ID' => $eqpdetailid,
            'Equipment_Manual' => $filename
        );
        
       $insertdata12  = array(
        "Start_Date" => (!empty($data['startdate'])) ? date('M Y', strtotime($data['startdate'])) : '',
        "Startdate_month" => (!empty($data['startdate'])) ? date('d', strtotime($data['startdate'])) : ''
         );
        
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($update)) {
            try {
                $condition = array("AU_Equipment_Detail_ID = '" . $eqpdetailid . "'");
                $db->update('pm_au_equipment_detail', $update, $condition);
                $condition1 = array("AU_Equipment_Task_ID = '" . $data['taskId'] . "'");
                $db->update('pm_au_equipment_task', $insertdata12, $condition1);
                if (!empty($filename)) {
                    $db->insert('pm_au_equipment_manual', $insertdata);
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /**
     * This is for Equipment Manual PDF detail
     */
    public function getEquipmentManualById($eqpdetailid) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_equipment_manual'), array('t1.AU_Equipment_Manual_ID', 't1.AU_Equipment_Detail_ID', 't1.Equipment_Manual'));
            $select = $select->where('t1.AU_Equipment_Detail_ID=?', $eqpdetailid);
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * This is for delete Equipment Manual PDF
     */
    public function deleteEquipmentManualPDF($param) {

        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            if (!empty($param['au_equipment_manual_id']) && !empty($param['au_equipment_detail_id'])) {
                $condition = array('AU_Equipment_Manual_ID = ' . $param['au_equipment_manual_id']);
                $db->delete('pm_au_equipment_manual', $condition);
                return true;
            } else if (empty($param['au_equipment_manual_id'])) {
                $update['Equipment_Manual'] = '';
                $condition = array('AU_Equipment_Detail_ID = ' . $param['au_equipment_detail_id']);
                $db->update('pm_au_equipment_detail', $update, $condition);
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    // This section start for PM work order

    /*
     * This is for work order by equipment
     */

    public function getWorkorderListByEquipment($buildingId, $sortingData) {
        $a1 = $sortingData['eqparts'];
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_work_order'), array('BuildingID' => 't1.BuildingID', 'Reading_Task' => 't1.Reading_Task', 'WO_Number' => 't1.PM_WO_Number'))
                ->joinLeft(array('t2' => 'pm_au_equipment_detail'), 't2.AU_Equipment_Detail_ID = t1.AU_Equipment_Detail_ID', array('Equipment_Floor' => 't2.Equipment_Floor', 'Equipment_Unit' => 't2.Equipment_Unit', 'Equipment_Inservice_Date' => 't2.Equipment_Inservice_Date', 'Equipment_Location' => 't2.Equipment_Location', 'Equipment_Notes' => 't2.Equipment_Notes', 'Equipment_Image' => 't2.Equipment_Image', 'Equipment_Status' => 't2.Equipment_Status'))
                ->joinLeft(array('t3' => 'pm_au_equipment_name'), 't3.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', array('AU_Equipment_Name_ID' => 't3.AU_Equipment_Name_ID', 'AU_Equipment_Name' => 't3.AU_Equipment_Name'))
                ->where('t1.BuildingID  = ?', $buildingId)
                ->where('t2.Equipment_Status  = ?', 1);
        if (!empty($sortingData['eqparts'])) {
            //$select->where("t2.Equipment_Floor LIKE '" . $a1 . "%' or t2.Equipment_Unit LIKE '" . $a1 . "%' or t2.Equipment_Location LIKE '" . $a1 . "%' or t1.PM_WO_Number LIKE '" . $a1 . "%' or t3.AU_Equipment_Name LIKE '" . $a1 . "%'");
            $select->where(" t2.Equipment_Floor = '" . $a1 . "' OR t2.Equipment_Unit = '" . $a1 . "' OR t1.PM_WO_Number = '" . $a1 . "' OR t3.AU_Equipment_Name = '" . $a1 . "' OR  t2.Equipment_Location = '" . $a1 . "' ");
        }

        $select->group(array('t3.AU_Equipment_Name'))
                ->group(array('t1.PM_WO_Number'))
                ->group(array('t2.Equipment_Floor'))
                ->group(array('t2.Equipment_Unit'))
                ->group(array('t2.Equipment_Make_Model'))
                ->group(array('t2.Equipment_Location'))
                ->group(array('t2.Equipment_Serial_Number'))
                ->group(array('t2.Equipment_Inservice_Date'))
                ->group(array('t2.Equipment_Notes'))
                ->group(array('t2.Equipment_Image'))
                ->group(array('t2.Equipment_Status'))
                ->group(array('t1.Reading_Task'));
        if (empty($sortingData['type'])) {
            if ($sortingData['id'] == '0') {
                $select->order('t3.AU_Equipment_Name DESC');
            } else if ($sortingData['id'] == '1') {
                $select->order('t3.AU_Equipment_Name ASC');
            } else if ($sortingData == '0') {
                $select->order('t1.PM_WO_Number');
            }
        } else {
            if ($sortingData['id'] == '0') {
                if ($sortingData['type'] == 'floor') {
                    $select->order("t2.Equipment_Floor DESC");
                } else if ($sortingData['type'] == 'unit') {
                    $select->order("t2.Equipment_Unit DESC");
                } else if ($sortingData['type'] == 'wo') {
                    $select->order("t1.PM_WO_Number DESC");
                } else if ($sortingData['type'] == 'location') {
                    $select->order("t2.Equipment_Location DESC");
                } else if ($sortingData['type'] == 'equipment') {
                    $select->order("t3.AU_Equipment_Name DESC");
                }
            } else if ($sortingData['id'] == '1') {
                if ($sortingData['type'] == 'floor') {
                    $select->order("t2.Equipment_Floor ASC");
                } else if ($sortingData['type'] == 'unit') {
                    $select->order("t2.Equipment_Unit ASC");
                } else if ($sortingData['type'] == 'wo') {
                    $select->order("t1.PM_WO_Number ASC");
                } else if ($sortingData['type'] == 'location') {
                    $select->order("t2.Equipment_Location ASC");
                } else if ($sortingData['type'] == 'equipment') {
                    $select->order("t3.AU_Equipment_Name ASC");
                }
            }
        }
//echo $select;
        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }

    /**
     * This is for sorting work order by equipment
     */
    public function getWorkorderListBy($buildingId, $sortingData) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_work_order'), array('BuildingID' => 't1.BuildingID', 'Reading_Task' => 't1.Reading_Task', 'WO_Number' => 't1.PM_WO_Number'))
                ->joinLeft(array('t2' => 'pm_au_equipment_detail'), 't2.AU_Equipment_Detail_ID = t1.AU_Equipment_Detail_ID', array('Equipment_Floor' => 't2.Equipment_Floor', 'Equipment_Unit' => 't2.Equipment_Unit', 'Equipment_Inservice_Date' => 't2.Equipment_Inservice_Date', 'Equipment_Location' => 't2.Equipment_Location', 'Equipment_Notes' => 't2.Equipment_Notes', 'Equipment_Image' => 't2.Equipment_Image', 'Equipment_Status' => 't2.Equipment_Status'))
                ->joinLeft(array('t3' => 'pm_au_equipment_name'), 't3.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', array('AU_Equipment_Name_ID' => 't3.AU_Equipment_Name_ID', 'AU_Equipment_Name' => 't3.AU_Equipment_Name'))
                ->where('t1.BuildingID  = ?', $buildingId)
                ->where('t2.Equipment_Status  = ?', 1);
        if (!empty($sortingData['equipment_name_id'])) {
            $select->where('t3.AU_Equipment_Name_ID  = ?', $sortingData['equipment_name_id']);
        }

        $select->group(array('t3.AU_Equipment_Name'))
                ->group(array('t1.PM_WO_Number'))
                ->group(array('t2.Equipment_Floor'))
                ->group(array('t2.Equipment_Unit'))
                ->group(array('t2.Equipment_Make_Model'))
                ->group(array('t2.Equipment_Location'))
                ->group(array('t2.Equipment_Serial_Number'))
                ->group(array('t2.Equipment_Inservice_Date'))
                ->group(array('t2.Equipment_Notes'))
                ->group(array('t2.Equipment_Image'))
                ->group(array('t2.Equipment_Status'))
                ->group(array('t1.Reading_Task'));

        if ($sortingData['id'] == '0') {
            if ($sortingData['type'] == 'floor') {
                $select->order("t2.Equipment_Floor DESC");
            } else if ($sortingData['type'] == 'unit') {
                $select->order("t2.Equipment_Unit DESC");
            } else if ($sortingData['type'] == 'wo') {
                $select->order("t1.PM_WO_Number DESC");
            } else if ($sortingData['type'] == 'location') {
                $select->order("t2.Equipment_Location DESC");
            } else if ($sortingData['type'] == 'equipment') {
                $select->order("t3.AU_Equipment_Name DESC");
            }
        } else {
            if ($sortingData['type'] == 'floor') {
                $select->order("t2.Equipment_Floor ASC");
            } else if ($sortingData['type'] == 'unit') {
                $select->order("t2.Equipment_Unit ASC");
            } else if ($sortingData['type'] == 'wo') {
                $select->order("t1.PM_WO_Number ASC");
            } else if ($sortingData['type'] == 'location') {
                $select->order("t2.Equipment_Location ASC");
            } else if ($sortingData['type'] == 'equipment') {
                $select->order("t3.AU_Equipment_Name ASC");
            }
        }

        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }

    /*
     * This is search for work order by equipment
     */

    public function wosearchEquipment($buildingId, $sortingData) {
        $a1 = $sortingData['eqparts'];
        if ($sortingData['eqname'] == 1) {
            $arrayaDataNumber = array('WO_Number' => 't1.PM_WO_Number');
        } else if ($sortingData['eqname'] == 2) {
            $arrayDataEqpName = array('AU_Equipment_Name' => 't3.AU_Equipment_Name');
        } else if ($sortingData['eqname'] == 3) {
            $arrayData = array('Equipment_Floor' => 't2.Equipment_Floor');
        } else if ($sortingData['eqname'] == 4) {
            $arrayData = array('Equipment_Unit' => 't2.Equipment_Unit');
        } else if ($sortingData['eqname'] == 5) {
            $arrayData = array('Equipment_Location' => 't2.Equipment_Location');
        }

        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_work_order'), $arrayaDataNumber)
                ->joinLeft(array('t2' => 'pm_au_equipment_detail'), 't2.AU_Equipment_Detail_ID = t1.AU_Equipment_Detail_ID', $arrayData)
                ->joinLeft(array('t3' => 'pm_au_equipment_name'), 't3.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', $arrayDataEqpName)
                ->where('t1.BuildingID  = ?', $buildingId)
                ->where('t2.Equipment_Status  = ?', 1);

        if (!empty($sortingData['eqparts'])) {
            //$select->where('t2.Equipment_Location LIKE ?', $sortingData['eqparts'].'%');
            $select->where("t2.Equipment_Floor LIKE '" . $a1 . "%' or t2.Equipment_Unit LIKE '" . $a1 . "%' or t2.Equipment_Location LIKE '" . $a1 . "%' or t2.Equipment_Make_Model LIKE '" . $a1 . "%' or t5.AU_TypeDesignation LIKE '" . $a1 . "%'");
        }


        $select->group(array('t3.AU_Equipment_Name'))
                ->group(array('t1.PM_WO_Number'))
                ->group(array('t2.Equipment_Floor'))
                ->group(array('t2.Equipment_Unit'))
                ->group(array('t2.Equipment_Make_Model'))
                ->group(array('t2.Equipment_Location'))
                ->group(array('t2.Equipment_Serial_Number'))
                ->group(array('t2.Equipment_Inservice_Date'))
                ->group(array('t2.Equipment_Notes'))
                ->group(array('t2.Equipment_Image'))
                ->group(array('t2.Equipment_Status'))
                ->group(array('t1.Reading_Task'))
                ->order('t3.AU_Equipment_Name');
        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }

    /**
     * This is for PM - Setup and options
     */
    public function getWorkOrderOptionByBuilding($building_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_work_order_options'), array('t1.*'));
            $select->where('t1.BuildingID  = ?', $building_id);
            $res = $db->fetchAll($select);
            /* foreach ($res as $data) {
              $datas[] = (array) $data;
              } */
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * This is of save the PM Setup and Options
     */
    public function insertpmsetupoptions($data, $building_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $data['BuildingID'] = $building_id;
        if (!empty($data)) {
            try {
                $select = $db->select()->from(array('t1' => 'pm_au_work_order_options'), array('t1.BuildingID'))
                        ->where('t1.BuildingID  = ?', $building_id);
                $res = $db->fetchAll($select);
                if (count($res) > 0) {
                    $condition = array('BuildingID = ' . $building_id);
                    $db->update('pm_au_work_order_options', $data, $condition);
                    return 1;
                } else {
                    $db->insert('pm_au_work_order_options', $data);
                    return 2;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /**
     * This is for get the PM work order Number
     */
    public function getWoNumberByBuildingID($building_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_work_order'), array('t1.PM_WO_Number','t1.Reading_Task'));
            $select->where('t1.BuildingID  = ?', $building_id);
            $select->group(array('t1.PM_WO_Number'));
            //echo $select;
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    /*
     * This is check for Task or Reading Or both
     */
    public function getReadingTaskByBuildingID($pmwonumber,$building_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_work_order'), array('t1.PM_WO_Number','t1.Reading_Task'));
            $select->where('t1.BuildingID  = ?', $building_id);
            $select->where('t1.PM_WO_Number  = ?', $pmwonumber);
            $select->group(array('t1.Reading_Task'));
            $select->order('t1.Reading_Task desc');
            //echo $select;
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    /*
     * This is for call procedure
     */
    public function callProcedure($buildingId){
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $stmt = $db->query("CALL pm_wo_number_only($buildingId)");
            $data = $stmt->fetchAll();
            return $data;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }      
        
        
    }

    /*
     * get open pm work order
     */

    public function getOpenPmWorkorder($pmwonumber,$pmreadingtask, $building_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        try {
            $select->from(array('t1' => 'pm_au_work_order'), array('BuildingID' => 't1.BuildingID', 'WO_Number' => 't1.PM_WO_Number', 'Reading_Task' => 't1.Reading_Task'));
            $select->joinLeft(array('t2' => 'pm_au_equipment_detail'), 't2.AU_Equipment_Detail_ID = t1.AU_Equipment_Detail_ID', array('Equipment_Floor' => 't2.Equipment_Floor', 'Equipment_Unit' => 't2.Equipment_Unit', 'Equipment_Make_Model' => 't2.Equipment_Make_Model', 'Equipment_Location' => 't2.Equipment_Location', 'Equipment_Serial_Number' => 't2.Equipment_Serial_Number'));
            $select->joinLeft(array('t3' => 'pm_au_equipment_name'), 't3.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 't3.AU_Equipment_Name'));
            $select->where('t1.BuildingID  = ?', $building_id);
            $select->where('t1.PM_WO_Number  = ?', $pmwonumber);
            $select->where('t1.Reading_Task  = ?', $pmreadingtask);
            $select->group(array('t1.PM_WO_Number'))
                    ->group(array('t1.BuildingID'))
                    ->group(array('t3.AU_Equipment_Name'))
                    ->group(array('t1.PM_WO_Number'))
                    ->group(array('t2.Equipment_Floor'))
                    ->group(array('t2.Equipment_Unit'))
                    ->group(array('t2.Equipment_Make_Model'))
                    ->group(array('t2.Equipment_Location'))
                    ->group(array('t2.Equipment_Serial_Number'))
                    ->group(array('t2.Equipment_Inservice_Date'))
                    ->group(array('t2.Equipment_Notes'))
                    ->group(array('t2.Equipment_Image'))
                    ->group(array('t2.Equipment_Status'))
                    ->group(array('t1.Reading_Task'))
                    ->order(array('t1.PM_WO_Number'));
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /*
     * get pm work order task detail
     */

    public function getPmWorkorderTaskDetail($pmwonumber, $building_id, $readingTask) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //$select = $db->select();
        try {
            $select1 = $db->select()->from(array('t1' => 'pm_au_work_order'), array('PM_WO_ID' => 't1.PM_WO_ID', 'BuildingID' => 't1.BuildingID', 'PM_WO_Number' => 't1.PM_WO_Number', 'PM_WO_StartDate' => 't1.PM_WO_StartDate', 'Reading_Task' => 't1.Reading_Task', 'WO_Parent_ID' => 't1.Parent_ID'))
                    ->joinLeft(array('t2' => 'pm_au_equipment_task'), 't2.AU_Equipment_Task_ID = t1.AU_Equipment_Task_Reading_ID', array(''))
                    ->joinLeft(array('t3' => 'pm_au_template_task'), 't3.AU_Template_Task_ID = t2.AU_Template_Task_ID', array('Sort_Order' => 't3.View_order', 'Task_Instruction' => 't3.Task_Instruction', 'JobTime' => 't3.Task_jobtime', 'AU_Template_Task_ID' => 't3.AU_Template_Task_ID', 'Parent_ID' => 't3.Parent_ID'))
                    ->joinLeft(array('t4' => 'pm_au_frequency'), 't4.AU_Frequency_ID = t3.AU_Frequency_ID ', array('Frequency' => 't4.Name'))
                    ->where('t1.Reading_Task  = ?', $readingTask)
                    ->where('t1.BuildingID  = ?', $building_id)
                    ->where('t1.PM_WO_Number  = ?', $pmwonumber)
                    ->group(array('t1.PM_WO_Number'))
                    ->group(array('t1.BuildingID'))
                    ->group(array('t3.View_order'))
                    ->group(array('t3.Task_Instruction'))
                    ->group(array('t3.AU_Template_Task_ID'))
                    ->group(array('t4.Name'))
                    ->group(array('t1.Parent_ID'))
                    ->group(array('t1.Reading_Task'));


            $select2 = $db->select()->from(array('t8' => 'pm_au_work_order'), array('PM_WO_ID' => 't8.PM_WO_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID'))
                   ->joinLeft(array('t7' => 'pm_au_template_task'), 't7.AU_Template_Task_ID = t8.Parent_ID ', array('Sort_Order' => 't7.View_order', 'Task_Instruction' => 't7.Task_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Task_ID' => 't7.AU_Template_Task_ID', 'Parent_ID' => 't7.Parent_ID'))
                    ->joinLeft(array('t9' => 'pm_au_equipment_task'), 't9.AU_Equipment_Task_ID = t8.AU_Equipment_Task_Reading_ID',array(''))
                    
                    ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))
                    ->where('t8.Reading_Task  = ?', $readingTask)
                    ->where('t8.BuildingID  = ?', $building_id)
                    ->where('t8.PM_WO_Number  = ?', $pmwonumber)
                    ->where('t8.Parent_ID  > 0')
                    ->group(array('t8.PM_WO_Number'))
                    ->group(array('t8.BuildingID'))
                    ->group(array('t7.View_order'))
                    ->group(array('t7.Task_Instruction'))
                    ->group(array('t7.Task_jobtime'))
                    ->group(array('t7.AU_Template_Task_ID'))
                    ->group(array('t6.Name'))
                    ->group(array('t8.Parent_ID'))
                    ->group(array('t8.Reading_Task'))
                    ->order('Sort_Order');

            $select = $db->select()->union(array($select1, $select2));
            //->order('title');
            //echo $select; //die('Emad');                    
            $res = $db->fetchAll($select);
            foreach ($res as $data) {
                $datas[] = (array) $data;
            }
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * This for get the Pm Complete Job Time
     */
    public function getPmCompleteJobTime($building_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_work_order_options'), array('t1.PM_Complete_Job_Time','t1.PM_Auto_Create_Jobs'));
            $select->where('t1.BuildingID  = ?', $building_id);
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getPmCompletedBy($building_id, $completedbyuserid='') {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_equipment_detail'), array('AU_Equipment_Detail_ID' => 't1.AU_Equipment_Detail_ID'));
            $select->joinLeft(array('t2' => 'pm_au_equipment_task'), 't2.AU_Equipment_Detail_ID=t1.AU_Equipment_Detail_ID');
            $select->joinLeft(array('t3' => 'email_group_users'), ' t3.group_id=t2.Email_group_ID');
            $select->joinRight(array('t4' => 'users'), 't4.uid=t3.user_id', array('uid' => 't4.uid', 'fullname' => new Zend_Db_Expr("CONCAT(t4.firstName, ' ', t4.lastName)")));
            $select->where('t1.BuildingID  = ?', $building_id);
            if(!empty($completedbyuserid)){
               $select->where('t4.uid  = ?', $completedbyuserid); 
            }
            $select->group(array('t2.Email_group_ID'));
            $select->group(array('t4.uid'));
            $select->group(array('t3.user_id'));
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getPmCompleteWoData($PmWoId) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_work_order'), array('PM_WO_ID' => 't1.PM_WO_ID', 'AU_Equipment_Task_Reading_ID' => 't1.AU_Equipment_Task_Reading_ID', 'AU_Equipment_Detail_ID' => 't1.AU_Equipment_Detail_ID', 'AU_Template_Designation_ID' => 't1.AU_Template_Designation_ID', 'Parent_ID' => 't1.Parent_ID', 'BuildingID' => 't1.BuildingID', 'PM_WO_Number' => 't1.PM_WO_Number', 'PM_WO_StartDate' => 't1.PM_WO_StartDate', 'Reading_Task' => 't1.Reading_Task'));
            $select->where('t1.PM_WO_ID  = ?', $PmWoId);
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function savePmCompleteData($completeData) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($completeData)) {
            try {
                $insert = $db->insert('pm_au_history', $completeData);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deletePmcompletewo($pmwoid) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('PM_WO_ID = ' . $pmwoid);
            $db->delete('pm_au_work_order', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /*
     * get pm work order task detail
     */

    public function getPmWorkorderReadingDetail($pmwonumber, $building_id, $readingTask) {
        $db = Zend_Db_Table::getDefaultAdapter();
        //$select = $db->select();
        try {
            $select1 = $db->select()->from(array('t1' => 'pm_au_work_order'), array('PM_WO_ID' => 't1.PM_WO_ID', 'BuildingID' => 't1.BuildingID', 'PM_WO_Number' => 't1.PM_WO_Number', 'PM_WO_StartDate' => 't1.PM_WO_StartDate', 'Reading_Task' => 't1.Reading_Task', 'WO_Parent_ID' => 't1.Parent_ID'))
                    ->joinLeft(array('t2' => 'pm_au_equipment_readings'), 't2.AU_Equipment_Readings_ID = t1.AU_Equipment_Task_Reading_ID', array(''))
                    ->joinLeft(array('t3' => 'pm_au_template_reading'), 't3.AU_Template_Reading_ID = t2.AU_Template_Reading_ID', array('Sort_Order' => 't3.View_order', 'Reading_Instruction' => 't3.Reading_Instruction', 'JobTime' => 't3.Task_jobtime', 'AU_Template_Reading_ID' => 't3.AU_Template_Reading_ID', 'Parent_ID' => 't3.Parent_ID', 'Reading_Value' => 't3.Reading_Value', 'Tolerance' => 't3.Tolerance'))
                    ->joinLeft(array('t4' => 'pm_au_frequency'), 't4.AU_Frequency_ID = t3.AU_Frequency_ID ', array('Frequency' => 't4.Name'))
                    ->joinLeft(array('t5' => 'pm_au_unitofmeasure'), 't5.AU_uom_ID = t3.AU_uom_ID', array('Unit_of_Measure' => 't5.Name'))
                    ->where('t1.Reading_Task  = ?', $readingTask)
                    ->where('t1.BuildingID  = ?', $building_id)
                    ->where('t1.PM_WO_Number  = ?', $pmwonumber)
                    ->group(array('t1.PM_WO_Number'))
                    ->group(array('t1.BuildingID'))
                    ->group(array('t3.Tolerance'))
                    ->group(array('t3.Reading_Value'))
                    ->group(array('t3.Interval_Value'))
                    ->group(array('t3.Parent_ID'))
                    ->group(array('t3.View_order'))
                    ->group(array('t3.Task_jobtime'))
                    ->group(array('t3.Reading_Instruction'))
                    ->group(array('t3.AU_Template_Reading_ID'))
                    ->group(array('t4.Name'))
                    ->group(array('t1.Parent_ID'))
                    ->group(array('t1.Reading_Task'))
                    ->group(array('t5.Name'));


            $select2 = $db->select()->from(array('t1' => 'pm_au_work_order'), array('PM_WO_ID' => 't1.PM_WO_ID', 'BuildingID' => 't1.BuildingID', 'PM_WO_Number' => 't1.PM_WO_Number', 'PM_WO_StartDate' => 't1.PM_WO_StartDate', 'Reading_Task' => 't1.Reading_Task', 'WO_Parent_ID' => 't1.Parent_ID'))
                    
                    ->joinLeft(array('t3' => 'pm_au_template_reading'), 't3.AU_Template_Reading_ID = t1.Parent_ID ', array('Sort_Order' => 't3.View_order', 'Reading_Instruction' => 't3.Reading_Instruction', 'JobTime' => 't3.Task_jobtime', 'AU_Template_Reading_ID' => 't3.AU_Template_Reading_ID', 'Parent_ID' => 't3.Parent_ID', 'Reading_Value' => 't3.Reading_Value', 'Tolerance' => 't3.Tolerance'))
                    ->joinLeft(array('t2' => 'pm_au_equipment_readings'), 't2.AU_Equipment_Readings_ID = t1.AU_Equipment_Task_Reading_ID', array(''))
                    ->joinLeft(array('t4' => 'pm_au_frequency'), 't4.AU_Frequency_ID = t3.AU_Frequency_ID ', array('Frequency' => 't4.Name'))
                    ->joinLeft(array('t5' => 'pm_au_unitofmeasure'), 't5.AU_uom_ID = t3.AU_uom_ID', array('Unit_of_Measure' => 't5.Name'))
                    ->where('t1.Reading_Task  = ?', $readingTask)
                    ->where('t1.BuildingID  = ?', $building_id)
                    ->where('t1.PM_WO_Number  = ?', $pmwonumber)
                    ->where('t1.Parent_ID  > 0')
                    ->group(array('t1.PM_WO_Number'))
                    ->group(array('t1.BuildingID'))
                    ->group(array('t3.Tolerance'))
                    ->group(array('t3.Reading_Value'))
                    ->group(array('t3.Interval_Value'))
                    ->group(array('t3.Parent_ID'))
                    ->group(array('t3.View_order'))
                    ->group(array('t3.Task_jobtime'))
                    ->group(array('t3.Reading_Instruction'))
                    ->group(array('t3.AU_Template_Reading_ID'))
                    ->group(array('t4.Name'))
                    ->group(array('t1.Parent_ID'))
                    ->group(array('t1.Reading_Task'))
                    ->group(array('t5.Name'))
                    ->order('Sort_Order');

            $select = $db->select()->union(array($select1, $select2));
            //->order('title');
            //echo $select; die('Emad');                    
            $res = $db->fetchAll($select);
            foreach ($res as $data) {
                $datas[] = (array) $data;
            }
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getEquipmentDetailbyTempId($temp_id, $build_id) {

        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_equipment_name'), array('AU_Equipment_Name' => 't1.AU_Equipment_Name', 'AU_Equipment_Name_ID' => 't1.AU_Equipment_Name_ID'));
            $select->joinLeft(array('t2' => 'pm_au_equipment_detail'), 't2.AU_Equipment_Name_ID=t1.AU_Equipment_Name_ID');

            $select->where('t1.BuildingID  = ?', $build_id);
            $select->where('t2.AU_Template_Name_ID  = ?', $temp_id);
            $select->group(array('t1.AU_Equipment_Name'));
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * This is for get Typedesignation by Template name id 
     */
    public function getTypeDesignationbyTempId($temp_id, $build_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_template_typedesignation'), array('AU_TypeDesignation' => 't1.AU_TypeDesignation'));
            $select->joinLeft(array('t2' => 'pm_au_template_name'), 't2.AU_Template_Name_ID=t1.AU_Template_Name_ID');
            $select->where('t2.BuildingID  = ?', $build_id);
            $select->where('t1.AU_Template_Name_ID  = ?', $temp_id);
            $select->order('t1.AU_TypeDesignation');
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * This is for get Template and typedesignation by desig id
     */
    public function getTemplateTypedesignationByTypeDesig($design_id, $build_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_template_name'), array('AU_Template_Name_ID' => 't1.AU_Template_Name_ID', 'AU_Template_Name' => 't1.AU_Template_Name'));
            $select->joinLeft(array('t2' => 'pm_au_template_typedesignation'), 't2.AU_Template_Name_ID=t1.AU_Template_Name_ID');
            $select->where('t1.BuildingID  = ?', $build_id);
            $select->where('t2.AU_Template_Designation_ID  = ?', $design_id);
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * This is for get all vt template name
     */
    public function getAllVTTemplate() {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_vt_template_name'), array('VT_Template_Name_ID' => 't1.VT_Template_Name_ID', 'VT_Template_Name' => 't1.VT_Template_Name', 'Vt_Admin_Template' => 't1.Vt_Admin_Template'));
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * This is for Vt template name exist or not
     */
    public function checktypedesig($data) {

        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_vt_template_name'), array('VT_Template_Name_ID' => 't1.VT_Template_Name_ID', 'VT_Template_Name' => 't1.VT_Template_Name', 'Vt_Admin_Template' => 't1.Vt_Admin_Template'));
            $select->where('t1.VT_Template_Name  = ?', $data['vttempname']);
            $select->where('t1.Vt_Admin_Template  = ?', 'No');
            $res = $db->fetchAll($select);
            if (count($res) > 0) {
                $VT_Template_Name_ID = $res[0]->VT_Template_Name_ID;
                $select = $db->select()->from(array('t1' => 'pm_vt_template_typedesignation'), array('VT_TypeDesignation' => 't1.VT_TypeDesignation', 'VT_Admin_Template' => 't1.VT_Admin_Template'));
                $select->where('t1.VT_TypeDesignation  = ?', $data['typedesignation']);
                $select->where('t1.VT_Admin_Template  = ?', 'No');
                $res2 = $db->fetchAll($select);
                if (count($res2) > 0) {
                    return $res2;
                } else {
                    return $VT_Template_Name_ID;
                }
            } else {
                $VT_Template_Name_ID = $this->InsertTemplateNametoVT($data);
                $select = $db->select()->from(array('t1' => 'pm_vt_template_typedesignation'), array('VT_TypeDesignation' => 't1.VT_TypeDesignation', 'VT_Admin_Template' => 't1.VT_Admin_Template'));
                $select->where('t1.VT_TypeDesignation  = ?', $data['typedesignation']);
                $select->where('t1.VT_Admin_Template  = ?', 'No');
                $res3 = $db->fetchAll($select);
                if (count($res3) > 0) {
                    return $res3;
                } else {
                    return $VT_Template_Name_ID;
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * This is for Vt template name exist or not
     */
    public function checkvttemplatename($data) {

        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_vt_template_name'), array('VT_Template_Name_ID' => 't1.VT_Template_Name_ID', 'VT_Template_Name' => 't1.VT_Template_Name', 'Vt_Admin_Template' => 't1.Vt_Admin_Template'));
            $select->where('t1.VT_Template_Name  = ?', $data['vttempname']);
            $select->where('t1.Vt_Admin_Template  = ?', 'No');
            $res = $db->fetchAll($select);
            if (count($res) > 0) {
                return false;
            } else {

                return true;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function checkvttypedesig($data) {

        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_vt_template_typedesignation'), array('VT_TypeDesignation' => 't1.VT_TypeDesignation', 'VT_Admin_Template' => 't1.VT_Admin_Template'));
            $select->where('t1.VT_TypeDesignation  = ?', $data['typedesignation']);
            $select->where('t1.VT_Admin_Template  = ?', 'No');
            $res = $db->fetchAll($select);
            if (count($res) > 0) {
                return 'No';
            } else {
                return 'Yes';
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function InsertTemplateNametoVT($templatedata) {
        $data = array('VT_Template_Name' => $templatedata['vttempname'],
            'Vt_Admin_Template' => 'No'
        );
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($templatedata)) {
            try {
                $insert = $db->insert('pm_vt_template_name', $data);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    /**
     * This is for Save VT type designation name
     */
    public function saveVttypedesign($temptypeDesigdata, $user_id) {
        if ($temptypeDesigdata['temptypedata'] == 3) {
            $temptypeDesigdata['VT_Template_Name_ID'] = $this->InsertTemplateNametoVT($temptypeDesigdata);
        }
        $data = array('VT_Template_Name_ID' => $temptypeDesigdata['VT_Template_Name_ID'],
            'VT_TypeDesignation' => $temptypeDesigdata['typedesignation'],
            'VT_TypeDescritpion' => 'User Created Template - ' . date('F d, Y'),
            'User_id' => $user_id,
            'VT_Admin_Template' => 'No'
        );
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($temptypeDesigdata)) {
            try {
                $insert = $db->insert('pm_vt_template_typedesignation', $data);
                //return true;
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function getTemplateByBuildingId($data, $user_id) {
        $buildingid = $data['importbuilding'];
        $db = Zend_Db_Table::getDefaultAdapter();

        try {
            $select = $db->select()->from(array('t1' => 'pm_au_template_name'), array('AU_Template_Name_ID' => 't1.AU_Template_Name_ID', 'AU_Template_Name' => 't1.AU_Template_Name', 'BuildingID' => 't1.BuildingID'));
            $select->where('t1.BuildingID  = ?', $data['exportbuilding']);
            $select->order('t1.AU_Template_Name_ID');
            $res = $db->fetchAll($select);
            //return $res;  

            $select1 = $db->select()->from(array('t1' => 'pm_au_template_name'), array('AU_Template_Name_ID' => 't1.AU_Template_Name_ID', 'AU_Template_Name' => 't1.AU_Template_Name', 'BuildingID' => 't1.BuildingID'));
            $select1->where('t1.BuildingID  = ?', $data['importbuilding']);
            $select1->order('t1.AU_Template_Name_ID');
            $res1 = $db->fetchAll($select1);
            //return $res1;
            foreach ($res as $export) {
                $flag = 0;
                $select2 = $db->select()->from(array('t1' => 'pm_au_template_typedesignation'), array('AU_Template_Designation_ID' => 't1.AU_Template_Designation_ID', 'AU_Template_Name_ID' => 't1.AU_Template_Name_ID', 'AU_TypeDesignation' => 't1.AU_TypeDesignation', 'AU_TypeDescritpion' => 't1.AU_TypeDescritpion', 'User_id' => 't1.User_id'));
                $select2->where('t1.AU_Template_Name_ID  = ?', $export->AU_Template_Name_ID);
                $select2->order('t1.AU_Template_Name_ID');
                $res2 = $db->fetchAll($select2);
                foreach ($res1 as $import) {
                    if ($export->AU_Template_Name == $import->AU_Template_Name) {                        
                        $flag = 1;
                        break;
                    }
                }
                if ($flag == 0) {
                    $insertdata = array('AU_Template_Name' => $export->AU_Template_Name,
                        'BuildingID' => $buildingid, //$data['importbuilding'],
                        'user_id' => $user_id
                    );
                    $db->insert('pm_au_template_name', $insertdata);
                    $template_name_id = $db->lastInsertId();

                    foreach ($res2 as $typedesign) {
                        $typedesigndata = array('AU_Template_Name_ID' => $template_name_id,
                            'AU_TypeDesignation' => $typedesign->AU_TypeDesignation,
                            'AU_TypeDescritpion' => $typedesign->AU_TypeDescritpion,
                            'User_id' => $user_id,
                        );
                        $db->insert('pm_au_template_typedesignation', $typedesigndata);
                        $newdesignid = $db->lastInsertId();

                        /* Task Section  */
                        $task_subset = $this->getEquipmentTemplateTask_subsetbyid_import('pm_au_template_task', $typedesign->AU_Template_Designation_ID);
                        foreach ($task_subset as $tsubset) {
                            $innertask = $this->getEquipmentTemplateTask_taskbysubsetId_import('pm_au_template_task', $typedesign->AU_Template_Designation_ID, $tsubset->AU_Template_Task_ID);
                            $data = (array) $tsubset;
                            unset($data['AU_Template_Task_ID']);
                            $data['AU_Template_Designation_ID'] = $newdesignid;
                            $data['User_id'] = $user_id;
                            $parent_id = $this->insertEquipmentTemplatesubset($data);
                            if (!empty($innertask)) {
                                foreach ($innertask as $task) {
                                    $innerdata = (array) $task;
                                    unset($innerdata['AU_Template_Task_ID']);
                                    $innerdata['Parent_ID'] = $parent_id;
                                    $innerdata['AU_Template_Designation_ID'] = $newdesignid;
                                    $innerdata['User_id'] = $user_id;
                                    $this->InsertEquipmentTemplatetask($innerdata);

                                    //die;
                                }
                            }
                        }

                        $task_data = $this->get_tabledata_Au('pm_au_template_task', $typedesign->AU_Template_Designation_ID);
                        foreach ($task_data as $tdata) {
                            $data = (array) $tdata;
                            unset($data['AU_Template_Task_ID']);
                            $data['AU_Template_Designation_ID'] = $newdesignid;
                            $data['User_id'] = $user_id;
                            $this->InsertEquipmentTemplatetask($data);
                        }
                        
                        
                        /* Reading Section  */
                        $task_subset = $this->getEquipmentTemplateTask_subsetbyid_import('pm_au_template_reading', $typedesign->AU_Template_Designation_ID);
                        foreach ($task_subset as $tsubset) {
                            $innertask = $this->getEquipmentTemplateTask_taskbysubsetId_import('pm_au_template_reading', $typedesign->AU_Template_Designation_ID, $tsubset->AU_Template_Reading_ID);
                            $data = (array) $tsubset;
                            unset($data['AU_Template_Reading_ID']);
                            $data['AU_Template_Designation_ID'] = $newdesignid;
                            $data['User_id'] = $user_id;
                            $parent_id = $this->insertEquipmentTemplateReadingsubset($data);
                            if (!empty($innertask)) {
                                foreach ($innertask as $task) {
                                    $innerdata = (array) $task;
                                    unset($innerdata['AU_Template_Reading_ID']);
                                    $innerdata['Parent_ID'] = $parent_id;
                                    $innerdata['AU_Template_Designation_ID'] = $newdesignid;
                                    $innerdata['User_id'] = $user_id;
                                    $this->InsertEquipmentTemplateReading($innerdata);

                                    //die;
                                }
                            }
                        }

                        $task_data = $this->get_tabledata_Au('pm_au_template_reading', $typedesign->AU_Template_Designation_ID);
                        foreach ($task_data as $tdata) {
                            $data = (array) $tdata;
                            unset($data['AU_Template_Reading_ID']);
                            $data['AU_Template_Designation_ID'] = $newdesignid;
                            $data['User_id'] = $user_id;
                            $this->InsertEquipmentTemplateReading($data);
                        }
                        
                    }
                } else {
                    foreach ($res2 as $typedesign) {
                        $typedesigndata = array('AU_Template_Name_ID' => $export->AU_Template_Name_ID,
                            'AU_TypeDesignation' => $typedesign->AU_TypeDesignation . '- 01',
                            'AU_TypeDescritpion' => $typedesign->AU_TypeDescritpion,
                            'User_id' => $user_id,
                        );
                        $db->insert('pm_au_template_typedesignation', $typedesigndata);
                        $newdesignid = $db->lastInsertId();
                                                
                        /* Task Section  */
                        $task_subset = $this->getEquipmentTemplateTask_subsetbyid_import('pm_au_template_task', $typedesign->AU_Template_Designation_ID);
                        foreach ($task_subset as $tsubset) {
                            $innertask = $this->getEquipmentTemplateTask_taskbysubsetId_import('pm_au_template_task', $typedesign->AU_Template_Designation_ID, $tsubset->AU_Template_Task_ID);
                            $data = (array) $tsubset;
                            unset($data['AU_Template_Task_ID']);
                            $data['AU_Template_Designation_ID'] = $newdesignid;
                            $data['User_id'] = $user_id;
                            $parent_id = $this->insertEquipmentTemplatesubset($data);
                            if (!empty($innertask)) {
                                foreach ($innertask as $task) {
                                    $innerdata = (array) $task;
                                    unset($innerdata['AU_Template_Task_ID']);
                                    $innerdata['Parent_ID'] = $parent_id;
                                    $innerdata['AU_Template_Designation_ID'] = $newdesignid;
                                    $innerdata['User_id'] = $user_id;
                                    $this->InsertEquipmentTemplatetask($innerdata);

                                    //die;
                                }
                            }
                        }

                        $task_data = $this->get_tabledata_Au('pm_au_template_task', $typedesign->AU_Template_Designation_ID);
                        foreach ($task_data as $tdata) {
                            $data = (array) $tdata;
                            unset($data['AU_Template_Task_ID']);
                            $data['AU_Template_Designation_ID'] = $newdesignid;
                            $data['User_id'] = $user_id;
                            $this->InsertEquipmentTemplatetask($data);
                        }
                        
                        
                        /* Reading Section  */
                        $task_subset = $this->getEquipmentTemplateTask_subsetbyid_import('pm_au_template_reading', $typedesign->AU_Template_Designation_ID);
                        foreach ($task_subset as $tsubset) {
                            $innertask = $this->getEquipmentTemplateTask_taskbysubsetId_import('pm_au_template_reading', $typedesign->AU_Template_Designation_ID, $tsubset->AU_Template_Reading_ID);
                            $data = (array) $tsubset;
                            unset($data['AU_Template_Reading_ID']);
                            $data['AU_Template_Designation_ID'] = $newdesignid;
                            $data['User_id'] = $user_id;
                            $parent_id = $this->insertEquipmentTemplateReadingsubset($data);
                            if (!empty($innertask)) {
                                foreach ($innertask as $task) {
                                    $innerdata = (array) $task;
                                    unset($innerdata['AU_Template_Reading_ID']);
                                    $innerdata['Parent_ID'] = $parent_id;
                                    $innerdata['AU_Template_Designation_ID'] = $newdesignid;
                                    $innerdata['User_id'] = $user_id;
                                    $this->InsertEquipmentTemplateReading($innerdata);

                                    //die;
                                }
                            }
                        }

                        $task_data = $this->get_tabledata_Au('pm_au_template_reading', $typedesign->AU_Template_Designation_ID);
                        foreach ($task_data as $tdata) {
                            $data = (array) $tdata;
                            unset($data['AU_Template_Reading_ID']);
                            $data['AU_Template_Designation_ID'] = $newdesignid;
                            $data['User_id'] = $user_id;
                            $this->InsertEquipmentTemplateReading($data);
                        }
                        
                    }
                }
            }
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Save into Vt Table Task and Reading data from Au table 
     */
    public function saveIntoVtTableTaskAndReading($design_id, $vt_desing_id, $user_id) {

        /* Task Section  */
        $task_subset = $this->getEquipmentTemplateTask_subsetbyid_import('pm_au_template_task', $design_id);
        foreach ($task_subset as $tsubset) {
            $innertask = $this->getEquipmentTemplateTask_taskbysubsetId_import('pm_au_template_task', $design_id, $tsubset->AU_Template_Task_ID);
            $data = (array) $tsubset;
            unset($data['AU_Template_Task_ID']);
            unset($data['Startdate_EOM']);
            $data['VT_Template_Designation_ID'] = $vt_desing_id;
            unset($data['AU_Template_Designation_ID']);
            unset($data['User_id']);
            $data['User_ID'] = $user_id;
            $parent_id = $this->insertVTTemplatesubset($data);

            if (!empty($innertask)) {
                foreach ($innertask as $task) {
                    $innerdata = (array) $task;
                    unset($innerdata['AU_Template_Task_ID']);
                    unset($innerdata['Startdate_EOM']);
                    $innerdata['Parent_ID'] = $parent_id;
                    $innerdata['VT_Template_Designation_ID'] = $vt_desing_id;
                    unset($innerdata['AU_Template_Designation_ID']);
                    unset($innerdata['User_id']);
                    $innerdata['User_ID'] = $user_id;
                    $this->InsertVTTemplatetask($innerdata);
                    //die;
                }
            }
        }

        $task_data = $this->get_tabledata_Au('pm_au_template_task', $design_id);
        foreach ($task_data as $tdata) {
            $data = (array) $tdata;
            unset($data['AU_Template_Task_ID']);
            unset($data['Startdate_EOM']);
            unset($data['User_id']);
            $data['VT_Template_Designation_ID'] = $vt_desing_id;
            unset($data['AU_Template_Designation_ID']);
            $data['User_ID'] = $user_id;
            $this->InsertVTTemplatetask($data);
        }

        /* Reading Section  */
        $task_subset = $this->getEquipmentTemplateTask_subsetbyid_import('pm_au_template_reading', $design_id);
        foreach ($task_subset as $tsubset) {
            $innertask = $this->getEquipmentTemplateTask_taskbysubsetId_import('pm_au_template_reading', $design_id, $tsubset->AU_Template_Reading_ID);
            $data = (array) $tsubset;
            unset($data['AU_Template_Reading_ID']);
            unset($data['Startdate_EOM']);
            $data['VT_Template_Designation_ID'] = $vt_desing_id;
            unset($data['AU_Template_Designation_ID']);
            unset($data['User_id']);
            $data['User_ID'] = $user_id;
            $parent_id = $this->insertVTTemplatesubsetReading($data);
            if (!empty($innertask)) {
                foreach ($innertask as $task) {
                    $innerdata = (array) $task;
                    unset($innerdata['AU_Template_Reading_ID']);
                    unset($innerdata['Startdate_EOM']);
                    $innerdata['Parent_ID'] = $parent_id;
                    $innerdata['VT_Template_Designation_ID'] = $vt_desing_id;
                    unset($innerdata['AU_Template_Designation_ID']);
                    unset($innerdata['User_id']);
                    $innerdata['User_ID'] = $user_id;
                    $this->InsertVTTemplateReading($innerdata);
                    //die;
                }
            }
        }

        $task_data = $this->get_tabledata_Au('pm_au_template_reading', $design_id);
        foreach ($task_data as $tdata) {
            $data = (array) $tdata;
            unset($data['AU_Template_Reading_ID']);
            unset($data['Startdate_EOM']);
            unset($data['User_id']);
            $data['VT_Template_Designation_ID'] = $vt_desing_id;
            unset($data['AU_Template_Designation_ID']);
            $data['User_ID'] = $user_id;
            $this->InsertVTTemplateReading($data);
        }

        return true;
        
    }

    public function getEquipmentTemplateTask_subsetbyid_import($table_name, $desig_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("AU_Template_Designation_ID = " . $desig_id . " and AU_Frequency_ID is null and Parent_ID = 0");
        }
        //echo $select;
        // die;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function getEquipmentTemplateTask_taskbysubsetId_import($table_name, $desig_id, $Parent_ID) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($desig_id)) {
            $select = $db->select()
                    ->from(array($table_name))
                    ->where("AU_Template_Designation_ID = " . $desig_id . "  and Parent_ID = " . $Parent_ID);
        }
        //echo $select;
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }

    public function insertVTTemplatesubset($SubsetData) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($SubsetData)) {
            try {
                $insert = $db->insert('pm_vt_template_task', $SubsetData);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function InsertVTTemplatetask($taskdata) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($taskdata)) {
            try {
                $insert = $db->insert('pm_vt_template_task', $taskdata);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function insertVTTemplatesubsetReading($SubsetData) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($SubsetData)) {
            try {
                $insert = $db->insert('pm_vt_template_reading', $SubsetData);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function InsertVTTemplateReading($taskdata) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($taskdata)) {
            try {
                $insert = $db->insert('pm_vt_template_reading', $taskdata);
                $id = $db->lastInsertId();
                return $id;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    
    public function getEquipmentDetailID($build_id,$design_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from(array('t1' => 'pm_au_equipment_detail'),array('AU_Equipment_Detail_ID'=>'t1.AU_Equipment_Detail_ID'));
            $select->where('t1.BuildingID  = ?', $build_id);
            $select->where('t1.AU_Template_Designation_ID  = ?', $design_id);
            $select->group('t1.AU_Equipment_Detail_ID');
            $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }
    
    public function updateonlystartdateofmonthequipmentdetailtaskroot($data, $eqp_detail_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                if ($includesubset == "") {
                    $db->query("UPDATE pm_au_template_task as t1, pm_au_equipment_task as t2 SET t2.Startdate_month='" . $data['Startdate_month'] . "' WHERE t1.AU_Template_Task_ID=t2.AU_Template_Task_ID AND t1.Parent_ID=0 AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                } else {
                    $db->query("UPDATE pm_au_template_task as t1, pm_au_equipment_task as t2 SET t2.Startdate_month='" . $data['Startdate_month'] . "' WHERE t1.AU_Template_Task_ID=t2.AU_Template_Task_ID AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    
    public function updateonlystartdateofmonthequipmentdetailtasksubset($data, $eqp_detail_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $db->query("UPDATE pm_au_template_task as t1, pm_au_equipment_task as t2 SET t2.Startdate_month='" . $data['startdate_month'] . "' WHERE t1.AU_Template_Task_ID=t2.AU_Template_Task_ID AND t1.Parent_ID='" . $Parent_ID . "' AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    
    public function updateonlystartdateofmonthequipmentdetailreadingroot($data, $eqp_detail_id = "", $includesubset = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                if ($includesubset == "") {
                    $db->query("UPDATE pm_au_template_reading as t1, pm_au_equipment_readings as t2 SET t2.Startdate_month='" . $data['Startdate_month'] . "' WHERE t1.AU_Template_Reading_ID=t2.AU_Template_Reading_ID AND t1.Parent_ID=0 AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                } else {
                    $db->query("UPDATE pm_au_template_reading as t1, pm_au_equipment_readings as t2 SET t2.Startdate_month='" . $data['Startdate_month'] . "' WHERE t1.AU_Template_Reading_ID=t2.AU_Template_Reading_ID AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                }
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    
    public function updateonlystartdateofmonthequipmentdetailreadingsubset($data, $eqp_detail_id = "", $Parent_ID = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $db->query("UPDATE pm_au_template_reading as t1, pm_au_equipment_readings as t2 SET t2.Startdate_month='" . $data['startdate_month'] . "' WHERE t1.AU_Template_Reading_ID=t2.AU_Template_Reading_ID AND t1.Parent_ID='" . $Parent_ID . "' AND t1.AU_Frequency_ID is not null AND t2.AU_Equipment_Detail_ID='" . $eqp_detail_id . "'");
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    
    /**
     * This is of save the PM Generate wO's
     */
    public function insertpmgeneratewo($data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $db->insert('pm_au_wo_manual', $data);
                return true;                
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    
    /**
     * select data for show the Manually Generate WO's
     */
    public function getManuallyGenerateWO($buidingId) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($buidingId)) {
            $select = $db->select()                    
                    ->from(array('t1' => 'pm_au_wo_manual'), array('dateCreated'=>'t1.Date_TimeStamp','woGeneratedDate'=>'t1.PM_MAN_Date'))
                    ->joinLeft(array('t2' => 'users'), 't2.uid = t1.user_id', array('createdBy' => new Zend_Db_Expr("CONCAT(t2.firstName, ' ', t2.lastName)")))
                    ->where("t1.Building_ID = " . $buidingId);
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }
    
     /**
     * This is of save the notes / Comments PM complete wO's
     */
    public function insertnotespmcompletewo($data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $db->insert('pm_au_history_notes', $data);
                return true;                
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    /**
     * select data for show the notes / Comments for pm-complete WO's
     */
    public function getNotesofpmcompletewo($buidingId, $pmwonumber) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($buidingId)) {
            $select = $db->select()                    
                    ->from(array('t1' => 'pm_au_history_notes'), array('PM_WO_Notes_ID'=>'t1.PM_WO_Notes_ID','PM_WO_Notes'=>'t1.PM_WO_Notes'))                    
                    ->where("t1.Building_ID = " . $buidingId)
                    ->where("t1.PM_WO_Number = " . $pmwonumber);
        }
        $res = $db->fetchAll($select);
        return ($res && sizeof($res) > 0) ? $res : false;
    }
   /**
    * update the notes / Comments for pm complete wo's
    */ 
    public function updatenotespmcompletewo($updatedata, $pm_wo_notes_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($updatedata)) {
            try {
                $con = 'PM_WO_Notes_ID=' . $pm_wo_notes_id;
                $condition = array($con);
                $db->update('pm_au_history_notes', $updatedata, $condition);
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    
    /*
     * This is for Get data from pm_au_work_order
     */
    public function getWorkOrderData($pmwonumber,$building_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_work_order'), array('t1.AU_Equipment_Detail_ID','t1.AU_Template_Designation_ID'));
            $select->where('t1.BuildingID  = ?', $building_id);
            $select->where('t1.PM_WO_Number  = ?', $pmwonumber);
            $select->group(array('t1.PM_WO_Number'));
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    /**
     * This is of save the Photos / Documents PM complete wO's
     */
    public function insertphotospmcompletewo($data) {
       
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $db->insert('pm_au_history_photos', $data);
                $id = $db->lastInsertId();
                return $id;
                         
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    
    /**
     * This is of save the multiple Photos / Documents PM complete wO's
     */
    public function insertmultiplephotospmcompletewo($data) {       
        $db = Zend_Db_Table::getDefaultAdapter();
        if (!empty($data)) {
            try {
                $db->insert('pm_au_history_wo_photo', $data);
                return true;
                         
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
    
    /*
     * This is for Get data from pm_au_work_order
     */
    public function getHistoryPhotosWOData($pmwonumber,$building_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_history_photos'), array('t1.PM_WO_Photo_ID','t1.PM_WO_Photo'));
            $select->where('t1.Building_ID  = ?', $building_id);
            $select->where('t1.PM_WO_Number  = ?', $pmwonumber);            
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    /**
     * 
     */
    public function deletedocumenthistorywo($pm_wo_photo_id) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $condition = array('PM_WO_Photo_ID = ' . $pm_wo_photo_id);
            $db->delete('pm_au_history_photos', $condition);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    /*
     * get pm work order task detail
     */

    public function getPmWorkorderHistoryDetail($building_id,$readingTask, $data = "") {
       
        $db = Zend_Db_Table::getDefaultAdapter();
        //$select = $db->select();
        try {
            $select1 = $db->select()->from(array('t1' => 'pm_au_history'), array('PM_History_ID' => 't1.PM_History_ID', 'BuildingID' => 't1.BuildingID', 'PM_WO_Number' => 't1.PM_WO_Number', 'PM_WO_StartDate' => 't1.PM_WO_StartDate', 'Reading_Task' => 't1.Reading_Task', 'WO_Parent_ID' => 't1.Parent_ID','PM_Actual_JobTime'=>'t1.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t1.PM_WO_Complete_Date','PM_Note_Comments'=>'t1.PM_Note_Comments','PM_CompletedBy_UID'=>'t1.PM_CompletedBy_UID','Created_at'=>'t1.Created_at','AU_Equipment_Detail_ID'=>'t1.AU_Equipment_Detail_ID', 'AU_Template_Designation_ID'=>'t1.AU_Template_Designation_ID','AU_Equipment_Task_Reading_ID'=>'t1.AU_Equipment_Task_Reading_ID'))
                    ->joinLeft(array('t2' => 'pm_au_equipment_task'), 't2.AU_Equipment_Task_ID = t1.AU_Equipment_Task_Reading_ID', array(''))
                    ->joinLeft(array('t3' => 'pm_au_template_task'), 't3.AU_Template_Task_ID = t2.AU_Template_Task_ID', array('Sort_Order' => 't3.View_order', 'Task_Instruction' => 't3.Task_Instruction', 'JobTime' => 't3.Task_jobtime', 'AU_Template_Task_ID' => 't3.AU_Template_Task_ID', 'Parent_ID' => 't3.Parent_ID'))
                    ->joinLeft(array('t4' => 'pm_au_frequency'), 't4.AU_Frequency_ID = t3.AU_Frequency_ID ', array('Frequency' => 't4.Name'))

                    ->joinLeft(array('nt1' => 'pm_au_equipment_detail'), 'nt1.AU_Equipment_Detail_ID = t1.AU_Equipment_Detail_ID', array('Equipment_Floor' => 'nt1.Equipment_Floor', 'Equipment_Unit' => 'nt1.Equipment_Unit', 'Equipment_Location' => 'nt1.Equipment_Location'))
                    ->joinLeft(array('nt3' => 'pm_au_equipment_name'), 'nt3.AU_Equipment_Name_ID = nt1.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 'nt3.AU_Equipment_Name'))
                    
                    ->where('t1.Reading_Task  = ?', $readingTask)
                    ->where('t1.BuildingID  = ?', $building_id);
                    
                    if(!empty($data)){
                        if($data['historySearch']=='All'){ 
                            $select1->where('t1.AU_Equipment_Detail_ID  = ?', $data['unit']);
                        } else if($data['historySearch']=='woNumber'){
                            $select1->where('t1.PM_WO_Number between '.$data['wonumberfrom'].' and '.$data['wonumberto'].'');
                                                        
                        } else if($data['historySearch']=='dateRnage'){
                            
                            $yrdata = strtotime($data['dateToUpdate']);
                            $updata['Start_date'] = date('M Y', $yrdata);
                            
                            
                            $datefrom = date("Y-m-d", strtotime($data['datefrom']));
                            $dateto = date("Y-m-d", strtotime($data['dateto']));
                            //$select1->where('t1.Created_at between '.$datefrom.' and '.$dateto.'');
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') >= ?",  $datefrom);
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') <= ?",  $dateto);                           
                            
                        }                       
                        
                    }
                    
                    //->where('t1.PM_WO_Number  = ?', $pmwonumber)
                    $select1->group(array('t1.PM_WO_Number'))
                    ->group(array('t1.BuildingID'))
                    ->group(array('t3.View_order'))
                    ->group(array('t3.Task_Instruction'))
                    ->group(array('t3.AU_Template_Task_ID'))
                    ->group(array('t4.Name'))
                    ->group(array('t1.Parent_ID'))
                    ->group(array('t1.Reading_Task'));


            $select2 = $db->select()->from(array('t8' => 'pm_au_history'), array('PM_History_ID' => 't8.PM_History_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID','PM_Actual_JobTime'=>'t8.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t8.PM_WO_Complete_Date','PM_Note_Comments'=>'t8.PM_Note_Comments','PM_CompletedBy_UID'=>'t8.PM_CompletedBy_UID','Created_at'=>'t8.Created_at','AU_Equipment_Detail_ID'=>'t8.AU_Equipment_Detail_ID', 'AU_Template_Designation_ID'=>'t8.AU_Template_Designation_ID', 'AU_Equipment_Task_Reading_ID'=>'t8.AU_Equipment_Task_Reading_ID'))
                   ->joinLeft(array('t7' => 'pm_au_template_task'), 't7.AU_Template_Task_ID = t8.Parent_ID ', array('Sort_Order' => 't7.View_order', 'Task_Instruction' => 't7.Task_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Task_ID' => 't7.AU_Template_Task_ID', 'Parent_ID' => 't7.Parent_ID'))
                    ->joinLeft(array('t9' => 'pm_au_equipment_task'), 't9.AU_Equipment_Task_ID = t8.AU_Equipment_Task_Reading_ID',array(''))                    
                    ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))

                    ->joinLeft(array('nt2' => 'pm_au_equipment_detail'), 'nt2.AU_Equipment_Detail_ID = t8.AU_Equipment_Detail_ID', array('Equipment_Floor' => 'nt2.Equipment_Floor', 'Equipment_Unit' => 'nt2.Equipment_Unit', 'Equipment_Location' => 'nt2.Equipment_Location'))
                    ->joinLeft(array('nt4' => 'pm_au_equipment_name'), 'nt4.AU_Equipment_Name_ID = nt2.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 'nt4.AU_Equipment_Name'))

                    ->where('t8.Reading_Task  = ?', $readingTask)
                    ->where('t8.BuildingID  = ?', $building_id);
                    
                    if(!empty($data)){
                        if($data['historySearch']=='All'){
                            $select2->where('t8.AU_Equipment_Detail_ID  = ?', $data['unit']);
                        } else if($data['historySearch']=='woNumber'){
                            $select2->where('t8.PM_WO_Number between '.$data['wonumberfrom'].' and '.$data['wonumberto'].'');
                                                        
                        } else if($data['historySearch']=='dateRnage'){                           
                            $datefrom = date("Y-m-d", strtotime($data['datefrom']));
                            $dateto = date("Y-m-d", strtotime($data['dateto']));
                            //$select2->where('t8.Created_at between '.$datefrom.' and '.$dateto.''); 
                            $select2->where("DATE_FORMAT(DATE(t8.Created_at), '%Y-%m-%d') >= ?",  $datefrom);
                            $select2->where("DATE_FORMAT(DATE(t8.Created_at), '%Y-%m-%d') <= ?",  $dateto);
                        }
                        
                        
                    }
                    
                    //->where('t8.PM_WO_Number  = ?', $pmwonumber)
                    $select2->where('t8.Parent_ID  > 0')
                    ->group(array('t8.PM_WO_Number'))
                    ->group(array('t8.BuildingID'))
                    ->group(array('t7.View_order'))
                    ->group(array('t7.Task_Instruction'))
                    ->group(array('t7.Task_jobtime'))
                    ->group(array('t7.AU_Template_Task_ID'))
                    ->group(array('t6.Name'))
                    ->group(array('t8.Parent_ID'))
                    ->group(array('t8.Reading_Task'))
                    ->order('PM_WO_Number');

            $select = $db->select()->union(array($select1, $select2));
			//$sql = $select->__toString();
			//echo "jhgfshd";
			//echo "$sql\n";
            //->order('title');
            //echo $select; //die('Emad');                    
            $res = $db->fetchAll($select);
            foreach ($res as $data) {
                $datas[] = (array) $data;
            }
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function getPmWorkorderHistorySortDetail($building_id, $readingTask, $data = []) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select1 = $db->select()->from(array('t1' => 'pm_au_history'), array('PM_History_ID' => 't1.PM_History_ID', 'BuildingID' => 't1.BuildingID', 'PM_WO_Number' => 't1.PM_WO_Number', 'PM_WO_StartDate' => 't1.PM_WO_StartDate', 'Reading_Task' => 't1.Reading_Task', 'WO_Parent_ID' => 't1.Parent_ID','PM_Actual_JobTime'=>'t1.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t1.PM_WO_Complete_Date','PM_Note_Comments'=>'t1.PM_Note_Comments','PM_CompletedBy_UID'=>'t1.PM_CompletedBy_UID','Created_at'=>'t1.Created_at','AU_Equipment_Detail_ID'=>'t1.AU_Equipment_Detail_ID', 'AU_Template_Designation_ID'=>'t1.AU_Template_Designation_ID','AU_Equipment_Task_Reading_ID'=>'t1.AU_Equipment_Task_Reading_ID'))
            ->joinLeft(array('t2' => 'pm_au_equipment_task'), 't2.AU_Equipment_Task_ID = t1.AU_Equipment_Task_Reading_ID', array(''))
            ->joinLeft(array('t3' => 'pm_au_template_task'), 't3.AU_Template_Task_ID = t2.AU_Template_Task_ID', array('AU_Frequency_ID' => 't3.AU_Frequency_ID','Sort_Order' => 't3.View_order', 'Task_Instruction' => 't3.Task_Instruction', 'JobTime' => 't3.Task_jobtime', 'AU_Template_Task_ID' => 't3.AU_Template_Task_ID', 'Parent_ID' => 't3.Parent_ID'))
            ->joinLeft(array('t4' => 'pm_au_frequency'), 't4.AU_Frequency_ID = t3.AU_Frequency_ID ', array('Frequency' => 't4.Name'))
                    ->joinLeft(array('nt1' => 'pm_au_equipment_detail'), 'nt1.AU_Equipment_Detail_ID = t1.AU_Equipment_Detail_ID', array('Equipment_Floor' => 'nt1.Equipment_Floor', 'Equipment_Unit' => 'nt1.Equipment_Unit', 'Equipment_Location' => 'nt1.Equipment_Location'))
                    ->joinLeft(array('nt3' => 'pm_au_equipment_name'), 'nt3.AU_Equipment_Name_ID = nt1.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 'nt3.AU_Equipment_Name'))
                    ->where('t1.Reading_Task  = ?', $readingTask)
                    //->where('t3.Parent_ID  = 0')
                    ->where('t1.BuildingID  = ?', $building_id);
                    
                    if(!empty($data)){
                        
                        if($data['historySearch']=='All' && !empty($data['unit'])){ 
                            $select1->where('t1.AU_Equipment_Detail_ID  = ?', $data['unit']);
                        } else if($data['historySearch']=='woNumber' && !empty($data['wonumberfrom']) && !empty($data['wonumberto'])){
                            $select1->where('t1.PM_WO_Number between '.$data['wonumberfrom'].' and '.$data['wonumberto'].'');
                        } else if($data['historySearch']=='dateRnage'){
                            $yrdata = strtotime($data['dateToUpdate']);
                            $updata['Start_date'] = date('M Y', $yrdata);
                            $datefrom = date("Y-m-d", strtotime($data['datefrom']));
                            $dateto = date("Y-m-d", strtotime($data['dateto']));
                            //$select1->where('t1.Created_at between '.$datefrom.' and '.$dateto.'');
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') >= ?",  $datefrom);
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') <= ?",  $dateto); 
                        }          
                    }
                  $select1->group(array('t1.PM_WO_Number'));
            //$sql = $select1->__toString();
			//echo "jhgfshd";
			//echo "$sql\n";
			//die;
            $res = $db->fetchAll($select1);
            foreach ($res as $i => $data) {  
                $datas[$i] = (array) $data;
            }
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getPmWorkorderHistorySortTitleDetailHC($building_id,$PM_History_ID, $PM_WO_Number, $Reading_Task, $child) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            

            $select2 = $db->select()->from(array('t8' => 'pm_au_history'), array('PM_History_ID' => 't8.PM_History_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID','PM_Actual_JobTime'=>'t8.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t8.PM_WO_Complete_Date','PM_Note_Comments'=>'t8.PM_Note_Comments','PM_CompletedBy_UID'=>'t8.PM_CompletedBy_UID','Created_at'=>'t8.Created_at','AU_Equipment_Detail_ID'=>'t8.AU_Equipment_Detail_ID', 'AU_Template_Designation_ID'=>'t8.AU_Template_Designation_ID', 'AU_Equipment_Task_Reading_ID'=>'t8.AU_Equipment_Task_Reading_ID'))
            ->joinLeft(array('t9' => 'pm_au_equipment_task'), 't9.AU_Equipment_Task_ID = t8.AU_Equipment_Task_Reading_ID',array('')) 
            ->joinLeft(array('t7' => 'pm_au_template_task'), 't7.AU_Template_Task_ID = t9.AU_Template_Task_ID ', array('Sort_Order' => 't7.View_order', 'Task_Instruction' => 't7.Task_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Task_ID' => 't7.AU_Template_Task_ID', 'Parent_ID' => 't7.Parent_ID'))
                                
            ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))
            ->joinLeft(array('nt2' => 'pm_au_equipment_detail'), 'nt2.AU_Equipment_Detail_ID = t8.AU_Equipment_Detail_ID', array('Equipment_Floor' => 'nt2.Equipment_Floor', 'Equipment_Unit' => 'nt2.Equipment_Unit', 'Equipment_Location' => 'nt2.Equipment_Location'))
            ->joinLeft(array('nt4' => 'pm_au_equipment_name'), 'nt4.AU_Equipment_Name_ID = nt2.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 'nt4.AU_Equipment_Name'));

            $select2->where('t8.PM_WO_Number  = ?', $PM_WO_Number)
            ->where('t8.Reading_Task  = ?', $Reading_Task)
            ->where('t8.BuildingID  = ?', $building_id);
            if($child){
                $select2->where('t8.Parent_ID  != 0')
                ->group(array('t6.Name'))  ;          
            }else{
                $select2->where('t8.Parent_ID  = 0');
            }
            $select2->order('AU_Template_Task_ID')
            ->order('PM_History_ID')
            ->order('PM_WO_Number');
            $resb = $db->fetchAll($select2);
            
            foreach ($resb as $k => $datab) {
                $datas[$k] = (array) $datab;
            }  
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getPmWorkorderHistorySortTitleDetailHNC($building_id,$PM_History_ID, $PM_WO_Number, $Reading_Task) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            

            $select2 = $db->select()->from(array('t8' => 'pm_au_history'), array('PM_History_ID' => 't8.PM_History_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID','PM_Actual_JobTime'=>'t8.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t8.PM_WO_Complete_Date','PM_Note_Comments'=>'t8.PM_Note_Comments','PM_CompletedBy_UID'=>'t8.PM_CompletedBy_UID','Created_at'=>'t8.Created_at','AU_Equipment_Detail_ID'=>'t8.AU_Equipment_Detail_ID', 'AU_Template_Designation_ID'=>'t8.AU_Template_Designation_ID', 'AU_Equipment_Task_Reading_ID'=>'t8.AU_Equipment_Task_Reading_ID'))
            ->joinLeft(array('t9' => 'pm_au_equipment_task'), 't9.AU_Equipment_Task_ID = t8.AU_Equipment_Task_Reading_ID',array('')) 
            ->joinLeft(array('t7' => 'pm_au_template_task'), 't7.AU_Template_Task_ID = t9.AU_Template_Task_ID ', array('Sort_Order' => 't7.View_order', 'Task_Instruction' => 't7.Task_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Task_ID' => 't7.AU_Template_Task_ID', 'Parent_ID' => 't7.Parent_ID'))
                                
            ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))
            ->joinLeft(array('nt2' => 'pm_au_equipment_detail'), 'nt2.AU_Equipment_Detail_ID = t8.AU_Equipment_Detail_ID', array('Equipment_Floor' => 'nt2.Equipment_Floor', 'Equipment_Unit' => 'nt2.Equipment_Unit', 'Equipment_Location' => 'nt2.Equipment_Location'))
            ->joinLeft(array('nt4' => 'pm_au_equipment_name'), 'nt4.AU_Equipment_Name_ID = nt2.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 'nt4.AU_Equipment_Name'));

            $select2->where('t8.PM_WO_Number  = ?', $PM_WO_Number)
            ->where('t8.Reading_Task  = ?', $Reading_Task)
            ->where('t8.BuildingID  = ?', $building_id)
            ->where('t8.Parent_ID  = 0')
            ->order('AU_Template_Task_ID')
            ->order('PM_History_ID')
            ->order('PM_WO_Number');
            $resb = $db->fetchAll($select2);
            
            foreach ($resb as $k => $datab) {
                $datas[$k] = (array) $datab;
            }  
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getPmWorkorderHistoryTitleChildDetail($building_id, $Parent_ID, $PM_WO_Number) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select2 = $db->select()->from(array('t8' => 'pm_au_history'), array('PM_History_ID' => 't8.PM_History_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID','PM_Actual_JobTime'=>'t8.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t8.PM_WO_Complete_Date','PM_Note_Comments'=>'t8.PM_Note_Comments','PM_CompletedBy_UID'=>'t8.PM_CompletedBy_UID','Created_at'=>'t8.Created_at','AU_Equipment_Detail_ID'=>'t8.AU_Equipment_Detail_ID', 'AU_Template_Designation_ID'=>'t8.AU_Template_Designation_ID', 'AU_Equipment_Task_Reading_ID'=>'t8.AU_Equipment_Task_Reading_ID'))
            ->joinLeft(array('t9' => 'pm_au_equipment_task'), 't9.AU_Equipment_Task_ID = t8.AU_Equipment_Task_Reading_ID',array('')) 
            ->joinLeft(array('t7' => 'pm_au_template_task'), 't7.AU_Template_Task_ID = t9.AU_Template_Task_ID ', array('Sort_Order' => 't7.View_order', 'Task_Instruction' => 't7.Task_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Task_ID' => 't7.AU_Template_Task_ID', 'Parent_ID' => 't7.Parent_ID'))
                                
            ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))
            ->joinLeft(array('nt2' => 'pm_au_equipment_detail'), 'nt2.AU_Equipment_Detail_ID = t8.AU_Equipment_Detail_ID', array('Equipment_Floor' => 'nt2.Equipment_Floor', 'Equipment_Unit' => 'nt2.Equipment_Unit', 'Equipment_Location' => 'nt2.Equipment_Location'))
            ->joinLeft(array('nt4' => 'pm_au_equipment_name'), 'nt4.AU_Equipment_Name_ID = nt2.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 'nt4.AU_Equipment_Name'));

            $select2->where('t8.PM_WO_Number  = ?', $PM_WO_Number)
            ->where('t7.Parent_ID  = ?', $Parent_ID)
            //->where('t8.PM_History_ID  = ?', $PM_History_ID)
            ->where('t8.BuildingID  = ?', $building_id)
            ->order('AU_Template_Task_ID')
            ->order('PM_History_ID')
            ->order('PM_WO_Number');
            $resb = $db->fetchAll($select2);
            
            foreach ($resb as $k => $datab) {
                $datas[$k] = (array) $datab;
            }  
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /*
     * get pm work order Reader detail
     */

    public function getPmWorkorderHistoryReadingSortDetail($building_id,$readingTask, $data = []) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select1 = $db->select()->from(array('t1' => 'pm_au_history'), array('PM_History_ID' => 't1.PM_History_ID', 'BuildingID' => 't1.BuildingID', 'PM_WO_Number' => 't1.PM_WO_Number', 'PM_WO_StartDate' => 't1.PM_WO_StartDate', 'Reading_Task' => 't1.Reading_Task', 'WO_Parent_ID' => 't1.Parent_ID','PM_Actual_JobTime'=>'t1.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t1.PM_WO_Complete_Date','PM_Note_Comments'=>'t1.PM_Note_Comments','PM_CompletedBy_UID'=>'t1.PM_CompletedBy_UID','Created_at'=>'t1.Created_at','his_reading_value'=>'t1.Reading_Value','AU_Equipment_Detail_ID'=>'t1.AU_Equipment_Detail_ID'))
            ->joinLeft(array('t2' => 'pm_au_equipment_readings'), 't2.AU_Equipment_Readings_ID = t1.AU_Equipment_Task_Reading_ID', array(''))
            ->joinLeft(array('t3' => 'pm_au_template_reading'), 't3.AU_Template_Reading_ID = t2.AU_Template_Reading_ID', array('Sort_Order' => 't3.View_order', 'Reading_Instruction' => 't3.Reading_Instruction', 'JobTime' => 't3.Task_jobtime', 'AU_Template_Reading_ID' => 't3.AU_Template_Reading_ID', 'Parent_ID' => 't3.Parent_ID','Reading_Value'=>'t3.Reading_Value'))
            ->joinLeft(array('t4' => 'pm_au_frequency'), 't4.AU_Frequency_ID = t3.AU_Frequency_ID ', array('Frequency' => 't4.Name'))
            ->joinLeft(array('t5' => 'pm_au_unitofmeasure'), 't5.AU_uom_ID = t3.AU_uom_ID', array('Unit_of_Measure' => 't5.Name'))
            ->joinLeft(array('nt1' => 'pm_au_equipment_detail'), 'nt1.AU_Equipment_Detail_ID = t1.AU_Equipment_Detail_ID', array('Equipment_Floor' => 'nt1.Equipment_Floor', 'Equipment_Unit' => 'nt1.Equipment_Unit', 'Equipment_Location' => 'nt1.Equipment_Location'))
            ->joinLeft(array('nt3' => 'pm_au_equipment_name'), 'nt3.AU_Equipment_Name_ID = nt1.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 'nt3.AU_Equipment_Name'))
                    ->where('t1.Reading_Task  = ?', $readingTask)
                    //->where('t3.Parent_ID  = 0')
                    ->where('t1.BuildingID  = ?', $building_id);
                    if(!empty($data)){
                        if($data['historySearch']=='All' && !empty($data['unit'])){ 
                            $select1->where('t1.AU_Equipment_Detail_ID  = ?', $data['unit']);
                        } else if($data['historySearch']=='woNumber'){
                            $select1->where('t1.PM_WO_Number between '.$data['wonumberfrom'].' and '.$data['wonumberto'].'');
                        } else if($data['historySearch']=='dateRnage'){
                            $yrdata = strtotime($data['dateToUpdate']);
                            $updata['Start_date'] = date('M Y', $yrdata);
                            $datefrom = date("Y-m-d", strtotime($data['datefrom']));
                            $dateto = date("Y-m-d", strtotime($data['dateto']));
                            //$select1->where('t1.Created_at between '.$datefrom.' and '.$dateto.'');
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') >= ?",  $datefrom);
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') <= ?",  $dateto); 
                        }          
                    }
                    $select1->group(array('t1.PM_WO_Number'));
            // $sql = $select1->__toString();
			// echo "jhgfshd";
			// echo "$sql\n";                 
            $res = $db->fetchAll($select1);
            foreach ($res as $i => $data) {  
                $datas[$i] = (array) $data;
            }
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getPmWorkorderHistoryReadingSortTitleDetailHC($building_id,$PM_History_ID, $PM_WO_Number, $Reading_Task, $child) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select2 = $db->select()->from(array('t8' => 'pm_au_history'), array('PM_History_ID' => 't8.PM_History_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID','PM_Actual_JobTime'=>'t8.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t8.PM_WO_Complete_Date','PM_Note_Comments'=>'t8.PM_Note_Comments','PM_CompletedBy_UID'=>'t8.PM_CompletedBy_UID','Created_at'=>'t8.Created_at','his_reading_value'=>'t8.Reading_Value','AU_Equipment_Detail_ID'=>'t8.AU_Equipment_Detail_ID'))
            
            ->joinLeft(array('t9' => 'pm_au_equipment_readings'), 't9.AU_Equipment_Readings_ID = t8.AU_Equipment_Task_Reading_ID',array(''))
            ->joinLeft(array('t7' => 'pm_au_template_reading'), 't9.AU_Template_Reading_ID = t7.AU_Template_Reading_ID', array('Sort_Order' => 't7.View_order', 'Reading_Instruction' => 't7.Reading_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Reading_ID' => 't7.AU_Template_Reading_ID', 'Parent_ID' => 't7.Parent_ID','Reading_Value'=>'t7.Reading_Value'))
            ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))
            ->joinLeft(array('t55' => 'pm_au_unitofmeasure'), 't55.AU_uom_ID = t7.AU_uom_ID', array('Unit_of_Measure' => 't55.Name'))
            ->joinLeft(array('nt2' => 'pm_au_equipment_detail'), 'nt2.AU_Equipment_Detail_ID = t8.AU_Equipment_Detail_ID', array('Equipment_Floor' => 'nt2.Equipment_Floor', 'Equipment_Unit' => 'nt2.Equipment_Unit', 'Equipment_Location' => 'nt2.Equipment_Location'))
            ->joinLeft(array('nt4' => 'pm_au_equipment_name'), 'nt4.AU_Equipment_Name_ID = nt2.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 'nt4.AU_Equipment_Name'));

            $select2->where('t8.PM_WO_Number  = ?', $PM_WO_Number)
            ->where('t8.Reading_Task  = ?', $Reading_Task)
            ->where('t8.PM_History_ID  = ?', $PM_History_ID)
            ->where('t8.BuildingID  = ?', $building_id);
            if($child){
                $select2->where('t8.Parent_ID  != 0')
                ->group(array('t6.Name'))  ;          
            }else{
                $select2->where('t8.Parent_ID  = 0');
            }
            
            $select2->order('Sort_Order')
            ->order('PM_History_ID')
            ->order('PM_WO_Number');
            $resb = $db->fetchAll($select2);
           
            foreach ($resb as $k => $datab) {
                $datas[$k] = (array) $datab;
            }  
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getPmWorkorderHistoryReadingSortTitleDetailHNC($building_id,$PM_History_ID, $PM_WO_Number, $Reading_Task) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select2 = $db->select()->from(array('t8' => 'pm_au_history'), array('PM_History_ID' => 't8.PM_History_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID','PM_Actual_JobTime'=>'t8.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t8.PM_WO_Complete_Date','PM_Note_Comments'=>'t8.PM_Note_Comments','PM_CompletedBy_UID'=>'t8.PM_CompletedBy_UID','Created_at'=>'t8.Created_at','his_reading_value'=>'t8.Reading_Value','AU_Equipment_Detail_ID'=>'t8.AU_Equipment_Detail_ID'))
            ->joinLeft(array('t7' => 'pm_au_template_reading'), 't7.AU_Template_Reading_ID = t8.Parent_ID ', array('Sort_Order' => 't7.View_order', 'Reading_Instruction' => 't7.Reading_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Reading_ID' => 't7.AU_Template_Reading_ID', 'Parent_ID' => 't7.Parent_ID','Reading_Value'=>'t7.Reading_Value'))
            ->joinLeft(array('t9' => 'pm_au_equipment_readings'), 't9.AU_Equipment_Readings_ID = t8.AU_Equipment_Task_Reading_ID',array(''))
            
            ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))
            ->joinLeft(array('t55' => 'pm_au_unitofmeasure'), 't55.AU_uom_ID = t7.AU_uom_ID', array('Unit_of_Measure' => 't55.Name'))
            ->joinLeft(array('nt2' => 'pm_au_equipment_detail'), 'nt2.AU_Equipment_Detail_ID = t8.AU_Equipment_Detail_ID', array('Equipment_Floor' => 'nt2.Equipment_Floor', 'Equipment_Unit' => 'nt2.Equipment_Unit', 'Equipment_Location' => 'nt2.Equipment_Location'))
            ->joinLeft(array('nt4' => 'pm_au_equipment_name'), 'nt4.AU_Equipment_Name_ID = nt2.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 'nt4.AU_Equipment_Name'));

            $select2->where('t8.PM_WO_Number  = ?', $PM_WO_Number)
            ->where('t8.Reading_Task  = ?', $Reading_Task)
            ->where('t8.PM_History_ID  = ?', $PM_History_ID)
            ->where('t8.BuildingID  = ?', $building_id)
            ->where('t8.Parent_ID  = 0')
            ->order('Sort_Order')
            ->order('PM_History_ID')
            ->order('PM_WO_Number');
            $resb = $db->fetchAll($select2);
              
            foreach ($resb as $k => $datab) {
                $datas[$k] = (array) $datab;
            }  
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getPmWorkorderHistoryReadingTitleChildDetail($building_id, $Parent_ID, $PM_WO_Number) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select2 = $db->select()->from(array('t8' => 'pm_au_history'), array('PM_History_ID' => 't8.PM_History_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID','PM_Actual_JobTime'=>'t8.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t8.PM_WO_Complete_Date','PM_Note_Comments'=>'t8.PM_Note_Comments','PM_CompletedBy_UID'=>'t8.PM_CompletedBy_UID','Created_at'=>'t8.Created_at','his_reading_value'=>'t8.Reading_Value','AU_Equipment_Detail_ID'=>'t8.AU_Equipment_Detail_ID'))
            ->joinLeft(array('t7' => 'pm_au_template_reading'), 't7.AU_Template_Reading_ID = t8.Parent_ID ', array('Sort_Order' => 't7.View_order', 'Reading_Instruction' => 't7.Reading_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Reading_ID' => 't7.AU_Template_Reading_ID', 'Parent_ID' => 't7.Parent_ID','Reading_Value'=>'t7.Reading_Value'))
            ->joinLeft(array('t9' => 'pm_au_equipment_readings'), 't9.AU_Equipment_Readings_ID = t8.AU_Equipment_Task_Reading_ID',array(''))
            
            ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))
            ->joinLeft(array('t55' => 'pm_au_unitofmeasure'), 't55.AU_uom_ID = t7.AU_uom_ID', array('Unit_of_Measure' => 't55.Name'))
            ->joinLeft(array('nt2' => 'pm_au_equipment_detail'), 'nt2.AU_Equipment_Detail_ID = t8.AU_Equipment_Detail_ID', array('Equipment_Floor' => 'nt2.Equipment_Floor', 'Equipment_Unit' => 'nt2.Equipment_Unit', 'Equipment_Location' => 'nt2.Equipment_Location'))
            ->joinLeft(array('nt4' => 'pm_au_equipment_name'), 'nt4.AU_Equipment_Name_ID = nt2.AU_Equipment_Name_ID', array('AU_Equipment_Name' => 'nt4.AU_Equipment_Name'));

            $select2->where('t7.Parent_ID  = ?', $Parent_ID)
            ->where('t8.PM_WO_Number  = ?', $PM_WO_Number)
            //->where('t8.PM_History_ID  = ?', $PM_History_ID)
            ->where('t8.BuildingID  = ?', $building_id)
            ->order('Sort_Order')
            ->order('PM_History_ID')
            ->order('PM_WO_Number');
            $resb = $db->fetchAll($select2);
            
            foreach ($resb as $k => $datab) {
                $datas[$k] = (array) $datab;
            }  
            return $datas;

        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
	
	
	/*
     * This is for Get data of equpment name according to PM_WO_Number
     */
    public function getallEquipmentNameByWorkorderId($building_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        try {
            $select = $db->select()->from(array('t1' => 'pm_au_history_photos'), array('t1.PM_WO_Photo_ID','t1.PM_WO_Photo'));
            $select->where('t1.Building_ID  = ?', $building_id);
            $select->where('t1.PM_WO_Number  = ?', $pmwonumber);            
            $res = $db->fetchAll($select);
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
	
    
    public function sortPmWorkorderHistoryDetailByWO($building_id,$readingTask, $data = "") {
        $db = Zend_Db_Table::getDefaultAdapter();
        //$select = $db->select();
        try {
            $select1 = $db->select()->from(array('t1' => 'pm_au_history'), array('PM_History_ID' => 't1.PM_History_ID', 'BuildingID' => 't1.BuildingID', 'PM_WO_Number' => 't1.PM_WO_Number', 'PM_WO_StartDate' => 't1.PM_WO_StartDate', 'Reading_Task' => 't1.Reading_Task', 'WO_Parent_ID' => 't1.Parent_ID','PM_Actual_JobTime'=>'t1.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t1.PM_WO_Complete_Date','PM_Note_Comments'=>'t1.PM_Note_Comments','PM_CompletedBy_UID'=>'t1.PM_CompletedBy_UID','Created_at'=>'t1.Created_at','AU_Equipment_Detail_ID'=>'t1.AU_Equipment_Detail_ID', 'AU_Template_Designation_ID'=>'t1.AU_Template_Designation_ID','AU_Equipment_Task_Reading_ID'=>'t1.AU_Equipment_Task_Reading_ID'))
                    ->joinLeft(array('t2' => 'pm_au_equipment_task'), 't2.AU_Equipment_Task_ID = t1.AU_Equipment_Task_Reading_ID', array(''))
                    ->joinLeft(array('t3' => 'pm_au_template_task'), 't3.AU_Template_Task_ID = t2.AU_Template_Task_ID', array('Sort_Order' => 't3.View_order', 'Task_Instruction' => 't3.Task_Instruction', 'JobTime' => 't3.Task_jobtime', 'AU_Template_Task_ID' => 't3.AU_Template_Task_ID', 'Parent_ID' => 't3.Parent_ID'))
                    ->joinLeft(array('t4' => 'pm_au_frequency'), 't4.AU_Frequency_ID = t3.AU_Frequency_ID ', array('Frequency' => 't4.Name'))
                    
                    ->where('t1.Reading_Task  = ?', $readingTask)
                    ->where('t1.BuildingID  = ?', $building_id);
                    //->where('t1.PM_WO_Number  = ?', $pmwonumber)
                    if(!empty($data)){
                        if($data['historySearch']=='All'){ 
                            $select1->where('t1.AU_Equipment_Detail_ID  = ?', $data['unit']);
                        } else if($data['historySearch']=='woNumber'){
                            $select1->where('t1.PM_WO_Number between '.$data['wonumberfrom'].' and '.$data['wonumberto'].'');
                                                        
                        } else if($data['historySearch']=='dateRnage'){
                            
                            $yrdata = strtotime($data['dateToUpdate']);
                            $updata['Start_date'] = date('M Y', $yrdata);
                            
                            
                            $datefrom = date("Y-m-d", strtotime($data['datefrom']));
                            $dateto = date("Y-m-d", strtotime($data['dateto']));
                            //$select1->where('t1.Created_at between '.$datefrom.' and '.$dateto.'');
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') >= ?",  $datefrom);
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') <= ?",  $dateto);                           
                            
                        }                       
                        
                    }
                    $select1->group(array('t1.PM_WO_Number'))
                    ->group(array('t1.BuildingID'))
                    ->group(array('t3.View_order'))
                    ->group(array('t3.Task_Instruction'))
                    ->group(array('t3.AU_Template_Task_ID'))
                    ->group(array('t4.Name'))
                    ->group(array('t1.Parent_ID'))
                    ->group(array('t1.Reading_Task'));


            $select2 = $db->select()->from(array('t8' => 'pm_au_history'), array('PM_History_ID' => 't8.PM_History_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID','PM_Actual_JobTime'=>'t8.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t8.PM_WO_Complete_Date','PM_Note_Comments'=>'t8.PM_Note_Comments','PM_CompletedBy_UID'=>'t8.PM_CompletedBy_UID','Created_at'=>'t8.Created_at','AU_Equipment_Detail_ID'=>'t8.AU_Equipment_Detail_ID', 'AU_Template_Designation_ID'=>'t8.AU_Template_Designation_ID', 'AU_Equipment_Task_Reading_ID'=>'t8.AU_Equipment_Task_Reading_ID'))
                   ->joinLeft(array('t7' => 'pm_au_template_task'), 't7.AU_Template_Task_ID = t8.Parent_ID ', array('Sort_Order' => 't7.View_order', 'Task_Instruction' => 't7.Task_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Task_ID' => 't7.AU_Template_Task_ID', 'Parent_ID' => 't7.Parent_ID'))
                    ->joinLeft(array('t9' => 'pm_au_equipment_task'), 't9.AU_Equipment_Task_ID = t8.AU_Equipment_Task_Reading_ID',array(''))
                    
                    ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))
                    ->where('t8.Reading_Task  = ?', $readingTask)
                    ->where('t8.BuildingID  = ?', $building_id);                    
                    //->where('t8.PM_WO_Number  = ?', $pmwonumber)
                    if(!empty($data)){
                        if($data['historySearch']=='All'){
                            $select2->where('t8.AU_Equipment_Detail_ID  = ?', $data['unit']);
                        } else if($data['historySearch']=='woNumber'){
                            $select2->where('t8.PM_WO_Number between '.$data['wonumberfrom'].' and '.$data['wonumberto'].'');
                                                        
                        } else if($data['historySearch']=='dateRnage'){                           
                            $datefrom = date("Y-m-d", strtotime($data['datefrom']));
                            $dateto = date("Y-m-d", strtotime($data['dateto']));
                            //$select2->where('t8.Created_at between '.$datefrom.' and '.$dateto.''); 
                            $select2->where("DATE_FORMAT(DATE(t8.Created_at), '%Y-%m-%d') >= ?",  $datefrom);
                            $select2->where("DATE_FORMAT(DATE(t8.Created_at), '%Y-%m-%d') <= ?",  $dateto);
                        }
                        
                        
                    }
                    $select2->where('t8.Parent_ID  > 0')
                    ->group(array('t8.PM_WO_Number'))
                    ->group(array('t8.BuildingID'))
                    ->group(array('t7.View_order'))
                    ->group(array('t7.Task_Instruction'))
                    ->group(array('t7.Task_jobtime'))
                    ->group(array('t7.AU_Template_Task_ID'))
                    ->group(array('t6.Name'))
                    ->group(array('t8.Parent_ID'))
                    ->group(array('t8.Reading_Task'));
                    //->order('Sort_Order')
                    if(!empty($data)){
                        if($data['id']==1){
                           $select2 ->order(array('PM_WO_Number DESC'));
                            
                        } else if($data['id']==0){
                            $select2 ->order(array('PM_WO_Number ASC'));
                        }
                        
                    }        
                    

            $select = $db->select()->union(array($select1, $select2));
            //->order('title');
            //echo $select; die('Emad');                    
            $res = $db->fetchAll($select);
            foreach ($res as $data) {
                $datas[] = (array) $data;
            }
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    /*
     * get pm work order reading detail
     */

    public function getPmWorkorderHistoryReadingDetail($building_id,$readingTask, $data = "") {
       
        $db = Zend_Db_Table::getDefaultAdapter();
        //$select = $db->select();
        try {
            $select1 = $db->select()->from(array('t1' => 'pm_au_history'), array('PM_History_ID' => 't1.PM_History_ID', 'BuildingID' => 't1.BuildingID', 'PM_WO_Number' => 't1.PM_WO_Number', 'PM_WO_StartDate' => 't1.PM_WO_StartDate', 'Reading_Task' => 't1.Reading_Task', 'WO_Parent_ID' => 't1.Parent_ID','PM_Actual_JobTime'=>'t1.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t1.PM_WO_Complete_Date','PM_Note_Comments'=>'t1.PM_Note_Comments','PM_CompletedBy_UID'=>'t1.PM_CompletedBy_UID','Created_at'=>'t1.Created_at','his_reading_value'=>'t1.Reading_Value','AU_Equipment_Detail_ID'=>'t1.AU_Equipment_Detail_ID'))
                    ->joinLeft(array('t2' => 'pm_au_equipment_readings'), 't2.AU_Equipment_Readings_ID = t1.AU_Equipment_Task_Reading_ID', array(''))
                    ->joinLeft(array('t3' => 'pm_au_template_reading'), 't3.AU_Template_Reading_ID = t2.AU_Template_Reading_ID', array('Sort_Order' => 't3.View_order', 'Reading_Instruction' => 't3.Reading_Instruction', 'JobTime' => 't3.Task_jobtime', 'AU_Template_Reading_ID' => 't3.AU_Template_Reading_ID', 'Parent_ID' => 't3.Parent_ID','Reading_Value'=>'t3.Reading_Value'))
                    ->joinLeft(array('t4' => 'pm_au_frequency'), 't4.AU_Frequency_ID = t3.AU_Frequency_ID ', array('Frequency' => 't4.Name'))
                    ->joinLeft(array('t5' => 'pm_au_unitofmeasure'), 't5.AU_uom_ID = t3.AU_uom_ID', array('Unit_of_Measure' => 't5.Name'))
                    ->where('t1.Reading_Task  = ?', $readingTask)
                    ->where('t1.BuildingID  = ?', $building_id);
                    
                    if(!empty($data)){
                        if($data['historySearch']=='All'){                            
                            $select1->where('t1.AU_Equipment_Detail_ID  = ?', $data['unit']);
                        } else if($data['historySearch']=='woNumber'){
                            $select1->where('t1.PM_WO_Number between '.$data['wonumberfrom'].' and '.$data['wonumberto'].'');
                                                        
                        } else if($data['historySearch']=='dateRnage'){
                            
                            $yrdata = strtotime($data['dateToUpdate']);
                            $updata['Start_date'] = date('M Y', $yrdata);
                            
                            
                            $datefrom = date("Y-m-d", strtotime($data['datefrom']));
                            $dateto = date("Y-m-d", strtotime($data['dateto']));
                            //$select1->where('t1.Created_at between '.$datefrom.' and '.$dateto.'');
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') >= ?",  $datefrom);
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') <= ?",  $dateto);                           
                            
                        }                       
                        
                    }
                    
                    //->where('t1.PM_WO_Number  = ?', $pmwonumber)
                    $select1->group(array('t1.PM_WO_Number'))
                    ->group(array('t1.BuildingID'))
                    ->group(array('t3.View_order'))
                    ->group(array('t3.Reading_Instruction'))
                    ->group(array('t3.AU_Template_Reading_ID'))
                    ->group(array('t4.Name'))
                    ->group(array('t1.Parent_ID'))
                    ->group(array('t1.Reading_Task'));


            $select2 = $db->select()->from(array('t8' => 'pm_au_history'), array('PM_History_ID' => 't8.PM_History_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID','PM_Actual_JobTime'=>'t8.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t8.PM_WO_Complete_Date','PM_Note_Comments'=>'t8.PM_Note_Comments','PM_CompletedBy_UID'=>'t8.PM_CompletedBy_UID','Created_at'=>'t8.Created_at','his_reading_value'=>'t8.Reading_Value','AU_Equipment_Detail_ID'=>'t8.AU_Equipment_Detail_ID'))
                   ->joinLeft(array('t7' => 'pm_au_template_reading'), 't7.AU_Template_Reading_ID = t8.Parent_ID ', array('Sort_Order' => 't7.View_order', 'Reading_Instruction' => 't7.Reading_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Reading_ID' => 't7.AU_Template_Reading_ID', 'Parent_ID' => 't7.Parent_ID','Reading_Value'=>'t7.Reading_Value'))
                    ->joinLeft(array('t9' => 'pm_au_equipment_readings'), 't9.AU_Equipment_Readings_ID = t8.AU_Equipment_Task_Reading_ID',array(''))
                    
                    ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))
                    ->joinLeft(array('t5' => 'pm_au_unitofmeasure'), 't5.AU_uom_ID = t7.AU_uom_ID', array('Unit_of_Measure' => 't5.Name'))
                    ->where('t8.Reading_Task  = ?', $readingTask)
                    ->where('t8.BuildingID  = ?', $building_id);
                    
                    if(!empty($data)){
                        if($data['historySearch']=='All'){                            
                            $select2->where('t8.AU_Equipment_Detail_ID  = ?', $data['unit']);
                        } else if($data['historySearch']=='woNumber'){
                            $select2->where('t8.PM_WO_Number between '.$data['wonumberfrom'].' and '.$data['wonumberto'].'');
                                                        
                        } else if($data['historySearch']=='dateRnage'){                           
                            $datefrom = date("Y-m-d", strtotime($data['datefrom']));
                            $dateto = date("Y-m-d", strtotime($data['dateto']));
                            //$select2->where('t8.Created_at between '.$datefrom.' and '.$dateto.''); 
                            $select2->where("DATE_FORMAT(DATE(t8.Created_at), '%Y-%m-%d') >= ?",  $datefrom);
                            $select2->where("DATE_FORMAT(DATE(t8.Created_at), '%Y-%m-%d') <= ?",  $dateto);
                        }
                        
                        
                    }
                    
                    //->where('t8.PM_WO_Number  = ?', $pmwonumber)
                    $select2->where('t8.Parent_ID  > 0')
                    ->group(array('t8.PM_WO_Number'))
                    ->group(array('t8.BuildingID'))
                    ->group(array('t7.View_order'))
                    ->group(array('t7.Reading_Instruction'))
                    ->group(array('t7.Task_jobtime'))
                    ->group(array('t7.AU_Template_Reading_ID'))
                    ->group(array('t6.Name'))
                    ->group(array('t8.Parent_ID'))
                    ->group(array('t8.Reading_Task'));
                    //->order('Sort_Order');

            $select = $db->select()->union(array($select1, $select2));
            //->order('title');
            //echo $select; //die('Emad');                    
            $res = $db->fetchAll($select);
            foreach ($res as $data) {
                $datas[] = (array) $data;
            }
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function getEquipmentDetailForHistory($buildingId, $data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t2' => 'pm_au_equipment_detail'), array('AU_Equipment_Detail_ID' => 't2.AU_Equipment_Detail_ID', 'Floor' => 't2.Equipment_Floor', 'Unit' => 't2.Equipment_Unit', 'MakeModel' => 't2.Equipment_Make_Model', 'Location' => 't2.Equipment_Location', 'Notes' => 't2.Equipment_Notes','Equipment_Manual'=>'t2.Equipment_Manual'))
                ->where('t2.BuildingID  = ?', $buildingId)
                ->where('t2.AU_Equipment_Name_ID = ?', $data['eqname']);
        if(!empty($data['floor'])){
            $select->where('t2.Equipment_Floor = ?', $data['floor']);
            
        } else {
        $select->group(array('t2.Equipment_Floor'));
        }

        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }
    
    public function getWoByequipment($buildingId, $data) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_history'), array('PM_History_ID' => 't1.PM_History_ID', 'PM_WO_Number' => 't1.PM_WO_Number'))
                ->where('t1.BuildingID  = ?', $buildingId)
                ->where('t1.AU_Equipment_Detail_ID = ?', $data['equipmentDetailId'])
                ->group(array('t1.PM_WO_Number'));        
        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }
    
    public function getPmWOHistoryEquipmentDetail($buildingId, $data) {
                
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_equipment_name'), array('AU_Equipment_Name_ID' => 't1.AU_Equipment_Name_ID', 'AU_Equipment_Name' => 't1.AU_Equipment_Name'))
                ->JoinLeft(array('t2'=>'pm_au_equipment_detail'),'t1.AU_Equipment_Name_ID = t2.AU_Equipment_Name_ID', array('Equipment_Floor'=>'t2.Equipment_Floor','Equipment_Unit'=>'t2.Equipment_Unit','Equipment_Location'=>'t2.Equipment_Location','AU_Equipment_Detail_ID'=>'t2.AU_Equipment_Detail_ID','AU_Template_Designation_ID'=>'t2.AU_Template_Designation_ID'))
                ->where('t1.BuildingID  = ?', $buildingId)
                ->where('t1.AU_Equipment_Name_ID = ?', $data['equipmentname'])
                ->where('t2.Equipment_Floor = ?', $data['floor'])
                ->where('t2.AU_Equipment_Detail_ID = ?', $data['unit'])
                ->group(array('t1.AU_Equipment_Name'))
                ->order(array('t1.AU_Equipment_Name'));
        
        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }
    
    public function getTaskReading($buildingId) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_history'), array('Reading_Task' => 't1.Reading_Task'))
                ->where('t1.BuildingID  = ?', $buildingId)
                ->group(array('t1.Reading_Task'))
                ->order(array('t1.Reading_Task Desc'));        
        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;
    }
    
    public function getPmWoNotes($buildingId,$sortingData=""){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_history_notes'), array('PM_WO_DateStamp'=>'t1.PM_WO_DateStamp','PM_WO_Number'=>'t1.PM_WO_Number','PM_WO_Notes' => 't1.PM_WO_Notes','PM_WO_Notes_ID'=>'t1.PM_WO_Notes_ID'))
                ->where('t1.Building_ID  = ?', $buildingId);
                //->where('t1.AU_Equipment_Detail_ID  = ?', $equipId)
                //->where('t1.AU_Template_Designation_ID  = ?', $tempId)
                //->where('t1.PM_WO_Number  = ?', $woNumber);
                //->order(array('t1.PM_WO_DateStamp Desc'));
        
        if (!empty($sortingData)) {
            if ($sortingData['id'] == '0') {
                $select->order(array('t1.PM_WO_DateStamp DESC'));
            } else if ($sortingData['id'] == '1') {
                $select->order(array('t1.PM_WO_DateStamp'));
            } 
        } else {
            $select->order(array('t1.PM_WO_DateStamp DESC'));
        }
        
        
        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;        
    } 
    
    public function getPmWoPhotos($equipId, $tempId, $woNumber){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t1' => 'pm_au_history_photos'), array('PM_WO_Photo' => 't1.PM_WO_Photo','PM_WO_Photo_ID'=>'t1.PM_WO_Photo_ID'))
                ->where('t1.AU_Equipment_Detail_ID  = ?', $equipId)
                ->where('t1.AU_Template_Designation_ID  = ?', $tempId)
                ->where('t1.PM_WO_Number  = ?', $woNumber);                    
        $res = $db->fetchAll($select);
        foreach ($res as $data) {
            $datas[] = (array) $data;
        }
        return $datas;        
    }
    
    //** This is sorting reading data by work oreder
    public function sortPmWorkorderHistoryReadingDetailByWO($building_id,$readingTask, $data = "") {
       
        $db = Zend_Db_Table::getDefaultAdapter();
        //$select = $db->select();
        try {
            $select1 = $db->select()->from(array('t1' => 'pm_au_history'), array('PM_History_ID' => 't1.PM_History_ID', 'BuildingID' => 't1.BuildingID', 'PM_WO_Number' => 't1.PM_WO_Number', 'PM_WO_StartDate' => 't1.PM_WO_StartDate', 'Reading_Task' => 't1.Reading_Task', 'WO_Parent_ID' => 't1.Parent_ID','PM_Actual_JobTime'=>'t1.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t1.PM_WO_Complete_Date','PM_Note_Comments'=>'t1.PM_Note_Comments','PM_CompletedBy_UID'=>'t1.PM_CompletedBy_UID','Created_at'=>'t1.Created_at','his_reading_value'=>'t1.Reading_Value'))
                    ->joinLeft(array('t2' => 'pm_au_equipment_readings'), 't2.AU_Equipment_Readings_ID = t1.AU_Equipment_Task_Reading_ID', array(''))
                    ->joinLeft(array('t3' => 'pm_au_template_reading'), 't3.AU_Template_Reading_ID = t2.AU_Template_Reading_ID', array('Sort_Order' => 't3.View_order', 'Reading_Instruction' => 't3.Reading_Instruction', 'JobTime' => 't3.Task_jobtime', 'AU_Template_Reading_ID' => 't3.AU_Template_Reading_ID', 'Parent_ID' => 't3.Parent_ID','Reading_Value'=>'t3.Reading_Value'))
                    ->joinLeft(array('t4' => 'pm_au_frequency'), 't4.AU_Frequency_ID = t3.AU_Frequency_ID ', array('Frequency' => 't4.Name'))
                    ->joinLeft(array('t5' => 'pm_au_unitofmeasure'), 't5.AU_uom_ID = t3.AU_uom_ID', array('Unit_of_Measure' => 't5.Name'))
                    ->where('t1.Reading_Task  = ?', $readingTask)
                    ->where('t1.BuildingID  = ?', $building_id);
                    //->where('t1.PM_WO_Number  = ?', $pmwonumber)
                    if(!empty($data)){
                        if($data['historySearch']=='All'){ 
                            $select1->where('t1.AU_Equipment_Detail_ID  = ?', $data['unit']);
                        } else if($data['historySearch']=='woNumber'){
                            $select1->where('t1.PM_WO_Number between '.$data['wonumberfrom'].' and '.$data['wonumberto'].'');
                                                        
                        } else if($data['historySearch']=='dateRnage'){
                            
                            $yrdata = strtotime($data['dateToUpdate']);
                            $updata['Start_date'] = date('M Y', $yrdata);
                            
                            
                            $datefrom = date("Y-m-d", strtotime($data['datefrom']));
                            $dateto = date("Y-m-d", strtotime($data['dateto']));
                            //$select1->where('t1.Created_at between '.$datefrom.' and '.$dateto.'');
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') >= ?",  $datefrom);
                            $select1->where("DATE_FORMAT(DATE(t1.Created_at), '%Y-%m-%d') <= ?",  $dateto);                           
                            
                        }                       
                        
                    }
            
                    $select1->group(array('t1.PM_WO_Number'))
                    ->group(array('t1.BuildingID'))
                    ->group(array('t3.View_order'))
                    ->group(array('t3.Reading_Instruction'))
                    ->group(array('t3.AU_Template_Reading_ID'))
                    ->group(array('t4.Name'))
                    ->group(array('t1.Parent_ID'))
                    ->group(array('t1.Reading_Task'));


            $select2 = $db->select()->from(array('t8' => 'pm_au_history'), array('PM_History_ID' => 't8.PM_History_ID', 'BuildingID' => 't8.BuildingID', 'PM_WO_Number' => 't8.PM_WO_Number', 'PM_WO_StartDate' => 't8.PM_WO_StartDate', 'Reading_Task' => 't8.Reading_Task', 'WO_Parent_ID' => 't8.Parent_ID','PM_Actual_JobTime'=>'t8.PM_Actual_JobTime','PM_WO_Complete_Date'=>'t8.PM_WO_Complete_Date','PM_Note_Comments'=>'t8.PM_Note_Comments','PM_CompletedBy_UID'=>'t8.PM_CompletedBy_UID','Created_at'=>'t8.Created_at','his_reading_value'=>'t8.Reading_Value'))
                   ->joinLeft(array('t7' => 'pm_au_template_reading'), 't7.AU_Template_Reading_ID = t8.Parent_ID ', array('Sort_Order' => 't7.View_order', 'Reading_Instruction' => 't7.Reading_Instruction', 'JobTime' => 't7.Task_jobtime', 'AU_Template_Reading_ID' => 't7.AU_Template_Reading_ID', 'Parent_ID' => 't7.Parent_ID','Reading_Value'=>'t7.Reading_Value'))
                    ->joinLeft(array('t9' => 'pm_au_equipment_readings'), 't9.AU_Equipment_Readings_ID = t8.AU_Equipment_Task_Reading_ID',array(''))
                    
                    ->joinLeft(array('t6' => 'pm_au_frequency'), 't6.AU_Frequency_ID = t7.AU_Frequency_ID ', array('Frequency' => 't6.Name'))
                    ->joinLeft(array('t5' => 'pm_au_unitofmeasure'), 't5.AU_uom_ID = t7.AU_uom_ID', array('Unit_of_Measure' => 't5.Name'))
                    ->where('t8.Reading_Task  = ?', $readingTask)
                    ->where('t8.BuildingID  = ?', $building_id);                                                          
                    //->where('t8.PM_WO_Number  = ?', $pmwonumber)
                    if(!empty($data)){
                        if($data['historySearch']=='All'){
                            $select2->where('t8.AU_Equipment_Detail_ID  = ?', $data['unit']);
                        } else if($data['historySearch']=='woNumber'){
                            $select2->where('t8.PM_WO_Number between '.$data['wonumberfrom'].' and '.$data['wonumberto'].'');
                                                        
                        } else if($data['historySearch']=='dateRnage'){                           
                            $datefrom = date("Y-m-d", strtotime($data['datefrom']));
                            $dateto = date("Y-m-d", strtotime($data['dateto']));
                            //$select2->where('t8.Created_at between '.$datefrom.' and '.$dateto.''); 
                            $select2->where("DATE_FORMAT(DATE(t8.Created_at), '%Y-%m-%d') >= ?",  $datefrom);
                            $select2->where("DATE_FORMAT(DATE(t8.Created_at), '%Y-%m-%d') <= ?",  $dateto);
                        }
                    }
            
                    $select2->where('t8.Parent_ID  > 0')
                    ->group(array('t8.PM_WO_Number'))
                    ->group(array('t8.BuildingID'))
                    ->group(array('t7.View_order'))
                    ->group(array('t7.Reading_Instruction'))
                    ->group(array('t7.Task_jobtime'))
                    ->group(array('t7.AU_Template_Reading_ID'))
                    ->group(array('t6.Name'))
                    ->group(array('t8.Parent_ID'))
                    ->group(array('t8.Reading_Task'));
                    //->order('Sort_Order');
                            if(!empty($data)){
                        if($data['id']==1){
                           $select2 ->order(array('PM_WO_Number DESC'));
                            
                        } else if($data['id']==0){
                            $select2 ->order(array('PM_WO_Number ASC'));
                        }
                        
                    }

            $select = $db->select()->union(array($select1, $select2));
            //->order('title');
            //echo $select; //die('Emad');                    
            $res = $db->fetchAll($select);
            foreach ($res as $data) {
                $datas[] = (array) $data;
            }
            return $datas;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function getTemplateDetailForHistory($data) {
		$db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select();
        $select->from(array('t2' => 'pm_au_equipment_detail'), array('AU_Template_Name_IDD' => 't2.AU_Template_Name_ID', 'AU_Template_desi_IDD' =>'t2.AU_Template_Designation_ID'))
                 ->joinLeft(array('putn' => 'pm_au_template_name'), 'putn.AU_Template_Name_ID = t2.AU_Template_Name_ID', array('AU_Template_Name' => 'putn.AU_Template_Name'))
				 ->joinInner(array('putt' => 'pm_au_template_typedesignation'), 'putt.AU_Template_Name_ID = putn.AU_Template_Name_ID', array('AU_TypeDesignation' => 'putt.AU_TypeDesignation','AU_TypeDescritpion' => 'putt.AU_TypeDescritpion'));
        if(!empty($data['eqid'])){
            $select->where('t2.AU_Equipment_Name_ID = ?', $data['eqid']);
            
        } 
		//echo $select;die;
        $res = $db->fetchAll($select);
       return $res;
    }
    
    
}
