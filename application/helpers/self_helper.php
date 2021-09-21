<?php
function pr($data)
   {
       echo "<pre>";
       print_r($data);
       die;
   }
function uploadfile($name,$location,$unlink="")  //upload method
  {
    $ci= & get_instance();
    if(!empty($name))
    {
      // $this->form_validation->set_rules($name, 'Document', 'required');
    $config['upload_path']      = $location;
    $config['allowed_types']    = 'gif|jpg|png|pdf';          
    $config['file_name']        = date('ymdhis').$_FILES[$name]['name'];   

    $ci->upload->initialize($config);
    $ci->load->library('upload', $config);
   
      if (!$ci->upload->do_upload($name))
      {
      echo $ci->upload->display_errors();
      }
      else
      {
        $imgdata = $ci->upload->data();
        if($unlink)
          #pr($location.$unlink);
          unlink($location.$unlink);
      return  $img = $imgdata['file_name'];
      }
    }else{
    return  $img = '';
    }
  }

  
  function checkadminlogin()
  {
    $ci = & get_instance();
    if(empty($ci->session->userdata('loginadmin')))
    {
      redirect('admin');
    }    
  }

  function myview($data,$data2='')
  {

    $ci = & get_instance();
    $ci->load->view($data,$data2);
    return true;
  }

  
  
?>