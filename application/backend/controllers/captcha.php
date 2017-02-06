<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends CI_Controller {


	public function index()
	{
		$this->load->helper('captcha');
		$this->load->library('session');

		//создаем captcha
		$vals = array(
			'word'	 => 'text',		// текст
			'img_width' => 100,			// ширина изображения (int)
			'img_height' => 30,			// высота изображения (int)
			'random_str_length' => 5,		// длина случайной строки (int)
			'border' => FALSE,			// добавлять рамку (bool)
			'font_path'     => 'system/fonts/cour.ttf',   //Путь к шрифтам
		);
		$word = create_captcha_stream($vals);
		$this->session->set_flashdata('word', $word);
		//$this->session->set_userdata('word', $word);
	}
}
