<?php
/**
 * Description of Work Order Note
 *
 * @author brijesh
 */
class Model_WoNote extends Zend_Db_Table_Abstract {

   protected $_name = 'wo_note';   
   protected $_tab_role = 'wo_note'; 
   public $_errorMessage='';
   
   /* Get all Work Order Note list */
    public function getWoNote($wnId = "") {       
        
        $select = $this->select();
        if(!empty($wnId)){
            $select = $select->where( 'wnId = ? ', $wnId );
        }  
        $res = $this->fetchAll( $select );
        
        return ($res && sizeof($res)>0)? $res->toArray() : false ;

    } 
    
         /* Save Work Order Note */
    public function insertWoNote($data) {
        try{	
            return $this->insert($data);		
        } catch(Exception $e)	{	
            echo $e->getMessage();die;
        }
    }
    
    /* Update Work Order Note */
    public function updateWoNote($data, $wnId) {        
        $this->_errorMessage="";
        $where = $this->getAdapter()->quoteInto('wnId = ?', $wnId);	
        unset($data['wnId']);
        try {
            $this->update($data,$where);
            return true;
        }catch(Exception $e){    		
            echo $e->getMessage(); die();
        }	
    }
    
    public function getWoNoteByWoId($woId){
		$db = Zend_Db_Table::getDefaultAdapter();
		if(!empty($woId)){
		    $select = $db->select()  
			->from(array('wn' => 'wo_note'))		
			->joinLeft(array('u'=>'users'),'u.uid = wn.user_id',array('firstName', 'lastName'))			
			 ->where( 'woId = ? ', $woId );  
            $res = $db->fetchAll( $select );    
			$res = json_encode($res);
			$res = json_decode($res, true);
            return ($res && sizeof($res)>0)? $res : false ;
        }else
        return false;
	}
    
    public function getWoNoteByWoIdInternalNo($woId){
		$db = Zend_Db_Table::getDefaultAdapter();
		if(!empty($woId)){
		    $select = $db->select()  
			->from(array('wn' => 'wo_note'))		
			->joinLeft(array('u'=>'users'),'u.uid = wn.user_id',array('firstName', 'lastName'))	            		
			 ->where( 'internal != ? ', 1 ) 		
			 ->where( 'woId = ? ', $woId );  
            $res = $db->fetchAll( $select );    
			$res = json_encode($res);
			$res = json_decode($res, true);
            return ($res && sizeof($res)>0)? $res : false ;
        }else
        return false;
	}
    
    /********delete Work Order Note********/	
	public function deleteWoNote($wnId){
		if(!empty($wnId) && $wnId !=0){
			   try{
				  $this->delete('wnId = '.$wnId);
				  return true;
				}catch(Exception $e){
					return false;
				}
			}
	}
        
   
}
