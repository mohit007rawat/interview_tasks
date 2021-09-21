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
                    <a href="<?=base_url('malls')?>" class="btn btn-outline-primary waves-effect waves-light">Malls List</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Edit Sub-Category Name</div>
                        <hr>
                        <form method="post" action="<?=base_url('edit_product_brochure/').$this->uri->segment('2')?>" id="" enctype="multipart/form-data">
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sub-Category Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="name" value="<?= $product_brochure->name?>" placeholder="Category Name">
                                    <?=form_error('name')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sub-Category Image</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square" name="img" id='img'>
                                    <?=form_error('img')?>
                                </div>
                                <?php
                                    if(!empty($product_brochure->img))
                                    {
                                ?>
                                <div class="col-sm-3">
                                    <img width="140px" height="120px" src="<?=base_url('assets/brochure/').$product_brochure->img?>">
                                </div>    
                                <?php
                                    }
                                ?>
                                                          
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Brochure PDF</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square" name="pdf" accept="application/pdf" id='img'>
                                    <?=form_error('pdf')?>
                                </div>                                 
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-1">
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
    <style>
.ch_type
{
    
    color: #6b6b6b;
    font-size: .75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    margin-bottom: 10px;
    padding-left: 5px;
    margin-left: 12px;

}

#che_type
{
    
    left: -10px;
  
    top: 2px;

}
    </style>
    <?php include('include/footer.php')?>

    <script>
        $(document).ready(function(){
            $('#cat_type').on('change',function(){

                var cat_type = $(this).val();
        	    var fd = new FormData();
                fd.append('cat_type',cat_type);

                $.ajax({
                    url : "<?=base_url('admin/get_cat')?>",
                    method : "POST",
                    dataType : 'json',
                    data : fd,
                    processData: false,
                    contentType: false,
                    success : function(status){
                        $("#cat_name option:not(:first-child)").remove();
                        status.data.forEach(item => {
                            $("#cat_name").append(`<option value="${item.id}">${item.name}</option>`);
                        })
                    }
                });
            });
        });
    </script>