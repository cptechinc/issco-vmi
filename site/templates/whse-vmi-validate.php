<?php
	/**
	 * CXM Validate
	 * This template is made for Validating Data Inputs for the CXM form
	 * NOTE: the response values are formatted to be used by Jquery Validate's remote validation method
	 */
	$rm = strtolower($input->requestMethod());
 	$values = $input->$rm;
	$validate = $modules->get('ValidateVmi');
	$response   = '';
	$returntype = $values->return ? $values->text('return') : 'jqueryvalidate';

	if ($values->validate) {
		switch ($values->text('validate')) {
			case 'custid':
				$custID = $values->text('custID');

				if ($validate->custid($custID)) {
					$response = true;
				} else {
					$response = "$custID was not found in the Customer Master";
				}
				break;
			case 'shiptoid':
				$custID = $values->text('custID');
				$shiptoID = $values->text('shiptoID');

				if ($validate->shiptoid($custID, $shiptoID)) {
					$response = true;
				} else {
					$response = "$custID Ship-to $shiptoID was not found in the Ship-to Master";
				}
				break;
			case 'cell':
				$cell = $values->text('cell');

				if ($validate->cstkcell('', '', $cell)) {
					$response = true;
				} else {
					$response = "Stocking Cell $cell was not found in CSTK";
				}
				break;
			case 'cstkcell':
				$custID = $values->text('custID');
				$shiptoID = $values->text('shiptoID');
				$cell = $values->text('cell');

				if ($validate->cstkcell($custID, $shiptoID, $cell)) {
					$response = true;
				} else {
					$response = "Stocking Cell $cell for $custID $shiptoID was not found in CSTK";
				}
				break;
			case 'itemid':
				$validate = $modules->get('ValidateItem');
				$itemID = $values->text('itemID');

				if ($validate->itm($itemID)) {
					$response = true;
				} else {
					$response = "Item '$itemID' was not found in the Item Master";
				}
				break;
			case 'cstkitem':
				$validate = $modules->get('ValidateItemVmi');
				$custID = $values->text('custID');
				$shiptoID = $values->text('shiptoID');
				$cell = $values->text('cell');
				$itemID = $values->text('itemID');

				if ($validate->cstk($custID, $shiptoID, $cell, $itemID)) {
					$response = true;
				} else {
					$response = "Item '$itemID' in $cell for $custID $shiptoID was not found in CSTK";
				}
				break;
			case 'order-exists':
				$vmi = $modules->get('VendorManagedInventory');
				$custID = $values->text('custID');
				$shiptoID = $values->text('shiptoID');
				$cell = $values->text('cell');
				$itemID = $values->text('itemID');

				if ($vmi->order_exists($custID, $shiptoID, $cell, $itemID)) {
					$response = true;
				} else {
					$response = false;
				}
				break;
			case 'custitemid':
				$validate = $modules->get('ValidateItem');
				$custID = $values->text('custID');
				$itemID = $values->text('itemID');

				if ($validate->cxm($itemID, $custID)) {
					$response = $validate->itemID;
				} else {
					$response = false;
				}
				break;
		}
	}
	$page->body = json_encode($response);
