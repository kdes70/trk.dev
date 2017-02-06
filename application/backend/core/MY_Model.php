<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  CRUD MODEL
 */

class MY_Model extends CI_Model
{
    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;
    
    function __construct() {
        parent::__construct();
    }


    public function array_from_post($fields, $duble = NULL){
        $data = array();
        foreach ($fields as $field) {

            $data[$field] = $this->input->post($field);
            //Устонавливаем значение в транслит
            if(isset($duble))
            {
                $this->load->helper('cms_helper');
                $data['slug'] = translits($this->input->post($duble));
            }
        }
        return $data;
    }

    public function array_from_post_page($fields, $duble = NULL){
        $data = array();
        foreach ($fields as $field) {

            $data[$field] = $this->input->post($field);
            //Устонавливаем значение в транслит
            if(isset($duble))
            {
                $this->load->helper('cms_helper');
                $data['url_page'] = translits($this->input->post($duble));
            }
        }
        return $data;
    }


    /**
     * Метод получения данных из БД
     * @param  [type]  $id
     * @param  boolean $single
     * @return 
     */
    public function get($id = NULL,  $single = FALSE)
    {
        if($id != NULL)
        {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        }
        elseif ($single == TRUE)
        {
            $method = 'row';
        }
        else{
            $method = 'result';
        }
        if(!count($this->db->ar_orderby))
        {
            $this->db->order_by($this->_order_by);
        }
        return $this->db->get($this->_table_name)->$method();
    }

    /**
     * [get_by description]
     * @param  [type]  $where
     * @param  boolean $single
     * @return [type]
     */
    public function get_by($where, $single = FALSE)
    {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    /**
     * [save description]
     * @param  [type] $data [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    public function save($data, $id = NULL) {

        // Set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }

        // Insert
        if ($id === NULL) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        // Update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }

        return $id;
    }
/**
 * Метод удаления записи
 * @param  [type] $id
 * @return [type]
 */
    public function delete($id) {
        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return FALSE;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }

}