<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller{

	public function __construct()
	{
		parent::__construct();

		//DEbug
		$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		
		$view = '_admin_layout_show';
		$this->data['subview'] = 'admin/dashboard/dashboard';
		$this->display_view->admin_view($view, $this->data);

	}
	

	
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */