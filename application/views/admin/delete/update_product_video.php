<?php  include('include/header.php')?>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">   
    <div class="row pt-2 pb-2">
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
        </div>
    <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <?php if($this->session->flashdata('message')) { ?>
                <div class="alert alert-success" id="msg"><?=$this->session->flashdata('message')?></div>
                <?php } ?>
            </div>
        </div>
        <div class="row">      
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-body">  
                        <form method="POST" action="<?=base_url('update_product_video/').$this->uri->segment('2')?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">Update Video :</label>
                        <div class="col-sm-3">
                            <input type="file" accept="video/mp4,video/x-m4v,video/*" class="form-control form-control-square" name="video">
                        </div>  
                        <div class="col-sm-1">
                            <button type="submit" name='submit' class="btn btn-primary shadow-primary btn-square">Submit</button>
                        </div>                   
                    </div>  
                        </form>                
                                                                    
                        <hr>

                        <div class="row">
                        <?php
                        foreach($media as $k=>$v)
                        {
                        ?>      
                                <div class="col-md-3 mb-3">
                                    <video width="320" height="240" controls>
                                      <source src="<?=base_url('assets/product_image/').$v->image?>" type="video/mp4">
                                    </video>
                                   <!-- <img class="pro_img" src="<?=base_url('assets/product_image/').$v->image?>">
                                     <a class="btn-sm btn-danger mt-2 remove_button" onclick="return confirm('Are you sure want to delete')"
                                    href="<?=base_url('restaurant/delete_item_image/').base64_encode($v->id)?>">Remove</a> -->
                                </div> 
                           
                        <?php                           
                        }                        
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->

    </div>
</div>
<style>
    .pro_img
    {
        vertical-align: middle;
        border-style: none;
        width: 100%;
        margin-bottom: -7px;
        height: 210px;
    }
    .btn-sm.btn-danger.mt-2.remove_button {
    display: block;
    text-align: center;
    font-size: 15px;
}

</style>
<?php include('include/footer.php')?>
