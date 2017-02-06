<?php
class Guest extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('guest_model');

		//DEbug
		//$this->output->enable_profiler(TRUE);
	}

	public function index ()
	{
		 // Count all guest
   // $this->guest_model->set_published();
    $count = $this->db->count_all_results('guest');
    
    // Set up pagination
    $perpage = 4;
    if ($count > $perpage) {
      $this->load->library('pagination');
      $config['base_url'] = site_url($this->uri->segment(1) . '/');
      $config['total_rows'] = $count;
      $config['per_page'] = $perpage;
      $config['uri_segment'] = 2;
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $offset = $this->uri->segment(2);
    }
    else {
      $this->data['pagination'] = '';
      $offset = 0;
    }
    
    // Fetch articles
   // $this->guest_model->set_published();
    $this->db->limit($perpage, $offset);
    $this->data['guest'] = $this->guest_model->get();
    $this->data['guest_count'] = $count;
		
		// Load view
		$this->data['subview'] = 'admin/guest/guest';
		$this->display_view->admin_view('_admin_layout_show', $this->data);
	}


	public function answer ($id = NULL)
	{
		// Fetch a news or set a new one
		if ($id) {
			$this->data['guest'] = $this->guest_model->get($id);
			count($this->data['guest']) || $this->data['errors'][] = 'news could not be found';
		}
		else {
			$this->data['guest'] = $this->guest_model->get_new();
		}
		
	if($_POST['save'])
	{

			$data = $this->guest_model->array_from_post(array(
			'name', 
            'email', 
            'text',
            'parent_id'
			));
			
			$this->guest_model->save($data, $id);
			redirect('admin/guest');
	}
			

			//dump($data);
		
		
		// Load the view
		$this->data['subview'] = 'admin/guest/answer';
		$this->display_view->admin_view('_admin_layout_show', $this->data);
	}

	public function delete ($id)
	{
		$this->guest_model->delete($id);
		redirect('admin/guest');
	}



}