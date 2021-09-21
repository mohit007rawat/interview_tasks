<?php include('include/header.php');?>
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
                        <div class="card-title">Edit Form</div>
                        <hr>
                        <form method="post" enctype="multipart/form-data"  action="<?=base_url('admin/edit_user/').$this->uri->segment('3')?>"> 
                       
                         <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" value="<?=$users->name?>" name="name">
                                    <?=form_error('name')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" value="<?=$users->email?>" name="email">
                                    <?=form_error('email')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">DOB</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" value="<?=$users->dob?>" name="dob">
                                    <?=form_error('dob')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Img</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square"  name="img">
                                    <?=form_error('img')?>
                                </div>
                            </div>
                            <img width='180px' height="120px" src="<?=base_url('assets/img/').$users->img?>"><                            


							
							                           
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
