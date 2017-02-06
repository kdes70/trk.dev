<?php
class News extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('news_model');

		//DEbug
		//$this->output->enable_profiler(TRUE);
	}

	public function index ()
	{
		// Fetch all articles
		$this->data['news_list'] = $this->news_model->get();
		
		// Load view
		$this->data['subview'] = 'admin/news/news';
		$this->display_view->admin_view('_admin_layout_show', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a news or set a new one
		if ($id) {
			$this->data['news'] = $this->news_model->get($id);
			count($this->data['news']) || $this->data['errors'][] = 'news could not be found';
		}
		else {
			$this->data['news'] = $this->news_model->get_new();
		}
		
		// Set up the form
		$rules = $this->news_model->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {

			//$data['imd'] = $this->images_upload();

			$data = $this->news_model->array_from_post(array(
				'title', 
				'slug', 
				'text', 
				'pubdate',
				'img'
			), $duble = 'title');
			
			$this->news_model->save($data, $id);
			redirect('admin/news');
			//dump($data);
		}
		
		// Load the view
		$this->data['subview'] = 'admin/news/news_edit';
		$this->display_view->admin_view('_admin_layout_show', $this->data);
	}

	public function test()
	{
		$s = "Кривошеин Дима";
		echo $this->news_model->tr($s);
	}

	public function delete ($id)
	{
		$this->news_model->delete($id);
		redirect('admin/news');
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