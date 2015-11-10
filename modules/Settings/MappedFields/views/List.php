<?php

/**
 * List View Class for MappedFields Settings
 * @package YetiForce.View
 * @license licenses/License.html
 * @author Radosław Skrzypczak <r.skrzypczak@yetiforce.com>
 */
class Settings_MappedFields_List_View extends Settings_Vtiger_List_View
{

	public function preProcess(Vtiger_Request $request, $display = true)
	{
		$viewer = $this->getViewer($request);
		$viewer->assign('SUPPORTED_MODULE_MODELS', Settings_Vtiger_CustomRecordNumberingModule_Model::getSupportedModules());
		parent::preProcess($request, $display);
	}
}
