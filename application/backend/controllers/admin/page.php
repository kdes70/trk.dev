<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends Admin_Controller{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('page_model');

		//DEbug
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		
		
        $this->data['pages'] = $this->page_model->get_with_parent();


		$view = '_admin_layout_show';
		$this->data['subview'] = 'admin/page/pages';
		$this->display_view->admin_view($view, $this->data);

	}

	public function edit($id = NULL)
	{
		// Fetch a page or set a new one
		if ($id) {
			$this->data['page'] = $this->page_model->get($id);
			count($this->data['page']) || $this->data['errors'][] = 'page could not be found';
		}
		else {
			$this->data['page'] = $this->page_model->get_new();
		}
		
		// Pages for dropdown
		$this->data['pages_no_parents'] = $this->page_model->get_no_parents();
		
		// Set up the form
		$rules = $this->page_model->rules;
		$this->form_validation->set_rules($rules);
		
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {

			if(empty($_POST['url_page'])){

				$data = $this->page_model->array_from_post_page(array(
				'name', 
				'url_page', 
				'text', 
				'block',
				'template',
				'parent_id' 
				
			), $duble = 'name');
			}
			else{
				$data = $this->page_model->array_from_post(array(
				'name', 
				'url_page', 
				'text', 
				'block',
				'template',
				'parent_id' 
				
			));
			}
			
			$this->page_model->save($data, $id);
			redirect('admin/page');
		}
		
		// Load the view
		$view = '_admin_layout_show';
		$this->data['subview'] = 'admin/page/page_edit';
		$this->display_view->admin_view($view, $this->data);

	}

	public function order()
	{
		$this->data['sortable'] = TRUE;
		$view = '_admin_layout_show';
		$this->data['subview'] = 'admin/page/order';
		$this->display_view->admin_view($view, $this->data);
	}

	public function order_ajax ()
	{
		// Save order from ajax call
		if (isset($_POST['sortable'])) {
			$this->page_model->save_order($_POST['sortable']);
		}
		
		// Fetch all pages
		$this->data['pages'] = $this->page_model->get_nested();
		
		// Load view
		$this->load->view('admin/page/order_ajax', $this->data);
	}


	public function delete ($id)
	{
		$this->page_model->delete($id);
		redirect('admin/page');
	}

	// доделать
	public function translit($str)
	{	

		$res = translits($str);

		return json_decode($res);
		
	}

	public function _unique_url_page($str)
	{
		// Do NOT validate if slug already exists
		// UNLESS it's the slug for the current page
		

		$id = $this->uri->segment(4);
		$this->db->where('url_page', $this->input->post('url_page'));
		! $id || $this->db->where('id_page !=', $id);
		$page = $this->page_model->get();
		
		if (count($page)) {
			$this->form_validation->set_message('_unique_url_page', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */