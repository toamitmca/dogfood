<?php
class Supper_admin extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function call_procedure($procedure, $parameter = array()) {
		$param         = $this->userfunction->paramiter($parameter);
		$query         = $this->db->query("call $procedure($param)", $parameter);
		$close         = $this->db->close();
		return $result = $query->result();
	}
	public function call_procedureRow($procedure, $parameter = array()) {
		$param         = $this->userfunction->paramiter($parameter);
		$query         = $this->db->query("call $procedure($param)", $parameter);
		$close         = $this->db->close();
		return $result = $query->row();
	}
	public function userdata($array) {
		$recorddata = array(
			'admin_id'  => $array[0]->ad_id,
			'username'  => $array[0]->username,
			'validated' => true);
		$this->session->set_userdata($recorddata);

		main_menu('menuaccess');
	}

}
?>
