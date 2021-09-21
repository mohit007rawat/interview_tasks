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
                <div class="btn-group float-sm-right">
                    <a href="<?=base_url('slider')?>" class="btn btn-outline-primary waves-effect waves-light">Slider List</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Add Trending Images</div>
                        <hr>
                        <form method="post" action="<?=base_url('trending')?>" id="" enctype="multipart/form-data">
                            
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Add Thumb Image :</label>
                            <div class="col-sm-3">
                                <input type="file" class="form-control form-control-square" name="thumb_img">
                                        <?=form_error('thumb_img')?>

                        </div> 
                         <label class="col-sm-2 col-form-label">Alt Tag :</label>    
                         <div class="col-sm-3">
                            <input type="text" class="form-control form-control-square" value="<?=set_value('thumb_alt')?>" name="thumb_alt">
                            <?=form_error('thumb_alt')?>
                        </div>        
                    </div>  
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Add Main Images :</label>
                        <div class="col-sm-3">
                            <input type="file" class="form-control form-control-square" name="img">
                            <?=form_error('img')?>
                        </div>
                         <label class="col-sm-2 col-form-label">Alt Tag :</label>    
                         <div class="col-sm-3">
                            <input type="text" class="form-control form-control-square"  value="<?=set_value('alt')?>" name="alt">
                            <?=form_error('alt')?>
                        </div>                                          
                    </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-1">
                                    <button type="submit"
                                        class="btn btn-primary shadow-primary btn-square">
                                        Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: #c8c9eebd;"><i class="fa fa-table"></i> Trending Images List</div>
                    <div class="card-body" style="background-color: #f8ffc63d;">
                         <div class="row">
                        <?php
                            foreach($total_img as $datas)
                            {
                        ?>
                             <div class="col-sm-3">
                                <img style="width: 100%; height: 160px; box-shadow: 7px 5px 7px; margin-bottom: 15px;" src='<?=base_url('assets/trending/'.$datas->thumb_img)?>' alt='<?=$datas->thumb_alt?>'>
                                <a href='<?=base_url('admin/remove_trending_img/'.base64_encode($datas->id))?>' style="width: 100%;" class='btn btn-primary conf'> Remove </a>
                          
                            </div>
                        <?php
                            }
                        ?>
                       
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Product Description</div>
                        <hr>
                        <form method="post" action="<?=base_url('product_description')?>" id="" enctype="multipart/form-data">
                            
                        <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Description</label>
                                 <div class="col-sm-10">
                                      <textarea name="product_description" rows='10' class="form-control"><?=set_value('product_description')?><?=@$product_description->product_description?></textarea>
                                       <?=form_error('product_description')?>
                                 </div>
                            </div>
                             <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Select Related Product :</label>
                        <div class="col-sm-7">
                            <select name="products" class="js-example-basic-multiple form-control form-control-square">
                                <option value="">Select Product's</option>
                                 <?php

                        foreach($products as $k=>$v)
                        {
                        ?> 
                             <option value="<?=$v->id?>" <?=($v->id == $product_description->pro_id) ? 'selected' : ''?>><?=$v->name?></option>
                        <?php                           
                        }                        
                        ?>
                            </select>
                             <?=form_error('products')?>
                        </div>                     
                    </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-1">
                                    <button type="submit"
                                        class="btn btn-primary shadow-primary btn-square">
                                        Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->
       
    </div>
</div>   
<?php include('include/footer.php')?>
<script>
        $(document).ready(function(){
           CKEDITOR.replace( 'product_description' );
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2({
    placeholder: "Select Related Product",
    allowClear: true
});
});
</script>
 