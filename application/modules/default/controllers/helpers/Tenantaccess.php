<?php
class Zend_Controller_Action_Helper_Tenantaccess extends Zend_Controller_Action_Helper_Abstract{

	public function checkTenantaccess(){

		// allow role 5 and 7 only 
		 $roleId = Zend_Auth::getInstance()->getStorage()->read()->role_id;
         if($roleId == 5 || $roleId==7){
			$userId = Zend_Auth::getInstance()->getStorage()->read()->uid;
			$tenant = new Model_Tenant();
			$tenantuser = $tenant->getTenantByUser($userId);		
			
			$tenantCompanyList = $tenant->getTenantCompanies($userId);
			return $tenantCompanyList;
		
		}
	}

		public function getTenantbuilding(){

			// allow role 5 and 7 only 
			 $roleId = Zend_Auth::getInstance()->getStorage()->read()->role_id;
			 if($roleId == 5 || $roleId==7){
				$userId = Zend_Auth::getInstance()->getStorage()->read()->uid;
								
				$user_build_mod = new Model_UserBuildingModule();
				$buildingMapper1 = new Model_Building();

				$buildinglists = $user_build_mod->getUserBuildingIds($userId);
				if ($buildinglists) {
					$build_ID = $buildinglists[0]['building_id'];
					// $build_id_array = array();
					foreach ($buildinglists as $buildlist){
							$build_id_array[] = $buildlist['building_id'];
					 }
					$companyListing = $buildingMapper1->getBuildingList($build_id_array);
				}
				
				return $companyListing;
			 }
			
		}


}