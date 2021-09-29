<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_Model');
	}

	public function datatable()
	{
		require_once(BASEPATH.'../application/third_party/dataTableClass.php');

		// DB table to use
$table = 'product';

// Table's primary key
$primaryKey = 'id';
$columns = array(
	array( 'db' => 'name', 'dt' => 0 ),
	array( 'db' => 'description',  'dt' => 1 ),
	array( 'db' => 'country',   'dt' => 2 ),
	array( 'db' => 'currency',   'dt' => 3 ),
	array( 'db' => 'id',     'dt' => 4 ,'formatter'=>function($d,$row){
		return '<a class="btn-sm btn-success" href="'.base_url("admin/edit_product/").base64_encode($d).'">Edit</a>
		<a class="btn-sm btn-danger" href="'.base_url("admin/delete_product/").base64_encode($d).'">Delete</a>';
	}
)
);

// SQL server connection information
$sql_details = array(
	'user' => $this->db->username,
	'pass' => $this->db->password,
	'db'   => $this->db->database,
	'host' => $this->db->hostname
);

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
	}

	public function index()
	{
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('email','Email Id','trim|required');
			$this->form_validation->set_rules('password','Password','trim|required');
			if($this->form_validation->run() === FALSE)
			{ 
				myview('admin/loginhead');
				myview('admin/login');
			}
			else
			{
				$email = $this->input->post('email');
				$password = $this->input->post('password');

				$user_row = $this->Admin_Model->selectrow('admin',['email'=>$email,'is_verified'=>'1','is_deleted'=>'0']);
				if($user_row)
				{
					$hash = @$user_row->password;
					if (password_verify($password, $hash)) {
						$this->session->set_userdata('loginadmin',$user_row);
						redirect('admin/manage_product');
					} else {
						$this->session->set_flashdata('error',"Incorrect Password");
						myview('admin/loginhead');
						myview('admin/login');
					}
				}
				else
				{
					$this->session->set_flashdata('error',"Incorrect Email Id");
					redirect($_SERVER['HTTP_REFERER']);
				}
								
		}
		}else
		{
			myview('admin/loginhead');
			myview('admin/login');
		}
	}
	
	
	

	public function manage_product()
	{
		checkadminlogin();
		$data['users']=$this->Admin_Model->select('product');
		myview('admin/manage_product',$data);
	}

	public function logout()
	{
		checkadminlogin();
		$this->session->sess_destroy($this->session->userdata('loginadmin'));
		redirect('admin');	
	}

	public function edit_product($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide); 
		$data['country'] = $this->country->getCountry(); 
		$data['users']=$this->Admin_Model->selectrow('product',['id'=>$id]);
		
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('description','Description','required');
			$this->form_validation->set_rules('country','Country','required');
			
			if($this->form_validation->run()==FALSE){
				myview('admin/edit_product',$data);

			}else{	
                       
             
                $datas['name'] = $this->input->post('name');
				$datas['description'] = $this->input->post('description');
				$datas['country'] = $this->input->post('country');
				$datas['currency'] = $this->input->post('currency');
				$this->Admin_Model->update('product',$datas,['id'=>$id]);
				$this->session->set_flashdata('message',"Product Updated successfully");
				return redirect('admin/manage_product');

                
						
			}
		}else{
			myview('admin/edit_product',$data);
		}
	}

public function delete_product($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->db->delete('array_product(array)',['id'=>$id]);		
		$this->session->set_flashdata('message',"product delete successfully");
		return redirect($_SERVER['HTTP_REFERER']);
	}





	
	
}
?>