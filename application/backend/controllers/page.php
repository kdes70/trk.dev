<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends Frontend_Controller {

    function __construct() {
        parent::__construct();

        //META
        $this->data['title'] = 'Томский научно-производственный рыболовный комплекс';

       $this->data['left_page'] = $this->page_model->get_by(array('public'=>'1', 'block'=>'left'));
        //dump($this->data['news']);
        //DEbug
        //$this->output->enable_profiler(TRUE);

    } 

     public function index() {
     // Fetch the page template
      $this->data['page'] = $this->page_model->get_by(array('url_page' => (string) $this->uri->segment(1)), TRUE);
      count($this->data['page']) || show_404(current_url());
      
     // add_meta_title($this->data['page']->title);
      
      // Fetch the page data
      $method = '_' . $this->data['page']->template;
      if (method_exists($this, $method)) {
        $this->$method();
      }
      else {
        log_message('error', 'Could not load template ' . $method .' in file ' . __FILE__ . ' at line ' . __LINE__);
        show_error('Could not load template ' . $method);
        
      }
      
      // Load the view
        $this->data['subview'] = $this->data['page']->template;
        $this->display_view->view_page('_main_layout_show', $this->data);
     
    }

    private function _page(){
      $this->data['recent_news'] = $this->news_model->get_recent();
    }
     private function _gallery(){

       $this->load->model('gallery_model');
       $status = '';

      if(isset($_POST['upload']))
      {

        if (empty($_POST['title']))
        {
            $status = "error";
            $this->data['error'] = "Описание не может быть пустым!";
        }
      if ($status != "error")
      {
          $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] .'/tmce4/uploads/images/gallery/';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size']  = '100';
          $config['max_width']  = '1024';
          $config['max_height']  = '768';
          $config['encrypt_name']  = TRUE;
          $config['remove_spaces']  = TRUE;

          $this->load->library('upload', $config);

         
          if (!$this->upload->do_upload())
          {
              $status = 'error';
              $this->data['error'] = $this->upload->display_errors('', '');
          }
          else
          {
              $file = $this->upload->data();

              $newfile = '/images/gallery/'.$file["file_name"];

              $rules = $this->gallery_model->rules;
              $this->form_validation->set_rules($rules);

              $title = $this->input->post('title');

             if ($this->form_validation->run() == TRUE)
             {
                     $data = array('title'=>$title, 'img'=>$newfile);

                      $this->gallery_model->save($data);
                      redirect('gallery');
            }

            //  $file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
            
          }
          //@unlink($_FILES[$file_element_name]);
      }



      }
     
      $this->data['gallery'] = $this->gallery_model->get();
    }

   private function _guest_book(){
    $this->load->model('guest_model');

       $this->load->library('session');

       if(isset($_POST['ok']) )
      {
          $captcha = trim($this->input->post('captcha')); // то что пришло с формы
          $word = $this->session->flashdata('word'); // то что было сгенерировано

        //  var_dump($_SESSION);exit;

          if ('text' == $captcha)
          {
              //$this->data['page'] = $this->page_model->get_new();
              // Set up the form
              $rules = $this->guest_model->rules;
              $this->form_validation->set_rules($rules);

              // Process the form
              if ($this->form_validation->run() == TRUE) {
                  $data = $this->guest_model->array_from_post(array(
                      'name',
                      'email',
                      'text',

                  ));
                  $this->guest_model->save($data);
                  redirect('guest');
              }
          }
          else
          {
              $this->session->set_flashdata('code_bed', "Код не верен!");
          }


      } 


    // Count all guest
   // $this->news_model->set_published();
    $count = $this->db->count_all_results('guest');
    
    // Set up pagination
    $perpage = 6;
    if ($count > $perpage) {
      $this->load->library('pagination');
      $config['base_url'] = site_url($this->uri->segment(1) . '/');
      $config['total_rows'] = $count;
      $config['per_page'] = $perpage;
      $config['uri_segment'] = 2;
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $offset = $this->uri->segment(2);
    }
    else {
      $this->data['pagination'] = '';
      $offset = 0;
    }
    
    // Fetch articles
   // $this->news_model->set_published();
    $this->db->limit($perpage, $offset);
    $this->data['guest'] = $this->guest_model->get_by(array('parent_id'=>0));



    }
   private function _homepage(){
      
      $this->news_model->set_published();
      $this->db->limit(6);
      $this->data['news_list'] = $this->news_model->get();
      
    }

    // private function _news(){
    //   //$this->data['recent_news'] = $this->news_model->get_recent();
    // }

     private function _news_archive(){
      
    $this->data['recent_news'] = $this->news_model->get_recent();
      
    // Count all articles
    $this->news_model->set_published();
    $count = $this->db->count_all_results('news');
    
    // Set up pagination
    $perpage = 4;
    if ($count > $perpage) {
      $this->load->library('pagination');
      $config['base_url'] = site_url($this->uri->segment(1) . '/');
      $config['total_rows'] = $count;
      $config['per_page'] = $perpage;
      $config['uri_segment'] = 2;
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $offset = $this->uri->segment(2);
    }
    else {
      $this->data['pagination'] = '';
      $offset = 0;
    }
    
    // Fetch articles
    $this->news_model->set_published();
    $this->db->limit($perpage, $offset);
    $this->data['news'] = $this->news_model->get();

    }
    

   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */