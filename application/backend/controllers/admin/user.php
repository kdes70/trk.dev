<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  USER ADMIN CONTROLLER
 */

class User extends Admin_Controller{




	public function __construct()
	{
		parent::__construct();

		//DEbug
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$this->data['users'] = $this->user_model->get();

		//Основной слой вида 
		$view = 'admin/_layout_show';
		//Вид формы входа в админ панель
		$this->data['subview'] = 'admin/admin/user/users_row';
		$this->display_lib->dashboard($view, $this->data);

		//echo $this->user_model->is_admin(0);

		//echo $this->user_model->is_admin($this->session->userdata('group'));
	}


	public function edit($id = NULL)
	{
		$id == NULL || $this->data['user'] = $this->user_model->get($id);

		$rules = $this->user_model->rules_admin;
		$id || $rules['password'] .= '|required';
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE)
		{

		}

		// Тут виды для редактирования пользователя
	}

	public function delete($id)
	{
		# code...
	}

	public function profile($id_user)
	{
		$this->data['user_profile'] = $this->user_model->get($id_user);

		//Основной слой вида 
		$view = 'admin/_layout_show';
		//Вид формы входа в админ панель
		$this->data['subview'] = 'admin/admin/user/user_profile';
		$this->display_lib->dashboard($view, $this->data);

	}



/**
 * login user
 * @return [type] [description]
 */
	public function login ()
	{
		// Redirect a user if he's already logged in
		$dashboard = 'admin/dashboard';
		$this->user_model->loggedin() == FALSE || redirect($dashboard);
		
		// Set form
		$rules = $this->user_model->rules;
		$this->form_validation->set_rules($rules);
		//$this->user_model->login();
		// Process form
		if ($this->form_validation->run() == TRUE) {
			// We can login and redirect
			if ($this->user_model->login() == TRUE) {
				redirect($dashboard);
			}
			else {
				$this->session->set_flashdata('error', 'That email/password combination does not exist');
				redirect('admin/user/login', 'refresh');
			}
		}
		
		// Load view
		$this->data['subview'] = 'admin/user/login';
		$view = '_login_layout_show';
		$this->display_view->admin_login($view, $this->data);
	}

/**
 * Метод выхода из админ панели
 * @return [type] [description]
 */
	public function logout()
	{
		$this->user_model->logout();
		redirect('admin/user/login');
	}

	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */