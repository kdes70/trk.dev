<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend_Controller extends MY_Controller
{
    function __construct() {
        parent::__construct();

        
        $this->load->model('page_model');
        $this->load->model('news_model');
         $this->load->library('form_validation');
        $this->data['news_archive_link'] = $this->page_model->get_archive_link();
        $this->data['meta_title'] = config_item('site_name');

         $this->news_model->set_published();
        $this->db->limit(6);
        $this->data['news_slider'] = $this->news_model->get();
        
         $this->data['menutop'] = $this->page_model->get_nested(array('block'=>'top', 'public'=>'1'));
       $this->data['left_page'] = $this->page_model->get_by(array('public'=>'1', 'block'=>'left'));

      
       // dump($this->data['menu']);
    }
}
 
