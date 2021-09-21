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
$table = 'users';

// Table's primary key
$primaryKey = 'id';
$columns = array(
	array( 'db' => 'name', 'dt' => 0 ),
	array( 'db' => 'email',  'dt' => 1 ),
	array( 'db' => 'dob',   'dt' => 2 ),
	array( 'db' => 'img',     'dt' => 3 ,'formatter'=>function($d,$row){
		return '<img width="180px" height="120px" src="'.base_url('assets/img/').$d.'">';
	},
	
	),
	array( 'db' => 'id',     'dt' => 4 ,'formatter'=>function($d,$row){
		return '<a class="btn-sm btn-success" href="'.base_url("admin/edit_user/").base64_encode($d).'">Edit</a>';
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
						redirect('admin/manage_user');
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
	
	
	

	public function manage_user()
	{
		checkadminlogin();
		$data['users']=$this->Admin_Model->select('users');
		// foreach ($data['users'] as $key => $value) {
		// 	pr($value->id);
		// }

		
		myview('admin/manage_user',$data);
	}

	public function logout()
	{
		checkadminlogin();
		$this->session->sess_destroy($this->session->userdata('loginadmin'));
		redirect('admin');	
	}

	public function edit_user($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);  
		$data['users']=$this->Admin_Model->selectrow('users',['id'=>$id]);
		
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('email','Email','valid_email|required');
			$this->form_validation->set_rules('dob','DOB','required');
			
			if($this->form_validation->run()==FALSE){
				myview('admin/edit_user',$data);

			}else{	


			if(!empty($_FILES['img']['name']))
			{	
				
				$config['upload_path']          = 'assets/img/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['file_name']        = $_FILES['img']['name'];
                $this->load->library('upload', $config);
                $this->upload->do_upload('img');
                           $data = $this->upload->data();
						$datas['img'] = $data['file_name'];

			}	
                       
             
                        $datas['name'] = $this->input->post('name');
						$datas['email'] = $this->input->post('email');
						$datas['dob'] = $this->input->post('dob');
						$this->Admin_Model->update('users',$datas,['id'=>$id]);
						$this->session->set_flashdata('message',"User Updated successfully");
						return redirect('admin/manage_user');

                
						
			}
		}else{
			myview('admin/edit_user',$data);
		}
	}






	////////////////////////

	public function userstatus($ide)
    {
		checkadminlogin();
        if(!empty($ide))
        {
            $id=base64_decode($ide);            
			$check = $this->Admin_Model->selectrow('users_login',['id'=>$id]);
			$value = ($check->status==1)?'0':'1';
			$msg=($value=='1')?'Sub-Category Active successfully':'Sub-Category Block successfully';
			
			$this->Admin_Model->update('users_login',['status'=>$value],['id'=>$check->id]);
            $this->session->set_flashdata('message',$msg);
            return redirect('manage_user');
        }else{
            return redirect('manage_user');
        }
	}

	public function manage_faq()
	{
		checkadminlogin();
		$data['faq']=$this->Admin_Model->select('faq',['is_deleted'=>'0']);
		myview('admin/manage_faq',$data);
	}	

	public function faq()
	{			
		checkadminlogin();

			$this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('description','Description','trim|required');

			if($this->form_validation->run() === FALSE)
			{ 
				myview('admin/faq');
			}
			else
			{
				$title = $this->input->post('title');
				$description = $this->input->post('description');

				
				$this->Admin_Model->insert('faq',['title'=>$title,'description'=>$description]);
				$this->session->set_flashdata('message',"FAQ's Added Successfully");
				return redirect('admin/manage_faq');		
				
			}	
	
	}

	public function faqstatus($ide)
    {
		checkadminlogin();
        if(!empty($ide))
        {
            $id=base64_decode($ide);            
			$check = $this->Admin_Model->selectrow('faq',['id'=>$id]);
			$value = ($check->status==1)?'0':'1';
			$msg=($value=='1')?'FAQ active successfully':'FAQ inactive successfully';
			
			$this->Admin_Model->update('faq',['status'=>$value],['id'=>$check->id]);
            $this->session->set_flashdata('message',$msg);
			return redirect($_SERVER['HTTP_REFERER']);

        }else{
			return redirect($_SERVER['HTTP_REFERER']);

        }
	}

	public function delete_faq($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('faq',['is_deleted'=>'1'],['id'=>$id]);		
		$this->session->set_flashdata('message',"FAQ delete successfully");
		return redirect($_SERVER['HTTP_REFERER']);
	}

	

	public function manage_pro_color()
	{
		checkadminlogin();
		$data['color']=$this->Admin_Model->select('product_color',['is_deleted'=>'0']);
		myview('admin/manage_pro_color',$data);
	}	

	public function add_pro_color()
	{			
		checkadminlogin();

			$this->form_validation->set_rules('name','Color Name','trim|required');

			if($this->form_validation->run() === FALSE)
			{ 
				myview('admin/add_pro_color');
			}
			else
			{

				$name = $this->input->post('name');

				
				$this->Admin_Model->insert('product_color',['name'=>$name]);
				$this->session->set_flashdata('message',"Color Added Successfully");
				return redirect('admin/manage_pro_color');		
				
			}	
	
	}

	public function pro_color_status($ide)
    {
		checkadminlogin();
        if(!empty($ide))
        {
            $id=base64_decode($ide);            
			$check = $this->Admin_Model->selectrow('product_color',['id'=>$id]);
			$value = ($check->status==1)?'0':'1';
			$msg=($value=='1')?'Color active successfully':'Color inactive successfully';
			
			$this->Admin_Model->update('product_color',['status'=>$value],['id'=>$check->id]);
            $this->session->set_flashdata('message',$msg);
			return redirect($_SERVER['HTTP_REFERER']);

        }else{
			return redirect($_SERVER['HTTP_REFERER']);

        }
	}

	public function delete_pro_color($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('product_color',['is_deleted'=>'1'],['id'=>$id]);		
		$this->session->set_flashdata('message',"Color delete successfully");
		return redirect($_SERVER['HTTP_REFERER']);
	}

	public function edit_pro_color($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);  
		$data['product_color']=$this->Admin_Model->selectrow('product_color',['id'=>$id]);
		
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('name','Color Name','trim|required');		

			if($this->form_validation->run()==FALSE){
				myview('admin/edit_pro_color',$data);

			}else{			

				$name = $this->input->post('name');
				$insert = $this->Admin_Model->update('product_color',['name'=>$name],['id'=>$id]);
				if($insert)
				{
					$this->session->set_flashdata('message',"Color Updated successfully");
					return redirect('admin/manage_pro_color');
				}				
			}
		}else{
			myview('admin/edit_pro_color',$data);
		}
	}


	public function about_us()
	{
			checkadminlogin();
			$this->form_validation->set_rules('about_us','About us','trim|required');
			$this->form_validation->set_rules('heading','Heading','trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
			$data['meta'] = $this->Admin_Model->selectrow('about_us');


			if($this->form_validation->run() === FALSE)
			{ 
				myview('admin/about_us',$data);
			}
			else
			{
				if(!empty($_FILES['img1']['name']))
				{
					$img1 = uploadfile('img1','assets/about_us_img/');
					$about_us['img1'] = $img1; 
				}
				else
				{
					$img1 = "NULL";
				}

				if(!empty($_FILES['img2']['name']))
				{
					$img2 = uploadfile('img2','assets/about_us_img/');	
					$about_us['img2'] = $img2; 
				}
				else
				{
					$img2 = "NULL";
				}
				
				// $about_us = array(
								// 'img1' =>	$img1,
								// 'img2' =>	$img2,
								$about_us['first_desc'] =	$this->input->post('first_desc');
								$about_us['second_desc'] =	$this->input->post('second_desc');
								$about_us['main_description'] =	$this->input->post('main_description');


								$about_us['about_us'] =	$this->input->post('about_us');
								$about_us['heading'] =	$this->input->post('heading');
								$about_us['keywords'] = $this->input->post('keywords');
								$about_us['title'] = $this->input->post('title');
								$about_us['description'] = $this->input->post('description');
								$about_us['og_title'] = $this->input->post('og_title');
								$about_us['og_description'] = $this->input->post('og_description');
								$about_us['og_site_name'] = $this->input->post('og_site_name');
								$about_us['og_url'] = $this->input->post('og_url');
								$about_us['twitter_title'] = $this->input->post('twitter_title');
								$about_us['twitter_description'] = $this->input->post('twitter_description');
								$about_us['itemprop_title'] = $this->input->post('itemprop_title');
								$about_us['itemprop_description'] = $this->input->post('itemprop_description');
								$about_us['author'] = $this->input->post('author');
								$about_us['page_topic'] = $this->input->post('page_topic');
								$about_us['copyright'] = $this->input->post('copyright');
								$about_us['robots'] = $this->input->post('robots');
								$about_us['rating'] = $this->input->post('rating');
								$about_us['google_bot'] = $this->input->post('google_bot');
								$about_us['yahoo_seeker'] = $this->input->post('yahoo_seeker');
								$about_us['msnbot'] = $this->input->post('msnbot');
								$about_us['reply_to'] = $this->input->post('reply_to');
								$about_us['allow_search'] = $this->input->post('allow_search');
								$about_us['revisit_after'] = $this->input->post('revisit_after');
								$about_us['distribution'] = $this->input->post('distribution');
								$about_us['expires'] = $this->input->post('expires');
								$about_us['language'] = $this->input->post('language');
								$about_us['first_json_script_application'] = $this->input->post('first_json_script_application');
								$about_us['second_json_script_application'] = $this->input->post('second_json_script_application');
								$about_us['third_json_script_application'] = $this->input->post('third_json_script_application');
								$about_us['google_manager'] = $this->input->post('google_manager');
							// );
// pr($about_us);
				// if($data['meta'])
				// {
					$this->Admin_Model->update('about_us',$about_us,['id'=>'1']);				
					$this->session->set_flashdata('message',"About Us Updated Successfully");
					return redirect($_SERVER['HTTP_REFERER']);		
				// }
				// else
				// {
				// 	$this->Admin_Model->insert('about_us',$about_us);
				// 	$this->session->set_flashdata('message',"About Us Added Successfully");
				// 	return redirect($_SERVER['HTTP_REFERER']);		
				// }
			}	
	
	}

	public function term_and_condition()
	{
			checkadminlogin();
			$this->form_validation->set_rules('term_and_condition','Term And Condition','required');
			$this->form_validation->set_rules('heading','Heading','trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');

			$data['meta'] = $this->Admin_Model->selectrow('term_and_condition');

			if($this->form_validation->run() === FALSE)
			{ 
				myview('admin/term_and_condition',$data);
			}
			else
			{
				$term_and_condition = array(
								'term_and_condition' =>	$this->input->post('term_and_condition'),
								'heading' =>	$this->input->post('heading'),
								'keywords' => $this->input->post('keywords'),
								'title' => $this->input->post('title'),
								'description' => $this->input->post('description'),
								'og_title' => $this->input->post('og_title'),
								'og_description' => $this->input->post('og_description'),
								'og_site_name' => $this->input->post('og_site_name'),
								'og_url' => $this->input->post('og_url'),
								'twitter_title' => $this->input->post('twitter_title'),
								'twitter_description' => $this->input->post('twitter_description'),
								'itemprop_title' => $this->input->post('itemprop_title'),
								'itemprop_description' => $this->input->post('itemprop_description'),
								'author' => $this->input->post('author'),
								'page_topic' => $this->input->post('page_topic'),
								'copyright' => $this->input->post('copyright'),
								'robots' => $this->input->post('robots'),
								'rating' => $this->input->post('rating'),
								'google_bot' => $this->input->post('google_bot'),
								'yahoo_seeker' => $this->input->post('yahoo_seeker'),
								'msnbot' => $this->input->post('msnbot'),
								'reply_to' => $this->input->post('reply_to'),
								'allow_search' => $this->input->post('allow_search'),
								'revisit_after' => $this->input->post('revisit_after'),
								'distribution' => $this->input->post('distribution'),
								'expires' => $this->input->post('expires'),
								'language' => $this->input->post('language'),
								'first_json_script_application' => $this->input->post('first_json_script_application'),
								'second_json_script_application' => $this->input->post('second_json_script_application'),
								'third_json_script_application' => $this->input->post('third_json_script_application'),
								'google_manager' => $this->input->post('google_manager')
							);
				if($data['meta'])
				{
					$this->Admin_Model->update('term_and_condition',$term_and_condition,['id'=>'1']);				
					$this->session->set_flashdata('message',"Term And Condition Updated Successfully");
					return redirect($_SERVER['HTTP_REFERER']);		
				}
				else
				{
					$this->Admin_Model->insert('term_and_condition',$term_and_condition);
					$this->session->set_flashdata('message',"Term And Condition  Added Successfully");
					return redirect($_SERVER['HTTP_REFERER']);		
				}
			}	
	
	}

	public function privacy_policy()
	{
		checkadminlogin();

			$this->form_validation->set_rules('privacy_policy','Privacy Policy','required');
			$this->form_validation->set_rules('heading','Heading','trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');

			$data['meta'] = $this->Admin_Model->selectrow('privacy_policy');

			if($this->form_validation->run() === FALSE)
			{ 
				myview('admin/privacy_policy',$data);
			}
			else
			{
				$privacy_policy = array(
								'privacy_policy' =>	$this->input->post('privacy_policy'),
								'heading' =>	$this->input->post('heading'),
								'keywords' => $this->input->post('keywords'),
								'title' => $this->input->post('title'),
								'description' => $this->input->post('description'),
								'og_title' => $this->input->post('og_title'),
								'og_description' => $this->input->post('og_description'),
								'og_site_name' => $this->input->post('og_site_name'),
								'og_url' => $this->input->post('og_url'),
								'twitter_title' => $this->input->post('twitter_title'),
								'twitter_description' => $this->input->post('twitter_description'),
								'itemprop_title' => $this->input->post('itemprop_title'),
								'itemprop_description' => $this->input->post('itemprop_description'),
								'author' => $this->input->post('author'),
								'page_topic' => $this->input->post('page_topic'),
								'copyright' => $this->input->post('copyright'),
								'robots' => $this->input->post('robots'),
								'rating' => $this->input->post('rating'),
								'google_bot' => $this->input->post('google_bot'),
								'yahoo_seeker' => $this->input->post('yahoo_seeker'),
								'msnbot' => $this->input->post('msnbot'),
								'reply_to' => $this->input->post('reply_to'),
								'allow_search' => $this->input->post('allow_search'),
								'revisit_after' => $this->input->post('revisit_after'),
								'distribution' => $this->input->post('distribution'),
								'expires' => $this->input->post('expires'),
								'language' => $this->input->post('language'),
								'first_json_script_application' => $this->input->post('first_json_script_application'),
								'second_json_script_application' => $this->input->post('second_json_script_application'),
								'third_json_script_application' => $this->input->post('third_json_script_application'),
								'google_manager' => $this->input->post('google_manager')
							);
				if($data['meta'])
				{
					$this->Admin_Model->update('privacy_policy',$privacy_policy,['id'=>'1']);				
					$this->session->set_flashdata('message',"Term And Condition Updated Successfully");
					return redirect($_SERVER['HTTP_REFERER']);		
				}
				else
				{
					$this->Admin_Model->insert('privacy_policy',$privacy_policy);
					$this->session->set_flashdata('message',"Term And Condition  Added Successfully");
					return redirect($_SERVER['HTTP_REFERER']);		
				}
			}	
	
	}
	public function manage_faq_meta($pro_id,$type)
	{
		checkadminlogin();
		$id = base64_decode($pro_id);

		$data['meta']=$this->Admin_Model->selectrow('meta',['product_id'=>'0','type'=>'3']);
		#pr($data['meta']);
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
			

			if($this->form_validation->run()==FALSE){
				myview('admin/faq_meta',$data);
			}else{
		
				$datas= array(	
								'type' => $type,
								'title' => $this->input->post('title'),							
								'keywords' => $this->input->post('keywords'),
								'description' => $this->input->post('description'),
								'og_title' => $this->input->post('og_title'),
								'og_description' => $this->input->post('og_description'),
								'og_site_name' => $this->input->post('og_site_name'),
								'og_url' => $this->input->post('og_url'),
								'twitter_title' => $this->input->post('twitter_title'),
								'twitter_description' => $this->input->post('twitter_description'),
								'itemprop_title' => $this->input->post('itemprop_title'),
								'itemprop_description' => $this->input->post('itemprop_description'),
								'author' => $this->input->post('author'),
								'page_topic' => $this->input->post('page_topic'),
								'copyright' => $this->input->post('copyright'),
								'robots' => $this->input->post('robots'),
								'rating' => $this->input->post('rating'),
								'google_bot' => $this->input->post('google_bot'),
								'yahoo_seeker' => $this->input->post('yahoo_seeker'),
								'msnbot' => $this->input->post('msnbot'),
								'reply_to' => $this->input->post('reply_to'),
								'allow_search' => $this->input->post('allow_search'),
								'revisit_after' => $this->input->post('revisit_after'),
								'distribution' => $this->input->post('distribution'),
								'expires' => $this->input->post('expires'),
								'language' => $this->input->post('language'),
								'first_json_script_application' => $this->input->post('first_json_script_application'),
								'second_json_script_application' => $this->input->post('second_json_script_application'),
								'third_json_script_application' => $this->input->post('third_json_script_application'),
								'google_manager' => $this->input->post('google_manager')
							);
					if(!empty($data['meta']))
					{
						$insert = $this->Admin_Model->update('meta',$datas,['product_id'=>'0']);
						$msg = "Meta Updated!!";
					}
					else
					{
						$datas['product_id'] = '0';
						$insert = $this->Admin_Model->insert('meta',$datas);
						$msg = "Meta Inserted!!";
					}
					$this->session->set_flashdata('message',$msg);
					return redirect($_SERVER['HTTP_REFERER']);								
			}
		}else{
			myview('admin/faq_meta',$data);
		}
	}

	// public function manage_store()
	// {
	// 	checkadminlogin();
	// 	#$data['store']=$this->Admin_Model->join_select('ul.*,ua.country','users_login as ul','user_address as ua','ul.id=ua.user_id',['ul.is_verified'=>'1']);
	// 	$data['store']=$this->Admin_Model->select('users',['usertype'=>'1','is_verified'=>'1']);		
	// 	myview('admin/manage_store',$data);
	// }

	// public function storestatus($ide)
 //    {
	// 	checkadminlogin();
 //        if(!empty($ide))
 //        {
 //            $id=base64_decode($ide);            
	// 		$check = $this->Admin_Model->selectrow('users',['id'=>$id]);
	// 		$value = ($check->status==1)?'0':'1';
	// 		$msg=($value=='1')?'Store Active successfully':'Store Block successfully';
			
	// 		$this->Admin_Model->update('users',['status'=>$value],['id'=>$check->id]);
 //            $this->session->set_flashdata('message',$msg);
 //            return redirect('admin/manage_store');
 //        }else{
 //            return redirect('admin/manage_store');
 //        }
	// }

	// public function manage_restaurant()
	// {
	// 	checkadminlogin();
	// 	#$data['store']=$this->Admin_Model->join_select('ul.*,ua.country','users_login as ul','user_address as ua','ul.id=ua.user_id',['ul.is_verified'=>'1']);
	// 	$data['restaurant']=$this->Admin_Model->select('users',['usertype'=>'2','is_verified'=>'1']);		
	// 	myview('admin/manage_restaurant',$data);
	// }

	// public function restaurantstatus($ide)
 //    {
	// 	checkadminlogin();
 //        if(!empty($ide))
 //        {
 //            $id=base64_decode($ide);            
	// 		$check = $this->Admin_Model->selectrow('users',['id'=>$id]);
	// 		$value = ($check->status==1)?'0':'1';
	// 		$msg=($value=='1')?'Restaurant Active successfully':'Restaurant Block successfully';
			
	// 		$this->Admin_Model->update('users',['status'=>$value],['id'=>$check->id]);
 //            $this->session->set_flashdata('message',$msg);
 //            return redirect('admin/manage_restaurant');
 //        }else{
 //            return redirect('admin/manage_restaurant');
 //        }
	// }

	// public function productstatus($ide,$rowid)
 //    {
	// 	checkadminlogin();
 //        if(!empty($ide))
 //        {
 //            $id=base64_decode($ide);            
	// 		$check = $this->Admin_Model->selectrow('products',['id'=>$id]);
	// 		$value = ($check->status==1)?'0':'1';
	// 		$msg=($value=='1')?'Product Active successfully':'Product Block successfully';
			
	// 		$this->Admin_Model->update('products',['status'=>$value],['id'=>$check->id]);
 //            $this->session->set_flashdata('message',$msg);
 //            return redirect('admin/selected_product/'.$rowid);
 //        }else{
 //            return redirect('admin/selected_product/'.$rowid);
 //        }
	// }

	
	// public function delivery_boy()
	// {
	// 	checkadminlogin();
	// 	$data['delivery_boy']=$this->Admin_Model->select('delivery_boy',['is_deleted'=>'0']);
	// 	myview('admin/delivery_boy',$data);
	// }	

	// public function add_deliverboy()
	// {
	// 	checkadminlogin();
	// 	if(!empty($_POST))
	// 	{	
	// 		// if (empty($_FILES['img']['name'])) {
	// 		// 	$this->form_validation->set_rules('img', 'Images', 'required');
	// 		// }
	// 		$this->form_validation->set_rules('name', 'Name', 'trim|required');
	// 		$this->form_validation->set_rules('email', 'Email Id', 'trim|required');
	// 		$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
	// 		$this->form_validation->set_rules('driving_license', 'Driving License', 'trim|required');
	// 		$this->form_validation->set_rules('delivery_area', 'Delivery Area', 'trim|required');
	// 		$this->form_validation->set_rules('bank_name', 'Name', 'trim|required');
	// 		$this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'trim|required');
	// 		$this->form_validation->set_rules('ifsc_code', 'Name', 'trim|required');
	// 		$this->form_validation->set_rules('branch_name', 'Name', 'trim|required');
	// 		$this->form_validation->set_rules('account_number', 'Name', 'trim|required');
	// 		$this->form_validation->set_rules('password', 'Name', 'trim|required');

	// 		if($this->form_validation->run()==FALSE){
	// 			myview('admin/add_delivery_boy');
	// 		}else{				
	// 			$image_data = uploadfile('img','assets/deliverboy_profile/');			
	// 			$data = array(
	// 							'name' => ucfirst($this->input->post('name')),
	// 							'email' => $this->input->post('email'),								
	// 							'mobile' => $this->input->post('mobile'),								
	// 							'driving_license' => $this->input->post('driving_license'),								
	// 							'delivery_area' => $this->input->post('delivery_area'),																	
	// 							'longitude' => $this->input->post('longitude'),								
	// 							'latitude' => $this->input->post('latitude'),							
	// 							'bank_name' => $this->input->post('bank_name'),								
	// 							'account_holder_name' => $this->input->post('account_holder_name'),								
	// 							'ifsc_code' => $this->input->post('ifsc_code'),								
	// 							'branch_name' => $this->input->post('branch_name'),								
	// 							'account_number' => $this->input->post('account_number'),								
	// 							'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),							
	// 							'profile_img' => $image_data
	// 						);		
	// 			$insert = $this->Admin_Model->insert('delivery_boy',$data);
	// 			if($insert)
	// 			{
	// 				$this->session->set_flashdata('message',"Delivery Boy add successfully");
	// 				return redirect('admin/delivery_boy');
	// 			}				
	// 		}
	// 	}else{
	// 		myview('admin/add_delivery_boy');
	// 	}
	// }

	// public function view_delivery_boy_details($id='')
	// {
	// 	checkadminlogin();		
	// 	if(!empty($id))
	// 	{			
	// 		$id=base64_decode($id);  

	// 		$data['delivery_boy'] =  $this->Admin_Model->selectrow('delivery_boy',['id'=>$id]);
	// 		myview('admin/view_delivery_boy_details',$data);			
	// 	}
	// 	else
	// 	{
	// 		redirect('admin/delivery_boy');
	// 	}
	// }

	// public function edit_delivery_boy_details($id)
	// {
	// 	checkadminlogin();
	// 	$id=base64_decode($id); 
	// 	$data['delivery_boy'] =  $this->Admin_Model->selectrow('delivery_boy',['id'=>$id]);
	// 	if(!empty($_POST))
	// 	{	
	// 		// if (empty($_FILES['img']['name'])) {
	// 		// 	$this->form_validation->set_rules('img', 'Images', 'required');
	// 		// }
	// 		$this->form_validation->set_rules('name', 'Name', 'trim|required');
	// 		$this->form_validation->set_rules('email', 'Email Id', 'trim|required');
	// 		$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
	// 		$this->form_validation->set_rules('driving_license', 'Driving License', 'trim|required');
	// 		$this->form_validation->set_rules('delivery_area', 'Delivery Area', 'trim|required');
	// 		$this->form_validation->set_rules('bank_name', 'Name', 'trim|required');
	// 		$this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'trim|required');
	// 		$this->form_validation->set_rules('ifsc_code', 'Name', 'trim|required');
	// 		$this->form_validation->set_rules('branch_name', 'Name', 'trim|required');
	// 		$this->form_validation->set_rules('account_number', 'Name', 'trim|required');

	// 		if($this->form_validation->run()==FALSE){
				
	// 			myview('admin/edit_delivery_boy',$data);
	// 		}else{				

	// 			if (!empty($_FILES['img']['name'])) 
	// 			{
	// 				$image_data = uploadfile('img','assets/deliverboy_profile/');
	// 				$data2['profile_img'] = $image_data;		
	// 			}

	// 			if ($this->input->post('password')) 
	// 			{
	// 				$data2['password'] = password_hash($this->input->post('password'),PASSWORD_DEFAULT);		
	// 			}
							
				
	// 				$data2['name'] = ucfirst($this->input->post('name'));
	// 				$data2['email'] = $this->input->post('email');						
	// 				$data2['mobile'] = $this->input->post('mobile');								
	// 				$data2['driving_license'] = $this->input->post('driving_license');								
	// 				$data2['delivery_area'] = $this->input->post('delivery_area');								
	// 				$data2['longitude'] = $this->input->post('longitude');								
	// 				$data2['latitude'] = $this->input->post('latitude');								
	// 				$data2['bank_name'] = $this->input->post('bank_name');								
	// 				$data2['account_holder_name'] = $this->input->post('account_holder_name');								
	// 				$data2['ifsc_code'] = $this->input->post('ifsc_code');								
	// 				$data2['branch_name'] = $this->input->post('branch_name');								
	// 				$data2['account_number'] = $this->input->post('account_number');
						
	// 			$this->Admin_Model->update('delivery_boy',$data2,['id'=>$id]);
				
	// 				$this->session->set_flashdata('message',"Delivery Boy Updated successfully");
	// 				return redirect('admin/delivery_boy');
				
								
	// 		}
	// 	}else{
	// 		myview('admin/edit_delivery_boy',$data);
	// 	}
	// }

	// public function delivery_boy_status($ide)
 //    {
	// 	checkadminlogin();
 //        if(!empty($ide))
 //        {
 //            $id=base64_decode($ide);            
	// 		$check = $this->Admin_Model->selectrow('delivery_boy',['id'=>$id]);
	// 		$value = ($check->status==1)?'0':'1';
	// 		$msg=($value=='1')?'Delivery Boy active successfully':'Delivery Boy inactive successfully';
			
	// 		$this->Admin_Model->update('delivery_boy',['status'=>$value],['id'=>$check->id]);
 //            $this->session->set_flashdata('message',$msg);
 //            return redirect('admin/delivery_boy');
 //        }else{
 //            return redirect('admin/delivery_boy');
 //        }
	// }
	// public function delivery_boy_delete($ide)
	// {
	// 	checkadminlogin();
	// 	$id=base64_decode($ide);
	// 	$this->Admin_Model->update('delivery_boy',['is_deleted'=>'1'],['id'=>$id]);
	// 	$this->session->set_flashdata('message',"Delivery Boy Delete successfully");
	// 	return redirect('admin/delivery_boy');
	// }	

	public function coupon()
	{
		checkadminlogin();
		$data['coupon']=$this->Admin_Model->select('coupon',['is_deleted'=>'0']);
		myview('admin/coupon',$data);
	}	

	public function addCoupon()
	{
		checkadminlogin();
		if(!empty($_POST))
		{				
			$this->form_validation->set_rules('title', 'Name', 'trim|required');
			$this->form_validation->set_rules('name', 'Email Id', 'trim|required');
			$this->form_validation->set_rules('price', 'Mobile Number', 'trim|required');
			$this->form_validation->set_rules('start_date', 'Driving License', 'trim|required');
			$this->form_validation->set_rules('end_date', 'Delivery Area', 'trim|required');

			if($this->form_validation->run()==FALSE){
				myview('admin/addcoupon');
			}else{				
				$image_data = uploadfile('img','assets/coupon/');			
				$data = array(
								'title' => ucfirst($this->input->post('title')),
								'name' => $this->input->post('name'),								
								'mini_cart_val' => $this->input->post('mini_cart_val'),								
								'price' => $this->input->post('price'),								
								'start_date' => $this->input->post('start_date'),								
								'end_date' => $this->input->post('end_date')					
								
							);		
				$insert = $this->Admin_Model->insert('coupon',$data);
				if($insert)
				{
					$this->session->set_flashdata('message',"Coupon added successfully");
					return redirect('coupon');
				}				
			}
		}else{
			myview('admin/addcoupon');
		}
	}

	// public function editcoupon($eid)
	// {
	// 	checkadminlogin();
	// 	$id=base64_decode($eid); 
	// 	$data['coupon'] =  $this->Admin_Model->selectrow('coupon',['id'=>$id]);
	// 	if(!empty($_POST))
	// 	{	

	// 		$this->form_validation->set_rules('title', 'Title', 'trim|required');
	// 		$this->form_validation->set_rules('name', 'Name', 'trim|required');
	// 		$this->form_validation->set_rules('mini_cart_val', 'Minimum Cart Value', 'trim|required');
	// 		$this->form_validation->set_rules('price', 'Price', 'trim|required');
	// 		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
	// 		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');

	// 		if($this->form_validation->run()==FALSE){
	// 			myview('admin/editcoupon',$data);
	// 		}else{				
	// 			$data2['title'] = ucfirst($this->input->post('title'));			
	// 			$data2['name'] = ucfirst($this->input->post('name'));			
	// 			$data2['mini_cart_val'] = ucfirst($this->input->post('mini_cart_val'));			
	// 			$data2['price'] = ucfirst($this->input->post('price'));			
	// 			$data2['start_date'] = ucfirst($this->input->post('start_date'));			
	// 			$data2['end_date'] = ucfirst($this->input->post('end_date'));
	// 			$insert = $this->Admin_Model->update('coupon',$data2,['id'=>$id]);
	// 			$this->session->set_flashdata('message',"Coupon Updated successfully");
	// 				return redirect('coupon');
	// 		}
	// 	}else{
	// 		myview('admin/editcoupon',$data);
	// 	}
	// }

	public function couponstatus($ide)
    {
		checkadminlogin();
        if(!empty($ide))
        {
            $id=base64_decode($ide);            
			$check = $this->Admin_Model->selectrow('coupon',['id'=>$id]);
			$value = ($check->status==1)?'0':'1';
			$msg=($value=='1')?'Coupon active successfully':'Coupon inactive successfully';
			
			$this->Admin_Model->update('coupon',['status'=>$value],['id'=>$check->id]);
            $this->session->set_flashdata('message',$msg);
            return redirect('coupon');
        }else{
            return redirect('coupon');
        }
	}

	public function deletecoupon($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('coupon',['is_deleted'=>'1'],['id'=>$id]);
		$this->session->set_flashdata('message',"Coupon Delete successfully");
		return redirect('coupon');
	}	

	public function orders_request()
	{
		checkadminlogin();
		
			$data['orders_request'] = $this->Admin_Model->select('orders',['is_approved'=>'0']);		
			myview('admin/order_request',$data);		
	}

	public function ongoing_orders()
	{
		checkadminlogin();
		
			$data['ongoing_orders'] = $this->Admin_Model->select_ongoing_orders('orders');		
			myview('admin/ongoing_orders',$data);		
	}

	public function contact_us()
	{
		checkadminlogin();
		
			$data['contact_us'] = $this->Admin_Model->select('contact_us');		
			myview('admin/contact_us',$data);		
	}

	public function download_brochure()
	{
		checkadminlogin();
		$data['download_brochure']=$this->Admin_Model->join_select('b.*,p.name as p_name',
														 'download_brochure as b',
														 'product_brochure as p',
														 'b.product_id=p.id',
														 );
			// $data['download_brochure'] = $this->Admin_Model->select('download_brochure');		
			myview('admin/download_brochure',$data);		
	}

	public function brochure_message()
	{
		checkadminlogin();
		$data['brochure_message']=$this->Admin_Model->join_select('b.*,p.name as p_name',
														 'brochure_message as b',
														 'product_brochure as p',
														 'b.product_id=p.id',
														 );
			// $data['brochure_message'] = $this->Admin_Model->select('brochure_message');		
			myview('admin/brochure_message',$data);		
	}

	public function change_order_detail_status($action='',$id='')
	{
		checkadminlogin();	
		// if($this->usertype == 3){
		// 	if(!in_array(10, $this->access)){
		// 		redirect($_SERVER['HTTP_REFERER']);
		// 	}
		// }	
		if(isset($_POST))
		{			
			$action = $this->input->post('d_status');
			$id = $this->input->post('row_id');	
			$update = $this->Admin_Model->update('order_summery',['status'=>$action],['id'=>$id]);
			if($update)
			{				
				$status = true;
			}
			else
			{
				$status = false;
			}
		}
		else
		{
			$status = false;
		}
		echo json_encode(array('status'=>$status));
	}


	public function view_request_orders_details($id)
	{
		checkadminlogin();
		$id = base64_decode($id);

		$data['orders']=$this->Admin_Model->selectrow('orders',['id'=>$id]);
		$data['order_summery']=$this->Admin_Model->select('order_summery',['order_id'=>$id]);
		// $data['vender_details']=$this->Admin_Model->selectrow('users',['id'=>$data['orders']->vendor_id]);
		// $product_details = json_decode($data['orders']->product_details); 
		// foreach($product_details as $key) 
		// { 	
		// 	$datadetails = $this->Admin_Model->selectrow('products',['id'=>$key->product_id]);
		// 	$datadetails->qty = $key->qty;
		// 	$productName[] = $datadetails;
		// 	// pr($data);	
		// }
		
		// $data['orders']->pro_name = $productName;
		myview('admin/view_request_orders_details',$data);
	}

	public function view_ongoing_orders($id)
	{
		checkadminlogin();
		$id = base64_decode($id);

		$data['orders']=$this->Admin_Model->selectrow('orders',['id'=>$id]);
		$data['order_summery']=$this->Admin_Model->select('order_summery',['order_id'=>$id]);
		// $data['vender_details']=$this->Admin_Model->selectrow('users',['id'=>$data['orders']->vendor_id]);
		// $product_details = json_decode($data['orders']->product_details); 
		// foreach($product_details as $key) 
		// { 	
		// 	$datadetails = $this->Admin_Model->selectrow('products',['id'=>$key->product_id]);
		// 	$datadetails->qty = $key->qty;
		// 	$productName[] = $datadetails;
		// 	// pr($data);	
		// }
		
		// $data['orders']->pro_name = $productName;
		myview('admin/view_ongoing_orders',$data);
	}

	public function action_orders_request($action='',$id='')
	{
		checkadminlogin();		
		if(!empty($action) || !empty($id))
		{			
			$action = base64_decode($action);
			$id = base64_decode($id);
			
			if($action === '1')
			{
				$this->Admin_Model->update('orders',['order_status'=>'1'],['id'=>$id]);	
				$this->Admin_Model->update('order_summery',['status'=>'1'],['order_id'=>$id]);	
			}			
			$this->Admin_Model->update('orders',['is_approved'=>$action],['id'=>$id]);
		}
		else
		{
			redirect('admin/orders_request');
		}
		redirect('admin/orders_request');
	}

	public function update_delivery_status()
	{
		checkadminlogin();
		$status = false;
		if(isset($_POST))
		{		
			$d_status = $this->input->post('d_status');
			$row_id = $this->input->post('row_id');

			$update = $this->Admin_Model->update('orders',['order_status'=>$d_status],['id'=>$row_id]);
			$this->Admin_Model->update('order_summery',['status'=>'3'],['order_id'=>$row_id]);
			if($update)
			{				
				$status = true;
			}
			else
			{
				$status = false;
			}
		}	
		echo json_encode(array('status'=>$status));
	}

	public function complete_orders()
	{
		checkadminlogin();
			$data['complete_orders'] = $this->Admin_Model->select_complete_orders('orders',['order_status'=>'2']);		
			myview('admin/complete_orders',$data);		
	}

	public function update_profile()
	{
		checkadminlogin();
		#$data['profile_details'] = $this->Admin_Model->selectrow('users',['id'=>$id,'usertype'=>'1','is_verified'=>'1','user_status'=>'1','status'=>'1','is_deleted'=>'0']);

		if(!empty($_POST))
		{	
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
			
			if($this->form_validation->run()==FALSE){
				myview('admin/edit_profile');
			}
			else
			{
				$admin_pass = $this->Admin_Model->selectrow('users',['id'=>'3']);

				if(password_verify($this->input->post('old_password'),$admin_pass->password))
				{
					$data2['password']  = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
					$this->Admin_Model->update('users',$data2,['id'=>'3']);
					$this->session->set_flashdata('message',"Password Updated");
					return redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					$this->session->set_flashdata('message',"Old Password Incorrect!!");
					return redirect($_SERVER['HTTP_REFERER']);			
				}

							
			}				
			
		}
		else{
			myview('admin/edit_profile');
		}
		
	}

	public function manage_related_product($id)
	{
		checkadminlogin();
		$id = base64_decode($id);
		$cat_id = $this->Admin_Model->selectrow('products',['id'=>$id, 'is_deleted'=>'0'])->cat_id;
		$data['related_product']=$this->Admin_Model->select('products',['cat_id'=>$cat_id,'is_deleted'=>'0']);
		@$data['related_products'] = $this->Admin_Model->selectrow('related_products',['product_id'=>$id,'is_deleted'=>'0'])->related_product_id;
		if(!empty($_POST))
		{	
			$this->form_validation->set_rules('product[]', 'Products', 'trim|required');
			
			if($this->form_validation->run()==FALSE){
				myview('admin/manage_related_product',$data);				
			}
			else
			{	
					$data2['related_product_id']  = implode(',',$this->input->post('product'));
					$data2['product_id']  = $id;

				$check = $this->Admin_Model->selectrow('related_products',['product_id'=>$id, 'is_deleted'=>'0']);
				if($check)
				{
				
					$this->Admin_Model->update('related_products',$data2,['product_id'=>$id]);
					$this->session->set_flashdata('message',"Successfully Updated");					
				}
				else
				{
					$this->Admin_Model->insert('related_products',$data2);
					$this->session->set_flashdata('message',"Successfully Insert");
				}
				return redirect($_SERVER['HTTP_REFERER']);
			}				
			
		}
		else{
			myview('admin/manage_related_product',$data);			
		}
	}

	public function manage_product_accessories($id)
	{
		checkadminlogin();
		$id = base64_decode($id);
// 		$cat_id = $this->Admin_Model->selectrow('products',['id'=>$id, 'is_deleted'=>'0'])->cat_id;
		$data['related_product']=$this->Admin_Model->select('products',['is_deleted'=>'0']);
		@$data['accessories'] = $this->Admin_Model->selectrow('products_accessories',['product_id'=>$id,'is_deleted'=>'0'])->accessories;
		if(!empty($_POST))
		{	
			$this->form_validation->set_rules('product[]', 'Products', 'trim|required');
			
			if($this->form_validation->run()==FALSE){
				myview('admin/manage_product_accessories',$data);				
			}
			else
			{	
					$data2['accessories']  = implode(',',$this->input->post('product'));
					$data2['product_id']  = $id;

				$check = $this->Admin_Model->selectrow('products_accessories',['product_id'=>$id, 'is_deleted'=>'0']);
				if($check)
				{
				
					$this->Admin_Model->update('products_accessories',$data2,['product_id'=>$id]);
					$this->session->set_flashdata('message',"Successfully Updated");					
				}
				else
				{
					$this->Admin_Model->insert('products_accessories',$data2);
					$this->session->set_flashdata('message',"Successfully Insert");
				}
				return redirect($_SERVER['HTTP_REFERER']);
			}				
			
		}
		else{
			myview('admin/manage_product_accessories',$data);			
		}
	}

	public function setting()
	{
		checkadminlogin();
		#$data['profile_details'] = $this->Admin_Model->selectrow('users',['id'=>$id,'usertype'=>'1','is_verified'=>'1','user_status'=>'1','status'=>'1','is_deleted'=>'0']);
		$data['setting'] = $this->Admin_Model->selectrow('setting',['id'=>'1']);
		if(!empty($_POST))
		{	
			$this->form_validation->set_rules('google_api', 'Google Api', 'trim|required');
			$this->form_validation->set_rules('sms_api', 'Sms Api', 'trim|required');
			$this->form_validation->set_rules('points', 'Point', 'trim|required');
			$this->form_validation->set_rules('rupees', 'Rupees', 'trim|required');
			$this->form_validation->set_rules('video1', 'First Video', 'trim|required');
			$this->form_validation->set_rules('video2', 'Second Video', 'trim|required');
			
			if($this->form_validation->run()==FALSE){

				myview('admin/setting',$data);
			}
			else
			{	
					
				$data2['google_api']  = $this->input->post('google_api');
				$data2['sms_api']  = $this->input->post('sms_api');
				$data2['points']  = $this->input->post('points');
				$data2['rupees']  = $this->input->post('rupees');
				$data2['video1']  = $this->input->post('video1');
				$data2['video2']  = $this->input->post('video2');

					$this->Admin_Model->update('setting',$data2,['id'=>'1']);
					$this->session->set_flashdata('message',"Updated Updated");
					return redirect($_SERVER['HTTP_REFERER']);
			}				
			
		}
		else{
			myview('admin/setting',$data);
		}
	}

	public function review_request()
	{
		checkadminlogin();	
		$data['select_request'] = $this->Admin_Model->select('product_review',['review_status'=>'0']);
		myview('admin/review_request',$data);
	}

	public function action_review_request($action='',$id='')
	{
		checkadminlogin();
		if(!empty($action) || !empty($id))
		{
			$action = base64_decode($action);
			$id = base64_decode($id);			
			$this->Admin_Model->update('product_review',['review_status'=>$action],['id'=>$id]);
			$this->session->set_flashdata('message',"Review Updated");

			redirect('review_request');

		}
		// else
		// {
		// 	myview('admin/setting',$data);

		// 	#redirect('admin/review_request');
		// }
		// #redirect('admin/review_request');
	}

	public function manage_meta($pro_id,$type)
	{
		checkadminlogin();
		$id = base64_decode($pro_id);

		$data['meta']=$this->Admin_Model->selectrow('meta',['product_id'=>$id,'type'=>'2']);
		#pr($data['meta']);
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
			

			if($this->form_validation->run()==FALSE){
				myview('admin/meta',$data);
			}else{
		
				$datas= array(	
								'type' => $type,
								'title' => $this->input->post('title'),							
								'keywords' => $this->input->post('keywords'),
								'description' => $this->input->post('description'),
								'og_title' => $this->input->post('og_title'),
								'og_description' => $this->input->post('og_description'),
								'og_site_name' => $this->input->post('og_site_name'),
								'og_url' => $this->input->post('og_url'),
								'twitter_title' => $this->input->post('twitter_title'),
								'twitter_description' => $this->input->post('twitter_description'),
								'itemprop_title' => $this->input->post('itemprop_title'),
								'itemprop_description' => $this->input->post('itemprop_description'),
								'author' => $this->input->post('author'),
								'page_topic' => $this->input->post('page_topic'),
								'copyright' => $this->input->post('copyright'),
								'robots' => $this->input->post('robots'),
								'rating' => $this->input->post('rating'),
								'google_bot' => $this->input->post('google_bot'),
								'yahoo_seeker' => $this->input->post('yahoo_seeker'),
								'msnbot' => $this->input->post('msnbot'),
								'reply_to' => $this->input->post('reply_to'),
								'allow_search' => $this->input->post('allow_search'),
								'revisit_after' => $this->input->post('revisit_after'),
								'distribution' => $this->input->post('distribution'),
								'expires' => $this->input->post('expires'),
								'language' => $this->input->post('language'),
								'first_json_script_application' => $this->input->post('first_json_script_application'),
								'second_json_script_application' => $this->input->post('second_json_script_application'),
								'third_json_script_application' => $this->input->post('third_json_script_application'),
								'google_manager' => $this->input->post('google_manager')
							);
					if(!empty($data['meta']))
					{
						$insert = $this->Admin_Model->update('meta',$datas,['product_id'=>$id]);
						$msg = "Meta Updated!!";
					}
					else
					{
						$datas['product_id'] = $id;
						$insert = $this->Admin_Model->insert('meta',$datas);
						$msg = "Meta Inserted!!";
					}
					$this->session->set_flashdata('message',$msg);
					return redirect($_SERVER['HTTP_REFERER']);								
			}
		}else{
			myview('admin/meta',$data);
		}
	}

	public function manage_cat_meta($pro_id,$type)
	{
		checkadminlogin();
		$id = base64_decode($pro_id);

		$data['meta']=$this->Admin_Model->selectrow('meta',['product_id'=>$id,'type'=>'0']);
		#pr($data['meta']);
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
			

			if($this->form_validation->run()==FALSE){
				myview('admin/cat_meta',$data);
			}else{
		
				$datas= array(	
								'type' => $type,							
								'keywords' => $this->input->post('keywords'),
								'title' => $this->input->post('title'),
								'description' => $this->input->post('description'),
								'og_title' => $this->input->post('og_title'),
								'og_description' => $this->input->post('og_description'),
								'og_site_name' => $this->input->post('og_site_name'),
								'og_url' => $this->input->post('og_url'),
								'twitter_title' => $this->input->post('twitter_title'),
								'twitter_description' => $this->input->post('twitter_description'),
								'itemprop_title' => $this->input->post('itemprop_title'),
								'itemprop_description' => $this->input->post('itemprop_description'),
								'author' => $this->input->post('author'),
								'page_topic' => $this->input->post('page_topic'),
								'copyright' => $this->input->post('copyright'),
								'robots' => $this->input->post('robots'),
								'rating' => $this->input->post('rating'),
								'google_bot' => $this->input->post('google_bot'),
								'yahoo_seeker' => $this->input->post('yahoo_seeker'),
								'msnbot' => $this->input->post('msnbot'),
								'reply_to' => $this->input->post('reply_to'),
								'allow_search' => $this->input->post('allow_search'),
								'revisit_after' => $this->input->post('revisit_after'),
								'distribution' => $this->input->post('distribution'),
								'expires' => $this->input->post('expires'),
								'language' => $this->input->post('language'),
								'first_json_script_application' => $this->input->post('first_json_script_application'),
								'second_json_script_application' => $this->input->post('second_json_script_application'),
								'third_json_script_application' => $this->input->post('third_json_script_application'),
								'google_manager' => $this->input->post('google_manager')
							);
					if(!empty($data['meta']))
					{
						$insert = $this->Admin_Model->update('meta',$datas,['product_id'=>$id]);
						$msg = "Meta Updated!!";
					}
					else
					{
						$datas['product_id'] = $id;
						$insert = $this->Admin_Model->insert('meta',$datas);
						$msg = "Meta Inserted!!";
					}
					$this->session->set_flashdata('message',$msg);
					return redirect($_SERVER['HTTP_REFERER']);								
			}
		}else{
			myview('admin/cat_meta',$data);
		}
	}

	public function manage_subcat_meta($pro_id,$type)
	{
		checkadminlogin();
		$id = base64_decode($pro_id);

		$data['meta']=$this->Admin_Model->selectrow('meta',['product_id'=>$id,'type'=>'1']);
		#pr($data['meta']);
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
			

			if($this->form_validation->run()==FALSE){
				myview('admin/sub_cat_meta',$data);
			}else{
		
				$datas= array(	
								'type' => $type,
								'title' => $this->input->post('title'),							
								'keywords' => $this->input->post('keywords'),
								'description' => $this->input->post('description'),
								'og_title' => $this->input->post('og_title'),
								'og_description' => $this->input->post('og_description'),
								'og_site_name' => $this->input->post('og_site_name'),
								'og_url' => $this->input->post('og_url'),
								'twitter_title' => $this->input->post('twitter_title'),
								'twitter_description' => $this->input->post('twitter_description'),
								'itemprop_title' => $this->input->post('itemprop_title'),
								'itemprop_description' => $this->input->post('itemprop_description'),
								'author' => $this->input->post('author'),
								'page_topic' => $this->input->post('page_topic'),
								'copyright' => $this->input->post('copyright'),
								'robots' => $this->input->post('robots'),
								'rating' => $this->input->post('rating'),
								'google_bot' => $this->input->post('google_bot'),
								'yahoo_seeker' => $this->input->post('yahoo_seeker'),
								'msnbot' => $this->input->post('msnbot'),
								'reply_to' => $this->input->post('reply_to'),
								'allow_search' => $this->input->post('allow_search'),
								'revisit_after' => $this->input->post('revisit_after'),
								'distribution' => $this->input->post('distribution'),
								'expires' => $this->input->post('expires'),
								'language' => $this->input->post('language'),
								'first_json_script_application' => $this->input->post('first_json_script_application'),
								'second_json_script_application' => $this->input->post('second_json_script_application'),
								'third_json_script_application' => $this->input->post('third_json_script_application'),
								'google_manager' => $this->input->post('google_manager')
							);
					if(!empty($data['meta']))
					{
						$insert = $this->Admin_Model->update('meta',$datas,['product_id'=>$id]);
						$msg = "Meta Updated!!";
					}
					else
					{
						$datas['product_id'] = $id;
						$insert = $this->Admin_Model->insert('meta',$datas);
						$msg = "Meta Inserted!!";
					}
					$this->session->set_flashdata('message',$msg);
					return redirect($_SERVER['HTTP_REFERER']);								
			}
		}else{
			myview('admin/sub_cat_meta',$data);
		}
	}

	public function slider()
	{
		checkadminlogin();
		$data['slider']=$this->Admin_Model->select('slider',['is_deleted'=>'0']);		
		myview('admin/slider',$data);
	}
		
	public function add_slider()
	{
		checkadminlogin();
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('alt', 'Alt Name', 'trim|required');
			if (empty($_FILES['img']['name'])) {
				$this->form_validation->set_rules('img', 'Slider', 'required');
			}

			if($this->form_validation->run()==FALSE){
				myview('admin/add_slider');

			}else{

				$image_data = uploadfile('img','assets/slider_img/');
				$data = array(
								'alt' => $this->input->post('alt'),						
								'image' => $image_data
							);		
				$insert = $this->Admin_Model->insert('slider',$data);
				if($insert)
				{
					$this->session->set_flashdata('message',"Slider add successfully");
					return redirect('slider');
				}				
			}
		}else{
			myview('admin/add_slider');
		}
	}

	public function sliderStatus($ide)
    {
		checkadminlogin();
        if(!empty($ide))
        {
            $id=base64_decode($ide);            
			$check = $this->Admin_Model->selectrow('slider',['id'=>$id]);
			$value = ($check->status==1)?'0':'1';
			$msg=($value=='1')?'Slider active successfully':'Slider inactive successfully';
			
			$this->Admin_Model->update('slider',['status'=>$value],['id'=>$check->id]);
            $this->session->set_flashdata('message',$msg);
            return redirect('slider');
        }else{
            return redirect('slider');
        }
	}
	public function sliderdelete($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('slider',['is_deleted'=>'1'],['id'=>$id]);
		$this->session->set_flashdata('message',"Slider Delete Successfully");
		return redirect('slider');
	}	
	public function edit_slider($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);  
		$data['slider']=$this->Admin_Model->selectrow('slider',['id'=>$id]);
		
		
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('alt', 'Alt Tag', 'trim|required');		

			if($this->form_validation->run()==FALSE){
				myview('admin/edit_slider',$data);

			}else{			

				$datas['alt'] = $this->input->post('alt');
				if (!empty($_FILES['img']['name'])) {
					$image_data = uploadfile('img','assets/slider_img/');	
					$datas['image'] = $image_data;
				}
				$insert = $this->Admin_Model->update('slider',$datas,['id'=>$id]);
				if($insert)
				{
					$this->session->set_flashdata('message',"Sub-Category Updated successfully");
					return redirect('slider');
				}				
			}
		}else{
			myview('admin/edit_slider',$data);
		}
	}

	public function new_arrivals()
	{
		checkadminlogin();
		$data['new_arrivals']=$this->Admin_Model->select('new_arrivals',['is_deleted'=>'0']);		
		myview('admin/new_arrivals',$data);
	}
		
	public function add_new_arrivals()
	{
		checkadminlogin();
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('url', 'URL', 'trim|required');
			$this->form_validation->set_rules('alt', 'ALT tag', 'trim|required');
			if (empty($_FILES['img']['name'])) {
				$this->form_validation->set_rules('img', 'Image', 'required');
			}

			if($this->form_validation->run()==FALSE){
				myview('admin/add_new_arrivals');

			}else{

				$image_data = uploadfile('img','assets/new_arrivals_img/');
				$data = array(
								'url' => $this->input->post('url'),						
								'alt' => $this->input->post('alt'),						
								'image' => $image_data
							);		
				$insert = $this->Admin_Model->insert('new_arrivals',$data);
				if($insert)
				{
					$this->session->set_flashdata('message',"New Arrivals added successfully");
					return redirect('new_arrivals');
				}				
			}
		}else{
			myview('admin/add_new_arrivals');
		}
	}

	public function new_arrivals_status($ide)
    {
		checkadminlogin();
        if(!empty($ide))
        {
            $id=base64_decode($ide);            
			$check = $this->Admin_Model->selectrow('new_arrivals',['id'=>$id]);
			$value = ($check->status==1)?'0':'1';
			$msg=($value=='1')?'New Arrivals active successfully':'New Arrivals inactive successfully';
			
			$this->Admin_Model->update('new_arrivals',['status'=>$value],['id'=>$check->id]);
            $this->session->set_flashdata('message',$msg);
            return redirect('new_arrivals');
        }else{
            return redirect('new_arrivals');
        }
	}
	public function new_arrivalsdelete($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('new_arrivals',['is_deleted'=>'1'],['id'=>$id]);
		$this->session->set_flashdata('message',"New Arrivals Delete Successfully");
		return redirect('new_arrivals');
	}	
	public function edit_new_arrivals($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);  
		$data['new_arrivals']=$this->Admin_Model->selectrow('new_arrivals',['id'=>$id]);
		
		
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('url', 'Url', 'trim|required');		
			$this->form_validation->set_rules('alt', 'Alt Tag', 'trim|required');		

			if($this->form_validation->run()==FALSE){
				myview('admin/edit_new_arrivals',$data);

			}else{
				
				$datas['url'] = $this->input->post('url');
				$datas['alt'] = $this->input->post('alt');
				if (!empty($_FILES['img']['name'])) {
					$image_data = uploadfile('img','assets/new_arrivals_img/');	
					$datas['image'] = $image_data;
				}
				$insert = $this->Admin_Model->update('new_arrivals',$datas,['id'=>$id]);
				if($insert)
				{
					$this->session->set_flashdata('message',"New Arrivals Updated successfully");
					return redirect('new_arrivals');
				}				
			}
		}else{
			myview('admin/edit_new_arrivals',$data);
		}
	}

	public function create_affiliate($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		
		
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('token', 'Random Tokenn', 'trim|required');		
			// $this->form_validation->set_rules('percentage', 'Percentage', 'trim|required');		

			if($this->form_validation->run()==FALSE){
				myview('admin/create_affiliate');	
			}
			else
			{
					$datas['affiliate_status'] = '1';
					$datas['affiliate_key'] = $this->input->post('token');
					// $datas['affiliate_percentage'] = $this->input->post('percentage');

					$insert = $this->Admin_Model->update('users_login',$datas,['id'=>$id]);
					if($insert)
					{
						$this->session->set_flashdata('message',"Random Token Generate");
						return redirect('affiliate_request');
					}	

			}	
		}
		else
		{
				myview('admin/create_affiliate');
		}
	}

	

	public function affiliate_request()
	{
		checkadminlogin();	
		$data['select_request'] = $this->Admin_Model->select('users_login',['affiliate_status'=>'0']);
		myview('admin/affiliate',$data);
	}

	public function action_affiliate_request($action='',$ide='')
	{
		if(!empty($action) || !empty($id))
		{
			$action = base64_decode($action);
			$id = base64_decode($ide);
			if($action == '1')
			{
				#myview('admin/create_affiliate');
				redirect('create_affiliate/'.$ide);

			}
			else
			{
				$this->Admin_Model->update('users_login',['affiliate_status'=>$action],['id'=>$id]);
				$this->session->set_flashdata('message',"Affiliate Updated");
				redirect('affiliate_request');
			}		

		}
		// else
		// {
		// 	myview('admin/setting',$data);

		// 	#redirect('admin/review_request');
		// }
		// #redirect('admin/review_request');
	}

	public function manage_affiliate()
		{
			checkadminlogin();	
			$data['active_affiliate'] = $this->Admin_Model->select('users_login',['affiliate_status !='=>'0','affiliate_status !='=>'3']);
			myview('admin/manage_affiliate',$data);
		}


	public function affiliate_status($ide)
    {
		checkadminlogin();
        if(!empty($ide))
        {
            $id=base64_decode($ide);            
			$check = $this->Admin_Model->selectrow('users_login',['id'=>$id]);
			$value = ($check->affiliate_status=='1')?'2':'1';

			$msg=($value=='1')?'Affiliate active successfully':'Affiliate inactive successfully';
			
			$this->Admin_Model->update('users_login',['affiliate_status'=>$value],['id'=>$check->id]);
            $this->session->set_flashdata('message',$msg);
            return redirect('manage_affiliate');
        }else{
            return redirect('manage_affiliate');
        }
	}
	public function delete_affiliate($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('users_login',['affiliate_status'=>'3'],['id'=>$id]);
		$this->session->set_flashdata('message',"Affiliate Delete Successfully");
		return redirect('manage_affiliate');
	}

	public function trending()
	{
		checkadminlogin();
		$data['total_img'] = $this->Admin_Model->select('trending_img',['is_deleted'=>'0']);
		$data['products'] = $this->Admin_Model->select('products',['status'=>'1','is_deleted'=>'0']);
		$data['product_description']=$this->Admin_Model->selectrow('trending_product_description',['id'=>'1']);


		if(!empty($_POST))
		{
			if (empty($_FILES['thumb_img']['name'])) {
				$this->form_validation->set_rules('thumb_img', 'Thumb Alt', 'required');
			}
			// $this->form_validation->set_rules('thumb_img', 'Thumb Image', 'trim|required');		
			$this->form_validation->set_rules('thumb_alt', 'Thumb Alt', 'trim|required');

			if (empty($_FILES['img']['name'])) {
				$this->form_validation->set_rules('img', 'Main Image', 'required');
			}	
			// $this->form_validation->set_rules('img', 'Main Image', 'trim|required');	
			$this->form_validation->set_rules('alt', 'Main Alt Tag', 'trim|required');	

			if($this->form_validation->run()==FALSE){
				myview('admin/trending',$data);					
			}
			else
			{
					$image_data1 = uploadfile('thumb_img','assets/trending/');
					$image_data = uploadfile('img','assets/trending/');


					$datas['thumb_img'] = $image_data1;
					$datas['thumb_alt'] = $this->input->post('thumb_alt');
					$datas['img'] = $image_data;
					$datas['alt'] = $this->input->post('alt');

					$insert = $this->Admin_Model->insert('trending_img',$datas);
					if($insert)
					{
						$this->session->set_flashdata('message',"Image Added Successfully!!");
					redirect($_SERVER['HTTP_REFERER']);
					}	

			}	
		}
		else
		{
			myview('admin/trending',$data);
		}

	}
	public function remove_trending_img($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('trending_img',['is_deleted'=>'1'],['id'=>$id]);
		$this->session->set_flashdata('message',"Image Delete Successfully");
					redirect($_SERVER['HTTP_REFERER']);
		
	}
	
	public function product_banner($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
	$data['product_banner'] = $this->Admin_Model->select('product_banner',['pro_id'=>$id,'is_deleted'=>'0']);


		if(!empty($_POST))
		{
		
			if (empty($_FILES['img']['name'])) {
				$this->form_validation->set_rules('img', 'Image', 'required');
			}	
			// $this->form_validation->set_rules('img', 'Main Image', 'trim|required');	
			$this->form_validation->set_rules('alt', 'Alt Tag', 'trim|required');	

			if($this->form_validation->run()==FALSE){
				myview('admin/product_banner',$data);					
			}
			else
			{
					$image_data = uploadfile('img','assets/product_banner/');

					$datas['img'] = $image_data;
					$datas['pro_id'] = $id;
					$datas['alt'] = $this->input->post('alt');

					$insert = $this->Admin_Model->insert('product_banner',$datas);
					if($insert)
					{
						$this->session->set_flashdata('message',"Banners Added Successfully!!");
					redirect($_SERVER['HTTP_REFERER']);
					}	

			}	
		}
		else
		{
			myview('admin/product_banner',$data);
		}

	}
	public function remove_product_banner($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('product_banner',['is_deleted'=>'1'],['id'=>$id]);
		$this->session->set_flashdata('message',"Banners Delete Successfully");
					redirect($_SERVER['HTTP_REFERER']);
		
	}

	public function product_description()
	{
		checkadminlogin();
		$product_description=$this->Admin_Model->selectrow('trending_product_description',['id'=>'1']);
		
		#pr($data['product_description']);
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('product_description', 'Product Description', 'trim|required');
			$this->form_validation->set_rules('products', 'Product', 'trim|required');
		
			if($this->form_validation->run()==FALSE){
				redirect('admin/trending');
			}else{
		
				$datas= array(	
								'product_description' => $this->input->post('product_description'),				
								'pro_id' => $this->input->post('products')				
							);
					if(!empty($product_description))
					{
						$insert = $this->Admin_Model->update('trending_product_description',$datas,['id'=>'1']);
						$msg = "Description Updated!!";
					}
					else
					{
						
						$insert = $this->Admin_Model->insert('trending_product_description',$datas);
						$msg = "Description Inserted!!";
					}
					$this->session->set_flashdata('message',$msg);
					return redirect($_SERVER['HTTP_REFERER']);								
			}
		}else{
			myview('admin/trending');
		}
	}

	public function manage_description($id)
	{
		checkadminlogin();
		$id = base64_decode($id);
		$data['description'] = $this->Admin_Model->select('product_description',['pro_id'=>$id,'is_deleted'=>'0']);

		myview('admin/manage_description',$data);
	}

	public function add_description($ide)
	{
		checkadminlogin();
		$id = base64_decode($ide);
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('alt', 'Alt Tag', 'trim|required');
			$this->form_validation->set_rules('product_description', 'Product Description', 'trim|required');
			
			if (empty($_FILES['img']['name'])) {
				$this->form_validation->set_rules('img', 'Image', 'required');
			}

			if($this->form_validation->run()==FALSE){
				myview('admin/add_description');
				
			}else{				
				
				$img = uploadfile('img','assets/description_img/');
				$alt  = $this->input->post('alt');
				$product_description  = $this->input->post('product_description');

				$this->Admin_Model->insert('product_description',['alt'=>$alt,'product_info'=>$product_description,'pro_id'=>$id,'img'=>$img]);

					$this->session->set_flashdata('message',"Description added successfully");
					return redirect('manage_description/'.$ide);
					
					
			}
		}else{
		myview('admin/add_description');
			
		}
	}

	public function description_status($row_id,$ide)
    {
		checkadminlogin();
        if(!empty($ide))
        {
            #$id=base64_decode($ide);            
			$check = $this->Admin_Model->selectrow('product_description',['id'=>$row_id]);
			$value = ($check->status=='1')?'0':'1';

			$msg=($value=='1')?'Description active successfully':'Description inactive successfully';
			
			$this->Admin_Model->update('product_description',['status'=>$value],['id'=>$check->id]);
            $this->session->set_flashdata('message',$msg);
            return redirect('manage_description/'.$ide);
        }else{
            return redirect('manage_description/'.$ide);
        }
	}
	public function delete_description($row_id,$ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('product_description',['is_deleted'=>'1'],['id'=>$row_id]);
		$this->session->set_flashdata('message',"Description Delete Successfully");
            return redirect('manage_description/'.$ide);
		
	}

	public function edit_description($row_id,$ide)
	{
		checkadminlogin();
		$id = base64_decode($ide);
		$data['description']=$this->Admin_Model->selectrow('product_description',['id'=>$row_id]);

		if(!empty($_POST))
		{
			$this->form_validation->set_rules('alt', 'Alt Tag', 'trim|required');
			$this->form_validation->set_rules('product_description', 'Product Description', 'trim|required');

			if($this->form_validation->run()==FALSE){
				myview('admin/edit_description',$data);
				
			}else{	

			if (!empty($_FILES['img']['name'])) {
					$image_data = uploadfile('img','assets/description_img/');	
					$datas['img'] = $image_data;
				}			
				
				$datas['alt']  = $this->input->post('alt');
				$datas['product_info']  = $this->input->post('product_description');

				$this->Admin_Model->update('product_description',$datas,['id'=>$row_id]);

					$this->session->set_flashdata('message',"Description Updated successfully");
					return redirect('manage_description/'.$ide);
					
					
			}
		}else{
		myview('admin/edit_description',$data);
			
		}
	}

	public function manage_specification($ide)
	{
		checkadminlogin();
		$id = base64_decode($ide);
			$this->form_validation->set_rules('product_features','Product Features','required');
			$this->form_validation->set_rules('key_specs','Key Specs','trim|required');
			$this->form_validation->set_rules('warranty', 'Warranty', 'trim|required');
			$this->form_validation->set_rules('performance', 'Performance', 'trim|required');
			$this->form_validation->set_rules('other', 'Other', 'trim|required');

			$data['specification'] = $this->Admin_Model->selectrow('specification',['id'=>'1']);

			if($this->form_validation->run() === FALSE)
			{ 
				myview('admin/manage_specification',$data);
			}
			else
			{
				$specification = array(
								'pro_id' =>	$id,
								'product_features' =>	$this->input->post('product_features'),
								'key_specs' =>	$this->input->post('key_specs'),
								'warranty' => $this->input->post('warranty'),
								'performance' => $this->input->post('performance'),
								'other' => $this->input->post('other')
								
							);
				if($data['specification'])
				{
					$this->Admin_Model->update('specification',$specification,['id'=>'1']);				
					$this->session->set_flashdata('message',"Specification Updated Successfully");
					return redirect($_SERVER['HTTP_REFERER']);		
				}
				else
				{
					$this->Admin_Model->insert('specification',$specification);
					$this->session->set_flashdata('message',"Specification  Added Successfully");
					return redirect($_SERVER['HTTP_REFERER']);		
				}
			}	
	
	}

	public function product_faq($ide)
	{
		checkadminlogin();
		$id = base64_decode($ide);		
		$data['product_faq']=$this->Admin_Model->select('product_faq',['pro_id'=>$id,'is_deleted'=>'0']);
		myview('admin/product_faq',$data);
	}	

	public function add_product_faq($ide)
	{			
			checkadminlogin();
			$id = base64_decode($ide);
			$this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('description','Description','trim|required');

			if($this->form_validation->run() === FALSE)
			{ 
				myview('admin/add_product_faq');
			}
			else
			{
				$title = $this->input->post('title');
				$description = $this->input->post('description');

				
				$this->Admin_Model->insert('product_faq',['pro_id'=>$id,'title'=>$title,'description'=>$description]);
				$this->session->set_flashdata('message',"FAQ's Added Successfully");
				return redirect('product_faq/'.$ide);		
				
			}	
	
	}

	public function product_faq_status($row_id,$ide)
    {
		checkadminlogin();
        if(!empty($ide))
        {
            $row_id=base64_decode($row_id);            
			$check = $this->Admin_Model->selectrow('product_faq',['id'=>$row_id]);
			$value = ($check->status=='1')?'0':'1';

			$msg=($value=='1')?'FAQ active successfully':'FAQ inactive successfully';
			
			$this->Admin_Model->update('product_faq',['status'=>$value],['id'=>$check->id]);
            $this->session->set_flashdata('message',$msg);
            return redirect('product_faq/'.$ide);
        }else{
            return redirect('product_faq/'.$ide);
        }
	}
	
	public function delete_product_faq($row_id,$ide)
	{
		checkadminlogin();
		$row_id = base64_decode($row_id);
		$this->Admin_Model->update('product_faq',['is_deleted'=>'1'],['id'=>$row_id]);
		$this->session->set_flashdata('message',"FAQ Delete Successfully");
            return redirect('product_faq/'.$ide);
		
	}

	public function edit_product_faq($row_id,$ide)
	{
		checkadminlogin();
		$row_id=base64_decode($row_id);  
		$data['product_faq']=$this->Admin_Model->selectrow('product_faq',['id'=>$row_id]);
		
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('description','Description','trim|required');		

			if($this->form_validation->run()==FALSE){
				myview('admin/edit_product_faq',$data);

			}else{			

				$title = $this->input->post('title');
				$description = $this->input->post('description');
				$insert = $this->Admin_Model->update('product_faq',['title'=>$title,'description'=>$description],['id'=>$row_id]);
				if($insert)
				{
					$this->session->set_flashdata('message',"FAQ Updated successfully");
           			return redirect('product_faq/'.$ide);					
				}				
			}
		}else{
			myview('admin/edit_product_faq',$data);
		}
	}

	public function category_banner($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
	$data['category_banner'] = $this->Admin_Model->select('category_banner',['cat_id'=>$id,'is_deleted'=>'0']);


		if(!empty($_POST))
		{
		
			if (empty($_FILES['img']['name'])) {
				$this->form_validation->set_rules('img', 'Image', 'required');
			}	
			// $this->form_validation->set_rules('img', 'Main Image', 'trim|required');	
			$this->form_validation->set_rules('alt', 'Alt Tag', 'trim|required');	
			$this->form_validation->set_rules('url', 'URL', 'trim|required');	

			if($this->form_validation->run()==FALSE){
				myview('admin/category_banner',$data);					
			}
			else
			{
					$image_data = uploadfile('img','assets/category_banner/');

					$datas['img'] = $image_data;
					$datas['cat_id'] = $id;
					$datas['alt'] = $this->input->post('alt');
					$datas['url'] = $this->input->post('url');

					$insert = $this->Admin_Model->insert('category_banner',$datas);
					if($insert)
					{
						$this->session->set_flashdata('message',"Banners Added Successfully!!");
					redirect($_SERVER['HTTP_REFERER']);
					}	

			}	
		}
		else
		{
			myview('admin/category_banner',$data);
		}

	}
	public function remove_category_banner($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('category_banner',['is_deleted'=>'1'],['id'=>$id]);
		$this->session->set_flashdata('message',"Banners Delete Successfully");
					redirect($_SERVER['HTTP_REFERER']);
		
	}

	public function pincode()
	{
		checkadminlogin();
		$data['pincode']=$this->Admin_Model->select('pincode',['is_deleted'=>'0']);
		myview('admin/pincode',$data);
	}	

	public function addpincode()
	{
		checkadminlogin();
		if(!empty($_POST))
		{				
			$this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
			

			if($this->form_validation->run()==FALSE){
				myview('admin/addpincode');
			}else{					
				$data = array(
								'pincode' => ucfirst($this->input->post('pincode')),
							
							);		
				$insert = $this->Admin_Model->insert('pincode',$data);
				if($insert)
				{
					$this->session->set_flashdata('message',"Pincode added successfully");
					return redirect('pincode');
				}				
			}
		}else{
			myview('admin/addpincode');
		}
	}

	public function editpincode($eid)
	{
		checkadminlogin();
		$id=base64_decode($eid); 
		$data['pincode'] =  $this->Admin_Model->selectrow('pincode',['id'=>$id]);
		if(!empty($_POST))
		{	

			$this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
			
			if($this->form_validation->run()==FALSE){
				myview('admin/editpincode',$data);
			}else{				
				$data2['pincode'] = $this->input->post('pincode');			
				
				$insert = $this->Admin_Model->update('pincode',$data2,['id'=>$id]);
				$this->session->set_flashdata('message',"Pincode Updated successfully");
					return redirect('pincode');
			}
		}else{
			myview('admin/editpincode',$data);
		}
	}

	public function pincodestatus($ide)
    {
		checkadminlogin();
        if(!empty($ide))
        {
            $id=base64_decode($ide);            
			$check = $this->Admin_Model->selectrow('pincode',['id'=>$id]);
			$value = ($check->status==1)?'0':'1';
			$msg=($value=='1')?'Pincode active successfully':'Pincode inactive successfully';
			
			$this->Admin_Model->update('pincode',['status'=>$value],['id'=>$check->id]);
            $this->session->set_flashdata('message',$msg);
            return redirect('pincode');
        }else{
            return redirect('pincode');
        }
	}

	public function deletepincode($ide)
	{
		checkadminlogin();
		$id=base64_decode($ide);
		$this->Admin_Model->update('pincode',['is_deleted'=>'1'],['id'=>$id]);
		$this->session->set_flashdata('message',"pincode Delete successfully");
		return redirect('pincode');
	}	

	
}
?>