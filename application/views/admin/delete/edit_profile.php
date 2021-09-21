<?php include('include/header.php')?>
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
            <?php if($this->session->flashdata('message')) { ?>
                    <div class="alert alert-success" id="msg"><?=$this->session->flashdata('message')?></div>
                <?php } ?>
            </div>
            <div class="col-sm-3">
               
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Edit Password</div>
                        <hr>
                        <form method="post" action="<?=base_url('admin/update_profile')?>"> 
                       
                         <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Old Password</label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control form-control-square" value="<?php echo set_value('old_password'); ?>" name="old_password">
                                    <?=form_error('old_password')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control form-control-square" value="<?php echo set_value('password'); ?>" name="password">
                                    <?=form_error('password')?>
                                </div>
                            </div>
							<div class="form-group row">
                                <label class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control form-control-square" value="<?php echo set_value('cpassword'); ?>" name="cpassword">
                                    <?=form_error('cpassword')?>
                                </div>
                            </div>

							
							                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-3">
                                    <button type="submit"
                                        class="btn btn-primary shadow-primary btn-square">
                                        Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->

    </div>
 
<?php include('include/footer.php')?>
