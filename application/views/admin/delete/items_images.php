<?php include('include/header.php')?>
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
                        <!-- <form method="POST" action="<?=base_url('store/add_more_img/').$this->uri->segment(3)?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">Add Image :</label>
                        <div class="col-sm-3">
                            <input type="file" class="form-control form-control-square" name="more_img[]" multiple>
                        </div>  
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary shadow-primary btn-square">Submit</button>
                        </div>                   
                    </div>  
                        </form>                                                                                  
                        <hr>-->   

                        <div class="row">
                        <?php
                        foreach($products_image as $k=>$v)
                        {
                        ?>      
                                <div class="col-md-3 mb-3 img_mod">
                                    <img class="pro_img" src="<?=base_url('assets/product_image/').$v->image?>"></br>
                                    <a class="btn-sm btn-danger mt-2 remove_button" onclick="return confirm('Are you sure want to delete')"
                                    href="<?=base_url('admin/delete_product_image/').base64_encode($v->id).'/'.$this->uri->segment('3')?>">Remove</a>
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
.img_mod
{
    box-shadow: 0 2px 5px;

}

</style>
<?php include('include/footer.php')?>
