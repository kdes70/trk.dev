<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_Model extends MY_Model
{   
    protected $_table_name = 'pages';
    protected $_primary_key = 'id_page';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'parent_id, order';
    public $rules = array(
        'parent_id' => array(
            'field' => 'parent_id', 
            'label' => 'Parent', 
            'rules' => 'trim|intval'
        ),
        'template' => array(
            'field' => 'template', 
            'label' => 'Template', 
            'rules' => 'trim|required|xss_clean'
        ), 
        'block' => array(
            'field' => 'block', 
            'label' => 'Положение', 
            'rules' => 'trim|required|xss_clean'
        ), 
        'name' => array(
            'field' => 'name', 
            'label' => 'Название станицы', 
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ), 
        'url_page' => array(
            'field' => 'url_page', 
            'label' => 'URL станицы', 
            'rules' => 'trim|max_length[100]|xss_clean'
        ), 
        'text' => array(
            'field' => 'text', 
            'label' => 'Текст станицы', 
            'rules' => 'trim'
        )
    );

    public function get_archive_link(){
        $page = parent::get_by(array('template' => 'news_archive'), TRUE);
        return isset($page->url_page) ? $page->url_page : '';
    }
    
    public function get_page($url)
    {
        return $this->get_by(array('url_page' => $url, 'public' => '1'), TRUE);
    }

    public function get_new ()
    {
        $page = new stdClass();
        $page->name = '';
        $page->url_page = '';
        $page->text = '';
        $page->block = 'none';
        $page->template = 'page';
        $page->parent_id = 0;
        return $page;
    }

    public function save_order ($pages)
    {
        if (count($pages)) {
            foreach ($pages as $order => $page) {
                if ($page['item_id'] != '') {
                    $data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
                }
            }
        }
    }
/**
 * Получаем сортированый массив страниц
 * @return [type] [description]
 */
    public function get_nested ($where = NULL)
    {   
        if($where != NULL)
        {
            $this->db->where($where);
        }
        $this->db->order_by($this->_order_by);
        $pages = $this->db->get('pages')->result_array();
        
        $array = array();
        foreach ($pages as $page) {
            if (! $page['parent_id']) {
                // This page has no parent
                $array[$page['id_page']] = $page;
            }
            else {
                // This is a child page
                $array[$page['parent_id']]['children'][] = $page;
            }
        }
        return $array;
    }

    public function get_with_parent ($id = NULL, $single = FALSE)
    {
        $this->db->select('pages.*, p.url_page as parent_slug, p.name as parent_name');
        $this->db->join('pages as p', 'pages.parent_id=p.id_page', 'left');
        return parent::get($id, $single);
    }

    public function get_no_parents ()
    {
        // Fetch pages without parents
        $this->db->select('id_page, name');
        $this->db->where('parent_id', 0);
        $pages = parent::get();
        
        // Return key => value pair array
        $array = array(
            0 => 'No parent'
        );
        if (count($pages)) {
            foreach ($pages as $page) {
                $array[$page->id_page] = $page->name;
            }
        }
        
        return $array;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
        
        // Reset parent ID for its children
        $this->db->set(array(
            'parent_id' => 0
        ))->where('parent_id', $id)->update($this->_table_name);
    }




}