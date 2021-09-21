<body>

 <div id="wrapper">
	<div class="card border-primary border-top-sm border-bottom-sm card-authentication1 mx-auto my-5 animated bounceInDown">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
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
		 		<!-- <img src="<?=base_url()?>assets/images/logo-icon.png"> -->
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Create New Password</div>
		    <form method="post" action="<?=base_url('store/create_password')?>">
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <label for="exampleInputUsername" class="sr-only">OTP</label>
				  <input type="password" maxlength="4" name="password" class="form-control form-control-rounded" placeholder="Password">
				  <?=form_error('password')?>
			   </div>
			  </div>
			  <div class="form-group">
			   <div class="position-relative has-icon-right">
				  <label for="exampleInputUsername" class="sr-only">OTP</label>
				  <input type="cpassword" maxlength="4" name="cpassword" class="form-control form-control-rounded" placeholder="Confirm Password">
				  <?=form_error('cpassword')?>
			   </div>
			  </div>
			 <button type="submit" class="btn btn-primary shadow-primary btn-round btn-block waves-effect waves-light">Verify</button>
			 </form>
		   </div>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper-->

  <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/js/popper.min.js"></script>
  <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
  
</body>

</html>
