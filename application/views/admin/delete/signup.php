
<body>
 <div id="wrapper">
	<div class="card border-primary border-top-sm border-bottom-sm card-authentication1 mx-auto my-5 animated bounceInDown">
		<div class="card-body">
		 <div class="card-content p-2">
		  <div class="card-title text-uppercase text-center pb-2">SignUp Store</div>		    
		    <form method="POST" action="<?=base_url('store/signup')?>" enctype="multipart/form-data">
			  <div class="form-group">
			  <div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Name*</label>
								<div class="col-sm-9">
								<input type="text" class="form-control" id="" value="<?=set_value('name')?>" name="name" placeholder="Name">
								<?=form_error('name')?>
								</div>
						</div>		
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Last Name*</label>
								<div class="col-sm-9">
								<input type="text" class="form-control" id="" value="<?=set_value('l_name')?>" name="l_name" placeholder="Last Name">
								<?=form_error('l_name')?>
								</div>
						</div>	
					</div>
			  </div>
			  <div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Mobile Number*</label>
								<div class="col-sm-9">
									<input id="country_code" name="country_code" type="hidden" class="form-control">
									<input id="country" name="mobile_number" value="<?=set_value('mobile_number')?>" type="tel" class="form-control">
									<?=form_error('mobile_number')?>
								</div>
						</div>						
										
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Store Name*</label>
								<div class="col-sm-9">
								<input type="text" class="form-control" value="<?=set_value('store_name')?>" name="store_name" placeholder="Store Name">
								<?=form_error('store_name')?>
								</div>
						</div>					
					</div>
			  </div>
			  <div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Store Image</label>
								<div class="col-sm-9">
								<input type="file" class="form-control" name="store_image">	
								</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Estimated Delivery time</label>
								<div class="col-sm-9">
								<input type="text" class="form-control" name="estimated_delivery_time" placeholder="Estimated Delivery time">	
								</div>
						</div>
					</div>
			  </div>
			  <div class="row">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-2 col-form-label">Store Description</label>
								<div class="col-sm-10">
								<input type="text" class="form-control" name="store_desc" placeholder="Store Description">	
								</div>
						</div>
					</div>				
			  </div>
			  <div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Upload ID Proof*</label>
								<div class="col-sm-9">
									<input id="country" name="id_proof" type="file" class="form-control">
									<?=form_error('id_proof')?>
								</div>
						</div>						
										
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Upload Store License*</label>
								<div class="col-sm-9">
								<input type="file" class="form-control" value="<?=set_value('store_license')?>" name="store_license" placeholder="Store Name">
								<?=form_error('store_license')?>
								</div>
						</div>					
					</div>
			  </div>
			  <div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Account Holder Name*</label>
								<div class="col-sm-9">
									<input id="country" name="account_holder_name" value="<?=set_value('account_holder_name')?>" type="text" class="form-control" placeholder="Account Holder Name">
									<?=form_error('account_holder_name')?>
								</div>
						</div>						
										
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Bank Code*</label>
								<div class="col-sm-9">
								<input type="text" class="form-control" value="<?=set_value('bank_code')?>" name="bank_code" placeholder="Bank Code">
								<?=form_error('bank_code')?>
								</div>
						</div>					
					</div>
			  </div>
			  <div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Account Number*</label>
								<div class="col-sm-9">
									<input id="country" name="account_number" value="<?=set_value('account_number')?>" type="text" class="form-control" placeholder="Account Number">
									<?=form_error('account_number')?>
								</div>
						</div>						
										
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Confirm Account Number*</label>
								<div class="col-sm-9">
								<input type="text" class="form-control" value="<?=set_value('c_account_number')?>" name="c_account_number" placeholder="Confirm Account Number">
								<?=form_error('c_account_number')?>
								</div>
						</div>					
					</div>
			  </div>
			  <div class="row">
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Password*</label>
								<div class="col-sm-9">
									<input id="country" name="password" value="<?=set_value('password')?>" type="password" class="form-control" placeholder="Password">
									<?=form_error('password')?>
								</div>
						</div>						
										
					</div>
					<div class="col-md-6">
						<div class="form-group row">
							<label for="inputEmail3" class="col-sm-3 col-form-label">Re-enter password*</label>
								<div class="col-sm-9">
								<input type="password" class="form-control" value="<?=set_value('re_password')?>" name="re_password" placeholder="Re-enter password*">
								<?=form_error('re_password')?>
								</div>
						</div>					
					</div>
			  </div>
			  <div class="row">
					<div class="col-md-6">	
					<div class="form-group row">
						<input type="checkbox" id="vehicle2" name="condition" <?=!empty(set_value('condition'))?'checked':''?>>
  						<label for="vehicle2">Agree to terms and conditions</label><br>
						<?=form_error('condition')?>
					</div>				
					</div>				
			  </div>			 
			  </div>			  
			  <button type="submit" class="btn btn-primary shadow-primary btn-round btn-block waves-effect waves-light mt-3">Sign up</button>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.7/js/intlTelInput.js"></script>

	
</body>
<style>
	.card-authentication1 {
    max-width: 86rem;
}

.intl-tel-input {
    position: relative;
    display: block;
	margin-top: 10px;
}
.form-control-rounded
{
	margin-top: 10px;
}

.col-form-label {
    font-size: 11px;
}

.form-group.row p {
    color: red;
}
	</style>

	<script>
		$("#country").intlTelInput({
  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
});

		$("#country").on("countrychange", function(){
			var getCode = $("#country").intlTelInput('getSelectedCountryData').dialCode;
			$('#country_code').val(getCode);
			//console.log(getCode);
		})
		</script>
</html>
