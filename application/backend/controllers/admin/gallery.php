<?php
class Gallery extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('gallery_model');


		//DEbug
		//$this->output->enable_profiler(TRUE);
	}

	public function index ()
	{	

		if(isset($_POST['save']))
		{
			$rules = $this->gallery_model->rules;
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == TRUE) {

			//$data['imd'] = $this->images_upload();

			$data = $this->gallery_model->array_from_post(array(
				'title', 
				'img'
			));
			
			$this->gallery_model->save($data);
			//redirect('admin/gallery');
			//dump($data);
		}
		}
		// Fetch all articles
		$this->data['gallery'] = $this->gallery_model->get();
		
		// Load view
		$this->data['subview'] = 'admin/gallery/gallery_form';
		$this->display_view->admin_view('_admin_layout_show', $this->data);
	}

	

	public function delete ($id)
	{
		$this->gallery_model->delete($id);
		redirect('admin/gallery');
	}


	public function images_upload()
	{
		
			$config['upload_path'] = './images/news';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);
			
			if(!$this->upload->do_upload()){
				 $this->data['errors'] = $this->upload->display_errors();
			}
		
	}

}