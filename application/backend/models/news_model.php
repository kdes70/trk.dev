<?php
class News_model extends MY_Model
{
	protected $_table_name = 'news';
	protected $_primary_key = 'id_news';
	protected $_order_by = 'id_news ASC';
	protected $_timestamps = TRUE;
	public $rules = array(
	'pubdate' => array(
		'field' => 'pubdate', 
		'label' => 'Дата публикации', 
		'rules' => 'trim|required|exact_length[10]|xss_clean'
	), 
	'title' => array(
		'field' => 'title', 
		'label' => 'Заголовак', 
		'rules' => 'trim|required|max_length[100]|xss_clean'
	), 
	'slug' => array(
		'field' => 'slug', 
		'label' => 'URI', 
		'rules' => 'trim|max_length[100]|url_title|xss_clean'
	), 
	'text' => array(
		'field' => 'text', 
		'label' => 'Текст', 
		'rules' => 'trim|required'
	)
);

	public function get_new ()
	{
		$news = new stdClass();
		$news->title = '';
		$news->slug = $this->translits($news->title);
		$news->text = '';
		$news->pubdate = date('Y-m-d');
		//$news->template = 'news';
		return $news;
	}

	public function set_published(){
		$this->db->where('pubdate <=', date('Y-m-d'));
	}
	
	public function get_recent($limit = 3){
		
		// Fetch a limited number of recent articles
		$limit = (int) $limit;
		$this->set_published();
		$this->db->limit($limit);
		return parent::get();
	}

	public function translits($value='')
	{
		$this->load->helper('cms_helper');
		return translits($value);

	}

}