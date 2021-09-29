<?php
function pr($data)
   {
       echo "<pre>";
       print_r($data);
       die;
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