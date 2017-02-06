<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends CI_Controller {


	public function index()
	{
		$this->load->helper('captcha');
		$this->load->library('session');

		//������� captcha
		$vals = array(
			'word'	 => 'text',		// �����
			'img_width' => 100,			// ������ ����������� (int)
			'img_height' => 30,			// ������ ����������� (int)
			'random_str_length' => 5,		// ����� ��������� ������ (int)
			'border' => FALSE,			// ��������� ����� (bool)
			'font_path'     => 'system/fonts/cour.ttf',   //���� � �������
		);
		$word = create_captcha_stream($vals);
		$this->session->set_flashdata('word', $word);
		//$this->session->set_userdata('word', $word);
	}
}
