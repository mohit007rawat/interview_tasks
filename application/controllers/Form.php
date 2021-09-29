<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Form_Model','fm');	
	}

	// public function getCountry($url)

 //    {
	// 	$ch = curl_init();
 //        curl_setopt($ch, CURLOPT_URL, $url);
 //        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	$result = json_decode(curl_exec($ch));
 //        curl_close($ch);
 //        return $result;

 //    }

	public function index()
	{
		$data['country'] = $this->country->getCountry();
		$this->load->view('form',$data);
	}

	public function submit_form()
	{
		
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('description','Description','required');
			$this->form_validation->set_rules('country','Country','required');

			if($this->form_validation->run() == FALSE)
			{ 
				$array = array(
						    'error'   => true,
						    'name_error' => form_error('name'),
						    'description_error' => form_error('description'),
						    'country_error' => form_error('country')
						   );
			}
			else
			{
				
                $datas['name'] = $this->input->post('name');
				$datas['description'] = $this->input->post('description');
				$datas['country'] = $this->input->post('country');
				$datas['currency'] = $this->input->post('currency');
				$this->fm->insert('product',$datas);

				   $array = array(
							    'success' => '<div class="alert alert-success">Thank you for Submit Product</div>'
							   );
                
			}
             echo json_encode($array);
			
		
	}

}
