<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guest_Model extends MY_Model
{   
    protected $_table_name = 'guest';
    protected $_primary_key = 'id_guest';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id_guest DESC';
    public $rules = array(
        'parent_id' => array(
            'field' => 'parent_id', 
            'label' => 'Parent', 
            'rules' => 'trim|intval'
        ),
        'name' => array(
            'field' => 'name', 
            'label' => 'Имя',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ), 
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xxs_clean'
        ),
        'text' => array(
            'field' => 'text', 
            'label' => 'Текст станицы', 
            'rules' => 'trim|required'
        ),
        'captcha' => array(
            'field' => 'captcha',
            'label' => 'Введите код',
            'rules' => 'trim|required'
        ),
    );


    public function get_new ()
    {
        $page = new stdClass();
        $page->name = '';
        $page->email = '';
        $page->text = '';
        $page->parent_id = 0;
        return $page;
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
        $pages = $this->db->get('guest')->result_array();
        
        $array = array();
        foreach ($pages as $page) {
            if (! $page['parent_id']) {
                // This page has no parent
                $array[$page['id_guest']] = $page;
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