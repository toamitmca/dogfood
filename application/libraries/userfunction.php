<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class userfunction {
	public function paramiter($parameter = array()) {
		$qtag = null;
		$size = sizeof($parameter);
		if ($size > 0) {
			for ($i = 1; $i <= $size; $i++) {
				$qtag[] = '?';
			}
			return implode(',', $qtag);
		} else {
			return false;
		}
	}
	public function loginvalidation($redirect = NULL) {

		$CI = &get_instance();
		if ($CI->session->userdata('validated') != true) {
			if ($redirect != NULL) {
				redirect($redirect);
			} else {
				redirect('admin');
			}
		}
	}
	public function pageaccess($callcontroller) {
		$CI = &get_instance();
		if (in_array(base_url($callcontroller), $CI->session->userdata('url'))) {

			return true;
		} else {
			redirect('user');
		}
	}

}
