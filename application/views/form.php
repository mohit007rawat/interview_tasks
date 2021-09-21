<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
    <title>Registration Form</title>
    
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>    
</head>
<body>
 <div class="container">
  <br />
  <h3 align="center">User Registration Form</h3>
  <br />
  <div class="row">
   <div class="col-md-4">

   </div>
   <div class="col-md-4">
    <span id="success_message"></span>
    <form method="post" id="contact_form">
     <div class="form-group">
      <input type="text" name="name" id="name" class="form-control" placeholder="Name" />
      <span id="name_error" class="text-danger"></span>
     </div>
     <div class="form-group">
      <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" />
      <span id="email_error" class="text-danger"></span>
     </div>
     <div class="form-group">
      <input type="date" name="dob" id="subject" class="form-control">
      <span id="dob_error" class="text-danger"></span>
     </div>
      <div class="form-group">
      <input type="file" name="img" id="subject" class="form-control">
      <span id="img_error" class="text-danger"></span>
     </div>
  
     <div class="form-group">
      <input type="submit" name="contact" id="contact" class="btn btn-info" value="Contact Us">
     </div>
    </form>
   </div>
   <div class="col-md-4"></div>
  </div>
 </div>
</body>
</html>
<script>
$(document).ready(function(){

 $('#contact_form').on('submit', function(event){
  event.preventDefault();
    var coldata = new FormData(this); 
  $.ajax({
   url:"<?=base_url('form/submit_form')?>",
   method:"POST",
    data: coldata,
    contentType: false,
    cache: false,
    processData:false,
   dataType:"json",
   beforeSend:function(){
    $('#contact').attr('disabled', 'disabled');
   },
   success:function(data)
   {
    if(data.error)
    {
     if(data.name_error != '')
     {
      $('#name_error').html(data.name_error);
     }
     else
     {
      $('#name_error').html('');
     }
     if(data.email_error != '')
     {
      $('#email_error').html(data.email_error);
     }
     else
     {
      $('#email_error').html('');
     }
     if(data.subject_error != '')
     {
      $('#dob_error').html(data.dob_error);
     }
     else
     {
      $('#dob_error').html('');
     }
     if(data.message_error != '')
     {
      $('#img_error').html(data.img_error);
     }
     else
     {
      $('#img_error').html('');
     }
    }
    if(data.success)
    {
     $('#success_message').html(data.success);
     $('#name_error').html('');
     $('#email_error').html('');
     $('#dob_error').html('');
     $('#img_error').html('');
     $('#contact_form')[0].reset();
    }
    $('#contact').attr('disabled', false);
   }
  })
 });

});
</script>
