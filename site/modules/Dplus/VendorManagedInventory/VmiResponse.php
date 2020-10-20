<?php namespace ProcessWire;

use VmiOrderQuery, VmiOrder;

/**
 * VmiResponse
 * Handles Response Data for Itm functions
 *
 * @author Paul Gomez
 *
 * @property bool      $success            Did the function Succeed?
 * @property bool      $error              Was there an error?
 * @property bool      $message            Error Message / Success Message
 * @property VmiOrder  $order              VmiOrder
 *
 */
class VmiResponse extends WireData {

	const CRUD_CREATE = 1;
	const CRUD_UPDATE = 2;
	const CRUD_DELETE = 3;

	public function __construct() {
		$this->success = false;
		$this->error = false;
		$this->message = '';
		$this->order = null;
		$this->fields = array();
	}

	public function set_action(int $action = 0) {
		$this->action = $action;
	}

	public function has_success() {
		return boolval($this->success);
	}

	public function has_error() {
		return boolval($this->error);
	}

	public function set_success(bool $success) {
		$this->success = $success;
	}

	public function set_error(bool $error) {
		$this->error = $error;
	}

	public function set_message($message) {
		$this->message = $message;
	}

	public function set_order(VmiOrder $order) {
		$this->order = $order;
	}

	public function set_fields(array $fields) {
		$this->fields = $fields;
	}

	public function has_field($field) {
		return array_key_exists($field, $this->fields);
	}

	public static function response_error(VmiOrder $order, $message) {
		$response = new VmiResponse();
		$response->order = $order;
		$response->message = $message;
		$response->set_error(true);
		$response->set_success(false);
		return $response;
	}

	public static function response_success(VmiOrder $order, $message) {
		$response = new VmiResponse();
		$response->order = $order;
		$response->message = $message;
		$response->set_error(false);
		$response->set_success(true);
		return $response;
	}
}
