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
                    <!--<a href="<?=base_url('slider')?>" class="btn btn-outline-primary waves-effect waves-light">Slider List</a>-->
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Add Banner Images</div>
                        <hr>
                        <form method="post" action="<?=base_url('product_banner/').$this->uri->segment('2')?>" id="" enctype="multipart/form-data">
                      
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Add Product Banner :</label>
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

      
        <!--End Row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: #c8c9eebd;"><i class="fa fa-table"></i>Banner's List</div>
                    <div class="card-body" style="background-color: #f8ffc63d;">
                         <div class="row">
                        <?php
                            foreach($product_banner as $datas)
                            {
                        ?>
                             <div class="col-sm-3">
                                <img style="width: 100%; height: 160px; box-shadow: 7px 5px 7px; margin-bottom: 15px;" src='<?=base_url('assets/product_banner/'.$datas->img)?>' alt='<?=$datas->alt?>'>
                                <a href='<?=base_url('admin/remove_product_banner/'.base64_encode($datas->id))?>' style="width: 100%;" class='btn btn-primary conf'> Remove </a>
                          
                            </div>
                        <?php
                            }
                        ?>
                       
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
<?php include('include/footer.php')?>
 