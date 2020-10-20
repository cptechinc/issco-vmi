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

	if ($values->get) {
		switch ($values->text('get')) {
			case 'customer':
				$custID = $values->text('custID');

				if ($validate->custid($custID)) {
					$customer = CustomerQuery::create()->findOneByCustid($custID);
					$response = array(
						'id'   => $customer->custid,
						'name' => $customer->name
					);
				} else {
					$response = false;
				}
				break;
			case 'shipto':
				$custID = $values->text('custID');
				$shiptoID = $values->text('shiptoID');

				if ($validate->shiptoid($custID, $shiptoID)) {
					$shipto = CustomerShiptoQuery::create()->filterByCustid($custID)->filterByShiptoid($shiptoID)->findOne();
					$response = array(
						'custid'  => $shipto->custid,
						'id'      => $shipto->shiptoid,
						'name'    => $shipto->name,
						'address' => $shipto->address,
						'address2' => $shipto->address2,
						'city'    => $shipto->city,
						'state'   => $shipto->state,
						'zip'     => $shipto->zip
					);
				} else {
					$response = false;
				}
				break;
			case 'item':
				$validate = $modules->get('ValidateItemVmi');
				$custID = $values->text('custID');
				$shiptoID = $values->text('shiptoID');
				$cell = $values->text('cell');
				$itemID = $values->text('itemID');

				if ($validate->cstk($custID, $shiptoID, $cell, $itemID)) {
					$item = ItemMasterItemQuery::create()->filterByItemid($validate->itemID)->findOne();
					$response = array(
						'itemid'       => $item->itemid,
						'description'  => $item->description,
						'description2' => $item->description2,
						'qtypercase'   => $item->qtypercase,
						'custitemid'   => $validate->custitemID
					);
				} else {
					$response = false;
				}
				break;
			case 'order':
				$vmi = $modules->get('VendorManagedInventory');
				$custID = $values->text('custID');
				$shiptoID = $values->text('shiptoID');
				$cell = $values->text('cell');
				$itemID = $values->text('itemID');

				if ($vmi->order_exists($custID, $shiptoID, $cell, $itemID)) {
					$order = $vmi->get_order($custID, $shiptoID, $cell, $itemID);
					$response = array(
						'userid'   => $order->userid,
						'custid'   => $order->custid,
						'shiptoid' => $order->shiptoid,
						'cell'     => $order->cell,
						'cases'    => $order->cases,
						'qty'      => $order->qty
					);
				} else {
					$response = false;
				}
				break;
		}
	}
	$page->body = json_encode($response);
