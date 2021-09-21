<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Form_Model','fm');	
	}

	public function index()
	{
		$this->load->view('form');
	}

	public function submit_form()
	{
		
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('email','Email','valid_email|required');
			$this->form_validation->set_rules('dob','DOB','required');
			if(empty($_FILES['img']['name']))
			{
				$this->form_validation->set_rules('img','required');
			}

			if($this->form_validation->run() == FALSE)
			{ 
				$array = array(
						    'error'   => true,
						    'name_error' => form_error('name'),
						    'email_error' => form_error('email'),
						    'dob_error' => form_error('dob'),
						    'img_error' => form_error('img')
						   );
			}
			else
			{
				$config['upload_path']          = 'assets/img/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['file_name']        = $_FILES['img']['name'];

                 // $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('img'))
                {
                        echo $this->upload->display_errors();
                }
                else
                {
                        $data = $this->upload->data();
                        $datas['name'] = $this->input->post('name');
						$datas['email'] = $this->input->post('email');
						$datas['dob'] = $this->input->post('dob');
						$datas['img'] = $data['file_name'];
						$this->fm->insert('users',$datas);

						   $array = array(
									    'success' => '<div class="alert alert-success">Thank you for Contact Us</div>'
									   );
                }
			}
             echo json_encode($array);
			
		
	}

}
