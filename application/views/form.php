<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
    <title>Product Form</title>
    
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>    
</head>
<body>
 <div class="container">
  <br />
  <h3 align="center">Product Form</h3>
  <br />
  <div class="row">
   <div class="col-md-4">

   </div>
   <div class="col-md-4">
    <span id="success_message"></span>
    <form method="post" id="contact_form">
     <div class="form-group">
      <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" />
      <span id="name_error" class="text-danger"></span>
     </div>
     <div class="form-group">
      <textarea class="form-control" name="description" placeholder="Product Description"></textarea>
      <span id="description_error" class="text-danger"></span>
     </div>
     <div class="form-group">
      <select name="country" id="country" class="form-control">
        <option value="">Select Country</option>
        <?php
          foreach ($country->data as $key => $value) 
          {
            echo "<option value=".$value->name." data-currency=".$value->currency.">".$value->name."</option>";
          }
        ?>
      </select>
      <span id="country_error" class="text-danger"></span>
     </div>
      <div class="form-group">
      <input type="text" name="currency" id="currency" readonly class="form-control">
     </div>
  
     <div class="form-group">
      <input type="submit" name="contact" id="contact" class="btn btn-info" value="Submit">
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
    $("#country").change(function(){
        var element = $(this).find('option:selected');
        var myTag = element.attr("data-currency");
        $('#currency').val(myTag);
    });
});

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
     if(data.description_error != '')
     {
      $('#description_error').html(data.description_error);
     }
     else
     {
      $('#description_error').html('');
     }
     if(data.country_error != '')
     {
      $('#country_error').html(data.country_error);
     }
     else
     {
      $('#country_error').html('');
     }
    }
    if(data.success)
    {
     $('#success_message').html(data.success);
     $('#name_error').html('');
     $('#description_error').html('');
     $('#country_error').html('')
     $('#contact_form')[0].reset();
    }
    $('#contact').attr('disabled', false);
   }
  })
 });

});
</script>
