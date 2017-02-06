<?php 

/**
* DISPLAY VIEW
*/
class Display_view
{	

	private $_tpl = 'default'; //папка с видами по умолчанию
	private $_inc = '/inc'; // Папка статичных станиц

	
	public function view_page($view, $data)
	{
		$CI =& get_instance();

		
		$CI->load->view($this->_tpl.$this->_inc.'/doctype', $data);
		$CI->load->view($this->_tpl.$this->_inc.'/header');
		$CI->load->view($this->_tpl.$this->_inc.'/menu');
		$CI->load->view($this->_tpl.$this->_inc.'/slider', $data);
		$CI->load->view($this->_tpl.$this->_inc.'/left');
		$CI->load->view($this->_tpl.'/'.$view, $data);
		$CI->load->view($this->_tpl.$this->_inc.'/footer');
		
	}

	public function admin_login($view, $data)
	{
		$CI =& get_instance();

 	$CI->load->view('admin/'.$view, $data);
   
	}

	public function admin_view($view, $data)
	{
		$CI =& get_instance();

 	$CI->load->view('admin/'.$view, $data);
  
	}
	
	
}

 ?>