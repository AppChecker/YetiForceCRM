<?php
/**
 * Modal View Class for SQuoteEnquiries
 * @package YetiForce.View
 * @license licenses/License.html
 * @author Radosław Skrzypczak <r.skrzypczak@yetiforce.com>
 */
class SQuoteEnquiries_Modal_View extends Vtiger_BasicModal_View
{

	public function preProcess(Vtiger_Request $request)
	{
		echo '<div class="modal fade" id="sQuoteEnquiriesModal"><div class="modal-dialog"><div class="modal-content">';
	}
	
	function process(Vtiger_Request $request)
	{
		$moduleName = $request->getModule();
		$id = $request->get('record');
		$recordInstance = Vtiger_Record_Model::getInstanceById($id, $moduleName);
		
		$recordModel = Vtiger_DetailView_Model::getInstance($moduleName, $id)->getRecord();
		$recordStrucure = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_DETAIL);
		$structuredValues = $recordStrucure->getStructure();
		
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE_NAME', $moduleName);
		$viewer->assign('RECORD', $recordModel);
		$viewer->assign('RECORD_STRUCTURE', $structuredValues);
		$viewer->assign('RESTRICTS_ITEM', ['LBL_DISCARDED','LBL_ACCEPTED']);
		$this->preProcess($request);
		$viewer->view('Modal.tpl', $moduleName);
		$this->postProcess($request);
	}

}