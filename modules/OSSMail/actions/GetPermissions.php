<?php
/* +***********************************************************************************************************************************
 * The contents of this file are subject to the YetiForce Public License Version 1.1 (the "License"); you may not use this file except
 * in compliance with the License.
 * Software distributed under the License is distributed on an "AS IS" basis, WITHOUT WARRANTY OF ANY KIND, either express or implied.
 * See the License for the specific language governing rights and limitations under the License.
 * The Original Code is YetiForce.
 * The Initial Developer of the Original Code is YetiForce. Portions created by YetiForce are Copyright (C) www.yetiforce.com. 
 * All Rights Reserved.
 * *********************************************************************************************************************************** */

class OSSMail_GetPermissions_Action extends Vtiger_Action_Controller
{

	public function checkPermission(Vtiger_Request $request)
	{
		$moduleName = $request->getModule();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		if (!$currentUserPriviligesModel->hasModulePermission($moduleModel->getId())) {
			throw new NoPermittedException('LBL_PERMISSION_DENIED');
		}
	}

	public function process(Vtiger_Request $request)
	{
		$moduleName = $request->getModule();
		$View = $request->get('View');
		if (!$View) {
			$View = 'EditView';
		}
		$Permissions = array();
		$modules = array('Leads', 'Accounts', 'Contacts', 'Calendar', 'Products', 'HelpDesk', 'Campaigns', 'Project', 'Services', 'ModComments');
		foreach ($modules as $module) {
			$Permitted = Users_Privileges_Model::isPermitted($module, $View);
			$Permissions[$module] = $Permitted;
		}
		$response = new Vtiger_Response();
		$response->setResult($Permissions);
		$response->emit();
	}
}
