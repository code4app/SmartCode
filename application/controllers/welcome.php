<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
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