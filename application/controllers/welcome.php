<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/CUREST_Controller.php';

class Welcome extends CUREST_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index_get()
	{
        $db = $this->load->database('default', TRUE);
        $sql = 'SHOW DATABASES';
        $query = $db->query($sql, array());
        $db->close();
        
        $res = $query->result_array();
        
        $data = array(
            'database_list' => $res
        );
        
		$this->load->helper('url');
		$this->load->view('welcome_message', $data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */