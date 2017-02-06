<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Frontend_Controller {

     public function __construct(){
        parent::__construct();
        
        $this->data['recent_news'] = $this->news_model->get_recent();
    }

    public function index($id, $slug){
        // Fetch the news
        $this->news_model->set_published();
        $this->data['news'] = $this->news_model->get($id);
        
        // Return 404 if not found
        count($this->data['news']) || show_404(uri_string());
        
        // Redirect if slug was incorrect
        $requested_slug = $this->uri->segment(3);
        $set_slug = $this->data['news']->slug;
        if ($requested_slug != $set_slug) {
            redirect('news/' . $this->data['news']->id_news . '/' . $this->data['news']->slug, 'location', '301');
        }
        
        // Load view
       // add_meta_title($this->data['news']->title);
        $this->data['subview'] = 'news';
       $this->display_view->view_page('_main_layout_show', $this->data);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */