
<body>
 <div id="wrapper">
	<div class="card border-primary border-top-sm border-bottom-sm card-authentication1 mx-auto my-5 animated bounceInDown">
		<div class="card-body">
		 <div class="card-content p-2">
		 <div class="col-sm-12">
                <?php if($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger" id="msg"><?=$this->session->flashdata('error')?></div>
                <?php }
				else{
					?>
				<div class="alert alert-success" id="msg"><?=$this->session->flashdata('message')?></div>
					<?php
				} ?>
            </div>
		  <div class="card-title text-uppercase text-center pb-2">Reset Password</div>
		    <p class="text-center pb-2">Please enter your Mobile Number. You will receive a OTP to verify and create a new password.</p>
		    <form method="POST" action="<?=base_url('store/forget')?>">
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <label for="exampleInputEmailAddress" class="sr-only">Registerd Mobile Number*</label>
				  <input type="text" name="mobile" id="exampleInputEmailAddress" class="form-control form-control-rounded" placeholder="Registerd Mobile Number*">
				  <?=form_error('mobile')?>			
			   </div>
			  </div>
			 
			  <button type="submit" class="btn btn-primary shadow-primary btn-round btn-block waves-effect waves-light mt-3">Reset Password</button>
			  <div class="text-center pt-3">
				<hr>
				<p class="text-muted">Return to the <a href="<?=base_url('store/login')?>"> Sign In</a></p>
			  </div>
			 </form>
		   </div>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/js/popper.min.js"></script>
  <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
  
	
</body>

</html>
